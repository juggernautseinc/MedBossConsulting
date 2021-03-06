<?php

/*
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  All Rights Reserved
 */

use OpenEMR\Core\Header;
use Juggernaut\OpenEMR\Modules\PriorAuthModule\Controller\AuthorizationService;

require_once dirname(__FILE__, 6) . "/globals.php";
require_once dirname(__FILE__, 3) . "/vendor/autoload.php";

$data = new AuthorizationService();
$patients = $data->listPatientAuths();

?>
<!doctype html>
<html lang="en">
<head>
    <?php Header::setupHeader(['common', 'opener']) ?>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo xlt("List Exising Prior Auths Report"); ?></title>
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
        <h1><?php echo xlt("Prior Auths") ?></h1>
        <div class="table">
            <table class="table table-striped">
                <caption><?php echo xlt("Patients with prior auths"); ?></caption>
                <th scope="col"><?php echo xlt("MRN"); ?></th>
                <th scope="col"><?php echo xlt("Name"); ?></th>
                <th scope="col"><?php echo xlt("Ins"); ?></th>
                <th scope="col"><?php echo xlt("Auths"); ?></th>
                <th scope="col"><?php echo xlt("Start"); ?></th>
                <th scope="col"><?php echo xlt("End"); ?></th>
                <th scope="col">#<?php echo xlt("of Units"); ?></th>
                <th scope="col"><?php echo xlt("Remaining"); ?></th>

                <?php
                $name = '';
                    while ($iter = sqlFetchArray($patients)) {
                       // $sql = "SELECT count(*) AS count FROM `form_misc_billing_options` WHERE pid = ? AND `prior_auth_number` = ?";
                        if (!empty($iter['pid'])) {
                            $pid = $iter['pid'];
                        } else {
                            $pid = $iter['mrn'];
                        }
                        //$numbers = sqlQuery($sql, [$pid, $iter['auth_num']]);
                        $numbers = AuthorizationService::countUsageOfAuthNumber($pid, $iter['auth_num']);
                        $insurance = AuthorizationService::insuranceName($pid);

                        if ($name !== $iter['fname'] . " " . $iter['lname'] ) {
                            print "<tr><td><a href='#' onclick='openNewTopWindow(" . $pid . ")'>" . $pid . "</a></td>";
                            print "<td><strong>" . $iter['lname'] . ", " . $iter['fname'] . "</strong></td>";
                            print "<td style='max-width:75px;'>" . $insurance['name'] . "</td>";
                        } else {
                            print "<td></td>";
                            print "<td></td>";
                            print "<td></td>";
                        }
                        print "<td>" . $iter['auth_num'] . "</td>";
                        print "<td>" . $iter['start_date'] . "</td>";
                        print "<td>" . $iter['end_date'] . "</td>";
                        if (($iter['end_date'] < date('Y-m-d')) && ($iter['end_date'] !== '0000-00-00')) {
                            print "<td style='color: red'><strong>" . xlt('Expired') . "</strong></td>";
                            print "<td></td>";
                        } else {
                            print "<td>" . $iter['init_units'] . "</td>";
                            print "<td>" . ($iter['init_units'] - $numbers['count']) . "</td>";
                        }


                        print "</tr>";
                        $name = $iter['fname'] . " " . $iter['lname'];
                    }
                ?>
            </table>
            <table>
                <tr></tr>
            </table>

        </div>
        &copy; <?php echo date('Y') . " Juggernaut Systems Express" ?>
    </div>

</body>
</html>
