<?php /* Smarty version 2.6.18, created on 2011-05-11 09:45:51
         compiled from error_msg_template.tpl */ ?>
<div class="error" <?php if ($this->_tpl_vars['error_msg'] == ""): ?>style="display:none;"<?php endif; ?>>
<img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/warning.gif" alt="Warning!" class="error_div_warning" align="middle" /> <span><?php echo $this->_tpl_vars['error_msg']; ?>
</span>.
<br clear="all"/>
</div>
<?php if ($this->_tpl_vars['update_msg'] != ""): ?>
<div id='update_msg' ><strong><?php echo $this->_tpl_vars['update_msg']; ?>
</strong></div>
<?php endif; ?>

<?php if ($this->_tpl_vars['error_warning_msg'] != ""): ?>
<div id='error_warning_msg'>
<img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/warning_green.gif" alt="Warning!" class="error_div_warning" align="middle" /> <span style="color:#45941F"><?php echo $this->_tpl_vars['error_warning_msg']; ?>
</span>
</div>
<?php endif; ?>