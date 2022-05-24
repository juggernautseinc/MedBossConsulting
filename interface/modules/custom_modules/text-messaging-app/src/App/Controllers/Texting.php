<?php
/*
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  license https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

namespace Juggernaut\App\Controllers;

class Texting
{
    public static function bulk(): void
    {
        echo $numbers = $_POST['pnumbers'];
        echo $messagesbody = $_POST['message'];

    }
}
