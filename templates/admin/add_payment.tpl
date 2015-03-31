{include file="admin_top.tpl"}
<script language="javascript">
{literal}
function show_rows(VAL)
	{
	if(VAL!=1)
		{
            document.getElementById('cc_avenue_id').style.display='none';
	    document.getElementById('paypal_id').style.display='';
		}
	else
	 	{
	   document.getElementById('cc_avenue_id').style.display='';		
	   document.getElementById('paypal_id').style.display='none';
	 	 }
		
	}

{/literal}
</script>

  <table width="100%"  border="0" cellspacing="10" cellpadding="5">
	<tr>
	  <td valign="middle" class="bar">Admin Add/Edit Payment Details </td>
	</tr>
	<tr>
	  <td align="left" valign="top" class="border1">
	  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr><td>{include file='admin_error_msg_template.tpl'}</td></tr>
		<tr>
		  <td width="710" class="lback">
		  <form name="frmAdminpaymentAccount" id="frmAdminpaymentAccount" method="post" style="margin:0px;">
		     <table width="100%" border="0" cellspacing="0" cellpadding="4">
				<!--<tr>
				  <td colspan="4" align="left" class="text">
<table align="center" cellpadding="0" cellspacing="0" border="0" width="100%">
<tr><td width="15%" align="left"  ><b>Payment Mode &nbsp;:</b></td>
<td align="left" valign="top" >
<input type="radio" onClick="return show_rows(1)" value="1"
 {if $admin_payment_type==1}checked="checked"{/if}  name="payment_type">
 &nbsp;CC Avenue &nbsp;&nbsp;<input type="radio" onClick="return show_rows(2)"
value="0"{if $admin_payment_type==0 || $admin_payment_type==''} checked="checked" {/if} name="payment_type"> &nbsp;Paypal Account
				
				</td></tr>
				
				</table>
					  </td>
			    </tr>-->
				
				<tr>
				  <td colspan="4" align="left" class="text">&nbsp;</td>
			    </tr>
		<!--<tr id='paypal_id' {if $admin_payment_type==0}style="display:'';"
				{else}
				style="display:none;"
				 {/if} >-->

		<tr id='paypal_id' >
				  <td colspan="4" align="left" class="text">
	<table width="600" border="0" align="center" cellpadding="3" cellspacing="0">
	<tr>
		  <td width="32%" align="left" class="text" nowrap>Paypal Merchant Email&nbsp;:</td>
		  <td width="22%"><input name="paypal_merchant_id" type="text"
class="input required" id="paypal_merchant_id" style="width:430px;" value="{$paypal_merchant_id}" /></td>
		  <td width="46%">&nbsp;</td>
	</tr>
        <!--<tr>
		  <td width="32%" align="left" class="text">API Username&nbsp;:</td>
		  <td width="22%"><input name="API_USERNAME" type="text"  class="input required" id="API_USERNAME" style="width:430px;" value="{$API_USERNAME}" /></td>
		  <td width="46%">&nbsp;</td>
	</tr>
	<tr>
		  <td align="left" class="text">API Password&nbsp;:</td>
		  <td><input name="API_PASSWORD" style="width:430px;"type="text" class="input required" id="API_PASSWORD"  value="{$API_PASSWORD}"  /></td>
	      <td>&nbsp;</td>
	</tr>
	<tr>
		  <td align="left" class="text">API Signature&nbsp;:</td>
		  <td><input name="API_SIGNATURE" type="text" class="input required" id="API_SIGNATURE" value="{$API_SIGNATURE}" style="width:430px;" /></td>
		  <td>&nbsp;</td>
	</tr> --> 
		  </table>				  </td>
			    </tr>
				<!--<tr id='cc_avenue_id'  {if $admin_payment_type==1}style="display:'';" {else}style="display:none;"
				{/if} >  
				  <td colspan="4" align="left" class="text">
	<table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
		  <td width="32%" align="right" valign="top" class="text">CC Avenue Merchant Id&nbsp;<b>:</b>&nbsp;</td>
		  <td width="57%" align="left" valign="top"><input name="Merchant_Id" type="text"  class="input" id="Merchant_Id" size="30" value="{$Merchant_Id}" /></td>
		  <td width="11%">&nbsp;</td>
	</tr>
		  </table>				  </td>
			    </tr>-->
				<tr>
				  <td>&nbsp;</td>
				  <td align="center" valign="top"><input name="update_profile" type="submit" class="button" value="Update" />&nbsp;&nbsp;
					  <input name="cancel" type="reset" class="button" value="Cancel" onClick="window.location='admin_home.php'" /></td>
				  <td align="center" valign="top"></td>
				  <td>&nbsp;</td>
				</tr>
			</table>
		  </form></td>
		</tr>
	</table>
	</td>
	</tr>
</table>
{include file="admin_bottom.tpl"}