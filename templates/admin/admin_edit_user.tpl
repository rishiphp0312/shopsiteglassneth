{include file="admin_header.tpl"}
<div id="content">
<table width="100%" cellpadding="4" cellspacing="2" align="center" border="0">
<tr>
  <td class="heading_strip" colspan="2"><div style="float:left;">{$form_heading}</div></td>
</tr>
 <tr>
 <td valign="top">
 <form name="my_account" class="searching_form" id="my_account" method="post">
	 <table width="100%" cellpadding="4" cellspacing="2" align="center">
        <tr>
			<td colspan="2">{include file="error_msg_template.tpl"}</td>
		</tr>
	   {if $smarty.session.view_user_type==4}
	   <tr>
	   <td>First Name</td><td><input type="text" name="f_name" id="f_name" style="width:185px;" class="required" maxlength="40" value="{$user.first_name}"/></td>
	   </tr>
	    <tr>
	   <td>Last Name</td><td><input type="text" name="l_name" id="l_name" style="width:185px;" class="required" maxlength="40" value="{$user.last_name}"/></td>
	   </tr>
	   {else}
	   <tr>
          <td>Contact Name </td>
		  <td><input type="text" name="c_name" id="c_name" style="width:185px;" class="required" maxlength="40" value="{$user.company_name}"/></td>
	    </tr>
		{/if}
	   <tr>
         <td>Email</td>
         <td><input type="text" name="c_email" id="c_email" style="width:185px;" class="required email" maxlength="60" value="{$user.email}"/></td>
        </tr>
       <tr>
         <td>Password</td>
         <td><input type="password" id="pwd" name="pwd" style="width:185px;" class="required password" maxlength="20" value="{$user.password}"/></td>
       </tr>
	   <tr>
         <td>ConfirmPassword</td>
         <td><input type="password" id="conf_pwd" name="conf_pwd" equalTo="#pwd" style="width:185px;" class="required password" maxlength="20" value="{$user.password}"/></td>
       </tr>
       {if $smarty.session.view_user_type==3}
	   <tr>
         <td>Business Name</td>
         <td><input type="text" name="pb_name" style="width:185px;" class="required" maxlength="40" value="{$user.pb_name}"/></td>
        </tr>
       <tr>
         <td>Street Address </td>
         <td><input type="text" name="street_address" style="width:185px;" class="required" maxlength="40" value="{$user.street_address}"/></td>
        </tr>
       <tr>
         <td>City</td>
         <td><input type="text" name="city" style="width:185px;" class="required" maxlength="40" value="{$user.city}"/></td>
        </tr>
       <tr>
         <td>State</td>
         <td>{assign var=state_id value=$user.state_id}
			<select name="state_id" style="width:185px;" class="required">
					{html_options values="$stateID" output="$stateName" selected="$state_id"}
				</select></td>
        </tr>
       <tr>
         <td>Post Code </td>
         <td><input type="text" name="zipcode" style="width:185px;" class="required zipcode" maxlength="10"/ value="{$user.postcode}"></td>
        </tr>
       <tr>
         <td>Country</td>
         <td>{assign var=country_id value=$user.country_id}
			<select name="country_id" style="width:185px;" class="required">
					{html_options values="$countryID" output="$countryName" selected="$country_id"}
				</select></td>
        </tr>
	   {/if}
	   <tr>
	   <td>&nbsp;</td>
	   <td>
	   <input type="submit" name="Update" value="Update" class="button"> &nbsp;
	   <input type="button" name="Cancel" value="Cancel" class="button" onClick="window.location='admin_view_user_details.php';">
	   </td></tr>
      </table>
	  </form>
</td>
<td valign="top">{include file="admin_users_details_links.tpl"}</td>
</tr>
</table>
</div>
</div>
<div style="clear:both"></div>
</div>
<div id="box_bottom"></div>
{include file="admin_footer.tpl"} 