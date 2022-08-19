<?php

/**
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  license https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

function isPatientHere($source, $database)
{
    return sqlQuery("SELECT pid FROM $database.patient_data WHERE pid = ?", [$source]);
}

function whichFacility($d) {
    return match ($d) {
        1 => "serenity",
        2 => "reencuentro",
        default => "default",
    };
}

