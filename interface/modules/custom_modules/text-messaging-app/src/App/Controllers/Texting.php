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
        $numbers = $_POST['pnumbers'];
        if (!str_contains($numbers, ",")) {
            die('Please use a comma separated list');
        }
        $messagesbody = $_POST['message'];
        $individuals = explode(",", $numbers);
        foreach ($individuals as $individual) {
            $individual = str_replace("-", "", $individual);
            echo self::outBoundMessage($individual, $messagesbody);

        }

    }
}
