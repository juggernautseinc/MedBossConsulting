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
        $statement = "SELECT * FROM module_prior_authorizations WHERE `pid` = ?";
        $binds = array();
        $binds[] = $this->pid;
        return QueryUtils::fetchRecords($statement, $binds);
    }


}
