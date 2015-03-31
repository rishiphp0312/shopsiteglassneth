{include file="header.tpl"}
{include file="js_css_validation.tpl"}
{include file="header_search.tpl"}
<!--Start Middle-->
	<div id="middleMain">
			{include file="left_category.tpl"}
		<div id="middleRtMain">
			<div>{$description|clear_input}</div>
			<div class="registerBg">
				<div class="registerSUbHd">Contact Us<div class="reqField">*required</div></div>
				<form name="contact_us" id="contact_us" class="searching_form" method="post" action="contact_us.php">
						<table width="100%" cellpadding="0" cellspacing="5" border="0" style="font-size:12px;">
							<tr>
							<td colspan="3">
							{include file="error_msg_template.tpl"}</td>
							</tr>
							<!--<tr><td colspan="3">{#require_msg#}</td></tr>-->
							<tr>
							  <td valign="top" align="left">Ticket ID:</td>
							  <td valign="top" align="left"><input type="text" name="ticket_id" style="width:235px;" value="{$ticket_id}" class="formInput" maxlength="30"/></td>
							  <td>&nbsp;</td>
						  </tr>
							<tr>
								<td width="40%">First Name: <span class="redClr">*</span></td>
								<td width="26%"><input type="text" name="f_name" style="width:235px;" value="{$f_name}" class="required formInput" maxlength="30"/></td>
							    <td width="34%">&nbsp;</td>
							</tr>
							<tr>
								<td>Last Name: <span class="redClr">*</span></td>
								<td><input type="text" name="l_name" value="{$l_name}" style="width:235px;" class="required formInput" maxlength="30"/></td>
							    <td>&nbsp;</td>
							</tr>
							<tr>
								<td>Phone No:<span class="redClr">*</span></td>
								<td><input type="text" name="phone" style="width:235px;" value="{$phone}" class="required formInput" maxlength="20"/></td>
							    <td>&nbsp;</td>
							</tr>
							<tr>
								<td>E-mail: <span class="redClr">*</span></td>
								<td><input type="text" name="contact_email" value="{$contact_email}" style="width:235px;"  class="required email formInput" maxlength="60"/></td>
							    <td>&nbsp;</td>
							</tr>
							<tr>
								<td>Subject:</td>
								<td><select name="contact" style="width:243px;" class="required formSel">
										{html_options values="$contactValue" output="$contactOut" selected="$contact"}
									</select>								</td>
							    <td>&nbsp;</td>
							</tr>
							<tr>
								<td valign="top">Message: <span class="redClr">*</span></td>
								<td><textarea name="message" class="formContactTextArea required" cols="40" rows="5">{$message}</textarea></td>
							    <td>&nbsp;</td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td><img src="{$baseUrl}captcha/visual-captcha.php" class="captch_ver_image" alt="Security Code" /></td>
							    <td>&nbsp;</td>
							</tr>
							<tr>
								<td>Code Shown: <span class="redClr">*</span></td>
								<td><input type="text" style="width:100px;" name="CaptchaCode" class="required formInput" maxlength="5"/></td>
							    <td>&nbsp;</td>
							</tr><tr>
								<td>Report It: <span class="redClr">*</span></td>
								<td><input type="checkbox" {if $smarty.session.session_user_id==''}disabled='true'{/if} name="report_it"  id='report_it'/></td>
							    <td>&nbsp;<input type='hidden' value='{$smarty.get.details_item_value}' name='details_item_value'></td>
							</tr>
							<tr style="display:none;">
								<td>&nbsp;</td>
								<td><input type="checkbox" name="SendMeCopy" value="1" {if $SendMeCopy==1}checked{/if}/>Send me a Copy</td>
							    <td>&nbsp;</td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td><input type="submit" name="send_message" value="Send Message" alt="Send Message" title="Send Message" class="button" /></td>
							    <td>&nbsp;</td>
							</tr>
						</table>
				</form>
			</div>
		</div>
		<div class="clear"></div>
	</div>
<!--End Middle-->
{include file="footer.tpl"}