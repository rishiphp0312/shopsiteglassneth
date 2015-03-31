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
			<td bgcolor="#FFFFFF" nowrap>By Title:</td>
			<td bgcolor="#FFFFFF" >
			<input name="title" type="text" id="title" class="input" value="{$blk_title}" /></td>

			<td bgcolor="#FFFFFF">
		By Cost :&nbsp;<input name="cost_item" type="text" id="cost_item" class="input" value="{$cost_item}" /></td>
		  </tr>
		  <tr class="c1">
			<td bgcolor="#FFFFFF">Not Updated</td>
			<td width="19%" bgcolor="#FFFFFF"><select name="not_updated" id="not_updated">
			<option value="0">--Select--</option>
			<option value="3" {if $not_updated==3}selected{/if} >Last 3 Months</option>
			<option value="6" {if $not_updated==6}selected{/if}>Last 6 Months</option>
			<option value="12" {if $not_updated==12}selected{/if}>Last 12 Months</option>
			</select></td>
			
			<td bgcolor="#FFFFFF" colspan='3'  nowrap>
		
			<input name="form_member_search" type="submit" id="form_member_search" class="button" 
			value="Search" />
			&nbsp; <input type="button" class="button" name="reset" 
			value="Clear Search" onclick="window.location='admin_reports_not_updatedproducts.php';" /></td>
		  </tr>
  <tr class="c1">
			<td bgcolor="#FFFFFF">Category:&nbsp;</td>
			<td width="19%" bgcolor="#FFFFFF">
		      <select name="parentNAME" id='parentNAME' onchange="return val_category(document.getElementById('parentNAME').value)"   class="required input">
			<option value="0">--select--</option>

				  {html_options values=$parentID output=$parentNAME  selected=$smarty.get.parentNAME }

				  </select></td>
		
			<td bgcolor="#FFFFFF" colspan='2'  nowrap id ='ajax_id'>
			{if $smarty.get.category_id!='' && $smarty.get.category_id!=0} Sub Category:&nbsp;
			<select  name="category_id" id='category_id'  class="required input">
			 {html_options values=$SubCatID output=$SubCatNAME selected=$smarty.get.category_id }
				   </select>
				  {else}
			Sub Category:&nbsp;
		    <select  name="category_id" id='category_id' class="required input">
				  <option value="0">--select--</option>
				  </select>{/if}</td>
			<td bgcolor="#FFFFFF">
			
			Last Modified Date </td>
		  </tr>
  <tr class="c1">
			<td bgcolor="#FFFFFF">Country:&nbsp;</td>
			<td width="19%" bgcolor="#FFFFFF">
		      	<select  name="country_value"  id="country_value" class="input required" style="width:175px">
				<option value='0'>-- Select--</option>
                              {html_options values=$countryID output=$countryName selected=$selectcountry}
				</select>	</td>

			<td bgcolor="#FFFFFF" colspan='2'  nowrap >  State&nbsp;:<input name="state" type="text" id="state" class="input" value="{$state}" /></td>
			<td bgcolor="#FFFFFF" nowrap><select style='font-size:12px;width:70px;'  name="sel_days">
                 <option value='0' >--Days--</option>
		 {html_options values=$no_of_days_curentmonth output=$no_of_days_curentmonth selected=$sel_days}
			</select>&nbsp;&nbsp;Day&nbsp;&nbsp;
			<select name="sel_month">
		 {html_options values=$array_for_id output=$array_for_month selected=$sel_month}
			</select>
			  Month&nbsp;&nbsp;<br>&nbsp;
		    <select name="sel_year">
		 {html_options values=$year_12 output=$year_12 selected=$sel_year }
			</select>&nbsp;&nbsp;
		      Year

			&nbsp; </td>
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
		<tr class="listHeadRow"><td>S. No.</td>
                                        <td>Products</td>
		                        <td>Cost of Item</td>
		                        <td>Inventory Alert Quantity </td> 
                                        <td>Username </td>
                                        <td>Date Added </td>
		                        <td> Last Modified Date</td>
                                        <td>Sub Category </td><td>Country
		                         <td><!--Options--></td>
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
		  <td>{'$ '|cat:$prod.cost_item}</td>
		  <td>{$prod.inventory_alert}</td>   <td>{$prod.username}</td>
                   <td>{$prod.date_added|date_format:"%b %d, %Y"}</td>
		  <td>{$prod.date_modified|date_format:"%b %d, %Y"}</td>
                 <td>{$prod.tcm_name}
				  </td>   <td>{$prod.country}
				  </td>
		  <td nowrap>
			  <!--<a href="admin_edit_product.php?
			  item_id={$prod.item_id}&user_type={$prod.user_type}" 
			  style="text-decoration:none;" title="Edit">
			  	<img src="{$baseUrl}/images/edit_icon.png" alt="Edit" border="0" />
			  </a> &nbsp; &nbsp;
			   <a href="javascript: void(0);" title="Delete" style="text-decoration:none;"
			   onclick="confirm_msg({$prod.item_id},{5});">
			  	<img src="{$baseUrl}/images/dlt_icon.png" alt="Delete" border="0" /></a>
			   &nbsp; 
			  {if $prod.make_handpicked!=1 && $prod.hatting_status!=1} 
		 <a href="javascript: void(0);" title="Make Handpicked" style="text-decoration:none;"
			   onclick="confirm_msg({$prod.item_id},{6});">
			 <img src="{$baseUrl}/images/handpick_icon.png" alt="Make Handpicked"  border="0" /></a>
			  {/if}
-->
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