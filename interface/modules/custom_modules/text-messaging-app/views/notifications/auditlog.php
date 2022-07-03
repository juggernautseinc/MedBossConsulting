<?php

/**
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  license https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
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
    <title><?php echo xlt('Audit Log'); ?></title>
    <?php Header::setupHeader(['common']) ?>
</head>
<body>
<div class="container container-main m-5">
    <div class="mt-3">
        <h1><?php echo xlt('Audit Log'); ?></h1>
    </div>
    <div class="mt-3">
        <table class="table table-striped">
            <pre>
            <?php
                foreach ($this->params as $param) {
                    var_dump($param);
                }
            ?>
                </pre>
        </table>
    </div>
</div>
</body>
</html>
