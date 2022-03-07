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

class DownloadRemoteFile
{
    private $url;
    private $name;
    private $extension;

    public function __construct($url, $name, $extension)
    {
        $this->url = $url;
        $this->extension = $extension;
        $this->name = $name;
    }

    private function download(){
        $path = $GLOBALS['webroot'] . '/interface/modules/custom_modules/' . $this->name . $this->extensions;
        $file_path = fopen($path,'w');
        $client = new Client();
        $response = $client->get($this->url, ['sink' => $file_path]);
        return ['response_code' => $response->getStatusCode(), 'name' => $this->name];
    }
}
