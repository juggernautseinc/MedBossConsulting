<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/**
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  All rights reserved
 */

use Juggernaut\App\Controllers\Home;
use Juggernaut\App\Controllers\Invoice;

require_once dirname(__DIR__, 4) . '/globals.php';
require_once __DIR__ . '/../vendor/autoload.php';


$router = new Juggernaut\App\Router();

$router
    ->get('/interface/modules/custom_modules/text-messaging-app/public/index.php/home', [Home::class, 'index'])
    ->get('/interface/modules/custom_modules/text-messaging-app/public/index.php/invoices', [Invoice::class, 'index'])
    ->get('/interface/modules/custom_modules/text-messaging-app/public/index.php/invoices/create', [Invoice::class, 'create'])
    ->post('/interface/modules/custom_modules/text-messaging-app/public/index.php/invoices/create', [Invoice::class, 'store'])
    ->post('/interface/modules/custom_modules/text-messaging-app/public/index.php/texting/bulk', [Texting::class, 'bulk']);

echo $router->resolve($_SERVER['REQUEST_URI'], strtolower($_SERVER['REQUEST_METHOD']));
