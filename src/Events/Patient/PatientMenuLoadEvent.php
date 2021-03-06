<?php

/**
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  license https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

namespace OpenEMR\Events\Patient;

use Symfony\Component\EventDispatcher\Event;

class PatientMenuLoadEvent extends Event
{
    const EVENT_PATIENT_MENU_LOAD = "dashboard.menu.render.button.onload";
}
