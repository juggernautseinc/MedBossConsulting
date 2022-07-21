<?php

/*
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  license https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

namespace Juggernaut\App;

class InsuranceNotifications
{

    protected array $statuses;
    /**
     * @param array $appointmentData
     */
    public function __construct(array $appointmentData)
    {
        $genLetter = new TemplateProcessor($appointmentData);
    }



}
