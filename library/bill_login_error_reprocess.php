<?php

/**
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  license https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */


require_once dirname(__FILE__, 2) . '/interface/globals.php';

use OpenEMR\Billing\X12ClaimRepost;
use OpenEMR\Common\Crypto\CryptoGen;

function resetClaimStatus() :void
{
    $cryptgen = new CryptoGen();

    // Get user name and password
    $host = X12ClaimRepost::x12Url() ?? null;
    $user = X12ClaimRepost::x12Username() ?? null;
    $xPass = X12ClaimRepost::x12Password() ?? null;
    $pass = $cryptgen->decryptStandard($xPass['x12_sftp_pass']) ?? null;

    // Parse Host and Port

    $client = new X12ClaimRepost($host['path'], $user['x12_sftp_login'], $pass);

    if ($client == 'success') {
        echo 'Passed';
    } else {
        echo 'Failed to connect to SFTP host';
    }
    //X12ClaimRepost::updateStatus();
}



