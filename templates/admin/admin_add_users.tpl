
{include file="admin_top.tpl"}

<script language="javascript">
{literal}
function val_change(NUM)
{
	if(NUM==3)
	{
		document.getElementById('seller_td').style.display='';
	}
	else
	{
		document.getElementById('seller_td').style.display='none';
	}
}
{/literal}

</script>
<table width="100%"  border="0" cellspacing="10" cellpadding="5">
<tr>
  <td valign="middle" class="bar">Add/Edit Member</td>
</tr>
<tr>
  <td align="left" valign="top" class="border1">
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr><td>{#require_msg#}</td></tr>
	<tr>
		<td>
			{include file='admin_error_msg_template.tpl'}
			{if $smarty.request.user_id!=""}
			<div style="text-align:right; float:right;">
				<input type="button" name="mail_sel_users" value="Send Notification Email" class="button" onclick="window.location='admin_user_send_mail.php?user_id={$smarty.request.user_id}';" />
			</div>&nbsp;
			
			{/if}
		</td>
	</tr>
	<tr>
		<td width="710" class="lback">
		<form name="frmAddUser" id="frmAddUser" method="post" style="margin:0px;">
		
		<table width="100%" border="0" cellspacing="0" cellpadding="4">
	
		<tr>
			<td width="20%">First Name: *</td>
			<td>
				<input name="FirstName" type="text" value="{$FirstName}"  class="input required alph_num" id="FirstName" size="30"  />
			</td>
			<td>&nbsp;</td>
		</tr>
		
		<tr>
			<td>Last Name: *</td>
			<td>
				<input name="LastName" type="text"  class="input required alph_num" id="LastName" size="30" value="{$LastName}" />
			</td>
			<td>&nbsp;</td>
		</tr>
		
		<tr>
			<td>Email ID: *</td>
			<td>
				<input name="Email" type="text" class="input required email" id="Email" size="30" value="{$Email}" maxlength="50" />
			</td>
			<td>&nbsp;</td>
		</tr>
		
		<tr>
			<td>Username: *</td>
			<td>
				<input name="username" type="text" class="input required username" id="username" size="30" value="{$username}" maxlength="50" />
			</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>Phone1:</td>
			<td>
				<input name="phone1" type="text" class="input required" id="phone1" size="30" value="{$phone1}" maxlength="25" />
			</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>Zip:</td>
			<td>
				<input name="Zip" type="text" class="input num_zip" id="Zip" size="30" value="{$Zip}" maxlength="25" />
			</td>
			<td>&nbsp;</td>
		</tr>
		
			<tr>
			<td   colspan="3" align="left" >
		<table width="100%" border="0" cellspacing="0" cellpadding="4">
		<tr>
			<td width="20%">State:</td>
			<td width="30%"><input name="state" type="text" class="input required" id="state" size="30" value="{$state}" maxlength="25" /></td>
			<td width="50%">&nbsp;</td>
		</tr>
<tr>
			<td width="20%">City :</td>
			<td width="30%"><input name="city_value" type="text" class="input required" id="city_value" size="30" value="{$city_value}" maxlength="25" /></td>
			<td width="50%">&nbsp;</td>
		</tr>
		<tr>
			<td align="left" class="text">Country:</td>
			<td>
				<select  name="country_value"  id="country_value" class="input required" style="width:175px">
					{html_options values=$countryID output=$countryName selected=$c}
				</select>
				
			</td>
			<td>&nbsp;</td>
		</tr>

		

		<tr>
			<td align="left" class="text">Phone2:</td>
			<td>
				<input name="phone2" type="text" class="input" id="phone2" size="30" value="{$phone2}" maxlength="25" />
			</td>
			<td>&nbsp;</td>
		</tr>
		{*
		<tr>
			<td align="left" class="text">Paypal email:</td>
			<td>
				<input name="paypal_email" type="text" class="input required" id="paypal_email" size="30" value="{$paypal_email}" maxlength="25" />
			</td>
			<td>&nbsp;</td>
		</tr>
		*}
		<tr>
			<td align="left" class="text">Company name:</td>
			<td>
				<input name="company_name" type="text" class="input required" id="company_name" size="30" value="{$company_name}" maxlength="25" />
			</td>
			<td>&nbsp;</td>
		</tr>

		<tr>
			<td align="left" class="text">Company address:</td>
			<td><textarea name="company_address" type="text" class="input required " id="company_address" value="" style="width:170px" >{$company_address}</textarea>
			</td>
			<td>&nbsp;</td>
		</tr>

		<tr>
			<td align="left" class="text">Company phone:</td>
			<td>
				<input name="company_phone" type="text" class="input required" id="company_phone" size="30" value="{$company_phone}" maxlength="25" />
			</td>
			<td>&nbsp;</td>
		</tr>

		<tr>
			<td align="left" class="text">Company desc:</td>
			<td>
				<textarea name="company_desc" type="text" class="input" id="company_desc" style="width:170px" >{$company_desc}</textarea>
			</td>
			<td>&nbsp;</td>
		</tr>

		<!--<tr>
			<td align="left" class="text">Store name:</td>
			<td>
				<input name="store_name" type="text" class="input required" id="store_name" size="30" value="{$store_name}" maxlength="25" />
			</td>
			<td>&nbsp;</td>
		</tr>-->

		<tr>
			<td align="left" class="text">Welcome Note:</td>
			<td>
				<textarea name="v_welcome" type="text"
class="input required" id="v_welcome" style="width:170px;" >{$v_welcome}</textarea>
			</td>
			<td>&nbsp;</td>
		</tr>

		<tr>
			<td align="left" class="text">Payment Note:</td>
			<td>
				<textarea name="v_payment" type="text"
class="input required" id="v_payment" style="width:170px;">{$v_payment}</textarea>
			</td>
			<td>&nbsp;</td>
		</tr>

		<tr>
			<td align="left" class="text">Shipping Note:</td>
			<td>
				<textarea name="v_shipping" type="text"
class="input required" id="v_shipping" style="width:170px;">{$v_shipping}</textarea>
			</td>
			<td>&nbsp;</td>
		</tr>

		<tr>
			<td align="left" class="text">Refund and exchange Note:</td>
			<td>
				<textarea name="v_refund_exchange" type="text" class="input required" id="v_refund_exchange" style="width:170px;" >{$v_refund_exchange} </textarea>
			</td>
			<td>&nbsp;</td>
		</tr>

		<tr>
			<td align="left" class="text">Additional info Note:</td>
			<td>
			<textarea name="v_additional_info" type="text"
class="input required" id="v_additional_info" style="width:170px;">{$v_additional_info}</textarea>
			</td>
			<td>&nbsp;</td>
		</tr>

		
	
			
			</table>
			
			</td>
		
		</tr>
		
				
		
		

		
		<tr>
			<td>&nbsp;</td>
			<td>
				<input name="save" type="submit" class="button" value="Save" />
				<input name="cancel" type="reset" class="button" value="Cancel" onclick="window.location='admin_users.php'" />
			</td>
			<td>&nbsp;</td>
		</tr>
	</table>
	</form>
	</td>
	</tr>
</table>
</td>
</tr>
</table>
{include file="admin_bottom.tpl"}