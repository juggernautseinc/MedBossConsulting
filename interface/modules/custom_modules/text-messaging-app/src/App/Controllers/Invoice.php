<?php

/*
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  All Rights Reserved
 */

namespace Juggernaut\App\Controllers;

class Invoice
{
    public static function index(): string
    {
        return '<!doctype html><html lang="en"><title>Invoices page</title><body><h1>Invoices</h1></body></html>';
    }

    public static function create(): string
    {
        return 'Create Invoice';
    }

}
