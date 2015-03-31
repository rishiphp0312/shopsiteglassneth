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
		<table width="100%" cellpadding="2" cellspacing="1"  border="0" >
	   <tr>
    	<td valign="top" align="left" width="30%" >
		<table align="center" cellpadding="0" cellspacing="0" border="0" width="100%">
		<form action="" name="frm_pay_seller_search" method="post">
		<tr>
		<td align="left" width="40%">
		<b>Enter Seller's Username &nbsp;:</b>&nbsp;<br />
		<input type="text" class="formInput" value="{$seller_username}" name="seller_username" id="seller_username" />
		</td>
		<td align="left" colspan="2" >
		 <input type="submit" value=" Search " name="search"  class='Class_Button_ris' />
		 &nbsp;&nbsp;&nbsp;
		  <input type="button" value=" Clear Search " name="clear" onclick="window.location='events_gift_cards.php?rem_id_value={$smarty.get.rem_id_value}'"  class='Class_Button_ris' />
 		</td></tr>
		
		</form>
		</table>
		</td></tr>
		
		<tr>
		
		
		<td valign="top" align="left" width="30%" >
		<form action="paypal-for-reminder.php"  name="frmpayment_for_standrd" id="frmpayment_for_standrd">
		<table width="100%" cellpadding="2"  cellspacing="1" border="0" style="border:0px solid #E9D1D1;"  align="center" >
		  <tr>
		  <td colspan="3">&nbsp;</td>
		  </tr>
		  <tr>
		  <td colspan="3">
		  <table width="100%" cellpadding="2" bgcolor="#CCCCCC"  cellspacing="1" border="0" >
		  {if $smarty.request.seller_username!=''}
		  	  <tr>
		    <td  align="left" ><b>Select Seller </b></td>
		  <td  align="left" ><b>Username  </b></td> 
		  <td  align="left" ><b>Seller's Name </b> </td>
		
		  </tr  >
		  {if $num_users_serch>0}
		  	{foreach name=SERCH_LIST from=$all_serch_arr_val item=val_items_serch}
		  <tr bgcolor="#ffffff" >
		    <td  align="left" >
			<input  {if $smarty.foreach.SERCH_LIST.iteration==1} checked='true'{/if} type="radio" value="{$val_items_serch.user_id_value}" name="seller_id" /></td>
		  <td  align="left" >{$val_items_serch.username}</td> 
		  <td  align="left" >{$val_items_serch.first_name} {$val_items_serch.last_name}</td>
		
		  </tr>
		    {/foreach}
				<tr bgcolor="#ffffff" >
		      <td  align="left" colspan="3" style="font-size:13px;color:#804040;text-align:center;" >	{$page_counter} records&nbsp;&nbsp;&nbsp;&nbsp;<span style="float:right;">
						{$pageLink}</span></td>
			
		
		  </tr>
			{else}
			<tr bgcolor="#ffffff" >
		      <td  align="left" colspan="3" style="font-size:13px;color:#804040;text-align:center;" >No records found!!.</td>
			
		
		  </tr>
		  {/if}
			
			{/if}</table></td></tr>
		  <tr><td colspan="2">
	
	<input type="hidden" name="rem_id_value" value="{$rem_id_value}" />
	
	</td></tr>
		<tr>
		 <td colspan="2" style="border:0px solid #E9D1D1;" valign='top' >
                <table width="100%" cellpadding="2" cellspacing="1" border="0"  align="center" >
                   <!-- <tr>
		   <td width="130" align="left" valign="top" nowrap="nowrap" > Seller's Store			   </td>
		   <td width="50" valign="top" align="left" >
		   <select style="width:100px;"    name='seller_id' id='seller_id'>
		    <option value="0">--Select--</option>
		   {html_options values=$usersId  output=$usersName_store}
		    </select>
                    </td><td></td>
		</tr>-->
		<tr align="left">
		       <td width="6%" valign="top" >Amount &nbsp;:</td>
			   <td width="15%" valign="top" ><input maxlength='7'id="amount" name="amount" value="" class="formInput required only_numericwithfloat" style="width:100px;"  />&nbsp;</td>
		<td width="80%" valign='top'><b>{$CURRENCY}</b></td>
		</tr>
		<tr>
		       <td valign="top" align="left" colspan="3" ><img src="images/paypal.gif" alt="" />&nbsp;&nbsp;
<input type="submit" value=" Pay Now " name="pay" class='Class_Button_ris' />
			   &nbsp;&nbsp;<br>(Click here to pay directly on paypal.)</td>
		</tr>
  
		  </table>
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