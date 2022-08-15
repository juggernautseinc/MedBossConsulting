<?php

/*
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
     $providerArray[] = $prow;
}
var_dump($providerArray);
