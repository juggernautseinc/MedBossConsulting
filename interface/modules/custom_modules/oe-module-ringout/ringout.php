<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
echo "<pre>";
error_reporting(E_ALL);
require_once "../../../globals.php";

$RECIPIENT = '7573282736';

$RINGCENTRAL_CLIENTID = 'iVJDCIomS96YnMJMDTxNSA';
$RINGCENTRAL_CLIENTSECRET = 'IIwpTj7oTvOyg6NyOn6L7AwKSlG16uR_-h2nyAIjTuIA';
$RINGCENTRAL_SERVER = 'https://platform.devtest.ringcentral.com';

$RINGCENTRAL_USERNAME = '+13133982896';
$RINGCENTRAL_PASSWORD = '#8*2q0Rl1uriq5Vij*PR';
$RINGCENTRAL_EXTENSION = '101';

$rcsdk = new RingCentral\SDK\SDK($RINGCENTRAL_CLIENTID, $RINGCENTRAL_CLIENTSECRET, $RINGCENTRAL_SERVER);

$platform = $rcsdk->platform();
$platform->login($RINGCENTRAL_USERNAME, $RINGCENTRAL_EXTENSION, $RINGCENTRAL_PASSWORD);

$resp = $platform->post('/account/~/extension/~/ring-out',
    [
        'from' => ['phoneNumber' => $RINGCENTRAL_USERNAME],
        'to' => ['phoneNumber' => $RINGCENTRAL_USERNAME],
        'playPrompt' => false
    ]);

print_r ("Call Placed. Call Status: " . $resp->json()->status->callStatus);

