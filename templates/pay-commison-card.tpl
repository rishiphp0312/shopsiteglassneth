
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
<span class="mainHD">Buy you Item</span>
	<!--Start my items -->
	<div class="myitemmain">
		<div class="myItemtopbg">
			<div class="clear"></div>
		</div>

		<div class="myiteminsidemain">
		<table width="100%" cellpadding="3" celspacing="3" border="0" >
		<!--<tr>
		<td style="border:1px solid #8A5F40;">You can send a gift card to any one, anywhere.
		. please fill your account detail.!! </td></tr>-->

		<tr>
		<td style="vertical-align:top;">
		<form action="" method="post" name="frmpayment" id="frmpayment">
		<table width="630" cellpadding="3" celspacing="3" border="0"  >
		<tr>
			<td colspan="1">
				<input type=hidden name=paymentType value="Sale" />
				<input type=hidden name=id value="{$id}" />
				<input type=hidden name=buyid value="{$buyid}" />
					{include file='error_msg_template.tpl'}			</td>
			<td style="color:red;">*required</td>
			<td  ><a href="#" onclick="history.go(-1);" >Go Back</a></td>
		</tr>
		<tr>
			<td align="left" valign="top" style="padding-left:2px;font-weight:bold; font-size:14px; vertical-align:top;" > Please fill the information</td>
		    <td  colspan="2" align="right" valign="top" style="padding-left:2px;font-weight:bold; font-size:14px; vertical-align:top;" >
			<!--<a href="pay-item-costsecond.php">Pay into Paypal</a>-->
			</td>
		    </tr>
		<tr align="left" valign="top">
			<td style="padding-left:25px;width:200px;">First Name<span style="color:red;" >*</span></td>
			<td ><input type="text" maxlength=32 name="firstName"  value='{$user_values.first_name}' class="formInput required alph_num" ></td>
			<td></td>
		</tr>
		<tr align="left" valign="top">
			<td style="padding-left:25px;width:200px;">Last Name <span style="color:red;" >*</span></td>
			<td ><input type="text" maxlength=32 name="lastName" class="formInput required alph_num" value='{$user_values.last_name}' ></td>
			<td></td>
		</tr>
		<tr align="left" valign="top">
			<td style="padding-left:25px;width:200px;" >
				Card type :<span style="color:red;">*</span>			</td>
			<td >
			<select name="creditCardType" onChange="javascript:generateCC(); return false;">
				<option value=Visa selected>Visa</option>
				<option value=MasterCard>MasterCard</option>
				<option value=Discover>Discover</option>
				<option value=Amex>American Express</option>
			</select>			</td>
			<td></td>
		</tr>
		<tr align="left" valign="top">
			<td style="padding-left:25px;width:200px;">Credit Card Number<span style="color:red;" >*</span></td>
			<td ><input type="text" maxlength=19 name="creditCardNumber" class="formInput required alph_num"  ></td>
			<td></td>
		</tr>
		<tr align="left" valign="top">
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
			{foreach from=$show_exp_year item=exp_date }
				<option value={$exp_date}>{$exp_date}</option>
				{/foreach}
			</select></td>
			<td></td>
		</tr>
		<tr align="left" valign="top">
			<td style="padding-left:25px;width:200px;">Card Verification Number:<span style="color:red;">*</span></td>
			<td><input type=text size=3 maxlength=4 name="cvv2Number"  value="{$cvv2Number}"
			class="formInput required alph_num"  /></td>
			<td></td>
		</tr>
		<!--<tr>
			<td style="padding-left:25px;width:200px;">CVC on Back:<span style="color:red;">*</span></td>
			<td>
				<input name="v_cc_cvc" id="v_cc_cvc" type="text"
				value="{$v_cc_cvc}" class="formInput required alph_num" maxlength="30" />
			</td>
			<td></td>
		</tr>-->
		<tr>
			<td colspan="2" align="left" valign="top" style="padding-left:25px;width:200px;font-weight:bold;">Billing Address:</td>

			<td align="left" valign="top"></td>
		</tr>
		<tr>
			<td align="left" valign="top" style="padding-left:25px;width:200px;">Address 1:<span style="color:red;">*</span></td>
			<td align="left" valign="top">
				<input type="text" maxlength=100 name="address1"
				value="{$user_values.address1}" class="formInput required alph_num" ></td>
			<td align="left" valign="top"></td>
		</tr>
		<tr>
			<td align="left" valign="top" style="padding-left:25px;width:200px;">Address 2:<span style="color:red;"></span></td>
			<td align="left" valign="top">
				<input type="text" maxlength=100 name="address2" value="{$user_values.address2}" class="formInput" >			</td>
			<td align="left" valign="top">(optional)</td>
		</tr>
		<tr align="left" valign="top">
			<td style="padding-left:25px;width:200px;">City:<span style="color:red;">*</span></td>
			<td>
				<input type="text" name="city"  value="{$user_values.city}" class="formInput required alph_num" maxlength="30">			</td>
			<td></td>
		</tr>
		<tr align="left" valign="top">
			<td style="padding-left:25px;width:200px;">State:<span style="color:red;">*</span></td>
			<!--<td>
				<select id=state name=state>
				<option value=></option>
				<option value=AK>AK</option>
				<option value=AL>AL</option>
				<option value=AR>AR</option>
				<option value=AZ>AZ</option>
				<option value=CA selected>CA</option>
				<option value=CO>CO</option>
				<option value=CT>CT</option>
				<option value=DC>DC</option>
				<option value=DE>DE</option>
				<option value=FL>FL</option>
				<option value=GA>GA</option>
				<option value=HI>HI</option>
				<option value=IA>IA</option>
				<option value=ID>ID</option>
				<option value=IL>IL</option>
				<option value=IN>IN</option>
				<option value=KS>KS</option>
				<option value=KY>KY</option>
				<option value=LA>LA</option>
				<option value=MA>MA</option>
				<option value=MD>MD</option>
				<option value=ME>ME</option>
				<option value=MI>MI</option>
				<option value=MN>MN</option>
				<option value=MO>MO</option>
				<option value=MS>MS</option>
				<option value=MT>MT</option>
				<option value=NC>NC</option>
				<option value=ND>ND</option>
				<option value=NE>NE</option>
				<option value=NH>NH</option>
				<option value=NJ>NJ</option>
				<option value=NM>NM</option>
				<option value=NV>NV</option>
				<option value=NY>NY</option>
				<option value=OH>OH</option>
				<option value=OK>OK</option>
				<option value=OR>OR</option>
				<option value=PA>PA</option>
				<option value=RI>RI</option>
				<option value=SC>SC</option>
				<option value=SD>SD</option>
				<option value=TN>TN</option>
				<option value=TX>TX</option>
				<option value=UT>UT</option>
				<option value=VA>VA</option>
				<option value=VT>VT</option>
				<option value=WA>WA</option>
				<option value=WI>WI</option>
				<option value=WV>WV</option>
				<option value=WY>WY</option>
				<option value=AA>AA</option>
				<option value=AE>AE</option>
				<option value=AP>AP</option>
				<option value=AS>AS</option>
				<option value=FM>FM</option>
				<option value=GU>GU</option>
				<option value=MH>MH</option>
				<option value=MP>MP</option>
				<option value=PR>PR</option>
				<option value=PW>PW</option>
				<option value=VI>VI</option>
			</select>
			</td>-->
			<td>
				<input type="text" name="state" id="state"  value="{$user_values.state}"  class="formInput required alph_num" maxlength="30">			</td>
			<td></td>
		</tr>
		<tr align="left" valign="top">
			<!--<td style="padding-left:25px;width:200px;">Country:</td>
			<td align=left>United States</td>-->
			<td style="padding-left:25px;width:200px;">Country:<span style="color:red;"></span></td>
			<td>
				<select name="country" id="country" class="formSel">
					{html_options values=$countryID output=$countryName selected=$country_value}
				</select>			</td>
			<td></td>
		</tr>
		<tr align="left" valign="top">
			<td style="padding-left:25px;width:200px;">Zip:<span style="color:red;">*</span></td>
			<td><input maxlength=10 name="zip" value="{$user_values.zipcode}"   class="formInput required alph_num"  /></td>
			<td width="50" nowrap>(5 or 9 digit)</td>
		</tr>

		
		<tr align="left" valign="top">
			<td style="padding-left:25px;width:200px;">Item Cost is:<span style="color:red;"></span></td>
			<td align="left"><b>{$USD}&nbsp;{$total_amt_commison}&nbsp;</b></td>
			<td>&nbsp;</td>
		</tr>

<tr align="left" valign="top">
			<td style="padding-left:25px;width:200px;">Total Amount:<span style="color:red;"></span></td>
			<td><input maxlength='7' name="amount" readonly value="{$total_amt_commison}"
			class="formInput"  /></td>
			<td><b>{$USD}</b>&nbsp;</td>
		</tr>

		<!--<tr>

			<td colspan="3" align="right" style="padding-right:100px; color:#027eb2;">
			<input name="terms" type="checkbox" value="Y" /> You agree to the terms and conditions for nethaat.</td>

		</tr>-->
		<tr>
			<td style="padding-left:25px;width:200px;"></td>
			<td>
				<input type="submit" name="submit" class='Class_Button_ris' value="PURCHASE NOW"  />			</td>
			<td></td>
		</tr>
		</table>
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