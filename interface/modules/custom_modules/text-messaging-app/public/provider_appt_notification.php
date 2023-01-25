<?php

/**
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  license https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */


require_once dirname(__DIR__, 4) . '/globals.php';
require_once dirname(__DIR__) . "/vendor/autoload.php";
require_once ($GLOBALS['srcdir'] . "/appointments.inc.php");

use Juggernaut\App\Controllers\SendMessage;

$providerArray = [];
/*$providers = sqlStatement(
    "SELECT DISTINCT `pc_aid` FROM `openemr_postcalendar_events` WHERE `pc_aid` > 2 ORDER BY `pc_aid` ASC"
);*/
$providers = sqlStatement("SELECT `id` FROM `users` WHERE `authorized` = 1 ");

while ($prow = sqlFetchArray($providers)) {
     $providerArray[] = $prow['id'];
}

foreach ($providerArray as $key => $value) {
    $apptDate = date('Y-m-d');
    echo $value . "<br>";
    $providerAppointments = fetchAppointments($apptDate, $apptDate, null, $value,);
    $listOfAppointments = '';
    foreach ($providerAppointments as $appointment) {
        $listOfAppointments .= $appointment['pc_title'] . " " . $appointment['pc_startTime'] . " " . $appointment['pc_aid'];
    }
    $message = "Your schedule for today: " . $listOfAppointments . " \r\n";

    $number = sqlQuery("SELECT phonecell FROM `users` WHERE id = ?", [$value]);

    echo $message . "<br>";
    if (!empty($number['phonecell'])) {
        $cell = str_replace("-", "", $number['phonecell']);
        //SendMessage::outBoundMessage($cell, $message);
    }
}

sqlStatement("update background_services set running = 0 where name = 'Provider_Reminders'");
