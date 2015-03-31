{include file="header.tpl"}
{include file="header_search.tpl"}
<!--Start Middle-->
<div id="middleMain">
{*include file="left_category.tpl"*}
<!--<div id="middleRtMain">-->
<div>
<!--Start Tab Link-->

<div class="shopmain">
<span class="mainHD">Leave Feedback</span>
	<!--Start my items -->
	<div class="myitemmain">
		<div class="myItemtopbg">
			<div class="clear"></div>
		</div>
		
		<div class="myiteminsidemain">
		<table width="100%" cellpadding="3" celspacing="3" border="0" >
		{if $num gt 0}
		<tr>
		<td style="vertical-align:top;">
		<table width="100%" cellpadding="3" celspacing="3" border="0	" align="center" >
		
		<tr>
			<td  style="font-weight:bold;font-size:13px;vertical-align:top;">
				Item
			</td>
			<td  style="font-weight:bold;font-size:13px;vertical-align:top;">
				Seller
			</td>
			<td nowrap style="font-weight:bold;font-size:13px;vertical-align:top;width:100px;">
				Seller E-mail
			</td>
			<td nowrap style="font-weight:bold;font-size:13px;vertical-align:top;width:50px">
				Paid Amount
			</td>
			<td  nowrap style="font-weight:bold;font-size:13px;vertical-align:top;">
				Payment/Ship Status 
			</td>
			<td nowrap style="font-weight:bold;font-size:13px;vertical-align:top;width:100px">
				Purchase Date
			</td>
			
			<td  colspan="2" align="" style="font-weight:bold;font-size:13px;vertical-align:top;">
				Action
			</td>
			
		</tr>
		<tr><td colspan="6"></td></tr>
		{section name=cus loop=$citem}
		{if $citem[cus].feedback_status!="1"}
		<tr>
			<td style="font-size:12px;padding-top:8px;">
				{$citem[cus].title} 
			</td>
			<td style="font-size:12px;padding-top:8px;">
				{$citem[cus].first_name} {$citem[cus].last_name}({$citem[cus].username})
			</td>
			<td style="font-size:12px;padding-top:8px;">
				 {$citem[cus].email}
			</td>
			<td style="font-size:12px;padding-top:8px;">
				{$citem[cus].amount} <b>{$CURRENCY}</b>
			</td>
			<td style="font-size:12px;padding-top:8px;">
				<b><a href="javascript:void(0);">{if $citem[cus].shipping_status==1}
				Paid and shipped
				{else}
				paid but not ship..
				{/if}</a></b>
			</td>
			
			<td style="font-size:12px;padding-top:8px;">
				{$citem[cus].purchase_date|date_format}
			</td>
			
			<td style="font-size:12px;padding-top:8px;font-weight:bold;" colspan="2">
				<a href="leavefeedback.php?id={$citem[cus].s}&itemid={$citem[cus].item_id}&buyid={$citem[cus].buyer_id}&seller_id={$citem[cus].id}">Leave feed-back</a> 
				</a> 
			</td>
			
			
		</tr>{/if}
		{/section}
		{else}
		<tr>
			<td style="font-weight:bold;font-size:15px;vertical-align:top;">
				You have not purchase any item..
			</td>
		</tr>
		{/if}
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