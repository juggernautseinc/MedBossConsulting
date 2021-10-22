<?php

/**
 * assessment_intake save.php.
 *
 * @package   OpenEMR
 * @link      http://www.open-emr.org
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2018 Brady Miller <brady.g.miller@gmail.com>
 * @license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

require_once("../../globals.php");
require_once("$srcdir/api.inc");
require_once("$srcdir/sql.inc");
require_once("$srcdir/forms.inc");

use OpenEMR\Common\Csrf\CsrfUtils;

if (!empty($_POST)) {
    if (!CsrfUtils::verifyCsrfToken($_POST["csrf_token_form"])) {
        CsrfUtils::csrfNotVerified();
    }
}

if ($encounter == "") {
    $encounter = date("Ymd");
}

if ($_GET["mode"] == "new") {
    $newid = generate_id();
    array_shift($_POST);
    $data = json_encode($_POST);
    sqlStatement("INSERT INTO form_assessment_intake SET
                                       id = ?,
                                       personal_strengths = ?,
                                       authorized = 1,
                                       activity = 1,
                                       date = NOW()
    ", [$newid, $data]);

    addForm($encounter, "Assessment and Intake", $newid, "assessment_intake", $pid, $userauthorized);
} elseif ($_GET["mode"] == "update") {
    $id = $_POST['id'];
    array_shift($_POST);
    $data = json_encode($_POST);
    sqlStatement(
        "update form_assessment_intake set
                               personal_strengths = ?,
                                       authorized = 1,
                                       activity = 1,
                                       date = NOW() where
                                       id=?",
        array($data, $id)
    );
}
//die('What happen captn?');
formHeader("Redirecting....");
formJump();
formFooter();
