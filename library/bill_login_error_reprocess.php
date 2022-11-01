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

function authenticationChecker() :void
{
    $raw_url = X12SFTPClient::x12Url();
    // Parse URL
    $parsed_url = parse_url($raw_url);

    if($parsed_url === false)
    {
        fwrite(STDERR, "Failed to parse SFTP To Go URL.\n");
        exit(1);
    }
}

    //X12RemoteTracker::sftpSendLoginErrorFiles();



echo "Sent! Refresh the claim tracker page. ";
