<?php

/**
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  license https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once dirname(__FILE__, 2) . '/interface/globals.php';

use OpenEMR\Billing\BillingProcessor\X12RemoteTracker;
use OpenEMR\Billing\X12SFTPClient;
use OpenEMR\Common\Crypto\CryptoGen;

function authenticationChecker() :void
{
    $cryptgen = new CryptoGen();

    $raw_url = X12SFTPClient::x12Url();
    // Parse URL
    $parsed_url = parse_url($raw_url['x12_sftp_host']);

    if ($parsed_url === false)
    {
        exit("Failed to parse SFTP To Go URL.\n");
    }

    // Get user name and password
    $user = X12SFTPClient::x12Username() ?? null;
    $xPass = X12SFTPClient::x12Password() ?? null;
    $pass = $cryptgen->decryptStandard($xPass['x12_sftp_pass']);

    // Parse Host and Port
    $host = $parsed_url ?? null;
    $port = 22;
var_dump($host);
var_dump($pass);
var_dump($user); die;
    $client = new X12SFTPClient($host, $user['x12_sftp_login'], $pass);
    var_dump($client);

}

    //X12RemoteTracker::sftpSendLoginErrorFiles();
authenticationChecker();


echo "Sent! Refresh the claim tracker page. ";

