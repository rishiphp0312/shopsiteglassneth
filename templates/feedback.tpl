{include file="header.tpl"}
{include file="header_search.tpl"}
<!--Start Middle-->
<div id="middleMain">
{*include file="left_category.tpl"*}
<!--<div id="middleRtMain">-->
<div>
<!--Start Tab Link-->

<div class="shopmain">
<span class="mainHD">Seller's History</span>
	<!--Start my items -->
	<div class="myitemmain">
		<div class="myItemtopbg">
			<div class="clear"></div>
		</div>
		
		<div class="myiteminsidemain">
		<table width="700" cellpadding="3" celspacing="3" border="0" >
		
		<tr>
		<td style="vertical-align:top;border:1px solid #CC66FF;">
		
		<table width="300" cellpadding="3" celspacing="3" border="0"  >
		<tr>
			<td  style="font-weight:bold;font-size:13px; vertical-align:top;">
				{if $username!=""}
					{$username} ( {$num} )
				{else}
					{$username1} ( {$num} ) 
				{/if} 
			</td>
			<td  style="font-weight:bold;font-size:12px; vertical-align:top;">
			</td>
		</tr>
		<tr>
			<td  style="font-weight:bold;font-size:13px; vertical-align:top; ">
				Registered user since:
			</td>
			<td  style="font-size:12px; vertical-align:top;">
				{if $regdt!=""}
					{$regdt|date_format} 
				{else}
					{$regdt1|date_format} 
				{/if} 
			</td>
		</tr>
		<tr>
			<td  style="font-weight:bold;font-size:13px; vertical-align:top; ">
				From
			</td>
			<td  style="font-size:12px; vertical-align:top;">
				{if $user_country_name!=""}
					{$user_country_name} 
				{else}
					{$user_country_name1} 
				{/if} 
			</td>
		</tr>
		<tr>
			<td  style="font-weight:bold;font-size:13px; vertical-align:top;">
				Total feedback recived
			</td>
			<td  style="font-size:12px; vertical-align:top;">
				{$num}
			</td>
		</tr>
		</table>
		
		</td>
		<td></td>
		<td style="vertical-align:top;border:1px solid #CC66FF;">
			<table width="400" cellpadding="3" celspacing="3" border="0"  >
			<tr>
				<td colspan="4" style="text-align:center;font-weight:bold;font-size:13px; vertical-align:top;">
					Recent Feedback
				</td>
				
			</tr>
			<tr>
				<td  style="font-weight:bold;font-size:13px; vertical-align:top; ">
					
				</td>
				<td  style="font-weight:bold;color:green;font-size:14px; vertical-align:top;">
				<img src="images/positive.gif">
				</td>
				<td  style="font-size:14px;font-weight:bold;color:black; vertical-align:top;">
				<img src="images/neutral.gif">
				</td>
				<td  style="font-size:14px;font-weight:bold;color:red; vertical-align:top;">
				<img src="images/negative.gif">
				</td>
			</tr>
			<tr><td bgcolor="#eeeeee" colspan="4" ></td>
			<tr>
				<td  style="font-weight:bold;font-size:13px; vertical-align:top; ">
					Last Month
				</td>
				<td  style="font-size:12px; font-weight:bold; vertical-align:top; color:green;">
					{$lastpositive}
				</td>
				<td  style="font-size:14px;font-weight:bold;color:black; vertical-align:top;">
					{$lastnutral}
				</td>
				<td  style="font-size:14px;font-weight:bold;color:red; vertical-align:top;">
					{$lastnegative}
				</td>
			</tr>
			<tr>
				<td  style="font-weight:bold;font-size:13px; vertical-align:top;">
				Last Six Months 	
				</td>
				<td  style="font-size:12px; font-weight:bold; vertical-align:top; color:green;">
					{$sixpositive}
				</td>
				<td  style="font-size:14px;font-weight:bold;color:black; vertical-align:top;">
					{$sixnutral}
				</td>
				<td  style="font-size:14px;font-weight:bold;color:red; vertical-align:top;">
					{$sixnegative}
				</td>
			</tr>
			<tr>
				<td  style="font-weight:bold;font-size:13px; vertical-align:top;width:150px; ">
					Last Twelve Months
				</td>
				<td  style="font-size:12px; font-weight:bold; vertical-align:top; color:green;">
					{$onepositive}
				</td>
				<td  style="font-size:14px;font-weight:bold;color:black; vertical-align:top;">
					{$onenutral}
				</td>
				<td  style="font-size:14px;font-weight:bold;color:red; vertical-align:top;">
					{$onenegative}
				</td>
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