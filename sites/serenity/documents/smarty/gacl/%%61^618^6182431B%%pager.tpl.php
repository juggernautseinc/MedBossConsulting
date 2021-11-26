<?php /* Smarty version 2.6.31, created on 2021-04-03 06:51:40
         compiled from phpgacl/pager.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'text', 'phpgacl/pager.tpl', 7, false),)), $this); ?>
<table width="100%" cellspacing="0" cellpadding="2" border="0">
  <tr valign="middle">
    <td align="left">
<?php if (isset ( $this->_tpl_vars['paging_data']['atfirstpage'] ) && $this->_tpl_vars['paging_data']['atfirstpage']): ?>
      |&lt; &lt;&lt;
<?php else: ?>
      <a href="<?php echo $this->_tpl_vars['link']; ?>
page=1">|&lt;</a> <a href="<?php echo $this->_tpl_vars['link']; ?>
page=<?php if (isset ( $this->_tpl_vars['paging_data']['prevpage'] )): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['paging_data']['prevpage'])) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
<?php endif; ?>">&lt;&lt;</a>
<?php endif; ?>
    </td>
    <td align="right">
<?php if (isset ( $this->_tpl_vars['paging_data']['atlastpage'] ) && $this->_tpl_vars['paging_data']['atlastpage']): ?>
      &gt;&gt; &gt;|
<?php else: ?>
      <a href="<?php echo $this->_tpl_vars['link']; ?>
page=<?php if (isset ( $this->_tpl_vars['paging_data']['nextpage'] )): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['paging_data']['nextpage'])) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
<?php endif; ?>">&gt;&gt;</a> <a href="<?php echo $this->_tpl_vars['link']; ?>
page=<?php if (isset ( $this->_tpl_vars['paging_data']['lastpageno'] )): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['paging_data']['lastpageno'])) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
<?php endif; ?>">&gt;|</a>
<?php endif; ?>
    </td>
  </tr>
</table>