<?php

/**
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  license https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

require_once dirname(__FILE__, 4) . "/globals.php";

$paymentsforthemonth = "SELECT ar_activity.pay_amount, ar_activity.adj_amount FROM `ar_activity`
LEFT JOIN ar_session ON ar_session.session_id = ar_activity.session_id
WHERE ar_session.payment_type = 'insurance'  AND ar_session.deposit_date BETWEEN '2022-05-01' AND '2022-05-31' AND ar_session.payer_id = 106
AND ar_session.deposit_date IS NOT NULL AND ar_activity.deleted IS NULL";

$totalpayments = sqlStatement($paymentsforthemonth);

$u = [];
$r = [];
while ($iter = sqlFetchArray($totalpayments)) {
   $u[] = $iter['pay_amount'];
   $r[] = $iter['adj_amount'];
}
$display_adjustments_total = array_sum($r);
$display_total_payments = array_sum($u);
echo $display_total_payments . "<br>";
echo $display_adjustments_total;
