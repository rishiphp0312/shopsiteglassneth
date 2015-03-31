{include file="header.tpl"}
{include file="js_css_validation.tpl"}
{include file="header_search.tpl"}

<link rel="stylesheet" type="text/css" href="{$baseUrl}fancybox/jquery.fancybox-1.2.6.css" media="screen" />
<script type="text/javascript" src="{$baseUrl}fancybox/jquery.fancybox-1.2.6.pack.js"></script>

{literal}
<SCRIPT language="JavaScript1.2">
$(document).ready(function()
{
	$("a.locker_password").fancybox({
	'hideOnContentClick': false,
	'frameWidth'			: 455,
	'frameHeight'			: 200		
	});
});

</SCRIPT>
{/literal}	

<div id="middleMain">
{literal}
<script>
function check_val()
{
	var ava_qty = document.getElementById('max_quantity').value;
	var min_qty = document.getElementById('quantity').value;

	alert('ava_qty'+ava_qty);
	alert('min_qty'+min_qty);
	//if(min_qty > ava_qty)
	if(ava_qty < min_qty)
	{
	alert('jcjc')
	alert('Minimum Quantity cannot be greater than Available Quantity!!');
	return false;
	}else
	return true;
}

function upd_function()
{
	document.getElementById('showdiv').style.display="none";
	document.getElementById('upddiv').style.display="block";
}
function show_function()
{
	document.getElementById('showdiv').style.display="block";
	document.getElementById('upddiv').style.display="none";
}
</script>
{/literal}
{*include file="left_category.tpl"*}
<!--Start Middle-->
<div id="middleMain">
	<div id="middleRtMain" style="width:100%">
	<div >
	<span class="mainHD">Seller & Store Information</span>
		<!--start top tab-->
		<div>
			
			<div class="clear"></div>
		</div>
		
		<!--End top tab-->
		<!--Start inside part -->
		
		<div id="showdiv" style="display:block" class="sellItemmian">
		<table cellspacing="2" cellpadding="5" border="0" width="100%">
			<tr>
	<td align="right" style="font-weight:bold"><a href="#my_account.php" onclick='history.go(-1)' >Go Back</a></td>
			</tr>
			<tr>
	<td align="right" style="font-weight:bold"><a href="javascript://" onclick=upd_function()>Edit Section</a></td>
			</tr>
			<tr>
				<td style="padding:20px;">
				<table cellspacing="3" cellpadding="3" width="100%" border="0" >
					
					<tr>
						<td style="vertical-align:top;font-weight:bold">Store Name</td>
						<td style="vertical-align:top;">		{$username} 
						</td>
						<td colspan="2">&nbsp;</td>
						
					</tr>
					<tr>
						<td width="180" style="font-weight:bold;vertical-align:top;">Store Image</td>
						<td>
							{if $v_store_image !=""}<img  src="{$baseUrl}getthumb.php?w=50&h=50&fromfile=uploads/store_logos/{$v_store_image}" alt="Store Image"   border='0' class="itemimg"/>
							{else}
							<img src='images/no_img.jpg'  height="100" width="100" align="middle" border="1" class="" style="padding:2px;vertical-align:top;">
							{/if}
						</td>
						<td colspan="2">&nbsp;</td>		
					</tr>
					<tr>
						<td width="180" style="font-weight:bold;vertical-align:top;">First Name</td>
						<td width="200">{$f_name}</td>
						<td colspan="2">&nbsp;</td>		
					</tr>
					<tr>
						<td style="font-weight:bold;padding-left:0px;vertical-align:top;">Last Name</td>
						<td width="200" >{$l_name}</td>
						<td colspan="2">&nbsp;</td>
					</tr>
					<tr>	<td colspan="4">&nbsp;</td></tr>
					<tr >
						<td style="font-weight:bold;vertical-align:top;">Address1</td>
						<td >{$address1	}</td>
						<td colspan="2">&nbsp;</td>
					</tr>
					<tr>
						<td style="font-weight:bold;vertical-align:top;">Address2</td>
						<td >{$address2}</td>
						<td colspan="2">&nbsp;</td>
					</tr>
					<tr><td colspan="4">&nbsp;</td></tr>
					<tr>
						<td style="vertical-align:top;font-weight:bold">Phone1</td>
						<td >{$phone1}</td>
						<td colspan="2">&nbsp;</td>
					
						
					</tr>
					<tr>
						<td style="vertical-align:top;font-weight:bold;">Phone2</td>
						<td >{$phone2}</td>
						<td colspan="2">&nbsp;</td>
					</tr>
					<tr>
						<td style="vertical-align:top;font-weight:bold;">City </td>
						<td width="200"  >{$city}</td>
						<td colspan="2">&nbsp;</td>
					</tr>
					<tr>
						
						<td style="vertical-align:top;font-weight:bold;">State</td>
						<td >{$state}</td>
						<td colspan="2">&nbsp;</td>
					</tr>
					<tr>
						
						<td style="vertical-align:top;font-weight:bold;">Country</td>
						<td >{$user_country_name}</td>
						<td colspan="2">&nbsp;</td>
					</tr>
					<tr>
						<td style="vertical-align:top;font-weight:bold">Zipcode</td>
						<td >{$zipcode}</td>
						<td colspan="2">&nbsp;</td>
					</tr>
					<tr><td colspan="4">&nbsp;</td></tr>
					{*
					<tr>
						<td style="vertical-align:top;font-weight:bold">Paypal Email</td>
						<td >{$paypal_email}</td>
						<td colspan="2">&nbsp;</td>
					</tr>
					*}
					<tr>
						<td style="vertical-align:top;font-weight:bold;">Company Name </td>
						<td >{$company_name}</td>
						<td colspan="2">&nbsp;</td>
					</tr>
					<tr>
						<td style="vertical-align:top;font-weight:bold">Company Address</td>
						<td > {$company_address} </td>
						<td colspan="2">&nbsp;</td>
					
						
					</tr>
					<tr>
						<td style="vertical-align:top;font-weight:bold;">Company Phone</td>
						<td >{$company_phone}</td>
						<td colspan="2">&nbsp;</td>
					</tr>
					
					<tr>
						<td style="vertical-align:top;font-weight:bold;">Company Desc </td>
						<td width="75%">{$company_desc}</td>
						<td colspan="2">&nbsp;</td>
					</tr>
					<tr><td colspan="4">&nbsp;</td></tr>
					

				</table>
				</td>
			</tr>
		</table>

		<table cellspacing="2" cellpadding="5" border="0" width="100%" align="center">
			<tr>
				<td colspan="2" style="color:#8A5F40;vertical-align:top;font-weight:bold;font-size:16px;">Shop Policy Information</td>
			</tr>
			<tr>
				<td colspan="2" align="right" style="vertical-align:top;font-weight:bold;"><a href="shop-policies.php?id={$id}">Edit Section</a></td>
			</tr>
			<tr>
			<td colspan="2" style="padding:18px;">
				<table cellspacing="2" cellpadding="5" border="0" width="100%">
					
					<tr>
						<td  width="22%" style="vertical-align:top;font-weight:bold;">Welcome Note</td>
						<td>{$v_welcome}</td>
					</tr>
					<tr>
						<td style="vertical-align:top;font-weight:bold;">Payment Note</td>
						<td>{$v_payment}</td>
					</tr>
					<tr>
						<td style="vertical-align:top;font-weight:bold;">Shipping Note</td>
						<td>{$v_shipping}</td>
					</tr>
					<tr>
						<td style="vertical-align:top;font-weight:bold;">Refunds and Exchanges Note</td>
						<td>{$v_refund_exchange}</td>
					</tr>
					<tr>
						<td style="vertical-align:top;font-weight:bold;">Additional Information Note</td>
						<td>{$v_additional_info}</td>
					</tr>
				</table>
			</td>
			</tr>
		</table>
		<table cellspacing="2" cellpadding="5" border="0" width="100%" align="center">
			<tr>
				<td colspan="2" style="color:#8A5F40;vertical-align:top;font-weight:bold;font-size:16px;">Locker Password</td>
			</tr>			<tr>
				<td colspan="2" align="right" style="vertical-align:top;font-weight:bold;"><a class="locker_password" href="{$baseUrl}locker_password.php">Edit Password</a></td>
			</tr>
			<tr>
			<td colspan="2" style="padding:18px;">
			<form name="lockerpassword" id="lockerpassword" method="post" action="">
				<table cellspacing="2" cellpadding="5" border="0" width="100%">
					
					<tr>
					{if $locker_password!=""}
						<td colspan="2" style="font-weight:bold;">
						Your locker password is
  <span style="color:green;font-size:15px;padding-left:11px;"> <u>{$locker_password}</u></span>
 <br><br> This access code valid till <span style="color:red;font-size:15px;padding-left:5px;"> <u> {$locker_last_date|date_format}</u></span> 
						</td>
					{else}
						<td style="color:red;font-weight:bold;">Store's locker is not password protected<br><br>
						<a href="locker_items_seller.php">Create locker Password now</a>
						</td>
					{/if}
					</tr>

				</table>
			</form>
			</td>
			</tr>
		</table>
		
		
		</div>	

		

		
		<div id="upddiv" style="display:none" class="sellItemmian">
		
		<form  name="frmStore_upd_new" id="frmStore_upd_new" method="post" action="store_info.php" enctype="multipart/form-data" >

		<table cellspacing="2" cellpadding="5" border="0" width="100%">

			<tr>
				<td>{include file='error_msg_template.tpl'}</td>
				<td align="right" style="font-weight:bold"><a href="javascript://" onclick=show_function()>Show Information</a></td>
			</tr>
			<tr>
				<td colspan="2" style="padding:20px;border-color: #D3BCA2 #D3BCA2 -moz-use-text-color;border-style: ridge;">
				<table cellspacing="3" cellpadding="3" border="0">
					
				<tr>
						<td width="120" style="font-weight:bold; vertical-align:top;"> First Name <span class="redClr">*</span>
						</td>
						<td width="200">
							<input type="text" name="f_name" value="{$f_name}" 
							class="required formInput">
						</td>
						<td style="font-weight:bold;padding-left:0px;vertical-align:top;">Last Name</td>
						<td width="200" ><input type="text" name="l_name" value="{$l_name}" class="required formInput"></td>
					</tr>
					<tr><td colspan="4">&nbsp;</td></tr>
					<tr >
						<td style="font-weight:bold;vertical-align:top;">Address1<span class="redClr">*</span></td>
						<td ><input type="text" name="address1" value="{$address1}" class="required formInput"></td>
						<td style="font-weight:bold;vertical-align:top;">Address2</td>
						<td ><input type="text" name="address2" value="{$address2}" class="formInput"></td>
					</tr>
					<tr><td colspan="4">&nbsp;</td></tr>
					<tr>
						<td style="vertical-align:top;font-weight:bold;">Phone1<span class="redClr">*</span></td>
						<td ><input type="text" name="phone1" value="{$phone1}" 
						class="required formInput"></td>
					
						<td style="vertical-align:top;font-weight:bold;">Phone2</td>
						<td ><input type="text" name="phone2" value="{$phone2}" class="formInput"></td>
					</tr>
					<tr>
						<td style="vertical-align:top;font-weight:bold;">City <span 
						class="redClr">*</span></td>
						<td width="200"  ><input type="text" name="city" value="{$city}" class="required formInput"></td>
						<td colspan="2">&nbsp;</td>
					</tr>
					<tr>
						
						<td style="vertical-align:top;font-weight:bold;">State<span class="redClr">*</span></td>
						<td ><input type="text" name="state" value="{$state}" class="required formInput"></td>
						<td colspan="2">&nbsp;</td>
					</tr>
					<tr>
						
						<td style="vertical-align:top;font-weight:bold;">Country</td>
						<td >
						<select class="formSel" name="country_value"  id="country_value">
							{html_options values=$countryID output=$countryName selected=$country_id}
						</select>
						</td>
						<td colspan="2">&nbsp;</td>
					</tr>
					<tr>
						<td style="vertical-align:top;font-weight:bold">Zipcode<span class="redClr">*</span></td>
						<td ><input type="text" name="zipcode" value="{$zipcode}" class="required formInput"></td>
						<td colspan="2">&nbsp;</td>
					</tr>
					<tr><td colspan="4">&nbsp;</td></tr>
					{*
					<tr>
						<td style="vertical-align:top;font-weight:bold">Paypal email<span class="redClr">*</span></td>
						<td ><input type="text" name="paypal_email" value="{$paypal_email}" class="required email formInput"></td>
						<td colspan="2">&nbsp;</td>
					
						
					</tr>
					*}
					<tr>
						<td style="vertical-align:top;font-weight:bold;">Company name <span class="redClr">*</span></td>
						<td ><input type="text" name="company_name" value="{$company_name}" class="required formInput"></td>
						<td colspan="2">&nbsp;</td>
					</tr>
					<tr>
						<td style="vertical-align:top;font-weight:bold">Company address<span class="redClr">*</span></td>
						<td >  <input type="text" name="company_address" value="{$company_address}" class="required formInput"> </td>
						<td colspan="2">&nbsp;</td>
					
						
					</tr>
					<tr>
						<td style="vertical-align:top;font-weight:bold;">Company phone<span class="redClr">*</span></td>
						<td ><input type="text" name="company_phone" value="{$company_phone}" class="required formInput"></td>
						<td colspan="2">&nbsp;</td>
					</tr>
					
					<tr>
						<td style="vertical-align:top;font-weight:bold;">Company desc<span class="redClr">*</span> </td>
						<td ><input type="text" name="company_desc" value="{$company_desc}" class="required formInput"></td>
						<td colspan="2">&nbsp;</td>
					</tr>
					<tr><td colspan="4">&nbsp;</td></tr>
					<!--<tr>
						<td style="vertical-align:top;font-weight:bold">Store name<span class="redClr">*</span></td>
						<td ><input type="text" readonly="true" name="store_name" value="{$store_name}" class="required formInput"></td>
						<td colspan="2">&nbsp;</td>
					</tr>	-->
					
					<tr>
						<td style="vertical-align:top;font-weight:bold">Store Image</td>
						<td ><input name="storeimage" type="file" class="formInput" /></td>
						<td colspan="2">&nbsp;<input type="hidden" name="store_image_upd" value="{$v_store_image}"></td>
					</tr>
					<tr>
						<td style="vertical-align:top;font-weight:bold"></td>
						<td align='left'  >
						<table border='0' width='100%'>
						<tr><td width='10%' valign='top' align='left'><input type='radio' value='1'
						name='make_info_pvt_pub' {if $private_public_store==1}checked{/if} ></td>
						<td width='10%' valign='top' align='left'><b>Private</b></td>
						<td width='10%' valign='top' align='left'>
						<input type='radio' value='0' name='make_info_pvt_pub' {if $private_public_store==0}checked{/if} ></td>
						<td width='70%' valign='top' align='left' ><b>Public</b>  </td>
						
						</tr>
						<tr>
						<td colspan='6' valign='top' align='left' style='font-size:10px;color:red;' > 
						You can restrict   address , city ,zip code and state from displaying publicly by making it private.  </td>
						<!--email ,phone no ,zip code -->
						</tr>
						</table>
					</td>
						<td colspan="2">&nbsp;<input type="hidden" name="store_image_upd" value="{$v_store_image}"></td>
					</tr>
					
					

				</table>
				</td>
			</tr>
			<tr><td align="right"><input type="submit" class='Class_Button_ris' name="submit" value="Update"></td></tr>
		</table>
		
		</form>
		</div>
		
		<!--End inside part -->
	</div>
						<div align="right">
						
						{if $item_id_value!=''}
	
	<a href="upload_imgage.php?item_id_value={$item_id_value}">
	<img src="images/next_btn.jpg" alt="" vspace="8" border="0" /></a>
	{else}
	&nbsp;
	{/if}
		
		
	<!--	</div>

	</div>

	

	</div>

</div>
<div class="clear"></div>
</div>
{*include file="footer.tpl"*}-->
</div>
</div>
<div class="clear"></div>
</div>

{include file="footer.tpl"}

{if $onload && $onload!=""}
<script language="javascript" type="text/javascript">
{$onload}
</script>
{/if}