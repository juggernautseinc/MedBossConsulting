<?php

/**
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  license https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

require_once dirname(__DIR__) . "/interface/globals.php";


function isPatientHere($source, $database)
{
    $database = $database . ".";
    $pid = sqlQuery("SELECT pubpid FROM " . $database . "patient_data WHERE pid = ?", [$source]);
    return $pid['pubpid'];
}

function processUploaedImage($imageName, $image, $pid)
{

    require_once dirname(__DIR__) . "/controllers/C_Document.class.php";
    require_once dirname(__DIR__) . "/library/documents.php";
    $size = filesize($image);
    $type = "application/jpeg";
    $category_id = 742111;

    addNewDocument($imageName, $type, $image, 0, $size, $pid, $pid, $category_id);
    //move image to patient chart
}

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