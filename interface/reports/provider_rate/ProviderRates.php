<?php

/*
 *  package   OpenEMR
 *  link      http://www.open-emr.org
 *  author    Sherwin Gaddis <sherwingaddis@gmail.com>
 *  copyright Copyright (c )2021. Sherwin Gaddis <sherwingaddis@gmail.com>
 *  license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 *
 */


class ProviderRates
{
    public function __construct()
    {
        //do epic stuff here in the future
    }

    public function getProviders()
    {
        $sql = "SELECT id, fname, lname FROM users WHERE authorized = 1";
        $data = sqlStatement($sql);
        return $data;
    }

    public function retreiveRates($userid)
    {
        $sql = "SELECT percentage, flat FROM payroll_data WHERE userid = ?";
        return sqlQuery($sql, [$userid]);
    }

    public function savePayrollData($userid, $percentage, $flat)
    {
        $doeuserexist = sqlQuery("SELECT userid FROM payroll_data WHERE  userid = ?", [$userid]);
        if (!is_numeric($doeuserexist['userid'])) {
            $sql = "INSERT INTO payroll_data SET userid = ?, percentage = ?, flat = ?";
            sqlStatement($sql, [$userid, $percentage, $flat]);
            return "insert completed";
        } else {
               if (!empty($percentage)) {
                   $sql = "UPDATE payroll_data SET percentage = ? WHERE userid = ?";
                   sqlStatement($sql, [$percentage, $userid]);
                   return "percentage inserted";
               } else {
                   $sql = "UPDATE payroll_data SET flat = ? WHERE userid = ?";
                   sqlStatement($sql, [$flat, $userid]);
                   return "flat rate inserted -" . $flat;
               }
        }
        return 'Failed';
    }
}
