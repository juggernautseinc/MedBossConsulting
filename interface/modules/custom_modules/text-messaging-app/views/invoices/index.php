<?php
/*
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  license https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

$dir = '/interface/modules/custom_modules/text-messaging-app';

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo xlt('Invoices View') ?></title>
    <?php \OpenEMR\Core\Header::setupHeader(['common']); ?>
</head>
<body>
<div class="container m-5" >
    <div class="mt-5">
        <h1><?php echo xlt('Index view'); ?></h1>
        <form action="/interface/modules/custom_modules/text-messaging-app/public/index.php/invoices/create" method="post">
            <label for="amount">Amount</label>
            <input class="form-control" type="text" name="amount">
            <input class="form-control" type="submit" value="Submit">
        </form>
    </div>
    <div class="mt-5">
        <?php include_once __DIR__ . "/../nav.php"; ?>
    </div>
</div>
</body>
</html>
