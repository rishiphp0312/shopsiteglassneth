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

       <script language="JavaScript" src="calendar_us.js"></script>
	<link rel="stylesheet" href="calendar.css">
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




$(document).ready(function()
{

	$("a.item_quantity").fancybox({
	'hideOnContentClick': false,
	'frameWidth'			: 255,
	'frameHeight'			: 100
	});
});
function submit_pay_directpackage(PKG_PAY_URL,ADM_PAYPAL_ID)
{
//alert(PKG_PAY_URL+"=Payment details of admin is incomplete.Payment cannot be processed further!!="+ADM_PAYPAL_ID);
	
   if(ADM_PAYPAL_ID!='')
	{
    document.frm_pay_directpackage_paypal.action=PKG_PAY_URL;
    document.frm_pay_directpackage_paypal.submit();
    return false;
    }
	else
	{
	alert("Payment details of admin is incomplete.Payment cannot be processed further!!")
	  return false;
	}
}
 function showval_hidden(NUM,VAL)
{
  var PACK_COST;
  PACK_COST=VAL;
  var MON_TH ;

  if(NUM==1 || NUM=='')
  MON_TH  =1;

  if(NUM==2)
  MON_TH  =6;

  if(NUM==3)
  MON_TH  =12;

  document.getElementById('amount').value  = PACK_COST;
  document.getElementById('amount1').value = PACK_COST;
  
  var str = document.getElementById('custom1').value+'##--0|0--##'+MON_TH;
  document.getElementById('custom').value = str;
  //document.getElementById('custom1').value = '';
  //alert(document.getElementById('custom').value+'--custom');
 // NUM='';
}
</script>
{/literal}

<div id="middleRtMain">
	<div class="shopmain">
				<div class="mainHD fl" >Package Detail </div>
				<div class="fr" style='padding-right:10px;padding-top:5px;font-weight:bold;' ><div style="width:100px;float:left;" >
				<a href='#my_account.php'  onclick='history.go(-1)'>Go Back</a>
				</div>

				</div>
				<div class="clear">
					<!--Start my items -->

					<div class="myitemmain" style='width:700px;'  >

					
  <div class="myItemtopbg" style='text-align:right;'  >
                               <form name='frm_pay_directpackage_paypal' action="" method="post">
          <!--<a href='#' onclick='return submit_pay_directpackage();'>Pay directly on Paypal</a>
                            <a href='#' onClick='return submit_pay_directpackage();'>Pay directly on Paypal</a>
<input type='image' src="images/paypal.gif" alt="" />-->

                                <input type='hidden' value='{$amount_1month}' id='amount1' name='amount'>
                                <input type="hidden" name="redirect_cmd" value="_xclick" />
                             	<input type="hidden" name="cmd" value="_ext-enter" />
                                <input type="hidden" name="business" value="{$adm_paypal_merchant_id}" />
                                <input type='hidden' value='{$custom}##--0|0--##1' id='custom' name='custom'>
                                <input type='hidden' value='{$custom}' id='custom1' name='custom1'>
                                <input type="hidden" name="item_name" value="Package Purchase">
                                <input type="hidden" name="no_shipping" value="0" />
                                <input type="hidden" name="return" value="{$baseUrl}my_account.php" />
                                <input type="hidden" name="cancel_return" value="{$baseUrl}api_error1.php" />
                                <input type="hidden" name="no_note" value="1" />
                                <input type="hidden" name="currency_code" value="USD" />
                                <input type="hidden" name="notify_url" value="{$baseUrl}notify_pay_package.php" />
                                <input type="hidden" name="flag" value="yes">

                                 </form>
                                  </div>

						<div  >
							<div class="titlelf" >
							</div>

							<div class="itemlf"   >

							</div>
							<div class="itemleftlf"  style='width:200px;'>

							
							<!--quantity_available -->
							</div>
							<div class="costlf" >&nbsp;</div>
							<div class="clear"></div>
						</div>
						<div  >
			
							<div class="itemleftlf"  style='width:200px;'>
							&nbsp;
							</div>
							<div class="costlf"  style="width:200px;float:right;">
							&nbsp;</div>
							<div class="clear"></div>
						</div>

						<div  style='border:0px solid red;width:620px;'  >
					</div>
		
		
		
			
			<div   >
               <form name="frm_purchasepackage" id='frm_purchasepackage' action='pay-package-cost.php' method='post' >
                          <div class="titlelf" style="float:left;padding-top:0px;border:0px solid red;width:650px;" >
                            <div><span style="font-size:12px;text-align:left;color:#000000;">Note:</span>
<span style="font-size:12px;text-align:left;color:red;">Price of package is inclusive of the taxes.</span>
				</div>

				
				<div class="clear"></div>
				</div>
            <div class="titlelf" style="float:left;padding-top:0px;border:0px solid red;width:650px;" >
                            <div>&nbsp;
				</div>


				<div class="clear"></div>
				</div>
			<div class="titlelf" style="float:left;width:100px;" ><b>Package Name:</b></div>

				<div class="itemlf" style="float:right;width:580px;text-align:left;"  >
                                                   {$package_name|ucfirst}
				</div>
				<div class="itemleftlf"  style='width:200px;'>&nbsp; </div>
				<div class="costlf" >&nbsp;</div>
				<div class="clear"></div>
				</div>

				<div  >
				<div class="titlelf" style='font-weight:bold;text-align:left;float:left;width:100px;'  >Select Duration :</div>

				<div class="itemlf" style="float:right;width:580px;text-align:left;" >
                                 <input type='radio' value='1'onclick="return showval_hidden('1',{$amount_1month})" checked='checked'  name='duration_id'>1 Month &nbsp;
                                 <input type='radio' value='6'onclick="return showval_hidden('2',{$amount_6month})"  name='duration_id'>6 Months &nbsp;
                                  <input type='radio' value='12'onclick="return showval_hidden('3',{$amount_12month})" name='duration_id'>1 Year &nbsp;
				</div>
				<div class="itemleftlf"  style='width:200px;'>	  </div>
				<div class="costlf" >&nbsp;</div>
				<div class="clear"></div>
				<div class="itemleftlf"  style='width:200px;'> </div>
				<div class="costlf" >&nbsp;</div>
				<div class="clear"></div>
				</div>
				<div  >
                                 <div class="titlelf" style='font-weight:bold;text-align:left;float:left;width:100px;'  >
                                    Package Cost :</div>
        			    <div class="itemlf" style="float:right;width:580px;text-align:left;" >
                                     1 Month &nbsp;&nbsp;&nbsp;&nbsp;USD {$amount_1month}
                                     <br>6 Month &nbsp;&nbsp;&nbsp;&nbsp;USD {$amount_6month}
                                     <br>1 Year &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;USD {$amount_12month}
                                     </div>
        			     <div class="itemleftlf"  style='width:200px;'>&nbsp;
				  </div>
                                   <div class="clear"></div>
                                    <div  >
                                       <div class="titlelf" style='font-weight:bold;text-align:left;float:left;width:100px;'  >
                                            Items Range :</div>
    					    <div class="itemlf" style="float:right;width:580px;text-align:left;" >
                  			   {$start_item}&nbsp;-&nbsp;{$end_item}
                                             </div>
					     <div class="itemleftlf"  style='width:200px;'>
	    				     </div>

					<div class="costlf" >&nbsp;</div>
					<div class="clear"></div>
					<div class="itemleftlf"  style='width:200px;'>
					</div>
					<div class="costlf" >&nbsp;</div>
					<div class="clear"></div>
					</div>




				<div class="itemleftlf"  style='width:200px;'>
                                  <input type='hidden' value='{$amount_1month}' id='amount' name='amount'>
                                  <input type='hidden' value='{$end_item}' id='max_items' name='max_items'>
                               
                                  <input type='hidden' value='{$start_item}' id='min_items' name='min_items'>
                                  <input type='hidden' value='{$package_name}' id='package_name_id' name='package_name_id'>

					 </div>
					<div class="costlf" >&nbsp;</div>
					<div class="clear"></div>
					<div class="itemleftlf"  style='width:100px;'>
					  </div>
					<div class="costlf" style='width:700px;text-align:left;padding-top:5px;border:0px solid red;' >
                                          <div style='width:400px;text-align:left;float:left;'>&nbsp;&nbsp;
 <img src="images/paypal_cart.jpg" alt="" />&nbsp;<br>&nbsp;&nbsp;<!--
<input type='submit' name='pay_now'  value=' Purchase through Credit Card '
style='width:180px;font-size:12px;font-weight:bold;background-color:#7E354D;border:1px solid #7E354D;
cursor:pointer;color:#ffffff;'>--></div><div style='width:280px;text-align:left;float:right;'>&nbsp;&nbsp;&nbsp; <img src="images/paypal.gif" alt="" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong> <a href='#'
 onClick="return submit_pay_directpackage('{$PAYPAL_URL}','{$adm_paypal_merchant_id}');">Pay directly on Paypal</a></strong></div>
</div>
					<div class="clear"></div>
					</div>
				</form>

			<div class="itemimgbox" style='width:690px;'>
			{*$page_counter*}<!-- records-->&nbsp;&nbsp;&nbsp;&nbsp;<span style="float:right;">
			{*$pageLink*}</span>
			<div class="clear"></div>
			</div>

			<div class="itemimgbox"	style='color:red;font-size:14px;width:690px;'>
					<!--	No records found!!--></span>
			<div class="clear"></div>
			</div>
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
