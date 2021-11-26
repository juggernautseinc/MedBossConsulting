<?php /* Smarty version 2.6.31, created on 2021-04-03 06:51:30
         compiled from phpgacl/header.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'text', 'phpgacl/header.tpl', 5, false),)), $this); ?>
<!DOCTYPE html>

<html>
  <head>
    <title>phpGACL - <?php echo ((is_array($_tmp=$this->_tpl_vars['page_title'])) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
</title>
    <link rel="stylesheet" href="admin.css" type="text/css" title="phpGACL" />