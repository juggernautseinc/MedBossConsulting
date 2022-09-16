<?php

/*
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  license https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

namespace Juggernaut;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class Notification
{
    private $pendingArray;

    /**
     * @throws \phpmailerException
     * @throws Exception
     */
    public function sendList($days)
    {
        $listPending = new NotificationModel($days);
        $this->pendingArray = $listPending->hasPendingAppts();
        if (is_array($this->pendingArray)) {
            $staffMessage = $this->buildMessage();
            return $this->emailStaff($staffMessage);
        }
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
     * @throws PHPMailer\PHPMailer\Exception
     */
    private function emailStaff($message): string
    {
        $emailSubject = xlt('Pending Appointment Status');
        $email_sender = $GLOBALS['patient_reminder_sender_email'];
        $mail = new PHPMailer();
        $mail->AddReplyTo($email_sender, $email_sender);
        $mail->SetFrom($email_sender, $email_sender);
        $mail->AddAddress('sherwin@affordablecustomehr.com', 'Med Boss Consulting');
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