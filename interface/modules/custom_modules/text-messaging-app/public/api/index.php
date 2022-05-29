<?php

/*
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  All Rights Reserved
 */

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Origin, Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

use OpenEMR\Common\Crypto\CryptoGen;
$key = new CryptoGen();
if (!defined('CONST_INCLUDE_KEY')) {define('CONST_INCLUDE_KEY', $key->decryptStandard($GLOBALS['response_key']));}

require_once __DIR__ . '/../../vendor/autoload.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$uri = explode('/', $uri);

echo json_encode($uri);
