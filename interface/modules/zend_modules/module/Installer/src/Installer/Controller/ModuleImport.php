<?php

/*
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  license https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

namespace Installer\Controller;

use GuzzleHttp\Client;

class ModuleImport
{
    private $url;
    private $name;

    public function __construct($url, $name)
    {
        $this->url = $url;
        $this->name = $name;
        return self::download();
    }

    private function download()
    {
        $path = dirname(__DIR__, 6) .  '/custom_modules/' . $this->name;
        $setDirOwner = dirname(__DIR__, 6) .  '/custom_modules';
        chown($setDirOwner, 'root');
        //$stat = stat($path);

         die('check directory owner.');
        $zipResource = fopen($path, "w");
        // Get The Zip File From Server
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER,true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_FILE, $zipResource);
        $page = curl_exec($ch);
        if(!$page) {
            echo "Error :- ".curl_error($ch);
        }
        curl_close($ch);

    }

    public static function createImportDir()
    {
        return $GLOBALS['webroot'];
        if (!file_exists($import_dir)) {
            $import_dir = dirname(__DIR__, 6) .  '/custom_modules/';
            try {
                mkdir($import_dir . DIRECTORY_SEPARATOR . "import", '755', true);
            } catch (Exception $e) {
                return "An error occurred: " . $e->getMessage();
            }
        } else {
            return "does";
        }
    }
}
