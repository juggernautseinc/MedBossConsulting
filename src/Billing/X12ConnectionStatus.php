<?php

/*
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  license https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

namespace OpenEMR\Billing;

use phpseclib\Net\SFTP;

class X12ConnectionStatus
{
    private bool $status;

    public function __construct(
        $host,
        $username,
        $password,
        $port = 22
    )
    {
        $connection = new SFTP($host, $port);
        $this->status = $connection->login($username, $password);
     }
    public function getConnectionStatus()
    {
        return $this->status;
    }
    public static function x12Url()
    {
        return sqlQuery('SELECT x12_sftp_host FROM x12_partners');
    }

    public static function x12Username()
    {
        return sqlQuery('SELECT x12_sftp_login FROM x12_partners');
    }
    public static function x12Password()
    {
        return sqlQuery('SELECT x12_sftp_pass FROM x12_partners');
    }

    public static function updateStatus(): void
    {
        sqlQuery("UPDATE `x12_remote_tracker` SET 
                                status = 'waiting',
                                messages = NULL
                            WHERE `status` = 'login-error'");
    }

    public static function arrayOfX12Partners(): array
    {
        $x12_ids = [];
        $partners = sqlStatement("SELECT id FROM `x12_partners`");
        while ($partner = sqlFetchArray($partners)) {
            $x12_ids[] = $partners;
        }
        return $x12_ids;
    }

    public static function getPartnerConnection($partnerId)
    {
        return sqlQuery('SELECT `x12_sftp_host`, `x12_sftp_login`,`x12_sftp_pass` FROM `x12_partners` WHERE id = ?', [$partnerId]);
    }
}

