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
    /**
     * @param array $response
     * @param string|null $db
     * @return void
     */
    public function saveText(array $response, ?string $db)
    {
        $statement = "INSERT INTO " . $db . ".text_message_module (`id`, `fromnumber`, `text`, `date`) VALUES (NULL, ?, ?, NOW())";

        $binding = [$response['fromNumber'], $response['text']];
        QueryUtils::sqlInsert($statement, $binding);
    }
}