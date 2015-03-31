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
	var message = "Do you really want to delete this coupon?";
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
			location.href='view-coupons.php?delete_coupon_id='+id;
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
				<div class="mainHD fl" >Your Coupons </div>
				<div class="fr" style='padding-right:10px;padding-top:5px;font-weight:bold;'>
				<a href='#my_account.php' onclick='history.go(-1)'>Go Back</a></div>
				<div class="clear">
					<!--Start my items -->
					 {if $users_items_details}
					<div class="myitemmain">
					
					
						<div class="myItemtopbg" >
							<div class="titlelf" >Coupon Code 
							</div>
							
							<div class="itemlf" style='width:60px;'  >Discount
			 
							</div>
							<div class="itemleftlf"  style='border:0px solid red;width:330px;' >
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Items Applied&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Coupon Validity
</div>
							
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
							<div class="itemimgbox" style='border:0px solid red;width:100px;' >
			 	<span style='font-size:14px;color:red;' >&nbsp;{$val_items.coupon_code}&nbsp;&nbsp;{if $val_items.coupon_status==0}[<span style="color:#006432;">Expired</span> ]{/if}</span>
		
							&nbsp;
							</div>
							<div class="clear"></div>
							</div>
							<div class="itemlf" style='border:0px solid red;width:50px;'>
		
	<span style='font-size:14px;color:red;' >&nbsp;{if $val_items.discount_type==0}
     {$val_items.discount_amount}%
	{else}
       ${$val_items.discount_amount}
	{/if}
	</span>
	</div>
	<div class="itemleftlf" style='border:0px solid red;width:200px;' >
	 {$val_items.title_name|ucfirst}
	</div>
	<div class="costlf" style='border:0px solid red;width:230px;text-align:left;' >
	 {$val_items.start_date|date_format} to  {$val_items.end_date|date_format}
&nbsp;&nbsp;<a onclick="confirm_msg({$val_items.coupon_id}, '');" href="#view-coupons.php?delete_coupon_id={$val_items.coupon_id}" title="Delete">
	<img src="images/delete_btn.jpg" alt="" class="editImg" />
	</a>
<!--
	<a href="sell-an-item.php?item_id_value={$val_items.item_id}"><img  src='images/edit_btn.jpg' border='0'></a>
	<a href="item-details.php?details_item_value={$val_items.item_id}"><img src="images/details_btn.jpg" alt="" class="editImg" /></a>&nbsp;&nbsp;<a 
	onclick="confirm_msg({$val_items.item_id}, '');" href="#items_list.php?delete_item_value={$val_items.item_id}" title="Delete">
	<img src="images/delete_btn.jpg" alt="" class="editImg" />
	</a>
	
	
	<span class="itemlf" ><span style="color:#CC0033">{if $val_items.date_modified!=''}Last Modified{/if}
	</span>{if $val_items.date_modified!=''} <b>:</b>{/if}{$val_items.date_modified|date_format:"%B %d, %Y"}</span>
	<br>
	{if $val_items.status!=3}Current Status{/if}<span style="color:red;padding-left:5px;">{if $val_items.status==0}Pending {/if}{if $val_items.status==1}Active {/if}
	{if $val_items.status==2}Suspend{/if}</span>
	-->
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
