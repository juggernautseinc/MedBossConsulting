<?php

/*
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  All rights reserved
 */

use OpenEMR\Core\Header;
use Juggernaut\App\Controllers\SendMessage;

require_once dirname(__DIR__, 3) . '/globals.php';

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
            <div class="mx-auto">
                <div class="m-2">
                    <strong><?php echo $GLOBALS['SMS_NOTIFICATION_HOUR'] . " " . xlt(' Hours in advanced to send notification - in Globals') ?></strong>
                </div>

                <?php require_once dirname(__FILE__) . "/views/nav_top.php"; ?>
                <div>
                    <?php
                       var_dump($_SERVER['HTTP_HOST']);
                        $FQDN = $_SERVER['HTTP_HOST'];
                        echo substr_count($FQDN, ".") . "<br>";
                        echo strpos($FQDN)  . "<br>";

                    var_dump(SendMessage::IsValidFQDN($FQDN));
                    ?>
                </div>

            </div>
        </div>



    </div>
</body>
</html>
