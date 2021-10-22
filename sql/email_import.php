<?php

/*
 * @package OpenEMR
 * @link    http://www.open-emr.org
 * @author  Sherwin Gaddis <sherwingaddis@gmail.com>
 * @copyright Copyright (c) 2021 Sherwin Gaddis <sherwingaddis@gmail.com>
 * @license https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

echo "start<br><br>";
$ignoreAuth = true;
// Set $sessionAllowWrite to true to prevent session concurrency issues during authorization related code
$sessionAllowWrite = true;
require_once("../interface/globals.php");
$i = 0;
if (($handle = fopen("emails.csv", "r")) !== FALSE) {
    while (! feof($handle)) {

        $line = fgetcsv($handle);

        //sqlStatement($sql, [$id, $name, $line[0]]);


        print_r($line);

        echo "<br>";
        if ($i == 5) {
            break;
        }
        ++$i;
    }


    fclose($handle);
}

echo "<br>end";