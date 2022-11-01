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
    public function __construct(
        $host,
        $username,
        $password
    )
    {
        $info = '';
        $credentials = $username . ":" . $password;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "ftp://" . $host);
        curl_setopt($curl, CURLOPT_USERPWD, $credentials);
        curl_exec($curl);
        if (!curl_errno($curl)) {
            $info = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        }
        curl_close($curl);
        return $info;
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

