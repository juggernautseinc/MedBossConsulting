<?php
/**
 * TeleHealth Visit save.php
 *
 * @package   OpenEMR
 * @link      http://www.open-emr.org
 * @author    Ray Magauran <magauran@medexbank.com>
 * @copyright Copyright (c) 2020 Ray Magauran <magauran@medexbank.com>
 * @license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */


require_once("../../globals.php");
require_once("$srcdir/api.inc");
require_once("$srcdir/forms.inc");
require_once("$srcdir/MedEx/API.php");

use OpenEMR\Common\Csrf\CsrfUtils;

$MedEx = new MedExApi\MedEx('MedExBank.com');

if (!CsrfUtils::verifyCsrfToken($_POST["csrf_token_form"])) {
    CsrfUtils::csrfNotVerified();
}

if (!$encounter) { // comes from globals.php
    die(xlt("Internal error: we do not seem to be in an encounter!"));
}
$id = 0 + (isset($_GET['id']) ? $_GET['id'] : '');

if ($_POST['r'] > '') {
    //go ask MedEx for an update.
    //return json_encoded array with dashBoard carrying the update from MedEx
    if (($GLOBALS['medex_enable'] == '1')) {
        $logged_in          = $MedEx->login('1');
        //ask MedEx to update my dashBoard
        $data['pid']        = $_POST['pid'];
        $data['providerID'] = $_SESSION['authUserID'];
        $data['appt']       = sqlQuery("select * from openemr_postcalendar_events where pc_eid=?", array($_POST['eid']));
        $data['token']      = $logged_in['token'];
        $TM = $MedEx->display->TM_bot($logged_in, $data);
        echo json_encode($TM);
        exit;
    }
    
}
$sets = "date = CURDATE(),
    pid = ?,
    encounter = ? ,
    form_id = ?,
    user = ?,
    groupname = ?,
    authorized = ?,
    activity = 1,
    tm_duration = ?,
    tm_subj = ?,
    tm_obj = ?,
    tm_imp = ?,
    tm_plan = ?,
    provider_id = ?";

if (empty($id)) {
    
    $newid = sqlInsert(
        "INSERT INTO form_telemed SET $sets",
        [
            $_SESSION["pid"],
            $encounter,
            $id,
            $userauthorized,
            $_SESSION["authGroup"],
            $_SESSION["authUserID"],
            $_POST["tm_duration"],
            $_POST["tm_subj"],
            $_POST["tm_obj"],
            $_POST["tm_imp"],
            $_POST["tm_plan"],
            $_SESSION["authUserID"]
        ]
    );
    addForm($encounter, "telemed", $newid, "telemed", $pid, $userauthorized);
} else {
    $sets = "date = CURDATE(),
    pid = ?,
    user = ?,
    groupname = ?,
    authorized = ?,
    activity = 1,
    tm_duration = ?,
    tm_subj = ?,
    tm_obj = ?,
    tm_imp = ?,
    tm_plan = ?,
    provider_id = ?";
    sqlStatement(
        "UPDATE form_telemed SET $sets WHERE id = ?",
        [
            $_SESSION["pid"],
            $userauthorized,
            $_SESSION["authGroup"],
            $_SESSION["authUserID"],
            $_POST["tm_duration"],
            $_POST["tm_subj"],
            $_POST["tm_obj"],
            $_POST["tm_imp"],
            $_POST["tm_plan"],
            $_SESSION["authUserID"],
            $id
        ]
    );
}

$_SESSION["encounter"] = $encounter;
formHeader("Redirecting....");
formJump($GLOBALS['webroot'].'/interface/patient_file/encounter/load_form.php?formname=telemed');
formFooter();