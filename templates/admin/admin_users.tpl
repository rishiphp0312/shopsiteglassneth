{include file="admin_top.tpl"}
<script language="javascript">
{literal}
function confirm_msg(val,id)
{
 	if(val==1)
	{
		var STR='Activate';
		var val_status=1;
	}
	else if(val==2)
	{
		var STR='Restore';
		var val_status=99;
	}
	else if(val==3)
	{
		var STR='Delete';
		var val_status=100;
	}
	else
	{
		var val_status=0;
		var STR='DeActivate';
	}
	jConfirm('Do you really want to '+STR+' this user?', 'Confirm', function(r) 
	{
		if(r)
		{	
		
		window.location.href='admin_users.php?ACT_VAL='+val_status+'&user_id='+id;
				
				}
		else
		{
			return false;
		}	
	});
}

{/literal}
</script>
<table width="100%"  border="0" cellspacing="10" cellpadding="5">
	<tr>
	  <td valign="middle" class="bar">{$form_heading}</td>
	</tr>
	<tr><td align="left" valign="top" class="border1">
	<form name="searchUser" id="searchUser" action="" method="get">
	<table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#D5F1FF">
		  <tr>
			<td colspan="4" class="subheading">Member  Search</td>
		  </tr>
		  <tr>
			<td bgcolor="#FFFFFF">Username:</td>
			<td bgcolor="#FFFFFF"><input name="username" type="text" id="username" class="input" value="{$username}" /></td>
			<td bgcolor="#FFFFFF"><!--Store Name:--></td>
			<td bgcolor="#FFFFFF"><!--<input name="store_name" type="text" id="store_name" class="input" value="{$store_name}" />--></td>
			<td bgcolor="#FFFFFF" align='left' >Country</td>
			<td bgcolor="#FFFFFF"><select  name="country_value"  id="country_value" class="input required" style="width:175px">
				<option values='0'>-- Select Country--</option>
                              {html_options values=$countryID output=$countryName selected=$selectcountry}
				</select>
                        </td>
		  </tr>
                   <tr>
			<td bgcolor="#FFFFFF">City:</td>
			<td bgcolor="#FFFFFF"><input name="city" type="text" id="city" class="input" value="{$city}" /></td>
			<td bgcolor="#FFFFFF">State:</td>
			<td bgcolor="#FFFFFF"><input name="state" type="text" id="state" class="input" value="{$state}" /></td>
			<td bgcolor="#FFFFFF" align='left' >Date of<br> Registration</td>
			<td bgcolor="#FFFFFF"><select style='font-size:12px;width:70px;'  name="sel_days">
                 <option value='0' >--Days--</option>
		 {html_options values=$no_of_days_curentmonth output=$no_of_days_curentmonth selected=$sel_days}
			</select>&nbsp;&nbsp;<select name="sel_month">
                       <option value='0' >--Month--</option>
		       {html_options values=$array_for_id output=$array_for_month selected=$sel_month}
			</select> &nbsp;&nbsp;<br><br>   <select name="sel_year">
                  
		 {html_options values=$year_12 output=$year_12 selected=$sel_year }
			</select>&nbsp;Year
                        </td>
		  </tr>
		  <tr>
			<td bgcolor="#FFFFFF">First Name:</td>
			<td bgcolor="#FFFFFF"><input name="FirstName" type="text" id="keywords" class="input" value="{$FirstName}" /></td>
			<td bgcolor="#FFFFFF">Last Name:</td>
			<td bgcolor="#FFFFFF"><input name="LastName" type="text" id="keywords" class="input" value="{$LastName}" /></td>
			<td bgcolor="#FFFFFF" colspan="2"><input name="form_member_search" type="submit" id="form_member_search" class="button" value="Search" />
			&nbsp; <input type="button" class="button" name="reset" value="Clear Search" onclick="window.location='admin_users.php';" /></td>
		  </tr>
		  <tr>
			<td bgcolor="#FFFFFF">Email:</td>
			<td width="19%" bgcolor="#FFFFFF"><input name="Email" type="text" id="Email" class="input" value="{$Email}" /></td>
			<td bgcolor="#FFFFFF">Status</td>
			<td bgcolor="#FFFFFF">
			<input type="radio" name="status" value="YN" {$chkBoth}>Both
			<input type="radio" name="status" value="Y" {$chkActive}>Active
			<input type="radio" name="status" value="N" {$chkInActive}>InActive
			</td>
			<td bgcolor="#FFFFFF" colspan="2"><input type="button" name="mail_all_users" value="Send Notification Email" class="button" onclick="window.location='admin_send_bulk_mail.php';" /></td>
		  </tr>
	  </table>
	  </form>
	</td>
	</tr>
	<tr>
	<td align="right">
	<div style="float:left;">{$page_counter} Users</div> 
	</td>
	</tr>	
	<tr>
	  <td align="left" valign="top" class="border1">
      <table width="100%" cellpadding="4" cellspacing="2" align="center">
       {if $usersList}
	<tr class="listHeadRow">
          <td>S. No.</td>
          <td>Username</td>
	  <td>Name</td>
	  <!--<td nowrap >Store Name</td>-->
          <td>Country</td>
          
          <td>City</td><td>State</td>
	  <td>Email</td>
	  <!--<td>User Type</td>-->
	  <td>Registration Date</td>
          <td>Status</td>
	  <td>Options</td>
	</tr>
	{foreach name=users from=$usersList item=user}
	<tr bgcolor="{cycle values='#f5f5f5,#e6e6e6'}">
	<td>
	  {if $smarty.request.pageNumber!="" && $smarty.request.pageNumber>1}
	  {assign var=pageconut value=$smarty.request.pageNumber-1}
	  {$smarty.const.ADMIN_PAGE_NUMBER*$pageconut+$smarty.foreach.users.iteration}.
	  {else}
	  {$smarty.foreach.users.iteration}.
	  {/if}
	  </td>
          <td>
	  <a href="admin_add_users.php?user_id={$user.user_id_value}&user_type={$user.user_type}" title="View Details" style="font-weight:normal;">
	  {$user.username}
	  </a>
	  </td>
	  <td>{$user.first_name} {$user.last_name}</td>
	 <!-- <td>{$user.store_name}</td>-->
	 
	 <td>{$user.country}</td>
          <td>{$user.city}</td><td>{$user.state}</td>
	  <td>{$user.email}</td>
	 <!-- <td>{$userTypeArr[$user.user_type]}</td>-->
	  <td>{$user.reg_date|date_format:"%b %d, %Y"}</td>
          <td>
	  {if $user.usr_stat_val==1}
	  <a href="javascript: void(0);" title="De-Activate It" style="text-decoration:none;" onclick="confirm_msg(0,{$user.user_id_value});">De-Activate</a>{else}
	  <a href="javascript: void(0);" title="Activate It" style="text-decoration:none;" onclick="confirm_msg(1,{$user.user_id_value});">Activate</a>
	  {/if}
	  </td>
	  <td>
		  <a href="admin_add_users.php?user_id={$user.user_id_value}&user_type={$user.user_type}" style="text-decoration:none;" title="Edit">
		  	<img src="{$baseUrl}/images/edit_icon.png" alt="Edit" border="0" />
		  </a>
		   &nbsp;
		  {if $user.isdeleted==1}
		  <a href="javascript: void(0);" title="Restore" style="text-decoration:none;" onclick="confirm_msg(2,{$user.user_id_value});"><img src="{$baseUrl}/images/restore.png" alt="Restore" border="0" /></a>
	      {else}			 
<a href="javascript: void(0);" title="Delete" style="text-decoration:none;"
onclick="confirm_msg(3,{$user.user_id_value});"><img src="{$baseUrl}/images/dlt_icon.png" alt="Delete" border="0" /></a>
		 {/if}
		</td>
		</tr>
		{/foreach}
        <tr>
			<td colspan="9">
			<div style="float:left;">{$page_counter} Users</div>
			 {if $pageLink}
			<div class="admn_pagination_msg_board">
			<span style="float:right;">{$pageLink}</span>
			</div>
			 {/if}
			</td>
        </tr>
		{else}
		<tr><td colspan="9"><div class="no_record_found">No record found...!</div></td></tr>
		{/if}
      </table>
</td>
	</tr>
</table>	  
{include file="admin_bottom.tpl"} 