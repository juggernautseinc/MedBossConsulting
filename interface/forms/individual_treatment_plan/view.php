<?php

require_once("../../globals.php");
require_once("$srcdir/api.inc");

use OpenEMR\Core\Header;

formHeader("Form: individual_treatment_plan");

$obj = formFetch("form_individual_treatment_plan", $_GET["id"]);
$values = json_decode($obj['long_term_goals'], true);
?>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <?php Header::setupHeader(); ?>
</head>
<body class='body_top'>
<div class="container" id="container_div">
    <form method=post action="<?php echo $rootdir;?>/forms/individual_treatment_plan/save.php?mode=update" name="my_form">
        <input type="hidden" name="id" value="<?php print $_GET['id'] ?>">
        <br />
        <h2><center>Individual Treatment Plan</center></h2><br />
        <center><a href="javascript:top.restoreSession();document.my_form.submit();" class="btn btn-primary">Save</a>
            <img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="5" height="1">
            <a href="<?php echo $GLOBALS['form_exit_url']; ?>" class="btn btn-secondary" onclick="top.restoreSession()">Cancel</a></center>
        <br />

        <b>Modality:</b> <br>
        <input type="checkbox" name="individual" value="1" <?php if($values['individual']) { print "checked"; } ?>> Individual<br>
        <input type="checkbox" name="family" value="1" <?php if($values['individual']) { print "checked"; } ?>> Family<br>
        <input type="checkbox" name="couple" value="1" <?php if($values['individual']) { print "checked"; } ?>> Couple<br><br>
        <b>Patient Strengths:</b><br />
        <textarea cols=85 rows=2 wrap=virtual name="diagnosis_description" ><?php print $values['diagnosis_description']; ?></textarea><br /><br />

        <b>Patient Challenges:</b><br />
        <textarea cols=85 rows=3 wrap=virtual name="presenting_problem" ><?php print $values['presenting_problem']; ?></textarea><br /><br />

        <b>PROBLEM LIST</b>
        <table class="table" border="1">
            <tr>
                <td></td><td align="center">Person's Condition</td><td align="center">No Significant Changes Reported or Observed</td><td align="center">Notable</td><td align="center">Changes in Person's Condition</td>
            </tr>
            <tr>
                <td>#1</td>
                <td> <textarea name="personcondition1"><?php print $values['personcondition1']; ?></textarea></td>
                <td><textarea name="nscro1"><?php print $values['nscro1']; ?></textarea></td>
                <td><textarea name="notable1"><?php print $values['notable1']; ?></textarea></td>
                <td><textarea name="cipc1"><?php print $values['cipc1']; ?></textarea></td>
            </tr>
            <tr>
                <td>#2</td>
                <td><textarea name="personcondition2"><?php print $values['personcondition2']; ?></textarea></td>
                <td><textarea name="nscro2"><?php print $values['nscro2']; ?></textarea></td>
                <td><textarea name="notable2"><?php print $values['notable2']; ?></textarea></td>
                <td><textarea name="cipc2"><?php print $values['cipc2']; ?></textarea></td>
            </tr>
            <tr>
                <td>#3</td>
                <td> <textarea name="personcondition3"><?php print $values['personcondition3']; ?></textarea></td>
                <td><textarea name="nscro3"><?php print $values['nscro3']; ?></textarea></td>
                <td><textarea name="notable3"><?php print $values['notable3']; ?></textarea></td>
                <td><textarea name="cipc1"><?php print $values['cipc1']; ?></textarea></td>
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
            <textarea cols=85 rows=3 wrap=virtual name="long_term_goals1" ><?php print $values['long_term_goals1']; ?></textarea><br /><br />
        </div>
        <div id="goal_tables">
            <table class="table">
                <tr>
                    <th>Objective/Short Term Goals:</th><th>Intervention</th><th>Target Date</th>
                </tr>
                <tr>
                    <td><input type="text" name="shorttermgoals_1" size="52" maxlength="80" value="<?php print $values['shorttermgoals_1']; ?>"></td>
                    <td><input type="text" name="shorttermgoals_2" size="52" maxlength="80" value="<?php print $values['shorttermgoals_2']; ?>"></td>
                    <td><input type="text" name="shorttermgoals_3" size="12" maxlength="80" value="<?php print $values['shorttermgoals_3']; ?>"></td>
                </tr>
                <tr>
                    <td><input type="text" name="intervention_1" size="52" maxlength="80" value="<?php print $values['intervention_1']; ?>"></td>
                    <td><input type="text" name="intervention_2" size="52" maxlength="80" value="<?php print $values['intervention_2']; ?>"></td>
                    <td><input type="text" name="intervention_3" size="12" maxlength="80" value="<?php print $values['intervention_3']; ?>"></td>
                </tr>
                <tr>
                    <td><input type="text" name="targetdate_1" size="52" maxlength="80" value="<?php print $values['targetdate_1']; ?>"></td>
                    <td><input type="text" name="targetdate_1" size="52" maxlength="80" value="<?php print $values['targetdate_1']; ?>"></td>
                    <td><input type="text" name="targetdate_1" size="12" maxlength="80" value="<?php print $values['targetdate_1']; ?>"></td>
                </tr>
            </table>
        </div>
        <div id="longtermgoal2">
            <b>Long Term Goals #2:</b><br /><hr>
            <textarea cols=85 rows=3 wrap=virtual name="long_term_goals2" ><?php print $values['long_term_goals2']; ?></textarea><br /><br />
        </div>

        <div class="shorttermgoals2">
            <table class="table">
                <tr>
                    <th>Objective/Short Term Goals:</th><th>Intervention</th><th>Target Date</th>
                </tr>
                <tr>
                    <td><input type="text" name="shorttermgoals_11" size="52" maxlength="80" value="<?php print $values['shorttermgoals_11']; ?>"></td>
                    <td><input type="text" name="shorttermgoals_22" size="52" maxlength="80" value="<?php print $values['shorttermgoals_22']; ?>"></td>
                    <td><input type="text" name="shorttermgoals_33" size="12" maxlength="80" value="<?php print $values['shorttermgoals_33']; ?>"></td>
                </tr>
                <tr>
                    <td><input type="text" name="intervention_11" size="52" maxlength="80" value="<?php print $values['intervention_11']; ?>"></td>
                    <td><input type="text" name="intervention_22" size="52" maxlength="80" value="<?php print $values['intervention_22']; ?>"></td>
                    <td><input type="text" name="intervention_33" size="12" maxlength="80" value="<?php print $values['intervention_33']; ?>"></td>
                </tr>
                <tr>
                    <td><input type="text" name="targetdate_11" size="52" maxlength="80" value="<?php print $values['targetdate_11']; ?>"></td>
                    <td><input type="text" name="targetdate_22" size="52" maxlength="80" value="<?php print $values['targetdate_22']; ?>"></td>
                    <td><input type="text" name="targetdate_33" size="12" maxlength="80" value="<?php print $values['targetdate_33']; ?>"></td>
                </tr>
            </table>
        </div>
        <div class="longtermgoals3">
            <b>Long Term Goals #3:</b><br /><hr>
            <textarea cols=85 rows=3 wrap=virtual name="long_term_goals3" ><?php print $values['long_term_goals3']; ?></textarea><br /><br />
        </div>
        <div id="shorttermgoals3">
            <table class="table">
                <tr>
                    <th>Objective/Short Term Goals:</th><th>Intervention</th><th>Target Date</th>
                </tr>
                <tr>
                    <td><input type="text" name="shorttermgoals_111" size="52" maxlength="80" value="<?php print $values['shorttermgoals_111']; ?>"></td>
                    <td><input type="text" name="shorttermgoals_222" size="52" maxlength="80" value="<?php print $values['shorttermgoals_222']; ?>"></td>
                    <td><input type="text" name="shorttermgoals_333" size="12" maxlength="80" value="<?php print $values['shorttermgoals_333']; ?>"></td>
                </tr>
                <tr>
                    <td><input type="text" name="intervention_111" size="52" maxlength="80" value="<?php print $values['intervention_111']; ?>"></td>
                    <td><input type="text" name="intervention_222" size="52" maxlength="80" value="<?php print $values['intervention_222']; ?>"></td>
                    <td><input type="text" name="intervention_333" size="12" maxlength="80" value="<?php print $values['intervention_333']; ?>"></td>
                </tr>
                <tr>
                    <td><input type="text" name="targetdate_111" size="52" maxlength="80" value="<?php print $values['targetdate_111']; ?>"></td>
                    <td><input type="text" name="targetdate_222" size="52" maxlength="80" value="<?php print $values['targetdate_222']; ?>"></td>
                    <td><input type="text" name="targetdate_333" size="12" maxlength="80" value="<?php print $values['targetdate_333']; ?>"></td>
                </tr>
            </table>
        </div>
        <b>Discharge Criteria:</b><br />
        <textarea cols=85 rows=2 wrap=virtual name="discharge_criteria" ><?php print $values['discharge_criteria']; ?></textarea><br /><br />


        <b>Referral to:</b><br />
        <input type="checkbox" name="individual_family_therapy" value="1" <?php if($values['individual_family_therapy']) { print "checked"; } ?>>&nbsp;<b>Parenting/Skills Training</b></input><br>
        <input type="checkbox" name="substance_abuse" value="1" <?php if($values['substance_abuse']) { print "checked"; } ?>>&nbsp;<b>Substance Abuse</b></input><br />
        <input type="checkbox" name="group_therapy" value="1" <?php if($values['group_therapy']) { print "checked"; } ?>>&nbsp;<b>Group Therapy - psychoeducational group</b></input><br>
        <input type="checkbox" name="parenting" value="1" <?php if($values['parenting']) { print "checked"; } ?>>&nbsp;<b>Inpatient / Hospital Mental Health Crisis Intervention</b></input><br /><br />
        <input type="checkbox" name="other" value="1" <?php if($values['other']) { print "checked"; } ?>>&nbsp;<b>Other: </b>
        <input type="text" name="other" size="50" value="<?php print $values['other']; ?>"><br /><br />

        <br /><br />
        <h4 >Action Steps by supports - family:</h4>
        <textarea cols=85 rows=2 wrap=virtual name="action_steps" ><?php print $values['action_steps']; ?></textarea><br /><br />
        <br /><br />
        <table class="table">
            <tr>
                <td><h4>Other supports - agencies Name:</h4></td><td><h4>Contact Information</h4></td>
            </tr>
            <tr>
                <td><input type="text" name="supportagencies1" style="width:390px" value="<?php print $values['supportagencies1']; ?>"></td>
                <td><input type="text" name="contactinfo1" style="width:390px" value="<?php print $values['contactinfo1']; ?>"></td>
            </tr>
            <tr>
                <td><input type="text" name="supportagencies2" style="width:390px" value="<?php print $values['supportagencies2']; ?>"></td>
                <td><input type="text" name="cantactinfo2" style="width:390px" value="<?php print $values['cantactinfo2']; ?>"></td>
            </tr>

        </table>
        <center><a href="javascript:top.restoreSession();document.my_form.submit();" class="btn btn-primary">Save</a>
            <img src="<?php echo $GLOBALS['images_static_relative'];?>/space.gif" width="5" height="1">
            <a href="<?php echo $GLOBALS['form_exit_url']; ?>" class="btn btn-secondary" onclick="top.restoreSession()">Cancel</a></center>
        <br />
    </form>
</div>
<?php
formFooter();
?>
