<?php

/*
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  All Rights reserved
 */

namespace Juggernaut\App\Model;


class NotificationModel
{

    public function getPatientTextMessages(): array
    {
        $sql = "SELECT `tmm`.`date`, `tmm`.`fromnumber`, `tmm`.`text`, CONCAT(pd.fname, ' ', pd.lname) AS name " .
        " FROM `text_message_module` tmm ";
        if (!empty($_SESSION['pid'])) {
            $sql .= " JOIN `patient_data` pd ON CONCAT('+1', REPLACE(`pd`.`phone_cell`, '-', '')) = `tmm`.`fromnumber`";
            $sql .= " WHERE `tmm`.`fromnumber` = '+1" . str_replace("-", "", $this->getPatientCell()['phone_cell'])
                 . "' ORDER BY `tmm`.`id` DESC LIMIT 25";
        } else {
            $sql .= " JOIN `patient_data` pd ON CONCAT('+1', REPLACE(`pd`.`phone_cell`, '-', '')) = `tmm`.`fromnumber`";
            $sql .= " ORDER BY `tmm`.`id` DESC LIMIT 25";
        }
        $source = sqlStatement($sql);
        $dataArray = [];
        while($row = sqlFetchArray($source)) {
            $dataArray[] = $row;
        }

        return $dataArray;
    }

    /**
     * @return array|false|null
     */
    public function getPatientCell()
    {
        $sql = "SELECT `phone_cell` FROM `patient_data` WHERE `pid` = ? ";
        return sqlQuery($sql, [$_SESSION['pid']]);
    }

    public function createMeetingId(): string
    {
        $newmeetingid = sqlQuery("select DOB from patient_data where pid = ?", [$_SESSION['pid']]);
        return md5($newmeetingid['DOB'] . $_SESSION['pid']);
    }

    public function getAppointments(): array
    {
        $nDays = self::numberOfDays();
        $date = date("Y-m-d",strtotime($nDays));
        $sql = "SELECT `pc_pid`, `pc_eid`, `pc_aid`, `pc_catid` FROM `openemr_postcalendar_events` WHERE `pc_eventDate` BETWEEN ? AND ?";
        $genListOfAppointment = sqlStatement($sql, [$date, $date]);
        $listOfAppointments = [];
        while($row = sqlFetchArray($genListOfAppointment)) {
            $listOfAppointments[] = $row;
        }
        return $listOfAppointments;
    }

    private function numberOfDays(): string
    {
        $days = round($GLOBALS['SMS_NOTIFICATION_HOUR']/24);
        //the idea is to be flexible up to 5 days

        switch ($days) {
            case 1:
                $numDays = '+1 days';
                break;

            case 2:
                $numDays = '+2 days';
                break;

            case 3:
                $numDays = '+3 days';
                break;

            default:
                $numDays = '+4 days';
        }
        return $numDays;
    }

}
