<?php
/*
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  license https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

namespace Juggernaut;

class Notification
{
    private $pendingArray;

    public function sendList($days)
    {
        $listPending = new NotificationModel($days);
        $this->pendingArray = $listPending->hasPendingAppts();
        return $this->buildMessage();
    }

    private function buildMessage()
    {
        $message = '';
        var_dump($this->pendingArray);
        foreach ($this->pendingArray as $appt) {
            $provider = getProviderName($appt['pc_aid']);
            $message .= "Patient " . $appt['pc_pid'] . ", " . $provider . ", " . $appt['pc_eventDate'] . ", " . $appt['pc_startTime'] . "\r\n";
        }
        return $message;
    }
}