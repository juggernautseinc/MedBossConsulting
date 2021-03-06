<?php /* Smarty version 2.6.31, created on 2021-05-06 10:50:28
         compiled from phpgacl/acl_debug.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'attr', 'phpgacl/acl_debug.tpl', 26, false),array('modifier', 'text', 'phpgacl/acl_debug.tpl', 65, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "phpgacl/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
  </head>
<body>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "phpgacl/navigation.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<form method="get" name="acl_debug" action="acl_debug.php">
<table cellpadding="2" cellspacing="2" border="2" width="100%">
  <tr>
  	<th rowspan="2">&nbsp;</th>
  	<th colspan="2">ACO</th>
  	<th colspan="2">ARO</th>
  	<th colspan="2">AXO</th>
    <th rowspan="2">Root ARO<br />Group ID</th>
    <th rowspan="2">Root AXO<br />Group ID</th>
    <th rowspan="2">&nbsp;</th>
  </tr>
  <tr>
    <th>Section</th>
    <th>Value</th>
    <th>Section</th>
    <th>Value</th>
    <th>Section</th>
    <th>Value</th>
  </tr>
  <tr valign="middle" align="center">
    <td nowrap><b>acl_query(</b></td>
    <td><input type="text" name="aco_section_value" size="15" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['aco_section_value'])) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
"></td>
    <td><input type="text" name="aco_value" size="15" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['aco_value'])) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
"></td>
    <td><input type="text" name="aro_section_value" size="15" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['aro_section_value'])) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
"></td>
    <td><input type="text" name="aro_value" size="15" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['aro_value'])) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
"></td>
    <td><input type="text" name="axo_section_value" size="15" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['axo_section_value'])) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
"></td>
    <td><input type="text" name="axo_value" size="15" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['axo_value'])) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
"></td>
    <td><input type="text" name="root_aro_group_id" size="15" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['root_aro_group_id'])) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
"></td>
    <td><input type="text" name="root_axo_group_id" size="15" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['root_axo_group_id'])) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
"></td>
    <td><b>)</b></td>
  </tr>
  <tr class="controls" align="center">
    <td colspan="10">
    	<input type="submit" class="button" name="action" value="Submit">
    </td>
  </tr>
</table>
<?php if (is_array ( $this->_tpl_vars['acls'] ) && count ( $this->_tpl_vars['acls'] ) > 0): ?>
<br />
<table cellpadding="2" cellspacing="2" border="2" width="100%">
  <tr>
    <th rowspan="2" width="4%">ACL ID</th>
    <th colspan="2">ACO</th>
    <th colspan="2">ARO</th>
    <th colspan="2">AXO</th>
    <th colspan="2">ACL</th>
  </tr>
  <tr>
    <th width="12%">Section</th>
    <th width="12%">Value</th>
    <th width="12%">Section</th>
    <th width="12%">Value</th>
    <th width="12%">Section</th>
    <th width="12%">Value</th>
    <th width="8%">Access</th>
    <th width="16%">Updated Date</th>
  </tr>
<?php $_from = $this->_tpl_vars['acls']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['acl']):
?>
  <tr valign="top" align="left">
    <td valign="middle" rowspan="2" align="center">
        <?php echo ((is_array($_tmp=$this->_tpl_vars['acl']['id'])) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>

    </td>
    <td nowrap>
		<?php echo ((is_array($_tmp=$this->_tpl_vars['acl']['aco_section_value'])) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>

    </td>
    <td nowrap>
		<?php echo ((is_array($_tmp=$this->_tpl_vars['acl']['aco_value'])) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>

    </td>

    <td nowrap>
		<?php echo ((is_array($_tmp=$this->_tpl_vars['acl']['aro_section_value'])) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
<br />
    </td>
    <td nowrap>
		<?php echo ((is_array($_tmp=$this->_tpl_vars['acl']['aro_value'])) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
<br />
    </td>

    <td nowrap>
		<?php echo ((is_array($_tmp=$this->_tpl_vars['acl']['axo_section_value'])) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
<br />
    </td>
    <td nowrap>
		<?php echo ((is_array($_tmp=$this->_tpl_vars['acl']['axo_value'])) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
<br />
    </td>

    <td valign="middle" class="<?php if ($this->_tpl_vars['acl']['allow']): ?>green<?php else: ?>red<?php endif; ?>" align="center">
		<?php if ($this->_tpl_vars['acl']['allow']): ?>
			ALLOW
		<?php else: ?>
			DENY
		<?php endif; ?>
    </td>
    <td valign="middle" align="center">
        <?php echo ((is_array($_tmp=$this->_tpl_vars['acl']['updated_date'])) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>

     </td>
  </tr>
  <tr valign="middle" align="left">
    <td colspan="4">
        <b>Return Value:</b> <?php echo ((is_array($_tmp=$this->_tpl_vars['acl']['return_value'])) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
<br />
    </td>
    <td colspan="4">
        <b>Note:</b> <?php echo ((is_array($_tmp=$this->_tpl_vars['acl']['note'])) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>

    </td>
  </tr>
<?php endforeach; endif; unset($_from); ?>
</table>
<?php endif; ?>
<input type="hidden" name="return_page" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['return_page'])) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
">
</form>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "phpgacl/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>