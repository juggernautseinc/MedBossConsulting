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
    protected $pid;

    public function __construct()
    {
        $this->pid = $_SESSION['pid'];
    }

    public function getPatientTextMessages()
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

    private function getPatientCell()
    {
        $sql = "SELECT `phone_cell` FROM `patient_data` WHERE `pid` = ? ";
        return sqlQuery($sql, [$_SESSION['pid']]);
    }

}
