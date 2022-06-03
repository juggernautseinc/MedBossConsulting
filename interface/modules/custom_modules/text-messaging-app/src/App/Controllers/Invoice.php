<?php

/*
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  All Rights Reserved
 */

namespace Juggernaut\App\Controllers;

use Juggernaut\App\View;

class Invoice
{
    /**
     * @throws \Juggernaut\App\Exceptions\ViewNotFoundException
     */
    public function index(): string
    {
        return (new View('invoices/index'))->render();
    }

    /**
     * @throws \Juggernaut\App\Exceptions\ViewNotFoundException
     */
    public function create(): string
    {
        return (new View('invoices/create'))->render();
    }

    public function store(): void
    {
        $value = $_POST['amount'];
        var_dump($value);
    }
}
