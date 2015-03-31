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

				<div class="mainHD fl" >My Sold Items</div>
				<div class="fr" style='padding-right:10px;padding-top:5px;font-weight:bold;' ><a href='#my_account.php' onclick='history.go(-1)'>Go Back</a></div>
				<div class="clear">
					<!--Start my items -->
					 {if $users_items_details}
					<div class="myitemmain">
					
					
						<div class="myItemtopbg"  style="width:700px;border:0px solid red;" >
							<div class="titlelf" style="width:140px;border:0px solid red;" >Title
							<a href='seller_sold_item.php?order_by={$title_asc}'><img src='images/arrow_top.gif'></a>&nbsp;
							<a href='seller_sold_item.php?order_by={$title_desc}'><img src='images/arrow_btm.gif'></a> 
	</div>
							
							<div class="itemlf"  style="width:220px;border:0px solid red;padding-left:10px;" >
							Item Cost&nbsp;&nbsp;&nbsp;&nbsp;Total Sold Cost </div>
							<div class="itemleftlf"  style='width:120px;border:0px solid red;text-align:right;' >Buyer
                                                       
							
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
							<div style='padding-left:25px;border:0px solid red;width:100px;'>
                                                        <a href="item-details.php?details_item_value={$val_items.item_id}">
                                                        <img  src="{if $val_items.image1!=''}{$baseUrl}getthumb.php?w=150&h=50&fromfile=uploads/{$val_items.image1}{else}images/item_small_img.jpg{/if}" alt=""{if $val_items.image1==''} height='50' width="100"{/if} border='0'  class="itemimg handle" /></a>
							<br>&nbsp;<a href="item-details.php?details_item_value={$val_items.item_id}">{assign var= 'title_firt' value=$val_items.title|ucfirst}{$title_firt|truncate:25}</a></div>
							<div class="clear"></div>
							</div>
							<div class="itemlf" style='border:0px solid red;text-align:left;width:90px;'>

							
							
                                                        {$USD}&nbsp;{$val_items.cost_item|number_format:2:".":","}&nbsp;&nbsp;&nbsp;</div>
                                                       <div class="itemlf" style='border:0px solid red;text-align:left;width:130px;'>
                                                       &nbsp;&nbsp;&nbsp;<b>Amount</b> ={if $val_items.amount!='0.00'}
                                                       {$val_items.amount|convert_price}{else}Purchased by giftcard{/if}<br>
                                                       <b>Giftcard1</b> ={if $val_items.gift_card1!='0.00'} {$val_items.gift_card1|convert_price}{else}Not Used{/if}<br>
                                                       <b> Giftcard2</b> ={if $val_items.gift_card2!='0.00'} {$val_items.gift_card2|convert_price}{else}Not Used{/if}<br>
                                                       <b>Shipping Cost </b>={if $val_items.ship_cost!=''} {$val_items.ship_cost|convert_price}{else}Free{/if}
                                                      &nbsp;&nbsp;&nbsp;

	                                          
                                                        </div>
							<div class="itemleftlf" style="text-align:right;">
							{if $val_items.first_name==''} 0
							{else} {$val_items.first_name|ucfirst} {$val_items.last_name|ucfirst}
							{/if}&nbsp;&nbsp;&nbsp;
<!--{if $val_items.inventory_alert >=$val_items.quantity_available}
	<blink>
	<a class="item_quantity" href="{$baseUrl}add_quantity.php?item_id_value={$val_items.item_id}">
	Update Quantity</a></blink>
	{else}
		<a class="item_quantity" href="{$baseUrl}add_quantity.php?item_id_value={$val_items.item_id}">
	Update Quantity</a>
	{/if}-->
	</div>
	<div class="costlf" >
     <!--<a href="sell-an-item.php?item_id_value={$val_items.item_id}"><img class='vAlign'  src='images/edit_btn.jpg' border='0'>
	</a>-->
	<!--
	<a href="item-details.php?details_item_value=
	{$val_items.item_id}">
	<img src="images/details_btn.jpg" alt="" class="editImg" /></a>&nbsp;&nbsp;-->
	<!--<a 
	onclick="confirm_msg({$val_items.item_id}, '');" href="#items_list.php?delete_item_value={$val_items.item_id}" title="Delete">
	<img src="images/delete_btn.jpg" alt="" class="editImg" /></a>-->
	<br><br><br>
	
	<span class="itemlf" ><span style="color:#CC0033">
	{if $val_items.purchase_date!=''}Sold Date{/if}</span>{if $val_items.purchase_date!=''}
	<b>:</b>{/if}{$val_items.purchase_date|date_format}</span>
	<br>
	<!--{if $val_items.status!=3}Current Status{/if}<span style="color:red;padding-left:5px;">{if $val_items.status==0}Pending {/if}{if $val_items.status==1}Active {/if}
	{if $val_items.status==2}Suspend{/if}</span>-->
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
