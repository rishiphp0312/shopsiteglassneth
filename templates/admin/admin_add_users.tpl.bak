{include file="admin_top.tpl"}
  <table width="100%"  border="0" cellspacing="10" cellpadding="5">
	<tr>
	  <td valign="middle" class="bar">Add/Edit Member</td>
	</tr>
	<tr>
	  <td align="left" valign="top" class="border1">
	  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr><td>{#require_msg#}</td></tr>
		<tr><td>{include file='admin_error_msg_template.tpl'} {if $smarty.request.user_id!=""}<div style="text-align:right; float:right;"><input type="button" name="mail_sel_users" value="Send Notification Email" class="button" onclick="window.location='admin_user_send_mail.php?user_id={$smarty.request.user_id}';" /></div>{/if}</td></tr>
		<tr>
		  <td width="710" class="lback">
		  <form name="frmAddUser" id="frmAddUser" method="post" style="margin:0px;">
		     <input type="hidden" name="forum_user_id" value="{$forum_user_id}" />
			 <table width="100%" border="0" cellspacing="0" cellpadding="4">
				 
				
				<tr>
				  <td width="32%" align="left" class="text">User Type </td>
				  <td width="22%">
				<input name="user_type"   type="radio" value="4" {if $UserType==4 || $UserType==''}checked {/if}class="radio" 
				id="user_buyer"  /><label for="user_buyer">Buyer</label>
				<input name="user_type" type="radio" value="3"  class="radio" {if $UserType==3}checked {/if} id="user_seller"
				 /><label for="user_seller">Seller</label></div>
					<div class="clr"><img src="images/spacer.gif" height="1" width="1" />


		
				  <td width="46%">&nbsp;</td>
				</tr>
				<tr>
				  <td width="32%" align="left" class="text">First Name: *</td>
				  <td width="22%"><input name="FirstName" type="text" value="{$FirstName}"    class="input required alph_num" id="FirstName" size="30" value="{$FirstName}" /></td>
				  <td width="46%">&nbsp;</td>
				</tr>
				<tr>
				  <td width="32%" align="left" class="text">Last Name: *</td>
				  <td width="22%"><input name="LastName" type="text"  class="input required alph_num" id="LastName" size="30"
				  value="{$LastName}" /></td>
				  <td width="46%">&nbsp;</td>
				</tr>
				<tr>
				  <td align="left" class="text">Email ID: *</td>
				  <td><input name="Email" type="text" class="input required email" id="Email" 
				  size="30" value="{$Email}" maxlength="50" /></td>
				  <td>&nbsp;</td>
				</tr>
				<tr>
				  <td align="left" class="text">Username: *</td>
				  <td><input name="username" type="text" class="input required username" id="username" 
				  size="30" value="{$username}" maxlength="50" /></td>
				  <td>&nbsp;</td>
				</tr>
				<!--<tr>
				  <td align="left" class="text">Password: *</td>
				  <td><input name="Password" type="password" class="required input" id="Password" size="30" value="{$Password}" maxlength="20" /></td>
				  <td>&nbsp;</td>
				</tr>
				<tr>
				  <td align="left" class="text">Confirm Password: *</td>
				  <td><input name="RePassword" type="password" equalTo="#Password" class="required input" id="RePassword" size="30" value="{$Password}" maxlength="20" /></td>
				  <td>&nbsp;</td>
				</tr>-->
				<tr>
				  <td align="left" class="text">Phone:</td>
				  <td><input name="Phone" type="text" class="input num_phone" id="Phone" size="30" value="{$Phone}" maxlength="25" /></td>
				  <td>&nbsp;</td>
				</tr>
				<tr>
				  <td align="left" class="text">Zip:</td>
				  <td><input name="Zip" type="text" class="input num_zip" id="Zip" size="30" value="{$Zip}" maxlength="25" /></td>
				  <td>&nbsp;</td>
				</tr>
				<tr style="display:none;">
				  <td align="left" class="text">Email Alerts:</td>
				  <td><input type="radio" name="EmailAlert" id="EmailAlert_1" value="1" {if $EmailAlert==1}checked{/if}>&nbsp;Buying & Selling<br/>
						<input type="radio" name="EmailAlert" id="EmailAlert_2" value="2" {if $EmailAlert==2}checked{/if}>&nbsp;Letting & Renting<br/>
						<input type="radio" name="EmailAlert" id="EmailAlert_3" value="3" {if $EmailAlert==3}checked{/if}>&nbsp;Prices & Promotions	</td>
				  <td>&nbsp;</td>
				</tr>
				<tr style="display:none;">
				  <td align="left" class="text">Newsletter:</td>
				  <td><input type="radio" name="nLetter" id="nLetter_1" value="1" {if $nLetter==1}checked{/if}>&nbsp;Daily<br/>
						<input type="radio" name="nLetter" id="nLetter_2" value="7" {if $nLetter==7}checked{/if}>&nbsp;Weekly<br/>
						<input type="radio" name="nLetter" id="nLetter_3" value="30" {if $nLetter==30}checked{/if}>&nbsp;Monthly</td>
				  <td>&nbsp;</td>
				</tr>
				<tr>
				  <td>&nbsp;</td>
				  <td><input name="save" type="submit" class="button" value="Save" />
					  <input name="cancel" type="reset" class="button" value="Cancel" onclick="window.location='admin_users.php'" /></td>
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