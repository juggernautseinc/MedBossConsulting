<?php

/*
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  All Rights Reserved
 */

require_once dirname(__DIR__, 3 ) . '/globals.php';

use OpenEMR\Core\Header;

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Texting with TextBelt Service</title>
    <?php Header::setupHeader(['common']) ?>
</head>
<body>
    <div class="container m-5">
        <h1><?php echo xlt('Texting Patients'); ?></h1>
        <a href="public/index.php/invoices?foo=bar" ><?php echo xlt('Invoices Page Go!'); ?></a>
        <a href="public/index.php/home" ><?php echo xlt('Home Page Go!'); ?></a>
        <input type="text" name="pnumbers" value="" class="form-control" >
        <textarea name="message" class="form-control"></textarea>
        <input class="btn btn-primary" type="submit" value="Send Message">
    </div>
</body>
</html>

