<?php

/*
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  license https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

require_once dirname(__DIR__, 2) . "/globals.php";

use OpenEMR\Common\Csrf\CsrfUtils;

if (!empty($_POST)) {
    if (!CsrfUtils::verifyCsrfToken($_POST["csrf_token"])) {
        CsrfUtils::csrfNotVerified();
    }
$mark = "INSERT INTO `patient_status` (`statusid`, `status`, `pid`, `userId`, `date`) VALUES ('', 'inactive', ?, ?, '')";
    sqlStatement($mark, [$_POST['patientid'], $_SESSION['authUser']]);
echo 'Patient ID ' . $_POST['patientid']  . ' has been marked inactive';
}
