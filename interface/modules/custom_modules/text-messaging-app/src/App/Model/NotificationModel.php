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

    public function getPatientTextMessages(): array
    {
        $sql = "SELECT * FROM `text_message_module` ";
        if (!empty($this->pid)) {
            $sql .= "WHERE `fromnumber` = '+1'" . $this->getPatientCell()['phone_cell'];
        }
        var_dump($sql); die;
        return QueryUtils::fetchRecords($sql);
    }

    private function getPatientCell(): array
    {
        $sql = "SELECT `phone_cell` FROM `patient_data` WHERE `pid` = ? ";
        return QueryUtils::fetchRecords($sql, [$this->pid]);
    }

}
