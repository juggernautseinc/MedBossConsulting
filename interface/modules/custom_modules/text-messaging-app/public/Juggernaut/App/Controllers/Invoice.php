<?php
/*
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  license https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

namespace Juggernaut\App\Controllers;

class Invoice
{
    public function index(): string
    {
        return '<!doctype html><html><title>Invoices page</title><body><h1>Invoices</h1></body></html>';
    }

    public function create(): string
    {
        return 'Create Invoice';
    }
}
