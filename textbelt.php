<?php

require_once "interface/globals.php";

function createMeetingId()
{
    $newmeetingid = sqlQuery("select DOB from patient_data where pid = ?", [$_SESSION['pid']]);
    $room = md5($newmeetingid['DOB'] . $_SESSION['pid']);
    return $room;
}

$link = '';
$wherefrom = explode("/", $_SERVER['HTTP_REFERER']);
if ($wherefrom[5] == 'tabs') {
    $meetingid = createMeetingId();
    $consent = "By clicking the link below, you are consenting to the telehealth service that is being provided.";
    $link = "https://" . $_SERVER['SERVER_NAME'] . "/interface/jitsi/jitsi.php?room=" . $meetingid . "&pid=" . $_SESSION['pid'];
}

$sendto = $_GET['recipient'];

$ch = curl_init('https://textbelt.com/text');
$data = array(
  'phone' => $sendto,
  'message' => "Serenity Telehealth 8084682439 $link",
  'key' => '2fdab352c078e28c7cc1b1e2b3a1044798330532ATN0rDH2HW7V0dPOOHSIRhyex',
);

curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);

$message = json_decode($response, true);
if ($message['success'] === true) {
    echo "Message send successfully";
} else {
    echo "Message failed : <br>" . $message['error'];
}
