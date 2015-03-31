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
		<table width="100%" cellpadding="3" cellspacing="3" border="0"  >
		<!--<tr>
		<td style="border:1px solid #8A5F40;">You can send a gift card to any one, anywhere.
		. please fill your account detail.!! </td></tr>-->
		
		<tr>
		<td style="vertical-align:top;"  align='right'>
		<form action="" method="post" name="frmshipment" id="frmshipment">
		<table width="830" cellpadding="3" cellspacing="3" border="0" align='right' >
		<tr>
			<td colspan="2" align='left'style="padding-left:2px;font-size:12px; vertical-align:top;text-align:left;color:#996633;" ><b>Quantity &nbsp;:</b> &nbsp;{$quantity}&nbsp;
				<input type='hidden' name='paymentType' value="Sale" />
				<input type='hidden' name='id' value="{$id}" />
				<input type='hidden' name='buyid' value="{$buyid}" />
<input type=hidden name='seller_id' value="{$smarty.request.seller_id}" />
<input type=hidden name='requested_quantity' value="{$quantity}" />

					{include file='error_msg_template.tpl'}
			</td>
			<td style="color:red;">*required</td>
		</tr>
		<!--<tr>
			<td  colspan="3" 
			style="padding-left:2px;font-weight:bold; font-size:14px; vertical-align:top;text-align:left;" >
			Billing information</td>
		</tr>-->
		<tr>
			<td  colspan="2" align="left" valign="top">	<fieldset style="border:1px solid #999999;">
			<legend style="padding-left:2px;font-weight:bold; font-size:14px; vertical-align:top;text-align:left;">Billing information</legend>
			<table align="center" cellpadding="2" cellspacing="2" border="0">
	<tr><td width="100" valign='top' style="padding-left:25px;width:100px;">Address1 </td>
			<td width="188" align='left' style="padding-left:25px;"><textarea name="address1" id='address1'  class="formInput required alph_num_space">{$user_values.address1}</textarea></td>
			<td width="196" align='left'><input type='hidden' value='{$weight_val}' name='weight'>
			<input type='hidden' value='{$unit_type_val}' name='unit_type'>
			<input type='hidden' value='{$item_id}' name='item_id'></td>
		</tr>
			<tr>
			<td valign='top' style="padding-left:25px;width:100px;">Address2 </td>
			<td style="padding-left:25px;" align='left'><textarea name="address2" id='address2'  class="formInput required alph_num_space" >{$user_values.address2}</textarea></td>
			<td></td>
		</tr>
		
			<tr>
			<td style="padding-left:25px;width:100px;" valign='top'>City </td>
			<td  style="padding-left:25px;" align='left'><input type='text' name="city" id='city' class="formInput required alph_num_space"
			value='{$user_values.city}'></td>
			<td></td>
		</tr>
		<tr>
			<td style="padding-left:25px;width:100px;" valign='top'>Zipcode </td>
			<td style="padding-left:25px;" align='left'><input type='text' name="zipcode"  id='zipcode' class="formInput required alph_num"
			value='{$user_values.zipcode}'></td>
			<td style="padding-left:25px;width:200px;">&nbsp; </td>
		</tr>
		<tr>
			<td style="padding-left:25px;width:100px;" valign='top'>Country </td>
			<td valign='top'style="padding-left:25px;" align='left'>
			<select class="formSel" name="country_value"  id="country_value">
					{html_options values=$countryCode output=$countryName 
					selected=$code_accord_country_ip}
					</select>
			</td>
			<td align='right'style="padding-left:25px;width:200px;">
			 </td>
		</tr>
				
			</table></fieldset>
			</td>
		</tr>
		<tr>
			<td style="padding-left:2px;font-size:12px; vertical-align:top;text-align:center;color:#996633;" >
			</td>
		<td></td>
		<td></td>
         </tr>
	
		<tr>

			<td COLSPAN='2' align="left" valign="top" nowrap="nowrap" style="padding-left:12px;" >
			<input type='checkbox' value='1' id='chk_box'  name='chk_box'
			onclick='ship_bill({$smarty.session.chk_session});' >  
			Click here if shipping address is same as billing address</td>
<td ></td>
			
		</tr>
		
		
	
		<tr id='row1'>
			<td  colspan="2" align="left" valign="top">	<fieldset style="border:1px solid #999999;">
			<legend style="padding-left:1px;font-weight:bold; font-size:14px; vertical-align:top;text-align:left;">Shipping Address:</legend>
			<table align="center" cellpadding="2" width="600" cellspacing="2" border="0">
			
			<tr id='row2'>
			<td width="115" align="left" valign='top' style="padding-left:10px;width:100px;">Address1 </td>
			<td width="197" align='left' style="padding-left:10px;">
 <textarea name="saddress1" id='saddress1' class="formInput required alph_num_space"></textarea></td>
			<td></td>
		</tr>
		<tr id='row3'>
			<td align="left" valign='top' style="padding-left:10px;width:100px;" >Address 2:<span style="color:red;"></span></td>
			<td style="padding-left:10px;" align='left'>
			<textarea name="saddress2" id='saddress2' class="formInput required alph_num_space"></textarea></td>
			<td>(optional)</td>
		</tr>
		<tr id='row4'>
			<td align="left" valign="top" style="padding-left:10px;width:100px;">City:</td>
			<td style="padding-left:10px;" align='left'>
				<input type="text" name="scity" id='scity' value=""
				class="formInput required alph_num_space" maxlength="30">
			</td>
			<td></td>
		</tr>
		
		
		<tr id='row5'>
			<td align="left" valign="top" style="padding-left:10px;width:100px;">Zipcode:</td>
			<td style="padding-left:10px;" align='left'>
			<input maxlength=10 name="szipcode" id='szipcode' value="" class="formInput required alph_num"  /></td>
			<td width="160" nowrap>(5 or 9 digit)</td>
		</tr>
		<tr id='row6'>
			<td align="left" valign="top" style="padding-left:10px;width:100px;">Country:<span style="color:red;"></span></td>
			<td style="padding-left:10px;" align='left'>
			<select class="formSel" name="scountry_value"  id="scountry_value">
			{html_options values=$countryCode output=$countryName selected=$code_accord_country_ip}
			</select>
			<b></b>
			
			</td>
			<td>&nbsp;</td>
		</tr>

	</table></fieldset></td></tr>
	
	
			
		<tr>
			<td style="padding-left:10px;width:100px;text-align:left;"><table width="100%" border="0" cellpadding="2" cellspacing="0"
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
 </td>
			<td style="padding-left:10px;text-align:center;" align='center'>
				<input type="submit" class='Class_Button_ris' style="width:120px;" name="submit" value="Calculate Shipping "  />
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