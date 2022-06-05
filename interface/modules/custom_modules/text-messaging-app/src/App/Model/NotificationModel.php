<?php
/*
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  license https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

namespace Juggernaut\App\Model;

use OpenEMR\Common\Database\QueryUtils;

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
            $sql .= "WHERE `fromnumber` = '+1'" . $this->getPatientCell()['phone_cell'];
        }

        $data = sqlStatement($sql);
        var_dump($data, $this->getPatientCell()['phone_cell']); die;
    }

    private function getPatientCell()
    {
        $sql = "SELECT `phone_cell` FROM `patient_data` WHERE `pid` = ? ";
        return sqlQuery($sql, [$_SESSION['pid']]);
    }

}
