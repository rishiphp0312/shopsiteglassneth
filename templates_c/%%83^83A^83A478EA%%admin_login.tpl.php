<?php /* Smarty version 2.6.18, created on 2012-02-26 10:38:44
         compiled from admin_login.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin_header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<table align="center" width="98%" border="0" cellpadding="0" cellspacing="0" style="border-left:1px solid #AFDDF7;border-right:1px solid #AFDDF7;border-bottom:1px solid #AFDDF7">
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td style="margin-top:0px; height:500px;">
	<table width="350" border="0" align="center" cellpadding="4" cellspacing="1" bgcolor="">
      <tr>
        <td colspan="3" bgcolor="#FFFFFF">
		<fieldset style="border: 1px solid #AFDDF7;">
          <legend><span class="heading">Administrator Login </span></legend>
          <form action="" method="post" name="login_frm" id="login_frm" style="margin:0">
            <table width="100%" align="center" cellpadding="3" cellspacing="1">
			  <tr>
              <td height="10" colspan="2" align="right"></td>
              </tr>
			  <tr><td colspan="2"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'admin_error_msg_template.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td></tr>
              <tr>
                <td width="25%" align="right" class="text">Username:</td>
                <td width="75%" align="left"><input name="login_username" type="text" class="input" id="login_username" value="" size="35" /></td>
                </tr>
              <tr>
                <td align="right" class="text">Password:</td>
                <td align="left"><input name="login_password" type="password" class="input" id="login_password" value="" size="35" /></td>
                </tr>
              <tr style="display:none;">
                <td></td>
                <td><input name="remember_me" type="checkbox" value="yes" />
                  &nbsp;<span class="text">Remember Me</span></td>
                </tr>
              <tr>
                <td></td>
                <td align="left" valign="middle"><input name="submit" type="submit" class="button" value="Login" />
                  &nbsp;<a href="admin_forgot_password.php" class="set_links">Forgot Password?</a></td>
              </tr>
              <tr>
                <td height="10" colspan="2"></td>
              </tr>
            </table>
          </form>
        </fieldset></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
<script language="javascript">document.getElementById('login_username').focus();</script>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin_footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>		