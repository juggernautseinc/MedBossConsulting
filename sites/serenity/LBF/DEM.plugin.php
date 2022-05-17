<?php

/*
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  license https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

function DEM_javascript_onload()
{
    echo "
    document.getElementById('form_Notes2').addEventListener('click', addNoteEditor);
    function addNoteEditor() {
       alert('Logging change');
       document.getElementById('form_changehistory').innerHTML = 'Last updated by ' + Date();
    }
    ";
}

