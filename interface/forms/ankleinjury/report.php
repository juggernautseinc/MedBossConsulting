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
    print "<table>";
    if (!empty($data)) {

        if (!empty($data["referral_source"])) {
            echo "<tr><td>Referral Source: </td><td>" . $data['referral_source'] . "</td></tr>";
        }

    }
    print "</table>";
}
