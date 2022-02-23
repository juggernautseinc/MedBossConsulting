<?php

/*
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  license https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

require_once dirname(__FILE__, 5) . "/globals.php";
require_once dirname(__FILE__, 2) . '/vendor/autoload.php';

use Juggernaut\OpenEMR\Modules\PriorAuthModule\Controller\AuthorizationService;
use Juggernaut\OpenEMR\Modules\PriorAuthModule\Controller\ListAuthorizations;
use OpenEMR\Core\Header;
use OpenEMR\Common\Csrf\CsrfUtils;

$pid = $_SESSION['pid'];

if (!empty($_POST['token'])) {

    if (!CsrfUtils::verifyCsrfToken($_POST["token"])) {
        CsrfUtils::csrfNotVerified();
    }

    $postData = new AuthorizationService();
    $postData->setPid($pid);
    $postData->setAuthNum($_POST['authorization']);
    $postData->setInitUnits($_POST['units']);
    echo $startDate = DateToYYYYMMDD($_POST['start_date']);
    $postData->setStartDate($startDate);
    $endDate = DateToYYYYMMDD($_POST['end_date']);
    $postData->setEndDate($endDate);
    $postData->setCpt($_POST['cpts']);
    $postData->storeAuthorizationInfo();
}

$listData = new ListAuthorizations();
$listData->setPid($pid);
$authList = $listData->getAllAuthorizations();
$listData->insertMissingAuthsFromForm(); //from form prior auth


const TABLE_TD = "</td><td>";
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo xlt('Prior Authorization Manager'); ?></title>
    <?php Header::setupHeader(['common', 'datetime-picker'])?>

    <script>
        $(function() {
            $('.datepicker').datetimepicker({
                <?php $datetimepicker_timepicker = false; ?>
                <?php $datetimepicker_showseconds = false; ?>
                <?php $datetimepicker_formatInput = true; ?>
                <?php require($GLOBALS['srcdir'] . '/js/xl/jquery-datetimepicker-2-5-4.js.php'); ?>
                <?php // can add any additional javascript settings to datetimepicker here; need to prepend first setting with a comma ?>
            });
        })
    </script>
</head>
<body>
    <div class="container">
        <div class="m-4">
                <span style="font-size: xx-large; padding-right: 20px"><?php echo xlt('Prior Authorization Manager'); ?></span>
                <a href="../../../../patient_file/summary/demographics.php" onclick="top.restoreSession()" title="Go Back">
                    <i id="advanced-tooltip" class="fa fa-undo fa-2x small" aria-hidden="true"></i></a>

        </div>
        <div class="m-4">
            <?php if (empty($pid)) {
                echo xlt("You must be in a patients Chart to enter this information");
                die;
            } ?>
            <div class="m-3">
                <h3><?php echo xlt('Enter new authorization'); ?></h3>
            </div>
            <form id="theform" method="post" action="index.php" onsubmit="top.restoreSession()">
                <input type="hidden" name="token" value="<?php echo attr(CsrfUtils::collectCsrfToken()); ?>">
                <input type="hidden" name="id" value="">
                <div class="form-row">
                    <div class="col">
                        <input class="form-control" id="authorization" name="authorization" value="" placeholder="<?php echo xlt('Authorization Number') ?>">
                    </div>
                    <div class="col">
                        <input class="form-control" name="units" value="" placeholder="<?php echo xlt('Units') ?>">
                    </div>
                    <div class="col">
                        <input class="form-control datepicker" name="start_date" value="" placeholder="<?php echo xlt('Start Date') ?>">
                    </div>
                    <div class="col">
                        <input class="form-control datepicker" name="end_date" value="" placeholder="<?php echo xlt('End Date') ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <input class="form-control" name="cpts" value="" placeholder="<?php echo xlt('CPTs') ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <input class="form-control btn btn-primary" type="submit" value="Save">
                    </div>
                </div>
            </form>
        </div>
        <div class="m-4">
            <table class="table table-striped">
                <caption><?php echo xlt('Display of authorization code'); ?></caption>
                <tr>
                    <th scope="col"><?php echo xlt('Authorization Number'); ?></th>
                    <th scope="col"><?php echo xlt('Allocated Units'); ?></th>
                    <th scope="col"><?php echo xlt('Remaining Units'); ?></th>
                    <th scope="col"><?php echo xlt('Start Date'); ?></th>
                    <th scope="col"><?php echo xlt('End Date'); ?></th>
                    <th scope="col"><?php echo xlt('CPTs'); ?></th>
                </tr>
                <?php
                    if (!empty($authList)) {
                        while ($iter = sqlFetchArray($authList)) {
                            $editData = json_encode($iter);
                            print "<tr><td>";
                            print $iter['auth_num'];
                            print TABLE_TD . $iter['init_units'];
                            print TABLE_TD . $iter['remaining_units'];
                            print TABLE_TD . $iter['start_date'];
                            if ($iter['end_date'] == '0000-00-00') {
                                print TABLE_TD;
                            } else {
                                print TABLE_TD . $iter['end_date'];
                            }
                            print TABLE_TD . $iter['cpt'];
                            print TABLE_TD . " <button class='btn btn-primary' onclick=getRowData(" . $iter['id'] . ")>" . xlt('Edit') . "</button>
                            <input type='hidden' id='" . $iter['id'] . "' value='" . $editData . "' ></td></tr>";
                        }
                    }
                ?>
            </table>
        </div>
    </div>
<script>

    function getRowData(jsonData) {
        let dataArray = document.getElementById(jsonData).value;
        const obj = JSON.parse(dataArray);
        document.getElementById('authorization').value = obj.auth_num;

    }
</script>
</body>
</html>
