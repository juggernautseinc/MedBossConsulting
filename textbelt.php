<?php

require_once "interface/globals.php";

use OpenEMR\Common\Crypto\CryptoGen;

function createMeetingId()
{
    $newmeetingid = sqlQuery("select DOB from patient_data where pid = ?", [$_SESSION['pid']]);
    return md5($newmeetingid['DOB'] . $_SESSION['pid']);
}

$link = '';
$wherefrom = explode("/", $_SERVER['HTTP_REFERER']);
if ($wherefrom[5] == 'tabs') {
    $meetingid = createMeetingId();
    $consent = "By clicking the link below, you are consenting to the telehealth service that is being provided.";
    $link = "https://" . $_SERVER['SERVER_NAME'] . "/interface/jitsi/jitsi.php?room=" . $meetingid . "&pid=" . $_SESSION['pid'];
}

$sendTo = $_GET['recipient'];
function sendSMS($sendTo, $link)
{
    $key = new CryptoGen();
    $ch = curl_init('https://textbelt.com/text');
    $data = array(
      'phone' => $sendTo,
      'message' => "Serenity Telehealth $link",
      'key' => $key->decryptStandard($GLOBALS['texting_enables']),
    );

    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}

$response = sendSMS($sendTo, $link);
$message = json_decode($response, true);
if ($message['success'] === true) {
    echo "Message send successfully. Remaining quota " . $message['quotaRemaining'];
} else {
    echo "Message failed : <br>" . $message['error'];
}
