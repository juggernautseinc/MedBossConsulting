<?php

/*
 *  package   OpenEMR
 *  link      http://www.open-emr.org
 *  author    Sherwin Gaddis <sherwingaddis@gmail.com>
 *  copyright Copyright (c )2021. Sherwin Gaddis <sherwingaddis@gmail.com>
 *  license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 *
 */

namespace OpenEMR\Billing\BillingProcessor;

use OpenEMR\Services\InsuranceService;
use OpenEMR\Services\InsuranceCompanyService;

/**
 * Class BillingModifiers
 * @package OpenEMR\Billing\BillingProcessor
 * The purpose of this class is to set the billing modifier according to the insurance provider
 * The future of this list is to have the insurance companies managed by the end user.
 */
class BillingModifiers
{
    public $modifer;
    public $pos;

    public function __construct($pid)
    {
        //find patient primary insurance provider id
        $insuranceprovider = new InsuranceService();
        $patientinsuranceid = $insuranceprovider->getOneByPid($pid, 'primary');
        return $patientinsuranceid;
        //find the providers name
        $insuranceprovidername = new InsuranceCompanyService();
        $isurname = $insuranceprovidername->getOneById($patientinsuranceid['provider']);
        error_log("did tihis fire off?", $patientinsuranceid);
        $insurername = [
            'presbyterian',
            'western',
            'humana',
            'bcbs',
            'tricare',
            'molina',
            'magellan',
            'uhc',
            'medicare',
            'hmaa',
            'uha',
            'aloha',
            'hmsa'
            ];
        $checkName = explode(" ", $isurname['name']);
        foreach ($checkName as $name) {
            if (in_array($name, $insurername)) {
                return $name;
            }
        }

    }
    public function hmsa()
    {
        $this->modifer = '95';
        return $this->modifer;
    }
    public function aloha()
    {
        $this->modifer = '95';
        return $this->modifer;
    }
    public function uha()
    {
        $this->modifer = '95';
        return $this->modifer;
    }
    public function hmaa()
    {
        $this->modifer = '95';
        return $this->modifer;
    }
    public function medicare()
    {
        $this->modifer = '95';
        return $this->modifer;
    }
    public function uhc()
    {
        $this->modifer = '';
        return $this->modifer;
    }
    public function magellan()
    {
        $this->modifer = '95';
        return $this->modifer;
    }
    public function presbyterian()
    {
        $this->modifer = '';
        return $this->modifer;
    }
    public function molina()
    {
        $this->modifer = 'GT';
        return $this->modifer;
    }
    public function tricare()
    {
        $this->modifer = '95';
        return $this->modifer;
    }
    public function bcbs()
    {
        $this->modifer = '95';
        return $this->modifer;
    }
    public function humana()
    {
        $this->modifer = '95';
        return $this->modifer;
    }
    public function Western()
    {
        $this->modifer = 'GT';
        return $this->modifer;
    }
    public function UMR()
    {
        $this->modifer = '';
        return $this->modifer;
    }
}
