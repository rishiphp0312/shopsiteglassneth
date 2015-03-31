{include file="header.tpl"}
{include file="header_search.tpl"}
<!--Start Middle-->
<div id="middleMain">
{*include file="left_category.tpl"*}
<!--<div id="middleRtMain">-->
<div>
<!--Start Tab Link-->

<div class="shopmain">
<span class="mainHD">Transation detail page</span>
	<!--Start my items -->
	<div class="myitemmain">
		<div class="myItemtopbg">
			<div class="clear"></div>
		</div>
		
		<div class="myiteminsidemain">
		<table width="100%" cellpadding="3" celspacing="3" border="0" >
		<tr>
			<td>Your details are-</td>
		</tr>
		<tr>
		<td style="vertical-align:top;">
		<table width="730" cellpadding="3" celspacing="3" border="0" align="center" >
		
		<tr>
			<td  style="font-weight:bold;font-size:13px;vertical-align:top;">
				Transaction ID
			</td>
			<td style="font-size:12px;padding-top:8px;">
				{$TRANSACTIONID} 
			</td>
		</tr>
		<tr>
			<td  style="font-weight:bold;font-size:13px;vertical-align:top;">
				Amount
			</td>
			<td style="font-size:12px;padding-top:8px;">
				{$AMT} {$CURRENCY}
			</td>
		</tr>
		<tr>
			<td  style="font-weight:bold;font-size:13px;vertical-align:top;">
				AVS Code
			</td>
			<td style="font-size:12px;padding-top:8px;">
				{$AVSCODE} 
			</td>
		</tr>
		<tr>
			<td  style="font-weight:bold;font-size:13px;vertical-align:top;">
				CVV2
			</td>
			<td style="font-size:12px;padding-top:8px;">
				{$CVV2MATCH} 
			</td>
		</tr>
		<tr>
			
		</tr>
		
		</table>
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