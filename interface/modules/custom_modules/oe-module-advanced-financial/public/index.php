<?php

/**
 *
 *  package   OpenEMR
 *  link      https://affordablecustomehr.como
 *  author    Sherwin Gaddis <sherwingaddis@gmail.com>
 *  copyright Copyright (c )2021. Sherwin Gaddis <sherwingaddis@gmail.com>
 *  All rights reserved
 *
 */

require_once dirname(__FILE__, 5) . "/globals.php";

use OpenEMR\Core\Header;

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo xlt("Documentation Reminders"); ?></title>
    <?php Header::setupHeader(['common'])?>
</head>
<body>
    <div class="container-lg">
        <div class = "">
		</div>
		<div class="">
		</div>
		&copy; <?php echo date('Y') . " Juggernaut Systems Express" ?>
    </div>
</body>
</html>