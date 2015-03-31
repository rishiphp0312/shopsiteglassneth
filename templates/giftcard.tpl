{include file="header.tpl"}
{include file="header_search.tpl"}
<!--Start Middle-->
<div id="middleMain">
{include file="js_css_validation.tpl"}

{*include file="left_category.tpl"*}
{literal}
<script language="javascript">

function paypal_login()
{
//alert("sssssss");
/*
var frm_name = 'frmGiftcard';

var NAME_VAL=document.getElementById('name').value;
var EMAIL_VAL=document.getElementById('email').value;
var CITY_VAL=document.getElementById('city').value;
var STATE_VAL=document.getElementById('name').value;
var country_value=document.getElementById('country_value').value;
var seller_id=document.getElementById('seller_id').value;
var buyer_id=document.getElementById('buyer_id').value;
var str=NAME_VAL+'|#-#|'+EMAIL_VAL+'|#-#|'+CITY_VAL;
var str1=STATE_VAL+'|#-#|'+country_value;
var custom_var= str+'|#-#|'+str1+'|#-#|'+buyer_id;
document.getElementById('custom').value=str+'|#-#|'+str1+'|#-#|'+buyer_id;
alert('seller_id'+document.getElementById('seller_id').value);
var amount_val =document.getElementById('amount').value
//document.frmGiftcard.submit();

//window.location.href= 'giftcardpayment2.php?custom='+custom_var+'&amount='+amount_val+'&seller_id='+seller_id;
*/
document.frmGiftcard.action= 'giftcardpayment2.php';
document.frmGiftcard.submit;

}

</script>
{/literal}
<!--<div id="middleRtMain">-->
<div>
<!--Start Tab Link-->


<div class="shopmain">
<span class="mainHD">Gift card</span>
	<!--Start my items -->
	<div class="myitemmain">
		<div class="myItemtopbg">
			<div class="clear"></div>
		</div>
		
		<div class="myiteminsidemain">
		<table width="100%" cellpadding="3" cellspacing="1" border="0" >
		<tr><td colspan='2' style="border:0px solid #8A5F40;color:#8A5F40;font-family:arial;text-align:left;font-weight:700;font-size:13px;">You can send a gift card to any one, anywhere.. please select your criteria.!! </td></tr>
		<tr>
		<tr><td colspan='2' style="color:red;text-align:left;">* Required</td></tr>
		<tr>
		<td style="vertical-align:top;">
		<form name="frmGiftcard" id="frmGiftcard" method="post" action="giftcard.php">
		<table width="530" cellpadding="3" cellspacing="0" border="0" align="left" >
		<tr>
		<td colspan="3">{include file="error_msg_template.tpl"}		</td>
		</tr>
		<tr>
			<td width="162" nowrap style="padding-left:15px;font-weight:bold; font-size:13px;vertical-align:top;width:150px;">
				Reciever Name<span style="color:red;">*</span>			</td>
			<td colspan="2"  style="font-weight:bold;font-size:13px; vertical-align:top;">
				<input type="text" name="name" id="name" class="formInput required">			</td>
		</tr>
		<tr>
			<td nowrap style="font-weight:bold;font-size:13px; vertical-align:top;width:150px;padding-left:15px;">
				Reciever Email <span style="color:red;">*</span>			</td>
			<td colspan="2"  style="font-weight:bold;font-size:13px; vertical-align:top;">
				<input type="text" name="email" id='email' class="required email formInput">			</td>
		</tr>
		<tr>
			<td nowrap style="font-weight:bold;font-size:13px; vertical-align:top; width:150px;padding-left:15px;">
				Amount<span style="color:red;">*</span>			</td>
			<td colspan="2"  style="font-weight:bold;font-size:13px; vertical-align:top;">
				<input type="text" name="amount" id='amount'  class="formInput required alph_num"><b> {$CURRENCY}</b>			</td>
		</tr>
		<tr>
			<td nowrap colspan="3" style="font-weight:bold; font-size:13px;vertical-align:top;width:150px;padding-left:15px;padding-top:5px;">
				Reciever Address			</td>
		</tr>
		
		<tr>
			<td nowrap style="font-weight:bold;font-size:13px;vertical-align:top;width:150px;padding-left:15px;">
				Reciever City<span style="color:red;">*</span>			</td>
			<td colspan="2"  style="font-weight:bold;font-size:13px; vertical-align:top;">
				<input type="text" name="city" id='city'  class="formInput required">
				<input type="hidden" id='seller_id'  value="{$sellersid_for_giftcard}"
				 name="seller_id" />	<input type="hidden" id='buyer_id'  value="{$smarty.session.session_user_id}" name="buyer_id" />			</td>
		</tr>
		<tr>
			<td nowrap style="font-weight:bold;font-size:13px;vertical-align:top;width:150px;padding-left:15px;">
				Reciever State <span style="color:red;">*</span>			</td>
			<td colspan="2" style="font-weight:bold;font-size:13px; vertical-align:top;">
				<input type="text" name="state" id='state' class="formInput required alph_num">			</td>
		</tr>
		<tr>
			<td nowrap style="font-weight:bold;font-size:13px;vertical-align:top;width:150px;padding-left:15px;">
				Reciever Country <span style="color:red;">*</span>			</td>
			<td colspan="2" style="font-weight:bold;font-size:13px; vertical-align:top;">
		<select class="formSel" name="country_value"  id="country_value">
				{html_options values=$countryID output=$countryName selected=$country_value}
		</select>			</td>
		</tr>
		<tr>
			<td nowrap>			</td>
			<td width="189" align="left" valign="top" style="font-weight:bold;font-size:13px; vertical-align:top;">
				<input type="submit" name="submit" value="BUY"  class="btn">			</td>
		    <td width="153" align="left" valign="top" style="font-weight:bold;font-size:13px; vertical-align:top;"></td>
		</tr>
		</table>
		</form>
		</td>
                   <td>
                    &nbsp;                
<img src="{$baseUrl}images/giftcard_img.jpg">

                   </td>
		
		</tr>
		<tr>
		<td colspan='2' >&nbsp;
		</td></tr>
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





</div>
<!--</div>-->
<div class="clear"></div>
</div>
<!--End Middle-->
{include file="footer.tpl"}