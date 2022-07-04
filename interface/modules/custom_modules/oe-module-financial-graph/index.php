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

$beginningDepositDate = '2022-05-01';
$endingDepositDate = '2022-05-31';
$insurersId = 106;

echo insuranceIncome($beginningDepositDate, $endingDepositDate, $insurersId);
