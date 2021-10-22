<?php

/*
 *  package   OpenEMR
 *  link      http://www.open-emr.org
 *  author    Sherwin Gaddis <sherwingaddis@gmail.com>
 *  copyright Copyright (c )2021. Sherwin Gaddis <sherwingaddis@gmail.com>
 *  license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 *
 */

require_once "globals.php";
echo $_SESSION['authUserID'] . " user ";
$user = $_SESSION['authUserID'];
$sql = "select notes from users where id = ?";
$site_id = sqlQuery($sql, [$user]);

echo "<br><br>" . $site_id['notes'];

