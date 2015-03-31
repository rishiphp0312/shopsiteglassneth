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
				<div class="mainHD fl" >View Haating Details of {$items_details1}</div>
				<div class="fr" style='padding-right:10px;padding-top:5px;font-weight:bold;' ><a href='#my-haating-items-list.php' onclick='history.go(-1)' >Go Back</a></div>
				<div class="clear">
					<!--Start my items -->
					 {if $users_items_details}
					<div class="myitemmain">
					
					
						<div class="myItemtopbg" >
							<div class="titlelf" >Username  
							</div>
							
							<div class="itemlf"   >Bid Posted
		
							</div>
							<div style='float:left;width:50px;'>
							Status</div>
							<div class="itemleftlf"  style='width:200px;'>
							Date Posted<!--<Available Quantity
							<a href='my-haating-items-list.php?order_by=
							{$quantity_available_asc}'><img src='images/arrow_top.gif'></a>&nbsp;
			<a href='my-haating-items-list.php?order_by={$quantity_available_desc}'>
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
							<div style='text-align:left;padding-left:10px;' >
			
	
						{$val_items.username}	
							</div>
							<div class="clear"></div>
							</div>
							<div class="itemlf" style='width:170px;'>
		{if $val_items.cost_posted!=''}	

							{$val_items.cost_posted|convert_price}&nbsp;	
							{/if}
							
	</div>
	<div style='float:left;width:110px;'>
        {if $val_items.bid_status==1 && $num_rows_accepted_item!=0}
							&nbsp;Accepted
							{/if}
							{if $val_items.bid_status==0 }
							&nbsp;NA
							{/if}
							{if $val_items.bid_status==2 && $num_rows_accepted_item==0}	
							Waiting for approval
							{/if}
							{if $val_items.bid_status==2 && $num_rows_accepted_item!=0}	
							Process Completed
							{/if}

	</div>
	
							<div class="itemleftlf" 
							style='width:80px;'>
							{$val_items.add_date|date_format}	

	
	</div>
	<div class="costlf" style='width:120px;'>
	{if $num_rows_accepted_item==0 && $val_items.bid_status==2 }	
	<a href="view_bids.php?approv_this_item_id={$val_items.hat_id}">Approved</a>
      
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
							{/if}
							{if $smarty.foreach.cat.iteration==0}
							<div class="itemimgbox" 
							style='color:red;font-size:14px;width:690px;'>
						No records found!!							<div class="clear"></div>
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
