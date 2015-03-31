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
			location.href='seller_active_items.php?delete_item_value='+id;
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

				<div class="mainHD fl" >Commision on Sold Items</div>
				<div class="fr" style='padding-right:10px;padding-top:5px;font-weight:bold;' ><a href='#my_account.php' onclick='history.go(-1)'>Go Back</a></div>
				<div class="clear">
					<!--Start my items -->
					 {if $users_items_details}
					<div class="myitemmain">


						<div class="myItemtopbg" >
							<div class="titlelf" >Title
							<!--<a href='seller_active_items.php?order_by={$title_asc}'><img src='images/arrow_top.gif'></a>&nbsp;
							<a href='seller_active_items.php?order_by={$title_desc}'><img src='images/arrow_btm.gif'></a>-->
	</div>

							<div class="itemlf"   >Commision Cost
							<!--<a href='seller_active_items.php?order_by={$cost_asc}'>
							<img src='images/arrow_top.gif'>
							</a>&nbsp;
							<a href='seller_active_items.php?order_by={$cost_desc}'>
                                            <img src='images/arrow_btm.gif'></a>--> </div>
							<div class="itemleftlf"  style='width:200px;' >Payment Status
 
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
	<a href="item-details.php?details_item_value={$val_items.item_id}">
        <img  src="{if $val_items.image1!=''}{$baseUrl}getthumb.php?w=150&h=50&fromfile=uploads/{$val_items.image1}{else}images/item_small_img.jpg{/if}" alt="" {if $val_items.image1==''}height='50' width="100"{/if}  border='0' class="itemimg handle" /></a>
	<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="item-details.php?details_item_value={$val_items.item_id}">{$val_items.title|truncate:20}</a></div>
	<div class="clear"></div>
	</div>
	<div class="itemlf" style='border:0px solid red;'>
		&nbsp;&nbsp;&nbsp;&nbsp;<!--$&nbsp;-->
                {if $val_items.commision_amount!='' && $val_items.commision_amount!=0}
                   {$val_items.commision_amount|convert_price}
                {else}
                   Free
                {/if}
                            

	</div>
	<div class="itemleftlf">
	{if $val_items.commision_status==0}Pending{else}Paid{/if}
             &nbsp;&nbsp;&nbsp;
          </div>
          <div class="costlf" >
	            <!--<a href="item-details.php?details_item_value={$val_items.item_id}">
                   <img src="images/details_btn.jpg" alt="" class="editImg" /></a>&nbsp; &nbsp;
            <a	onclick="confirm_msg({$val_items.item_id}, '');" href="#seller_active_items.php?delete_item_value={$val_items.item_id}" title="Delete">-->
	</a><span class="itemlf" >Purchase date&nbsp;:&nbsp;{$val_items.purchase_date|date_format}</span>

	</div>
	<div class="clear"></div>
						</div>



							{/foreach}


						<div class="itemimgbox" style='width:690px;'>
						{$page_counter} records&nbsp;&nbsp;&nbsp;&nbsp;<span style="float:right;">
						{$pageLink}</span>
							<div class="clear"></div>
							</div>
                          <div class="itemimgbox" style='width:690px;border:0px solid red;height:20px;vertical-align:bottom;'>
						<div>
                                                &nbsp;</div>
                                        	<div class="clear"></div>
						</div>
                                               <div class="itemimgbox" style='width:690px;border:0px solid red;height:20px;vertical-align:bottom;'>
						<div>Note:<span style='font-size:12px;color:red;'>Prices are inclusive of  tax.</span></div>
                                        	<div class="clear"></div>
						</div>
						
                                                <div class="itemimgbox" style='width:690px;border:0px solid red;'><br>
						<div style="width:300px;float:left;">Total Commision &nbsp;<b>
          <span style='font-weight:bold;color:#000000;font-size:12px;'>
       {if $total_amt_commison!=0 && $total_amt_commison!='' }{$total_amt_commison}{else}0{/if}&nbsp;&nbsp;&nbsp;USD</span></b>
           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{if $total_amt_commison!=0 && $total_amt_commison!='' }
        {$total_amt_commison|convert_price}{else}
    <span style='font-size:12px;font-weight:bold;color:red;'>Payment Completed.</span>{/if}&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;
        {if $total_amt_commison!=0 && $total_amt_commison!='' }
            &nbsp;<img src="images/paypal.gif" alt="" />&nbsp;&nbsp;
                             &nbsp; <a href='pay-for-commision.php'><b>Pay Direct</b></a>&nbsp;&nbsp;&nbsp;&nbsp; {/if}
				</div>
               <div style="width:300px;float:right;">{if $total_amt_commison!=0 && $total_amt_commison!='' }
                 &nbsp;<img src="images/paypal_cart.jpg" alt="" />&nbsp;<br>
               <!--   <a href='pay-commison-card.php'><b>Pay through CreditCard</b></a>&nbsp;&nbsp;--> {/if}
                  </div>
                             			<div class="clear"></div>
							</div>
     <div class="itemimgbox" style='width:690px;border:0px solid red;'>&nbsp;</div>
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
