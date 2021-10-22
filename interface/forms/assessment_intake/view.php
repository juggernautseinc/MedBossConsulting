<?php

/*
 *  package   OpenEMR
 *  link      http://www.open-emr.org
 *  author    Sherwin Gaddis <sherwingaddis@gmail.com>
 *  copyright Copyright (c )2021. Sherwin Gaddis <sherwingaddis@gmail.com>
 *  license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 *
 */

require_once("../../globals.php");
require_once("../../../library/api.inc");

use OpenEMR\Common\Csrf\CsrfUtils;
use OpenEMR\Core\Header;

$form_id = $_GET['id'];
$obj = "SELECT * FROM form_assessment_intake WHERE id = ?";
$getData = sqlFetchArray(sqlStatement($obj, [$form_id]));
$formData = json_decode($getData["personal_strengths"], true);
/*echo "<pre>";
var_dump($formData);
echo "</pre>";*/
?>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <?php Header::setupHeader(); ?>
    <title><?php echo xlt("Assessment Intake Form"); ?></title>
</head>
<body class='body_top'>
<div id="container_div" class="container">
    <form method="post" action="<?php echo $rootdir;?>/forms/assessment_intake/save.php?mode=update" name="my_form">
        <input type="hidden" name="csrf_token_form" value="<?php echo attr(CsrfUtils::collectCsrfToken()); ?>" />
        <input type="hidden" name="id" value="<?php echo attr($form_id); ?>">
        <br />
        <h3 class="title text-center"> Intake and Clinical Summary</h3>
        <div class="text-center">
            <a href="javascript:top.restoreSession();document.my_form.submit();" class="btn btn-primary"><?php echo xlt("Save"); ?></a>
            <a href="<?php echo $GLOBALS['form_exit_url']; ?>" class="btn btn-secondary" onclick="top.restoreSession()"><?php echo xlt("Don't Save"); ?></a>
        </div>
        <br />
        <div class="form-group">
            <label class="font-weight-bold">Referral Source:</label>
            <input type="text" class="form-control" name="referral_source" value="<?php echo $formData['referral_source']?>"/>
        </div>
        <p class="font-weight-bold">Purpose:</p>
        <div >
            <input type="checkbox"  name='new_client_eval' <?php if ($formData['new_client_eval']) { echo "checked"; }?>/>
            <label for 'new client evaluation'>New client evaluation</label>
        </div>
        <div >
            <input type="checkbox"  name='consultation' <?php if ($formData['consultation']) { echo "checked"; }?>/>
            <label for "consultation" >Consultation</label>
        </div>
        <div >
            <input type="checkbox"  name='annual' <?php if ($formData['annual']) { echo "checked"; }?>/>
            <label for 'Annual Update'>Annual Update</label>
        </div><br>


        <div class="form-group">
            <label class="font-weight-bold">Copy sent to:</label>
            <input type="text" class="form-control" name="copy_sent_to" value="<?php echo $formData['copy_sent_to']?>"/>
        </div><br>

        <div class="form-group">
            <label class="font-weight-bold"> Goals and treatment expectations of the patient:</label>
            <textarea class="form-control" cols="100" rows="3" wrap="virtual" name="treatment"><?php echo $formData['treatment']?></textarea><br>


            <h5 class="font-weight-bold mt-3": underline;"AREAS OF FUNCTIONING"</h5>
            <h4 class="title text-center"> AREAS OF FUNCTIONING</h4>

            <div class="form-group">
                <label class="font-weight-bold">How is School/Work impacted by current condition?</label>
                <textarea class="form-control" cols="100" rows="3" wrap="virtual" name="school_work"><?php echo $formData['school_work']?></textarea>
            </div><br>


            <div class="form-group">
                <label class="font-weight-bold">How are Personal and Family Relationships (Intimate) impacted?</label>
                <textarea class="form-control" cols="100" rows="4" wrap="virtual" name="personal_relationships"><?php echo $formData['personal_relationships']?></textarea>
            </div><br>


            <div class="form-group">
                <label class="font-weight-bold">Other?</label>
                <textarea class="form-control" cols="100" rows="4" wrap="virtual" name="other"><?php echo $formData['other']?></textarea>
            </div><br>


            <h4 class="title text-center"> CLINCAL FINDINGS</h4>

            <div class="form-group">
                <label class="font-weight-bold">Clinical Summary:</label>
                <textarea class="form-control" cols="100" rows="10" wrap="virtual" name="summary"><?php echo $formData['summary']?></textarea>
            </div>


            <h5 class="font-weight-bold mt-3" style="text-decoration: underline;">Diagnoses</h5>
            <div class="form-group">
                <label class="font-weight-bold">Axis I:</label>
                <textarea class="form-control" cols="100" rows="3" wrap="virtual" name="axis1"><?php echo $formData['axis1']?></textarea>
            </div>
            <div class="form-group">
                <label class="font-weight-bold">Axis II:</label>
                <textarea class="form-control" cols="100" rows="3" wrap="virtual" name="axis2"><?php echo $formData['axis2']?></textarea>
            </div>
            <div class="form-group">
                <label class="font-weight-bold">Axis III:</label>
                <textarea class="form-control" cols="100" rows="3" wrap="virtual" name="axis3"><?php echo $formData['axis3']?></textarea>
            </div>

            <p class="font-weight-bold">Axis IV Psychosocial and environmental problems in the last year:</p>
            <div >
                <input type="checkbox" name='ax4_prob_support_group' <?php if ($formData['ax4_prob_support_group']) { echo "checked"; } ?>/>
                <label >Problems with primary support group</label>
            </div>
            <div >
                <input type="checkbox" name='ax4_prob_soc_env' <?php if ($formData['ax4_prob_soc_env']) { echo "checked"; } ?>/>
                <label >Problems related to the social environment</label>
            </div>
            <div >
                <input type="checkbox" name='ax4_educational_prob' <?php if ($formData['ax4_educational_prob']) { echo "checked"; } ?>/>
                <label >Educational problems</label>
            </div>
            <div >
                <input type="checkbox" name='ax4_occ_prob' <?php if ($formData['ax4_occ_prob']) { echo "checked"; } ?>/>
                <label >Occupational problems</label>
            </div>
            <div >
                <input type="checkbox" name='ax4_housing' <?php if ($formData['ax4_housing']) { echo "checked"; } ?>/>
                <label >Housing problems</label>
            </div>
            <div >
                <input type="checkbox" name='ax4_economic' <?php if ($formData['ax4_economic']) { echo "checked"; } ?>/>
                <label >Economic problems</label>
            </div>
            <div >
                <input type="checkbox" name='ax4_access_hc' <?php if ($formData['ax4_access_hc']) { echo "checked"; } ?>/>
                <label >Problems with access to health care services</label>
            </div>
            <div >
                <input type="checkbox" name='ax4_legal' <?php if ($formData['ax4_legal']) { echo "checked"; } ?>/>
                <label >Problems related to interaction with the legal system/crime</label>
            </div>
            <div class="form-inline">
                <div >
                    <input type="checkbox" name='ax4_other_cb' <?php if ($formData['ax4_other_cb']) { echo "checked"; } ?>/>
                    <label >Other (specify):</label>
                </div>
                <div class="form-group">
                    <textarea class="form-control" cols="100" rows="2" wrap="virtual" name="ax4_other"><?php echo $formData['ax4_other']?></textarea>
                </div>
            </div>
            <p class="font-weight-bold">Axis V Global Assessment of Functioning (GAF) Scale (100 down to 0):</p>
            <div class="form-group">
                <label class="font-weight-bold">Currently</label>
                <input type="text" class="form-control" name="ax5_current" value="<?php echo $formData['ax5_current']?>"/>
            </div>

            <div class="form-group">
                <label class="font-weight-bold">Past Year</label>
                <input type="text" class="form-control" name="ax5_past" value="<?php echo $formData['ax5_past']?>"/>
            </div><br>

            <h4 class="title text-center"> INITIAL RISK EVALUATION</h4>

            <p class="font-weight-bold">Suicide:</p>

            <div >
                <input type="checkbox" name='risk_suicide_na' <?php if ($formData['risk_suicide_na']) { echo "checked"; } ?>/>
                <label >Not Assessed</label>
            </div>

            <p class="font-weight-bold mt-3">Behaviors:</p>
            <div >
                <input type="checkbox" name='risk_suicide_nk' <?php if ($formData['risk_suicide_nk']) { echo "checked"; } ?>/>
                <label >Not Known</label>
            </div>
            <div >
                <input type="checkbox" name='risk_suicide_io' <?php if ($formData['risk_suicide_io']) { echo "checked"; } ?>/>
                <label >Ideation only</label>
            </div>
            <div >
                <input type="checkbox" name='risk_suicide_plan' <?php if ($formData['risk_suicide_plan']) { echo "checked"; } ?>/>
                <label >Plan</label>
            </div>
            <div >
                <input type="checkbox" name='risk_suicide_iwom' <?php if ($formData['risk_suicide_iwom']) { echo "checked"; } ?>/>
                <label >Intent without means</label>
            </div>
            <div >
                <input type="checkbox" name='risk_suicide_iwm' <?php if ($formData['risk_suicide_iwm']) { echo "checked"; } ?>/>
                <label >Intent with means</label>
            </div>

            <p class="font-weight-bold mt-3">Homocide:</p>
            <div >
                <input type="checkbox" name='risk_homocide_na' <?php if ($formData['risk_homocide_na']) { echo "checked"; } ?>/>
                <label >Not Assessed</label>
            </div>

            <p class="font-weight-bold mt-3">Behaviors:</p>
            <div >
                <input type="checkbox" name='risk_homocide_nk' <?php if ($formData['risk_homocide_nk']) { echo "checked"; } ?>/>
                <label >Not Known</label>
            </div>
            <div >
                <input type="checkbox" name='risk_homocide_io' <?php if ($formData['risk_homocide_io']) { echo "checked"; } ?>/>
                <label >Ideation only</label>
            </div>
            <div >
                <input type="checkbox" name='risk_homocide_plan' <?php if ($formData['ax4_legal']) { echo "checked"; } ?>/>
                <label >Plan</label>
            </div>

            <div >
                <input type="checkbox" name='risk_homocide_iwom' <?php if ($formData['risk_homocide_iwom']) { echo "checked"; } ?>/>
                <label >Intent without means</label>
            </div>

            <div >
                <input type="checkbox" name='risk_homocide_iwm' <?php if ($formData['risk_homocide_iwm']) { echo "checked"; } ?>/>
                <label >Intent with means</label>
            </div>

            <p class="font-weight-bold mt-3">Compliance with treatment:</p>
            <div >
                <input type="checkbox" name='risk_compliance_na' <?php if ($formData['risk_compliance_na']) { echo "checked"; } ?>/>
                <label >Not Assessed</label>
            </div>

            <div >
                <input type="checkbox" name='risk_compliance_fc' <?php if ($formData['risk_compliance_fc']) { echo "checked"; } ?>/>
                <label >Full compliance</label>
            </div>

            <div >
                <input type="checkbox" name='risk_compliance_mc' <?php if ($formData['risk_compliance_mc']) { echo "checked"; } ?>/>
                <label >Minimal compliance</label>
            </div>

            <div >
                <input type="checkbox" name='risk_compliance_moc' <?php if ($formData['risk_compliance_moc']) { echo "checked"; } ?>/>
                <label >Moderate compliance</label>
            </div>

            <div >
                <input type="checkbox" name='risk_compliance_var' <?php if ($formData['risk_compliance_var']) { echo "checked"; } ?>/>
                <label >Variable</label>
            </div>

            <div >
                <input type="checkbox" name='risk_compliance_no' <?php if ($formData['risk_compliance_no']) { echo "checked"; } ?>/>
                <label >Little or no compliance</label>
            </div>

            <p class="font-weight-bold mt-3">Substance Abuse:</p>

            <div >
                <input type="checkbox" name='risk_substance_na' <?php if ($formData['risk_substance_na']) { echo "checked"; } ?>/>
                <label >Not Assessed</label>
            </div>
            <div >
                <input type="checkbox" name='risk_substance_none' <?php if ($formData['risk_substance_none']) { echo "checked"; } ?>/>
                <label >None / normal use:</label>
            </div>
            <div >
                <input type="checkbox" name='risk_substance_ou' <?php if ($formData['risk_substance_ou']) { echo "checked"; } ?>/>
                <label >Overuse</label>
            </div>
            <div >
                <input type="checkbox" name='risk_substance_dp' <?php if ($formData['risk_substance_dp']) { echo "checked"; } ?>/>
                <label >Dependence</label>
            </div>
            <div >
                <input type="checkbox" name='risk_substance_ur' <?php if ($formData['risk_substance_ur']) { echo "checked"; } ?>/>
                <label >Unstable remission of abuse</label>
            </div>
            <div >
                <input type="checkbox" name='risk_substance_ab' <?php if ($formData['risk_substance_ab']) { echo "checked"; } ?>/>
                <label >Abuse</label>
            </div>

            <p class="font-weight-bold mt-3">Current physical or sexual abuse:</p>
            <div >
                <input type="checkbox" name='risk_sexual_na' <?php if ($formData['risk_sexual_na']) { echo "checked"; } ?>/>
                <label >Not Assessed</label>
            </div>
            <div >
                <input type="checkbox" name='risk_sexual_y' <?php if ($formData['risk_sexual_y']) { echo "checked"; } ?>/>
                <label >Yes</label>
            </div>
            <div >
                <input type="checkbox" name='risk_sexual_n' <?php if ($formData['risk_sexual_n']) { echo "checked"; } ?>/>
                <label >No</label>
            </div>

            <p class="font-weight-bold mt-3">Legally reportable?</p>
            <div >
                <input type="checkbox" name='risk_sexual_ry' <?php if ($formData['risk_sexual_ry']) { echo "checked"; } ?>/>
                <label >Yes</label>
            </div>
            <div >
                <input type="checkbox" name='risk_sexual_rn' <?php if ($formData['risk_sexual_rn']) { echo "checked"; } ?>/>
                <label >No</label>
            </div>

            <p class="font-weight-bold mt-3">If yes, client is </p>

            <div >
                <input type="checkbox" name='risk_sexual_cv' <?php if ($formData['risk_sexual_cv']) { echo "checked"; } ?>/>
                <label >victim</label>
            </div>
            <div >
                <input type="checkbox" name='risk_sexual_cp' <?php if ($formData['risk_sexual_cp']) { echo "checked"; } ?>/>
                <label >perpetrator</label>
            </div>
            <div >
                <input type="checkbox" name='risk_sexual_b' <?php if ($formData['risk_sexual_b']) { echo "checked"; } ?>/>
                <label >Both</label>
            </div>
            <div >
                <input type="checkbox" name='risk_sexual_nf' <?php if ($formData['risk_sexual_nf']) { echo "checked"; } ?>/>
                <label >neither, but abuse exists in family</label>
            </div>

            <p class="font-weight-bold mt-3">Current child/elder abuse:</p>
            <div >
                <input type="checkbox" name='risk_neglect_na' <?php if ($formData['risk_neglect_na']) { echo "checked"; } ?>/>
                <label >Not Assessed</label>
            </div>
            <div >
                <input type="checkbox" name='risk_neglect_y' <?php if ($formData['risk_neglect_y']) { echo "checked"; } ?>/>
                <label >Yes</label>
            </div>
            <div >
                <input type="checkbox" name='risk_neglect_n' <?php if ($formData['risk_neglect_n']) { echo "checked"; } ?>/>
                <label >No</label>
            </div><br>

            <label class="font-weight-bold mt-3">Legally reportable?</label><br>
            <div >
                <input type="checkbox" name='risk_neglect_ry' <?php if ($formData['risk_neglect_ry']) { echo "checked"; } ?>/>
                <label >Yes</label>
            </div>

            <div >
                <input type="checkbox" name='risk_neglect_rn' <?php if ($formData['risk_neglect_rn']) { echo "checked"; } ?>/>
                <label >No</label>
            </div>

            <p class="font-weight-bold mt-3">If yes, client is </p>

            <div >
                <input type="checkbox" name='risk_neglect_va' <?php if ($formData['risk_neglect_va']) { echo "checked"; } ?>/>
                <label >Not Assessed</label>
            </div>

            <div >
                <input type="checkbox" name='risk_neglect_cv' <?php if ($formData['risk_neglect_cv']) { echo "checked"; } ?>/>
                <label >victim</label>
            </div>

            <div >
                <input type="checkbox" name='risk_neglect_cp' <?php if ($formData['risk_neglect_cp']) { echo "checked"; } ?>/>
                <label >perpetrator</label>
            </div>

            <div >
                <input type="checkbox" name='risk_neglect_cb' <?php if ($formData['risk_neglect_cb']) { echo "checked"; } ?>/>
                <label >both</label>
            </div>

            <div >
                <input type="checkbox" name='risk_neglect_cn' <?php if ($formData['risk_neglect_cn']) { echo "checked"; } ?>/>
                <label >neither, but abuse exists in family</label>
            </div>

            <div class="row align-items-center">
                <div class="col-2">
                    <p class="font-weight-bold">If risk exists the client:</p>
                </div>
                <div class="col-4">
                    <div >
                        <input type="checkbox" name='risk_exists_c' id='risk_exists_c' <?php if ($formData['risk_exists_c']) { echo "checked"; } ?>/>
                        <label >can meaningfully agree to a contract not to harm</label>
                    </div>
                    <div >
                        <input type="checkbox" name='risk_exists_cn' id='risk_exists_cn' <?php if ($formData['risk_exists_cn']) { echo "checked"; } ?>/>
                        <label >cannot meaningfully agree to a contract not to harm</label>
                    </div>
                </div>
                <div class="col-2">
                    <div >
                        <input type="checkbox" name='risk_exists_s' <?php if ($formData['risk_exists_s']) { echo "checked"; } ?>/>
                        <label >self</label>
                    </div>
                    <div >
                        <input type="checkbox" name='risk_exists_o' <?php if ($formData['risk_exists_o']) { echo "checked"; } ?>/>
                        <label >others</label>
                    </div>
                    <div >
                        <input type="checkbox" name='risk_exists_b' <?php if ($formData['risk_exists_b']) { echo "checked"; } ?>/>
                        <label >both</label>
                    </div>
                </div>
            </div><br>

            <span><h4 class="title text-center"> TREATMENT RECOMMENDATIONS / INITIAL TREATMENT PLAN</h4></span>

            <p class="font-weight-bold">Outpatient Psychotherapy:</p>
            <div >
                <input type="checkbox" name='recommendations_psy_i' <?php if ($formData['recommendations_psy_i']) { echo "checked"; } ?>/>
                <label >Individual</label>
            </div>

            <div >
                <input type="checkbox" name='recommendations_psy_f' <?php if ($formData['recommendations_psy_f']) { echo "checked"; } ?>/>
                <label >Family</label>
            </div>

            <div >
                <input type="checkbox" name='recommendations_psy_m' <?php if ($formData['recommendations_psy_m']) { echo "checked"; } ?>/>
                <label >Marital/relational</label>
            </div>

            <div >
                <input type="checkbox" name='recommendations_psy_g' <?php if ($formData['recommendations_psy_g']) { echo "checked"; } ?>/>
                <label >Group Therapy</label>
            </div>

            <div class="form-inline" style="padding-left: 5px">
                <div class="form-group">
                    <input type="checkbox" name='recommendations_psy_o' <?php if ($formData['recommendations_psy_o']) { echo "checked"; } ?>/>
                    <label > Other </label>
                </div>
                <div class="form-group" style="padding-left: 15px">
                    <textarea class="form-control" cols="100" rows="3" wrap="virtual" name="recommendations_psy_note"><?php echo $formData['recommendations_psy_note']?></textarea>
                </div>
            </div>
            <br>
            <p class="font-weight-bold">Return to care in:</p>
            <div >
                <input type="checkbox" name='rtc1' <?php if ($formData['rtc1']) { echo "checked"; } ?>/>
                <label >1 Week</label>
            </div>
            <div >
                <input type="checkbox" name='rtc2' <?php if ($formData['rtc2']) { echo "checked"; } ?>/>
                <label >2 Weeks</label>
            </div>

            <div >
                <input type="checkbox" name='rtc3' <?php if ($formData['rtc3']) { echo "checked"; } ?>/>
                <label >3 Weeks</label>
            </div>

            <div >
                <input type="checkbox" name='rtc4' <?php if ($formData['rtc4']) { echo "checked"; } ?>/>
                <label >1 Month</label>
            </div>

            <p class="font-weight-bold">Inpatient / Hospitalization:</p>
            <div >
                <input type="checkbox" name='recommendations_psy_i' <?php if ($formData['recommendations_psy_i']) { echo "checked"; } ?>/>
                <label >Inpatient</label>
            </div>
            <div >
                <input type="checkbox" name='recommendations_psy_f' <?php if ($formData['recommendations_psy_f']) { echo "checked"; } ?>/>
                <label >Residential Treatment</label>
            </div>
            <p class="font-weight-bold">Substance Abuse Treatment:</p>
            <div >
                <input type="checkbox" name='recommendations_psy_m' <?php if ($formData['recommendations_psy_m']) { echo "checked"; } ?>/>
                <label >Inpatient</label>
            </div>
            <div >
                <input type="checkbox" name='recommendations_psy_o' <?php if ($formData['recommendations_psy_o']) { echo "checked"; } ?>/>
                <label >Residential Treatment</label>
                <br><br>
                <label >Other External Referral</label>
            </div>
            <div class="form-group">
                <textarea class="form-control" cols="100" rows="3" wrap="virtual" name="recommendations_psy_notes"><?php echo $formData['recommendations_psy_notes']?></textarea>
            </div><br>
            <div class="form-group">
                <label class="font-weight-bold">Date report sent to referral source:</label>
                <input type="text" class="form-control" name='refer_date' value="<?php echo $formData['refer_date']?>"/>
            </div><br>
            <div class="form-group">
                <label class="font-weight-bold">Parent/Guardian:</label>
                <input type="text" class="form-control" name='parent' value="<?php echo $formData['parent']?>"/>
            </div>
        </div>
    </form>
    <?php
    formFooter();
    ?>
