<?php

/*
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  license https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

namespace OpenEMR\Services;

class SwitchPatientInsurance
{
    private $insurancecompanyservice;
    private $insuranceservice;
    public function __construct(
        InsuranceCompanyService $insuranceCompanyService,
        InsuranceService $insuranceService
    )
    {
        $this->insurancecompanyservice = $insuranceCompanyService;
        $this->insuranceservice = $insuranceService;
    }

    public function listPatientInsurances()
    {
        return [$_SESSION['pid']];
        //return $this->insuranceservice->getAll($search);
    }
}
