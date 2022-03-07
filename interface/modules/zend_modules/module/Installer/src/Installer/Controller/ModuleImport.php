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
        $import = file_get_contents($this->url);
        return file_put_contents($path, $import);
    }
}
