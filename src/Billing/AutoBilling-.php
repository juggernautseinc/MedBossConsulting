<?php

/*
 *  package   OpenEMR
 *  link      http://www.open-emr.org
 *  author    Sherwin Gaddis <sherwingaddis@gmail.com>
 *  copyright Copyright (c )2020.. Sherwin Gaddis <sherwingaddis@gmail.com>
 *  license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

namespace OpenEMR\Billing;

use Exception;
use OpenEMR\Billing\BillingProcessor\BillingModifiers;
use OpenEMR\Services\AppointmentService;

class AutoBilling
{
    private $rid;
    private $pid;
    private $userid;

    public function __construct()
    {
           $this->rid = $this->getMaxBilling();
           $this->pid = $_SESSION['pid'];
        $this->userid = $_SESSION['authUserID'];
    }

    protected function genCptArray()
    {
        $getstringtovariable = $this->cpts;
        $theCpts = explode(",,", $getstringtovariable);
        return $theCpts;
    }

    protected function genDxArray()
    {
        $getstringtovariable = $this->dxs;
        $theDxs = explode(",,", $getstringtovariable);
        return $theDxs;
    }

    protected function genMultiCode()
    {
        $cptarray = $this->genCptArray();
        $dxarray = $this->genDxArray();
        $this->generateBilling($dxarray[0], $cptarray[0]);
        $this->generateBilling($dxarray[1], $cptarray[1]);
        $this->generateBilling($dxarray[2], $cptarray[2]);
        $this->generateBilling($dxarray[3], $cptarray[3]);
    }

    public function billingEntries($dx, $cpt)
    {
        /**
         * determine insurance and modifiers
         */
        $date = date("Y-m-d") . " 00:00:00";
        $appointmentype = new AppointmentService();
        $apptitle = $appointmentype->getPatientAppointmentCategory($_SESSION['pid'], $date);
        $lookforhyphen = substr_count($apptitle, '-');
        if ($lookforhyphen >= 1) {
            file_put_contents("/var/www/html/errors/category.txt", $apptitle . "\r", FILE_APPEND);
            $telehealthvisit = explode(" - ", $apptitle['pc_catname']);
            file_put_contents("/var/www/html/errors/insurancematch.txt", $telehealthvisit[0] . " <- " . $telehealthvisit[1] . "\r", FILE_APPEND);

            if ($telehealthvisit[0] == 'TeleHealth') {
                $fid = new BillingModifiers($_SESSION['pid']);
                error_log("Checked Patient Insurance.", time());
                file_put_contents("/var/www/html/errors/insurancematch_2.txt", $fid . "\n", FILE_APPEND);
            }
        }
        /**
         * determine if there is more than one CPT and Dx code
         */

        $howmanycpts = substr_count($cpt, ",,");
        $howmanydx =substr_count($dx, ",,");

        if($howmanycpts > 1 || $howmanydx > 1) {
            $this->cpts = $cpt;
            $this->dxs = $dx;
        }

        if($howmanydx == 1 && $howmanycpts == 1) {
            $cpt = str_replace(",,", "", $cpt);
            $dx = str_replace(",,", "", $dx);
            $this->generateBilling($dx, $cpt);
        } else {
            $this->genMultiCode();
        }
    }

    public function generateBilling($dx, $cpt)
    {
        /**
         *  This section is for the billing to be filled when the encounter is signed.
         */

            $event_date = date("Y-m-d H:i:s");


        /**
         *  Aggregate information to fill billing table
         */
        //$event_date = $event_date . " " . date("H:i:s"); // append current time to event date
        $billingData = explode("-", $cpt);  //separate up billing information into code and text
        $code = trim($billingData[0]);  // code that is in the calendar description with the decimalOpen
        $text = $billingData[1]; //get the billing description from the code table


        $icd10code = explode(" - ", $dx);
        $icd10 = $icd10code[0];
        $desc = $icd10code[1];

        /**
         * Grab Fee
         * @returns int
        */
        $fees = $this->getCodeFee($code);

        /**
         * Grab the encounter to post charges using the event date
         * @returns int
         */
       //$enc = $this->getEventEncounter($pid, $event_date);
        $enc = $_SESSION['encounter'];
        /**
         * Grab the provider for the encounter from the event table
         */
        //$provider = $this->getEventProvider($pid, $event_date);
        $provider = $_SESSION['authUserID'];
        /**
         * find out if there are any entries in the billing table for event date for this patient
         * moved to calendar inc
         *
         */
        $hasBilling = $this->findEventBilling($this->pid, $enc);

        /**
         * Gets the modifier assigned to the
         */
        $modifier = $this->getModifier($code);
        $modifier = str_replace(",", "", $modifier);

        //insert billing if there is none
        if (empty($hasBilling['encounter'])) {

            if (!empty($code)) {
                try {
                    $codetype = "CPT4";
                    $this->insertCPTBilling($event_date, $code, $this->pid, $provider, $this->userid, $enc, $text, $fees, $icd10, $codetype, $modifier);
                } catch (Exception $e) {
                    return $e;
                }
            }

            try {
                //Enter ICD10 if it exist
                if (!empty($desc) && empty($res)) {
                    $codetype = "ICD10";
                    $this->insertICDBilling($event_date, $codetype, $icd10, $this->pid, $provider, $this->userid, $enc, $desc);
                }
            } catch (Exception $e) {
                return $e;
            }
        }
    }// End of billing entries

    /**
     * @param $event_date
     * @param $code
     * @param $pid
     * @param $provider
     * @param $userid
     * @param $enc
     * @param $text
     * @param $fees
     * @param $icd
     * @param $codetype
     * @param $modifier
     */
    private function insertCPTBilling($event_date, $code, $pid, $provider, $userid, $enc, $text, $fees, $icd10, $codetype, $modifier)
    {
        $sql = "REPLACE INTO billing SET " .
            "date = ? , " .
            "code_type = ?, " .
            "code = ?, " .
            "pid = ?, " .
            "provider_id = ?, " .
            "user = ?, " .
            "groupname = 'default', " .
            "authorized = '1', " .
            "encounter = ?, " .
            "code_text = ?, " .
            "billed = '0', ".
            "activity = '1', " .
            "modifier = ?, " .
            "units = '1', " .
            "fee = ?, " .
            "justify = ?, " .
            "pricelevel = 'standard'";

        try {
             $justify = "ICD10|$icd10:";
              sqlStatement($sql, [$event_date, $codetype, $code, $pid, $provider, $userid, $enc, $text, $modifier, $fees, $justify]);
        } catch (Exception $e) {
            return $e;
        }
        return 1;
    }

    /**
     * @param $enDate
     * @param $icd10
     * @param $pid
     * @param $provider
     * @param $userid
     * @param $enc
     * @param $desc
     */
    private function insertICDBilling($event_date, $codetype, $icd10, $pid, $provider, $userid, $enc, $desc)
    {

        $sql = "REPLACE INTO billing SET "
            . "date = ?,"
            . "code_type = ?,"
            . "code = ?,"
            . "pid = ?,"
            . "provider_id = ?,"
            . "user = ?,"
            . "groupname = 'default',"
            . "authorized = '1',"
            . "encounter = ?,"
            . "code_text = ?,"
            . "activity = '1',"
            . "units = '1', "
            . "fee = '0.00'";

        try {
            sqlStatement($sql, [$event_date, $codetype, $icd10, $pid, $provider, $userid, $enc, $desc]);
        } catch (Exception $e) {
            return $e;
        }
    }

    /**
     * @param $pid
     * @return mixed
     */
    public function getDiagnosis()
    {
        /**
         * get the most recent diagnosis
         */
        $sql = "select title, diagnosis, type from lists where pid = ? ORDER BY id DESC LIMIT 1";
        $res = sqlQuery($sql, [$this->pid]);
        return $res;
    }

    /**
     * @param $code
     * @return string
     */
    private function getCodeFee($code)
    {
        $getFee = "SELECT b.pr_price FROM `codes` AS a, prices AS b WHERE a.code = ? AND a.id = b.pr_id ";
        $fee = sqlQuery($getFee,array($code));
        if (empty($fee['pr_price'])) {
            $fees = '0.00';
        } else {
            $fees = $fee['pr_price'];
        }

        return $fees;
    }

    /**
     * @param $pid
     * @param $enDate
     * @return mixed
     */
    private function getEventEncounter($pid,$enDate)
    {
        $d = substr($enDate, 0,-8);
        $de = $d." 00:00:00";
        $sql = "SELECT encounter FROM form_encounter WHERE pid = ? AND date = ?";
        $query_e = sqlQuery($sql, [$pid, $de]);
        return $query_e['encounter'];
    }

    /**
     * @param $pid
     * @param $enDate
     * @return mixed
     * Check if billing has been done for this event date
     */
    private function findEventBilling($pid, $enc)
    {
        $sql = "select id from billing where pid = ? and encounter = ?";
        $findbilling = sqlQuery($sql, [$pid, $enc]);
        return $findbilling;
    }

    //find modifier for code if one

    /**
     * @param $code
     * @return mixed
     */
    private function getModifier($code) {
        $sql = "select modifier from codes where code = ?";
        $isModified = sqlQuery($sql, [$code]);
        return $isModified['modifier'];
    }

    //get the provider for the encounter

    /**
     * @param $pid
     * @param $event_date
     * @return mixed
     */
    private function getEventProvider($pid, $event_date)
    {
        $ev = substr($event_date, 0,-8);
        $sql = "select pc_aid from openemr_postcalendar_events where pc_eventDate = ? AND pc_pid = ? ";
        $provider = sqlQuery($sql, [$ev, $pid]);
        return $provider['pc_aid'];
    }

    /**
     * @param $pid
     * @param $enc
     * @return mixed
     *  check that any documentation has been started/saved
     */
    private function checkDocumenation($pid, $enc)
    {
        $sql = "select count(formdir) as c from forms where pid = ? and encounter = ?";
        $formcount = sqlQuery($sql, [$pid, $enc]);
        return $formcount['c'];

    }

    private function getMaxBilling()
    {
        $sql = "select MAX(id) as id from billing";
        $maxid = sqlQuery($sql);
        return $maxid['id'];
    }

    private function getCodeText($description, $codeDes)
    {
        $desc = "%".$description;
        $sql = "select code_text from codes where code_text LIKE ? and code = ?;";
        $codetext = sqlQuery($sql, [$desc, $codeDes]);
        $value = substr($codetext['code_text'], 0, strpos($codetext['code_text'], "-"));
        return trim($value);
    }
} // end of class
