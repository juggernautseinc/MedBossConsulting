<?php

/*
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  license https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

use OpenEMR\Services\CalendarProviderDuration;

$twig = new CalendarProviderDuration();

$content = [
    'title' => 'Set Provider Appt Duration'
];

echo $twig->twigEnv()->render('provider_duration.twig.html', $content);

