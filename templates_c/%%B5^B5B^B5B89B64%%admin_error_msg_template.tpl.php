<?php /* Smarty version 2.6.18, created on 2012-02-26 10:38:44
         compiled from admin_error_msg_template.tpl */ ?>
<div class="error" <?php if ($this->_tpl_vars['error_msg'] == ""): ?>style="display:none;"<?php endif; ?>>
<img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/warning.gif" alt="Warning!" class="error_div_warning" align="absmiddle" /> <span><?php echo $this->_tpl_vars['error_msg']; ?>
</span>.
<br clear="all"/>
</div>
<?php if ($this->_tpl_vars['update_msg'] != ""): ?>
<div id='update_msg' ><?php echo $this->_tpl_vars['update_msg']; ?>
</div>
<?php endif; ?>

<?php if ($this->_tpl_vars['error_warning_msg'] != ""): ?>
<div id='error_warning_msg'>
<img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/warning_green.gif" alt="Warning!" class="error_div_warning" align="absmiddle" /> <span style="color:#45941F"><?php echo $this->_tpl_vars['error_warning_msg']; ?>
</span>
</div>
<?php endif; ?>