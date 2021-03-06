<?php
/*
 * @package OpenEMR
 * @link    http://www.open-emr.org
 * @author  Sherwin Gaddis <sherwingaddis@gmail.com>
 * @copyright Copyright (c) 2021 Sherwin Gaddis <sherwingaddis@gmail.com>
 * @license https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

require_once("../../interface/globals.php");

use OpenEMR\Common\Csrf\CsrfUtils;

if (!CsrfUtils::verifyCsrfToken($_GET["csrf_token_form"])) {
    CsrfUtils::csrfNotVerified();
}

if (isset($_GET['term'])) {
    $return_arr = array();
    $term = filter_input(INPUT_GET, "term");

    $sql = "SELECT code, code_text  FROM codes WHERE code_text LIKE ? ORDER BY code_text";
    $val = array($term . '%');
    $res = sqlStatement($sql, $val);
    while ($row = sqlFetchArray($res)) {
        $return_arr[] =  $row['name'];
    }

    /* Toss back results as json encoded array. */
    echo json_encode($return_arr);
}
