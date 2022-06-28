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
use OpenEMR\Events\Appointments\AppointmentSetEvent;

class TextAppointmentStatusChange
    {
        public function __construct()
        {
            $event = AppointmentsSubscriber::getSubscribedEvents();
            return $event;
        }

        public function scheduleChanged(AppointmentSetEvent $event)
        {
            $appointmentInfo = $event->givenAppointmentData();
            var_dump($appointmentInfo); die;
        }
    }
