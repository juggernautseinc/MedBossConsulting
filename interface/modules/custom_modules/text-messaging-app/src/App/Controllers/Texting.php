<?php

/*
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  All rights reserved
 */

namespace Juggernaut\App\Controllers;

class Texting
{
    public static function bulk(): void
    {
        $numbers = $_POST['pnumbers'];
        $messagesbody = $_POST['message'];

        foreach ($numbers as $number) {
            echo $number;
        }

    }
}
