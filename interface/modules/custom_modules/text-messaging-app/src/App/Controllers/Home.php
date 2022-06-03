<?php

/**
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  All Rights Reserved
 */

namespace Juggernaut\App\Controllers;

use Juggernaut\App\View;

class Home
{
    /**
     * @throws \Juggernaut\App\Exceptions\ViewNotFoundException
     */
    public function index(): string
    {
        return View::make('index')->render();
    }
}
