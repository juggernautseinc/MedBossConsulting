<?php

/*
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  All rights reserved
 */

namespace Juggernaut\App\Controllers;

use Juggernaut\App\Model\NotificationModel;
use Juggernaut\App\Exceptions\NumberNotFoundException;

class Texting extends SendMessage
{
    protected NotificationModel $data;

    public function __construct()
    {
        $this->data = new NotificationModel();
    }

    public static function bulk(): void
    {
        echo "<title>Texting Results</title>";
        $numbers = $_POST['pnumbers'];
        if (!str_contains($numbers, ",")) {
            die(xlt('Please use a comma separated list'));
        }
        $messagesbody = $_POST['message'];
        $individuals = explode(",", $numbers);
        foreach ($individuals as $individual) {
            if(empty($individual)) {
                continue; //The plan on using it for single messages to patients
            }
            $individual = str_replace("-", "", $individual);
            $response = self::outBoundMessage($individual, $messagesbody);
            $results = json_decode($response, true);

            echo self::messageResultsDisplay($results);
        }
    }

    /**
     * @throws NumberNotFoundException
     */
    public function sendTelehealthMessage()
    {
        require_once dirname(__FILE__, 8) . "/library/patient.inc";
        $balance = get_patient_balance_excluding($_SESSION['pid']);
        $number = $this->data->getPatientCell();
        if (!empty($number)) {
            $patientNumber = str_replace('-', '', $number);
            $outboundMessage = self::telehealthMessageBody() .
                $this->data->getTextFacilityInfo()['name'] . ' ' .
                self::meetingLink();
        if ($balance > 0) {
            $outboundMessage .= self::balanceMessage();
        }
            $response = self::outBoundMessage((int)$patientNumber, $outboundMessage);
            $results = json_decode($response, true);

            echo self::messageResultsDisplay($results) . ' <br>' . $patientNumber;
        } else {
            throw new NumberNotFoundException();
        }
    }

    public function individualPatient()
    {
        $patientNumber = self::getPatientCell();
        $message = $_POST['message'];
        $response = self::outBoundMessage((int)$patientNumber, $message);
        return json_decode($response, true);

    }

    private function telehealthMessageBody(): string
    {
        return "By clicking the link below, you are consenting to the telehealth service that is being provided. " .
            " Please call office at " . $this->data->getTextFacilityInfo()['phone'] . ". \n ";
    }

    private function balanceMessage(): string
    {
        return xlt(" There is a balance due on your account. Please log into the patient portal and remit payment");
    }

    private function meetingLink(): string
    {
        return "https://" .
            $_SERVER['SERVER_NAME'] .
            "/interface/jitsi/jitsi.php?room=" .
            $this->data->createMeetingId() . "&pid=" . $_SESSION['pid'];
    }

    private function messageResultsDisplay($results): string
    {
        if ($results['success'] === true) {
            return " Successful, message ID " . $results['textId'] .
                " <br>Remaining message " . $results['quotaRemaining'] . " <br>Alert support when this get to 20";
        } else {
            return " Message failed " . $results['error'];
        }
    }
}
