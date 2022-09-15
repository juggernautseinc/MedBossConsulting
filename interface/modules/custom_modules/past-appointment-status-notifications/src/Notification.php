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
    public function sendList($days)
    {
        $listPending = new NotificationModel($days);
       return $listPending->hasPendingAppts();
    }
}