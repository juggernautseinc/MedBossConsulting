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
    <?php Header::setupHeader(['common', 'opener']) ?>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>List Exising Prior Auths Report</title>
    <script>
        // opens the demographic and encounter screens in a new window
        function openNewTopWindow(newpid) {
            top.restoreSession();
            top.RTop.location = "<?php echo $GLOBALS['webroot']; ?>/interface/patient_file/summary/demographics.php?set_pid=" + encodeURIComponent(newpid);
        }
    </script>
</head>
<body>
    <div class="container-lg" style="padding-top: 6em">
        <h1>Prior Auths</h1>
        <div class="table">
            <table class="table table-striped">
                <caption><?php echo xlt("Patients with prior auths"); ?></caption>
                <th scope="col">MRN</th>
                <th scope="col">Name</th>
                <th scope="col"> Ins</th>
                <th scope="col">Auths</th>
                <th scope="col">#of Units</th>
                <th scope="col">Remaining</th>

                <?php
                $name = '';
                    while ($iter = sqlFetchArray($patients)) {
                        $sql = "SELECT count(*) AS count FROM `form_misc_billing_options` WHERE pid = ? AND `prior_auth_number` = ?";
                        $numbers = sqlQuery($sql, [$iter['pid'], $iter['auth_num']]);

                        $icname = "SELECT ic.name  FROM `insurance_data` id " .
                            "JOIN insurance_companies ic ON id.provider = ic.id " .
                            "WHERE `pid` = ? AND type = 'primary'";
                        $insurance = sqlQuery($icname, [$iter['pid']]);

                        if ($name !== $iter['fname'] . " " . $iter['lname'] ) {
                            print "<tr><td><a href='#' onclick='openNewTopWindow(" . $iter['pid'] . ")'>" . $iter['pid'] . "</a></td>";
                            print "<td><strong>" . $iter['fname'] . " " . $iter['lname'] . "</strong></td>";
                            print "<td style='max-width:75px;'>" . $insurance['name'] . "</td>";
                        } else {
                            print "<td></td>";
                            print "<td></td>";
                            print "<td></td>";
                        }
                        print "<td>" . $iter['auth_num'] . "</td>";
                        print "<td>" . $iter['init_units'] . "</td>";
                        print "<td>" . ($iter['init_units'] - $numbers['count']) . "</td>";
                        print "</tr>";
                        $name = $iter['fname'] . " " . $iter['lname'];
                    }
                ?>
            </table>

        </div>
        &copy; <?php echo date('Y') . " Juggernaut Systems Express" ?>
    </div>

</body>
</html>
