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

require_once dirname(__DIR__) . "/interface/globals.php";
require_once "photo_inc.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use OpenEMR\Common\Crypto\CryptoGen;

$id = rand();
$eMsg =  xlt('Danger Wil Robinson') . "!";
$status = false;

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
    echo xlt("Image Upload Complete ");
    $subject = 'Testing image upload alert! ' . $_POST['token'];
    $body = 'Test complete ' . $path.$imageName;
    $attachment = $path.$imageName;
    $status = true;
} else {

    die($eMsg);
}
if ($status == true) {
    send_staff_email($subject, $body, $attachment);
}
//now email staff of new upload

//get the file from the tmp folder
$image = $path . $imageName;

//processUploaedImage($imageName, $image, $_POST['token']);
//unlink($image);

function send_staff_email($subject, $body, $attachment)
{
    $recipient = $GLOBALS['practice_return_email_path'];
    if (empty($recipient)) {
        return;
    }
    $cryptoGen = new CryptoGen();
    $mail = new PHPMailer();
    $mail->From = $recipient;
    $mail->FromName = 'In-House Portal Uploads';
    $mail->addAttachment($attachment);
    $mail->isSMTP();
    $mail->IsHTML(true);
    $mail->Host = $GLOBALS['SMTP_HOST'];
    $mail->SMTPAuth = true;
    $mail->Username = $GLOBALS['SMTP_USER'];
    $mail->Password = $cryptoGen->decryptStandard($GLOBALS['SMTP_PASS']);
    $mail->SMTPSecure = $GLOBALS['SMTP_SECURE'];
    $mail->Port = $GLOBALS['SMTP_PORT'];
    $mail->Body = $body;
    $mail->Subject = $subject;
    $mail->AddAddress($recipient);
    if (!$mail->Send()) {
        error_log("There has been a mail error sending to " . errorLogEscape($recipient .
                " " . $mail->ErrorInfo));
    }
}