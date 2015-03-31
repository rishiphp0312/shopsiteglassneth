{include file="admin_top.tpl"}
<script language="javascript">
{literal}
function confirm_msg(id,VAL)
{
 if(VAL==1)
 var STR='restore';
 else
 var STR='suspend';

 jConfirm('Do you really want to '+STR+' this store?', 'Confirm', function(r)
 {

  if(r)
  {
   location.href='admin_approve_store.php?approve_id='+id+'&approve_store='+VAL;
  }
  else
  {
   return false;
  }

 });
}


function makeFeatured(user_id, fetured_status)
{
	if(fetured_status==1)
	var strMsg='featured';
	else
	var strMsg='un-featured';

       jConfirm('Do you really want to '+strMsg+' this store?', 'Confirm', function(r)
	{
		if(r)
		{
			location.href="admin_approve_store.php?action=featured&user_id="+user_id+"&fetured_status="+fetured_status;
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
	  <td valign="middle" class="bar">Manage Reported Items</td>
	</tr>
	<tr><td align="left" valign="top" class="border1">
	<form name="searchUser" id="searchUser" action="" method="get">
	<!--<table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#D5F1FF">
		  <tr>
			<td colspan="4" class="subheading">Search Stores/Sellers</td>
		  </tr>
		  <tr>
			<td bgcolor="#FFFFFF">Username:</td>
			<td bgcolor="#FFFFFF"><input name="username" type="text" id="username" class="input" value="{$username}" /></td>
			<td bgcolor="#FFFFFF">Store Name:</td>
			<td bgcolor="#FFFFFF"><input name="store_name"
type="text" id="store_name" class="input" value="{$store_name}" /></td>
			<td bgcolor="#FFFFFF">Email:</td>
			<td bgcolor="#FFFFFF"><input name="Email" type="text" id="Email" class="input" value="{$Email}" /></td>
		  </tr>
  <tr>
			<td bgcolor="#FFFFFF">Country:</td>
			<td bgcolor="#FFFFFF"><select  name="country_value"  id="country_value" class="input required" style="width:175px">
					<option values='0'>-- Select Country--</option>
{html_options values=$countryID output=$countryName selected=$selectcountry}
				</select></td>
			<td bgcolor="#FFFFFF">State:</td>
			<td bgcolor="#FFFFFF">
<input name="state" type="text" id="state" class="input" value="{$state}" /></td>
			<td bgcolor="#FFFFFF" >City :

			&nbsp;</td><td bgcolor="#FFFFFF" ><input name="city" type="text" id="city" class="input" value="{$city}" /> </td>
		  </tr>
		  <tr>
			<td bgcolor="#FFFFFF">First Name:</td>
			<td bgcolor="#FFFFFF"><input name="FirstName" type="text" id="keywords" class="input" value="{$FirstName}" /></td>
			<td bgcolor="#FFFFFF">Last Name:</td>
			<td bgcolor="#FFFFFF"><input name="LastName" type="text" id="keywords" class="input" value="{$LastName}" /></td>
			<td bgcolor="#FFFFFF" colspan="2">
                        <input name="form_member_search" type="submit" id="form_member_search" class="button" value="Search" />
			&nbsp; <input type="button" class="button" name="reset" value="Clear Search" onclick="window.location='admin_approve_store.php';" /></td>
		  </tr>
	  </table>-->
	  </form>
	</td>
	</tr>
	<tr>
	<td align="right">
	<div style="float:left;">{$page_counter} Items</div>
	</td>
	</tr>
	<tr>
	  <td align="left" valign="top" class="border1">
      <table width="100%" cellpadding="4" cellspacing="2" align="center">
       {if $usersList}
	<tr class="listHeadRow">
          <td>S. No.</td>
          <td>Reporter by Username</td>
	  <td>Reporter by Name</td>
	  <!--<td>Store Name</td>-->
          <td>Item Reported</td>
	  <td>Email</td>
	  <td>Reported Date</td>
          <!--<td>Suspended</td>
	  <td>Featured</td>
	--></tr>
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
	  <a href="admin_add_users.php?user_id={$user.buyer_id}&user_type={$user.user_type}" title="View Details" style="font-weight:normal;">
	  {$user.username}
	  </a>
	  </td>
	  <td>{$user.first_name} {$user.last_name}</td>
	  <!--<td>{$user.store_name}</td>-->
          <td>{$user.title}</td>
         
	  <td>{$user.email}</td>
	  <td>{$user.rep_date|date_format:"%b %d, %Y"}</td>
          <!--<td>
	  {if $user.approve_store==1}
	  <a href="javascript: void(0);" title="Suspend It" style="text-decoration:none;" onclick="confirm_msg({$user.user_id_value}, 0);">No</a>
	  {else}
	  <a href="javascript: void(0);" title="Restore It" style="text-decoration:none;" onclick="confirm_msg({$user.user_id_value}, 1);">Yes</a>
	  {/if}
	  </td>
	  <td>
	  {if $user.v_status==1}
	  <a href="javascript: void(0);" title="Un-Featured It" style="text-decoration:none;" onclick="makeFeatured({$user.user_id_value},0);">Yes</a>
	  {else}
	  <a href="javascript: void(0);" title="Featured It" style="text-decoration:none;" onclick="makeFeatured({$user.user_id_value},1);">No</a>
	  {/if}
	</td>-->
	</tr>
	{/foreach}
        <tr>
		<td colspan="8">
		<div style="float:left;">{$page_counter} Users</div>
		 {if $pageLink}
		<div class="admn_pagination_msg_board"><span style="float:right;">{$pageLink}</span></div>
		{/if}
	</td>
        </tr>
		{else}
		<tr><td colspan="8"><div class="no_record_found">No record found...!</div></td></tr>
		{/if}
      </table>
</td>
	</tr>
</table>
{include file="admin_bottom.tpl"} 