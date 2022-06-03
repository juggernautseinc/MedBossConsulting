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
        $invoiceView = new View('invoices/index');
        return $invoiceView->render();
    }

    public function create(): string
    {
        return self::formView();
    }

    public function store(): void
    {
        $value = $_POST['amount'];
        var_dump($value);
    }
}
