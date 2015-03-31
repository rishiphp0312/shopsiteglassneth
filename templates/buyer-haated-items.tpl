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
				<div class="fr" style='padding-right:10px;padding-top:5px;font-weight:bold;' ><a href='my_account.php'>Go Back</a></div>
				<div class="clear">
					<!--Start my items -->
					 {if $users_items_details}
					<div class="myitemmain">
					
					
						<div class="myItemtopbg" >
							<div class="titlelf" >Title 
							<!--<a href=''my-haating-items-list.php?order_by={$title_asc}'><img src='images/arrow_top.gif'></a>&nbsp;
							<a href=''my-haating-items-list.php?order_by={$title_desc}'><img src='images/arrow_btm.gif'></a> 
	--></div>
							
							<div class="itemlf"   >Bid Accepted
			
							</div>
							<div class="itemleftlf"  style='width:200px;'><!--
							Available Quantity<a href='my-haating-items-list.php?order_by=
							{$quantity_available_asc}'><img src='images/arrow_top.gif'></a>&nbsp;
				<a href='my-haating-items-list.php?order_by={$quantity_available_desc}'>

							<img src='images/arrow_btm.gif'></a>-->
							<!--<br><br>
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
							<!--<div class="itemimgbox">-->
				<div >
	<a href="item-details.php?details_item_value={$val_items.item_id}"><img
src="{if $val_items.image1!=''}{$baseUrl}getthumb.php?w=150&h=50&fromfile=uploads/{$val_items.image1}{else}images/item_small_img.jpg{/if}" alt=""  border='0' {if $val_items.image1==''}width='70' height="50"
	{/if} class="itemimg handle" /></a>
							<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<a href="item-details.php?details_item_value={$val_items.item_id}">{assign var='tit_trunc' value = $val_items.title|truncate:20:"":true}{$tit_trunc|ucfirst}</a></div>
							<div class="clear"></div>
							</div>
							<div class="itemlf" style='border:0px solid red;'>

							<span style='text-align:left;'>
							
	</span>&nbsp;&nbsp;<!--{$USD}-->&nbsp;{$val_items.cost_posted|convert_price} 
	
	</div>
							<div class="itemleftlf">
							{if $val_items.quantity_available==''} 
							{else} {*$val_items.quantity_available*}
							{/if}&nbsp;&nbsp;&nbsp;

	
	
	</div>
	<div class="costlf" style="width:200px;">
	<div style="float:left;width:80px;padding-top:10px;">
	<a href="item-details.php?details_item_value={$val_items.item_id}">
	<img src="images/details_btn.jpg"  alt="" class="editImg" /></a>&nbsp;&nbsp;</div>
	<div style="float:left;width:80px;">
	{*if $val_items.paid_status==0*}
	<a href="item-details.php?details_item_value={$val_items.item_id}"><img src="images/buy_now_btn.jpg" alt=""  vspace="5" /></a>
	{*/if*}
	&nbsp;</div>

	<br><br><br>
	
	<span class="itemlf" ><span style="color:#CC0033">{if $val_items.add_date!=''}Date Added{/if}</span>
	{if $val_items.add_date!=''} <b>:</b>{/if}{$val_items.add_date|date_format}</span>
	<br></div>
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
