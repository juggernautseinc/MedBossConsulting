<?php
/*
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  license https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

namespace Juggernaut\App\Controllers;

use Juggernaut\App\Controllers\AppointmentsSubscriber;

    class TextAppointmentStatusChange
    {
        public function __construct()
        {
            $event = AppointmentsSubscriber::getSubscribedEvents();
            var_dump($event); die;
            //file_put_contents("/var/www/html/errors/appointment_changes.txt", print_r($event, true, PHP_EOL));
        }
    }
