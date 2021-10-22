<?php

require_once("../../globals.php");
require_once("$srcdir/api.inc");

use OpenEMR\Core\Header;

formHeader("Form: individual_treatment_plan");
?>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <?php Header::setupHeader(); ?>
</head>
<body class='body_top'>
<div class="container" id="container_div">
    <form method=post action="<?php echo $rootdir;?>/forms/individual_treatment_plan/save.php?mode=new" name="my_form">
        <br />
        <span class="title"><center>Individual Treatment Plan</center></span><br /><br />
        <center><a href="javascript:top.restoreSession();document.my_form.submit();" class="btn btn-primary">Save</a>
        <img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="5" height="1">
        <a href="<?php echo $GLOBALS['form_exit_url']; ?>" class="btn btn-secondary" onclick="top.restoreSession()">Cancel</a></center>
        <br />

        <?php $res = sqlStatement("SELECT fname,mname,lname,ss,street,city,state,postal_code,phone_home,DOB FROM patient_data WHERE pid = ?", array($pid));
        $result = SqlFetchArray($res); ?>

        <b>Date of Referral:</b>&nbsp;<input type="text" name="date_of_referal">
        <img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="260" height="1">
        <b>Date of Plan:</b>&nbsp; <?php print text(date('m/d/y')); ?><br /><br />

        <img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="28" height="1">
        <b>Client Name:</b>&nbsp; <?php echo text($result['fname']) . '&nbsp' . text($result['mname']) . '&nbsp;' . text($result['lname']); ?>
        <img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="292" height="1">
        <b>DCN:</b>
        <img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="1" height="1">
        <input type="text" name="dcn"> <br /><br />

        <b>Modality:</b> <br>
        <input type="checkbox" name="individual"> Individual<br>
        <input type="checkbox" name="family"> Family<br>
        <input type="checkbox" name="couple"> Couple<br><br>
        <b>Patient Strengths:</b><br />
        <textarea cols=85 rows=2 wrap=virtual name="diagnosis_description" ></textarea><br /><br />

        <b>Patient Challenges:</b><br />
        <textarea cols=85 rows=3 wrap=virtual name="presenting_problem" ></textarea><br /><br />

        <b>PROBLEM LIST</b>
        <table class="table" border="1">
        <tr>
            <td></td><td align="center">Person's Condition</td><td align="center">No Significant Changes Reported or Observed</td><td align="center">Notable</td><td align="center">Changes in Person's Condition</td>
        </tr>
        <tr>
            <td>#1</td><td> <textarea name=""></textarea></td><td><textarea name=""></textarea></td><td><textarea name=""></textarea></td><td><textarea name=""></textarea></td>
        </tr>
        <tr>
            <td>#2</td><td> <textarea name=""></textarea></td><td><textarea name=""></textarea></td><td><textarea name=""></textarea></td><td><textarea name=""></textarea></td>
        </tr>
        <tr>
            <td>#3</td><td> <textarea name=""></textarea></td><td><textarea name=""></textarea></td><td><textarea name=""></textarea></td><td><textarea name=""></textarea></td>
        </tr>
        <tr>
            <td colspan="5"></td>
        </tr>

        </table>
        <br><br>
        <div id="goals" style="padding-bottom: 30px">
            <strong>Goal(s) Addressed as Per Individualized Action Plan:</strong>
        </div>
        <div class="longtermgoal1">
        <b>Long Term Goal #1:</b><br /><hr>
        <textarea cols=185 rows=3 wrap=virtual name="long_term_goals" ></textarea><br /><br />
        </div>
        <div id="goal_tables">
            <table class="table">
                <tr>
                    <th>Objective/Short Term Goals:</th><th>Intervention</th><th>Target Date</th>
                </tr>
                <tr>
                    <td><input type="text" name="intervention_1" size="52" maxlength="80"></td>
                    <td><input type="text" name="intervention_1" size="52" maxlength="80"></td>
                    <td><input type="text" name="intervention_1" size="12" maxlength="80"></td>
                </tr>
                <tr>
                    <td><input type="text" name="intervention_1" size="52" maxlength="80"></td>
                    <td><input type="text" name="intervention_1" size="52" maxlength="80"></td>
                    <td><input type="text" name="intervention_1" size="12" maxlength="80"></td>
                </tr>
                <tr>
                    <td><input type="text" name="intervention_1" size="52" maxlength="80"></td>
                    <td><input type="text" name="intervention_1" size="52" maxlength="80"></td>
                    <td><input type="text" name="intervention_1" size="12" maxlength="80"></td>
                </tr>
            </table>
        </div>

        <b>Long Term Goals #2:</b><br /><hr>
        <textarea cols=85 rows=3 wrap=virtual name="long_term_goals" ></textarea><br /><br />
        <b>Objective/Short Term Goals:</b>
        <div class="longtermgals2">
            <table class="table">
                <tr>
                    <th>Objective/Short Term Goals:</th><th>Intervention</th><th>Target Date</th>
                </tr>
                <tr>
                    <td><input type="text" name="intervention_1" size="52" maxlength="80"></td>
                    <td><input type="text" name="intervention_1" size="52" maxlength="80"></td>
                    <td><input type="text" name="intervention_1" size="12" maxlength="80"></td>
                </tr>
                <tr>
                    <td><input type="text" name="intervention_1" size="52" maxlength="80"></td>
                    <td><input type="text" name="intervention_1" size="52" maxlength="80"></td>
                    <td><input type="text" name="intervention_1" size="12" maxlength="80"></td>
                </tr>
                <tr>
                    <td><input type="text" name="intervention_1" size="52" maxlength="80"></td>
                    <td><input type="text" name="intervention_1" size="52" maxlength="80"></td>
                    <td><input type="text" name="intervention_1" size="12" maxlength="80"></td>
                </tr>
            </table>
        </div>
        <img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="162" height="1">
        <b>Target Date:</b><br />
        <input type="text" name="short_term_goals_1" size="42" maxlength="40">
        <img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="6" height="1">
        <input type="text" name="time_frame_1" size="16" maxlength="15"><br />

        <input type="text" name="short_term_goals_2" size="42" maxlength="40">
        <img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="6" height="1">
        <input type="text" name="time_frame_2" size="16" maxlength="15"><br />

        <input type="text" name="short_term_goals_3" size="42" maxlength="40">
        <img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="6" height="1">
        <input type="text" name="time_frame_3" size="16" maxlength="15"><br /><br />

        <b>Long Term Goals #3:</b><br /><hr>
        <textarea cols=85 rows=3 wrap=virtual name="long_term_goals" ></textarea><br /><br />
        <b>Objective/Short Term Goals:</b>
        <img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="162" height="1">
        <b>Target Date:</b><br />
        <input type="text" name="short_term_goals_1" size="42" maxlength="40">
        <img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="6" height="1">
        <input type="text" name="time_frame_1" size="16" maxlength="15"><br />

        <input type="text" name="short_term_goals_2" size="42" maxlength="40">
        <img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="6" height="1">
        <input type="text" name="time_frame_2" size="16" maxlength="15"><br />

        <input type="text" name="short_term_goals_3" size="42" maxlength="40">
        <img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="6" height="1">
        <input type="text" name="time_frame_3" size="16" maxlength="15"><br /><br />

        <b>Discharge Criteria:</b><br />
        <textarea cols=85 rows=2 wrap=virtual name="discharge_criteria" ></textarea><br /><br />


        <b>Referral to:</b><br />
        <input type="checkbox" name="individual_family_therapy">&nbsp;<b>Parenting/Skills Training</b></input><br>

        <input type="checkbox" name="substance_abuse">&nbsp;<b>Substance Abuse</b></input><br />

        <input type="checkbox" name="group_therapy">&nbsp;<b>Group Therapy - psychoeducational group</b></input><br>

        <input type="checkbox" name="parenting">&nbsp;<b>Inpatient / Hospital Mental Health Crisis Intervention</b></input><br /><br />

        <input type="checkbox" name="other">&nbsp;<b>Other:  </b></input><input type="text" name="other" size="50"><br /><br />

        <b>ICD/9/CM Code:</b>&nbsp;<input type="text" name="icd9">

        <br /><br />
        <center><a href="javascript:top.restoreSession();document.my_form.submit();" class="btn btn-primary">Save</a>
        <img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="5" height="1">
        <a href="<?php echo $GLOBALS['form_exit_url']; ?>" class="btn btn-secondary" onclick="top.restoreSession()">Cancel</a></center>
        <br />
    </form>
</div>
<?php
formFooter();
?>
