{include file="admin_top.tpl"}
<script language="javascript">
{literal}
function confirm_msg(id,val)
{
//alert(val+'id');
if(val==1)
{
    jConfirm('Do you really want to Suspend this Item?', 'Confirm', function(r)
	{
		if(r)
		{
			location.href='admin_products_listing.php?suspend_item_value='+id;
		}
		else
		{
			return false;
		}
	});

}
else if(val==2)
{
 jConfirm('Do you really want to Approve this Item?', 'Confirm', function(r)
	{
		if(r)
		{
			location.href='admin_products_listing.php?approve_item_value='+id;
		}
		else
		{
			return false;
		}
	});
}

else if(val==6)
{
 jConfirm('Do you really want to make this Item Handpicked?', 'Confirm', function(r)
	{
		if(r)
		{
			location.href='admin_products_listing.php?handpicked_item_value='+id;
		}
		else
		{
			return false;
		}
	});
}
else
	{
	jConfirm('Do you really want to delete this Item?', 'Confirm', function(r)
	{
		if(r)
		{
			location.href='admin_products_listing.php?delete_item_value='+id;
		}
		else
		{
			return false;
		}
	});
	}
}
{/literal}
</script>
<table width="100%"  border="0" cellspacing="10" cellpadding="5">
	<tr>
	  <td valign="middle" class="bar">{$form_heading}</td>
	</tr>
	<tr><td align="left" valign="top" class="border1"><form action="" method="get">
	 <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#D5F1FF">
		
		  <tr class="c3">
			<td colspan="4" class="subheading">Search Package</td>
		  </tr>
  <tr class="c2">
			<td bgcolor="#FFFFFF"colspan="5">Purchase Date<input type='radio' value='0'{if $select_date=='' || $select_date==0}checked='checked'{/if} name='select_date'>&nbsp;&nbsp; Expired Date<input type='radio' value='1'{if  $select_date==1}checked {/if}name='select_date'></td>
		  </tr>
		<tr class="c2">
			<td bgcolor="#FFFFFF" colspan='2'><select style='font-size:12px;width:70px;'  name="sel_days">
                 <option value='0' >--Days--</option>
		 {html_options values=$no_of_days_curentmonth output=$no_of_days_curentmonth selected=$sel_days}
			</select>&nbsp;&nbsp;
			<select name="sel_month">
                 <option value='0' >--Month--</option>
		 {html_options values=$array_for_id output=$array_for_month selected=$sel_month}
			</select>
			  Month&nbsp;
		    <select name="sel_year">
		 {html_options values=$year_12 output=$year_12 selected=$sel_year }
			</select>&nbsp;&nbsp;
		      Year</td>
			<td bgcolor="#FFFFFF" nowrap>Seller's Username:</td>
			<td bgcolor="#FFFFFF" >
			<input name="username" type="text" id="username" class="input" value="{$username}" /></td>

			<td bgcolor="#FFFFFF">
		Cost of Package :&nbsp;
<input name="package_cost" type="text" id="package_cost" class="input" value="{$package_cost}" style='width:80px;' /></td>
		  </tr>
		  <tr class="c1">
			<td bgcolor="#FFFFFF">By Country &nbsp;</td>
			<td width="19%" bgcolor="#FFFFFF">
		<select  name="country_value"  id="country_value" class="input required" style="width:175px">
				<option value='0'>-- Select Country--</option>
                              {html_options values=$countryID output=$countryName selected=$selectcountry}
				</select></td>
			<td bgcolor="#FFFFFF">Seller's State:</td>
			<td bgcolor="#FFFFFF"  nowrap>&nbsp;<input name="state" type="text" id="state" class="input" value="{$state}" /></td>
			<td bgcolor="#FFFFFF">
			<input name="form_member_search" type="submit" id="form_member_search" class="button"
			value="Search" />
			&nbsp; <input type="button" class="button" name="reset"
			value="Clear Search" onclick="window.location='admin_reports_purchased_packages.php';" /></td>
		  </tr>

		
	  </table></form>
	</td>
	</tr>
	<tr>
	<td align="right">
	<div style="float:left;">{$page_counter} Products</div>
	<!--<input type="button" name="mail_all_users" value="Send Notification Email" class="button" onclick="window.location='admin_send_bulk_mail.php';" />
	 {if $usersList}
	 <input type="button" name="btnExport" value="Export Users" class="button" onclick="window.location='admin_export_users.php?{$smarty.server.QUERY_STRING}';" />
	{/if}
	</td> -->
	</tr>
	<tr>
	  <td align="left" valign="top" class="border1">
      <table width="100%" cellpadding="4" cellspacing="2" align="center">
       {if $page_some }
<tr >
        <td valign='top'align='left'colspan=2>Total Cost Of Sold Packages</td>
       <td colspan=6 valign='top' align='left'style='font-size:12px;color:#885e36;font-weight:bold;text-align:left;'>$ {$tot_purchase_cost_packg}</td>
</tr>
		<tr class="listHeadRow"><td valign='top'align='left'>S. No.</td>
<td valign='top'align='left'>Username</td>
                                        <td valign='top'align='left'>Seller's Name</td>
		                        <td valign='top'align='left'>Package Cost </td>
                                        <td nowrap valign='top' align='left'> Package Name </td>
		                        <td valign='top' align='left'> Expiry Date  </td>

		                       <td valign='top' align='left' >Purchased Date </td>
				               <td></td>

		</tr>
		{foreach name=prods from=$productList item=prod}

		<tr bgcolor="{cycle values='#f5f5f5,#e6e6e6'}">
          <td valign='top'align='left'>
		  {if $smarty.request.pageNumber!="" && $smarty.request.pageNumber>1}
		  {assign var=pageconut value=$smarty.request.pageNumber-1}
		  {$smarty.const.ADMIN_PAGE_NUMBER*$pageconut+$smarty.foreach.prods.iteration}.
		  {else}
		  {$smarty.foreach.prods.iteration}.
		  {/if}
		  </td>
  <td valign='top'align='left'><a href='admin_add_users.php?user_id={$prod.user_id}'>{$prod.username}</a></td>
         
		  <td valign='top'align='left'>{$prod.first_name}{$prod.last_name}</td>
 <td valign='top'align='left'>

		USD&nbsp; {$prod.amount}
		  </td>
 <td nowrap valign='top'align='left'>{$prod.pack_name}-(0-{$prod.max_items})</td>
		  <td valign='top'align='left'>{$prod.expiry_date|date_format}
		 				
		  </td>
		  <td valign='top'align='left'>{$prod.date_purchased|date_format}</td>
                 <td valign='top'align='left'>
		 </td>

		</tr>

		{/foreach}
        <tr>
			<td colspan="8">
			<div style="float:left;">{$page_counter} Products </div>
			 {if $pageLink}
			<div class="admn_pagination_msg_board">
			<span style="float:right;">{$pageLink}</span>
			</div>
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