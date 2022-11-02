<?php

/*
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  license https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

namespace OpenEMR\Billing;


use Exception;

class X12ClaimRepost
{
    private $connection;

    /**
     * @throws Exception
     */
    public function __construct(
        $host,
        $username,
        $password,
    )
    {
        $this->connection = @ssh2_connect($host);
        if (! $this->connection) {
            throw new Exception("Failed to connection to host");
        }


    }

    public static function x12Url(): bool|array|null
    {
        return sqlQuery('SELECT x12_sftp_host FROM x12_partners WHERE id = 4');
    }

    public static function x12Username(): bool|array|null
    {
        return sqlQuery('SELECT x12_sftp_login FROM x12_partners WHERE id = 4');
    }
    public static function x12Password(): bool|array|null
    {
        return sqlQuery('SELECT x12_sftp_pass FROM x12_partners WHERE id = 4');
    }

    public static function updateStatus(): void
    {
        sqlQuery("UPDATE `x12_remote_tracker` SET status = 'waiting' WHERE `status` = 'login-error' ");
    }
}

