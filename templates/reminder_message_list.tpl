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
         //alert(id+'=id');
	jConfirm(message, 'Confirm', function(r) 
	{
		if(r)
		{
			location.href='items_list.php?delete_item_value='+id;
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

				<div style="border:0px solid #FF0000;width:650px;" class="mainHD fl" >
				<div style="width:250px;float:left;" >				
				My Reminder's Message </div>
				<div style="width:420px;float:right;text-align:center;font-size:12px;color:#333333;border:0px solid red;" >
				<!--<form name="frm_serch" action="" method="get">
				<input type="radio" name="serch_item_value" checked="checked" {if $serch_item_value_chk==0 ||$serch_item_value_chk=='' }checked{/if}  value="0" />All &nbsp;
				<input type="radio" name="serch_item_value" {if $serch_item_value_chk==1}checked{/if} value="1" />Active&nbsp;	<input {if $serch_item_value_chk==3}checked{/if} type="radio" name="serch_item_value" value="3"  />Hold&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="Search" class="Class_Button_ris name" style="width:80px;" name="search" />
				</form>-->
				</div>
				</div>
				<div class="fr" style='padding-right:10px;padding-top:5px;font-weight:bold;' ><a href='#my_account.php' onclick='history.go(-1)'>Go Back</a></div>
				<div class="clear">
					<!--Start my items -->
					 {if $users_items_details}
					<div class="myitemmain">
					
					
						<div class="myItemtopbg" >
							<div class="titlelf" >Name 
							
	</div>
							
							<div class="itemlf"   >Message </div>
			<div class="itemleftlf"  style='width:200px;' >
		Event Date
							<!--<br><br><a href='#'>Send it in Hatting</a>-->
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
			{$val_items.name|ucfirst}
							<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						</div>
							<div class="clear"></div>
							</div>
							<div class="itemlf" style='border:0px solid red;'>


        &nbsp;&nbsp;&nbsp;&nbsp;{$val_items.message}
	
	</div>
							<div class="itemleftlf">
							  &nbsp;&nbsp;&nbsp;&nbsp;{$val_items.rem_day}-{$val_items.rem_month|date_value_month}
	</div>
	<div class="costlf" >
<a href="edit-reminder-mesg.php?rem_id_value={$val_items.rem_gift_id}"><img class='vAlign'  src='images/edit_btn.jpg' border='0'>
	</a>
	<!--<a href="item-details.php?details_item_value={$val_items.item_id}"><img src="images/details_btn.jpg" alt="" class="editImg" /></a>&nbsp;&nbsp;
	<a 
	onclick="confirm_msg({$val_items.item_id}, '');" href="#items_list.php?delete_item_value={$val_items.item_id}" title="Delete">
	<img src="images/delete_btn.jpg" alt="" class="editImg" /></a>
	<br><br><br>-->
	
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
