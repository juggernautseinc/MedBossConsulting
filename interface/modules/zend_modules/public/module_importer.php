<?php

/*
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  license https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

use Installer\Controller\ModuleImport;

echo "Landed <br><br>";

if (!CsrfUtils::verifyCsrfToken($_POST["token"])) {
    CsrfUtils::csrfNotVerified();
}
$parts = explode('/', $_POST['module_import']);

var_dump($parts);
