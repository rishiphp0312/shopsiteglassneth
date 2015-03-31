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
	var message = "Do you really want to delete this reminder?";
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
			location.href='view_reminders.php?delete_item_value='+id;
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
<div class="shopmain"  >

				<div class="mainHD fl" >View Events in  coming 15 days </div>
				<div class="fr" style='padding-right:10px;padding-top:5px;font-weight:bold;' >
				<!--<a href='my_account.php'>Go Back</a><br>-->
				<a href='add_reminder.php'>Add Reminder</a>
				</div>
				<div class="clear">
					<!--Start my items -->
					 {if $users_items_details}
					<div class="myitemmain">
					
					
						<div class="myItemtopbg" >
							<div class="titlelf" >Event Name 
							
	</div>
							
							<div class="itemlf"   >Event Date
							&nbsp;
							 </div>
							<div class="itemleftlf"  style='width:200px;' >Name
							
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
							<div class="itemimgbox">
			
	
	{$val_items.rem_title|ucfirst}</div>
							<div class="clear"></div>
							</div>
							<div class="itemlf" style='border:0px solid red;'>

							
							{$val_items.rem_day}&nbsp;{$val_items.rem_month|date_value_month}
	</div>
							<div class="itemleftlf" style='text-align:center;width:190px;'>
							{$val_items.name|ucfirst}
	</div>
	<div class="costlf" >
<a href="add_reminder_message.php?rem_id_value={$val_items.rem_id}">
<!--<img class='vAlign'  src='images/edit_btn.jpg' border='0'>-->Save message
	</a>
	&nbsp;&nbsp;
	<!--<a onclick="confirm_msg({$val_items.rem_id}, '');" href="#items_list.php?delete_item_value={$val_items.rem_id}" title="Delete">
	<img src="images/delete_btn.jpg" alt="" class="editImg" /></a>-->
	<br><br><br>
	
	<!--<span class="itemlf" ><span style="color:#CC0033">
	{if $val_items.date_modified!=''}Last Modified{/if}</span>{if $val_items.date_modified!=''}
	<b>:</b>{/if}{*$val_items.date_modified|date_format:"%B %d, %Y"*}</span>
	<br>
	</span>-->
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
