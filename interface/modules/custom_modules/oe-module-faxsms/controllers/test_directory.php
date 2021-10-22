<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "../../../../globals.php";

$location = $GLOBALS['OE_SITE_DIR'] . '/documents/logs_and_misc/_cache';

file_put_contents($location."/platform.json", "This is a test of the json system. this is only a test");

echo "check " . $location;
