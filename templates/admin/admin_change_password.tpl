{include file="admin_top.tpl"}
  <table width="100%"  border="0" cellspacing="10" cellpadding="5">
	<tr>
	  <td valign="middle" class="bar">Change Password</td>
	</tr>
	<tr>
	  <td align="left" valign="top" class="border1">
	  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr><td>{include file='admin_error_msg_template.tpl'}</td></tr>
		<tr>
		  <td width="710" class="lback">
		  <form name="frmChangePassword" id="frmChangePassword" method="post" style="margin:0px;">
		   <input type="hidden" name="hdnOldPassord" id="hdnOldPassord" value="{$old_password}" />
			  <table width="100%" border="0" cellspacing="0" cellpadding="4">
				<tr>
				  <td width="32%" align="left" class="text">Old Password:</td>
				  <td width="22%">
				<!--  <input name="old_password" type="password"  equalTo="#hdnOldPassord" class="input required" id="old_password" size="30" value="" />-->
				<input name="old_password" type="password"  class="input required" id="old_password" size="30" value="" />
				  </td>
				  <td width="46%">&nbsp;</td>
				</tr>
				<tr>
				  <td align="left" class="text">New Password:</td>
				  <td><input name="new_password" type="password" class="input required" id="new_password" size="30" value="" maxlength="25" /></td>
				  <td>&nbsp;</td>
				</tr>
				<tr>
				  <td align="left" class="text">Confirm Password:</td>
				  <td><input name="confirm_new_password" equalTo="#new_password" type="password" class="input required" id="confirm_new_password" size="30" value="" maxlength="25" /></td>
				  <td>&nbsp;</td>
				</tr>
				<tr>
				  <td>&nbsp;</td>
				  <td><input name="changePassword" type="submit" class="button" value="Change Password" />
					 <input name="cancel" type="reset" class="button" value="Cancel" onclick="window.location='admin_home.php'" /></td>
				  <td>&nbsp;</td>
				</tr>
			</table>
		  </form></td>
		</tr>
	</table>
	</td>
	</tr>
</table>
{include file="admin_bottom.tpl"}