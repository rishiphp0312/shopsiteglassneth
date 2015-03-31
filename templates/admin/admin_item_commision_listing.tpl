{include file="admin_top.tpl"}
<script language="javascript">
{literal}
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
document.getElementById('year_row_id').style.display='';
document.getElementById('month_row_id').style.display='none';
}else
{
document.getElementById('month_row_id').style.display='';
document.getElementById('year_row_id').style.display='none';
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
<table width="100%"  border="0" cellspacing="5" cellpadding="5">
	<tr>
	  <td valign="middle" class="bar">{$form_heading}</td>
	</tr>
	 	 <tr><td align="left" valign="top" class="border1">
	 <form action="" method="get" name="frmSearch" id="frmSearch">
<table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#D5F1FF">
		  <tr class="c3">
			<td colspan="4" class="subheading"> Search</td>
		  </tr>
                <tr class="c3">
			<td colspan="5" bgcolor="#FFFFFF" class="subheading"> Purchased Date</td>
		 </tr>
		<tr class="c1">
		<td colspan="3" bgcolor="#FFFFFF">
                 <select style='font-size:12px;width:70px;'  name="sel_days">
                 <option value='0' >--Days--</option>
		 {html_options values=$no_of_days_curentmonth output=$no_of_days_curentmonth selected=$sel_days}
		</select>&nbsp;&nbsp;
                 <select name="sel_month">
                 <option value='0' >--Month--</option>
		 {html_options values=$array_for_id output=$array_for_month selected=$sel_month}
			</select>
			&nbsp;
		    <select name="sel_year">
		 {html_options values=$year_12 output=$year_12 selected=$sel_year }
			</select>&nbsp;&nbsp;
		      Year
		    </td><td bgcolor="#FFFFFF">Commision Cost &nbsp;$&nbsp;<input type='text' value='{$commision_amount}'style='width:70px;' name='commision_amount'>
                   <br><br><span style='font-size:12px;color:red;'> Enter 0.00 if looking for free.</span>
                        </td>
			<td bgcolor="#FFFFFF">Country &nbsp;
		<select  name="country_value"  id="country_value" class="input required" style="width:175px">
				<option value='0'>-- Select--</option>
                              {html_options values=$countryID output=$countryName selected=$selectcountry}
				</select>
				<br /><br />
				Seller's Username &nbsp;
				<input type="text" value="{$Username}" name="Username" style="width:125px;"/>
				</td>
		  </tr>
		 <tr id="year_row_id"  >

			<td bgcolor="#FFFFFF">Category&nbsp;:&nbsp;
		      <select name="parentNAME" id='parentNAME' onchange="return val_category(document.getElementById('parentNAME').value)"   class="required input">
			<option value="0">--select--</option>
			<!--	<optgroup label="Numbers">-->
				  {html_options values=$parentID output=$parentNAME  selected=$smarty.get.parentNAME }

				  </select></td>
			<td colspan="3" bgcolor="#FFFFFF" id ='ajax_id'>
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
			<td bgcolor="#FFFFFF">Cost Of Item &nbsp;:&nbsp;<input type='text' value='{$cost_item}'style='width:70px;' name='cost_item'><br /> 
&nbsp;Commision Status &nbsp;<input type='radio' value='1'{if  $commision_status==1 } checked="checked" {/if} name='commision_status'>Paid &nbsp;<input type='radio' value='0' {if  $commision_status==0 } checked="checked" {/if}  name='commision_status'>Not Paid&nbsp;
<input type='radio' value='2' {if $commision_status=='' || $commision_status==2 } checked='checked' {/if} name='commision_status'>All
                 </td>
		  </tr>
<tr id="month_row_id"  >

			<td bgcolor="#FFFFFF">State&nbsp;:&nbsp;<input name="state" type="text" id="state" class="input" value="{$state}" /></td>
			<td colspan="3" bgcolor="#FFFFFF" >
				<input name="form_member_search" type="submit" id="form_member_search" class="button"
			value="Search" /> <br />
			&nbsp; <input type="button" class="button" name="reset"
			value="Clear Search" onclick="window.location='admin_item_commision_listing.php';" /></td>
			<td bgcolor="#FFFFFF">City&nbsp;:<input name="city" type="text" id="city" class="input" value="{$city}" /></td>
		  </tr>
	  </table>
	  </form>
	</td>
	</tr>
         <tr>
	  <td align="left" valign="top" >
            <table width='90%'>
             <tr><td width='3%' bgcolor='#f5eee4' ></td><td align='left' valign='top' >Commision Paid Items</td></tr>
             </table>
           &nbsp; </td></tr>
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
      <table width="100%" cellpadding="4" cellspacing="2" border='0' align="center">
       {if $productList && $no_id_fetched!='0'}
		
	<tr ><td colspan='2'>Total Commision Cost</td> 
                                 <td colspan='3' style='font-size:12px;color:#885e36;font-weight:bold;text-align:left;'>
                                 $ {$tot_commison_cost_item}</td>

            <td style='font-size:11px;color:#885e36;'colspan='3'  >(<span style='color:red;'>*</span>)&nbsp; This is the cost on which commision calculated.</td>

		</tr>
                                       <!--<td>Status</td>-->
		                       <!--<td>Options</td>-->
		</tr>
                <tr class="listHeadRow"><td>S. No.</td> <!--<td>Order ID</td>-->
                                        <td>Products</td>
		                        <td>Cost of Item</td>
                                       <td nowrap >Payment History of Sold Item</td>
		                        <td>Commision Cost </td>
                                        <td>Sub Category
                                          <br> Name </td>
                                        <td>Quantity</td>

		                       <td>Date of Purchase </td>

                                       <!--<td>Status</td>-->
		                       <!--<td>Options</td>-->
		</tr>

		{foreach name=prods from=$productList item=prod}


		<tr {if $prod.commision_status==0}bgcolor="{cycle values='#f5f5f5,#e6e6e6'}"{else}bgcolor="#f5eee4"{/if}>
          <td>
		  {if $smarty.request.pageNumber!="" && $smarty.request.pageNumber>1}
		  {assign var=pageconut value=$smarty.request.pageNumber-1}
		  {$smarty.const.ADMIN_PAGE_NUMBER*$pageconut+$smarty.foreach.prods.iteration}.
		  {else}
		  {$smarty.foreach.prods.iteration}.
		  {/if}		  </td> <!-- <td>{$prod.s}</td>-->
          <td>
		  <a href="admin_view_product_detail.php?product_id={$prod.item_id}&user_type_id={$prod.seller_id}" title="View Details" style="font-weight:normal;">
		  {$prod.title}		  </a>	<br />Buyer :{$anObject->buyer_username($prod.buyer_id)} 	 <br />
		  Seller : {$prod.username}		</td>
		  <td>{'$ '|cat:$prod.cost_item}</td>
                   <td valign='top' align='left'>
                   <table align='center' cellpadding='0' cellspacing='0' width='100%'>
                   <tr><td><span style='color:red;'>*</span><b> Cost for Item Paid&nbsp;</b> </td><td>  {'$ '|cat:$prod.amount}</td></tr>
                   <tr><td> <span style='color:red;'>*</span><b> Giftcard Amount 1&nbsp;</b></td><td> {if $prod.gift_card1!=0.00} {'$ '|cat:$prod.gift_card1}{else}Not Used{/if}</td></tr>
                   <tr><td> <span style='color:red;'>*</span><b>  Giftcard Amount 2&nbsp;</b></td><td> {if $prod.gift_card2!=0.00} {'$ '|cat:$prod.gift_card2}{else}Not Used{/if}</td></tr>
                   <tr><td>&nbsp;<b>  Shipping Cost&nbsp;</b></td><td>  {'$ '|cat:$prod.ship_cost}</td></tr>
				    {if $prod.request_item_id!=0}
 <tr><td><b>Request Custom Item</b></td><td></td></tr>
 <tr><td><b>Advance Payment= </b></td><td>
 {if $anObject->chk_itemcustom($prod.request_item_id)!=''}
 ${$anObject->chk_itemcustom($prod.request_item_id)}{else}
 Not paid
 {/if}
 </td></tr>
                  {/if}

                  </table></td>
		  <td>&nbsp;{if $prod.commision_amount!='' && $prod.commision_amount!=0 }$ {$prod.commision_amount}{else}Free(Basic Plan){/if}</td>
 <td>{$prod.sub_cat_name|ucfirst}</td><td>{$prod.quantity}</td>
		  <td> {$prod.purchase_date|date_format:"%b %d, %Y"}</td>
        

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