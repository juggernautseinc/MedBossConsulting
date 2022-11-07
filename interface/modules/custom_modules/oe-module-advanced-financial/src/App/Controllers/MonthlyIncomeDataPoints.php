<?php

/**
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  All rights reserved
 */

namespace Juggernaut\App\Controllers;

class MonthlyIncomeDataPoints
{
    private function insuranceIncome($beginningDepositDate, $endingDepositDate, $insurersId): float
    {
        $paymentsforthemonth = "SELECT (ar_activity.pay_amount - ar_activity.adj_amount) AS net FROM `ar_activity` LEFT JOIN ar_session ON ar_session.session_id = ar_activity.session_id WHERE ar_session.payment_type = 'insurance' AND ar_activity.deleted IS NULL AND ar_session.payer_id = 106 ";

        $totalpayments = sqlStatement($paymentsforthemonth);

        $u = [];

        while ($iter = sqlFetchArray($totalpayments)) {
            //$u[] = $iter['net'];
            var_dump($iter['net']);
        }
var_dump($u);
        return array_sum($u);
    }

    public function buildDataPoints($insurersId): array
    {
        (int)$currentMonth = date('m');
        $dataPointsArray = [];
        $i = 1;
        while ($i <= $currentMonth) {
            $text = $this->monthText($i);
            $depositDateInfo = $this->depositDate($i);
            $monthIncome = $this->insuranceIncome($depositDateInfo[0], $depositDateInfo[1], $insurersId);
            if ($monthIncome > 0) {
                $dataPointsArray[] = ['label' => $text, 'y' => $monthIncome];
            }
            $i++;
        }
        return $dataPointsArray;
    }

    private function monthText($monthNumeral): string
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
            default:
                return 'Error processing month';
        }
    }

    private function depositDate($month) {
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
}
