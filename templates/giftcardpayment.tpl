{include file="header.tpl"}
{include file="header_search.tpl"}
<!--Start Middle-->
<div id="middleMain">
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
{*include file="left_category.tpl"*}
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
		<table width="100%" cellpadding="3" cellspacing="3" border="0" >
		
			<tr><td align="left" valign="top" style="border:0px solid #8A5F40;">
			<form action="" method="post" name="Pay_order_new">
			<table align="left" cellpadding="0" cellspacing="0" border="0">
			<tr><td valign="top" align="left">&nbsp;<b>Total Amount&nbsp;&nbsp;{$smarty.session.giftcardreciveramount}&nbsp;USD</b></td></tr>
	               	<tr><td valign="top" align="left">&nbsp;</td></tr>

                        <tr><td align="left" >
                        <img src="images/paypal.gif" alt="" />
                        <input type='hidden' value='{$smarty.session.giftcard_seller_id}' name='seller_id'> &nbsp;
                        <input type="submit" name="purchase_now" value="PURCHASE NOW"  class='Class_Button_ris' />&nbsp;
                       &nbsp;(Click here to pay on paypal site.)</td></tr>
		   </table>
	         </form>
	        </td>
                </tr>
		<tr>
		<td style="vertical-align:top;">
		<form action="giftcardpayment.php" method="post" name="frmpayment" id="frmpayment">
	<!--	<table width="700" cellpadding="3" cellspacing="2" border="0"  >
		<tr>
			<td colspan="2">
				<input type=hidden name=paymentType value="Sale" />
				<input type=hidden name=id value="{$id}" />
				<input type=hidden name=buyid value="{$buyid}" />
					{include file='error_msg_template.tpl'}
			</td>
			<td valign='top' align='right' >&nbsp;</td>
		</tr>
		<tr>
			<td  colspan="2" style="padding-left:2px;font-weight:bold; font-size:14px;
			vertical-align:top;" > Please fill the information</td><td align='right' style="color:red;">*required
</td>
		</tr>
		<tr>
			<td style="padding-left:25px;width:200px;">First Name<span style="color:red;" >*</span></td>
			<td >
			<input type="text" maxlength=32 name="firstName" class="formInput required alph_num" >
			</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td style="padding-left:25px;width:200px;">Last Name <span style="color:red;" >*</span></td>
			<td >
			<input type="text" maxlength=32 name="lastName" class="formInput required alph_num" ></td>
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
			<td >
			<input type="text" maxlength=19 name="creditCardNumber" class="formInput required alph_num" >
			</td>
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
			<td>
			<input type=text size=3 maxlength=4 name="cvv2Number"  value="{$cvv2Number}" 
			class="formInput required alph_num"  />
			</td>
			<td></td>
		</tr>
			<tr>
			<td colspan="2" style="padding-left:25px;width:200px;font-weight:bold;">Billing Address:</td>
			
			<td></td>
		</tr>
		<tr>
			<td style="padding-left:25px;width:200px;">Address 1:<span style="color:red;">*</span></td>
			<td>
				<input type="text" maxlength=100 name="address1" 
				value="{$address1}" class="formInput required  alph_num_space" >
			</td>
			<td></td>
		</tr>
		<tr>
			<td style="padding-left:25px;width:200px;">Address 2:<span style="color:red;"></span></td>
			<td>
				<input type="text" maxlength=100 name="address2" value="{$address2}" class="formInput required  alph_num_space" >
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
			<td>
			<input maxlength=10 name="zip" value="{$zip}" class="input required alph_num"  /></td>
			<td width="50" nowrap>(5 or 9 digit)</td>
		</tr>
		<tr>
			<td style="padding-left:25px;width:200px;">Amount:<span style="color:red;"></span></td>
			<td><input maxlength=7 name="amount" 
	value="{$smarty.session.giftcardreciveramount}" class="formInput" readonly /><b>{$CURRENCY}</b></td>
			<td>&nbsp;</td>
		</tr>

		
		<tr>
			<td style="padding-left:25px;width:200px;"></td>
			<td valign='top' colspan='2' align='left' >
<input type="submit" name="submit" value="PURCHASE NOW"  class='Class_Button_ris' />&nbsp;&nbsp;&nbsp;
<img src='images/paypal_cart.jpg' >
				
			</td>
			
		</tr>
<tr>
<td colspan='3' valign='top' align='left' ><table width="100%" border="0" cellpadding="2" cellspacing="0"align="right"
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
</table></td></tr>
		</table>-->
		</form>
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





</div>
<!--</div>-->
<div class="clear"></div>
</div>
<!--End Middle-->
{include file="footer.tpl"}