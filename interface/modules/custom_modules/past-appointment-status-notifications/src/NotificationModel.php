<?php
/*
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  license https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

namespace Juggernaut;


class NotificationModel
{
    private $pastDays;

    public function __construct($days)
    {
        $this->pastDays = $days;

    }

    public function hasPendingAppts()
    {
        $hasPendingAppts = $this->buildAppointmentList();
        if (!empty($hasPendingAppts)) {
            return $hasPendingAppts;
        } else {
            return xlt('No pending appointments found for ' . $this->pastDays);
        }
    }

    private function retrievePendingStatusAppts()
    {
        $sql = "SELECT `pc_eid`, `pc_pid`, `pc_aid`, `pc_title`, `pc_eventDate`, " .
            " `pc_apptstatus`, `pc_startTime` " .
            " FROM `openemr_postcalendar_events` WHERE `pc_apptstatus` = '^' AND " .
            " `pc_eventDate` = ? AND `pc_pid` != ''";

        return sqlStatement($sql, [$this->pastDays]);
    }

    protected function buildAppointmentList()
    {
        $list_ofAppointments = $this->retrievePendingStatusAppts();
        $pendingAppointments = [];

        while ($status = sqlFetchArray($list_ofAppointments))
        {
            $pendingAppointments[] = $status;
        }
        return $pendingAppointments;
    }
}