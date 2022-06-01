<?php
/*
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  license https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

namespace Juggernaut\App\Controllers;

use OpenEMR\Common\Database\QueryUtils;

class StoreTexts
{
    public function saveText(array $response, string $db)
    {
        $statement = "INSERT `fromnumber`, `text`, `date` INTO " . $db . ".text_message_module VALUES (?, ?, NOW())";
        $binding = [$response['fromNumber'], $response['text']];
        QueryUtils::sqlInsert($statement, $binding);
    }
}
