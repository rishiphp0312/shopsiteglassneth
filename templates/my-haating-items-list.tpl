{include file="header.tpl"}
{include file="js_css_validation.tpl"}

<!-- Jquery Fancy Box -->
<link rel="stylesheet" type="text/css" href="{$baseUrl}fancybox/jquery.fancybox-1.2.6.css" media="screen" />
<script type="text/javascript" src="{$baseUrl}fancybox/jquery.fancybox-1.2.6.pack.js"></script>
<script type="text/javascript" src="js/jquery/jquery-ui-1.7.1.custom.min.js"></script>

{include file="header_search.tpl"}
<!--End Logo-->
<!--Start Middle-->
<!--rishi--><div id="middleMain">
{include file="left_category.tpl"}
{literal}
<SCRIPT language="JavaScript1.2">
  
function confirm_msg(id, parent_id)
{
	var message = "Do you really want to delete this item?";
	//if(id==0)
	//{
	//	message += "\n This action also delete all child categories associated with this.";
	//	jAlert("You can not delete a parent category.",'Error');
	//	return false;	
	//}
	jConfirm(message, 'Confirm', function(r) 
	{
		if(r)
		{
			location.href='my-haating-items-list.php?delete_item_value='+id;
		}
		else
		{
			return false;
		}	
	});
}

function  max_min_fun(NUM)
{       NUM        =  parseInt(NUM);
	var MIN_ID = document.getElementById('min_val_'+NUM).value;
	var MAX_ID = document.getElementById('max_val_'+NUM).value;
	var MIN_IDa     = parseFloat(MIN_ID);
	var MAX_IDa     = parseFloat(MAX_ID);

	 // alert(MIN_IDa+'MIN_IDaa');
	// alert(MAX_IDa+'MAX_IDbb');
	if(MAX_IDa=='NaN'  || MIN_IDa=='NaN'  || MIN_IDa=='' || MAX_IDa=='')
	{
	       
		alert("Value should not be blank");
		return false;
		}
		else if((MAX_IDa<MIN_IDa) && (MAX_IDa!=NaN  && MIN_IDa!=NaN && MAX_IDa!=''  && MIN_IDa!=''))
		{
		
		alert("Value should be greater in maximum value");
		return false;
		}else 
	return true;
}
function  delete_chk()
{
	var DEL_VAL= confirm("Are you sure you want to delete?");
	if(DEL_VAL==true)
	return true;
	else
	return false;
}
function poponload(VAL)
{
	//alert('ss');
	testwindow= window.open ("add_quantity.php?item_id_value="+VAL, "mywindow","location=1,status=1,scrollbars=1,width=300,height=200");
	testwindow.moveTo(100,100);
}

$(document).ready(function()
{
	
	$("a.item_quantity").fancybox({
	'hideOnContentClick': false,
	'frameWidth'			: 255,
	'frameHeight'			: 100		
	});
});


</SCRIPT>
			
{/literal}			

<div id="middleRtMain">
	<div class="shopmain">
				<div class="mainHD fl" >My Haating Items</div>
				<div class="fr" style='padding-right:10px;padding-top:5px;font-weight:bold;' ><a href='#my_account.php'  onclick='history.go(-1)'>Go Back</a></div>
				<div class="clear">
					<!--Start my items -->
					 {if $users_items_details}
					<div class="myitemmain">
					
					
						<div class="myItemtopbg" >
							<div class="titlelf" >Title 
							<!--<a href=''my-haating-items-list.php?order_by={$title_asc}'><img src='images/arrow_top.gif'></a>&nbsp;
							<a href=''my-haating-items-list.php?order_by={$title_desc}'><img src='images/arrow_btm.gif'></a> 
	--></div>
							
							<div class="itemlf"  >Cost Range<!--<a href='items_list.php?order_by={$cost_range_asc}'>
							<img src='images/arrow_top.gif'>
							</a>&nbsp;
							<a href='my-haating-items-list.php?order_by={$cost_desc}'>
							<img src='images/arrow_btm.gif'></a>--> 
							</div>
							<div class="itemleftlf"  style='width:200px;'>Available Quantity
							<!--<a href='my-haating-items-list.php?order_by={$quantity_available_asc}'>
							<img src='images/arrow_top.gif'></a>&nbsp;<a href='my-haating-items-list.php?order_by={$quantity_available_desc}'>
							<img src='images/arrow_btm.gif'></a>
							<br><br>
							<a href='#'>Send it in Hatting</a>-->
							<!--quantity_available -->
							</div>
							<div class="costlf" >&nbsp;</div>
							<div class="clear"></div>
						</div>
						
						
						
						
			{foreach name=cat from=$users_items_details item=val_items}
				
						<div class="myiteminsidemain"  >
							<div class="titlelf">
							<div class="itmno">{if $smarty.request.pageNumber!="" && $smarty.request.pageNumber>1}
		  {assign var=pageconut value=$smarty.request.pageNumber-1}
		  {$smarty.const.ADMIN_PAGE_NUMBER*$pageconut+$smarty.foreach.cat.iteration}.
		  {else}
		  {$smarty.foreach.cat.iteration}.
		  {/if}</div>
							<div >
	{assign var='item_name' value=$val_items.title|ucfirst}
	<a href="item-details.php?details_item_value={$val_items.item_id}">
        <img src="{if $val_items.image1!=''}{$baseUrl}getthumb.php?w=150&h=50&fromfile=uploads/{$val_items.image1}{else}images/item_small_img.jpg{/if}" alt="" {if $val_items.image1==''}height='50'width="100" {/if} border='0' 	class="itemimg handle" /></a><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="item-details.php?details_item_value={$val_items.item_id}">{$item_name|truncate:20}</a>
	<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<span style="text-align:left;font-family:Arial, Helvetica, sans-serif;font-size:10px;color:#6A6A6A;"><!--$&nbsp;-->{$val_items.cost_item|convert_price}</span></div>
	<div class="clear"></div>
	                        			</div>
							<div class="itemlf" style='border:0px solid red;'>
		      				       <span style='text-align:left;'></span>&nbsp;&nbsp;&nbsp;
	<form name='frm' action='' method='post'>
	{if $val_items.hat_min_value!='' && $val_items.hat_min_value!='0'}
	&nbsp;<!--$&nbsp;-->{$val_items.hat_min_value|convert_price}&nbsp;-&nbsp;<!--$&nbsp;-->{$val_items.hat_max_value|convert_price}
	{else}
	Min Value&nbsp;<input type='text' value=''  style='width:50px;' id='{'min_val_'|cat:$smarty.foreach.cat.iteration}'  name='min_val' ><br><br>Max Value&nbsp; 
	<input type='text' style='width:50px;' value='' name='max_val' id='{'max_val_'|cat:$smarty.foreach.cat.iteration}'   >
	<br><br><input type='hidden' value='{$val_items.item_id}' name='item_value_id'>
       <input type='submit' style='width:50px;' value='Submit' name='max_min' onclick='return max_min_fun({$smarty.foreach.cat.iteration});' >
  	{/if}
	</form>
	<br>
	<a  href="view_bids.php?item_id_value={$val_items.item_id}">
	My Haating History</a>	
	
	
	</div>
							<div class="itemleftlf">
							{if $val_items.quantity_available==''} 0
							{else} {$val_items.quantity_available}
							{/if}&nbsp;&nbsp;&nbsp;

	<!--<a class="item_quantity" href="{$baseUrl}add_quantity.php?item_id_value={$val_items.item_id}">
	Update Quantity</a>-->
	
	</div>
	<div class="costlf"><a href="sell-an-item.php?item_id_value={$val_items.item_id}"><img  src='images/edit_btn.jpg' border='0'></a><a href="item-details.php?details_item_value={$val_items.item_id}"><img src="images/details_btn.jpg" alt="" class="editImg" /></a>&nbsp;&nbsp;<a onclick="confirm_msg({$val_items.item_id}, '');" href="#items_list.php?delete_item_value={$val_items.item_id}" title="Delete">
	<img src="images/delete_btn.jpg" alt="" class="editImg" />
	</a>
	<br><br><br>
	
	<span class="itemlf" ><span style="color:#CC0033">{if $val_items.date_modified!=''}Last Modified{/if}</span>{if $val_items.date_modified!=''} <b>:</b>{/if}{$val_items.date_modified|date_format}</span>
	<br>
	{if $val_items.status!=3}Current Status{/if}<span style="color:red;padding-left:5px;">{if $val_items.status==0}Pending {/if}{if $val_items.status==1}Active {/if}
	{if $val_items.status==2}Suspend{/if}</span>
	</div>
							<div class="clear"></div>
						</div>
						
						
						
							{/foreach}
						
					
						<div class="itemimgbox" style='width:690px;'>
						{$page_counter} records&nbsp;&nbsp;&nbsp;&nbsp;<span style="float:right;">
						{$pageLink}</span>
							<div class="clear"></div>
							</div>
							{else}
							<div class="itemimgbox" 
							style='color:red;font-size:14px;width:690px;'>
						No records found!!</span>
							<div class="clear"></div>
							</div>
							{/if}
	
							<div class="clear"></div>
						</div>
						
					
					</div>	
					
				<!--End my items -->
				
				
			</div>
			</div>
			<div class="clear"></div>
		</div>
		<!--End Middle-->
{include file="footer.tpl"}
