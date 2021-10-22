<?php
/**
 * TeleHealth Visit Form
 *
 * @package   OpenEMR
 * @link      http://www.open-emr.org
 * @author    Ray Magauran <magauran@medexbank.com>
 * @copyright Copyright (c) 2020 Ray Magauran <magauran@medexbank.com>
 * @license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */



require_once("../../globals.php");
require_once("$srcdir/api.inc");
require_once("$srcdir/patient.inc");
require_once("$srcdir/options.inc.php");

require_once("$srcdir/MedEx/API.php");
use OpenEMR\Common\Csrf\CsrfUtils;
use OpenEMR\Core\Header;
use OpenEMR\OeUI\OemrUI;


$MedEx = new MedExApi\MedEx('MedExBank.com');

$form_name   = "TeleHealth";
$form_folder = "telemed";
$Form_Name   = "TeleHealth Visit";
$action      = $_POST['action'];
$id          = $_GET['id'];
$display     = $_POST['display'];
$pid         = $_SESSION['pid'];
$refresh     = $_POST['refresh'];


formHeader("TeleHealth");
$returnurl = 'encounter_top.php';

//$query = "SELECT * " .
//        "FROM form_encounter AS fe, forms AS f WHERE " .
//        "fe.pid = ? AND " .
//        "f.formdir = ? AND f.encounter = fe.encounter AND f.encounter=? AND f.deleted = 0
//        ORDER BY f.id DESC LIMIT 1";
//    $erow = sqlQuery($query, array($pid, $form_folder, $encounter));
        //  $_GET['id'] = $erow['id']
        
$formid         = 0 + (isset($_GET['id']) ? $_GET['id'] : 0);
$obj            = $formid ? formFetch("form_telemed", $formid) : array();
$id             = $form_id;
//echo "ok $formid then";var_dump($obj);die();
$query          = "SELECT * FROM patient_data where pid=?";
$pat_data       =  sqlQuery($query, array($pid));

$tm_duration    = $obj['tm_duration'];
$tm_subj        = $obj['tm_subj'];
$tm_obj         = $obj['tm_obj'];
$tm_imp         = $obj['tm_imp'];
$tm_plan        = $obj['tm_plan'];
$tm_provider    = $obj['provider_id'];

$dated          = new DateTime($obj['encounter_date']);
$dated          = $dated->format('Y-m-d');
$visit_date     = oeFormatShortDate($dated);

$query          = "select * from openemr_postcalendar_events where pc_pid=? and pc_eventDate like ?";
$appt           = sqlQuery($query, array($pid, $obj['date']));

$query          = "SELECT * FROM users where id = ?";
$prov_data      = sqlQuery($query, array($tm_provider));

?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <?php Header::setupHeader(''); ?>
    
    <?php
        if (($GLOBALS['medex_enable'] == '1')) {
            $logged_in = $MedEx->login('1');
            $data['pid']            = $pid;
            $data['providerID']     = $_SESSION['authUserID'];
            $data['eid']            = $appt['pc_eid'];
            $data['appt']           = $appt;
            $data['token']          = $logged_in['token'];
            $data['pat_fname']      = $pat_data['fname'];
            $data['pat_lname']      = $pat_data['lname'];
            $data['pat_email']      = $pat_data['email'];
            $data['pat_mobile']     = $pat_data['mobile'];
            $data['pat_allowemail'] = $pat_data['hipaa_allowemail'];
            $data['pat_allowsms']   = $pat_data['hipaa_allowsms'];
            
            $TM = $MedEx->display->TM_bot($logged_in, $data);
        
        } else {
            $token = openssl_random_pseudo_bytes(4);
            $token = bin2hex($token);
            //Brady: add a global to link to other tele-providers like Doxy.me or Zoom?
            //For now this links to public servers jitsi-meet  maintainers server.
            //Room must be locked to be HIPAA compliant.
            $TM['url_provider'] = 'https://meet.jit.si/'.$token;
            $TM['url_patient'] = 'https://meet.jit.si/'.$token;
            $TM['label_url_patient'] = 'https://meet.jit.si/'.$token;
            $TM['label_service_url'] = 'Open Jitsi-Meet'; //xlt below
        }

        $visit_header = xlt("TeleHealth Visit");
        
        $arrOeUiSettings = array(
            'heading_title' => xl($visit_header),
            'include_patient_name' => false,// use only in appropriate pages
            'expandable' => false,
            'expandable_files' => array(),//all file names need suffix _xpd
            'action' => "",//conceal, reveal, search, reset, link or back
            'action_title' => "",
            'action_href' => "",//only for actions - reset, link or back
            'show_help_icon' => false,
            'help_file_name' => "Tele_help.php"
        );
        //var_dump($TM);die();
        $oemr_ui = new OemrUI($arrOeUiSettings);
    ?>
    <style>
        .numberCircle {
            display:inline-block;
            line-height:0px;
            border-radius:50%;
            border:1px solid;
            font-size:10px;
        }

        .numberCircle span {
            display:inline-block;
            padding-top:50%;
            padding-bottom:50%;
            margin-left:6px;
            margin-right:6px;
        }
        .blink {
            animation: blinker 0.9s linear infinite;
            color: red; more:#1c87c9;
            font-weight: bold;
        }
        @keyframes blinker {
            50% { opacity: 0; }
        }
        .blink-one {
            animation: blinker-one 1s linear infinite;
        }
        @keyframes blinker-one {
            0% { opacity: 0; }
        }
        .blink-two {
            animation: blinker-two 3s linear infinite;
        }
        @keyframes blinker-two {
            100% { opacity: 0; }
        }
        .underline {
            text-decoration: underline;
        }

        
        table th, table td{
            padding: 10px; /* Apply cell padding */
        }

    </style>
</head>

<body class="body_top">
    <br /><br />
    <div id="container_div" class="<?php echo attr($oemr_ui->oeContainer()); ?>">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-header clearfix">
                    <?php echo  $oemr_ui->pageHeading() . "\r\n"; ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="text-center col-sm-6">
                <form method='post' name='tm_form' action='<?php echo $rootdir."/forms/telemed/save.php?id=" . attr_url($formid); ?>'>
                    <input type="hidden" name="csrf_token_form" id="csrf_token_form" value="<?php echo attr(CsrfUtils::collectCsrfToken()); ?>" />
                    <div class="card card-body bg-light text-center">
                        <div class="card-text">
                            <table id="printableArea"
                                    border="0"
                                    cellspacing="10"
                                    cellpadding="10"
                                    border='0'
                                    style='width:100%;
                                    min-width:250px;
                                    white-space: nowrap;
                                    box-shadow: 0px 4px 48px #8080805c;
                                    margin:0px auto;
padding:10px;'>
                                <tr>
                                    <td align="left"><?php echo xlt('Patient'); ?>:</td>
                                    <td>
                                        <label> <?php
                                                if (is_numeric($pid)) {
                                                    $result = getPatientData($pid, "fname,lname,squad");
                                                    echo text($result['fname'])." ".text($result['lname']);
                                                }
                                                $patient_name=($result['fname'])." ".($result['lname']);
                                            ?>
                                        </label>
                                        <?php echo xlt('DOB'); ?>:
                                        <label class="forms-data"> <?php if (is_numeric($pid)) {
                                                $result = getPatientData($pid, "*");
                                                echo text($result['DOB']);
                                            }
                                                $dob=($result['DOB']);
                                            ?>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="text-right"><?php echo xlt('Duration'); ?>:</td>
                                    <td><input type="text"
                                               id="duration"
                                               name="tm_duration"
                                               class="small"
                                               placeholder="<?php echo xla('Visit duration '); ?>"
                                               value="<?php echo attr($tm_duration); ?>">
                                        <span class="btn btn-primary" onclick="timer();" id="startT"><?php echo xlt('Start'); ?></span>
                                        <span class="btn btn-primary" id="stop"><?php echo xlt('Stop'); ?></span>
                                        <span class="btn btn-primary" id="clear"><?php echo xlt('Reset'); ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="text-right" class="forms"><?php echo xlt('Subjective'); ?>:</td>
                                    <td class="forms">
                                        <textarea type="text"  rows="1" cols="40"
                                                  name="tm_subj"
                                                  class=" form-control"
                                                  id="subjective"><?php echo text($obj['subjective']);?><?php echo text($tm_subj); ?></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="text-right" class="forms"><?php echo xlt('Objective'); ?>:</td>
                                    <td class="forms">
                                        <textarea type="text"  rows="2" cols="40"
                                                  name="tm_obj"
                                                  class=" form-control"
                                                  id="objective"><?php echo text($obj['objective']);?><?php echo text($tm_obj); ?></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="text-right" class="forms"><?php echo xlt('Impression'); ?>:</td>
                                    <td class="forms">
                                        <textarea type="text" rows="3" cols="40"
                                                  name="tm_imp"
                                                  class=" form-control"
                                                  id="assessment"><?php echo text($obj['assessment']);?><?php echo text($tm_imp); ?></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="text-right" class="forms"><?php echo xlt('Plan'); ?>:</td>
                                    <td class="forms">
                                        <textarea type="text" rows="3" cols="40"
                                                  class=" form-control"
                                                  name="tm_plan"
                                                  id="plan"><?php echo text($obj['plan']);?><?php echo text($tm_plan); ?></textarea>
                                    </td>
                                </tr>
                                <tr><td align="center" colspan="2"><button class="btn btn-primary" style="float:unset;" id="save"><?php echo xlt('Save');?></button>
                                        </td></tr>
                            </table>
    
                        </div>
                    </div>
                </form>
            </div>
            <div class="text-left col-sm-6">
                <div class="card card-body bg-light text-center">
                    <div class="card-text text-center">
                        <table cellspacing="10"
                               cellpadding="10"
                               border='0'
                               style='width:100%;
                                      min-width:400px;
                                      white-space: nowrap;
                                      box-shadow: 0px 4px 48px #8080805c;
                                      margin:0px auto;'>
                            <tr>
                                <td class="text-center" colspan="2" style="vertical-align: middle;">
                                    <h4 class="underline">Provider DashBoard</h4>
                                    <div>
                                    <span class="btn btn-primary"
                                            onclick="window.open('<?php echo $TM['url_provider']; ?>', '_blank', '');">
                                        <i class=" fa fa-user-md"></i>
                                        <?php echo $TM['label_service_url']; ?>
                                    </span>
                                    </div>
                                </td>
                            </tr>
                            
                            <tr>
                                <td class='text-center bold' colspan="2">
                                    <u class="oe-bold-black underline red"><u>Off-site Provider Access</u></span>
                                </td>
                            </tr>
                            <tr>
                                <td class='text-right bold' style="vertical-align: middle;">URL:</td>
                                <td> https://medexbank.com/login.php</td>
                            </tr>
                            <tr>
                                <td class='text-right bold' style="vertical-align: baseline;">Username:
                                </td>
                                <td><span id="P_email"><?php echo $TM['P_email']; ?></span></td>
                            </tr>
                        </table>
                        
                    </div>
                </div>
<br />
                <div class="card card-body bg-light text-center">
                    <div class="card-text" id="TM_dashboard">
                        <div class="borderShadow">
                            <table cellspacing="10"
                                   cellpadding="10"
                                   border='0'
                                   style='width:100%;
                                      min-width:400px;
                                      white-space: nowrap;
                                      box-shadow: 0px 4px 48px #8080805c;
                                      margin:0px auto;'>
                                <tr style="padding-top:20px;">
                                    <td class='text-center'
                                        colspan='2'
                                        style="vertical-align: middle;">
                                        <h4 class="underline">Patient Waiting Room</h4>
                                        
                                        <p>
                                        <?php echo $TM['url_patient']; ?>
                                        <i class="fa fas fa-copy js-copy-pat-btn" title="Click to copy to clipboard"></i>
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-center">
                                        <span id="dashBoard_data"><span id="waiting_indicator">
                                            <i class="fa fa-spinner fa-spin"></i>
                                        </span></span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $oemr_ui->oeBelowContainerDiv();?>
    <?php
        //home of the help modal ;)
        //$GLOBALS['enable_help'] = 0; // Please comment out line if you want help modal to function on this page
        if ($GLOBALS['enable_help'] == 1) {
            // echo "<script>var helpFile = 'telemed_help.php'</script>";
            // help_modal.php lives in interface, set path accordingly
            require "../../help_modal.php";
        }
    ?>

</body>
<script>
    function copyTextToClipboard(text) {
        if (!navigator.clipboard) {
            fallbackCopyTextToClipboard(text);
            return;
        }
        navigator.clipboard.writeText(text).then(function() {
            alert('<?php echo xla('Patient URL copied to clipboard!'); ?>');
        }, function(err) {
            console.error('Async: Could not copy text: ', err);
        });
    }

    var copyPatBtn = document.querySelector('.js-copy-pat-btn');
    copyPatBtn.addEventListener('click', function(event) {
        copyTextToClipboard('<?php echo $TM['url_patient']; ?>');
    });

    var timing = 0;
    var duration = document.getElementById('duration'),
        startT = document.getElementById('startT'),
        stop = document.getElementById('stop'),
        clear = document.getElementById('clear'),
        seconds = 0, minutes = 0, hours = 0,
        t;

    function add() {
        seconds++;
        if (seconds >= 60) {
            seconds = 0;
            minutes++;
            if (minutes >= 60) {
                minutes = 0;
                hours++;
            }
        }

        duration.value = (hours ? (hours > 9 ? hours : "0" + hours) : "00") + ":" + (minutes ? (minutes > 9 ? minutes : "0" + minutes) : "00") + ":" + (seconds > 9 ? seconds : "0" + seconds);

        timer();
    }
    function timer() {
        //alert('timer started');
        t = setTimeout(add, 1000);
    }

    /* Stop button */
    stop.onclick = function() {
        clearTimeout(t);
    }

    /* Clear button */
    clear.onclick = function() {
        duration.value = "00:00:00";
        seconds = 0; minutes = 0; hours = 0;
    }

    function printDiv(divname)
    {
        var printContents = document.getElementById(divname).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = originalContents;
        window.print();
    }
    <?php require_once "$srcdir/restoreSession.php"; ?>

    function refreshTable(pid,timing='') {
        top.restoreSession();
    
        if (timing < 300000) {
            timing = timing + 5000;
        }
    
        $.ajax({
                   type: "POST",
                   url: "../../forms/telemed/save.php",
                   data: {
                       r            : '1',
                       pid          : '<?php echo $pid; ?>',
                       provider_id  : '<?php echo $tm_provider; ?>',
                       go           : 'TM_bot',
                       msg          : 'TM_refresh',
                       eid          : '<?php echo $appt['pc_eid']; ?>',
                       csrf_token_form : $("#csrf_token_form").val()
                   },
               }).done(function(result){
                   obj = JSON.parse(result);
                   $('#dashBoard_data').html(obj.dashBoard);
                    $('#waiting_indicator').html(obj.waiting_indicator);
                    $('#P_email').html(obj.P_email);
                    var d = $('#dashBoard_data');
                    d.scrollTop(d.prop("scrollHeight"));
                    setTimeout(function(){
                        refreshTable(pid,timing);
                    }, timing);
                });
    }

    $(function () {
        refreshTable('<?php echo $data['pid'];?>',timing);
        //consider adding class nodisplay
        $( "ul.navbar-nav" ).children().click(function(){
            $(".collapse").collapse('hide');
        });
    });

</script>
</html>