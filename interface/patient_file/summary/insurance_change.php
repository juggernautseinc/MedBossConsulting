<?php

/*
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  license https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

require_once dirname(__DIR__, 2) . "/globals.php";

use OpenEMR\Services\InsuranceCompanyService;
use OpenEMR\Services\InsuranceService;

$patient_insurance = new InsuranceService();
$companies = new InsuranceCompanyService();

$primary = $patient_insurance->getOneByPid($_SESSION['pid'], 'primary');
$pri_name = $companies->getOneById($primary['provider']);

$secondary = $patient_insurance->getOneByPid($_SESSION['pid'], 'secondary');
$sec_name = $companies->getOneById($secondary['provider']);

$tertiary = $patient_insurance->getOneByPid($_SESSION['pid'], 'tertiary');
$tri_name = $companies->getOneById($tertiary['provider']);

echo "Stage One!";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form id="form" name="theinsuranceform" action="" method="post">
        <table class="table table-striped">
            <tr>
                <td><?php echo xlt('Primary'); ?></td>
                <td><?php echo xlt($pri_name['name']); ?></td>
                <td>
                    <select name="pritype" id="pritype">
                        <option></option>
                        <option value="secondary"><?php echo xlt('Secondary') ?></option>
                        <option value="tertiary"><?php echo xlt('Tertiary') ?></option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><?php echo xlt('Secondary'); ?></td>
                <td><?php echo xlt($sec_name['name']); ?></td>
                <td>
                    <select name="sectype" id="sectype">
                        <option></option>
                        <option value="primary"><?php echo xlt('Primary') ?></option>
                        <option value="tertiary"><?php echo xlt('Tertiary') ?></option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><?php echo xlt('Tertiary'); ?></td>
                <td><?php echo xlt($tri_name['name']); ?></td>
                <td>
                    <select name="tr1type" id="tr1type">
                        <option></option>
                        <option value="secondary"><?php echo xlt('Primary') ?></option>
                        <option value="tertiary"><?php echo xlt('Secondary') ?></option>
                    </select>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
