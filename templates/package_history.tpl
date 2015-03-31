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

	<div class="mainHD fl" >Purchase Package History </div>
		<div class="fr" style='padding-right:10px;padding-top:5px;font-weight:bold;' ><a href='#my_account.php' onclick='history.go(-1)'>Go Back</a></div>
		<div class="clear">
		<!--Start my items -->
		 {if $num_rows }
		<div class="myitemmain">


		<div class="myItemtopbg" >
		   <div class="titlelf"  style='border:0px solid red;width:120px;'>Package Title</div>
      		   <div class="itemlf"  style='border:0px solid red;width:165px;'>Duration & Cost </div>
		      <div class="costlf"style='border:0px solid red;width:360px;text-align:left;' >
                          <div  style='border:0px solid red;width:100px;float:left;'> Items Range </div>
                          <div  style='border:0px solid red;width:122px;float:left;'> Purchased Date </div>
                          <div style='border:0px solid red;width:120px;float:left;'> Expiry Date </div>

	
                       </div>

		   <div class="clear"></div>
		</div>




		{foreach name=cat from=$slabList item=val_items}

               <div class="myiteminsidemain">
		<div class="titlelf"  style='border:0px solid red;width:120px;'>
		<div class="itmno">{if $smarty.request.pageNumber!="" && $smarty.request.pageNumber>1}
		  {assign var=pageconut value=$smarty.request.pageNumber-1}
		  {$smarty.const.ADMIN_PAGE_NUMBER*$pageconut+$smarty.foreach.cat.iteration}.
		  {else}
		  {$smarty.foreach.cat.iteration}.
		  {/if}</div>
        	<div  style='border:0px solid red;width:100px;' >
                            &nbsp;&nbsp;{$val_items.pack_name|ucfirst}</div>
							
							</div>
							<div class="itemlf" style='border:0px solid red;width:200px;text-align:left;float:left;'>

			&nbsp;&nbsp;&nbsp;&nbsp;{$val_items.time_month}&nbsp;&nbsp;
                      USD&nbsp;{$val_items.amount}
	</div>
		<div class="itemleftlf" style='text-align:left;padding-left:10px;border:0px solid red;width:100px;' >
			{$val_items.min_items}&nbsp;-&nbsp;{$val_items.max_items}      </div>
	<div  style='text-align:left;float:left;border:0px solid red;width:240px;'>
        <div class="costlf"  style='text-align:left;float:left;border:0px solid red;width:100px;'>
              {$val_items.date_purchased|date_format} </div>
	<div class="costlf"  style='text-align:left;border:0px solid red;width:110px;' >
       {$val_items.expiry_date|date_format}&nbsp;<br><span style='font-size:12px;color:red;' >
      {if $val_items.pack_status==1}   (Active){else} (Expired){/if}</span></div>
	</div>
        <div class="clear"></div>
       </div>

  {/foreach}
	<div class="itemimgbox" style='width:690px;'>
		&nbsp;&nbsp;&nbsp;&nbsp;


		</div>
		  <div class="clear"></div>
		</div>
{else}
<div class="myitemmain" style='text-align:center;font-family:red;font-size:14px;color:red;'>No records found!!</div>
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
