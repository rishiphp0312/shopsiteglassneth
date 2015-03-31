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
			<div>
				<span class="mainHD">Submit Your Store/Business Details</span>
				<form name="frmStore" id="frmStore" method="POST" action="store.php">
				<div class="registerBg">
					<div class="registerSUbHd">Contact Details
                                       <div class="reqField">*required</div>
                               </div>
					<div class="field">First name:<span class="redClr">*</span></div>
					<div class="labal"><input type="text" name="first_name" class="formInput required" maxlength="50" value="{$first_name|clear_input}" /></div>
					<div class="clr"><img src="images/spacer.gif" height="1" width="1" /></div>
					<div class="field">Last name:<span class="redClr">*</span></div>
					<div class="labal"><input type="text" name="last_name" class="formInput required" maxlength="50" value="{$last_name|clear_input}" /></div>
					<div class="clr"><img src="images/spacer.gif" height="1" width="1" /></div>
					<div class="field">Address 1:<span class="redClr">*</span></div>
					<div class="labal"><input type="text" name="address1" class="formInput required" maxlength="100" value="{$address1|clear_input}" /></div>
					<div class="clr"><img src="images/spacer.gif" height="1" width="1" /></div>
					<div class="field">Address 2:</div>
					<div class="labal"><input type="text" name="address2" class="formInput" maxlength="100" value="{$address2|clear_input}" /></div>
					<div class="clr"><img src="images/spacer.gif" height="1" width="1" /></div>
					<div class="field">City:<span class="redClr">*</span></div>
					<div class="labal"><input type="text" name="city" class="formInput required" maxlength="50" value="{$city|clear_input}" /></div>
					<div class="clr"><img src="images/spacer.gif" height="1" width="1" /></div>
					<div class="field">Postal Code:<span class="redClr">*</span></div>
					<div class="labal"><input type="text" name="zipcode" class="formInput required" maxlength="20" value="{$zipcode|clear_input}" /></div>
					<div class="clr"><img src="images/spacer.gif" height="1" width="1" /></div>
					<div class="field">Province/State:<span class="redClr">*</span></div>
					<div class="labal"><input type="text" name="state" class="formInput required" maxlength="50" value="{$state|clear_input}" /></div>
					<div class="clr"><img src="images/spacer.gif" height="1" width="1" /></div>
					<div class="field">Country:<span class="redClr">*</span></div>
					<div class="labal">
					<select class="formSel" name="country_id">
						{html_options values=$countryID output=$countryName selected=$country_id}
					</select>
					</div>
					<div class="clr"><img src="images/spacer.gif" height="1" width="1" /></div>
					<div class="field">Primary Phone Number:<span class="redClr">*</span></div>
					<div class="labal"><input type="text" name="phone1" class="formInput required" maxlength="20" value="{$phone1|clear_input}" /></div>
					<div class="clr"><img src="images/spacer.gif" height="1" width="1" /></div>
					<div class="field">Secondary Phone Number:</div>
					<div class="labal"><input type="text" name="phone2" class="formInput" maxlength="20" value="{$phone2|clear_input}" /></div>
					<div class="clr"><img src="images/spacer.gif" height="1" width="1" /></div>
					<!--
					<div class="field">Email address:<span class="redClr">*</span></div>
					<div class="labal"><input type="text" name="email" class="formInput" /></div>
					<div class="clr"><img src="images/spacer.gif" height="1" width="1" /></div>
					-->
					<div class="field">PayPal email address:<span class="redClr">*</span></div>
					<div class="labal"><input type="text" name="paypal_email" class="formInput required email" maxlength="60" value="{$paypal_email|clear_input}" /></div>
					<div class="clr"><img src="images/spacer.gif" height="1" width="1" /></div>
					{if $value_of_country==1}
			<!--<div  style="width:600px;border:0px solid red;">
					<div class="field">Select Payment&nbsp;:</div>
					<div class="labal">&nbsp;&nbsp;Paypal Details&nbsp;&nbsp;<input type="radio" value="0" {if $payment_type==0 ||$payment_type==''}checked="checked"{/if}  onClick="return show_rows(1)"  name="choose_payment"/>&nbsp;&nbsp;CC Avenue&nbsp;&nbsp;<input type="radio" value="1" {if $payment_type==1}checked="checked"{/if}  onClick="return show_rows(2)" name="choose_payment"/></div>
					<div class="clr"><img src="images/spacer.gif" height="1" width="1" /></div> </div>-->{/if}
				<!--	<div id="row_user" style="width:600px;border:0px solid red;{if $payment_type==1}display:none;{/if}">
					<div class="field">PayPal API Username:</div>
					<div class="labal"><input type="text" name="API_USERNAME" class="formInput" maxlength="60" value="{$API_USERNAME}" /></div>
					<div class="clr"><img src="images/spacer.gif" height="1" width="1" /></div> </div>-->
					<!--API_SIGNATURE-->
					<!--<div id="row_pass" style="width:600px;border:0px solid red;{if $payment_type==1}display:none;{/if}">
					<div class="field">PayPal API Password:</div>
					<div class="labal"><input type="text" name="API_PASSWORD" class="formInput" maxlength="60" value="{$API_PASSWORD}" /></div>
					<div class="clr"><img src="images/spacer.gif" height="1" width="1" /></div></div>

<div id="row_sign" style="width:600px;border:0px solid red;{if $payment_type==1}display:none;{/if}">

					<div class="field">PayPal API Signature:</div>
					<div class="labal"><input type="text" name="API_SIGNATURE" class="formInput" maxlength="60" value="{$API_SIGNATURE}" /></div>
					<div class="clr"><img src="images/spacer.gif" height="1" width="1" />
					</div>
</div>
<div id="row_sign" style="width:600px;border:0px solid red;{if $payment_type==1}display:none;{/if}">

					<div class="field">PayPal API Merchant Id:</div>
					<div class="labal"><input type="text" name="paypal_merchant_id" class="formInput" maxlength="60" value="{$API_SIGNATURE}" /></div>
					<div class="clr"><img src="images/spacer.gif" height="1" width="1" />
					</div>
</div>

					<div id="row_merchant_id" style="width:600px;border:0px solid red;{if $payment_type==0 || $payment_type==''}display:none;{/if} ">

		<div class="field" >CC Avenue Merchant Id:</div>
					<div class="labal"><input type="text" name="Merchant_Id" class="formInput" maxlength="60" value="{$Merchant_Id}" /></div>
					<div class="clr"><img src="images/spacer.gif" height="1" width="1" /></div></div>

					<div>Payment for our service is made through Pay Pal. If you do not already have a Pay Pal account, you must sign up for one using the email address you enter here in the next step.<br /><br /></div>-->




					<div class="registerSUbHd">Business Details(optional)</div>
					<div class="field">Company Name:</div>
					<div class="labal"><input type="text" name="company_name" class="formInput" maxlength="100" value="{$company_name|clear_input}" /></div>
					<div class="clr"><img src="images/spacer.gif" height="1" width="1" /></div>
					<div class="field">Company Address:</div>
					<div class="labal"><input type="text" name="company_address" class="formInput" maxlength="100" value="{$company_address|clear_input}" /></div>
					<div class="clr"><img src="images/spacer.gif" height="1" width="1" /></div>
					<div class="field">Business Phone Number:</div>
					<div class="labal"><input type="text" name="company_phone" class="formInput" maxlength="20" value="{$company_phone|clear_input}" /></div>
					<div class="clr"><img src="images/spacer.gif" height="1" width="1" /></div>
					<div class="field">Store Name:</div>
					<div class="labal"><input type="text" name="store_name" class="formInput" maxlength="100" value="{$store_name|clear_input}" /></div>
					<div class="clr"><img src="images/spacer.gif" height="1" width="1" /></div>
					<div class="field">Description of Business:</div>
					<div class="labal"><textarea name="company_desc" rows="5" cols="40" class="formInput">{$company_desc|clear_input}</textarea></div>
					<div class="clr"><img src="images/spacer.gif" height="1" width="1" /></div>
					<div class="field"></div>
					<div class="labal"><input name="btnSubmit" type="submit" value="Submit" class="btn" /></div>
					<div class="clr"><img src="images/spacer.gif" height="1" width="1" /></div>
				</div>
				</form>
			</div>
		</div>
<!--End Middle-->
{include file="footer.tpl"}