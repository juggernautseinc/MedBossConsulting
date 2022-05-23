<?php

/**
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  All rights reserved
 */

require_once __DIR__ . '/../vendor/autoload.php';
require_once dirname(__DIR__, 4) . '/globals.php';

$router = new Juggernaut\App\Router();

$router->register(
    '/interface/modules/custom_modules/text-messaging-app/public',
    function () {
        echo 'Home';
    }
);

$router->register(
  '/interface/modules/custom_modules/text-messaging-app/public/index.php/invoices',
  function () {
      echo '<!doctype html><html><title>Invoices page</title><body><h1>Invoices</h1></body></html>';
  }
);


echo $router->resolve($_SERVER['REQUEST_URI']);
