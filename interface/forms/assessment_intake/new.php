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
require_once("$srcdir/api.inc");

use OpenEMR\Common\Csrf\CsrfUtils;
use OpenEMR\Core\Header;

formHeader("Form: assessment_intake");
?>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <?php Header::setupHeader(); ?>
    <script>
        let dcn_field = '';

        // This invokes the find-code popup.
        function sel_diagnosis(dcn) {
            dcn_field = dcn;
            dlgopen('../../patient_file/encounter/find_code_popup.php?codetype=ICD10', '_blank', 1024, 825);
        }
        // handles the call back from the popup
        function set_related(codetype, code, selector, codedesc) {
            if (code) {
                if (codetype == 'ICD10') {
                    document.getElementById(dcn_field).value += code + " - " + codedesc + " ,, \r\n";
                }
            }
        }
    </script>
    <title><?php echo xlt("Assessment Intake Form"); ?></title>
</head>
<body class='body_top'>
<div id="container_div" class="container">
    <form method="post" action="<?php echo $rootdir;?>/forms/assessment_intake/save.php?mode=new" name="my_form">
        <input type="hidden" name="csrf_token_form" value="<?php echo attr(CsrfUtils::collectCsrfToken()); ?>" />
        <br />
        <h3 class="title text-center"> Intake and Clinical Summary</h3>
        <div class="text-center">
            <a href="javascript:top.restoreSession();document.my_form.submit();" class="btn btn-primary"><?php echo xlt("Save"); ?></a>
            <a href="<?php echo $GLOBALS['form_exit_url']; ?>" class="btn btn-secondary" onclick="top.restoreSession()"><?php echo xlt("Don't Save"); ?></a>
        </div>
        <br />
        <div class="form-group">
            <label class="font-weight-bold">Referral Source:</label>
            <input type="text" class="form-control" name="referral_source" />
        </div>
        <p class="font-weight-bold">Purpose:</p>
        <div >
            <input type="checkbox"  name='new_client_eval' checked/>
            <label for 'new client evaluation'>New client evaluation</label>
        </div>
        <div >
            <input type="checkbox"  name='consultation' />
            <label for "consultation" >Consultation</label>
        </div>
        <div >
            <input type="checkbox"  name='annual' />
            <label for 'Annual Update'>Annual Update</label>
        </div><br>


        <div class="form-group">
            <label class="font-weight-bold">Copy sent to:</label>
            <input type="text" class="form-control" name="copy_sent_to" />
        </div><br>

        <div class="form-group">
            <label class="font-weight-bold"> Goals and treatment expectations of the patient:</label>
            <textarea class="form-control" cols="100" rows="3" wrap="virtual" name="treatment"></textarea><br>


            <h5 class="font-weight-bold mt-3": underline;"AREAS OF FUNCTIONING"</h5>
            <h4 class="title text-center"> AREAS OF FUNCTIONING</h4>

            <div class="form-group">
                <label class="font-weight-bold">How is School/Work impacted by current condition?</label>
                <textarea class="form-control" cols="100" rows="3" wrap="virtual" name="school_work"></textarea>
            </div><br>


            <div class="form-group">
                <label class="font-weight-bold">How are Personal and Family Relationships (Intimate) impacted?</label>
                <textarea class="form-control" cols="100" rows="4" wrap="virtual" name="personal_relationships"></textarea>
            </div><br>


            <div class="form-group">
                <label class="font-weight-bold">Other?</label>
                <textarea class="form-control" cols="100" rows="4" wrap="virtual" name="other"></textarea>
            </div><br>


            <h4 class="title text-center"> CLINCAL FINDINGS</h4>

            <div class="form-group">
                <label class="font-weight-bold">Clinical Summary:</label>
                <textarea class="form-control" cols="100" rows="10" wrap="virtual" name="summary"></textarea>
            </div>


            <h5 class="font-weight-bold mt-3" style="text-decoration: underline;">Diagnoses</h5>
            <div class="form-group">
                <label class="font-weight-bold">Axis I:</label>
                <textarea class="form-control" cols="100" rows="3" wrap="virtual" name="axis1"></textarea>
            </div>
            <div class="form-group">
                <label class="font-weight-bold">Axis II:</label>
                <textarea class="form-control" cols="100" rows="3" wrap="virtual" name="axis2"></textarea>
            </div>
            <div class="form-group">
                <label class="font-weight-bold">Axis III:</label>
                <textarea class="form-control" cols="100" rows="3" wrap="virtual" name="axis3"></textarea>
            </div>

            <p class="font-weight-bold">Axis IV Psychosocial and environmental problems in the last year:</p>
            <div >
                <input type="checkbox" name='ax4_prob_support_group' />
                <label >Problems with primary support group</label>
            </div>
            <div >
                <input type="checkbox" name='ax4_prob_soc_env' />
                <label >Problems related to the social environment</label>
            </div>
            <div >
                <input type="checkbox" name='ax4_educational_prob' />
                <label >Educational problems</label>
            </div>
            <div >
                <input type="checkbox" name='ax4_occ_prob' />
                <label >Occupational problems</label>
            </div>
            <div >
                <input type="checkbox" name='ax4_housing' />
                <label >Housing problems</label>
            </div>
            <div >
                <input type="checkbox" name='ax4_economic' />
                <label >Economic problems</label>
            </div>
            <div >
                <input type="checkbox" name='ax4_access_hc' />
                <label >Problems with access to health care services</label>
            </div>
            <div >
                <input type="checkbox" name='ax4_legal' />
                <label >Problems related to interaction with the legal system/crime</label>
            </div>
            <div class="form-inline">
                <div >
                    <input type="checkbox" name='ax4_other_cb' />
                    <label >Other (specify):</label>
                </div>
                <div class="form-group">
                    <textarea class="form-control" cols="100" rows="2" wrap="virtual" name="ax4_other"></textarea>
                </div>
            </div>
            <p class="font-weight-bold">Axis V Global Assessment of Functioning (GAF) Scale (100 down to 0):</p>
            <div class="form-group">
                <label class="font-weight-bold">Currently</label>
                <input type="text" class="form-control" name="ax5_current" />
            </div>

            <div class="form-group">
                <label class="font-weight-bold">Past Year</label>
                <input type="text" class="form-control" name="ax5_past" />
            </div><br>

            <h4 class="title text-center"> INITIAL RISK EVALUATION</h4>

            <p class="font-weight-bold">Suicide:</p>

            <div >
                <input type="checkbox" name='risk_suicide_na' />
                <label >Not Assessed</label>
            </div>

            <p class="font-weight-bold mt-3">Behaviors:</p>
            <div >
                <input type="checkbox" name='risk_suicide_nk' />
                <label >Not Known</label>
            </div>
            <div >
                <input type="checkbox" name='risk_suicide_io' />
                <label >Ideation only</label>
            </div>
            <div >
                <input type="checkbox" name='risk_suicide_plan' />
                <label >Plan</label>
            </div>
            <div >
                <input type="checkbox" name='risk_suicide_iwom' />
                <label >Intent without means</label>
            </div>
            <div >
                <input type="checkbox" name='risk_suicide_iwm' />
                <label >Intent with means</label>
            </div>

            <p class="font-weight-bold mt-3">Homocide:</p>
            <div >
                <input type="checkbox" name='risk_homocide_na' />
                <label >Not Assessed</label>
            </div>

            <p class="font-weight-bold mt-3">Behaviors:</p>
            <div >
                <input type="checkbox" name='risk_homocide_nk' />
                <label >Not Known</label>
            </div>
            <div >
                <input type="checkbox" name='risk_homocide_io' />
                <label >Ideation only</label>
            </div>
            <div >
                <input type="checkbox" name='risk_homocide_plan' />
                <label >Plan</label>
            </div>

            <div >
                <input type="checkbox" name='risk_homocide_iwom' />
                <label >Intent without means</label>
            </div>

            <div >
                <input type="checkbox" name='risk_homocide_iwm' />
                <label >Intent with means</label>
            </div>

            <p class="font-weight-bold mt-3">Compliance with treatment:</p>
            <div >
                <input type="checkbox" name='risk_compliance_na' />
                <label >Not Assessed</label>
            </div>

            <div >
                <input type="checkbox" name='risk_compliance_fc' />
                <label >Full compliance</label>
            </div>

            <div >
                <input type="checkbox" name='risk_compliance_mc' />
                <label >Minimal compliance</label>
            </div>

            <div >
                <input type="checkbox" name='risk_compliance_moc' />
                <label >Moderate compliance</label>
            </div>

            <div >
                <input type="checkbox" name='risk_compliance_var' />
                <label >Variable</label>
            </div>

            <div >
                <input type="checkbox" name='risk_compliance_no' />
                <label >Little or no compliance</label>
            </div>

            <p class="font-weight-bold mt-3">Substance Abuse:</p>

            <div >
                <input type="checkbox" name='risk_substance_na' />
                <label >Not Assessed</label>
            </div>
            <div >
                <input type="checkbox" name='risk_substance_none' />
                <label >None / normal use:</label>
            </div>
            <div >
                <input type="checkbox" name='risk_substance_ou' />
                <label >Overuse</label>
            </div>
            <div >
                <input type="checkbox" name='risk_substance_dp' />
                <label >Dependence</label>
            </div>
            <div >
                <input type="checkbox" name='risk_substance_ur' />
                <label >Unstable remission of abuse</label>
            </div>
            <div >
                <input type="checkbox" name='risk_substance_ab' />
                <label >Abuse</label>
            </div>

            <p class="font-weight-bold mt-3">Current physical or sexual abuse:</p>
            <div >
                <input type="checkbox" name='risk_sexual_na' />
                <label >Not Assessed</label>
            </div>
            <div >
                <input type="checkbox" name='risk_sexual_y' />
                <label >Yes</label>
            </div>
            <div >
                <input type="checkbox" name='risk_sexual_n' />
                <label >No</label>
            </div>

            <p class="font-weight-bold mt-3">Legally reportable?</p>
            <div >
                <input type="checkbox" name='risk_sexual_ry' />
                <label >Yes</label>
            </div>
            <div >
                <input type="checkbox" name='risk_sexual_rn' />
                <label >No</label>
            </div>

            <p class="font-weight-bold mt-3">If yes, client is </p>

            <div >
                <input type="checkbox" name='risk_sexual_cv' />
                <label >victim</label>
            </div>
            <div >
                <input type="checkbox" name='risk_sexual_cp' />
                <label >perpetrator</label>
            </div>
            <div >
                <input type="checkbox" name='risk_sexual_b' />
                <label >Both</label>
            </div>
            <div >
                <input type="checkbox" name='risk_sexual_nf' />
                <label >neither, but abuse exists in family</label>
            </div>

            <p class="font-weight-bold mt-3">Current child/elder abuse:</p>
            <div >
                <input type="checkbox" name='risk_neglect_na' />
                <label >Not Assessed</label>
            </div>
            <div >
                <input type="checkbox" name='risk_neglect_y' />
                <label >Yes</label>
            </div>
            <div >
                <input type="checkbox" name='risk_neglect_n' />
                <label >No</label>
            </div><br>

            <label class="font-weight-bold mt-3">Legally reportable?</label><br>
            <div >
                <input type="checkbox" name='risk_neglect_ry' />
                <label >Yes</label>
            </div>

            <div >
                <input type="checkbox" name='risk_neglect_rn' />
                <label >No</label>
            </div>

            <p class="font-weight-bold mt-3">If yes, client is </p>

            <div >
                <input type="checkbox" name='risk_neglect_va' />
                <label >Not Assessed</label>
            </div>

            <div >
                <input type="checkbox" name='risk_neglect_cv' />
                <label >victim</label>
            </div>

            <div >
                <input type="checkbox" name='risk_neglect_cp' />
                <label >perpetrator</label>
            </div>

            <div >
                <input type="checkbox" name='risk_neglect_cb' />
                <label >both</label>
            </div>

            <div >
                <input type="checkbox" name='risk_neglect_cn' />
                <label >neither, but abuse exists in family</label>
            </div>

            <div class="row align-items-center">
                <div class="col-2">
                    <p class="font-weight-bold">If risk exists the client:</p>
                </div>
                <div class="col-4">
                    <div >
                        <input type="checkbox" name='risk_exists_c' id='risk_exists_c' />
                        <label >can meaningfully agree to a contract not to harm</label>
                    </div>
                    <div >
                        <input type="checkbox" name='risk_exists_cn' id='risk_exists_cn' />
                        <label >cannot meaningfully agree to a contract not to harm</label>
                    </div>
                </div>
                <div class="col-2">
                    <div >
                        <input type="checkbox" name='risk_exists_s' />
                        <label >self</label>
                    </div>
                    <div >
                        <input type="checkbox" name='risk_exists_o' />
                        <label >others</label>
                    </div>
                    <div >
                        <input type="checkbox" name='risk_exists_b' />
                        <label >both</label>
                    </div>
                </div>
            </div><br>

           <span><h4 class="title text-center"> TREATMENT RECOMMENDATIONS / INITIAL TREATMENT PLAN</h4></span>

            <p class="font-weight-bold">Outpatient Psychotherapy:</p>
            <div >
                <input type="checkbox" name='recommendations_psy_i' />
                <label >Individual</label>
            </div>

            <div >
                <input type="checkbox" name='recommendations_psy_f' />
                <label >Family</label>
            </div>

            <div >
                <input type="checkbox" name='recommendations_psy_m' />
                <label >Marital/relational</label>
            </div>

            <div >
                <input type="checkbox" name='recommendations_psy_g' />
                <label >Group Therapy</label>
            </div>

            <div class="form-inline" style="padding-left: 5px">
                <div class="form-group">
                    <input type="checkbox" name='recommendations_psy_o' />
                    <label > Other </label>
                </div>
                <div class="form-group" style="padding-left: 15px">
                    <textarea class="form-control" cols="100" rows="3" wrap="virtual" name="recommendations_psy_notes"></textarea>
                </div>
            </div>
            <br>
            <p class="font-weight-bold">Return to care in:</p>
            <div >
                <input type="checkbox" name='rtc1' />
                <label >1 Week</label>
            </div>
            <div >
                <input type="checkbox" name='rtc2' />
                <label >2 Weeks</label>
            </div>

            <div >
                <input type="checkbox" name='rtc3' />
                <label >3 Weeks</label>
            </div>

            <div >
                <input type="checkbox" name='rtc4' />
                <label >1 Month</label>
            </div>

            <p class="font-weight-bold">Inpatient / Hospitalization:</p>
            <div >
                <input type="checkbox" name='recommendations_psy_i' />
                <label >Inpatient</label>
            </div>
            <div >
                <input type="checkbox" name='recommendations_psy_f' />
                <label >Residential Treatment</label>
            </div>
            <p class="font-weight-bold">Substance Abuse Treatment:</p>
            <div >
                <input type="checkbox" name='recommendations_psy_m' />
                <label >Inpatient</label>
            </div>
            <div >
                <input type="checkbox" name='recommendations_psy_o' />
                <label >Residential Treatment</label>
                <br><br>
                <label >Other External Referral</label>
            </div>
            <div class="form-group">
                <textarea class="form-control" cols="100" rows="3" wrap="virtual" name="recommendations_psy_notes"></textarea>
            </div><br>
            <div class="form-group">
                <label class="font-weight-bold">Date report sent to referral source:</label>
                <input type="text" class="form-control" name='refer_date' />
            </div><br>
            <div class="form-group">
                <label class="font-weight-bold">Parent/Guardian:</label>
                <input type="text" class="form-control" name='parent' />
            </div>
            <div class="form-group">
                <label class="font-weight-bold" for="dcn"><?php echo xlt('Diagnosis') ?>:</label>
                <input type="text" class="form-control" name="dcn1" id="dcn1" onclick="sel_diagnosis('dcn1')" value="<?php echo xlt($obj['dcn1']); ?>" readonly/>
            </div>
            <div class="form-row">
                <div class="col-7 mb-3">
                    <label class="font-weight-bold" for="cpt4"><?php echo xlt('CPT4') ?>:</label>
                    <input type="text" class="form-control" name="cpt4" placeholder="CPT4" value="90791 - Mental Healthy Diagnostic Evaluation by Mental Health Therapist (15 min increments),," />
                </div>
            </div>
        </div>
    </form>
    <?php
    formFooter();
    ?>
