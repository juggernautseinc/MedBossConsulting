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
use OpenEMR\Core\Header;

$genDatapoints = new MonthlyIncomeDataPoints();
$insurersId = 106;
$dataPointsToDisplay = $genDatapoints->buildDataPoints($insurersId);

$points = '"Month,Total Deposited\n"' . " +\r";
$points .= $dataPointsToDisplay;
//echo "<pre>"; var_dump($points); echo "</pre>";
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo xlt("Graphical Income Report"); ?></title>
    <?php Header::setupHeader(['common'])?>
    <script src="//cdnjs.cloudflare.com/ajax/libs/dygraph/2.1.0/dygraph.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/dygraph/2.1.0/dygraph.min.css" />
    <script>
        g = new Dygraph(
            document.getElementById("graphdiv"),
            <?php echo $points ?>
        );
    </script>
</head>
<body>
    <div class="container-lg">
        <div class = "" id="graphdiv">
		</div>
		<div class="">
		</div>
		&copy; <?php echo date('Y') . " Juggernaut Systems Express" ?>
    </div>

</body>
</html>
