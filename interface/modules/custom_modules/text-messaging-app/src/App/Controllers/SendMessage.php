<?php

/**
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  All Rights Reserved
 */

namespace Juggernaut\App\Controllers;

use OpenEMR\Common\Crypto\CryptoGen;

class SendMessage
{
    public function outBoundMessage(int $phone, string $message) : string
    {
        $ch = curl_init('https://textbelt.com/text');
        $data = array(
            'phone' => $phone,
            'message' => $message,
            'key' => self::getKey(),
        );

        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    private function getKey()
    {
        $key = new CryptoGen();
        return $key->decryptStandard($GLOBALS['texting_enables']);
    }

}
