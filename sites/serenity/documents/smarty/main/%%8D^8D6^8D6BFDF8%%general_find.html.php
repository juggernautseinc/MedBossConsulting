<?php /* Smarty version 2.6.31, created on 2021-09-13 18:35:10
         compiled from /var/www/html/boss/templates/patient_finder/general_find.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'xlt', '/var/www/html/boss/templates/patient_finder/general_find.html', 47, false),array('function', 'xla', '/var/www/html/boss/templates/patient_finder/general_find.html', 54, false),array('modifier', 'attr', '/var/www/html/boss/templates/patient_finder/general_find.html', 58, false),array('modifier', 'text', '/var/www/html/boss/templates/patient_finder/general_find.html', 64, false),)), $this); ?>
<html>
<head>


<?php echo '
 <style>
<!--
td {
	font-size:12pt;
	font-family:helvetica;
}
.small {
	font-size: 9pt;
	font-family: "Helvetica", sans-serif;
	text-decoration: none;
}
.small:hover {
	text-decoration: underline;
}
li{
	font-size:11pt;
	font-family: "Helvetica", sans-serif;
	margin-left: 15px;
}
a {
	font-size:11pt;
	font-family: "Helvetica", sans-serif;
}
-->
</style>
'; ?>

<link rel="stylesheet" href="<?php echo $this->_tpl_vars['GLOBALS']['css_header']; ?>
">
</head>
<body class="body_top">
<form name="patientfinder" method="post" action="<?php echo $this->_tpl_vars['FORM_ACTION']; ?>
" onsubmit="return top.restoreSession()">
<table>
	<tr>
		<td><?php echo smarty_function_xlt(array('t' => 'Name'), $this);?>
</td>
		<td>
			<input type="text" size="40" name="searchstring" value=""/>
		</td>
	</tr>
	<tr>
		<td>
			<input type="submit" value="<?php echo smarty_function_xla(array('t' => 'Search'), $this);?>
"/>
		</td>
	</tr>
</table>
<input type="hidden" name="process" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['PROCESS'])) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" />
<input type="hidden" name="pid" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['hidden_ispid'])) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" />
</form>
<table>
<?php if (! empty ( $this->_tpl_vars['result_set'] ) && count ( $this->_tpl_vars['result_set'] ) > 0): ?>
	<tr>
		<td><?php echo smarty_function_xlt(array('t' => 'Results Found For Search'), $this);?>
 '<?php echo ((is_array($_tmp=$this->_tpl_vars['search_string'])) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
'</td>
	</tr>
	<tr>
		<td><?php echo smarty_function_xlt(array('t' => 'Name'), $this);?>
</td><td><?php echo smarty_function_xlt(array('t' => 'DOB'), $this);?>
</td><td><?php echo smarty_function_xlt(array('t' => 'Patient ID'), $this);?>
</td>
<?php endif; ?>
<?php $_from = $this->_tpl_vars['result_set']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['search_results'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['search_results']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['result']):
        $this->_foreach['search_results']['iteration']++;
?>
	<tr>
		<td>
			<a href="javascript:<?php echo '{}'; ?>
" onclick="window.opener.document.<?php echo ((is_array($_tmp=$this->_tpl_vars['form_id'])) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
.value='<?php if ($this->_tpl_vars['ispub'] == true): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['result']['pubpid'])) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
<?php else: ?><?php echo ((is_array($_tmp=$this->_tpl_vars['result']['pid'])) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
<?php endif; ?>'; window.opener.document.<?php echo ((is_array($_tmp=$this->_tpl_vars['form_name'])) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
.value='<?php echo ((is_array($_tmp=$this->_tpl_vars['result']['name'])) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
'; window.close();"><?php echo ((is_array($_tmp=$this->_tpl_vars['result']['name'])) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
</a>
		</td>
		<td><?php echo ((is_array($_tmp=$this->_tpl_vars['result']['DOB'])) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
</td>
		<td><?php echo ((is_array($_tmp=$this->_tpl_vars['result']['pubpid'])) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
</td>
	</tr>
<?php endforeach; else: ?>
	<?php if (is_array ( $this->_tpl_vars['result_set'] )): ?>
	<tr>
		<td><?php echo smarty_function_xlt(array('t' => 'No Results Found For Search'), $this);?>
 '<?php echo ((is_array($_tmp=$this->_tpl_vars['search_string'])) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
'</td>
	</tr>
	<?php endif; ?>
<?php endif; unset($_from); ?>
	</table>
  </body>
</html>