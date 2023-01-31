<?php

/*
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  license https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

namespace OpenEMR\Billing;

use OpenEMR\Common\Crypto\CryptoGen;
class X12ClaimRepostProcessor
{
    public static function connectionStatus() :string
    {
        $status = '';
        foreach (self::partners() as $partner) {
            $connect = self::determineConnectionStatus($partner);
            $status .= $connect;
        }
        return $status;
    }

    private static function determineConnectionStatus($partner): string
    {
        $cryptgen = new CryptoGen();
        // Get username and password
        $host = X12ConnectionStatus::x12Url() ?? null;
        $user = X12ConnectionStatus::x12Username() ?? null;
        $xPass = X12ConnectionStatus::x12Password() ?? null;
        $pass = $cryptgen->decryptStandard($xPass['x12_sftp_pass']) ?? null;
        if (empty($host)) {
            return '<button>' . xlt('Unable to find host information') . '</button>';
        }
        // Parse Host and Port
        $client = new X12ConnectionStatus($host['x12_sftp_host'], $user['x12_sftp_login'], $pass);
        $status = $client->getConnectionStatus() ;
        if ($status) {
            //reset the batches to waiting to be sent when connection comes back online.
            X12ConnectionStatus::updateStatus();
            return '<button class="btn-success">' . xlt('Connected to clearinghouse') . '</button>';
        }
        return '<button class="btn-danger">' . xlt('Clearinghouse connection failed') . '</button>';
    }

     public static function partners(): array
    {
        return X12ConnectionStatus::arrayOfX12Partners();
    }

    public function partnerConnection($partnerid): bool|array|null
    {
        return X12ConnectionStatus::getPartnerConnection($partnerid);
    }
}
