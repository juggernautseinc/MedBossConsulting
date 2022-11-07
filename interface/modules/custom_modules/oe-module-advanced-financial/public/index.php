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

//$genDatapoints = new MonthlyIncomeDataPoints();
$insurersId = 106;
//$dataPointsToDisplay = $genDatapoints->buildDataPoints($insurersId);

    function insuranceIncome($beginningDepositDate, $endingDepositDate, $insurersId)
    {
        $paymentsforthemonth = "SELECT (ar_activity.pay_amount - ar_activity.adj_amount) AS net FROM `ar_activity` " .
            "LEFT JOIN ar_session ON ar_session.session_id = ar_activity.session_id " .
            "WHERE ar_session.payment_type = 'insurance'  AND ar_session.deposit_date BETWEEN ? AND ? " .
            " AND ar_session.payer_id = ? AND ar_session.deposit_date IS NOT NULL AND ar_activity.deleted IS NULL";

        $fetchpayments = sqlStatement($paymentsforthemonth, [$beginningDepositDate, $endingDepositDate, $insurersId]);
        $u = [];

        while ($iter = sqlFetchArray($fetchpayments)) {
            $u[] = $iter['net'];
        }
var_dump($u);
        return array_sum($u);
    }

    function buildDataPoints($insurersId): array
    {
        (int)$currentMonth = date('m');
        $dataPointsArray = [];
        $i = 1;
        while ($i <= $currentMonth) {
            $text = monthText($i);
            $depositDateInfo = depositDate($i);
            $monthIncome = insuranceIncome($depositDateInfo[0], $depositDateInfo[1], $insurersId);
            if ($monthIncome > 0) {
                $dataPointsArray[] = ['label' => $text, 'y' => $monthIncome];
            }
            $i++;
        }
        return $dataPointsArray;
    }

    function monthText($monthNumeral): string
    {
        switch ($monthNumeral) {
            case 1:
                return "January";
            case 2:
                return "February";
            case 3:
                return "March";
            case 4:
                return "April";
            case 5:
                return "May";
            case 6:
                return "June";
            case 7:
                return "July";
            case 8:
                return "August";
            case 9:
                return "September";
            case 10:
                return "October";
            case 11:
                return "November";
            case 12:
                return "December";
            default:
                return 'Error processing month';
        }
    }

    function depositDate($month) {
        $depositArray = [];
        switch ($month) {
            case 1:
                $depositArray[] = date('Y') . '-01-01';
                $depositArray[] = date('Y') . '-01-31';
                return $depositArray;

            case 2:
                $depositArray[] = date('Y') . '-02-01';
                $depositArray[] = date('Y') . '-02-28';
                return $depositArray;

            case 3:
                $depositArray[] = date('Y') . '-03-01';
                $depositArray[] = date('Y') . '-03-31';
                return $depositArray;

            case 4:
                $depositArray[] = date('Y') . '-04-01';
                $depositArray[] = date('Y') . '-04-30';
                return $depositArray;

            case 5:
                $depositArray[] = date('Y') . '-05-01';
                $depositArray[] = date('Y') . '-05-31';
                return $depositArray;

            case 6:
                $depositArray[] = date('Y') . '-06-01';
                $depositArray[] = date('Y') . '-06-30';
                return $depositArray;

            case 7:
                $depositArray[] = date('Y') . '-07-01';
                $depositArray[] = date('Y') . '-07-31';
                return $depositArray;

            case 8:
                $depositArray[] = date('Y') . '-08-01';
                $depositArray[] = date('Y') . '-08-31';
                return $depositArray;

            case 9:
                $depositArray[] = date('Y') . '-09-01';
                $depositArray[] = date('Y') . '-09-30';
                return $depositArray;

            case 10:
                $depositArray[] = date('Y') . '-10-01';
                $depositArray[] = date('Y') . '-10-31';
                return $depositArray;

            case 11:
                $depositArray[] = date('Y') . '-11-01';
                $depositArray[] = date('Y') . '-11-30';
                return $depositArray;

            case 12:
                $depositArray[] = date('Y') . '-12-01';
                $depositArray[] = date('Y') . '-12-31';
                return $depositArray;
            default:
                return xlt('Error finding deposit date array');
        }
    }
    $data = buildDataPoints($insurersId);
    var_dump($data);
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
</head>
<body>
    <div class="container-lg">
        <div class = "" id="graphdiv">
		</div>
		<div class="">
		</div>
		&copy; <?php echo date('Y') . " Juggernaut Systems Express" ?>
    </div>
<script>
    g = new Dygraph(
        document.getElementById("graphdiv"),

    );
</script>
</body>
</html>
