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

    private function download(): array
    {
        $path = dirname(__DIR__) .  '/interface/modules/custom_modules/' . $this->name;
        var_dump($path); die;
        $file_path = fopen($path,'w');
        $client = new Client();
        $response = $client->get($this->url, ['sink' => $file_path]);
        return ['response_code' => $response->getStatusCode(), 'name' => $this->name];
    }
}
