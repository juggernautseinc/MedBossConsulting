<?php

/**
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  All rights reserved
 */

require_once __DIR__ . '/../vendor/autoload.php';

$router = new Juggernaut\App\Router();

$router->register(
    '/',
    function () {
        echo 'Home';
    }
);

$router->register(
  '/invoices',
  function () {
      echo 'Invoices';
  }
);

echo $router->resolve($_SERVER['REQUEST_URI']);
