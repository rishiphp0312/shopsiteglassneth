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
	'frameWidth'			: 455,
	'frameHeight'			: 200		
	});
});


</SCRIPT>
			
{/literal}			

<div id="middleRtMain">
	<div class="shopmain">
				<div class="mainHD fl" >View Shipping Details</div>
				<div class="fr" style='padding-right:10px;padding-top:5px;font-weight:bold;' ><a href='#' onclick='history.go(-1)' >Go Back</a></div>
				<div class="clear">
					<!--Start my items -->
					 {if $productList}
					<div class="myitemmain">
					
					
						<div class="myItemtopbg" >
							<div class="titlelf" style='border:0px solid red;width:130px;' >Product Name
							</div>
							
							<div class="itemlf" style='width:150px;border:0px solid red;'  >Shipping Cost
							</div>
							<div class="itemleftlf"  style='border:0px solid red;width:130px;text-align:left;' >Status
							</div>
							<div class="itemleftlf"  style='border:0px solid red;width:150px;'>Date Shipping Starts
							</div>
							<div class="itemleftlf"  style='border:0px solid red;width:70px;' >
									
							</div>
							
							
							
							<div class="clear"></div>
						</div>
						
						
						
						
			{foreach name=cat from=$productList item=val_items}
				
						<div class="myiteminsidemain"  >
							<div class="titlelf">
							<div class="itmno">{if $smarty.request.pageNumber!="" 
							&& $smarty.request.pageNumber>1}
		  {assign var=pageconut value=$smarty.request.pageNumber-1}
		  {$smarty.const.ADMIN_PAGE_NUMBER*$pageconut+$smarty.foreach.cat.iteration}.
		  {else}
		  {$smarty.foreach.cat.iteration}.
		  {/if}</div>
		  {assign var='item_name' value=$val_items.title|UCFIRST}
	 <div  style='border:0px solid red;width:120px;' >
	 <span style='font-size:14px;' >&nbsp;{$item_name|truncate:20}</span><br />
	 &nbsp;</div>
							<div class="clear"></div>
							</div>
	<div class="itemlf" style='border:0px solid red;width:100px;text-align:left;'>
	<span style='font-size:14px;' >&nbsp;
	{if $val_items.shipping_cost!=''} <!-- $ -->{$val_items.shipping_cost|convert_price}	{/if}
	</span>
	</div>
	<div class="itemleftlf" style='border:0px solid red;width:100px;text-align:left;' >
	 {if $val_items.ship_status==2}Delivered
	 {/if}
	 {if $val_items.ship_status==1} Shipped but not delivered
 	 {/if}
	 {if $val_items.ship_status==0}Not Shipped
	 {/if}
	</div>
	<div class="costlf" style='border:0px solid red;width:120px;text-align:left;' >
	{if $val_items.ship_status==0}
	<a 
	class="item_quantity iframe" href="{$baseUrl}shipping_start_details.php?upd_status={$val_items.ship_id}&last_trans_id={$val_items.last_trans_id}"
	>Add Ship Details</a>&nbsp;
	{else}
	&nbsp;
	{/if}
	</div>
	<div class="costlf" style='border:0px solid red;width:100px;text-align:left;' >
	{if $val_items.date_add!=''}
	{$val_items.date_add|date_format}
	{else}
	Null
	{/if}
	</div>
	<div class="clear"></div>
	</div>
	{/foreach}
						
					
						<div class="itemimgbox" style='width:690px;'>
						{$page_counter} records&nbsp;&nbsp;&nbsp;&nbsp;
						<span style="float:right;">
						{$pageLink}</span>
							<div class="clear"></div>
							</div>
							{else}
	<div class="itemimgbox"	style="color:red;font-size:14px;width:690px;">
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
