{include file="admin_header.tpl"}
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
          <legend><span class="heading">Administrator Forgot Password </span></legend>
          <form action="" method="post" name="frmAdminforgotPwd" id="frmAdminforgotPwd" style="margin:0">
            <table width="100%" align="center" cellpadding="3" cellspacing="1">
			  <tr>
                <td height="10" colspan="2" align="right"></td>
              </tr>
			  <tr><td colspan="2">{include file='admin_error_msg_template.tpl'}</td></tr>
              <tr>
                <td width="25%" align="right" class="text">Email:</td>
                <td width="75%" align="left"><input name="admin_email" type="text" class="input required email" id="admin_email" value="" size="35" /></td>
                </tr>
              <tr>
                <td></td>
                <td align="left" valign="middle"><input name="submit" type="submit" class="button" value="Get Password" />
                  &nbsp;<a href="index.php" class="set_links">Login?</a></td>
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
<script language="javascript">document.getElementById('admin_email').focus();</script>
{include file="admin_footer.tpl"}		