{include file="admin_top.tpl"}
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
		<input type="hidden" name="forum_user_id" value="{$forum_user_id}" />
		<table width="100%" border="0" cellspacing="0" cellpadding="4">
		<tr>
			<td width="32%" align="left" class="text">User Type </td>			<td width="22%">
				<input name="user_type"   type="radio" value="4" {if $UserType==4 || $UserType==''}checked {/if}class="radio" id="user_buyer"  />
				<label for="user_buyer">Buyer</label>
				<input name="user_type" type="radio" value="3"  class="radio" {if $UserType==3}checked {/if} id="user_seller"	/>
				<label for="user_seller">Seller</label>
				<div class="clr"></div>
				<img src="images/spacer.gif" height="1" width="1" />
			<td width="46%">
				<div style="padding-right:4px; text-align:right; float:right;{if $UserType=="3"} display:block;{else}display:none; {/if}">
				<input type="submit" name="featured_users" value="Make featured" class="button"  />
			</div></td>
		</tr>
		
		<tr>
			<td width="32%" align="left" class="text">First Name: *</td>
			<td width="22%">
				<input name="FirstName" type="text" value="{$FirstName}"    class="input required alph_num" id="FirstName" size="30" value="{$FirstName}" />
			</td>
			<td width="46%">&nbsp;</td>
		</tr>
		
		<tr>
			<td width="32%" align="left" class="text">Last Name: *</td>
			<td width="22%">
				<input name="LastName" type="text"  class="input required alph_num" id="LastName" size="30" value="{$LastName}" />
			</td>
			<td width="46%">&nbsp;</td>
		</tr>
		
		<tr>
			<td align="left" class="text">Email ID: *</td>
			<td>
				<input name="Email" type="text" class="input required email" id="Email" size="30" value="{$Email}" maxlength="50" />
			</td>
			<td>&nbsp;</td>
		</tr>
		
		<tr>
			<td align="left" class="text">Username: *</td>
			<td>
				<input name="username" type="text" class="input required username" id="username"	size="30" value="{$username}" maxlength="50" />
			</td>
			<td>&nbsp;</td>
		</tr>
		<!--<tr>
			<td align="left" class="text">Password: *</td>
			<td>
				<input name="Password" type="password" class="required input" id="Password" size="30" value="{$Password}" maxlength="20" />
			</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td align="left" class="text">Confirm Password: *</td>
			<td>
				<input name="RePassword" type="password" equalTo="#Password" class="required input" id="RePassword" size="30" value="{$Password}" maxlength="20" />
			</td>
			<td>&nbsp;</td>
		</tr>-->
		<tr>
			<td align="left" class="text">Phone1:</td>
			<td>
				<input name="phone1" type="text" class="input required" id="phone1" size="30" value="{$phone1}" maxlength="25" />
			</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td align="left" class="text">Zip:</td>
			<td>
				<input name="Zip" type="text" class="input num_zip" id="Zip" size="30" value="{$Zip}" maxlength="25" />
			</td>
			<td>&nbsp;</td>
		</tr>
		{if $UserType=="3"}
		<tr>
			<td align="left" class="text">State:</td>
			<td>
				<input name="state" type="text" class="input required" id="state" size="30" value="{$state}" maxlength="25" />
			</td>
			<td>&nbsp;</td>
		</tr>
		
		
		<tr>
			<td align="left" class="text">Country:</td>
			<td>
				<select class="formSel" name="country_value"  id="country_value" class="input required" style="width:175px">
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

		<tr>
			<td align="left" class="text">Paypal email:</td>
			<td>
				<input name="paypal_email" type="text" class="input required" id="paypal_email" size="30" value="{$paypal_email}" maxlength="25" />
			</td>
			<td>&nbsp;</td>
		</tr>

		<tr>
			<td align="left" class="text">Company name:</td>
			<td>
				<input name="company_name" type="text" class="input required" id="company_name" size="30" value="{$company_name}" maxlength="25" />
			</td>
			<td>&nbsp;</td>
		</tr>

		<tr>
			<td align="left" class="text">Company address:</td>
			<td>
				<textarea name="company_address" type="text" class="input required " id="company_address" value="" style="width:170px" > {$company_address}</textarea>
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

		<tr>
			<td align="left" class="text">Store name:</td>
			<td>
				<input name="store_name" type="text" class="input required" id="store_name" size="30" value="{$store_name}" maxlength="25" />
			</td>
			<td>&nbsp;</td>
		</tr>

		<tr>
			<td align="left" class="text">Welcome Note:</td>
			<td>
				<textarea name="v_welcome" type="text" class="input required" id="v_welcome" style="width:170px" > {$v_welcome} </textarea>
			</td>
			<td>&nbsp;</td>
		</tr>

		<tr>
			<td align="left" class="text">Payment Note:</td>
			<td>
				<textarea name="v_payment" type="text" class="input required" id="v_payment" style="width:170px"> {$v_payment} </textarea>
			</td>
			<td>&nbsp;</td>
		</tr>

		<tr>
			<td align="left" class="text">Shipping Note:</td>
			<td>
				<textarea name="v_shipping" type="text" class="input required" id="v_shipping" style="width:170px">{$v_shipping}</textarea>
			</td>
			<td>&nbsp;</td>
		</tr>

		<tr>
			<td align="left" class="text">Refund and exchange Note:</td>
			<td>
				<textarea name="v_refund_exchange" type="text" class="input required" id="v_refund_exchange" style="width:170px" >{$v_refund_exchange} </textarea>
			</td>
			<td>&nbsp;</td>
		</tr>

		<tr>
			<td align="left" class="text">Additional info Note:</td>
			<td>
				<textarea name="v_additional_info" type="text" class="input required" id="v_additional_info" style="width:170px"> {$v_additional_info}</textarea>
			</td>
			<td>&nbsp;</td>
		</tr>

		{/if}
		<tr style="display:none;">
			<td align="left" class="text">Email Alerts:</td>
			<td>
				<input type="radio" name="EmailAlert" id="EmailAlert_1" value="1" {if $EmailAlert==1}checked{/if}>&nbsp;Buying & Selling<br/>
				<input type="radio" name="EmailAlert" id="EmailAlert_2" value="2" {if $EmailAlert==2}checked{/if}>&nbsp;Letting & Renting<br/>
				<input type="radio" name="EmailAlert" id="EmailAlert_3" value="3" {if $EmailAlert==3}checked{/if}>&nbsp;Prices & Promotions	
			</td>
			<td>&nbsp;</td>
		</tr>

		<tr style="display:none;">
			<td align="left" class="text">Newsletter:</td>
			<td>
				<input type="radio" name="nLetter" id="nLetter_1" value="1" {if $nLetter==1}checked{/if}>&nbsp;Daily<br/>
				<input type="radio" name="nLetter" id="nLetter_2" value="7" {if $nLetter==7}checked{/if}>&nbsp;Weekly<br/>
				<input type="radio" name="nLetter" id="nLetter_3" value="30" {if $nLetter==30}checked{/if}>&nbsp;Monthly
			</td>
			<td>&nbsp;</td>
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