<?php

/*
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  All rights reserved
 */

namespace Juggernaut\App\Controllers;

class Texting extends SendMessage
{
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

    //one way message
    public function sendTelehealthMessage()
    {
        $patientNumber = self::getPatientCell();
        if (!empty($patientNumber)) {
            $patientNumber = str_replace('-', '', $patientNumber['phone_cell']);
            $outboundMessage = self::telehealthMessageBody() .
                self::getTextFacilityInfo()['name'] . ' ' .
                self::meetingLink();

            $response = self::outBoundMessage((int)$patientNumber, $outboundMessage);
            $results = json_decode($response, true);

            echo self::messageResultsDisplay($results) . ' <br>' . $patientNumber  . ' <br><br>' . self::replyForm() ;
        }
    }

    private function telehealthMessageBody()
    {
        return "By clicking the link below, you are consenting to the telehealth service that is being provided. " .
            " Please call office at " . self::getTextFacilityInfo()['phone'] . ". \n ";
    }

    private function meetingLink()
    {
        return "https://" .
            $_SERVER['SERVER_NAME'] .
            "/interface/jitsi/jitsi.php?room=" .
            self::createMeetingId() . "&pid=" . $_SESSION['pid'];
    }

    private function createMeetingId()
    {
        $newmeetingid = sqlQuery("select DOB from patient_data where pid = ?", [$_SESSION['pid']]);
        return md5($newmeetingid['DOB'] . $_SESSION['pid']);
    }

    private function getTextFacilityInfo()
    {
        return sqlQuery("select `name`, `phone` from `facility` where `id` = 3");
    }

    private function getPatientCell()
    {
        return sqlQuery("select phone_cell from patient_data where pid = ?", [$_SESSION['pid']]);
    }

    private function messageResultsDisplay($results)
    {
        if ($results['success'] === true) {
            return " Successful, message ID " . $results['textId'] .
                " <br>Remaining message " . $results['quotaRemaining'] . " <br>Alert support when this get to 20";
        } else {
            return " Message failed " . $results['error'];
        }
    }

    private function replyForm()
    {
        return "<form name='reply'><input class='form-control' type='text' onclick='sendText()' placeholder='not working yet!'></form><button class='btn btn-primary'>Send</button> ";
    }
}
