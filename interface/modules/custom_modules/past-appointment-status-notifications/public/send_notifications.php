<?php

/*
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  license https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

require_once dirname(__DIR__, 3) . "/../globals.php";

$twdaysago = new DateTime('2 days ago');

$sql = "SELECT `pc_eid`, `pc_pid`, `pc_aid`, `pc_title`, `pc_eventDate`, `pc_apptstatus` 
FROM `openemr_postcalendar_events` WHERE `pc_apptstatus` = '^' AND `pc_eventDate` = ?
AND `pc_pid` != ''";

//$list_ofAppointments = sqlStatement($sql, [$twdaysago->format('Y-m-d')]);
$list_ofAppointments = sqlStatement($sql, ['2022-09-08']);
$pendingAppointments = [];

while ($status = sqlFetchArray($list_ofAppointments))
{
    $pendingAppointments[] = $status;
}

file_put_contents('/var/www/html/errors/status.txt', print_r($pendingAppointments, true), FILE_APPEND);

