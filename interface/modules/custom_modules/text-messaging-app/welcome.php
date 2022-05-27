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
    <?php Header::setupHeader() ?>
</head>
<body>
    <div class="container m-5">
        <h1><?php echo xlt('Bulk Texting'); ?></h1>
        <a href="public/index.php/invoices?foo=bar" ><?php echo xlt('Invoices Page Go!'); ?></a>
        <a href="public/index.php/home" ><?php echo xlt('Home Page Go!'); ?></a>
        <a href="public/index.php/invoices/create" ><?php echo xlt('Create Invoices Page Go!'); ?>
        <form method="post" action="public/index.php/texting/bulk" name="textcrude" >
            <input type="text" name="pnumbers" value="" class="form-control m-2" placeholder="place commas between numbers">
            <textarea name="message" class="form-control m-2" placeholder="Enter mass message here"></textarea>
            <input class="btn btn-primary mt-3" type="submit" value="Send Message">
        </form>
    </div>
</body>
</html>

