{include file="header.tpl"}
{include file="header_search.tpl"}
{include file="js_css_validation.tpl"}
{literal}
<script language="JavaScript">
	function generateCC(){
		var cc_number = new Array(16);
		var cc_len = 16;
		var start = 0;
		var rand_number = Math.random();

		switch(document.frmpayment.creditCardType.value)
        {
			case "Visa":
				cc_number[start++] = 4;
				break;
			case "Discover":
				cc_number[start++] = 6;
				cc_number[start++] = 0;
				cc_number[start++] = 1;
				cc_number[start++] = 1;
				break;
			case "MasterCard":
				cc_number[start++] = 5;
				cc_number[start++] = Math.floor(Math.random() * 5) + 1;
				break;
			case "Amex":
				cc_number[start++] = 3;
				cc_number[start++] = Math.round(Math.random()) ? 7 : 4 ;
				cc_len = 15;
				break;
        }

        for (var i = start; i < (cc_len - 1); i++) {
			cc_number[i] = Math.floor(Math.random() * 10);
        }

		var sum = 0;
		for (var j = 0; j < (cc_len - 1); j++) {
			var digit = cc_number[j];
			if ((j & 1) == (cc_len & 1)) digit *= 2;
			if (digit > 9) digit -= 9;
			sum += digit;
		}

		var check_digit = new Array(0, 9, 8, 7, 6, 5, 4, 3, 2, 1);
		cc_number[cc_len - 1] = check_digit[sum % 10];

		document.frmpayment.creditCardNumber.value = "";
		for (var k = 0; k < cc_len; k++) {
			document.frmpayment.creditCardNumber.value += cc_number[k];
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
<span class="mainHD" style='padding-left:3px;'>Advance Payment and agreement</span>
	        <div style='width:800px;float:left;text-align:right;'>
	        <a href='#' onclick='history.go(-1)'>Go Back</a>
	        </div>
	<!--Start my items -->
	        <div class="myitemmain">
		<div class="myItemtopbg">
			<div class="clear"></div>
		</div>
		
		<div class="myiteminsidemain">
		<table width="100%" cellpadding="0" cellspacing="3" border="0" >
		<tr>
		<td  style="font-weight:normal;font-size:13px;vertical-align:top;">
	        <b>Dear -</b> {$f_name} {$l_name}, {*$username*}
		</td>
		</tr>
		<tr>
		<td  style="padding:5px;font-weight:normal;font-size:12px;vertical-align:top;">
		As per your discussions and agreement with <b>{$title}</b> ,You 
		have requested for the custom item whose unit cost is *<b>{$price}  {$CURRENCY}</b>*.
                <br>Accordingly , you have to pay {$advancepersantage}% of item cost in advance to seller.<br>
                So your's advance money is *<b>{$adAmount*$cust_quantity} {$CURRENCY}</b>*.
                <!--(THIS AMOUNT CHANGES <br>AS THE PERCENTAGE CHANGES,IF WE CHANGE THE PERCENTAGE
                TO 100% THE AMOUNT WOULD<br>CHANGE AUTOMATICALLY TO @)( AND SO ON))<br>-->
                Please provide further details to pay.<br></td>
		</tr>
		<tr>
		<td style="vertical-align:top;border:0px solid red;" align="left">
		<form action="{$PAYPAL_URL}"  method="post" name="frmpayment_standard" id="frmpayment_standard">
		<table width="97%" cellpadding="3" cellspacing="3" border="0"  align="center" >
		<tr><td><input type="hidden" name="redirect_cmd" value="_xclick" />
	         <input type="hidden" name="cmd" value="_ext-enter" />
	         <input type="hidden" name="business" value="{$paypal_merchant_id}" />
	         <input type="hidden" name="item_name" value="Custom Item request">
	         <input type="hidden" name="no_shipping" value="0" />
	         <input type="hidden"  name="amount"	value="{$adAmount*$cust_quantity}"  />
	         <input type="hidden" name="return" value="{$baseUrl}my_account.php" />
	         <input type="hidden" name="cancel_return" value="{$baseUrl}api_error1.php" />
	         <input type="hidden" name="no_note" value="1" />
	         <input type="hidden" name="currency_code" value="USD" />
	         <input type="hidden" name="notify_url" value="{$baseUrl}notify_request_custom.php" />
	         <input type="hidden" name="custom" value="{$custom_variable}" />
	         <input type="hidden" name="flag" value="yes">
		 </td>
		</tr>
		<tr>
                <td align="left" valign="top"><img src="images/paypal.gif" alt="" />
                &nbsp;&nbsp;&nbsp;
	<input type="submit" name="pay_advance" value="Pay advance" class='Class_Button_ris' />
                </td>
		</tr>
		</table>
		</form></td></tr>
		<!--<tr>
		<td style="vertical-align:top;">
		<form action="DoDirectPaymentReceipt.php" method="post" name="frmpayment" id="frmpayment">
		<table width="630" cellpadding="3" celspacing="3" border="0"  >
		<tr><td colspan="2">
		<input type=hidden name=paymentType value="Sale" />
		<input type=hidden name=id value="{$id}" />
		<input type=hidden name=buyid value="{$buyid}" />
		{include file='error_msg_template.tpl'}
		</td>
		<td style="color:red;">*required</td>
		</tr>
		 <tr>
		<td  colspan="3" style="padding-left:2px;font-weight:bold; font-size:14px; vertical-align:top;" > Please fill the information</td>
		</tr>
		<tr>
		<td style="padding-left:25px;width:200px;">First Name<span style="color:red;" >*</span></td>
		<td ><input type="text" maxlength=32 name="firstName" class="formInput required alph_num" ></td>
		<td></td>
		</tr>
		<tr>
		<td style="padding-left:25px;width:200px;">Last Name <span style="color:red;" >*</span></td>
		<td ><input type="text" maxlength=32 name="lastName" class="formInput required alph_num" ></td>
		<td></td>
		</tr>
		<tr>
		<td style="padding-left:25px;width:200px;" >
		Card type :<span style="color:red;">*</span>
		</td>
		<td >
		<select name="creditCardType" onChange="javascript:generateCC(); return false;">
		<option value=Visa selected>Visa</option>
		<option value=MasterCard>MasterCard</option>
		<option value=Discover>Discover</option>
		<option value=Amex>American Express</option>
		</select>
		</td>
		<td></td>
		</tr>
		<tr>
		<td style="padding-left:25px;width:200px;">Credit Card Number<span style="color:red;" >*</span></td>
		<td ><input type="text" maxlength=19 name="creditCardNumber" class="formInput required alph_num" ></td>
		<td></td>
		</tr>
		<tr>
		<td style="padding-left:25px;width:200px;">Expiration Date:<span style="color:red;">*</span></td>
		<td >
		<select name=expDateMonth>
		<option value=1>01</option>
		<option value=2>02</option>
		<option value=3>03</option>
		<option value=4>04</option>
		<option value=5>05</option>
		<option value=6>06</option>
		<option value=7>07</option>
		<option value=8>08</option>
		<option value=9>09</option>
		<option value=10>10</option>
		<option value=11>11</option>
		<option value=12>12</option>
		</select>
		<select name=expDateYear>
		<option value=2005>2005</option>
		<option value=2006>2006</option>
		<option value=2007>2007</option>
		<option value=2008>2008</option>
		<option value=2009>2009</option>
		<option value=2010 selected>2010</option>
		<option value=2011>2011</option>
		<option value=2012>2012</option>
		<option value=2013>2013</option>
		<option value=2014>2014</option>
		<option value=2015>2015</option>
		</select>
		</td>
		<td></td>
		</tr>
		<tr>
		<td style="padding-left:25px;width:200px;">Card Verification Number:<span style="color:red;">*</span></td>
		<td><input type=text size=3 maxlength=4 name="cvv2Number"  value="{$cvv2Number}" class="formInput required alph_num"  /></td>
		<td></td>
		</tr>
		<tr>
		<td colspan="2" style="padding-left:25px;width:200px;font-weight:bold;">Billing Address:</td>
		<td></td>
		</tr>
		<tr>
		<td style="padding-left:25px;width:200px;">Address 1:<span style="color:red;">*</span></td>
		<td>
		<input type="text" maxlength=100 name="address1" value="{$address1}" class="formInput required alph_num" >
		</td>
		<td></td>
		</tr>
		<tr>
		<td style="padding-left:25px;width:200px;">Address 2:<span style="color:red;"></span></td>
		<td>
		<input type="text" maxlength=100 name="address2" value="{$address2}" class="formInput" >
		</td>
		<td>(optional)</td>
		</tr>
		<tr>
		<td style="padding-left:25px;width:200px;">City:<span style="color:red;">*</span></td>
		<td>
		<input type="text" name="city" value="{$city}" class="formInput required alph_num" maxlength="30">
		</td>
		<td></td>
		</tr>
		<tr>
		<td style="padding-left:25px;width:200px;">State:<span style="color:red;">*</span></td>
		<td>
		<input type="text" name="state" id="state" value="{$state}" class="formInput required alph_num" maxlength="30">
		</td>
		<td></td>
		</tr>
		<tr>
		<td style="padding-left:25px;width:200px;">Country:<span style="color:red;"></span></td>
		<td>
		<select name="country" id="country" class="formSel">
		{html_options values=$countryID output=$countryName selected=$country_value}
		</select>
		</td>
		<td></td>
		</tr>
		<tr>
		<td style="padding-left:25px;width:200px;">Zip:<span style="color:red;">*</span></td>
		<td><input maxlength=10 name="zip" value="{$zip}" class="formInput required alph_num"  /></td>
		<td width="50" nowrap>(5 or 9 digit)</td>
		</tr>
		<tr>
		<td style="padding-left:25px;width:200px;">Amount:<span style="color:red;"></span></td>
		<td><input maxlength=7 name="amount" value="{$adAmount}" class="formInput" readonly />{$CURRENCY}</td>
		<td>&nbsp;</td>
		</tr>
          	<tr>
		<td style="padding-left:25px;width:200px;"></td>
		<td valign='top' align='left'style='padding-top:5px;'  >
		<input type="submit" name="submit" value="SUBMIT"  />&nbsp;&nbsp;&nbsp;<img src='images/paypal_cart.jpg'>
		</td><td>&nbsp;</td>
		</tr>-->
                <!--<tr><td colspan="3" align="right" style="padding-right:100px; color:#027eb2;">
                <input name="terms" type="checkbox" value="Y" /> You agree to the terms and conditions for nethaat.</td>
		</tr>-->
               <!--<tr>
		<td style="padding-left:25px;width:200px;">CVC on Back:<span style="color:red;">*</span></td>
		<td>
		<input name="v_cc_cvc" id="v_cc_cvc" type="text" value="{$v_cc_cvc}" class="formInput required alph_num" maxlength="30" />
		</td>
		<td></td>
		</tr>-->
		</table>
		</form>
		</td></tr>
		</table></div>
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