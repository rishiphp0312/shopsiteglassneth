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
	<div class="myitemmain"  style='text-align:right'>
	<a href='#my_account.php' onclick='history.go(-1)'>Go Back</a>
		<div class="myItemtopbg" >
			<div class="clear"></div>
		</div>
		
		<div class="myiteminsidemain">
		<table width="100%" cellpadding="3" celspacing="3" border="0" >
		{if $num gt 0}

<tr>
		<td  colspan='7' valign='top'
style="font-weight:bold;font-size:12px;vertical-align:top;align='left'">{$page_counter} records
</td></tr>
		<tr>
		<td style="vertical-align:top;">
		<table width="100%" cellpadding="3" cellspacing="1" bgcolor='#EFEFEF'  border="0" align="left" >
		
		<tr  bgcolor='#EFEFEF' >
			<td width="20%"  style="text-align:center;font-weight:bold;font-size:13px;vertical-align:top;">
				Item
			</td>
			<td width="20%"  style="text-align:center;font-weight:bold;font-size:13px;vertical-align:top;">
				Seller
			</td>			
			<td width="15%"  nowrap style="text-align:center;font-weight:bold;font-size:13px;vertical-align:top;width:120px;
			">
				Paid Amount
			</td>
			<td  width="15%"  nowrap style="text-align:center;font-weight:bold;font-size:13px;vertical-align:top;">
				Payment/Ship Status 
			</td>
			<td width="15%"  nowrap style="text-align:center;font-weight:bold;font-size:13px;vertical-align:top;width:100px">
				Purchase Date
			</td>
			
			<td width="15%"  colspan="2" align="center" style="text-align:center;font-weight:bold;font-size:13px;vertical-align:top;">
				Action
			</td>
			
		</tr>
		
		{section name=cus loop=$citem}
		{if $citem[cus].feedback_status!="1"}
		<tr  bgcolor='#ffffff' >
			<td style="font-size:12px;padding-top:8px;text-align:center;">
			{*$smarty.iteration.cus*}&nbsp;&nbsp;&nbsp;	{$citem[cus].title}
			</td>
			<td style="font-size:12px;padding-top:8px;text-align:center;">
				{$citem[cus].first_name} {$citem[cus].last_name}({$citem[cus].username})
			</td>
	
			<td style="font-size:12px;padding-top:8px;text-align:center;">
				{$citem[cus].amount|convert_price}<!-- <b>{$CURRENCY}</b>-->
			</td>
			<td style="font-size:12px;padding-top:8px;text-align:center;">
{*if $anObject->ship_status($citem[cus].s)*}
{*if $citem[cus].shipping_status==1*}
				<b>
				<a href="javascript:void(0);">
				{if $anObject->ship_status($citem[cus].s)==0}
				Paid but not shipped.
				{/if}
                            {if $anObject->ship_status($citem[cus].s)==1}
				Shipped but not delivered.
				{/if}
				{if $anObject->ship_status($citem[cus].s)==2}
				Paid and delivered.
				{/if}</a></b>&nbsp;
			</td>
			
			<td style="font-size:12px;padding-top:8px;text-align:center;">
				{$citem[cus].purchase_date|date_format}
			</td>
			
			<td colspan=2 style="font-size:12px;padding-top:8px;font-weight:bold;text-align:center;" colspan="2">
				<a href="leavefeedback.php?id={$citem[cus].s}&itemid={$citem[cus].item_id}&buyid={$citem[cus].buyer_id}&seller_id={$citem[cus].seller_id}">Leave feed-back</a>
				</a> 
			</td>
			
			
		</tr>{/if}
		{/section}
<tr>
			<td colspan='7'bgcolor='#ffffff' style="text-align:center;font-weight:bold;font-size:12px;vertical-align:top;align='left'">
				{$page_counter} records&nbsp;<span style="float:right;">
						{$pageLink}</span>
			</td>
		</tr>

		{else}
		<tr>
			<td colspan='7' style="text-align:center;font-weight:bold;font-size:15px;vertical-align:top;">
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