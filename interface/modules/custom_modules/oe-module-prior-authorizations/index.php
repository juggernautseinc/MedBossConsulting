<?php

/*
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  license https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

require_once dirname(__FILE__, 4) . "/globals.php";

use OpenEMR\Core\Header;

$pid = $_SESSION['pid']
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo xlt('Prior Authorization Manager'); ?></title>
    <?php Header::setupHeader(['common'])?>
</head>
<body>
    <div class="container">
        <div class="m-4">
            <h1><?php echo xlt('Prior Authorization Manager'); ?></h1>
        </div>
        <div class="m-4">
            <?php if (empty($pid)) {
                die("You must be in a patients Chart to enter this information");
            } ?>
            <form id="theform" method="post" action="index.php" onsubmit="top-restoreSession()">
                <div class="form-group">
                    <label for="authorization">
                        <?php echo xlt('Authorization Number') ?>
                    </label>
                    <input class="form-control" name="authorization" value="">
                    <label class="label">Initial Units</label>
                    <input class="form-control" name="units" value="">
                    <label class="label">CPTs</label>
                    <input class="form-control" name="cpts" value="">
                </div>
            </form>
        </div>

    </div>
</body>
</html>
