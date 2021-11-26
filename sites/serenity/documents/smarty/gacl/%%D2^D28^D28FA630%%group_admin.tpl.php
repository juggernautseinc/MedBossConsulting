<?php /* Smarty version 2.6.31, created on 2021-04-03 06:52:28
         compiled from phpgacl/group_admin.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'attr', 'phpgacl/group_admin.tpl', 7, false),array('modifier', 'text', 'phpgacl/group_admin.tpl', 20, false),array('modifier', 'attr_url', 'phpgacl/group_admin.tpl', 26, false),array('modifier', 'upper', 'phpgacl/group_admin.tpl', 26, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "phpgacl/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "phpgacl/acl_admin_js.tpl", 'smarty_include_vars' => array()));
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
    <form method="post" name="edit_group" action="edit_group.php">
      <input type="hidden" name="csrf_token_form" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['CSRF_TOKEN_FORM'])) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
">
      <table cellpadding="2" cellspacing="2" border="2" width="100%">
        <tbody>
          <tr>
            <th width="2%">ID</th>
            <th width="40%">Name</th>
            <th width="20%">Value</th>
            <th width="6%">Objects</th>
            <th width="30%">Functions</th>
            <th width="2%"><input type="checkbox" class="checkbox" name="select_all" onClick="checkAll(this)"/></th>
          </tr>
<?php $_from = $this->_tpl_vars['groups']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['group']):
?>
          <tr valign="middle" align="center">
            <td><?php echo ((is_array($_tmp=$this->_tpl_vars['group']['id'])) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
</td>
                        <td align="left"><?php echo $this->_tpl_vars['group']['name']; ?>
</td>
            <td align="left"><?php echo ((is_array($_tmp=$this->_tpl_vars['group']['value'])) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
</td>
            <td><?php echo ((is_array($_tmp=$this->_tpl_vars['group']['object_count'])) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
</td>
            <td>
              [&nbsp;<a href="assign_group.php?group_type=<?php echo ((is_array($_tmp=$this->_tpl_vars['group_type'])) ? $this->_run_mod_handler('attr_url', true, $_tmp) : attr_url($_tmp)); ?>
&group_id=<?php echo ((is_array($_tmp=$this->_tpl_vars['group']['id'])) ? $this->_run_mod_handler('attr_url', true, $_tmp) : attr_url($_tmp)); ?>
&return_page=<?php echo ((is_array($_tmp=$this->_tpl_vars['return_page'])) ? $this->_run_mod_handler('attr_url', true, $_tmp) : attr_url($_tmp)); ?>
">Assign&nbsp;<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['group_type'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)))) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
</a>&nbsp;]
              [&nbsp;<a href="edit_group.php?group_type=<?php echo ((is_array($_tmp=$this->_tpl_vars['group_type'])) ? $this->_run_mod_handler('attr_url', true, $_tmp) : attr_url($_tmp)); ?>
&parent_id=<?php echo ((is_array($_tmp=$this->_tpl_vars['group']['id'])) ? $this->_run_mod_handler('attr_url', true, $_tmp) : attr_url($_tmp)); ?>
&return_page=<?php echo ((is_array($_tmp=$this->_tpl_vars['return_page'])) ? $this->_run_mod_handler('attr_url', true, $_tmp) : attr_url($_tmp)); ?>
">Add&nbsp;Child</a>&nbsp;]
              [&nbsp;<a href="edit_group.php?group_type=<?php echo ((is_array($_tmp=$this->_tpl_vars['group_type'])) ? $this->_run_mod_handler('attr_url', true, $_tmp) : attr_url($_tmp)); ?>
&group_id=<?php echo ((is_array($_tmp=$this->_tpl_vars['group']['id'])) ? $this->_run_mod_handler('attr_url', true, $_tmp) : attr_url($_tmp)); ?>
&return_page=<?php echo ((is_array($_tmp=$this->_tpl_vars['return_page'])) ? $this->_run_mod_handler('attr_url', true, $_tmp) : attr_url($_tmp)); ?>
">Edit</a>&nbsp;]
              [&nbsp;<a href="acl_list.php?action=Filter&filter_<?php echo ((is_array($_tmp=$this->_tpl_vars['group_type'])) ? $this->_run_mod_handler('attr_url', true, $_tmp) : attr_url($_tmp)); ?>
_group=<?php echo ((is_array($_tmp=$this->_tpl_vars['group']['raw_name'])) ? $this->_run_mod_handler('attr_url', true, $_tmp) : attr_url($_tmp)); ?>
&return_page=<?php echo ((is_array($_tmp=$this->_tpl_vars['return_page'])) ? $this->_run_mod_handler('attr_url', true, $_tmp) : attr_url($_tmp)); ?>
">ACLs</a>&nbsp;]
            </td>
            <td><input type="checkbox" class="checkbox" name="delete_group[]" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['group']['id'])) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
"></td>
          </tr>
<?php endforeach; endif; unset($_from); ?>
          <tr class="controls" align="center">
            <td colspan="4">&nbsp;</td>
            <td colspan="2" nowrap><input type="submit" class="button" name="action" value="Add" /> <input type="submit" class="button" name="action" value="Delete" /></td>
          </tr>
        </tbody>
      </table>
    <input type="hidden" name="group_type" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['group_type'])) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
">
    <input type="hidden" name="return_page" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['return_page'])) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
">
  </form>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "phpgacl/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>