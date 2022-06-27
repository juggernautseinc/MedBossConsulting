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

$process = new NotificationModel();

$peopleToBeContacted = $process->getAppointments();

echo "<pre>";
var_dump($peopleToBeContacted);
