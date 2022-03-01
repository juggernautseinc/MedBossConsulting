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

    /**
     * @return void
     * this method is to back populate the module table in case just uses the prior auth form
     * or they have already been using the misc billing options
     * this is a silent function
     */
    public function insertMissingAuthsFromForm()
    {
        $formsAuths = self::formPriorAuth();
        $formMiscBilling = self::formMiscBilling();
        $array_merger = array_push($formsAuths, $formMiscBilling);
        $moduleAuths = self::getAuthsFromModulePriorAuth();

        if (!empty($moduleAuths) &&  !empty($array_merger)) {
            $insertArray = array_diff($moduleAuths, $array_merger);
            foreach ($insertArray as $auth) {
                $getinfo = sqlQuery("SELECT date_from, date_to FROM `form_prior_auth` WHERE `prior_auth_number` = ? ORDER BY `id` DESC LIMIT 1 ", [$auth]);
                if (!empty($getinfo['date_from'])) {
                    $saveInfoWithDate = "INSERT INTO `module_prior_authorizations` SET `id` = '', `pid` = ?, `auth_num` = ?, `start_date` = ?, `end_date` = ?";
                    $bindArray = [$_SESSION['pid'], $auth, $getinfo['date_from'], $getinfo['date_to']];
                    sqlStatement($saveInfoWithDate, $bindArray);
                } elseif (!empty($auth)) {
                    $saveInfoWithDate = "INSERT INTO `module_prior_authorizations` SET `id` = '', `pid` = ?, `auth_num` = ?";
                    $bindArray = [$_SESSION['pid'], $auth];
                    sqlStatement($saveInfoWithDate, $bindArray);
                }
            }
        }
    }

    /**
     * @return array
     * from form prior auth
     */
    private function formPriorAuth(): array
    {
        $sql = "select prior_auth_number from form_prior_auth where pid = ?";
        $auths = sqlStatement($sql, [$_SESSION['pid']]);
        $auths_array = [];
        while ($row = sqlFetchArray($auths)) {
            $auths_array[] = $row['prior_auth_number'];
        }
        return $auths_array;
    }

    /**
     * @return array
     */
    private function formMiscBilling()
    {
        $sql = "select prior_auth_number from form_misc_billing_options where pid = ?";
        $auths = sqlStatement($sql, [$_SESSION['pid']]);
        $auths_array = [];
        while ($row = sqlFetchArray($auths)) {
            $auths_array[] = $row['prior_auth_number'];
        }
        return $auths_array;
    }

}
