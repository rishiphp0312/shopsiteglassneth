{include file="header.tpl"}
{include file="header_search.tpl"}
<!--Start Middle-->
<div id="middleMain">
{include file="js_css_validation.tpl"}
{literal}
<script language="JavaScript">
 function ship_bill(NUM)
	 {
	  var CHK = document.getElementById('chk_box');
	  if(CHK.checked==true)
		      {
		       document.getElementById('row1').style.display='none'; 
		       document.getElementById('row2').style.display='none'; 
		       document.getElementById('row3').style.display='none'; 
		       document.getElementById('row4').style.display='none'; 
		        document.getElementById('row6').style.display='none'; 
		       document.getElementById('row5').style.display='none'; 
		     }
		     else
		     {
		       document.getElementById('row1').style.display=''; 
		       document.getElementById('row2').style.display=''; 
		       document.getElementById('row3').style.display=''; 
		       document.getElementById('row4').style.display=''; 
		       document.getElementById('row5').style.display=''; 
		       document.getElementById('row6').style.display=''; 
		     }
	
	 
	 
	 /*
	 
     
     
      var ZIP = document.getElementById('zipcode'); 
      var City = document.getElementById('city'); 
      var City = document.getElementById('city'); 
      var address2 = document.getElementById('address2'); 
      var address1 = document.getElementById('address1'); 
      var country_val = document.getElementById('country_value').selectedIndex;
      alert('sdsd'+country_val);
      //
		 if(CHK.checked==true)
		      {
		     
		      document.getElementById('chk_box').checked = 'checked';
		      document.getElementById('szipcode').value  =  ZIP.value;
		      document.getElementById('scity').value      =  City.value;
		      document.getElementById('saddress2').value =  address2.value;
		      document.getElementById('saddress1').value =  address1.value;
		      document.getElementById('saddress1').options[country_val].selected;
		      //document.forms[0].marsupials.options[selIdx].text;
		      }
		      else
		      {
		   
		      document.getElementById('szipcode').value  =  '';
		      document.getElementById('scity').value      =  '';
		      document.getElementById('saddress2').value =  '';
		      document.getElementById('saddress1').value =  ''; 
		      
		      }
		      */
	}

	
</script>
{/literal}
{*include file="left_category.tpl"*}
<!--<div id="middleRtMain">-->
<div>
<!--Start Tab Link-->


<div class="shopmain">
<span class="mainHD">Ship your Item &nbsp;&nbsp;</span>
	<!--Start my items -->
	<div class="myitemmain">
		<div class="myItemtopbg" style="text-align:right;"><a href="#" onclick="history.go(-1);" >Go Back</a>
			<div class="clear"></div>
		</div>
		
		<div class="myiteminsidemain">
		<table width="100%" cellpadding="3" celspacing="3" border="0" >
		<!--<tr>
		<td style="border:1px solid #8A5F40;">You can send a gift card to any one, anywhere.
		. please fill your account detail.!! </td></tr>-->
		
		<tr>
		<td  style="vertical-align:top;">
		<form action="advance_aggrement.php" method="post" name="frmshipment1" id="frmshipment1">
		<table width="630" cellpadding="3" celspacing="3" border="0"  >
		<tr>
		
			<td colspan="2">
			<input type='hidden' name='itemid' value="{$smarty.request.itemid}" />
			<input type='hidden' name='buyerid' value="{$smarty.session.session_user_id}" />
				<input type='hidden' name='paymentType' value="Sale" />
				<input type='hidden' name='id' value="{$id}" />
				<input type='hidden' name='buyid' value="{$buyid}" />
					{include file='error_msg_template.tpl'}
			</td>
			<td style="color:red;">*required</td>
		</tr>
		<tr>
			<td  colspan="3" 
			style="padding-left:2px;font-weight:bold; font-size:14px; vertical-align:top;" >
			Billing information</td>
		</tr>
		
		<tr>
			<td valign='top' style="padding-left:25px;width:200px;">Address1 </td>
			<td ><textarea name="address1" id='address1'  class="formInput required alph_num">
			{$user_values.address1}</textarea></td>
			<td><input type='hidden' value='{$weight_val}' name='weight'>
			<input type='hidden' value='{$unit_type_val}' name='unit_type'>
			</td>
		</tr>
			<tr>
			<td valign='top' style="padding-left:25px;width:200px;">Address2 </td>
			<td ><textarea name="address2" id='address2'  class="formInput required alph_num" >
			{$user_values.address2}</textarea></td>
			<td></td>
			
			
			</tr>
			<tr>
			<td style="padding-left:25px;width:200px;" valign='top'>City </td>
			<td ><input type='text' name="city" id='city' class="formInput required alph_num" 
			value='{$user_values.city}'></td>
			<td></td>
		</tr>
		<tr>
			<td style="padding-left:25px;width:200px;" valign='top'>Zipcode </td>
			<td ><input type='text' name="zipcode"  id='zipcode' class="formInput required alph_num" 
			value='{$user_values.zipcode}'></td>
			<td></td>
		</tr>
		<tr>
			<td style="padding-left:25px;width:200px;" valign='top'>Country </td>
			<td >
			<select class="formSel" name="country_value"  id="country_value">
					{html_options values=$countryCode output=$countryName 
					selected=$iso_code_loged_user}
					</select>
			</td>
			<td></td>
		</tr>
		<!--<tr>
			<td style="padding-left:25px;width:200px;" valign='top'>Quantity </td>
			<td >
		<input type='text' value='{$smarty.session.ship_quantity}' name='Quantity' id='Quantity'>			</td>
			<td><input type='hidden'  value='{$zipcode_origin_seller}' name='origin_zipcode'>
			<input type='hidden' value='{$iso_code}' name='origin_iso_code'></td>
		</tr>-->
		<tr  >
			<td COLSPAN='3' style="padding-left:25px;width:400px;" >
			<input type='checkbox' value='1' id='chk_box'  name='chk_box'
			onclick='ship_bill({$smarty.session.chk_session});' >  
			Click here if shipping address is same as billing address</td>
		
		</tr>
		
		
	
		
	
	
		<tr id='row1'>
			<td colspan="2"  style="padding-left:25px;width:200px;font-weight:bold;">Shipping Address:</td>
			
			<td></td>
		</tr>
	<tr id='row2'>
			<td style="padding-left:25px;width:200px;" valign='top'>Address1 </td>
			<td ><textarea name="saddress1" id='saddress1' class="formInput required alph_num"></textarea></td>
			<td></td>
		</tr>
		<tr id='row3'>
			<td style="padding-left:25px;width:200px;" valign='top' >Address 2:<span style="color:red;"></span></td>
			<td>
			<textarea name="saddress2" id='saddress2' class="formInput required alph_num"></textarea></td>
			<td>(optional)</td>
		</tr>
		<tr id='row4'>
			<td style="padding-left:25px;width:200px;">City:</td>
			<td>
				<input type="text" name="scity" id='scity' value=""
				class="formInput required alph_num" maxlength="30">
			</td>
			<td></td>
		</tr>
		
		
		<tr id='row5'>
			<td style="padding-left:25px;width:200px;">Zipcode:</td>
			<td>
			<input maxlength=10 name="szipcode" id='szipcode' value=""   
						class="formInput required alph_num"  /></td>
			<td width="50" nowrap>(5 or 9 digit)</td>
		</tr>
		<tr id='row6'>
			<td style="padding-left:25px;width:200px;">Country:<span style="color:red;"></span></td>
			<td>
			<select class="formSel" name="scountry_value"  id="scountry_value">
					{html_options values=$countryCode output=$countryName
					selected=$country_value}
					</select>
			<b></b>
			
			</td>
			<td>&nbsp;</td>
		</tr>
		
		<tr>
			<td style="padding-left:25px;width:200px;"></td>
			<td>
				<input type="submit" name="submit" value="Calculate Shipping "  />
			</td>
			<td>&nbsp;
			</td>
		
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