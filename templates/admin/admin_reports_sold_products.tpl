{include file="admin_top.tpl"}
<script language="javascript">
{literal}
function val_category(VAL_CAT)
{
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
	//alert('ajax_id=='+xmlhttp.responseText);
    document.getElementById("ajax_id").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","ajax_code.php?val_main="+VAL_CAT,true);
xmlhttp.send();
}
function val_string(NUM)
{
//alert('val'+NUM);
if(NUM==1)
{
document.getElementById('year_month_row_id').style.display='';
}else
{
document.getElementById('year_month_row_id').style.display='none';
}
return false;

}
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
	 <form action="" method="get" name="frmSearch" id="frmSearch">
	 <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#D5F1FF">
		  <tr class="c3">
			<td colspan="4" class="subheading">{if $smarty.get.parentNAME!=0}{literal}<script>return val_category(document.getElementById('parentNAME').value){/literal}</script>{/if}Product  Search</td>
		  </tr>
		  <tr class="c1">
		   <td colspan="3" bgcolor="#FFFFFF">Category:&nbsp;
		      <select name="parentNAME" id='parentNAME' onchange="return val_category(document.getElementById('parentNAME').value)"   class="required input">
			<option value="0">--select--</option>
			
				  {html_options values=$parentID output=$parentNAME  selected=$smarty.get.parentNAME }
				 
				  </select> </td>

	        <td align="left" valign="top" bgcolor="#FFFFFF" id ='ajax_id'>
			{if $smarty.get.category_id!='' && $smarty.get.category_id!=0} Sub Category:&nbsp;
			<select  name="category_id" id='category_id'  class="required input">
			 {html_options values=$SubCatID output=$SubCatNAME selected=$smarty.get.category_id }
				   </select>
				  {else}
			Sub Category:&nbsp;
		    <select  name="category_id" id='category_id' class="required input">
				  <option value="0">--select--</option>
				  </select>{/if}
				  </td>
		  <td  bgcolor="#FFFFFF">Shipping Status:&nbsp;
		      <select name="ShippingStatus" id='ShippingStatus' class="required input">
        			<option value="0">--Select--</option>
				<option value="2" {if $ShippingStatus==2}selected{else}""{/if}>Pending</option>
                                <option value="1" {if $ShippingStatus==1}selected{else}""{/if}>Completed</option>
				  </select></td></tr>
		  <tr class="c1">
			<td bgcolor="#FFFFFF">Status</td>
			<td colspan="3" bgcolor="#FFFFFF">
			<input type="radio" name="status" value="1" {$chkActive}  onclick="val_string(1);" />  
			  Monthly
		    <input type="radio" name="status" value="2" {$chkInActive} onclick="val_string(2);" />
		      Week
		    <input type="radio" name="status" value="12" {$chkBoth} onclick="val_string(2);" />
	        Todays</td>
			<td bgcolor="#FFFFFF">
		<input name="form_member_search" type="submit" id="form_member_search" class="button"
			value="Search" />
			&nbsp; <input type="button" class="button" name="reset" 
			value="Clear Search" onclick="window.location='admin_reports_sold_products.php';" /></td>
		  </tr>
		 <tr id="year_month_row_id" style="{if $show_status=='NA'}display:'';{else}display:none;{/if}" >
		
			<td bgcolor="#FFFFFF">
			</td>
			<td colspan="3" bgcolor="#FFFFFF" ><select name="sel_year">
		 {html_options values=$year_12 output=$year_12 selected=$sel_year }
			</select>&nbsp;&nbsp;
			  <select name="sel_month">
                          <option value='0' >--Month--</option>
		 {html_options values=$array_for_id output=$array_for_month selected=$sel_month}
			</select>&nbsp;&nbsp;<select style='font-size:12px;width:70px;'  name="sel_days">
                 <option value='0' >--Days--</option>
		 {html_options values=$no_of_days_curentmonth output=$no_of_days_curentmonth selected=$sel_days}
			</select></td>
			<td bgcolor="#FFFFFF" >Purchased Cost &nbsp;&nbsp;<input type='text' value='{$purchased_cost}'style='width:70px;' name='purchased_cost'>	 </td>
		  </tr>
 <tr >

			<td bgcolor="#FFFFFF">Cost Of Item &nbsp;&nbsp;<input type='text' value='{$cost_item}'style='width:70px;' name='cost_item'>
			<br />		<br />	Seller's Username &nbsp;
				<input type="text" value="{$Username}" name="Username" style="width:125px;"/>
			
			</td>
			<td colspan="3" bgcolor="#FFFFFF" >
			  State&nbsp;:<input name="state" type="text" id="state" class="input" value="{$state}" /></td>
			<td bgcolor="#FFFFFF" >Country &nbsp;
		<select  name="country_value"  id="country_value" class="input required" style="width:175px">
				<option value='0'>-- Select--</option>
                              {html_options values=$countryID output=$countryName selected=$selectcountry}
				</select>		 </td>
		  </tr>
	  </table>
	  </form>
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
	<tr >
            <td colspan=3 >Total Purchased Cost Item &nbsp;&nbsp;<span style='font-size:12px;color:#885e36;font-weight:bold;'>$ {$tot_purchase_cost}</span></td>
             <td   colspan=2>Total Giftcard Used</td>
            <td  align= 'left'style='font-size:12px;color:#885e36;font-weight:bold;' >
            {if $tot_giftcardpurchase_cost!=0.00}$ {$tot_giftcardpurchase_cost}{else}Not used yet.{/if}</td>
            <td  colspan='2' align='right' >Total Ship Cost</td>
            <td style='font-size:12px;color:#885e36;font-weight:bold;text-align:left;' >$ {$tot_ship_cost}</td>
            </tr>
             <tr class="listHeadRow"><td>S. No.</td>
                                 
                                        <td>Product Name</td>
                                        <td nowrap >Payment History of Sold Item</td>
		                        <td>Cost of Item</td>
                                        <td>Quantity</td>
                                        <td>Sub Category</td>
		                        <td>Shipping Status </td>
		                        <td>Date of Purchase </td>
                                        <td>Country</td>
                                        <!--<td>Paymentmode</td>-->
                                        <!--<td>Status</td>-->
		                        <!--<td>Options</td>-->
		</tr>
		{foreach name=prods from=$productList item=prod}
		
		<tr bgcolor="{cycle values='#f5f5f5,#e6e6e6'}">  
          <td>
		  {if $smarty.request.pageNumber!="" && $smarty.request.pageNumber>1}
		  {assign var=pageconut value=$smarty.request.pageNumber-1}
		  {$smarty.const.ADMIN_PAGE_NUMBER*$pageconut+$smarty.foreach.prods.iteration}.
		  {else}
		  {$smarty.foreach.prods.iteration}.
		  {/if}		  </td><!--<td>{$prod.s}</td>-->
          <td>
		  <a href="admin_view_product_detail.php?product_id={$prod.item_id}&user_type_id={$prod.seller_id}" title="View Details" style="font-weight:normal;">
		  {$prod.title}		  </a>		<br />Buyer :{$anObject->buyer_username($prod.buyer_id)} 	 <br />
		  Seller : {$prod.username}		  </td>
                   <td valign='top' align='left'>
                   <table align='center' cellpadding='0' cellspacing='0' width='100%'>
                   <tr><td><b> Cost for Item Paid</b> </td><td>  {'$ '|cat:$prod.amount}</td></tr>
                   <tr><td> <b> Giftcard Amount 1</b></td><td> {if $prod.gift_card1!=0.00} {'$ '|cat:$prod.gift_card1}{else}Not Used{/if}</td></tr>
                   <tr><td><b> Giftcard Amount 2</b></td>
				   <td> {if $prod.gift_card2!=0.00} {'$ '|cat:$prod.gift_card2}{else}Not Used{/if}</td></tr>
                   <tr><td><b>  Shipping Cost</b></td><td>  {'$ '|cat:$prod.ship_cost}</td></tr>
 {if $prod.request_item_id!=0}
 <tr><td><b>Request Custom Item</b></td><td></td></tr>
 <tr><td><b>Advance Payment= </b></td><td>${$anObject->chk_itemcustom($prod.request_item_id)}</td></tr>
                  {/if}</table></td>
		  <td>{'$ '|cat:$prod.cost_item}</td>
                  <td>{$prod.quantity}</td>
                  <td>{$prod.tcm_sub_cat_name}</td>
		  <td>{if $prod.shipping_status==0}Pending {else}Completed{/if}</td>
		  <td>{$prod.purchase_date|date_format:"%b %d, %Y"}</td>
      <!--    <td>&nbsp;{$prod.paymentmode|ucfirst}</td>-->
           <td>{$prod.country}</td>
		</tr>
		
		{/foreach}
        <tr>
			<td colspan="9">
			<div style="float:left;">{$page_counter} Products </div>
			 {if $pageLink}
			<div class="admn_pagination_msg_board">
			<span style="float:right;">{$pageLink}</span>			</div>
			 {/if}			</td>
        </tr>
		{else}
		
		<tr><td colspan="9"><div class="no_record_found">No record found...!</div></td></tr>
	
		{/if}
      </table>
</td>
	</tr>
</table>	  
{include file="admin_bottom.tpl"} 