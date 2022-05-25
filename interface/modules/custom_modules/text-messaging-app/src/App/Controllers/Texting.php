<?php

/*
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  All rights reserved
 */

namespace Juggernaut\App\Controllers;

class Texting extends SendMessage
{
    public static function bulk(): void
    {
        echo "<title>Texting Results</title>";
        $numbers = $_POST['pnumbers'];
        if (!str_contains($numbers, ",")) {
            die('Please use a comma separated list');
        }
        $messagesbody = $_POST['message'];
        $individuals = explode(",", $numbers);
        foreach ($individuals as $individual) {
            if(empty($individual)) {
                continue;
            }
            $individual = str_replace("-", "", $individual);
            $response = self::outBoundMessage($individual, $messagesbody);
            $results = json_decode($response, true);

            if ($results['success'] === true) {
                echo "Successful, message ID " . $results['textId'] . " patients number " . $individual . "<br><br>";
            } else {
                echo "Unsuccessful, message ID " . $results['textId'] . " patients number " . $individual;
            }
        }

    }
}
