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
			<td bgcolor="#FFFFFF">By Seller's Username:</td>
			<td bgcolor="#FFFFFF"><input name="Username" type="text" id="Username" class="input"
			value="{$Username}" /></td>
			<td bgcolor="#FFFFFF" nowrap>By Title:&nbsp;<input name="title" type="text" id="title" class="input" value="{$title}" /></td>
			
			

			<td bgcolor="#FFFFFF">
		Shipping Cost :&nbsp;<input name="shipping_cost" style='width:70px;' type="text" id="shipping_cost" class="input" value="{$shipping_cost}" /></td>
		  </tr>
	<tr class="c2">
			<td bgcolor="#FFFFFF">Shipping Country:</td>
			<td bgcolor="#FFFFFF">
		<select  name="country_value"  id="country_value" class="input required" style="width:175px">
				<option value='0'>-- Select--</option>
                              {html_options values=$countryID output=$countryName selected=$selectcountry}
				</select></td>
			<td bgcolor="#FFFFFF" nowrap>Shipped Zipcode:&nbsp;<input name="Zipcode" type="text" id="Zipcode" class="input" value="{$Zipcode}" /></td>
			
			<td bgcolor="#FFFFFF" nowrap>
		Shipping City :&nbsp;<input name="city" type="text" id="city" class="input" value="{$city}" /></td>
		  </tr>
		  <tr class="c1">
			<td bgcolor="#FFFFFF">Date of Shipping Starts&nbsp;:</td>
			<td width="19%" bgcolor="#FFFFFF" nowrap><select style='font-size:12px;width:70px;'  name="sel_days">
                 <option value='0' >--Days--</option>
		 {html_options values=$no_of_days_curentmonth output=$no_of_days_curentmonth selected=$sel_days}
			</select>&nbsp;&nbsp;Day&nbsp;&nbsp;
			<select name="sel_month">
                   <option value='0' >--Month--</option>
		 {html_options values=$array_for_id output=$array_for_month selected=$sel_month}
			</select>
			  Month&nbsp;&nbsp;<br>&nbsp;
		    <select name="sel_year">
                    <option value='0' >--Year--</option>
		 {html_options values=$year_12 output=$year_12 selected=$sel_year }
			</select>&nbsp;&nbsp;
		      Year</td>
			
			<td bgcolor="#FFFFFF"  nowrap>Status &nbsp;<select name='ship_status' > <option value='0'>--select--</option>
                        <option value='2'{if $ship_status==2}selected{/if}>Pending</option>
                        <option value='1'{if $ship_status==1}selected{/if} >Completed</option>
                       <option value='3'{if $ship_status==3}selected{/if} >In Process</option>
                        </select></td>
			<td bgcolor="#FFFFFF">
			<input name="form_member_search" type="submit" id="form_member_search" class="button" 
			value="Search" />
			&nbsp; <input type="button" class="button" name="reset" 
			value="Clear Search" onclick="window.location='show_shipping_values.php';" /></td>
		  </tr>
		  
		</form>
	  </table>	</td>
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
<tr >
                                  <td colspan=2> Total Shipping Cost</td>
                                      <!--  <td>Order ID.</td>-->

                                        <td colspan='6' style='font-size:12px;color:#885e36;font-weight:bold;text-align:left;' >$ {$tot_ship_cost}</td>


		</tr>

		<tr class="listHeadRow">
                                  <td>S. No.</td>
                                      <!--  <td>Order ID.</td>-->
  <td>Seller's Username.</td>
                                        <td>Products</td>
		                        <td>Shipping Cost </td>
                             <td nowrap> Shipping Address </td>
		                        <td> Shipping Status </td>
<td> Country </td>
                                       
		                       <td>Date  Shipping Start &amp; Service </td>
				              
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
		  </td>  <!-- <td> {$prod.last_trans_id}</td>-->
  <td> {$prod.username}</td>

          <td>
		 
		  {$prod.title}
		  </td>
		  <td>{'$ '|cat:$prod.shipping_cost}</td>
 <td nowrap>{if $prod.shipping_address1!=''}
		 				
		 					Address1:{$prod.shipping_address1}<br>		{/if}
                                             {if $prod.shipping_address2!=''}
		 				
		 				Address2:	{$prod.shipping_address2}	<br>{/if}
                                          {if $prod.city!=''}
		 			City:&nbsp;{$prod.city}<br>
		 						{/if} {if $prod.country_code!=''}
		 			Country:&nbsp;{$prod.country}<br>
		 						{/if}{if $prod.dest_zip_code!=''}
		 			Zipcode:&nbsp;{$prod.dest_zip_code}<br>
		 						{/if}</td>
		  <td align="left">{if $prod.ship_status==0}
		 				Paid but not shipped.
		 						{/if}
		 {if $prod.ship_status==1}Shipped but not Delivered.
		 {/if}
		  {if $prod.ship_status==2}
		   Delivered.
		  {/if}
		  </td><td>{$prod.country} </td>
		  <td>{$prod.date_add|date_format:"%b %d, %Y"}<br />{$prod.ship_service}</td>
                <!-- <td>
		 <a href='show_shipping_values.php?upd_status={$prod.ship_id}&ship_status_value=
		 {if $prod.ship_status==1}0{else}1{/if}'>Update Status</a>
		
		 </td>        
 -->
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