<?php

/*
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  All rights reserved
 */

require_once dirname(__DIR__, 3) . '/globals.php';

use OpenEMR\Core\Header;
use Juggernaut\App\Controllers\SendMessage;

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
</head>
<body>
    <div class="container-fluid main_container mt-3">
        <div class="row">
            <div class="mx-auto" style="width: 80%">
                <div class="m-2">
                    <strong><?php echo $GLOBALS['SMS_NOTIFICATION_HOUR'] . " " . xlt(' Hours in advanced to send notification - in Globals') ?></strong>
                </div>

                <?php require_once dirname(__FILE__) . "/views/nav_top.php"; ?>
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
                        $testIsDomainValid = SendMessage::IsValidFQDN($domainNameRoot);
                    if ($testIsDomainValid > 0) {
                        echo xlt('You have to have a fully qualified domain name to use this module to receive inbound text') . "<br>";
                    }
                    ?>
                </div>

            </div>
        </div>



    </div>
</body>
</html>
