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

class ListAuthorizations
{
    private $pid;

    /**
     * @param mixed $pid
     */
    public function setPid($pid): void
    {
        $this->pid = $pid;
    }

    public function __construct()
    {
        //do epic stuff
    }

    public function getAllAuthorizations()
    {
        $sql = "SELECT *
                      FROM module_prior_authorizations
                      WHERE pid = ? ORDER BY `start_date` DESC";
        return sqlStatement($sql, [$this->pid]);
    }

    private function getAuthsFromModulePriorAuth()
    {
        $sql = "SELECT auth_num FROM module_prior_authorizations WHERE pid = ?";
        $auths = sqlStatement($sql, [$_SESSION['pid']]);
        $auth_array = [];
        while ($row = sqlFetchArray($auths)) {
            $auth_array[] = $row['auth_num'];
        }
        return $auth_array;
    }

    private function insertMissingAuthsFromForm()
    {
        $formsAuths = self::getArrayOfAuthNumbers();
        $moduleAuths = self::getAuthsFromModulePriorAuth();
        $insertArray = array_diff($formsAuths, $moduleAuths);

        foreach ($insertArray as $auth) {
            $getinfo = sqlQuery("SELECT date_from, date_to FROM form_prior_auth WHERE prior_auth_number = ? ORDER BY id DESC LIMIT 1");

        }
        return $getinfo;
    }

    /**
     * @return array
     * from form prior auth
     */
    private function getArrayOfAuthNumbers()
    {
        $sql = "select prior_auth_number from form_prior_auth where pid = ?";
        $auths = sqlStatement($sql, [$_SESSION['pid']]);
        $auths_array = [];
        while ($row = sqlFetchArray($auths)) {
            $auths_array[] = $row['prior_auth_number'];
        }
        return $auths_array;
    }
    public function seeAuthArray()
    {
        return self::insertMissingAuthsFromForm();
    }
}
