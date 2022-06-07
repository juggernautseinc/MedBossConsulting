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
    protected mixed $pid;

    public function __construct()
    {
        $this->pid = $_SESSION['pid'];
    }

    public function getPatientTextMessages(): array
    {
        $sql = "SELECT * FROM `text_message_module` ";
        if (!empty($this->pid)) {
            $sql .= "WHERE `fromnumber` = '+1" . $this->getPatientCell()['phone_cell'] . "' ORDER BY `id` DESC LIMIT 25";
        } else {
            $sql .= "ORDER BY `id` DESC LIMIT 25";
        }
        $source = sqlStatement($sql);
        $dataArray = [];
        while($row = sqlFetchArray($source)) {
            $dataArray[] = $row;
        }

        return $dataArray;
    }

    public function getPatientCell(): mixed
    {
        $sql = "SELECT `phone_cell` FROM `patient_data` WHERE `pid` = ? ";
        $number = sqlQuery($sql, [$_SESSION['pid']]);
        return $number['phone_cell'];
    }

    public function createMeetingId(): string
    {
        $newmeetingid = sqlQuery("select DOB from patient_data where pid = ?", [$_SESSION['pid']]);
        return md5($newmeetingid['DOB'] . $_SESSION['pid']);
    }

    public function getTextFacilityInfo(): bool|array|null
    {
        return sqlQuery("select `name`, `phone` from `facility` where `id` = 3");
    }

}
