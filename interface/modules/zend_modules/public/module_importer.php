<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
/*
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  license https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

use Installer\Controller\ModuleImport;
use OpenEMR\Common\Csrf\CsrfUtils;

require_once dirname(__FILE__, 4) . "/globals.php";

if (!CsrfUtils::verifyCsrfToken($_POST['token'])) {
    echo 'token not verified';
    CsrfUtils::csrfNotVerified();
}

echo ModuleImport::createImportDir();

die;
$parts = explode('/', $_POST['module_import']);
$part_count = count($parts);
$zip = ($part_count - 1);

$import = new ModuleImport($_POST['module_import'], $parts[$zip]);

var_dump($import);
