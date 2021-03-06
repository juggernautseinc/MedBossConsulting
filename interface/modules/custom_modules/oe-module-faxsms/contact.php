<?php
/**
 * Fax SMS Module Member
 *
 * @package   OpenEMR
 * @link      http://www.open-emr.org
 * @author    Jerry Padgett <sjpadgett@gmail.com>
 * @copyright Copyright (c) 2018-2021 Jerry Padgett <sjpadgett@gmail.com>
 * @license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

$sessionAllowWrite = true;
require_once(__DIR__ . "/../../../globals.php");

use OpenEMR\Modules\FaxSMS\Controllers\AppDispatch;
use OpenEMR\Core\Header;

function createMeetingId()
{
    $newmeetingid = sqlQuery("select DOB from patient_data where pid = ?", [$_SESSION['pid']]);
    $room = md5($newmeetingid['DOB'] . $_SESSION['pid']);
    return $room;
}
// kick off app endpoints controller
$clientApp = AppDispatch::getApiService();
$logged_in = $clientApp->authenticate();
$isSMS = $clientApp->getRequest('isSMS', 0);
if (empty($isSMS)) {
    $the_file = $clientApp->getRequest('file');
    $isContent = $clientApp->getRequest('isContent');
    $isDoc = $clientApp->getRequest('isDocuments');
    $isQueue = $clientApp->getRequest('isQueue');
    $file_name = pathinfo($the_file, PATHINFO_BASENAME);
    $file_mime = $clientApp->getRequest('mime');
} else {
    $recipient_phone = $clientApp->getRequest('recipient');
}

$service = $clientApp::getServiceType();

?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo xlt('Contact') ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php Header::setupHeader();
    echo "<script>var pid=" . js_escape($pid) . ";var isSms=" . js_escape($isSMS) . ";var recipient=" . js_escape($recipient_phone) . ";</script>";
    ?>
    <?php if (!empty($GLOBALS['text_templates_enabled'])) { ?>
    <script src="<?php echo $GLOBALS['web_root'] ?>/library/js/CustomTemplateLoader.js"></script>
    <?php } ?>
    <script>
        $(function () {
            if (isSms) {
                $(".smsExclude").addClass("d-none");
                //$("#form_name").val();
                //$("#form_lastname").val();
                $("#form_phone").val(recipient);
            }
            // when the form is submitted
            $('#contact-form').on('submit', function (e) {
                if (!e.isDefaultPrevented()) {
                    let wait = '<i class="fa fa-cog fa-spin fa-4x"></i>';
                    let url = 'sendFax';
                    if (isSms) {
                        url = 'sendSMS';
                    }
                    // POST values in the background the script URL
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: $(this).serialize(),
                        success: function (data) {
                            let err = (data.search(/Exception/) !== -1 ? 1 : 0);
                            if (!err) {
                                err = (data.search(/Error:/) !== -1) ? 1 : 0;
                            }
                            // Type of the message: success or danger. Apply it to the alert.
                            let messageAlert = 'alert-' + (err !== 0 ? 'danger' : 'success');
                            let messageText = data;

                            // let's compose alert box HTML
                            let alertBox = '<div class="alert ' + messageAlert + ' alert-dismissable">' +
                                '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + messageText + '</div>';

                            // If we have messageAlert and messageText
                            if (messageAlert && messageText) {
                                // inject the alert to messages div in our form
                                $('#contact-form').find('.messages').html(alertBox);
                                setTimeout(function () {
                                    if (!err) {
                                        // close dialog as we have success.
                                        dlgclose();
                                    }
                                    // if error let user close dialog for time to read error message.
                                }, 2000);
                            }
                        }
                    });
                    return false;
                }
            })
        });

        function sel_patient() {
            dlgopen(top.webroot_url + '/interface/main/calendar/find_patient_popup.php?pflag=0&pkretrieval=1', '_blank', 'modal-md', 400);
        }

        function setpatient(pid, lname, fname, dob) {
            $("#form_patient").val(fname+" "+lname);
            $("#form_patient_id").val(fname+""+pid);
            $("#form_pid").val(pid);
        }

        function contactCallBack(contact) {
            let actionUrl = 'getUser';
            return $.post(actionUrl, {'uid': contact}, function (d, s) {
                //$("#wait").remove()
            }, 'json').done(function (data) {
                $("#form_name").val(data[0]);
                $("#form_lastname").val(data[1]);
                $("#form_phone").val(data[2]);
            });
        }

        const getContactBook = function (e, rtnpid) {
            e.preventDefault();
            let btnClose = <?php echo xlj("Cancel"); ?>;
            dlgopen('', '', 'modal-lg', 500, '', '', {
                buttons: [
                    {text: btnClose, close: true, style: 'primary  btn-sm'}
                ],
                url: top.webroot_url + '/interface/usergroup/addrbook_list.php?popup=2',
                dialogId: 'fax'
            });
        };
    </script>
    <style>
        .panel-body {
            word-wrap: break-word;
            overflow: hidden;
        }
    </style>
</head>
<body>
    <div class="container">
        <form class="form" id="contact-form" method="post" action="contact.php" role="form">
            <input type="hidden" id="form_file" name="file" value='<?php echo attr($the_file) ?>'>
            <input type="hidden" id="form_isContent" name="isContent" value='<?php echo attr($isContent); ?>'>
            <input type="hidden" id="form_isDocuments" name="isDocuments" value='<?php echo attr($isDoc) ?>'>
            <input type="hidden" id="form_isQueue" name="isQueue" value='<?php echo attr($isQueue) ?>'>
            <input type="hidden" id="form_isSMS" name="isSMS" value='<?php echo attr($isSMS) ?>'>
            <input type="hidden" id="form_mime" name="mime" value='<?php echo attr($file_mime) ?>'>
            <div class="messages"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="form_name"><?php echo xlt('Firstname') ?></label>
                        <input id="form_name" type="text" name="name" class="form-control" placeholder="<?php echo xla('Not Required') ?>">
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label for="form_lastname"><?php echo xlt('Lastname') ?></label>
                        <input id="form_lastname" type="text" name="surname" class="form-control" placeholder="<?php echo xla('Not Required') ?>">
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group smsExclude">
                        <label for="form_email"><?php echo xlt('Email') ?></label>
                        <input id="form_email" type="email" name="email" class="form-control"
                            placeholder="<?php echo xla('Not required for fax') ?>">
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label for="form_phone"><?php echo xlt('Recipient Phone') ?> *</label>
                        <input id="form_phone" type="tel" name="phone" class="form-control" required="required" placeholder="<?php echo xla('Phone number of recipient') ?>">
                        <div class="help-block with-errors"></div>
                    </div>
                    <?php if ($service != "2" || !empty($isSMS)) { ?>
                        <div class="form-group">
                            <label for="form_message"><?php echo xlt('Message') ?></label>
                            <textarea id="form_message" name="comments" class="form-control" placeholder="
                            <?php echo empty($isSMS) ? xla('Comment for cover sheet.') : xla('SMS text message.') ?>" rows="3"></textarea>
                            <div class="help-block with-errors"></div>
                        </div>
                    <?php } ?>
                    <div>
                        <span class="text-center smsExclude"><strong><?php echo xlt('Sending File') . ': ' ?></strong><?php echo text($file_name) ?></span>
                    </div>
                    <div>
                        <button type="button" class="btn btn-primary" onclick="getContactBook(event, pid)" value="Contacts"><?php echo xlt('Contacts') ?></button>
                        <!-- patient picker ready once get patient info is added. -->
                        <!--<button type="button" class="btn btn-primary" onclick="sel_patient()" value="Patients"><?php /*echo xlt('Patients') */?></button>-->
                        <button type="submit" class="btn btn-success float-right" value=""><?php echo empty($isSMS) ? xlt('Send Fax') : xlt('Send SMS')?></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
