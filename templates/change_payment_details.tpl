{include file="header.tpl"}
{include file="js_css_validation.tpl"}
{include file="header_search.tpl"}
<script language="javascript">
{literal}

function show_rows(VAL)
	{
	
	if(VAL!=1)
		{
       document.getElementById('row_user').style.display='none';		
	   document.getElementById('row_pass').style.display='none';
	   document.getElementById('row_sign').style.display='none';
	   document.getElementById('row_merchant_id').style.display='';
	   
		}
	else
	 	{
	   document.getElementById('row_user').style.display='';		
	   document.getElementById('row_pass').style.display='';
	   document.getElementById('row_sign').style.display='';
	   document.getElementById('row_merchant_id').style.display='none';
	 	 }
		
	}


{/literal}
</script>
<!--Start Middle-->
	<div id="middleMain">
			{include file="left_category.tpl"}
		<div id="middleRtMain">
				<table width="95%" border="0" class="registerBg" style="width:620px;padding:0px;" align="left" cellpadding="3"  id="registerSUbHd" cellspacing="0">
				<tr><td align="left" valign="top"  class="registerSUbHd">Change Payment Details</td></tr>
				  {if $value_of_country==1}
				<tr><td align="left" valign="top" >
					
				<form id="frmChangepaymentdetails_seller" name="frmChangepaymentdetails_seller" method="post">
					<table  border="0" style="width:600px;padding:0px;" align="left" cellpadding="5"  id="registerSUbHd" cellspacing="0">
					  <tr><td colspan="4">{include file='error_msg_template.tpl'}</td></tr>
				    
					<!--
					<tr>
					   <td align="left" valign="top" class="text">Select Payment Mode&nbsp; <b> :</b> </td>
					   <td>&nbsp; </td>
					   <td width="16%" align="left" valign="top">Paypal&nbsp;
				       <input type="radio" value="0" {if $payment_type==0 ||$payment_type==''}checked="checked"{/if}  onClick="return show_rows(1)"  name="choose_payment"/> </td>
					  <td width="57%" align="left" valign="top">CC Avenue&nbsp;
				      <input type="radio" value="1" {if $payment_type==1}checked="checked"{/if}   onClick="return show_rows(2)" name="choose_payment"/>
					  </td>
					  </tr>
					  -->
					
	                              <tr >
					  <td align="left" valign="top" style='font-size:12px;font-weight:bold;color:#804000' class="text">
                                          Paypal Direct Payment </td>
					  <td>&nbsp;</td>
					  <td colspan="2">&nbsp;</td>
					  </tr>
					<tr >
					  <td align="left" valign="top" class="text">Paypal Merchant Email&nbsp;<b> :</b> </td>
					  <td>&nbsp;</td>
					  <td colspan="2"><input name="paypal_merchant_id" id="paypal_merchant_id" type="text" class="required login_input" style="width:350px;" value="{$paypal_merchant_id}" /></td>
					  </tr>
					<!--<tr id="row_user" {if $payment_type==1}style="display:none;" {/if} >
					  <td width="25%" align="left" valign="top" class="text">API Username&nbsp;<b> :</b> </td>
					  <td width="2%">&nbsp;</td>
					  <td colspan="2" align="left" valign="top">
					  <input name="API_USERNAME" id="API_USERNAME" type="text" class="required login_input" style="width:350px;" value="{$API_USERNAME}" /></td>
					  </tr>-->
                                        <!--  <tr >
					  <td align="left" valign="top" style='font-size:12px;font-weight:bold;color:#804000;' class="text">
                                          Paypal Credit Card Payment </td>
					  <td>&nbsp;</td>
					  <td colspan="2">&nbsp;</td>
					  </tr>
					<tr id="row_user" {if $payment_type==1}style="display:none;" {/if} >
					  <td width="25%" align="left" valign="top" class="text">API Username&nbsp;<b> :</b> </td>
					  <td width="2%">&nbsp;</td>
					  <td colspan="2" align="left" valign="top">
					  <input name="API_USERNAME" id="API_USERNAME" type="text" class="required login_input" style="width:350px;" value="{$API_USERNAME}" /></td>
					  </tr>
					<tr id="row_pass" {if $payment_type==1}style="display:none;" {/if} >
					  <td align="left" valign="top" class="text">API  Password&nbsp;<b> :</b></td>
					  <td>&nbsp;</td>
					  <td colspan="2" align="left" valign="top"><input name="API_PASSWORD" type="password" class="required login_input" id="API_PASSWORD" style="width:350px;" value="{$API_PASSWORD}" /></td>
					  </tr>
					  
					<tr id="row_sign" {if $payment_type==1}style="display:none;" {/if}>
					  <td align="left" valign="top"  class="text">API Signature&nbsp;<b> :</b></td>
					  <td>&nbsp;</td>
					  <td colspan="2"><input name="API_SIGNATURE" type="text" class="required login_input" value="{$API_SIGNATURE}" 
				 id="API_SIGNATURE" style="width:350px;"  /></td>
					  </tr>

 <tr id='row_merchant_id' {if $payment_type==0 || $payment_type==''}style="display:none;"{/if}>
					  <td align="left" valign="top" class="text">CC Avenue Merchant Id&nbsp;<b> :</b></td>
					  <td>&nbsp;</td>
					  <td colspan="2"><input name="Merchant_Id" type="text" class="required login_input" id="Merchant_Id" style="width:350px;"  value="{$Merchant_Id}" /></td>
					  </tr>-->
					  
					<tr>
					  <td>&nbsp;</td>
					  <td>&nbsp;</td>
					  <td colspan="2">
					  <input name="change_paymentdetails" type="submit" value="Modify" class="button" /> 
					  <input name="cancel" type="button" value="Cancel" class="button" onClick="window.location='my_account.php';" />					  </td>
					</tr>
				
				  </table>
				</form>
		  </td></tr>
		  {/if}
		  {if $value_of_country!=1}
		  <tr><td align="left" valign="top" >
					
				<form id="frmChangepaymentdetails_seller1" name="frmChangepaymentdetails_seller1" method="post">
					<table  border="0" style="width:600px;padding:0px;" align="left" cellpadding="5"  id="registerSUbHd" cellspacing="0">					
					  <tr><td colspan="4">{include file='error_msg_template.tpl'}</td></tr>					
			           <tr><td colspan="4" align="left" valign="top"
                                   style='font-size:12px;font-weight:bold;color:#804000;' class="text">
                                      Paypal Direct Payment </td>
				    </tr>
                             <tr>	  <td align="left" valign="top" class="text">Paypal Merchant Email : </td>
				  <td>&nbsp;</td>
				  <td colspan="2"><input name="paypal_merchant_id" id="paypal_merchant_id" type="text" class="required login_input" style="width:350px;" value="{$paypal_merchant_id}" /></td>
					  </tr>  <!--<tr >
					  <td colspan="4" align="left" valign="top" style='font-size:12px;font-weight:bold;color:#804000;' class="text">
                                          Paypal Credit Card Payment </td>
					   </tr>
					<tr   >
					  <td width="25%" align="left" valign="top" class="text">API Username&nbsp;<b> :</b> </td>
					  <td width="2%">&nbsp;</td>
					  <td colspan="2" align="left" valign="top">
					  <input name="API_USERNAME" id="API_USERNAME" type="text" class="required login_input" style="width:350px;" value="{$API_USERNAME}" /></td>
					  </tr>
					<tr >
					  <td align="left" valign="top" class="text">API  Password&nbsp;<b> :</b></td>
					  <td>&nbsp;</td>
					  <td colspan="2" align="left" valign="top"><input name="API_PASSWORD" type="password" class="required login_input" id="API_PASSWORD" style="width:350px;" value="{$API_PASSWORD}" /></td>
					  </tr>
					  
					<tr >
					  <td align="left" valign="top"  class="text">API Signature&nbsp;<b> :</b></td>
					  <td>&nbsp;</td>
					  <td colspan="2"><input name="API_SIGNATURE" type="text" class="required login_input" value="{$API_SIGNATURE}" 
				 id="API_SIGNATURE" style="width:350px;"  /></td>
					  </tr>
                       -->
					 
					<tr>
					  <td><input name="choose_payment" value="0" type="hidden" />&nbsp;</td>
					  <td>&nbsp;</td>
					  <td colspan="2">
					  <input name="change_paymentdetails" type="submit" value="Modify" class="button" /> 
					  <input name="cancel" type="button" value="Cancel" class="button" onClick="window.location='my_account.php';" />					  </td>
					</tr> {/if}
				  </table>
				</form>
		  </td></tr>
		  </table>
			<!--</div>-->
		</div>
		<div class="clear"></div>
	</div>
<!--End Middle-->
{include file="footer.tpl"}