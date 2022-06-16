<?php

/*
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  Reserved
 */

// The purpose of this function is to create JavaScript that is run
// once when the page is loaded.
//
function LBT_authorizations_javascript_onload()
{

    $today = date('Y-m-d H:s:i');
    echo "
     document.getElementById('form_Date_V').value = '$today';
    ";
}
