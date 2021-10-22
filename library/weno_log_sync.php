<?php

/*
 *  @package OpenEMR
 *  @link    http://www.open-emr.org
 *  @author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  @copyright Copyright (c) 2021 Sherwin Gaddis <sherwingaddis@gmail.com>
 *  @license https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once dirname(__FILE__, 2) . "/interface/globals.php";

use OpenEMR\Rx\Weno\Container;

function start_weno()
{
    $container = new Container();
    $logsync = $container->getLogproperties();
    $logsync->logSync();
}
