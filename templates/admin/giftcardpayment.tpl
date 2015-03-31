{include file="admin_top.tpl"}
{*include file="js_css_validation.tpl"*}
<script language="javascript">
{literal}
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
{/literal}
</script>
<table width="100%"  border="0" cellspacing="10" cellpadding="5">
	<tr>
	  <td valign="middle" class="bar">{$form_heading}</td>
	</tr>

	<tr>
	
	</tr>	
	<tr>
	  <td align="left" valign="top" class="border1">
      <table width="100%" cellpadding="4" border='0' cellspacing="2" align="center">
   <form action="giftcardpayment.php" method="post" name="frmpayment" id="frmpayment">
	<tr>
		 
		     
		  <td colspan='2' align='left' 
		  style='font-size:12px;font-family:arial;color:red;text-align:right;'>
		
		      <input type=hidden name=paymentType value="Sale" />
				<input type=hidden name=id value="{$id}" />
				<input type=hidden name=buyid value="{$buyid}" />
		  </td>
	</tr>
	<tr>
	        <td align='right' width='200' ><b>First Name</b>&nbsp;:</td>
		      
	        <td align='left' style='padding-right:25px;'>
		<input type="text" maxlength=32 name="firstName" class="input required alph_num" ></td>
	 </tr>
	 <tr>
	        <td align='right' ><b>Last Name</b>&nbsp;:</td>
		      
	        <td align='left' style='padding-right:25px;'>
		
		<input type='text' maxlength=32 name="lastName"  style='width:180px;' value='' id='lastName'  
		class="required  input"  ></td>
	 </tr>
	  <tr>
	        <td align='right' ><b>Card type </b>&nbsp;:</td>
		      
	        <td align='left' style='padding-right:25px;'>
	
			<select name="creditCardType" onChange="javascript:generateCC(); return false;">
				<option value=Visa selected>Visa</option>
				<option value=MasterCard>MasterCard</option>
				<option value=Discover>Discover</option>
				<option value=Amex>American Express</option>
			</select>
</b>
		</td>
	 </tr>
	  <tr>
	        <td align='right' ><b>Credit Card Number<span style="color:red;" >*</span></b>&nbsp;</td>
		      
	        <td align='left' style='padding-right:25px;'>
		<input type="text" maxlength=19 name="creditCardNumber" class="input required alph_num" >

		</td>
	 </tr>
	  <tr>
	        <td align='right'><b>Expiration Date</b>&nbsp;:</td>
		      
	        <td align='left' style='padding-right:25px;'><select name=expDateMonth>
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
	 </tr>
	   <tr>
	        <td align='right' ><b>Card Verification Number</b>&nbsp;:</td>
		<td align='left' style='padding-right:25px;'>
		<input type=text size=3 maxlength=4 name="cvv2Number"  value="{$cvv2Number}" 
			class="input required alph_num"  />
	</td>
	 </tr>
	   <tr>
	        <td align='right' ><b>CVC on Back</b>&nbsp;:</td>
		      
	        <td align='left' style='padding-right:25px;'>
		<input name="v_cc_cvc" id="v_cc_cvc" type="text" 
				value='' class="input required alph_num" maxlength="30" />
		</td>
	 </tr>
	  <tr>
	        <td align='right' ><b>Billing Address</b>&nbsp;:</td>
		      
	        <td align='left' style='padding-right:25px;'>
		
		</td>
	 </tr>
	
	  <tr>
	        <td align='right' ><b>Address 1</b>&nbsp;:</td>
		      
	        <td align='left' style='padding-right:25px;'>
		<input type="text" maxlength=100 name="address1" 
				value=''class="input required alph_num" >
		</td>
	 </tr>
	  <tr>
	        <td align='right' ><b>Address 2</b>&nbsp;:</td>
		      
	        <td align='left' style='padding-right:25px;'>
		<input type="text" maxlength=100 name="address2" value='' class="input" >
		</td>
	 </tr>
	   <tr>
	        <td align='right' ><b>City:</b>&nbsp;:</td>
		      
	        <td align='left' style='padding-right:25px;'>
		<input type="text" name="city" value=''class="formInput required alph_num" maxlength="30">
		</td>
	 </tr>
	  <tr>
	        <td align='right' ><b>State</b>&nbsp;:</td>
		      
	        <td align='left' style='padding-right:25px;'>
		<input type="text" name="state" id="state" value='' class="input required alph_num" maxlength="30">
		</td>
	 </tr>
	  <tr>
	        <td align='right' ><b>Country</b>&nbsp;:</td>
		      
	        <td align='left' style='padding-right:25px;'>
		<select name="country" id="country" class="formSel">
					{html_options values=$countryID output=$countryName selected=$country_value}
				</select>
		</td>
	 </tr>
	 <tr>
	        <td align='right' ><b> Zip</b>&nbsp;:</td>
		      
	        <td align='left' style='padding-right:25px;'>
		<input maxlength=10 name="zip" value='' class="input required alph_num"  />
		</td>
	 </tr>
	 
	  <tr>
	        <td align='right' ><b> Amount</b>&nbsp;:</td>
		      
	        <td align='left' style='padding-right:25px;'>
		<input maxlength=7 name="amount" value="{$smarty.session.giftcardreciveramount}" 
		class="input" readonly /><b>&nbsp;{$CURRENCY}</b>
		</td>
	 </tr>
	 
	
	
	 <tr>
	       <td>&nbsp;</td>
		    
	      <td><input type='submit' value='Submit'  name='submit'></td>
	 </tr>
	</form>
		
      </table>
</td>
	</tr>
</table>	  
{include file="admin_bottom.tpl"} 