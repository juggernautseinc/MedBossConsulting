<?php

/*
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  All Rights Reserved
 */

use OpenEMR\Core\Header;

require_once dirname(__FILE__, 6) . "/globals.php";

$sql = "SELECT DISTINCT pd.pid AS MRN, pd.fname, pd.lname FROM patient_data AS pd JOIN form_misc_billing_options mb ON mb.pid = pd.pid ";
$patients = sqlStatement($sql);

?>
<!doctype html>
<html lang="en">
<head>
    <?php Header::setupHeader(['common']) ?>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>List Exising Prior Auths Report</title>
</head>
<body>
    <div class="container-lg" style="padding-top: 6em">
        <h1>Prior Auths</h1>
        <div class="table">
            <table class="table table-striped">
                <?php
                    while ($iter = sqlFetchArray($patients)) {
                        var_dump($iter);
                    }
                ?>
            </table>

        </div>
        &copy; <?php echo date('Y') . " Juggernaut Systems Express" ?>
    </div>

</body>
</html>
