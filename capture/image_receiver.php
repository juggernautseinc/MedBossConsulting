<?php

/**
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  license https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

$ignoreAuth = true;
// Set $sessionAllowWrite to true to prevent session concurrency issues during authorization related code
$sessionAllowWrite = true;
require_once dirname(__FILE__) . "/../interface/globals.php";


$id = rand();
try {
    file_put_contents("/var/www/html/errors/image-$id.txt", print_r($_POST, true));
} catch (Exception $e) {
    echo "Error " . $e->getMessage();
}

echo "Image Upload Complete";



