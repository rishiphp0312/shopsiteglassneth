{include file="header.tpl"}
{include file="js_css_validation.tpl"} 
{include file="header_search.tpl"}

{literal}
<script language="javascript">
function giftcard_success_r()
{
    //alert('giftcard_success_r');	
	
	document.getElementById("giftcard1").style.display="none";
	document.getElementById("giftcard").style.display="none";
	document.getElementById("creditcard").style.display="none";
	document.getElementById("giftcardsuccess").style.display="block";
	document.getElementById("giftcardsuccess2").style.display="none";
	document.getElementById("headerlink").style.display="none";
//	document.getElementById("pulse_calc_row_id").style.display="none";
	
	
	
}


function open_gift()
{
    //alert('open_gift');	
	document.getElementById("headerlink").style.display="none";
	document.getElementById("giftcard").style.display="block";
	document.getElementById("creditcard").style.display="none";
	document.getElementById("giftcardsuccess").style.display="none";
	document.getElementById("giftcard1").style.display="none";
	document.getElementById("giftcardsuccess2").style.display="none";
}

function open_gift_second()
{
    //alert('open_gift_second');
	document.getElementById("headerlink").style.display="none";
	document.getElementById("giftcard1").style.display="block";
	document.getElementById("giftcard").style.display="none";
	document.getElementById("creditcard").style.display="none";
	document.getElementById("giftcardsuccess").style.display="none";
	document.getElementById("giftcardsuccess2").style.display="none";
}

function open_creditcard()
{	//alert('open_creditcard');	
   //alert(window.location);
    window.location= 'pay-item-cost.php';
	document.getElementById("headerlink").style.display="none";
	document.getElementById("giftcard1").style.display="none";
	document.getElementById("giftcard").style.display="none";
	document.getElementById("giftcardsuccess").style.display="none";
	document.getElementById("creditcard").style.display="block";
	document.getElementById("giftcardsuccess2").style.display="none";

}

function giftcard_success()
{
	//alert('giftcard_success');
	document.getElementById("giftcard1").style.display="none";
	document.getElementById("giftcard").style.display="none";
	document.getElementById("creditcard").style.display="none";
	document.getElementById("giftcardsuccess").style.display="block";
	document.getElementById("giftcardsuccess2").style.display="none";
	document.getElementById("headerlink").style.display="none";
	
}
function giftcard_success2()
{
  document.getElementById("giftcard1").style.display="none";
	document.getElementById("giftcard").style.display="none";
	document.getElementById("creditcard").style.display="none";
	document.getElementById("giftcardsuccess").style.display="none";
	document.getElementById("giftcardsuccess2").style.display="block";
	document.getElementById("headerlink").style.display="none";
  /*alert(document.getElementById("giftcardsuccess2").style.display);	
	document.getElementById("giftcardsuccess2").style.display="block";
	document.getElementById("headerlink").style.display="none";
	document.getElementById("giftcard1").style.display="none";
	document.getElementById("giftcard").style.display="none";
	document.getElementById("creditcard").style.display="none";
	document.getElementById("giftcardsuccess").style.display="none";
	  alert(document.getElementById("giftcardsuccess2").style.display);
*/}
function return_success()
{alert('return_success');
	document.getElementById("headerlink").style.display="none";
}
function submit_form_paypal()
{
//	document.getElementById("headerlink").style.display="none";
}
function check_quantity()
{
  if(parseInt(document.getElementById('requested_quantity').value)>parseInt(document.getElementById('item_available_quantity').value) )
  {
  alert('Requested quantity is greater than available stock.Please enter less quantity!!');
  document.getElementById('requested_quantity').value='';
  return false;
  }
  else if(document.getElementById('requested_quantity').value=='' || document.getElementById('requested_quantity').value=='0')
 
  {
  alert('Please enter quantity!!');
  return false;
  }
 

}


</script>
{/literal}

<!--Start Middle-->
<div id="middleMain">
{*include file="left_category.tpl"*}
<!--<div id="middleRtMain">-->
<div>
<!--Start Tab Link-->

<div class="shopmain">
<span class="mainHD">Check Out</span>
	<!--Start my items -->
	<div class="myitemmain">
		<div class="myItemtopbg">
			<div class="clear"></div>
		</div>
		
		<div class="myiteminsidemain">
		<table width="100%" cellpadding="3" cellspacing="3" border="0" >
		<tr>
		<td style="padding:15px;vertical-align:top;border:1px solid #8A5F40">

		<table width="100%" cellpadding="3" cellspacing="3" border="0" align="center">
		{if $success !=""}
		<tr>
			<td colspan="2" style="font-size:13px;vertical-align:top;color:green" >
				<b>{$success}</b>			</td>
		</tr>
		{/if}
		{if $error_msg !=""}
		<tr>
			<td colspan="2" style="font-size:13px;vertical-align:top;color:red" >
				<b>{$error_msg}</b>			</td>
		</tr>
		{/if}
		<tr>
			<td colspan="2" style="font-size:12px;vertical-align:top;color:red" >
				<span style="color:#000000;">Note&nbsp;:&nbsp;</span>While purchasing the item with the giftcard,please
                                 enter the giftcard code after modifying the quantity.
. 		</td>
		</tr>
                <tr>
			<td colspan="2" style="font-size:12px;vertical-align:top;color:red" ><noscript>Your browser does not support JavaScript!.Please enable javascript on your browser.</noscript></td>
		</tr>

		
                <tr bgcolor='#FFF9EF'>
		<td  colspan=2 align="left" valign="top" style="font-size:14px;font-weight:bold;vertical-align:top;color:##333333;" >Order from <span class='classStorechkout'> {$merchant_user_name|ucfirst}</span>&nbsp;
&nbsp;<!--<span style="font-size:12px;font-weight:bold;vertical-align:top;color:#990000;text-align:right;float:right;">  <a onclick="history.go(-1);" href="#my_account.php" >Go Back</a> </span>-->
</td>
		<!--<td width="4%" align="left" valign="top"
style="font-size:12px;font-weight:bold;vertical-align:top;color:#990000;text-align:right;" >
</td>-->
		</tr>
	
                <tr>
		<td colspan="2" style="font-size:12px;vertical-align:top;color:#000000;" >
                <table width="100%" cellpadding="3" cellspacing="1" border="0" align="center" bgcolor='#EAEAE3' >
              
                <!--<tr  >
                <td  style="font-size:12px;vertical-align:top;color:#000000;" >
                <b>Item Cost  </b>
                </td>
		<td  style="font-size:12px;vertical-align:top;color:#000000;" >
                <b>Shipping Cost  </b> 
                </td><td  style="font-size:12px;vertical-align:top;color:#000000;" >
                <b>Quantity </b>
                </td>
                <td  style="font-size:12px;vertical-align:top;color:#000000;" >
                <b>Order Total
                </td> <td  style="font-size:12px;vertical-align:top;color:#000000;" >
                <b>Order Total
                </td>
		</tr>-->
   <tr  >
               
		<td  style="font-size:12px;vertical-align:top;color:#000000;" >
                <b>Item Description </b>
                </td>
                <td  style="vertical-align:top;color:#000000;" >&nbsp;
                 
                </td>
                <td  style="font-size:12px;vertical-align:top;color:#000000;" >
                <b>Unit Price </b>
                </td> <td  style="font-size:12px;vertical-align:top;color:#000000;" >
                <b>Quantity  </b>
                </td>
                <td  style="font-size:12px;vertical-align:top;color:#000000;" >
                <b> Price</b>
                </td>
		</tr>
     <!--    <tr bgcolor='#ffffff'>
		<td  style="font-size:12px;vertical-align:top;color:#000000;" >
               &nbsp;{$smarty.session.show_d_cost_item|convert_price}&nbsp;&nbsp;<br>&nbsp;USD {$smarty.session.show_d_cost_item|convert_number}                </td>
                <td  style="font-size:12px;vertical-align:top;color:#000000;" >
               &nbsp;{$smarty.session.service_rate|convert_price}&nbsp;&nbsp;<br>&nbsp;USD {$smarty.session.service_rate|convert_number}
                </td>
              	<td  style="font-size:12px;vertical-align:top;color:#000000;" >
               {$smarty.session.sess_requested_quantity}
                </td>
		<td  style="font-size:12px;vertical-align:top;color:#000000;" >
                {assign var= 'tot_cost' value=$smarty.session.show_d_cost_item*$smarty.session.sess_requested_quantity}
	        {$tot_cost|convert_price}&nbsp;  + &nbsp; {$smarty.session.service_rate|convert_price}&nbsp;&nbsp; ={assign var='all_finalcosts' value=$tot_cost+$smarty.session.service_rate}&nbsp;{$all_finalcosts|convert_price}&nbsp;&nbsp;(USD {$all_finalcosts|convert_number})
                 </td>
 <td  style="font-size:12px;vertical-align:top;color:#000000;" >
                <b>Order Total
                </td>
		</tr>
             -->

                <tr bgcolor='#ffffff' height='100'>
		
                <td  align='center' style="font-size:12px;vertical-align:top;color:#000000;padding-bottom:4px;" width='98' >
              <img src="{$baseUrl}getthumb.php?w=80&h=80&fromfile={if $item_image!=''}uploads/{$item_image}{else}images/item_small_img.jpg{/if}"
			  alt="" border="0" class="buyerimg"  />
               </td>
               <td  style="font-size:12px;vertical-align:top;color:#000000;padding-bottom:4px;" >
             
                &nbsp;<b>{$title|ucfirst}</b>
               </td>
              	<td  style="font-size:12px;vertical-align:top;color:#000000;padding-bottom:4px;" >
               {$smarty.session.show_d_cost_item|convert_price}&nbsp;&nbsp;<br>
                USD {$smarty.session.show_d_cost_item|convert_number}    </td>
		<td  style="font-size:12px;vertical-align:top;color:#000000;padding-bottom:4px;" >
             <span >  <form action="" method="post" id='frm_buynow_quantity' name="frm_buynow_quantity">
                <input type='text' value='{$smarty.session.ship_quantity}' class="required only_numeric" id='requested_quantity' style='width:40px;' name='requested_quantity'>&nbsp;&nbsp;
                <input type='submit' onclick="return check_quantity();"  class="Class_Button_ris"  value=" Update " style='width:90px;'  name='change'>
&nbsp;          <br>   <input type='hidden' value='{$smarty.request.item_id}' name='item_id'>
                <input type='hidden' value='{$smarty.request.seller_id}' name='seller_id'>
                <input type='hidden' value='{$item_quantity}' id='item_available_quantity' name='item_available_quantity'>
		</form>  </span>       &nbsp;<br> <span style='padding-top:4px;'> {$item_quantity} In Stock </span>   </td>
                  <td  style="font-size:12px;vertical-align:top;color:#000000;padding-bottom:4px;" >
{assign var= 'tot_cost' value=$smarty.session.show_d_cost_item*$smarty.session.sess_requested_quantity}
	        {$tot_cost|convert_price }&nbsp; <br>
  USD {$tot_cost|convert_number}&nbsp;
                  </td>
	
		</tr>
      
                </table>
                </td>
		</tr>
<tr><td colspan=2>&nbsp;</td></tr>

	<tr><td>&nbsp;</td>
		<td align='right'width='380px' style="border:1px solid #D3CEC2; font-size:12px;vertical-align:top;color:#000000;text-align:right;border-bottom:1px solid #7E354D;" height='20' >
                <table align='right' cellpadding='2' cellspacing='0' bgcolor='#D3CEC2' border='0' width='380px'>
                <tr bgcolor='#ffffff' >
		<td  align='right' width='140px' style="font-size:12px;vertical-align:top;color:#000000;text-align:right;
border-bottom:0px solid #7E354D;" height='20' >
                Product Total
                      </td><td align='left'  style="font-size:12px;vertical-align:top;color:#000000;text-align:right;
border-bottom:0px solid #7E354D;">&nbsp;&nbsp;{$tot_cost|convert_price } <br>&nbsp;&nbsp;  USD {$tot_cost|convert_number}


                 </td>
		</tr>
                 <tr bgcolor='#ffffff'>
	        <td  align='right'  style="font-size:12px;vertical-align:top;color:#000000;text-align:right;" >
                Shipping Cost  </td>
                <td align='left' style="font-size:12px;vertical-align:top;color:#000000;text-align:right;
border-bottom:0px solid #7E354D;" >&nbsp;&nbsp;{$smarty.session.service_rate*$smarty.session.sess_requested_quantity|convert_price}<br>
&nbsp;&nbsp;USD {$smarty.session.service_rate*$smarty.session.sess_requested_quantity|convert_number}</td>
		</tr>
                 <tr bgcolor='#D3CEC2' >
	        <td  align='right'  style="font-size:14px;vertical-align:top;color:#000000;text-align:right;" >
                <b>Order Total</b>  </td>
                <td align='left'  style="font-size:12px;vertical-align:top;color:#000000;text-align:right;
border-bottom:0px solid #7E354D;">&nbsp;{assign var= 'tot_cost' value=$smarty.session.show_d_cost_item*$smarty.session.sess_requested_quantity}
	     {assign var='all_finalcosts' value=$tot_cost+$smarty.session.service_rate*$smarty.session.sess_requested_quantity}&nbsp;{$all_finalcosts|convert_price}&nbsp;&nbsp;(USD {$all_finalcosts|convert_number})</td>
		</tr>
              
                  </table>
                      </td>
		</tr>
              
		  <tr>
		<td  align='left' style="font-size:12px;vertical-align:top;color:#000000;"  >
&nbsp;&nbsp;&nbsp;&nbsp;

</td>
		</tr>
<tr>
			<td  align='left' style="font-size:12px;vertical-align:top;color:#000000;"
></td>
		</tr>

		<tr>
			<td  style="font-size:13px;vertical-align:top;text-align:left;" >&nbsp;
					</td>
		
			<td  style="font-size:13px;vertical-align:top;" >
				
			</td>
                </tr>
		<tr>
		<td colspan="2">
		<div id="headerlink" style="display:block;">
		
			<div>
&nbsp;				</div>
				<div>
&nbsp;				</div>
			<div style='border:0px solid red;font-size:12px;'  >
			{if $smarty.session.payment_type==0} 
			<div class="payPalLft" style='border:0px solid red;width:300px;float:left;'>
<img src="images/paypal_cart.jpg" alt="" /><br />
			<!--<a href="#" onclick="open_creditcard();" ><br>
                       <b> Purchase through credit card.</b></a>--></div>{/if}
			{if $smarty.session.payment_type==0} 
			<div class="payPalLft"style='border:0px solid red;width:300px;float:left;' >
			<img src="images/paypal.gif" alt="" />
			<a href="paypal-for-item.php"  >
                        <b>Purchase through direct paypal.</b>
                        </a></div>{/if}
			
			{if $smarty.session.payment_type==1} 
			<!--<div class="payPalLft" ><img src="images/cc_avenue.gif" alt="" />
			
			<a href="#pay-item-cost-cc-avenue.php">Purchase through CC Aveneue</a></div>-->
                        {/if}
			<div class="payPalLft" style='border:0px solid red;width:200px;float:right;'>
                         <img src="images/gift_card.gif" alt="" /><br />
			{if $smarty.session.firstcardcode=='' || $smarty.session.secondcard_code==''}
                         <a href="javascript:void(0);" onclick="open_gift();">
                         <b>Purchase through gift card.</b></a>
                         {else}
                         You have total<span style='font-weight:bold;color:#6F4545;' >
                         ${$smarty.session.reciveramount_1_card+$smarty.session.reciveramount_2_card}
                         </span> in your's giftcard.
                         {/if}
                      </div>
			<div class="clear"></div>
			</div>
		       </div>	</td>
		</tr>
		</table>
		</td>
		</tr>
		<tr>
		<td style="vertical-align:top;padding-top:15px;">
		<div id="giftcard" style="display:none;border:1px solid #8A5F40;padding:15px;">
		<form action="" method="post" name="frmPaymentgigtcard">
			<table width="700" cellpadding="3" cellspacing="3" border="0" align="">
			{if $success !=""}
			<tr>
				<td colspan="2" style="font-weight:bold;font-size:12px; vertical-align:top;
				color:red;">
					{$success}
				</td>

			</tr>
			{/if}
			{if $error !=""}
			<tr>
				<td colspan="2" style="font-weight:bold;font-size:12px; vertical-align:top;color:red;">
					{$error}
				</td>

			</tr>
			{/if}
			<tr>
				<td width='600px;' style="font-weight:bold;font-size:12px;vertical-align:top;">
					Use your giftcard code to purchase the item.<br>
					Please fill credential.
				</td>
                                <td  style="font-weight:bold;font-size:12px;vertical-align:top;">
				<!--<a href='#' onclick='history.go(-1);'>Go Back</a>-->
                                </td>

			</tr>
			<tr>
				<td style="font-weight:bold;font-size:12px; vertical-align:top; ">
					Gift Card Code&nbsp;&nbsp; :&nbsp;&nbsp;<input type="text" name="cardcode" class="formInput required">
				</td>
				<td style="font-weight:bold;font-size:12px; vertical-align:top;">
					
				</td>
			</tr>
			<tr>
				<td style="font-weight:bold;font-size:13px; vertical-align:top;">
					<input type="HIDDEN" name="hidprice" value="{$price}">&nbsp;&nbsp;<input type="submit"  class='Class_Button_ris' name="giftsubmit" value="PURCHASE NOW">
				</td>
				<td style="font-weight:bold;font-size:13px; vertical-align:top;">
					
				</td>
			</tr>
			</table>
		</form>
		</div>
		<div id="giftcard1" style="display:none;border:1px solid #8A5F40;padding:15px;">
		<form action="" method="post" name="frmPaymentgigtcard">
			<table width="700" cellpadding="3" cellspacing="3" border="0" align="center">
			<tr>
				<td width="600" style="font-weight:bold;font-size:12px; vertical-align:top;">
					Use your second giftcard code to purchse item..<br>
					Please fill credential..
				</td>
<td style="font-weight:bold;font-size:12px; vertical-align:top;text-align:right;">
				<!--	<a herf='#' onclick="history.go(-1)">Go back</a>-->
				</td>

			</tr>
			<tr>
				<td style="font-weight:bold;font-size:12px; vertical-align:top;">
					Giftcard Code&nbsp;&nbsp; :&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="cardcode" class="formInput required">

				</td>
				<td style="font-weight:bold;font-size:13px; vertical-align:top;"></td>
			</tr>
			<tr>
				<td style="font-weight:bold;font-size:13px; vertical-align:top; ">
					<input type="hidden" name="hidprice" value="{$price}"><input type="submit" class='Class_Button_ris' name="giftsubmitagain" value="PURCHASE NOW">
				</td>
				<td style="font-weight:bold;font-size:13px; vertical-align:top;">					
				</td>
			</tr>
			</table>
		</form>
		</div>
		</td>
		</tr>

		<!--  /*************** Gift Card Success Block ***************/ -->

		<tr>
		<td style="vertical-align:top;padding-top:15px;">

		<!--  /*************** Start of Gift Card Success Block ***************/ -->
		<div id="giftcardsuccess" style="display:none;border:1px solid #8A5F40; padding:15px; ">
		<form action="" method="post" name="frmSubmitgiftcard">
			<table width="700" cellpadding="3" cellspacing="3" border="0" align="center">
		{if $plusecalculation!= "" || $plusecalculation=="0"}
                <tr>
		   <td colspan="2" style="text-align:left;font-size:12px;vertical-align:top;">
                    Note&nbsp;:&nbsp;<span style="text-align:left;font-size:12px;color:red;">
                    Click Done to complete the purchase process. </span> </td>
                  </tr>
                {else}
                 <tr>
		     <td colspan="2" style="text-align:left;font-size:12px;vertical-align:top;">
                      Note&nbsp;:&nbsp;<span style="text-align:left;font-size:12px;color:red;">
                      Purchase Incomplete giftcard amount is less than total order amount. </span> </td>
                  </tr>{/if}
                <tr>
		<td colspan="2" style="font-size:12px; vertical-align:top;">
		
		<!-- error start-->
             	<table width="100%" cellpadding="3" bgcolor='#EEEDE2' cellspacing="2" border="0" align="center">
	               <tr>
                        <td align='left' bgcolor='#EEEDE2' colspan='2'  class='classStorechkout' style='font-size:14px;' > Gift Certificate  Detail's </td>
                       </tr>
             
                        <tr bgcolor='#ffffff'>
                         <td align='left' width='250' > Receiver's Name </td>
                         <td align='left'>{$recivername|ucfirst}</td>
                        </tr>
                         <tr bgcolor='#ffffff'>
                           <td align='left'> Seller's Username  </td>
                            <td align='left'>{$merchant_user_name|ucfirst}</td>
                          </tr>

                          <tr bgcolor='#ffffff'>
                              <td align='left'>First Giftcard Amount  </td>
                              <td align='left'><b>{$reciveramount} {$CURRENCY}</b>.</td>
                          </tr>
	                  <tr bgcolor='#ffffff'>
                              <td align='left'> Total Order Amount   </td>
                              <td align='left'>
                {assign var= 'tot_cost' value=$smarty.session.show_d_cost_item*$smarty.session.sess_requested_quantity}
	      {assign var='all_finalcosts' value=$tot_cost+$smarty.session.service_rate*$smarty.session.sess_requested_quantity}&nbsp;{$all_finalcosts|convert_price}&nbsp;&nbsp;(USD {$all_finalcosts|convert_number})
            </td>
                          </tr>
                         <tr bgcolor='#ffffff'>
                          <td> {if $plusecalculation!= "" || $plusecalculation=="0"}Remaining Giftcard Amount. {else}Amount Need to Complete the purchase {/if}  </td>
                          <td>{if $plusecalculation!= "" || $plusecalculation=="0"}<b>{$plusecalculation} {$CURRENCY}</b>&nbsp; {if $plusecalculation!="0"} (You can use this giftcard amount to purchase another item.){/if}{else}<b>{$minusecalculation} {$CURRENCY}</b>{/if}</td>
                          </tr>
                          <tr bgcolor='#ffffff'>
                          <td> {if $plusecalculation!= "" || $plusecalculation=="0"}&nbsp;
                              {else}Payment Options {/if}  </td>
                          <td>
                          {if $plusecalculation!= "" || $plusecalculation=="0"}&nbsp;
                          <b>{*$plusecalculation*} {*$CURRENCY*}</b>{else} <B>
			  <a href="javascript:void(0);" onclick="open_gift_second();">GIFT CARD </a></B>
			  or by 
                <!-- <a href="javascript:void(0);" onclick="open_creditcard();"><B>CREDIT CARD</B> </a> or-->
                          <a href="paypal-for-item.php">Direct Paypal</a><br>
                       
                          {/if}</td>
                          </tr>

                    <tr bgcolor='#ffffff'  >
                    <td colspan=2>									
					
					<b>Enjoy shopping .. !!!</b>
					<input type="hidden" name="firstgiftcardamount" value="{$plusecalculation}"> 
					 <input type='hidden' value='{$smarty.request.item_id}' name='item_id'>
                    <input type='hidden' value='{$smarty.request.seller_id}' name='seller_id'>
                  <input type='hidden' value='{$smarty.session.calculategiftcardvalue}' name='gift_card1'>
                
					<input type="hidden" name="giftcardnumber" value="{$smarty.session.firstcardcode}">
					<input type="hidden" name="amount" value="{*$smarty.session.d_cost_item*}{$price}">
					<input type="hidden" name="paymentmode" value="giftcard"></td></tr>
</table>
				<!-- error end -->
				</td>	</tr>	{if $plusecalculation!= "" || $plusecalculation=="0"}
				<tr  id='pulse_calc_row_id' >
				<td colspan="2" style="font-size:13px; vertical-align:top;color:green; padding-top:15px;">
				<b><!--If you all set to purchase this item.-->If you are ready to purchase this item.Please press </b> &nbsp;&nbsp;&nbsp;
				<input type="submit" value="DONE" class='Class_Button_ris' name="firstsuccesssubmit">&nbsp;&nbsp;&nbsp;
                                 <b> If not </b> &nbsp;&nbsp;&nbsp;
				<input type="submit" value="CANCEL" class='Class_Button_ris' name="cancel">
				</td>
				

			

			</tr>
			{/if}
			
			</table>
			</form>
		</div>
		<!--  *************** end of Gift Card Success Block *************** -->
		<!--  *************** Gift Card Success2 Block *************** -->
		<div id="giftcardsuccess2" style="display:none; border:1px solid #8A5F40;padding:15px; ">
		<form action="" method="post" name="frmCancelgiftcard">
		<table width="700" cellpadding="3" cellspacing="3" border="0" >
		{if $plusecalculation!= "" || $plusecalculation=="0"}
                 <tr>
		 <td colspan="2" style="text-align:left;font-size:12px;vertical-align:top;">
                  Note&nbsp;:&nbsp;<span style="text-align:left;font-size:12px;color:red;">
                  Click Done to complete the purchase process.</span> </td>
                  </tr>
                {else}
                 <tr>
		<td colspan="2" style="text-align:left;font-size:12px;vertical-align:top;">
                Note&nbsp;:&nbsp;
                <span style="text-align:left;font-size:12px;color:red;">
                Purchase Incomplete giftcard amount is less than total order amount.</span> </td>
                 </tr>{/if}
                      <tr>

		 <td colspan="2" style="font-size:12px; vertical-align:top;">
              	<table width="100%" cellpadding="3" bgcolor='#EEEDE2' cellspacing="2" border="0" align="center">
	              <tr>
                         <td align='left' bgcolor='#EEEDE2' colspan='2'  class='classStorechkout' style='font-size:14px;' > Gift Certificate Detail's </td>
                         </tr>                      
                        <tr bgcolor='#ffffff'>
                          <td  align='left' width='250' > Receiver's Name </td>
                          <td align='left'>{$recivername|ucfirst}</td>
                        </tr>
                         
                        <tr bgcolor='#ffffff'>
                              <td align='left'> Seller's Username  </td>
                              <td align='left'>{$merchant_user_name|ucfirst}</td>
                         </tr>

                         <tr bgcolor='#ffffff'>
                              <td align='left'>Second Giftcard Amount</td>
                         <td align='left'><b>{$reciveramount} {$CURRENCY}</b>.</td>
                         </tr>
	                 <tr bgcolor='#ffffff'>
                              <td align='left'> Total Order Amount</td>
                              <td align='left'>
                        {assign var= 'tot_cost' value=$smarty.session.show_d_cost_item*$smarty.session.sess_requested_quantity}
	                {assign var='all_finalcosts' value=$tot_cost+$smarty.session.service_rate*$smarty.session.sess_requested_quantity}&nbsp;{$all_finalcosts|convert_price}&nbsp;&nbsp;(USD {$all_finalcosts|convert_number})
                              </td>
                          </tr>
                          <tr bgcolor='#ffffff'>
                              <td> {if $plusecalculation!= "" || $plusecalculation=="0"}
                               Remaining Giftcard Amount.                          
                               {else}
                               Amount Need to Complete the purchase.
                               {/if}  </td>
                               <td>{if $plusecalculation!= "" || $plusecalculation=="0"}
                               <b>{$plusecalculation} {$CURRENCY}</b> &nbsp;&nbsp;
                                {if $plusecalculation!="0"}
                                (You can use this giftcard to purchase another item.)
                                {/if}
                                 {else}
                              <b>{$minusecalculation|trim:'-'} {$CURRENCY}</b>
                               {/if}</td>
                          </tr>
                          <tr bgcolor='#ffffff'>
                          <td> {if $plusecalculation!= "" || $plusecalculation=="0"}
                               {else}
                               Payment Options {/if}  </td>
                          <td>
                          {if $plusecalculation!= "" || $plusecalculation=="0"}
                          <b>{*$plusecalculation*} {*$CURRENCY*}</b> &nbsp;{else} <B>
						  			 {if $smarty.session.payment_type==0}
                         <a href="paypal-for-item.php">Direct Paypal</a><br>
                          				{/if}
                          {/if}</td>
                          </tr>

                         <tr bgcolor='#ffffff'><td colspan=2><b>Enjoy shopping .. !!!</b>
				
<!--<a href="javascript:void(0);" onclick="open_creditcard();">
                                        <B>CREDIT CARD</B> </a>
			  or by  -->


</td></tr>
</table>



				
					
					<input type="hidden" name="firstgiftcardamount" value="{$plusecalculation}">

					<input type="hidden" name="firstcardcode" value="{$smarty.session.firstcardcode}">

					<input type="hidden" name="giftcardnumber" value="{$giftcardnumber}">

					<input type="hidden" name="item_id" value="{$item_id}">

					<input type="hidden" name="seller_id" value="{$seller_id}">

					<input type="hidden" name="amount" value="{$price}">

					<input type="hidden" name="paymentmode" value="giftcard">
				</td></tr>
				{if $plusecalculation != "" || $plusecalculation=="0"}
				<tr  >
				<td colspan="2" style="font-size:13px; vertical-align:top;color:green; padding-top:15px;">
				<b>If you all set to purchase this item.. Please press </b> &nbsp;&nbsp;&nbsp;
                                <input type="submit" value="DONE" class='Class_Button_ris' name="submitsecondtimesuccess">&nbsp;&nbsp;&nbsp;<b> If not </b> &nbsp;&nbsp;&nbsp;<input type="submit" value="CANCEL" class='Class_Button_ris' name="cancel">
				</td>
				

			</tr>
			{/if}
			
			</table>
			</form>
		</div>
		<!--  *************** Gift Card Success2 Block *************** -->
		</td>
		</tr>
		<!--  *************** Gift Card Success Block *************** -->

		<tr>
		<td style="vertical-align:top;">
		<div id="creditcard" style="display:none;border:1px solid #8A5F40;padding:15px;">
			<table width="700" cellpadding="3" cellspacing="3" border="0" align="center">
			<tr>
				<td style="font-weight:bold;font-size:14px; vertical-align:top;">
					Hello your card information is success..
				</td>
			</tr>
			</table>
		</div>
		</td>
		</tr>
		</table>
		</div>
		<div class="myItemtopbg">
			
			<!--start page number -->
			<div class="bradcrum" style="padding:0px;">
			
			</div>
			<!--end page number -->
			<div class="clear"></div>
		</div>
	</div>	
	<!--End my items -->
</div>





</div><div style='font-size:11px;color:red;'><table width="100%" border="0" cellpadding="2" cellspacing="0"
title="Click to Verify - This site chose VeriSign SSL for secure
e-commerce and confidential communications.">
<tr>
<td width="135" align="center" valign="top"><script
type="text/javascript"
src="https://seal.verisign.com/getseal?host_name=www.nethaat.com&amp;size=L&
amp;use_flash=YES&amp;use_transparent=YES&amp;lang=en"></script><br
/>
<a href="http://www.verisign.com/ssl-certificate/" target="_blank"
style="color:#000000; text-decoration:none; font:bold 7px
verdana,sans-serif; letter-spacing:.5px; text-align:center;
margin:0px; padding:0px;">ABOUT SSL CERTIFICATES</a></td>
</tr>
</table>
</div>
<!--</div>-->
<div class="clear"></div>
</div>
<!--End Middle-->
{include file="footer.tpl"}
{if $onload && $onload!=""}
<script language="javascript" type="text/javascript">
{$onload}
</script>
{/if}