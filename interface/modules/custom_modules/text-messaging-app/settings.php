<?php

/*
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  All rights reserved
 */

require_once dirname(__DIR__, 3) . '/globals.php';
require_once dirname(__FILE__) . "/vendor/autoload.php";

    use Juggernaut\App\Model\SettingModel;
    use OpenEMR\Core\Header,
    Juggernaut\App\Model\NotificationModel;

$data = new NotificationModel();

function IsValidFQDN($FQDN): bool
{
        return (!empty($FQDN) && preg_match('/(?=^.{1,254}$)(^(?:(?!\d|-)[a-z0-9\-]{1,63}(?<!-)\.)+(?:[a-z]{2,})$)/i', $FQDN) > 0);
}
$active = '<span class="sr-only">(current)</span>';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo xlt('Settings'); ?></title>
    <?php Header::setupHeader(['common']); ?>
    <script src="lib/js/nav.js"></script>
</head>
<body>
    <div class="container-fluid main_container mt-3">
        <div class="row">
            <div class="mx-auto" style="width: 80%">
                <div class="m-2">
                    <strong><?php echo $GLOBALS['SMS_NOTIFICATION_HOUR'] . " " . xlt(' Hours in advanced of appointment, send notification - This setting is in Globals') ?></strong><br>
                    <span style="color: red;">
                    <?php
                        $timezone = $data->getTimeZoneInfo();
                        if($timezone['gl_value'] == '') {
                            echo $GLOBALS['gbl_time_zone'] . xlt('The time zone needs to be set for messages to go out at the right time');
                        }
                    ?>
                    </span>
                </div>

                <?php require_once dirname(__FILE__) . "/views/nav_top.php"; ?>
                <p class="mt-2"><?php echo xlt('Select the status to send a message to patient '); ?></p>
                <div class="ml-5 mt-2">
                    <form name="theform" id="theform" action="settings.php" method="post">
                        <div class="row">
                        <?php
                            $apptstatuses = new SettingModel();
                            $statuses = $apptstatuses->getApptStatuses();
                            foreach($statuses as $status) {
                                print "<div class='form-check col-2'>";
                                print "<input class='form-control form-check-input' type='checkbox' name='" . $status['title'] . "' value='" . $status['option_id'] . "'>";
                                print "<label for='" . $status['title'] . "'>" . $status['title'] . "</label>";
                                print "<input type='text' class='form-control ml-2 col-8' name='message'>";
                                print "</div>";
                            }
                        ?>
                        </div>
                    </form>
                </div>
                <div>
                    <?php
                        $FQDN = $_SERVER['HTTP_HOST'];
                        $hasSubDomain = substr_count($FQDN, ".") . "<br>";
                        $domainNameRoot = '';
                        if ($hasSubDomain > 1) {
                            $cutLocation = strpos($FQDN, ".") + 1 . "<br>";
                            $domainNameRoot = substr($FQDN, $cutLocation);
                        } else {
                            $domainNameRoot = $_SERVER['HTTP_HOST'];
                        }

                    if (IsValidFQDN($domainNameRoot) != 1) {
                        echo "<span style='font-weight: bold; color: red'>" . xlt('You have to have a fully qualified domain name to use this module to receive inbound text') . "</span><br>";
                    }
                    ?>
                </div>

            </div>
        </div>



    </div>
</body>
</html>
