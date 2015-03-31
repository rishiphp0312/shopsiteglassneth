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
	 <tr><td align="left" valign="top" class="border1">
	 <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#D5F1FF">
		<form action="" method="get">
		  <tr class="c3">
			<td colspan="4" class="subheading">Product  Search</td>
		  </tr>
		<tr class="c2">
			<td bgcolor="#FFFFFF">By Sellers name:</td>
			<td bgcolor="#FFFFFF"><input name="Username" type="text" id="Username" class="input"
			value="{$Username}" /></td>
			<td bgcolor="#FFFFFF" nowrap>By Product:</td>
			<td bgcolor="#FFFFFF" >
			<input name="title" type="text" id="title" class="input" value="{$title}" /></td>

			<td bgcolor="#FFFFFF">
		By Cost :&nbsp;<input name="cost_item" type="text" id="cost_item" class="input" value="{$cost_item}" /></td>
		  </tr>
		  <tr class="c1">
			<td bgcolor="#FFFFFF" >Payment Mode</td>
			<td bgcolor="#FFFFFF">
				<select name="paymentmode" class="input">
					<option value="">--SELECT--</option>
					<option value="giftcard">GIFT CARD</option>
					<option value="creditcard">CREDIT CARD</option>
					<option value="ccavenue">CCAVENUE</option>
				</select>
			</td>
			<td colspan="4" bgcolor="#FFFFFF">
			<input name="form_member_search" type="submit" id="form_member_search" class="button" 
			value="Search" />
			&nbsp; <input type="button" class="button" name="reset" 
			value="Clear Search" onclick="window.location='admin_purchase_item.php';" /></td>
		  </tr>
		</form>
	  </table>
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
       {if $productList && $no_id_fetched!='0'}
		<tr class="listHeadRow">
			<td>S. No.</td>
			<td>Products</td>
			<td>Cost of Item</td>
			<!--<td>Store Name</td>-->
			<td>Purchase Mode</td>
			<td>Status</td>
			<td>Purchase Date</td>
				       
		</tr>
		{foreach name=prods from=$productList item=prod}
		
		<tr bgcolor="{cycle values='#f5f5f5,#e6e6e6'}">
			<td>
			{if $smarty.request.pageNumber!="" && $smarty.request.pageNumber>1}
			{assign var=pageconut value=$smarty.request.pageNumber-1}
			{$smarty.const.ADMIN_PAGE_NUMBER*$pageconut+$smarty.foreach.prods.iteration}.
			{else}
			{$smarty.foreach.prods.iteration}.
			{/if}
			</td>
			<td>
			<a href="admin_view_product_detail.php?product_id={$prod.item_id}&user_type_id={$prod.seller_id}" title="View Details" style="font-weight:normal;">
			{$prod.title}
			</a>
			</td>
			<td>{$prod.amount} {$CURRENCY}</td>
		<!--	<td>{if $prod.store_name!=""}{$prod.store_name}{else}{$prod.username}'s store{/if}</td>-->
			<td>
				{if $prod.paymentmode=="giftcard"}
					Gift Card
				{else}
					{if $prod.paymentmode=="creditcard"}
						Credit Card
					{else}
						{if $prod.paymentmode=="ccavenue"}
							CCAvenue
						{/if}
					{/if}
					Other Process
				{/if}
			
			</td>
			<td nowrap>
				{if $prod.shipping_status==1}
					Shipped
				{else}
					Not Shipped
				{/if}
					
			</td>
			<td>{$prod.date_modified|date_format:"%b %d, %Y"}</td>
			
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