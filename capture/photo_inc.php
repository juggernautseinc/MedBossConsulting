<?php

/**
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  license https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

function isPatientHere($source, $database)
{
    $database = $database . ".";
    $pid = sqlQuery("SELECT pubpid FROM " . $database . "patient_data WHERE pid = ?", [$source]);
    return $pid['pubpid'];
}

function processUploaedImage($imageName, $image, $pid)
{
    require_once dirname(__DIR__) . "/library/documents.php";
    $size = filesize($image);
    $type = "application/jpeg";
    $category_id = 742111;

    addNewDocument($imageName, $type, $image, 0, $size, $pid, $pid, $category_id);
    //move image to patient chart
}
