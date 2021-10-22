<?php

/**
 * assessment_intake report.php.
 *
 * Forms generated from formsWiz
 *
 * @package   OpenEMR
 * @link      http://www.open-emr.org
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2018 Brady Miller <brady.g.miller@gmail.com>
 * @license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

require_once("../../globals.php");
require_once($GLOBALS["srcdir"] . "/api.inc");
function assessment_intake_report($pid, $encounter, $cols, $id)
{
    $count = 0;
    //print "Assessment Intake Report";
    //$data = formFetch("form_assessment_intake", $id);

    $formFetch = sqlQuery("SELECT personal_strengths FROM form_assessment_intake WHERE id = ?", [$id]);
    $data = json_decode($formFetch['personal_strengths'], true);
    print "<table><tr>";
    if (!empty($data)) {
        if (!empty($data["referral_source"])) {
            echo "<tr><td style='padding: 15px'><b>Referral Source: </b></td><td><span style='padding-left: 15px'> " . $data['referral_source'] . "</span></td></tr>";
        }
        if (!empty($data["new_client_eval"] || $data["consultation"] || $data["annual"])) {
            echo "<tr><td style='padding: 15px'><b>Purpose: </b></td><td><span style='padding-left: 15px'> ";
                if (!empty($data['new_client_eval'])) {
                    print " New client evaluation <br>";
                }
                if (!empty($data['consultation'])) {
                    print " Consultation <br>";
                }
                if (!empty($data['annual'])) {
                    print " Annual Update <br>";
                }
            echo "</span></td></tr>";
        }
        if (!empty($data["copy_sent_to"])) {
            echo "<tr><td style='padding: 15px'><b>Copy sent to: </b></td><td><span style='padding-left: 15px'> " . $data['copy_sent_to'] .
                "</span></td></tr>";
        }
        if (!empty($data["treatment"])) {
            echo "<tr><td style='padding: 15px'><b>Goals and treatment <br>expectations of the patient: </b></td><td><span style='padding-left: 15px'> " .
                $data['treatment'] . "</span></td></tr>";
        }
        echo "<tr style='background-color: lightgray'><td colspan='2' align='center'><b>AREAS OF FUNCTIONING</b></td></tr>";
        if (!empty($data["school_work"])) {
            echo "<tr><td style='padding: 15px'><b>How is School/Work <br>impacted by current <br>condition? </b></td><td><span style='padding-left: 15px'> " .
                $data['school_work'] . "</span></td></tr>";
        }
        if (!empty($data["personal_relationships"])) {
            echo "<tr><td style='padding: 15px'><b>How are Personal and Family <br>Relationships (Intimate) impacted? </b></td><td><span style='padding-left: 15px'> " .
                $data['personal_relationships'] . "</span></td></tr>";
        }
        if (!empty($data["other"])) {
            echo "<tr><td style='padding: 15px'><b>Other? </b></td><td><span style='padding-left: 15px'> " .
                $data['other'] . "</span></td></tr>";
        }
        echo "<tr style='background-color: lightgray'><td colspan='2' align='center'><b>CLINCAL FINDINGS</b></td></tr>";
        if (!empty($data["summary"])) {
            echo "<tr><td style='padding: 15px'><b>Clinical Summary: </b></td><td><span style='padding-left: 15px'> " .
                $data['summary'] . "</span></td></tr>";
        }
        echo "<tr style='background-color: lightgray'><td colspan='2' align='center'><b>Diagnoses</b></td></tr>";
        if (!empty($data["axis1"])) {
            echo "<tr><td style='padding: 15px'><b>Axis I: </b></td><td><span style='padding-left: 15px'> " .
                $data['axis1'] . "</span></td></tr>";
        }
        if (!empty($data["axis2"])) {
            echo "<tr><td style='padding: 15px'><b>Axis II: </b></td><td><span style='padding-left: 15px'> " .
                $data['axis2'] . "</span></td></tr>";
        }
        if (!empty($data["axis3"])) {
            echo "<tr><td style='padding: 15px'><b>Axis III: </b></td><td><span style='padding-left: 15px'> " .
                $data['axis3'] . "</span></td></tr>";
        }
        echo "<tr ><td><b>Axis IV Psychosocial and environmental problems in the last year:</b></td><td></td>";
        echo "<tr><td></td><td>";
        if ($data['ax4_prob_support_group'] == 'on') {
            echo "Problems with primary support group<br>";
        }
        if ($data['ax4_prob_soc_env'] == 'on') {
            echo "Problems related to the social environment<br>";
        }
        if ($data['ax4_educational_prob'] == 'on') {
            echo "Educational problems<br>";
        }
        if ($data['ax4_occ_prob'] == 'on') {
            echo "Occupational problems<br>";
        }
        if ($data['ax4_housing'] == 'on') {
            echo "Housing problems<br>";
        }
        if ($data['ax4_economic'] == 'on') {
            echo "Economic problems<br>";
        }
        if ($data['ax4_access_hc'] == 'on') {
            echo "Problems with access to health care services<br>";
        }
        if ($data['ax4_legal'] == 'on') {
            echo "Problems related to interaction with the legal system/crime<br>";
        }
        if ($data['ax4_other_cb'] == 'on') {
            echo $data['ax4_other'];
        }
        echo "</td></tr>";
        if (!empty($data["ax5_current"])) {
            echo "<tr><td style='padding: 15px'><b>Currently: </b></td><td><span style='padding-left: 15px'> " .
                $data['ax5_current'] . "</span></td></tr>";
        }
        if (!empty($data["ax5_past"])) {
            echo "<tr><td style='padding: 15px'><b>Past Year: </b></td><td><span style='padding-left: 15px'> " .
                $data['ax5_past'] . "</span></td></tr>";
        }
        echo "<tr style='background-color: lightgray'><td colspan='2' align='center'><b>INITIAL RISK EVALUATION</b></td></tr>";
        echo "<tr><td style='padding: 15px'><b>Suicide: </b></td><td><span style='padding-left: 15px'>";
        if (!empty($data["risk_suicide_na"])) {
            echo "Not Assessed";
        }
        echo "</span></td></tr>";
        echo "<tr><td style='padding: 15px'><b>Behaviors: </b></td><td><span style='padding-left: 15px'> ";
        if (!empty($data["risk_suicide_nk"])) {
            print "Not Known <br>";
        }
        if (!empty($data["risk_suicide_io"])) {
            print "Ideation only <br>";
        }
        if (!empty($data["risk_suicide_plan"])) {
            print "Plan<br>";
        }
        if (!empty($data["risk_suicide_iwom"])) {
            print "Intent without means <br>";
        }
        if (!empty($data["risk_suicide_iwm"])) {
            print "Intent with means <br>";
        }
        echo "</span></td></tr>";
        echo "<tr><td style='padding: 15px'><b>Homocide: </b></td><td><span style='padding-left: 15px'> ";
        if (!empty($data["risk_homocide_na"])) {
            print "Not Assessed <br>";
        }
        echo "</span></td></tr>";
        echo "<tr><td style='padding: 15px'><b>Behaviors: </b></td><td><span style='padding-left: 15px'> ";
        if (!empty($data["risk_homocide_nk"])) {
            print "Not Known <br>";
        }
        if (!empty($data["risk_homocide_io"])) {
            print "Ideation only <br>";
        }
        if (!empty($data["risk_homocide_plan"])) {
            print "Plan<br>";
        }
        if (!empty($data["risk_homocide_iwom"])) {
            print "Intent without means <br>";
        }
        if (!empty($data["risk_homocide_iwm"])) {
            print "Intent with means <br>";
        }
        echo "</span></td></tr>";
        echo "<tr><td style='padding: 15px'><b>Compliance with treatment: </b></td><td><span style='padding-left: 15px'> ";
        if (!empty($data["risk_compliance_na"])) {
            print "Not Assessed <br>";
        }
        if (!empty($data["risk_compliance_fc"])) {
            print "Full compliance <br>";
        }
        if (!empty($data["risk_compliance_mc"])) {
            print "Minimal compliance <br>";
        }
        if (!empty($data["risk_compliance_moc"])) {
            print "Moderate compliance <br>";
        }
        if (!empty($data["risk_compliance_var"])) {
            print "Variable <br>";
        }
        if (!empty($data["risk_compliance_no"])) {
            print "Variable <br>";
        }
        echo "</span></td></tr>";
        echo "<tr><td style='padding: 15px'><b>Substance Abuse: </b></td><td><span style='padding-left: 15px'> ";
        if (!empty($data["risk_substance_na"])) {
            print "Not Assessed <br>";
        }
        if (!empty($data["risk_substance_none"])) {
            print "None / normal use <br>";
        }
        if (!empty($data["risk_substance_ou"])) {
            print "Overuse <br>";
        }
        if (!empty($data["risk_substance_dp"])) {
            print "Dependence <br>";
        }
        if (!empty($data["risk_compliance_var"])) {
            print "Variable <br>";
        }
        if (!empty($data["risk_substance_ur"])) {
            print "Unstable remission of abuse <br>";
        }
        if (!empty($data["risk_substance_ab"])) {
            print "Abuse <br>";
        }
        echo "</span></td></tr>";
        echo "<tr><td style='padding: 15px'><b>Current physical or sexual abuse: </b></td><td><span style='padding-left: 15px'> ";
        if (!empty($data["risk_sexual_na"])) {
            print "Not Assessed <br>";
        }
        if (!empty($data["risk_sexual_y"])) {
            print "Yes <br>";
        }
        if (!empty($data["risk_sexual_n"])) {
            print "No <br>";
        }
        echo "</span></td></tr>";
        echo "<tr><td style='padding: 15px'><b>Legally reportable? </b></td><td><span style='padding-left: 15px'> ";
        if (!empty($data["risk_sexual_ry"])) {
            print "Yes <br>";
        }
        if (!empty($data["risk_sexual_rn"])) {
            print "No <br>";
        }
        echo "</span></td></tr>";
        echo "<tr><td style='padding: 15px'><b>If yes, client is </b></td><td><span style='padding-left: 15px'> ";
        if (!empty($data["risk_sexual_cv"])) {
            print "victim <br>";
        }
        if (!empty($data["risk_sexual_cp"])) {
            print "perpetrator <br>";
        }
        if (!empty($data["risk_sexual_b"])) {
            print "both <br>";
        }
        if (!empty($data["risk_sexual_nf"])) {
            print "neither, but abuse exists in family <br>";
        }
        echo "</span></td></tr>";
        echo "<tr><td style='padding: 15px'><b>Current child/elder abuse: </b></td><td><span style='padding-left: 15px'> ";
        if (!empty($data["risk_neglect_na"])) {
            print "Not Assessed <br>";
        }
        if (!empty($data["risk_neglect_y"])) {
            print "Yes <br>";
        }
        if (!empty($data["risk_neglect_n"])) {
            print "No <br>";
        }
        echo "</span></td></tr>";
        echo "<tr><td style='padding: 15px'><b>Legally reportable? </b></td><td><span style='padding-left: 15px'> ";
        if (!empty($data["risk_neglect_ry"])) {
            print "Yes <br>";
        }
        if (!empty($data["risk_neglect_rn"])) {
            print "No <br>";
        }
        echo "</span></td></tr>";
        echo "<tr><td style='padding: 15px'><b>If yes, client is </b></td><td><span style='padding-left: 15px'> ";
        if (!empty($data["risk_neglect_va"])) {
            print "Not Assessed <br>";
        }
        if (!empty($data["risk_neglect_cv"])) {
            print "victim <br>";
        }
        if (!empty($data["risk_neglect_cp"])) {
            print "perpetrator <br>";
        }
        if (!empty($data["risk_neglect_cb"])) {
            print "both <br>";
        }
        if (!empty($data["risk_neglect_cn"])) {
            print "neither, but abuse exists in family <br>";
        }
        echo "</span></td></tr>";
        echo "<tr><td style='padding: 15px'><b>If risk exists the client: </b></td><td><span style='padding-left: 15px'> ";
        if ('risk_exists_c') {
            print "can meaningfully agree to a contract not to harm<br>";
        }
        if ($data["risk_exists_cn"]) {
            print "cannot meaningfully agree to a contract not to harm<br>";
        }
        if ($data["risk_exists_s"]) {
            print "self<br>";
        }
        if ($data["risk_exists_o"]) {
            print "others<br>";
        }
        if ($data["risk_exists_b"]) {
            print "both";
        }
        echo "</span></td></tr>";
        echo "<tr style='background-color: lightgray'><td colspan='2' align='center'><b>TREATMENT RECOMMENDATIONS / INITIAL TREATMENT PLAN</b></td></tr>";
        echo "<tr><td style='padding: 15px'><b>Outpatient Psychotherapy: </b></td><td><span style='padding-left: 15px'> ";
        if ($data['recommendations_psy_i']) {
            print "Individual<br>";
        }
        if ($data['recommendations_psy_f']) {
            print "Family<br>";
        }
        if ($data['recommendations_psy_m']) {
            print "Marital/relationship<br>";
        }
        if ($data['recommendations_psy_g']) {
            print "Group<br>";
        }
        if ($data['recommendations_psy_o']) {
            print $data['recommendations_psy_o'];
        }
        echo "</span></td></tr>";
        echo "<tr><td style='padding: 15px'><b>Outpatient Psychotherapy: </b></td><td><span style='padding-left: 15px'> ";
        if ($data['rtc1']) {
            print "1 Week";
        }
        if ($data['rtc2']) {
            print "2 Week";
        }
        if ($data['rtc3']) {
            print "3 Weeks";
        }
        if ($data['rtc4']) {
            print "1 Month";
        }
        echo "</span></td></tr>";
        echo "<tr><td style='padding: 15px'><b>Inpatient / Hospitalization:</b></td><td><span style='padding-left: 15px'> ";
        if ($data['recommendations_psy_i']) {
            print "Inpatient";
        }
        if ($data['recommendations_psy_f']) {
            print "Residential Treatment";
        }
        echo "</span></td></tr>";
        echo "<tr><td style='padding: 15px'><b>Substance Abuse Treatment:</b></td><td><span style='padding-left: 15px'> ";
        if ($data['recommendations_psy_m']) {
            print "Inpatient";
        }
        if ($data['recommendations_psy_o']) {
            print "Residential Treatment";
        }
        echo "</span></td></tr>";
        echo "<tr><td style='padding: 15px'><b>Other External Referral</b></td><td><span style='padding-left: 15px'> ";
        if ($data['recommendations_psy_notes']) {
            print $data['recommendations_psy_notes'];
        }
        echo "</span></td></tr>";
        echo "<tr><td style='padding: 15px'><b>Date report sent to referral source:</b></td><td><span style='padding-left: 15px'> ";
        if ($data['refer_date']) {
            print $data['refer_date'];
        }
        echo "</span></td></tr>";
        echo "<tr><td style='padding: 15px'><b>Parent/Guardian:</b></td><td><span style='padding-left: 15px'> ";
        if ($data['parent']) {
            print $data['parent'];
        }
        echo "</span></td></tr>";
    }
    print "</tr></table>";
}
