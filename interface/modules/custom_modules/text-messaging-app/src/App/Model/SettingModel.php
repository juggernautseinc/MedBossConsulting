<?php
/*
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  license https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

namespace Juggernaut\App\Model;

    class SettingModel
    {
        public function getApptStatuses(): array
        {
            $list = sqlStatement("SELECT option_id, title FROM list_options WHERE list_id LIKE ? AND activity = 1", ['apptstat']);
            $listArray = [];
            while ($row = sqlFetchArray($list))
            {
                $listArray[] = $row;
            }
            return $listArray;
        }

        public function statusOfSmsService()
        {
            return sqlQuery("SELECT `active` FROM `background_services` WHERE `name` = ?", ['SMS_REMINDERS']);
        }
    }
