{include file="header.tpl"}
{include file="js_css_validation.tpl"}
{include file="header_search.tpl"}
<!--Start Middle-->
	<div id="middleMain">
			{include file="left_category.tpl"}
		<div id="middleRtMain">
			<div class="registerBg">
				<div class="registerSUbHd">Change Address <div class="reqField">*required</div></div>
				<form id="frmChangeAddress" name="frmChangeAddress" method="post">
			
					<table width="100%" border="0" cellspacing="0" cellpadding="4">
					<tr><td colspan="4">{include file='error_msg_template.tpl'}</td></tr>
					<tr>
					  <td width="29%" align="left" valign="top" class="text">Change Address1: <span class="redClr">*</span></td>
					  <td width="1%">&nbsp;</td>
					  <td width="33%"><input name="change_address1" id="change_address1"
					  type="text" class="required formInput" 
					  size="20" value="{$fetch_address1}" maxlength="25" /></td>
					  <td width="37%">&nbsp;</td>
					</tr>
					<tr>
					  <td width="29%" align="left" valign="top" class="text">Change Address2:
</td>
					  <td width="1%">&nbsp;</td>
					  <td width="33%"><input name="change_address2" id="change_address2"
					  type="text" class="formInput"
					  size="20" value="{$fetch_address2}" maxlength="25" /></td>
					  <td width="37%">&nbsp;</td>
					</tr>
<tr>
					  <td width="29%" align="left" valign="top" class="text">Change Zipcode: <span class="redClr">*</span></td>
					  <td width="1%">&nbsp;</td>
					  <td width="33%"><input name="zipcode" id="zipcode"
					  type="text" class="required formInput"
					  size="20" value="{$fetch_zipcode}" maxlength="25" /></td>
					  <td width="37%">&nbsp;</td>
					</tr>
                                        <tr>
					  <td width="29%" align="left" valign="top" class="text">City
</td>
					  <td width="1%">&nbsp;</td>
					  <td width="33%"><input name="" id="change_city"
					  type="text" class="formInput"	  size="20" value="{$fetch_city}" maxlength="25" /></td>
					  <td width="37%">&nbsp;</td>
					</tr>
                                     <tr>
					  <td width="29%" align="left" valign="top" class="text">State</td>
					  <td width="1%">&nbsp;</td>
					  <td width="33%"><input name="change_state" id="change_state"
					  type="text" class="formInput"
					  size="20" value="{$fetch_state}" maxlength="25" /></td>
					  <td width="37%">&nbsp;</td>
					</tr>

                                      <tr>
					  <td width="29%" align="left" valign="top" class="text">Country</td>
					  <td width="1%">&nbsp;</td>
					  <td width="33%">
                                        <select class="formSel" name="country_value"  id="country_value">
					{html_options values=$countryID output=$countryName selected=$fetch_country}
					</select></td>
					  <td width="37%">&nbsp;</td>
					</tr>
                                    <tr>
					  <td>&nbsp;</td>
					  <td>&nbsp;</td>
					  <td colspan="2">
					  <input name="change_address_submit" type="submit" value="Change Address" class="button" /> 
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