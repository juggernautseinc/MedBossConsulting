<?php

/*
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  license https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

require_once dirname(__FILE__, 4) . "/globals.php";

use Juggernaut\OpenEMR\Modules\PriorAuthModule\Controller\AuthorizationService;
use OpenEMR\Core\Header;
use OpenEMR\Common\Csrf\CsrfUtils;

$pid = $_SESSION['pid'];

if (!empty($_POST['token'])) {

    if (!CsrfUtils::verifyCsrfToken($_POST["csrf_token_form"])) {
        CsrfUtils::csrfNotVerified();
    }
    $auth_num = filter_input('POST', 'authorization', FILTER_SANITIZE_SPECIAL_CHARS);
    $start_date = filter_input('POST', 'start_date', FILTER_SANITIZE_SPECIAL_CHARS);
    $end_date = filter_input('POST', 'end_date', FILTER_SANITIZE_SPECIAL_CHARS);
    $cpts = filter_input('POST', 'cpts', FILTER_SANITIZE_SPECIAL_CHARS);
    $units = filter_input('POST', 'units', FILTER_SANITIZE_SPECIAL_CHARS);

    $postData = new AuthorizationService();
    $postData->setPid($pid);
    $postData->setAuthNum($auth_num);
    $postData->setStartDate($start_date);
    $postData->setEndDate($end_date);
    $postData->setCpt($cpts);
    $postData->storeAuthorizationInfo();
}

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
                <a href="../../../patient_file/summary/demographics.php" onclick="top.restoreSession()" title="Go Back">
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
            <form id="theform" method="post" action="index.php" >
                <input type="hidden" name="token" value="<?php echo attr(CsrfUtils::collectCsrfToken()); ?>">
                <div class="form-row">
                    <div class="col">
                        <input class="form-control" name="authorization" value="" placeholder="<?php echo xlt('Authorization Number') ?>">
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
            </table>
        </div>

    </div>
</body>
</html>
