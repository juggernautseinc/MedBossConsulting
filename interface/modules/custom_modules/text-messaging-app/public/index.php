<?php

/**
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  All rights reserved
 */

use Juggernaut\Controllers\Home;
use Juggernaut\Controllers\Invoice;

require_once dirname(__DIR__, 4) . '/globals.php';
require_once __DIR__ . '/../vendor/autoload.php';


$router = new Juggernaut\App\Router();

$router
    ->register('/interface/modules/custom_modules/text-messaging-app/public/index.php/home', [Home::class, 'index'])
    ->register('/interface/modules/custom_modules/text-messaging-app/public/index.php/invoices', [Invoice::class, 'index'])
    ->register('/interface/modules/custom_modules/text-messaging-app/public/index.php/invoices/create', [Invoice::class, 'create']);

echo "<pre>";
var_dump($router);
//echo $router->resolve($_SERVER['REQUEST_URI']);
