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

require_once dirname(__FILE__) . "/../interface/globals.php";
require_once "photo_inc.php";

use PHPMailer\PHPMailer;

$id = rand();
$eMsg =  xlt('Danger Wil Robinson') . "!";

if ($_POST['token']) {
    $check_source = isPatientHere($_POST['token'], $_POST['dbase']);
} else {
    die($eMsg);
}

if (!empty($_POST['imageFile']) && !empty($check_source)) {
    try {
        $image = str_replace('data:image/jpeg;base64,', '', $_POST['imageFile']);
        $path = dirname(__DIR__) . "/sites/" . $_POST['dbase'] . "/documents/temp/";
        $imageName = "image-$id.jpg";
        file_put_contents($path . "image-$id.jpg", base64_decode($image));
    } catch (Exception $e) {
        echo "Error " . $e->getMessage();
        die;
    }
    echo xlt("Image Upload Complete");
    $subject = 'Testing image upload alert!';
    $body = 'Test complete';
    //now email staff of new upload
    send_staff_email($subject, $body);

} else {

    die($eMsg);
}

//get the file from the tmp folder
$image = $path . $imageName;

//processUploaedImage($imageName, $image, $_POST['token']);
//unlink($image);

function send_staff_email($subject, $body)
{
    $recipient = $GLOBALS['practice_return_email_path'];
    if (empty($recipient)) {
        return;
    }

    $mail = new PHPMailer();
    $mail->From = $recipient;
    $mail->FromName = 'In-House Pharmacy';
    $mail->isMail();
    $mail->Host = "localhost";
    $mail->Mailer = "mail";
    $mail->Body = $body;
    $mail->Subject = $subject;
    $mail->AddAddress($recipient);
    if (!$mail->Send()) {
        error_log("There has been a mail error sending to " . errorLogEscape($recipient .
                " " . $mail->ErrorInfo));
    }
}