<?php
echo $GLOBALS['webroot']; die;
/**
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  license https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

$ignoreAuth = true;
// Set $sessionAllowWrite to true to prevent session concurrency issues during authorization related code

require_once dirname(__FILE__) . "/../interface/globals.php";
require_once "photo_inc.php";

$id = rand();
$check_source = isPatientHere($_POST['token'], $database);
if (!empty($_POST['imageFile']) && !empty($check_source['pid'])) {
    try {
        $image = str_replace('data:image/jpeg;base64,', '', $_POST['imageFile']);
        $path = $GLOBALS['webroot'] . "/sites/" . $_POST['dbase'] . "/document/temp";
        file_put_contents($path . "/image-$id.jpg", base64_decode($image));
    } catch (Exception $e) {
        echo "Error " . $e->getMessage();
        die;
    }
    echo xlt("Image Upload Complete");
} else {
    echo xlt('Danger Wil Robinson') . "!";
}

die;
//get the file from the tmp folder
$image = $path . "/image-$id.jpg";
processUploaedImage($image, $_POST['token']);

