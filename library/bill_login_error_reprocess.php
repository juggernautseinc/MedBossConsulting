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

use OpenEMR\Billing\X12ClaimRepost;
use OpenEMR\Common\Crypto\CryptoGen;

function resetClaimStatus() :void
{
    $cryptgen = new CryptoGen();

    $raw_url = X12ClaimRepost::x12Url();
    // Parse URL
    $parsed_url = parse_url($raw_url['x12_sftp_host']);

    if ($parsed_url === false)
    {
        exit("Failed to parse SFTP To Go URL.\n");
    }

    // Get user name and password
    $user = X12ClaimRepost::x12Username() ?? null;
    $xPass = X12ClaimRepost::x12Password() ?? null;
    $pass = $cryptgen->decryptStandard($xPass['x12_sftp_pass']);

    // Parse Host and Port
    $host = $parsed_url ?? null;

    $client = new X12ClaimRepost($host['path'], $user['x12_sftp_login'], $pass);

    echo $client;
    //X12ClaimRepost::updateStatus();
}

resetClaimStatus();


