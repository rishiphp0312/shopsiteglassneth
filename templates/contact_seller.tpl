{include file="header.tpl"}
{include file="js_css_validation.tpl"}
{include file="header_search.tpl"}
{include file="js_css_validation.tpl"}

<!--Start Middle-->
<div id="middleMain">
<div class="registerBg" style="width:100%;">
<div class="registerSUbHd">Contact Seller <div class="reqField"><a href='javascript://' onclick='history.go(-1)'>Go back</a></div></div>
	<form name="contact_seller" id="contact_seller" class="searching_form" method="post" action="contact_seller.php">
<table width="100%" cellpadding="0" cellspacing="5" border="0" style="font-size:12px;">
		<tr>
		<td>
		
		<table width="100%" cellpadding="0" cellspacing="5" border="0" style="font-size:12px;">
		<tr><td colspan="3" class="redClr">* required</td></tr>
		<tr>
		<td colspan="3">
		{include file="error_msg_template.tpl"}
		{if $sms !=""}<span style="color:green;">{$sms}</span>{/if}</td>
		</tr>
		<tr>
			<td width="16%">First Name: <span class="redClr">*</span></td>
			<td width="16%"><input type="text" name="f_name" style="width:235px;" value="{$f_name}" class="required formInput" maxlength="30"/></td>
		    <td width="34%">&nbsp;</td>
		</tr>
		<tr>
			<td>Last Name: <span class="redClr">*</span></td>
			<td><input type="text" name="l_name" value="{$l_name}" style="width:235px;" class="required formInput" maxlength="30"/></td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>Phone No:</td>
			<td><input type="text" name="phone" style="width:235px;" value="" class="required formInput" maxlength="20"/></td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>E-mail: <span class="redClr">*</span></td>
			<td><input type="text" name="contact_email" value="{$contact_email}" style="width:235px;"  class="required email formInput" maxlength="60"/></td>
			<td>&nbsp;</td>
		</tr>
		
		<tr>
			<td valign="top">Message: <span class="redClr">*</span></td>
			<td><textarea name="message" class="formContactTextArea required" cols="40" rows="5">{$message}</textarea></td>
			<td>&nbsp;</td>
		</tr>
			
		<tr>
			<td>&nbsp;<input type="hidden" name="sentto" value="{$sendto}" /><input type='hidden' value='{$smarty.request.sellerid}' name='sellerid' id='sellerid'> </td>
			<td><input type="submit" name="send_message" class='Class_Button_ris'  value="Send Message" alt="Send Message" title="Send Message"  /></td>
			<td>&nbsp;</td>
		</tr>
		</table>
		
		</td>
		</tr>
	</table></form>

</div>

<div class="clear"></div>
</div>
<!--End Middle-->
{include file="footer.tpl"}