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

	<div class="mainHD fl" >Available Package &nbsp;</div>
		<div class="fr" style='padding-right:10px;padding-top:5px;font-weight:bold;' ><a href='#my_account.php' onclick='history.go(-1)'>Go Back</a></div>
		<div class="clear">
		<!--Start my items -->
		 {if $num_rows }
		<div class="myitemmain">

      
		<div  >
		   <div class="titlelf" style='font-size:12px;font-weight:bold;' >Current Package </div>
      		   <div class="itemlf"  style='border:0px solid red;'>{$pkg_pack_name} </div>
		   <div class="costlf"style='border:0px solid red;width:270px;text-align:left;' >0 - {$pkg_max_items}&nbsp;Items&nbsp;<b>Expiry:</b>&nbsp;{$pkg_exp_date|date_format}</div>
                                                
		   <div class="clear"></div>
		</div>
 
               <div  >
		   <div class="titlelf" >&nbsp; </div>
      		   <div class="itemlf"  style='border:0px solid red;'> </div>
		   <div class="costlf"style='border:0px solid red;width:270px;text-align:left;' >
                  </div>

		   <div class="clear"></div>
		</div>
              {if $num_rows_pacakage_exp>0}
                <div  >
		   <div class="titlelf" style='font-size:12px;font-weight:bold;' >Previous Package </div>
      		   <div class="itemlf"  style='border:0px solid red;'>{$pkg_pack_name_exp} </div>
		   <div class="costlf" style='border:0px solid red;width:270px;text-align:left;' >0-{$pkg_max_items_exp}&nbsp;Items &nbsp;<b>Expiry:</b>&nbsp;{$pkg_exp_date_prev|date_format}</div>

		   <div class="clear"></div>
		</div>{else}<div  >
		   <div class="titlelf" style='font-size:12px;font-weight:bold;' >Previous Package </div>
      		   <div class="itemlf"  style='border:0px solid red;color:red;font-size:12px;'>No previous package !! </div>
		   <div class="costlf" style='border:0px solid red;width:270px;text-align:left;' >&nbsp;&nbsp;
                   &nbsp;</div>

		   <div class="clear"></div>
		</div>{/if}
           <div  >
		   <div class="titlelf" >&nbsp; </div>
      		   <div class="itemlf"  style='border:0px solid red;'> </div>
		   <div class="costlf"style='border:0px solid red;width:270px;text-align:left;' >
                  </div>

		   <div class="clear"></div>
		</div>
	<div class="myItemtopbg" >
		   <div class="titlelf" >Package Title</div>
      		   <div class="itemlf"  style='border:0px solid red;'>Package Cost </div>
		   <div class="costlf"style='border:0px solid red;width:270px;text-align:left;' >Items Range</div>

		   <div class="clear"></div>
		</div>

   {if $pkg_max_items<=25}
 <div class="myiteminsidemain"  >
		<div class="titlelf">
		<div class="itmno">
1
</div>
        	<div >
                            &nbsp;&nbsp;  &nbsp;&nbsp;Basic</div>
							<div class="clear"></div>
							</div>
							<div class="itemlf" style='border:0px solid red;text-align:left;padding-left:25px;'>

			{$str_show_cat_with_commisiion} <br>


	</div>
		<div class="itemleftlf" style='border:0px solid red;width:100px;'>
			0-25 Items
	       </div>
	<div class="costlf" style='width:175px;text-align:left;border:0px solid red;'  >

     &nbsp;(Open your online shop and get space for 25 items for free.Rotate your
items in this space of 25 items.Nethaat sends you an invoice @ rate metioned against
the category of the item price ,after any product has been sold.When your store grows
upgrade to Master or Masterpro with fixed fees and no commissions.)

&nbsp;
	</div>
	<div class="clear"></div>
       </div>
						
{/if}
		{foreach name=cat from=$slabList item=val_items}
              {if $pkg_max_items <= $val_items.end_item}
               <div class="myiteminsidemain"  >
		<div class="titlelf">
		<div class="itmno">{if $smarty.request.pageNumber!="" && $smarty.request.pageNumber>1}
		  {assign var=pageconut value=$smarty.request.pageNumber-1}
		  {$smarty.const.ADMIN_PAGE_NUMBER*$pageconut+$smarty.foreach.cat.iteration}.
		  {else}
		  {$smarty.foreach.cat.iteration+1}.
		  {/if}</div>
        	<div >
                            &nbsp;&nbsp;{$val_items.package_name|ucfirst}</div>
							<div class="clear"></div>
							</div>
							<div class="itemlf" style='border:0px solid red;'>

			&nbsp;&nbsp;&nbsp;&nbsp;1 Month&nbsp;&nbsp;
                      USD&nbsp;{$val_items.amount_1month} <br>
                        &nbsp;&nbsp;&nbsp;&nbsp;6 Months&nbsp;&nbsp;
                       USD&nbsp;{$val_items.amount_6month}&nbsp;&nbsp; <br>
                     &nbsp;&nbsp;&nbsp;&nbsp;12 Months&nbsp;&nbsp;
                      USD&nbsp; {$val_items.amount_12month}&nbsp;&nbsp; <br>
	

	</div>
		<div class="itemleftlf">
			{$val_items.start_item}&nbsp;-&nbsp;{$val_items.end_item}<br>(Pay only fixed fees with no commissions.)
	       </div>
	<div class="costlf" >

       	<a href="package_detail.php?package_id={$val_items.cat_com_id}">
         <img src='images/buy_bow_btn.jpg'></a>&nbsp;&nbsp;
	</div>
	<div class="clear"></div>
       </div>
		{/if}
  {/foreach}
	<div class="itemimgbox" style='width:690px;'>
		&nbsp;&nbsp;&nbsp;&nbsp;

	     
		</div>
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
