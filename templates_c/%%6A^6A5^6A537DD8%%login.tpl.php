<?php /* Smarty version 2.6.18, created on 2011-05-11 09:52:14
         compiled from login.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "js_css_validation.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header_search.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<!--Start Middle-->
	<div id="middleMain">
			<span class="mainHD">Sign In to Nethaat</span>
			<div class="loginOB">
				<form name="frmLogin" id="frmLogin" action="<?php echo $this->_tpl_vars['baseUrl']; ?>
login.php" method="post">
				<div class="loginBg">
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'error_msg_template.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<div class="fl">
					Username:<br />
					<input name="username" id="username" type="text" class="required formInput" value="<?php echo $this->_tpl_vars['username']; ?>
" /><br /><br />
					Password:<br />
					<input name="password" id="password" type="password" class="required formInput" value="<?php echo $this->_tpl_vars['password']; ?>
" /><br /><br />
					<!--<input name="rememberMe" type="checkbox" value="1" <?php echo $this->_tpl_vars['rememberMe']; ?>
/>Stay signed in for one day<br /><br />-->
					<input name="Login" type="submit" value="Login" class="btn" /> <a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
forgot_password.php">Forgot your password?</a>
					</div>
					<div class="nymBg">
						<div class="top">
						Don't have an account?
						<span>No worries.</span>
						</div>
						<div class="bottom">
						<a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
registration.php">Create New Account</a>
						<span>It's easy!</span>
						</div>
					</div>
					<div class="clear"></div>
				</div>
				</form>
			</div>
		<div class="clear"></div>
	</div>
	<script language="javascript" type="text/javascript">
	document.getElementById('username').focus();
	</script>
<!--End Middle-->
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>