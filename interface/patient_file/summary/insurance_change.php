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
use OpenEMR\Services\SwitchPatientInsurance;
use OpenEMR\Core\Header;
use OpenEMR\Common\Csrf\CsrfUtils;

if (!empty($_POST)) {
    if (!CsrfUtils::verifyCsrfToken($_POST["csrf_token_form"])) {
        CsrfUtils::csrfNotVerified();
    }
}

$insurances = new SwitchPatientInsurance(
    new InsuranceCompanyService(),
    new InsuranceService()
);
$list = $insurances->listPatientInsurances();
echo "<pre>";
var_dump($list); die;

$primary = $patient_insurance->getOneByPid($_SESSION['pid'], 'primary');
$pri_name = $companies->getOneById($primary['provider']);

$secondary = $patient_insurance->getOneByPid($_SESSION['pid'], 'secondary');
$sec_name = $companies->getOneById($secondary['provider']);

$tertiary = $patient_insurance->getOneByPid($_SESSION['pid'], 'tertiary');
$tri_name = $companies->getOneById($tertiary['provider']);

echo "<h1>Stage One! Not working yet!!!</h1>";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo xlt('Change Order'); ?></title>
    <?php Header::setupHeader() ?>
</head>
<body>
    <form id="form" name="theinsuranceform" action="insurance_change.php" method="post">
        <input type="hidden" name="csrf_token_form" value="<?php echo attr(CsrfUtils::collectCsrfToken()); ?>">
        <table class="table table-striped">
            <tr>
                <td><strong><?php echo xlt('Primary'); ?></strong></td>
                <td><?php echo xlt($pri_name['name']); ?></strong></td>
                <td>
                    <select name="pritype" id="pritype" class="form-control ml-2">
                        <option></option>
                        <option value="secondary"><?php echo xlt('Secondary') ?></option>
                        <option value="tertiary"><?php echo xlt('Tertiary') ?></option>
                    </select>
                </td>
            </tr>
            <?php if ($sec_name['name']): ?>
            <tr>
                <td><strong><?php echo xlt('Secondary'); ?></strong></td>
                <td><?php echo xlt($sec_name['name']); ?></td>
                <td>
                    <select name="sectype" id="sectype" class="form-control ml-2">
                        <option></option>
                        <option value="primary"><?php echo xlt('Primary') ?></option>
                        <option value="tertiary"><?php echo xlt('Tertiary') ?></option>
                    </select>
                </td>
            </tr>
            <?php endif ?>
            <?php if ($tri_name['name']): ?>
            <tr>
                <td><strong><?php echo xlt('Tertiary'); ?></strong></td>
                <td><?php echo xlt($tri_name['name']); ?></td>
                <td>
                    <select name="tr1type" id="tr1type" class="form-control ml-2">
                        <option></option>
                        <option value="secondary"><?php echo xlt('Primary') ?></option>
                        <option value="tertiary"><?php echo xlt('Secondary') ?></option>
                    </select>
                </td>
            </tr>
            <?php endif ?>
        </table>
        <input type="submit" value="<?php echo xlt('Submit'); ?>" class="form-control">
    </form>
</body>
</html>
