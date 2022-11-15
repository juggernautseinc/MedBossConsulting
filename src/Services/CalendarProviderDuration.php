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
        return dirname(__DIR__) . DIRECTORY_SEPARATOR . "templates/calendar" . DIRECTORY_SEPARATOR;
    }
}
