<?php

/*
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  license https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

require_once dirname(__DIR__, 2) . "/globals.php";

use OpenEMR\Services\InsuranceCompanyService;
use OpenEMR\Services\InsuranceService;

$patient_insurance = new InsuranceService();
$companies = new InsuranceCompanyService();

$l = $patient_insurance->getOneByPid($_SESSION['pid'], 'primary');

var_dump($l);
echo "Stage One!";
