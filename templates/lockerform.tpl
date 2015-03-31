{include file="header.tpl"}
{include file="js_css_validation.tpl"}
{include file="header_search.tpl"}
<!--Start Middle-->
<div id="middleMain">
{*include file="left_category.tpl"*}
<!--<div id="middleRtMain">-->
<div>
<!--Start Tab Link-->

<div class="shopmain">
<span class="mainHD">Seller's Locker</span>
	<!--Start my items -->
	<div class="myitemmain">
		<div class="myItemtopbg">
			<div class="clear"></div>
		</div>
		
		<div class="myiteminsidemain">
		<table width="100%" cellpadding="3" celspacing="3" border="0" >
		
		<tr>
		<td style="vertical-align:top;">
		<form name="frmLocker" id="frmLocker" method="post" action="">
		<table width="630" cellpadding="6" celspacing="3" border="0" align="center" >
		<tr>
			<td colspan="4" style="font-weight:bold;color:red;font-size:13px; vertical-align:top; ">
				{$error_msg}
			</td>
		</tr>
		<tr>
			<td colspan="4" style="font-weight:normal;font-size:13px; vertical-align:top; ">
				You are going to access the <b><u>Locker Area</u></b> of <b>{$username}</b> <br> this store is registered to <b>{$f_name}-{$l_name} </b><br><span style="color:#8A5F40;font-weight:bold;">For accessing this locker please enter the access code...</span><br><br>
			</td>
		</tr>
		<tr>
			<td  style="font-weight:bold;font-size:13px;vertical-align:top;width:150px;">
				Enter Locker Password
			</td>
			<td colspan="3" style="font-weight:bold;font-size:13px; vertical-align:top; ">
				<input type="password" name="loc_pass" class="required formInput" >
			</td>
		</tr>
		<tr>
			<td> 
				<input type="hidden" name="purchase_date" value="{$purchase_date}">
				<input type="hidden" name="sellerid" value="{$sellerid}">
				<input type="hidden" name="locker_last_date" value="{$locker_last_date}">
			</td>
			<td colspan="3" style="padding:10px;	font-weight:bold;font-size:13px; vertical-align:top; ">
				<input type="submit" name="submit" value="GET LOCKER">
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