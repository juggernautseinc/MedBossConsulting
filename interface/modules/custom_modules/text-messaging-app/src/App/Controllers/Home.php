<?php

/**
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  All Rights Reserved
 */

namespace Juggernaut\App\Controllers;

class Home
{
    public static function index(): string
    {
        return '<!doctype html><html><title>Home page</title><body><h1>Home</h1></body></html>';
    }
}
