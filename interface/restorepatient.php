<?php

/*
 *  package   OpenEMR
 *  link      http://www.open-emr.org
 *  author    Sherwin Gaddis <sherwingaddis@gmail.com>
 *  copyright Copyright (c )2021. Sherwin Gaddis <sherwingaddis@gmail.com>
 *  license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 *
 */

require_once "globals.php";

//$sql = "REPLACE INTO patient_data SET `title` = ? , `fname` = ? , `mname` = ? , `lname` = ? , `pubpid` = ? , `DOB` = ? , `sex` = ? , `ss` = ? , `status` = ? , `phone_cell` = ? , `phone_home` = ? , `street` = ? , `city` = ? , `postal_code` = ? , `state` = ? , `email` = ? , `email_direct` = ? , `referral_source` = ? , `pharmacy_id` = ? , `Providerid2` = ? , `Notes` = ? , `occupation` = ? , `interpretter` = ? , `language` = ? , `sexual_orientation` = ? , `gender_identity` = ? , `religion` = ? , `monthly_income` = ? , `financial_review` = ? , `guardiansname` = ? , `guardianrelationship` = ? , `guardianaddress` = ? , `guardiancity` = ? , `guardianstate` = ? , `guardianpostalcode` = ? , `guardianphone` = ? , `guardianemail` = ? , `GPonfile` = ? , `hipaa_voice` = ? , `hipaa_message` = ? , `hipaa_mail` = ? , `hipaa_allowsms` = ? , `hipaa_allowemail` = ? , `allow_patient_portal` = ? , `cmsportal_login` = ? , `pid` = ? , `uuid` = ? , `date` = ? , `regdate` = ?";

//sqlStatement($sql, ['','Jennifer','','Splichal','511074692810316','1984-02-16','Female','','','(209) 345-9976','(209) 345-9976','1013 CHALONE CT','MODESTO','95358','CA','armyjennifer@gmail.com','armyjennifer@gmail.com','','0','15','','','','','','','','','','','','','','','','','','','YES','','YES','YES','YES','YES','','875','??????N????N??1?','2021-05-31 11:30:29','2021-05-31 11:30:29']) ;

//$sql = "UPDATE patient_data SET `title` = ? , `fname` = ? , `mname` = ? , `lname` = ? , `pubpid` = ? , `DOB` = ? , `sex` = ? , `ss` = ? , `status` = ? , `phone_cell` = ? , `phone_home` = ? , `street` = ? , `city` = ? , `postal_code` = ? , `state` = ? , `email` = ? , `email_direct` = ? , `referral_source` = ? , `pharmacy_id` = ? , `Providerid2` = ? , `Notes` = ? , `occupation` = ? , `interpretter` = ? , `language` = ? , `gender_identity` = ? , `sexual_orientation` = ? , `religion` = ? , `monthly_income` = ? , `financial_review` = ? , `guardiansname` = ? , `guardianrelationship` = ? , `guardianaddress` = ? , `guardiancity` = ? , `guardianstate` = ? , `guardianpostalcode` = ? , `guardianphone` = ? , `guardianemail` = ? , `GPonfile` = ? , `hipaa_voice` = ? , `hipaa_message` = ? , `hipaa_mail` = ? , `hipaa_allowsms` = ? , `hipaa_allowemail` = ? , `allow_patient_portal` = ? , `cmsportal_login` = ? , `Eligibility_` = ? , `Verified_` = ? , `Date_V` = ? , `Notes2` = ? , `date` = ? WHERE `pid` = ?";

//sqlStatement($sql, ['','Jennifer','','Splichal','511074692810316','1984-02-16','Female','','','(209) 345-9976','(209) 345-9976','1013 CHALONE CT','MODESTO','95358','CA','armyjennifer@gmail.com','armyjennifer@gmail.com','','0','15','Effective date:8/10/2020\r\nTermination date:12/7/2021\r\nNo Copay for VA\r\nprimary Insured\r\nAuth# VA0008555532','','','','','','','','0000-00-00 00:00:00','','','','','','','','','','YES','','YES','YES','YES','YES','','YES','','','Effective date:8/10/2020\r\nTermination date:12/7/2021\r\nNo Copay fo VA\r\nprimary Insured\r\nAuth# VA0008555532','2021-07-07 08:52:51','875']);
/*
$patient = "select pid, pubpid from patient_data WHERE email = ''";
$getPatient = sqlStatement($patient);

$email = "select portal_login_username from patient_access_onsite where pid = ? and id > 14";

$fill = "UPDATE patient_data SET email = ?, email_direct = ? WHERE pid = ?";


$i = 1;
while ($row = sqlFetchArray($getPatient)) {
    $address = sqlQuery($email, [$row['pid']]);
    //echo $address['portal_login_username'] . "<br>";
    if (!empty($address['portal_login_username'])) {
        $pemail = $address['portal_login_username'];
        sqlStatement($fill, [$pemail, $pemail, $row['pid']]);
        echo "Inserted Address - " . $row['pubpid'] . " - " . $address['portal_login_username'] . " $i<br>";
        $i++;
    }
}
*/

$phone = "select pid, pubpid, phone_home, phone_cell from patient_data WHERE phone_home != ''";

$list = sqlStatement($phone);

$transfer = "UPDATE patient_data SET phone_cell = ? WHERE pid = ?";

$i = 1;
while ($row = sqlFetchArray($list)) {
    if (empty($row['phone_cell'])) {
        sqlStatement($transfer, [$row['phone_home'], $row['pid']]);
        echo "this number needed to be copied - " . $row['pubpid'] . " - " . $row['phone_home'] . " - $i<br>";
        $i++;
    }
}
echo "<br>DONE!!!, THIS UPDATE";


