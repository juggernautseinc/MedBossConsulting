<?php

/**
 * package   OpenEMR
 *  link      http//www.open-emr.org
 *  author    Sherwin Gaddis <sherwingaddis@gmail.com>
 *  copyright Copyright (c )2021. Sherwin Gaddis <sherwingaddis@gmail.com>
 *  license   https//github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 *
 */

namespace Juggernaut\App\Controllers;

class Database
{
    public static function insuranceCompanies()
    {
        $list = [];
        $sql = sqlStatement("SELECT DISTINCT ic.id, ic.name " .
            "FROM insurance_companies AS ic, insurance_data AS ind WHERE ic.id = ind.provider");
        while ($iter = sqlFetchArray($sql)) {
            $list[] = $iter;
        }
        return $list;
    }
}
