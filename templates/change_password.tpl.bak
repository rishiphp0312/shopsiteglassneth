{include file="header.tpl"}
{include file="js_css_validation.tpl"}
{include file="header_search.tpl"}
<!--Start Middle-->
	<div id="middleMain">
			{include file="left_category.tpl"}
		<div id="middleRtMain">
			<div class="registerBg">
				<div class="registerSUbHd">Change Password <div class="reqField">*required</div></div>
				<form id="frmChangePassword" name="frmChangePassword" method="post">
					<input type="hidden" name="existing_password" id="existing_password" value="{$UserArr.password}" />
					<table width="100%" border="0" cellspacing="0" cellpadding="4">
					<tr><td colspan="4">{include file='error_msg_template.tpl'}</td></tr>
					<tr>
					  <td width="29%" align="left" valign="top" class="text">Old Password: <span class="redClr">*</span></td>
					  <td width="1%">&nbsp;</td>
					  <td width="33%">
					  <input name="OldPassword" id="OldPassword" type="password" class="required login_input"  size="20" value="" maxlength="25" /></td>
					  <td width="37%">&nbsp;</td>
					</tr>
					<tr>
					  <td align="left" valign="top" class="text">New Password: <span class="redClr">*</span></td>
					  <td>&nbsp;</td>
					  <td><input name="Password" type="password" class="required login_input" id="Password" size="20" value="" maxlength="25" /></td>
					  <td>&nbsp;</td>
					</tr>
					<tr>
					  <td align="left" valign="top" class="text">Confirm New Password: <span class="redClr">*</span></td>
					  <td>&nbsp;</td>
					  <td><input name="RePassword" type="password" equalTo="#Password" class="required login_input" id="RePassword" size="20" value="" maxlength="25" /></td>
					  <td>&nbsp;</td>
					</tr>
					<tr>
					  <td>&nbsp;</td>
					  <td>&nbsp;</td>
					  <td colspan="2">
					  <input name="change_password" type="submit" value="Change Password" class="button" /> 
					  <input name="cancel" type="button" value="Cancel" class="button" onclick="window.location='my_account.php';" />
					  </td>
					</tr>
					</table>
				</form>
			</div>
		</div>
		<div class="clear"></div>
	</div>
<!--End Middle-->
{include file="footer.tpl"}