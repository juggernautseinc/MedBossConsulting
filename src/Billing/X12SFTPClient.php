<?php

/*
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  license https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

namespace OpenEMR\Billing;

class X12SFTPClient
{
    private $connection;
    private $sftp;

    public function __construct($host, $port = 22)
    {
        $this->connection = ssh2_connect($host, $port);
        if (! $this->connection)
            throw new Exception("Failed to connect to ${host} on port ${port}.");
    }

    // Login with user and password
    public function auth_password($username, $password)
    {
        if (! ssh2_auth_password(
            $this->connection,
            $username,
            $password
            )
        )
            throw new Exception("Failed to authenticate with username $username " .
                "and password.");

        $this->sftp = ssh2_sftp($this->connection);
        if (! $this->sftp)
            throw new Exception("Could not initialize SFTP subsystem.");
    }

    // Disconnect session
    public function disconnect()
    {
        @ssh2_disconnect($this->connection);
    }

    public static function x12Url()
    {
        return sqlQuery('SELECT x12_sftp_host FROM x12_partners WHERE id = 4');
    }

    public static function x12Username()
    {
        return sqlQuery('SELECT x12_sftp_login FROM x12_partners WHERE id = 4');
    }
    public static function x12Password()
    {
        return sqlQuery('SELECT x12_sftp_pass FROM x12_partners WHERE id = 4');
    }
}
