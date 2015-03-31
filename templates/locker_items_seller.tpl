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
 function make_itactive()
{ 
alert('Item should be  active for haating');
return false;
}
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
			location.href='locker_items_seller.php?delete_item_value='+id;
		}
		else
		{
			return false;
		}	
	});
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
	testwindow= window.open ("locker_item_seller.php?item_id_value="+VAL, "mywindow","location=1,status=1,scrollbars=1,width=500,height=500");
	testwindow.moveTo(100,100);
}

$(document).ready(function()
{
	
	$("a.locker_password").fancybox({
	'hideOnContentClick': false,
	'frameWidth'			: 455,
	'frameHeight'			: 200		
	});
});


</SCRIPT>
			
{/literal}			

<div id="middleRtMain">
<div class="shopmain"  >

	<div class="mainHD fl" >My Locker Items</div>
	<div class="fr" style='padding-right:10px;padding-top:5px;font-weight:bold;' >
	{if $locker_password==""}
		<a class="locker_password" href="{$baseUrl}locker_password.php">Create Password</a>
	{elseif  $date>=$locker_last_date && $locker_last_date!="0000-00-00 00:00:00"}
	<a class="locker_password" href="{$baseUrl}locker_password.php">Update Password</a>
	{else}
		<a href="store_info.php">
		Password Protected
		</a>
	{/if} &nbsp;|&nbsp;
	<a href='#my_account.php' onclick='history.go(-1)'>Go Back</a></div>
	<div class="clear">
		<!--Start my items -->
		 {if $users_items_details}
		<div class="myitemmain">
		<div class="myItemtopbg" >
				<div class="titlelf" >Title 
				</div>
				<div class="itemlf" style='width:70px;'  >Cost
				</div>
				<div class="itemleftlf"  style='width:200px;' >Available Quantity
				</div>
				<div class="costlf" >&nbsp;</div>
				<div class="clear"></div>
		</div>
	{foreach name=cat from=$users_items_details item=val_items}
	<div class="myiteminsidemain"  >
		<div class="titlelf">
				<div class="itmno">
					{if $smarty.request.pageNumber!="" && $smarty.request.pageNumber>1}
						{assign var=pageconut value= $smarty.request.pageNumber-1 }
						{$smarty.const.ADMIN_PAGE_NUMBER*$pageconut+$smarty.foreach.cat.iteration}.
					{else}
						{$smarty.foreach.cat.iteration}.
					{/if}
				</div>
				
				<div >
				<a href="item-details.php?details_item_value={$val_items.item_id}" >
				<img  src="{if $val_items.image1!=''}{$baseUrl}getthumb.php?w=150&h=50&fromfile=uploads/{$val_items.image1}{else}images/item_small_img.jpg{/if}" alt=""  border='0' {if $val_items.image1==''}width="100" height='50' {/if} class="itemimg handle" />
				</a>
				<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="item-details.php?details_item_value={$val_items.item_id}">{$val_items.title|ucfirst} </a> </div>
				<div class="clear"></div>
				</div>
				<div class="itemlf" style='border:0px solid red;width:80px;'> {$USD}&nbsp;{if $val_items.cost_item!=''}{$val_items.cost_item|number_format:2:".":","}{else}NA{/if}	
			</div>
			<div class="itemleftlf">
				{$val_items.quantity_available}<br>
<span style='font-size:12px;color:#000000;background-color:#cccccc;font-weight:bold;'>
{if $val_items.expired_package ==1  }&nbsp;
Package Expired.&nbsp;<br>
{/if}{if $val_items.delete_restored ==1}&nbsp;
Item deleted by Admin.&nbsp;<br>
{/if}
</span>
			</div>
			<div class="costlf" >
				<a href="sell-an-item.php?item_id_value={$val_items.item_id}"><img class='vAlign'  src='images/edit_btn.jpg' border='0'></a>
				<a href="item-details.php?details_item_value={$val_items.item_id}"><img src="images/details_btn.jpg" alt="" class="editImg" /></a>&nbsp;&nbsp;<a onclick="confirm_msg({$val_items.item_id}, '');" href="#locker_items_seller.php?delete_item_value={$val_items.item_id}" title="Delete"><img src="images/delete_btn.jpg" alt="" class="editImg" /></a><br><br><br>
				<span class="itemlf" ><span style="color:#CC0033">{if $val_items.date_modified!=''}Last Modified{/if}</span>&nbsp;{if $val_items.date_modified!=''}<b>:</b>&nbsp;{/if}{$val_items.date_modified|date_format}</span><br>
				{if $val_items.status!=3}Current Status{/if}<span style="color:red;padding-left:5px;">{if $val_items.status==0}Pending {/if}{if $val_items.status==1}Active {/if}{if $val_items.status==2}Suspend{/if}</span>
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
