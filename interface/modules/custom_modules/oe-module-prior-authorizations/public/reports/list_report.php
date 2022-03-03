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

$sql = "SELECT pd.fname, pd.lname, mpa.pid, mpa.auth_num, mpa.start_date, mpa.end_date, mpa.cpt, mpa.init_units " .
    "FROM `module_prior_authorizations` mpa JOIN `patient_data` pd ON pd.pid = mpa.pid ORDER BY mpa.pid";
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
                <th scope="col">#of Units</th>
                <th scope="col">Remaining</th>

                <?php
                    while ($iter = sqlFetchArray($patients)) {

                        $sql = "SELECT count(*) AS count FROM `form_misc_billing_options` WHERE pid = ? AND `prior_auth_number` = ?";
                        $numbers = sqlQuery($sql, [$iter['pid'], $iter['auth_num']]);

                        print "<tr><td>" . $iter['pid'] . "</td>";
                        print "<td>" . $iter['fname'] . " " . $iter['lname'] . "</td>";
                        print "<td>" . $iter['auth_num'] . "</td>";
                        print "<td>" . $iter['init_units'] . "</td>";
                        print "<td>" . $numbers['count'] . "</td>";
                        print "</tr>";
                    }
                ?>
            </table>

        </div>
        &copy; <?php echo date('Y') . " Juggernaut Systems Express" ?>
    </div>

</body>
</html>
