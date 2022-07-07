<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/**
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  All Rights Reserved
 */

require_once dirname(__FILE__, 4) . "/globals.php";

$insurersId = 106;
$beginningDepositDate = date('Y') . '-01-01';
$endingDepositDate = date('Y') . '-01-31';

function insuranceIncome($beginningDepositDate, $endingDepositDate, $insurersId): float
{
    $paymentsforthemonth = "SELECT (ar_activity.pay_amount - ar_activity.adj_amount) AS net FROM `ar_activity`
    LEFT JOIN ar_session ON ar_session.session_id = ar_activity.session_id
    WHERE ar_session.payment_type = 'insurance'  AND ar_session.deposit_date BETWEEN ? AND ? AND ar_session.payer_id = ?
    AND ar_session.deposit_date IS NOT NULL AND ar_activity.deleted IS NULL";

    $totalpayments = sqlStatement($paymentsforthemonth, [$beginningDepositDate, $endingDepositDate, $insurersId]);

    $u = [];

    while ($iter = sqlFetchArray($totalpayments)) {
       $u[] = $iter['net'];
    }

    return array_sum($u);
}

function buildDataPoints($insurersId): array
{

    $currentMonth = date('m');
    $jsonArray = [];
    $i = 0;
    while ($i < $currentMonth) {
        $text = monthText($currentMonth);
        $depositDateInfo = depositDate($currentMonth);
        $jsonArray[] = "label => " . $text . ", y => " . insuranceIncome($depositDateInfo[0], $depositDateInfo[1], $insurersId);

    }
   return $jsonArray;
}

function monthText($monthNumeral) {
    return match ($monthNumeral) {
        1 => xlt("January"),
        2 => xlt("February"),
        3 => xlt("March"),
        4 => xlt("April"),
        5 => xlt("May"),
        6 => xlt("June"),
        7 => xlt("July"),
        8 => xlt("August"),
        default => xlt('Error processing month'),
    };
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

        default:
            return xlt('Error finding deposit date array');
    }
}


echo "January";
echo $january = insuranceIncome($beginningDepositDate, $endingDepositDate, $insurersId) . "<br>";

$beginningDepositDate = date('Y') . '-02-01';
$endingDepositDate = date('Y') . '-02-28';

echo "February";
echo $february = insuranceIncome($beginningDepositDate, $endingDepositDate, $insurersId) . "<br>";

$beginningDepositDate = date('Y') . '-03-01';
$endingDepositDate = date('Y') . '-03-31';

echo "March";
echo $march = insuranceIncome($beginningDepositDate, $endingDepositDate, $insurersId) . "<br>";

$beginningDepositDate = date('Y') . '-04-01';
$endingDepositDate = date('Y') . '-04-30';

echo "April";
echo $april = insuranceIncome($beginningDepositDate, $endingDepositDate, $insurersId) . "<br>";


$beginningDepositDate = date('Y') . '-05-01';
$endingDepositDate = date('Y') . '-05-31';

echo "May";
echo $may = insuranceIncome($beginningDepositDate, $endingDepositDate, $insurersId) . "<br>";

$beginningDepositDate = date('Y') . '-06-01';
$endingDepositDate = date('Y') . '-06-30';

echo "June";
echo $may = insuranceIncome($beginningDepositDate, $endingDepositDate, $insurersId) . "<br><br><br>";


$dataPoints = buildDataPoints($insurersId);

var_dump($dataPoints);
