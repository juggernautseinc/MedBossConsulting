<?php

/*
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  license https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

namespace OpenEMR\Services;

use OpenEMR\Common\Twig\TwigContainer;
use OpenEMR\Core\Kernel;

class CalendarProviderDuration
{
    private \Twig\Environment $twig;

    public function __construct(?Kernel $kernal = null)
    {
        if (empty($kernal)) {
            $kernal = new Kernel();
        }

        $twig = new TwigContainer($this->getTemplatePath(), $kernal);
        $twigEnv = $twig->getTwig();
        $this->twig = $twigEnv;
    }

    public function twigEnv(): \Twig\Environment
    {
        return $this->twig;
    }

    private function getTemplatePath(): string
    {
        return dirname(__DIR__) . DIRECTORY_SEPARATOR . "../templates/calendar" . DIRECTORY_SEPARATOR;
    }

    public function getCalendarProviderList(): array
    {
        $list = [];
        $sql = "SELECT DISTINCT `ope`.`pc_aid`, `u`.`fname`, `u`.`lname` FROM `openemr_postcalendar_events` AS ope " .
                "LEFT JOIN `users` AS u ON `u`.`id` = `ope`.`pc_aid` " .
        "WHERE `ope`.`pc_title` = 'In Office' AND `ope`.`pc_aid` != '' AND `u`.`active` = 1 AND `ope`.`pc_aid` != 1";
        $providers = sqlStatement($sql);
        while ($row = sqlFetchArray($providers)) {
            $list[] = $row;
        }
        return $list;
    }

    public function updateProviderDuration($updates)
    {
        foreach ($updates as $key => $update) {
            $entry = explode("_", $key);
            var_dump($entry[2]);
        }
    }
}
