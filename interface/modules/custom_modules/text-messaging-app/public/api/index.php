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
header('Access-Control-Allow-Headers: Origin, Content-Type, Access-Control-Allow-Headers, Authorizations, X-Requested-With');

$ignoreAuth = true;
// Set $sessionAllowWrite to true to prevent session concurrency issues during authorization related code
$sessionAllowWrite = true;

require_once __DIR__ . "/../../../../../globals.php";
require_once __DIR__ . '/../../vendor/autoload.php';

use OpenEMR\Common\Crypto\CryptoGen;
use OpenEMR\Common\Logging\EventAuditLogger;
use Juggernaut\App\Controllers\apiResponse;

$key = new CryptoGen();
if (!defined('CONST_INCLUDE_KEY')) {define('CONST_INCLUDE_KEY', $key->decryptStandard($GLOBALS['response_key']));}

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$uri = explode('/', $uri);
file_put_contents("/var/www/html/errors/uriFile.txt", print_r($_POST, true));

if ($uri[7] === 'reply') {
    $res = apiResponse::getResponse('200');
    echo json_encode($res);
} else {
    $res = apiResponse::getResponse('400');
    echo json_encode($res);
}


EventAuditLogger::instance()->newEvent('text', '', '', 1, "Inbound Text received");

