<?php

/*
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  All rights reserved
 */

    require_once dirname(__DIR__, 3) . "/../globals.php";
    require_once dirname(__DIR__) . "/vendor/autoload.php";

use Juggernaut\App\Model\NotificationModel;
use Juggernaut\App\Controllers\SendMessage;
$process = new NotificationModel();
$sending = new SendMessage();

$personsToBeContacted = $process->getAppointments();

echo "<pre>";
var_dump($GLOBALS);

foreach ($personsToBeContacted as $person) {

}

function message() {
        return "You have an appointment on " . $date . " at ";
         }
