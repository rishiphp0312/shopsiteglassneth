{include file="admin_top.tpl"}
  <table width="100%"  border="0" cellspacing="10" cellpadding="5">
	<tr>
	  <td valign="middle" class="bar">Admin Account</td>
	</tr>
	<tr>
	  <td align="left" valign="top" class="border1">
	  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr><td>{include file='admin_error_msg_template.tpl'}</td></tr>
		<tr>
		  <td width="710" class="lback">
		  <form name="frmAdminAccount" id="frmAdminAccount" method="post" style="margin:0px;">
		     <table width="100%" border="0" cellspacing="0" cellpadding="4">
				<tr>
				  <td width="32%" align="left" class="text">Name:</td>
				  <td width="22%"><input name="admin_name" type="text"  class="input required" id="admin_name" size="30" value="{$admin_name}" /></td>
				  <td width="46%">&nbsp;</td>
				</tr>
				<tr>
				  <td align="left" class="text">Admin Username:</td>
				  <td><input name="admin_user_name" type="text" class="input required" id="admin_user_name" size="30" value="{$admin_user_name}" maxlength="25" /></td>
				  <td>&nbsp;</td>
				</tr>
				<tr>
				  <td align="left" class="text">Admin Email:</td>
				  <td><input name="admin_email" type="text" class="input required email" id="admin_email" size="30" value="{$admin_email}" maxlength="50" /></td>
				  <td>&nbsp;</td>
				</tr>
				<tr>
				  <td>&nbsp;</td>
				  <td><input name="update_profile" type="submit" class="button" value="Update" />
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