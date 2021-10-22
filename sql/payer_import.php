<?php

/*
 * @package OpenEMR
 * @link    http://www.open-emr.org
 * @author  Sherwin Gaddis <sherwingaddis@gmail.com>
 * @copyright Copyright (c) 2021 Sherwin Gaddis <sherwingaddis@gmail.com>
 * @license https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

echo "start<br><br>";
//$ignoreAuth = true;
// Set $sessionAllowWrite to true to prevent session concurrency issues during authorization related code
$sessionAllowWrite = true;
require_once("../interface/globals.php");
$i = 0;
if (($handle = fopen("PayerList2.csv", "r")) !== FALSE) {
    while (! feof($handle)) {

        $line = fgetcsv($handle);
         $sql = "update insurance_companies set eligibility_id = ?, cms_id = ? WHERE name = ?";
        sqlStatement($sql, [$line[0], $line[0], $line[1]]);
        /*
                $newid = sqlQuery("select max(id) as id from serenity.insurance_companies");
                $id = $newid['id'] + 2;
                $sql = "insert into serenity.insurance_companies set id = ?, name = ?, cms_id = ?";
                $name = trim($line[1]);
                $cms_id = trim($line[0]);
                sqlStatement($sql, [$id, $name, $line[0]]);

                $phoneId = sqlQuery("select max(id) as id from serenity.phone_numbers");
                $newphoneid = $phoneId['id'] + 1;
                $psql = "insert into serenity.phone_numbers set id = ?, foreign_id = ?";
                sqlStatement($psql, [$newphoneid, $id]);

                $addressesId = sqlQuery("select max(id) as id from serenity.addresses");
                $newaddressesid = $addressesId['id'] + 1;
                $asql = "insert into serenity.addresses set id = ?, foreign_id = ?";
                sqlStatement($asql, [$newaddressesid, $id]);
        */
        //print_r($line);

        echo " " . $i . "<br>";
        //if ($i == 5) {
           // break;
       // }
        ++$i;
    }


    fclose($handle);
}

echo "<br>end";