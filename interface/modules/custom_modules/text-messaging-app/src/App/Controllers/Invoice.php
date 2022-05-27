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
    public function index(): string
    {
        return '<!doctype html><html lang="en"><title>Invoices page</title><body><h1>Invoices</h1></body></html>';
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

    private function formView()
    {
        return <<<EEB
<title>Post Form</title>
<form action="/interface/modules/custom_modules/text-messaging-app/public/index.php/invoices/create" method="post">
<label>Amount</label>
<input type="text" name="amount">
<input type="submit" value="Submit">
</form>
EEB;

    }

}
