<?php

/*
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  license https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

namespace Juggernaut\App;

class Database
{
    public function lookUpPatientData($pid)
    {
        $val = sqlStatement('select 1 from `module_prior_authorizations` LIMIT 1');
        if ($val !== FALSE) {
            $auth_num = sqlQuery("SELECT `auth_num` FROM `module_prior_authorizations` WHERE `pid` = ? AND `end_date` > NOW()", [$pid]);
            return $auth_num[''];
        } else {
            return null;
        }
    }
}
