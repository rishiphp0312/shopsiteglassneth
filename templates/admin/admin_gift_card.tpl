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
			<td colspan="4" class="subheading">Search</td>
		  </tr>
		<tr class="c2">
			<td bgcolor="#FFFFFF">Senders Username:</td>
			<td bgcolor="#FFFFFF"><input name="Username" type="text" id="Username" class="input"
			value="{$Username}" /></td>
			<td bgcolor="#FFFFFF" nowrap>Giftcard Code:</td>
			<td bgcolor="#FFFFFF" >
			<input name="Secrete" type="text" id="Secrete" class="input" value="{$Secrete}" /></td>

			<td bgcolor="#FFFFFF">Receiver's name :&nbsp;<input name="receiver" type="text" id="receiver" class="input" value="{$receiver}" /></td>
		  </tr>

		  <tr class="c1">
			<td colspan="2" bgcolor="#FFFFFF" >&nbsp;</td>
			
			<td colspan="4" bgcolor="#FFFFFF">
			<input name="form_member_search" type="submit" id="form_member_search" class="button" 
			value="Search" />
			&nbsp; <input type="button" class="button" name="reset" 
			value="Clear Search" onclick="window.location='admin_gift_card.php';" /></td>
		  </tr>
		</form>
	  </table>
	</td>
	</tr>	<tr>
	<td align="right">
	<div style="float:left;">{$page_counter} Products</div> 
	
	</tr>	
	<tr>
	  <td align="left" valign="top" class="border1">
      <table width="100%" cellpadding="4" cellspacing="2" align="center">
       {if $productList && $no_id_fetched!='0'}
		<tr class="listHeadRow">
			<td>S. No.</td>
			<td>Sender Username</td>
			<td>Receiver</td>
			<td>Receiver Email</td>
			<td>Remaining Amount</td>
			<td>Send Date</td>
			<td>Code</td>
				       
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
			{if $prod.buyer_id!=0}
			{$prod.username}
			{else}
			Admin
			{/if}
			</td>
			<td>{$prod.recivername} {$CURRENCY}</td>
			<td>{$prod.reciveremail}</td>
			<td>
				{if $prod.reciveramount=="0"}
					<span style="color:red">Amount used</span>
				{else}
					{$prod.reciveramount}
				{/if}
			</td>
			<td>{$prod.create_date|date_format:"%b %d, %Y"}</td>
			<td nowrap>{$prod.giftcardnumber}</td>
			
			
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