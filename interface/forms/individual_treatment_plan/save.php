<?php

require_once("../../globals.php");
require_once("$srcdir/api.inc");
require_once("$srcdir/forms.inc");

$encounter = $_SESSION['encounter'];
if ($encounter == "") {
    $encounter = date("Ymd");
}

if ($_GET["mode"] == "new") {
    //$newid = formSubmit("form_individual_treatment_plan", $_POST, $_GET["id"], $userauthorized);
    $newid = saveData($_POST);

    addForm($encounter, "Individual Treatment Plan", $newid, "individual_treatment_plan", $_SESSION['pid'], $userauthorized);

} elseif ($_GET["mode"] == "update") {
    $id = $_POST['id'];
    $storejsondata = json_encode($_POST);
    sqlStatement("update form_individual_treatment_plan set date = NOW(), long_term_goals = ?
    where id=?", [$storejsondata, $id]);
}

function saveData($data) {
    $sql = "INSERT INTO form_individual_treatment_plan SET id = ?, pid = ?, groupname= ?, user = ?, authorized = ?, activity=1, date = NOW(),".
        "long_term_goals = ? ";
    $storejsondata = json_encode($data);

    $items = [
        '', $_SESSION["pid"], $_SESSION["authProvider"], $_SESSION["authUser"], $userauthorized, $storejsondata
    ];
    sqlStatement($sql, $items);
    $nsql = "SELECT MAX(id) as id FROM form_individual_treatment_plan WHERE pid = ?";
    $newid = sqlQuery($nsql, [$_SESSION['pid']]);
    return $newid['id'];
}

formHeader("Redirecting....");
formJump();
formFooter();
