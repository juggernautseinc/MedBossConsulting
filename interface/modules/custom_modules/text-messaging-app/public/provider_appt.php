<?php

/*
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  license https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

require_once dirname(__DIR__, 4) . '/globals.php';
$providerArray = [];
$providers = sqlStatement("SELECT DISTINCT pc_aid FROM `openemr_postcalendar_events` WHERE pc_aid > 2");

while ($prow = sqlFetchArray($providers)) {
     $providerArray[] = $prow;
}

foreach ($providerArray as $pc_aid) {
    $apptDate = date('Y-m-d', strtotime(' +1 day'));
    $appts = sqlStatement("SELECT pc_title, pc_startTime FROM `openemr_postcalendar_events` " .
        " WHERE pc_aid = ? AND pc_eventDate = ?", [$pc_aid, $apptDate]);
    var_dump($pc_aid);
    /*$message = '';
    while ($arow = sqlFetchArray($appts)) {
         $message .= $arow['pc_title'] . ", " . $arow['pc_startTime'] . '\r\n';
    }*/

}
