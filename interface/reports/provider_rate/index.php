<?php

/*
 *  package   OpenEMR
 *  link      http://www.open-emr.org
 *  author    Sherwin Gaddis <sherwingaddis@gmail.com>
 *  copyright Copyright (c )2021. Sherwin Gaddis <sherwingaddis@gmail.com>
 *  license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 *
 */

require_once "../../globals.php";
require_once "ProviderRates.php";

use OpenEMR\Common\Acl\AclMain;
use OpenEMR\Common\Csrf\CsrfUtils;
use OpenEMR\Core\Header;

$providerdata = new ProviderRates();

if (!empty($_POST)) {

    $providerdata->savePayrollData($_POST['userid'], $percentage = $_POST['percentage'], $flat = $_POST['flat']);

}

$providers = $providerdata->getProviders();

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Provider Rate Manager</title>
    <?php Header::setupHeader(['common']); ?>
    <style>
        .htitle {
            padding: 3em;
        }
        .report {

        }
    </style>
</head>
<body>
<div class="container">
    <div class="htitle">
        <h2>Provider Rate Manager</h2>
    </div>
    <div class="report">
            <table class="table">
                <tr>
                    <th>Provider Name</th>
                    <th>Percentage Rate</th>
                    <th>Flat Rate</th>
                    <th>Update</th>
                </tr>
                <?php
                    while ($row = sqlFetchArray($providers)) {
                        $rate = $providerdata->retreiveRates($row['id']);
                        print "<tr>";
                        print "<td>" . $row['id'] . ' ' . $row['fname'] . " " . $row['lname'] . "<input type='hidden' name='userid' value='" .
                            $row['id'] . "'></td>";
                        print "<td><input type='text' id='percent_" . $row['id'] . "' value='"
                            . $rate['percentage'] .
                            "' name='percentage' onkeyup='toggleRate(" . $row['id'] . ")'></td>";
                        print "<td><input type='text' id='flat_" . $row['id'] . "' value='" . $rate['flat'] . "' name='flat'></td>";
                        print "<td><button onclick='saveLine(". $row['id'] .")' id='submit'>Update</button></td>";
                        print "</tr>";
                    }
                ?>
            </table>
    </div>
</div>
<script>
    function saveLine(id) {
        let percent = 'percent_' + id;
        let flat = 'flat_' + id;
        let flatValue = $("#"+flat).val();
        let percentValue = $("#"+percent).val();

        let url = '/interface/reports/provider_rate/postupdate.php?userid='+id+'&percent='+percentValue+'&flat='+flatValue;
        top.restoreSession();
        fetch(url
        ).then(res => {
            return res.text()
        })
        .then(data => console.log(data))
        .catch(error => console.log(error))
    }

    function togglePercentRate(row) {
        let rowid = 'flat_' + row;
        let rowvalue = document.getElementById(rowid).value;
        if (rowvalue.length() > 0) {
            document.getElementById(rowid).value = '';
        }
    }
</script>
</body>
</html>
