<?php

/**
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  All Rights reserved
 */

namespace OpenEMR\Module;

use OpenEMR\Core\Kernel;
use OpenEMR\Events\PatientDemographics\RenderEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class BootStrap
{
    private $eventDispatcher;

    public function __construct(EventDispatcherInterface $eventDispatcher, ?Kernel $kernel = null)
    {
        global $GLOBALS;
        if (empty($kernel)) {
            $kernel = new Kernel();
        }

        $this->eventDispatcher = $eventDispatcher;
        $this->subscribeToEvents();

    }

    public function subscribeToEvents()
    {
        $this->eventDispatcher->addListener(RenderEvent::EVENT_RENDER_JAVA, [$this, 'addButtonPatientMenu']);
    }

    private function addButtonPatientMenu()
    {
        return "<button>New Button</button> ";
    }
}
