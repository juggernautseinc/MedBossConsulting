<?php

/*
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  license https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

namespace OpenEMR\Billing;


class X12ClaimRepost
{
    /**
     * @throws GuzzleException
     */
    public function __construct(
        $host,
        $username,
        $password
    )
    {
        /**
         * Test the SFTP connection to see if it is working properly
         */
        $info = '';
        $credentials = $username . ":" . $password;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "sftp://" . $host);
        curl_setopt($curl, CURLOPT_USERPWD, $credentials);
        curl_exec($curl);
        if (!curl_errno($curl)) {
            $info = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        } else {
            print curl_error($curl);
        }
        curl_close($curl);
        return $info;
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
        sqlQuery("UPDATE `x12_remote_tracker` SET status = 'waiting' WHERE `status` != 'success' ");
    }
}

