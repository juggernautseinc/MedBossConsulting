<?php
/*
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  license https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

namespace Juggernaut\App\Controllers;

use Juggernaut\App\Exceptions\ViewNotFoundException;
use Juggernaut\App\View;

class Notification
{
    /**
     * @throws ViewNotFoundException
     */
    public function index(): string
    {
        $aView = new View('notification/index');
        return $aView->render();
    }
}
