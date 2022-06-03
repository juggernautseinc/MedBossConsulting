<?php

/**
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  All Rights Reserved
 */

namespace Juggernaut\App\Controllers;

use Juggernaut\App\Exceptions\ViewNotFoundException;
use Juggernaut\App\View;

class Home
{
    /**
     * @throws ViewNotFoundException
     */
    public function index(): string
    {
        $aView = new View('index');
        return $aView->render();
    }
}
