<?php


$ignoreAuth = true;
// Set $sessionAllowWrite to true to prevent session concurrency issues during authorization related code
$sessionAllowWrite = true;
require_once("interface/globals.php");

$site_id = $_GET['site'];

$dir = dirname(__DIR__);
$location = $dir ."/boss/sites/". $site_id . "/documents/logs_and_misc/methods/";
unlink($location . "sixa");
unlink($location . "sixb");
