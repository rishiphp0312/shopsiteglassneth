{include file="header.tpl"}
{include file="header_search.tpl"}
{*include file="gallery.tpl"*}
<!--Start Middle Part -->
	<div id="middle_container">
		<!--Start Middle Left -->
		<div class="midle_left">
			<h1>Edit Profile</h1> 
		 	<div class="recourses_detail_block">
			{include file="my_account_links.tpl"}
			<form id="frmRegister" name="frmRegister" method="post" action="edit_profile.php">
<table width="100%" border="0" cellspacing="0" cellpadding="4"> 
				<tr><td colspan="4">{#require_msg#}</td></tr>
				<tr><td colspan="4">{include file='error_msg_template.tpl'}</td></tr>
				<tr>
				  <td width="20%" align="left" valign="top" class="text">First Name : *</td>
				  <td width="1%">&nbsp;</td>
				  <td><input name="FirstName" id="FirstName" type="text" class="required alph_num login_input"  size="20" value="{$UserArr.FirstName}" maxlength="20" /></td>
				  <td>&nbsp;</td>
				</tr>
				<tr>
				  <td align="left" valign="top" class="text">Last Name : *</td>
				  <td>&nbsp;</td>
				  <td width="26%"><input name="LastName" type="text" class="required alph_num login_input" id="LastName" size="20" value="{$UserArr.LastName}" maxlength="20" /></td>
				  <td width="53%">&nbsp;</td>
				</tr>
				
				<tr>
				  <td align="left" valign="top" class="text">Email ID : *</td>
				  <td>&nbsp;</td>
				  <td><input name="Email" type="text" class="required email login_input" id="Email" size="20" value="{$UserArr.Email}" maxlength="50"/></td>
			      <td>&nbsp;</td>
				</tr>
				<tr>
				  <td align="left" valign="top" class="text">Contact No. :</td>
				  <td>&nbsp;</td>
				  <td><input name="Phone" type="text" class="num_phone login_input" id="Phone" size="20" value="{$UserArr.Phone}" maxlength="20" /></td>
				  <td>&nbsp;</td>
				</tr>
				<tr>
				  <td align="left" valign="top" class="text">Street No. : </td>
				  <td>&nbsp;</td>
				  <td><input name="street_no" type="text" class="login_input" id="street_no" size="20" value="{$UserArr.street_no}" maxlength="40" /></td>
				  <td>&nbsp;</td>
				</tr>
				<tr>
				  <td align="left" valign="top" class="text">Street Name : </td>
				  <td>&nbsp;</td>
				  <td><input name="street_name" type="text" class="login_input" id="street_name" size="20" value="{$UserArr.street_name}" maxlength="40" /></td>
				  <td>&nbsp;</td>
				</tr>
				<tr>
				  <td align="left" valign="top" class="text">City : </td>
				  <td>&nbsp;</td>
				  <td><input name="city" type="text" class="login_input" id="city" size="20" value="{$UserArr.city}" maxlength="40" /></td>
				  <td>&nbsp;</td>
				</tr>
				<tr>
				  <td align="left" valign="top" class="text">State : </td>
				  <td>&nbsp;</td>
				  <td><input name="state" type="text" class="login_input" id="state" size="20" value="{$UserArr.state}" maxlength="40" /></td>
				  <td>&nbsp;</td>
				</tr>
				<tr>
				  <td align="left" valign="top" class="text">Zip Code : </td>
				  <td>&nbsp;</td>
				  <td><input name="Zip" type="text" class="num_zip login_input" id="Zip" size="20" value="{$UserArr.Zip}" maxlength="20" /></td>
				  <td>&nbsp;</td>
				</tr>
				<tr style="display:none;">
				  <td align="left" valign="top" class="text">Email Alerts : </td>
				  <td>&nbsp;</td>
				  <td colspan="2">	
				  		<input type="radio" name="EmailAlert" id="EmailAlert_1" value="1" {if $UserArr.EmailAlert==1}checked{/if}>&nbsp;Buying & Selling<br/>
						<input type="radio" name="EmailAlert" id="EmailAlert_2" value="2" {if $UserArr.EmailAlert==2}checked{/if}>&nbsp;Letting & Renting<br/>
						<input type="radio" name="EmailAlert" id="EmailAlert_3" value="3" {if $UserArr.EmailAlert==3}checked{/if}>&nbsp;Prices & Promotions				  </td>
				</tr>
				<tr style="display:none;">
				  <td align="left" valign="top" class="text">Newsletter : </td>
				  <td>&nbsp;</td>
				  <td colspan="2">	
				  		<input type="radio" name="nLetter" id="nLetter_1" value="1" {if $UserArr.nLetter==1}checked{/if}>&nbsp;Daily<br/>
						<input type="radio" name="nLetter" id="nLetter_2" value="7" {if $UserArr.nLetter==7}checked{/if}>&nbsp;Weekly<br/>
						<input type="radio" name="nLetter" id="nLetter_3" value="30" {if $UserArr.nLetter==30}checked{/if}>&nbsp;Monthly				  </td>
				</tr>
				
				<tr>
				  <td>&nbsp;</td>
				  <td>&nbsp;</td>
				  <td colspan="2"><input name="update_profile" type="submit" value="Update Profile" class="button" /> <input name="cancel" type="button" value="Cancel" class="button" onclick="window.location='my_account.php';" /></td>
				</tr>
			  </table>
</form>
			</div>
		</div>
		<!--End Middle Left -->
		{include file="middle_right.tpl"}
	</div>
	<!--End Middle Part -->
{include file="footer.tpl"}