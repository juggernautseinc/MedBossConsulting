<?php

/**
 *
 *  package   OpenEMR
 *  link      https://affordablecustomehr.como
 *  author    Sherwin Gaddis <sherwingaddis@gmail.com>
 *  copyright Copyright (c )2021. Sherwin Gaddis <sherwingaddis@gmail.com>
 *  All rights reserved
 *
 */

require_once dirname(__FILE__, 5) . "/globals.php";
require_once dirname(__FILE__) . "/../vendor/autoload.php";

use Juggernaut\App\Controllers\MonthlyIncomeDataPoints;
use Juggernaut\App\Controllers\Database;

use OpenEMR\Core\Header;

$genDatapoints = new MonthlyIncomeDataPoints();
$data = new Database();
$insurersId = 106;
$firstInsuranceCompany = $data::firstInsuaranceCompany();
echo $firstInsuranceCompany['id'];
$dataPointsToDisplay = $genDatapoints->buildDataPoints($firstInsuranceCompany['id']);

$points = '"Month,Total Deposited\n"' . " +\r";
$points .= $dataPointsToDisplay;

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo xlt("Graphical Income Report"); ?></title>
    <?php Header::setupHeader(['common', 'dygraphs'])?>
    <link rel="stylesheet" src="/public/assets/modified/dygraphs-2-0-0/dygraph.css" />
</head>
<body>

    <div class="container-lg mt-5">
        <h2 class="m-4"><?php echo xlt('Insurance Monthly Income'); ?></h2>
        <form class="m-4 form">
                <?php
                        $companies = $data::insuranceCompanies();
                        echo $companies;
                ?>
        </form>
        <div id="graphdiv">
        </div>
        <div>
            <p><?php echo $firstInsuranceCompany['name']; ?></p>
        </div>
		<div class="mt-5">
            &copy; <?php echo date('Y') . " Juggernaut Systems Express" ?>
		</div>

    </div>
<script>
    g = new Dygraph(
        document.getElementById("graphdiv"),
        <?php echo substr($points, 0, -2); ?>
    );
</script>
<script src="js/report.js"></script>
</body>
</html>
