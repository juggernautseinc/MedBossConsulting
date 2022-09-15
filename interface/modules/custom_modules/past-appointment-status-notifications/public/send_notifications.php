<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
/*
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  license https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

require_once dirname(__DIR__, 3) . "/../globals.php";
require_once dirname(__DIR__, 4) . '/../library/patient.inc';

use Juggernaut\Notification;

$checkApptStatus = new Notification();

die($checkApptStatus->sendList());

//$twdaysago = new DateTime('2 days ago');

$sql = "SELECT `pc_eid`, `pc_pid`, `pc_aid`, `pc_title`, `pc_eventDate`, `pc_apptstatus`, `pc_startTime` 
FROM `openemr_postcalendar_events` WHERE `pc_apptstatus` = '^' AND `pc_eventDate` = ?
AND `pc_pid` != ''";

$list_ofAppointments = sqlStatement($sql, [$twdaysago->format('Y-m-d')]);

$pendingAppointments = [];

while ($status = sqlFetchArray($list_ofAppointments))
{
    $pendingAppointments[] = $status;
}

$mail = new PHPMailer();

var_dump($mail); die;

$message = '';
foreach ($pendingAppointments as $appt) {
    $provider = getProviderName($appt['pc_aid']);
    $message .= "Patient " . $appt['pc_pid'] . ", " . $provider . ", " . $appt['pc_eventDate'] . ", " . $appt['pc_startTime'] . "\r\n";
}

if (empty($message)) {
    $message = "No appointments were left in pending status on the calendar ";
}

$emailSubject = xlt('Pending Appointment Status');
$email_sender = $GLOBALS['patient_reminder_sender_email'];
\PHPMailer\PHPMailer\PHPMailer::class;
$mail->AddReplyTo($email_sender, $email_sender);
$mail->SetFrom($email_sender, $email_sender);
$mail->AddAddress($email_sender, $email_sender);
$mail->Subject = $emailSubject;
$mail->MsgHTML($message);
$mail->IsHTML(false);
$mail->AltBody = $message;

if ($mail->Send()) {
    file_put_contents('/var/www/html/errors/appt_notification.txt', "Sent " . date('Y-m-d') . "\r\n", FILE_APPEND);
} else {
    $mail_status = $mail->ErrorInfo;
    error_log("EMAIL ERROR: " . errorLogEscape($mail_status), 0);
}