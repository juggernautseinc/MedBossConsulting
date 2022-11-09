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
        $companies = [];
        $sql = sqlStatement("SELECT DISTINCT ic.id, ic.name " .
            "FROM insurance_companies AS ic, insurance_data AS ind WHERE ic.id = ind.provider");
        while ($iter = sqlFetchArray($sql)) {
            $companies[] = $iter;
        }
        $select = "<select name='icompany' id='icompany' class='select2-search--dropdown'>";
        $select .= "<option></option>";
        foreach ($companies as $company) {
            $select .= "<option value='" . $company['id'] . "'>";
            $select .= $company['name'];
            $select .= "</option>";
        }
        $select .= "</select>";
        return $select;
    }

    public static function firstInsuaranceCompany()
    {
        return sqlQuery("select ic.id from insurance_companies AS ic, insurance_data AS ind WHERE ic.id = ind.provider");
    }
}
