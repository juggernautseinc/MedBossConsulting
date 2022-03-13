<?php

/*
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  license https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

use Installer\Controller\ModuleImport;
use OpenEMR\Common\Csrf\CsrfUtils;
use OpenEMR\Core\Header;

require_once dirname(__FILE__, 4) . "/globals.php";

if (!CsrfUtils::verifyCsrfToken($_POST['token'])) {
    echo 'token not verified';
    CsrfUtils::csrfNotVerified();
}

/*
         * check if the directory exist to download the import. If it does not exist create it on
         * first use.
         */
$import_dir = ModuleImport::createImportDir();
?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title><?php echo xlt("Module Import") ?></title>
        <?php Header::setupHeader(); ?>
    </head>
    <body>
        <div class="container-lg">
            <div class="m-5">
                <h1><?php echo xlt("Module Import") ?></h1>
            </div>
            <div class="m-5">
                <?php
                /*
                 * get the file name to be imported from the URL supplied
                 */
                $parts = explode('/', $_POST['module_import']);
                $part_count = count($parts);
                $zip = ($part_count - 1);
                echo "<p><strong>" . xlt('Download location given ') . "</strong></p> " . $_POST['module_import'];
                ?>
            </div>
            <div class="m-5">
                <?php
                echo "<p><strong>" . xlt("Attempting to download file. ") . "</strong></p>";
                /*
                 * download the file to the import folder
                 */
                $import = new ModuleImport($_POST['module_import'], $parts[$zip], $import_dir);

                echo  "<strong>" . xlt('Result of download') . "</strong><pre>";
                print_r($import, true);
                ?>
            </div>
        </div>
    </body>
    </html>
