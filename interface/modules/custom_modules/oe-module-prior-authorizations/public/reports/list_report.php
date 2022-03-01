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
                <caption><?php echo xlt("Patients with prior auths"); ?></caption>
                <th scope="col">MRN</th>
                <th scope="col">Name</th>
                <th scope="col">Auths</th>
                <?php
                    while ($iter = sqlFetchArray($patients)) {
                        print "<tr><td>" . $iter['MRN'] . "</td>";
                        print "<td>" . $iter['fname'] . " " . $iter['lname'] . "</td>";
                        print "<td>";
                        $sql = "SELECT DISTINCT `prior_auth_number` FROM `form_misc_billing_options` WHERE pid = ?";
                        $numbers = sqlStatement($sql, [$iter['MRN']]);
                        $num_array = [];
                        while ($row = sqlFetchArray($numbers)) {
                            $num_array[] = $row;
                        }
                        var_dump($num_array);
                        print "</td>";
                        print "</tr>";
                    }
                ?>
            </table>

        </div>
        &copy; <?php echo date('Y') . " Juggernaut Systems Express" ?>
    </div>

</body>
</html>
