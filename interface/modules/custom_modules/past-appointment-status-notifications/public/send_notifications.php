<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/*
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  license https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

require_once dirname(__DIR__, 3) . "/../globals.php";
require_once dirname(__DIR__, 4) . '/../library/patient.inc';
require_once __DIR__ . "/../vendor/autoload.php";

use Juggernaut\Notification;

function start_appt_notification()
{
    $checkApptStatus = new Notification();

    $twodaysago = new DateTime('2 days ago');

    try {
        $checkApptStatus->sendList($twodaysago->format('Y-m-d'));
    } catch (phpmailerException $e) {
        file_put_contents('/var/www/html/errors/appt_notification_error.txt', $e->getMessage(), FILE_APPEND);
    }
}

start_appt_notification();