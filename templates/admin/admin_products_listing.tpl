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
{ var str_msg;
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

  str_msg = 'Do you really want to make this Item Featured?';
 jConfirm(str_msg,'Confirm', function(r)
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
else if(val==8)
{

  str_msg = 'Already there are 12 Featured Items.You need to delete some Featured Items.?';
 jConfirm(str_msg,'Confirm', function(r)
	{
		if(r)
		{

                        location.href='admin_handpicked_listing.php';


		}
		else
		{
			return false;
		}
	});
}
else if(val==5)
	{
	jConfirm('Do you really want to delete this Item?', 'Confirm', function(r) 
	{
		if(r)
		{
			location.href='admin_products_listing.php?delete_item_value1='+id;
		}
		else
		{
			return false;
		}	
	});
	}
else 
	{
	jConfirm('Do you really want to restore this Item?', 'Confirm', function(r) 
	{
		if(r)
		{
			location.href='admin_products_listing.php?delete_item_value0='+id;
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
			<td colspan="4" class="subheading">Product  Search</td>
		  </tr>
		<tr class="c2">
			<td bgcolor="#FFFFFF">By Sellers Username:</td>
			<td bgcolor="#FFFFFF"><input name="Username" type="text" id="Username" class="input"
			value="{$Username}" /></td>
		
			<td bgcolor="#FFFFFF"colspan='2' >Date Added<br><select style='font-size:12px;width:70px;'  name="sel_days">
                 <option value='0' >--Days--</option>
		 {html_options values=$no_of_days_curentmonth output=$no_of_days_curentmonth selected=$sel_days}
			</select>&nbsp;&nbsp;<select name="sel_month">
                       <option value='0' >--Month--</option>
		       {html_options values=$array_for_id output=$array_for_month selected=$sel_month}
			</select> &nbsp;&nbsp;
		    <select name="sel_year">{html_options values=$year_12 output=$year_12 selected=$sel_year }
			</select>&nbsp;

</td>

			<td bgcolor="#FFFFFF">
		By Cost :&nbsp;<input name="cost_item" type="text" id="cost_item" class="input" value="{$cost_item}" /></td>
		  </tr>
		  <tr class="c1">
			<td bgcolor="#FFFFFF">By Inventory Quantity:</td>
			<td width="19%" bgcolor="#FFFFFF"><input name="inventory_alert" 
			type="text" id="inventory_alert" class="input" value="{$inventory_alert}" /></td>
			
			<td bgcolor="#FFFFFF" colspan='2'  nowrap>Status:<br> &nbsp;<input type="radio" name="status" value="1" {$chkActive}> Expired Package Items
			<input type="radio" name="status" value="2" {$chkInActive}> Suspend <input type="radio" 
			name="status" value="12" {$chkBoth}> All</td>
			<td bgcolor="#FFFFFF">
			<input name="form_member_search" type="submit" id="form_member_search" class="button" 
			value="Search" />&nbsp;	&nbsp;<br> <br><input type="button" class="button" name="reset"
			value="Clear Search" onclick="window.location='admin_products_listing.php';" /></td>

		  </tr>
<tr id="month_row_id"  >

			<td colspan="3" bgcolor="#FFFFFF" >
				Country &nbsp;
		<select  name="country_value"  id="country_value" class="input required" style="width:175px">
				<option value='0'>-- Select--</option>
                              {html_options values=$countryID output=$countryName selected=$selectcountry}
				</select></td><td bgcolor="#FFFFFF">State&nbsp;:
<input name="state" type="text" id="state" class="input" value="{$state}" /></td>
			
			<td bgcolor="#FFFFFF">City&nbsp;:<input name="city" type="text" id="city" class="input" value="{$city}" /></td>
		  </tr>
 <tr id="year_row_id"  >

			<td colspan="3"  bgcolor="#FFFFFF">Category&nbsp;:&nbsp;
		      <select name="parentNAME" id='parentNAME' onchange="return val_category(document.getElementById('parentNAME').value)"   class="required input">
			<option value="0">--select--</option>
			  {html_options values=$parentID output=$parentNAME  selected=$smarty.get.parentNAME }

				  </select></td>
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
			<td bgcolor="#FFFFFF">By Title: &nbsp;
			<input name="title" type="text" id="title" class="input" value="{$blk_title}" />
                 </td>
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
       {if $productList && $no_id_fetched!='0'}
		<tr class="listHeadRow"><td>S. No.</td>
                                        <td>Products</td>
		                        <td>Cost of Item</td> <td>Username</td>
		                        <td>Inventory Alert Quantity </td>
                                        <td>Country</td>
                                       <td>Sub Category</td>
                                        <td>Date Added </td>
                                        <td>Date Modified Last</td>
                                       <!--<td>Status</td>-->
		                       <td>Options</td>
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
		  <br />
		    <b>{if $prod.locker_status!=0}Item is in Locker.<br />{/if}
		    {if $prod.request_item_id!=0}Request Custom Item.<br />{/if} 
			  {if $prod.delete_by_seller!=0}Item deleted by seller.<br />{/if} 
			  
			  
			 {if $prod.expired_package!='0'}Package Expired.{/if} </b>
			  </td>
		  <td>{'$ '|cat:$prod.cost_item}</td>
                  <td>{$prod.username}</td>
		  <td>{$prod.inventory_alert}</td>
                  <td>{$prod.country}</td>
                  <td>{$prod.name}</td>
		  <td>{$prod.date_added|date_format:"%b %d, %Y"}</td>
                 <td>{$prod.date_modified|date_format:"%b %d, %Y"}</td>
         
		  <td nowrap> <a href="admin_edit_product.php?item_id={$prod.item_id}&user_type={$prod.user_type}" 
			  style="text-decoration:none;" title="Edit"><img src="{$baseUrl}/images/edit_icon.png" alt="Edit" border="0" /> </a> &nbsp; &nbsp;
			  {if $prod.delete_restored==0}
		 <a href="javascript: void(0);" title="Delete" style="text-decoration:none;" onclick="confirm_msg({$prod.item_id},{5});">
	<img src="{$baseUrl}/images/dlt_icon.png" alt="Delete" border="0" /></a>
			   {else}
	 <a href="javascript: void(0);" title="Restore" style="text-decoration:none;"  onclick="confirm_msg({$prod.item_id},{7});">
	<img src="{$baseUrl}/images/restore.png" alt="Restore" border="0" /></a>		
			   {/if}&nbsp;
                          {if $total_records_feature <13}
			  {if $prod.make_handpicked!=1 && $prod.expired_package==0 && $prod.delete_restored ==0  && $prod.locker_status==0 && $prod.request_item_id==0
			&& $prod.delete_by_seller ==0  && $prod.status==1}
		 <a href="javascript: void(0);" title="Make Handpicked" style="text-decoration:none;" onclick="confirm_msg({$prod.item_id},{6});">
			 <img src="{$baseUrl}/images/handpick_icon.png" alt="Make Handpicked"  border="0" /></a>
			  {/if}
                          {else}
                   {if $prod.make_handpicked!=1 && $prod.expired_package==0 && $prod.delete_restored ==0  && $prod.locker_status==0 && $prod.request_item_id==0
			&& $prod.delete_by_seller ==0  && $prod.status==1  }
					
      <a href="javascript: void(0);" title="Make Handpicked" style="text-decoration:none;" onclick="confirm_msg({$prod.item_id},{8});">
			 <img src="{$baseUrl}/images/handpick_icon.png" alt="Make Handpicked"  border="0" /></a>
			  {/if}
                       {/if}

		</td>
		</tr>
		
		{/foreach}
        <tr>
			<td colspan="8">
			<div style="float:left;">
			{$page_counter} Products
			 </div>
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