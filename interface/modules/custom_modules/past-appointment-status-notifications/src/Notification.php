<?php

/*
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  license https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

namespace Juggernaut;

use PHPMailer;

class Notification
{
    private $pendingArray;

    public function sendList($days)
    {
        $listPending = new NotificationModel($days);
        $this->pendingArray = $listPending->hasPendingAppts();
        $staffMessage = $this->buildMessage();
        $this->emailStaff($staffMessage);
        return ;
    }

    private function buildMessage()
    {
        $message = '';

        foreach ($this->pendingArray as $appt) {
            $provider = getProviderName($appt['pc_aid']);
            $message .= "Patient " . $appt['pc_pid'] . ", " . $provider . ", " . $appt['pc_eventDate'] . ", " . $appt['pc_startTime'] . "\r\n";
        }
        return $message;
    }

    /**
     * @throws \phpmailerException
     */
    private function emailStaff($message)
    {
        $emailSubject = xlt('Pending Appointment Status');
        $email_sender = $GLOBALS['patient_reminder_sender_email'];
        $mail = new PHPMailer\PHPMailer\PHPMailer();
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
        return "SENT";
    }
}