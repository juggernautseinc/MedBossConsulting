<?php

/*
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  license https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

function appointmentLog($eid): array
{
    $log_entries = "SELECT date, original_user FROM patient_tracker WHERE eid = ?";
    $log_array = [];
    $fetch_log = sqlStatement($log_entries, [$eid]);
    while ($log = sqlFetchArray($fetch_log)) {
        $log_array[] = $log;
    }
    return $log_array;
}
