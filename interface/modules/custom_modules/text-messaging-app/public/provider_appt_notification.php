<?php

/**
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
     $providerArray[] = $prow['pc_aid'];
}

foreach ($providerArray as $key => $value) {
    $apptDate = date('Y-m-d', strtotime(' +1 day'));
    $appts = sqlStatement("SELECT pc_title, pc_startTime FROM `openemr_postcalendar_events` " .
        " WHERE pc_aid = ? AND pc_eventDate = ? ORDER BY pc_startTime ASC", [$value, $apptDate]);
    $facility = sqlQuery("SELECT facility FROM `users` WHERE id = ?", [$value]);

    $message = "Your $facility schedule for today: <br>";
    while ($arow = sqlFetchArray($appts)) {
         $message .= $arow['pc_title'] . ", " . $arow['pc_startTime'] . "<br>";
    }
    $number = sqlQuery("SELECT phonecell FROM `users` WHERE id = ?", [$value]);

    echo $message . "<br>";
    if (!empty($message)) {
        $cell = str_replace("-", "", $number['phonecell']);
        //SendMessage::outBoundMessage($cell, $message);
    }
}
