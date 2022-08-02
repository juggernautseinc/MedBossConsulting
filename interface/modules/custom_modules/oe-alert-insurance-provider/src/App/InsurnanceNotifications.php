<?php

/**
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  license https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

namespace Juggernaut\App;

use GuzzleHttp\Client;
use Mpdf\Mpdf;

class InsuranceNotifications
{
    protected array $statuses;
    protected $letter;
    protected $pid;
    protected $pdf;
    protected bool $checkInsurance;
    protected $output;
    protected $pdfName;
    /**
     * @param array $appointmentData
     */
    public function __construct(array $appointmentData)
    {
        $this->pid = $appointmentData['form_pid'];
        $this->checkInsurance = Database::isPatientTriWest($this->pid);
        $contact = Database::vaContactName($this->pid);
        $document = new TemplateProcessor($appointmentData);
        $flag = $document->createTemplateFlag();
        if ($this->checkInsurance && !empty($contact[1]['field_value']) && $flag) {
             //fill out template if the contact form has an email address
            $this->letter = $document->letterTemplate();
        }

        self::storeTempPdfDocument();
    }

    protected function storeTempPdfDocument(): void
    {
        require_once dirname(__DIR__, 5) . "/globals.php";
        require_once dirname(__DIR__, 6) . "/controllers/C_Document.class.php";
        require_once dirname(__DIR__, 6) . "/library/documents.php";

        $fileName = $this->pid . "-" . date('Y-m-d_H:m:s') . ".html";
        $tmpdir = $GLOBALS['OE_SITE_DIR'] . '/documents/temp/';
        $temp_filename = $tmpdir . $fileName;
        file_put_contents($temp_filename, $this->letter);
        $size = filesize($temp_filename);
        $type = "application/html";
        $category_id = 693414;

        addNewDocument($fileName, $type, $temp_filename, 0, $size, $_SESSION['authUserID'], $this->pid, $category_id);
    }
}
