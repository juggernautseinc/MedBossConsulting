<?php /* Smarty version 2.6.31, created on 2021-04-14 20:08:04
         compiled from /var/www/html/boss/interface/forms/soap/templates/general_new.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'xlt', '/var/www/html/boss/interface/forms/soap/templates/general_new.html', 3, false),array('function', 'headerTemplate', '/var/www/html/boss/interface/forms/soap/templates/general_new.html', 4, false),array('function', 'xla', '/var/www/html/boss/interface/forms/soap/templates/general_new.html', 112, false),array('modifier', 'attr', '/var/www/html/boss/interface/forms/soap/templates/general_new.html', 42, false),array('modifier', 'text', '/var/www/html/boss/interface/forms/soap/templates/general_new.html', 49, false),)), $this); ?>
<html>
<head>
<title><?php echo smarty_function_xlt(array('t' => 'SOAP'), $this);?>
</title>
<?php echo smarty_function_headerTemplate(array('assets' => 'jquery-ui|jquery-ui-base'), $this);?>

    <?php echo '
    <script>
        // handles the call back from the popup
        function set_related(codetype, code, selector, codedesc) {
            if (code) {
                if (codetype == \'ICD10\') {
                    document.getElementById(\'dxcode\').value += code + " - " + codedesc + " ,, \\r\\n";
                }
                if (codetype == \'CPT4\') {
                    document.getElementById(\'cpt\').value += code + " - " + codedesc + " ,, \\r\\n";
                }
                let xhr = new XMLHttpRequest();
                xhr.onload = function() {
                    if (this.status == 200) {
                        console.log(xhr.responseText);
                    }
                }

            }
        }
        // This invokes the find-code popup.
        function sel_diagnosis() {
            dlgopen(\'../../patient_file/encounter/find_code_popup.php?codetype=ICD10\');
        }
        function sel_code() {
            dlgopen(\'../../patient_file/encounter/find_code_popup.php?codetype=CPT4\');
        }
    </script>
    '; ?>


</head>
<body>
    <div class="container mt-3">
        <div class="row">
            <div class="col-12">
                <h2><?php echo smarty_function_xlt(array('t' => 'SOAP'), $this);?>
</h2>
                <form name="soap" method="post" action="<?php echo $this->_tpl_vars['FORM_ACTION']; ?>
/interface/forms/soap/save.php" onsubmit="return top.restoreSession()">
                    <input type="hidden" name="csrf_token_form" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['CSRF_TOKEN_FORM'])) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" />
                    <fieldset>
                        <legend><?php echo smarty_function_xlt(array('t' => 'Subjective'), $this);?>
</legend>
                        <span> - Presenting Problem of Issue from the patient point of view, what client says about cause , duration and seriousness</span>
                        <br><br>
                        <div class="container">
                            <div class="form-group" >
                                <textarea name="subjective" class="form-control" cols="60" rows="6" onkeyup="top.isSoapEdit = true;"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']->get_subjective())) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
</textarea>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend><?php echo smarty_function_xlt(array('t' => 'Objective'), $this);?>
</legend>
                        <span>- Therapists identified behaviors not previously documented under the mental status exam such as physical responses to questions or emotional responses or expressions</span>
                        <div class="container">
                            <div class="form-group">
                                <textarea name="objective" class="form-control" cols="60" rows="6" onkeyup="top.isSoapEdit = true;"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']->get_objective())) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
</textarea>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend><?php echo smarty_function_xlt(array('t' => 'Assessment'), $this);?>
</legend>
                        <span>- Clinician MUST document here SI / HI / Self Harm / High Risk Behaviors.   If any are yes, Provider must complete Crisis Intervention Form found under CLINICAL Tab.</span>
                        <div class="container">
                            <div class="form-group">
                                <textarea name="assessment" class="form-control" cols="60" rows="6" onkeyup="top.isSoapEdit = true;"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']->get_assessment())) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
</textarea>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend><?php echo smarty_function_xlt(array('t' => 'Plan/Clinical Analysis'), $this);?>
</legend>
                        <span>- Therapists identified behaviors not previously documented under the mental status exam such as physical responses to questions or emotional responses or expressions</span>
                        <div class="container">
                            <div class="form-group">
                                <textarea name="plan" class="form-control" cols="60" rows="6" onkeyup="top.isSoapEdit = true;"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']->get_plan())) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
</textarea>
                            </div>
                        </div>
                    </fieldset>
                    <?php if (empty ( $this->_tpl_vars['BILLING'] )): ?>
                    <fieldset>
                        <div class="container">
                            <div class="form-group">
                                <label for="cpt">CPT</label>
                                <textarea type="text" id="cpt" name="cpt" size="90" class="form-control" onclick="sel_code()" readonly></textarea>
                            </div>
                            <div class="form-group">
                                <label for="dxcode">Dx: </label>
                                <textarea type="text" id="dxcode" name="dxcode" size="90" class="form-control" onclick="sel_diagnosis()" readonly></textarea>
                            </div>
                        </div>
                    </fieldset>
                    <?php endif; ?>
                    <div class="form-group">
                        <div class="btn-group" role="group">
                            <button type="submit" class="btn btn-primary btn-save" name="Submit"><?php echo smarty_function_xlt(array('t' => 'Save'), $this);?>
</button>
                            <button type="button" class="btn btn-secondary btn-cancel" id="btnClose"><?php echo smarty_function_xlt(array('t' => 'Cancel'), $this);?>
</button>
                        </div>
                        <input type="hidden" name="id" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']->get_id())) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" />
                        <input type="hidden" name="activity" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']->get_activity())) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" />
                        <input type="hidden" name="pid" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']->get_pid())) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" />
                        <input type="hidden" name="process" value="true" />
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php echo '
    <script>
        const close = function() {
            if (top.isSoapEdit === true) {
                dlgopen(\'\', \'\', 450, 125, \'\', \'<div class="text-danger">'; ?>
<?php echo smarty_function_xla(array('t' => 'Warning'), $this);?>
<?php echo '</div>\', {
                    type: \'Alert\',
                    html: \'<p>'; ?>
<?php echo smarty_function_xla(array('t' => 'Do you want to close the tabs?'), $this);?>
<?php echo '</p>\',
                    buttons: [
                        {text: \''; ?>
<?php echo smarty_function_xla(array('t' => 'Cancel'), $this);?>
<?php echo '\', close: true, style: \'default btn-sm\'},
                        {text: \''; ?>
<?php echo smarty_function_xla(array('t' => 'Close'), $this);?>
<?php echo '\', close: true, style: \'danger btn-sm\', click: closeSoap},
                    ],
                    allowDrag: false,
                    allowResize: false,
                });
            } else {
                top.restoreSession();
                location.href = \'javascript:parent.closeTab(window.name, false)\';
            }
        }

        const closeSoap = function() {
            top.isSoapEdit = false;
            top.restoreSession();
            location.href = \'javascript:parent.closeTab(window.name, false)\';
        }
        $(\'#btnClose\').click(close);

    </script>
    '; ?>

</body>
</html>