<?php

/*
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  All rights reserved
 */

use OpenEMR\Core\Header;

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
        <?php echo $GLOBALS['SMS_NOTIFICATION_HOUR'] . " " . xlt(' Hours in advanced to send notification - in Globals') ?> <br>

    </div>
</body>
</html>
