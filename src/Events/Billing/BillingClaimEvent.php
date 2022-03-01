<?php

/*
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  license https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

namespace OpenEMR\Events\Billing;

use Symfony\Component\EventDispatcher\Event;

/**
 * Event object for creating billing addons during the claim process
 *
 * @package OpenEMR\Events
 * @subpackage Billing
 * @author Sherwin Gaddis <sherwingaddis@gmail.com>
 * @copyright Copyright (c) 2022 Sherwin Gaddis <sherwingaddis@gmail.com>
 */
class BillingClaimEvent extends Event
{
    /**
     * The purpose of this is to inject into the billing process
     */
    const EVENT_HANDLE = 'billing.claim';
}
