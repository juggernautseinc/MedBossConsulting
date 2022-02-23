<?php

/*
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  All Rights Reserved
 */

namespace Juggernaut\OpenEMR\Modules\PriorAuthModule\Controller;

use OpenEMR\Common\Database\QueryUtils;

class AuthorizationService
{
    private $id;
    private $pid;
    private $auth_num;
    private $start_date;
    private $end_date;
    private $cpt;
    private $init_units;
    private $remaining_units;
    private const MODULE_TABLE = 'module_prior_authorizations';

    public function __construct()
    {
        //do epic stuff
    }
    public function storeAuthorizationInfo()
    {
        $statement = "INSERT INTO " . self::MODULE_TABLE .
            "(`id`, `pid`, `auth_num`, `start_date`, `end_date`, `cpt`, `init_units`, `remaining_units`) " .
            "VALUES (?,?, ?, ?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE " .
            "auth_num = VALUES(auth_num), start_date = VALUES(start_date), end_date = VALUES(end_date), " .
            "cpt = VALUES(cpt), init_units = VALUES(init_units)";

        $binding = [];
        $binding[] = $this->id;
        $binding[] = $this->pid;
        $binding[] = $this->auth_num;
        $binding[] = $this->start_date;
        $binding[] = $this->end_date;
        $binding[] = $this->cpt;
        $binding[] = $this->init_units;
        $binding[] = $this->remaining_units;
        QueryUtils::sqlInsert($statement, $binding);
    }

    public static function getUnitsUsed($number)
    {
        $statement = "SELECT count(prior_auth_number) AS count FROM `form_misc_billing_options` WHERE `prior_auth_number` = ?";
        $binds = [$number];
        return QueryUtils::sqlStatementThrowException($statement, $binds);
    }

    public function setId($id): void
    {
        $this->id = $id;
    }
    /**
     * @return mixed
     */
    public function getPid()
    {
        return $this->pid;
    }

    /**
     * @param mixed $pid
     */
    public function setPid($pid): void
    {
        $this->pid = $pid;
    }

    /**
     * @return mixed
     */
    public function getAuthNum()
    {
        return $this->auth_num;
    }

    /**
     * @param mixed $auth_num
     */
    public function setAuthNum($auth_num): void
    {
        $this->auth_num = $auth_num;
    }

    /**
     * @return mixed
     */
    public function getStartDate()
    {
        return $this->start_date;
    }

    /**
     * @param mixed $start_date
     */
    public function setStartDate($start_data): void
    {
        $this->start_date = $start_data;
    }

    /**
     * @return mixed
     */
    public function getEndDate()
    {
        return $this->end_date;
    }

    /**
     * @param mixed $end_date
     */
    public function setEndDate($end_date): void
    {
        $this->end_date = $end_date;
    }

    /**
     * @return mixed
     */
    public function getCpt()
    {
        return $this->cpt;
    }

    /**
     * @param mixed $cpt
     */
    public function setCpt($cpt): void
    {
        $this->cpt = $cpt;
    }

    /**
     * @return mixed
     */
    public function getInitUnits()
    {
        return $this->init_units;
    }

    /**
     * @param mixed $init_units
     */
    public function setInitUnits($init_units): void
    {
        $this->init_units = $init_units;
    }

    /**
     * @return mixed
     */
    public function getRemainingUnits()
    {
        return $this->remaining_units;
    }

    /**
     * @param mixed $remaining_units
     */
    public function setRemainingUnits($remaining_units): void
    {
        $this->remaining_units = $remaining_units;
    }



}
