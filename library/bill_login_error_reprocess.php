<?php
/*
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  license https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

use OpenEMR\Billing\BillingProcessor\X12RemoteTracker;


X12RemoteTracker::sftpSendLoginErrorFiles();

echo "Sent! Refresh the claim tracker page. ";
