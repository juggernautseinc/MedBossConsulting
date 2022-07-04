<?php

/**
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  All Rights Reserved
 */

require_once dirname(__FILE__, 4) . "/globals.php";

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
$insurersId = 106;
$beginningDepositDate = date('Y') . '-01-01';
$endingDepositDate = date('Y') . '-01-31';

echo "January Income: ";
echo $january = insuranceIncome($beginningDepositDate, $endingDepositDate, $insurersId) . "<br>";

$beginningDepositDate = date('Y') . '-02-01';
$endingDepositDate = date('Y') . '-02-28';

echo "February Income: ";
echo $february = insuranceIncome($beginningDepositDate, $endingDepositDate, $insurersId) . "<br>";

$beginningDepositDate = date('Y') . '-03-01';
$endingDepositDate = date('Y') . '-03-31';

echo "March Income: ";
echo $march = insuranceIncome($beginningDepositDate, $endingDepositDate, $insurersId) . "<br>";

$beginningDepositDate = date('Y') . '-04-01';
$endingDepositDate = date('Y') . '-04-30';

echo "April Income: ";
echo $april = insuranceIncome($beginningDepositDate, $endingDepositDate, $insurersId) . "<br>";


$beginningDepositDate = date('Y') . '-05-01';
$endingDepositDate = date('Y') . '-05-31';

echo "May Income: ";
echo $may = insuranceIncome($beginningDepositDate, $endingDepositDate, $insurersId) . "<br>";

$beginningDepositDate = date('Y') . '-06-01';
$endingDepositDate = date('Y') . '-06-30';

echo "June Income: ";
echo $may = insuranceIncome($beginningDepositDate, $endingDepositDate, $insurersId) . "<br>";
