{include file="header.tpl"}
{include file="header_search.tpl"}
<!--Start Middle-->
<div id="middleMain">
{*include file="left_category.tpl"*}
<!--<div id="middleRtMain">-->
<div>
<!--Start Tab Link-->

<div class="shopmain">
<!--<div style='width:400px;float:left;border:1px solid red;' >-->
<span class="mainHD">My Buyer List</span>
<!--</div>
<div style='width:100px;float:right;border:1px solid red;' >
<a href='#' onclick='history.go(-1)'>Go Back</a>
</div>-->
	<!--Start my items -->
	<div class="myitemmain">
		<div class="myItemtopbg" style='text-align:right;'>
		<a href='#' onclick='history.go(-1)'>Go Back</a>

			<div class="clear"></div>
		</div>
		
		<div class="myiteminsidemain">
		<table width="100%" cellpadding="3" cellspacing="3" border="0" >
		{if $num gt 0}
<tr>
		<td  colspan='6' valign='top'
style="font-weight:bold;font-size:12px;vertical-align:top;align='left'">Note:<span style='font-weight:normal;color:red;font-size:11px;'> Amount below can be balanced amount or amount equal to cost of item.Balanced means(Discounted or haated cost or the amount left after using giftcard. ).</span>
</td></tr>
<tr>
		<td  colspan='6' valign='top' style="font-weight:bold;font-size:12px;vertical-align:top;align='left'">{$page_counter} records
</td></tr>
		<tr>
		<td style="vertical-align:top;">
		<table width="100%" cellpadding="3" celspacing="3" border="0	" align="center" >
		
		<tr>
			<td  style="font-weight:bold;font-size:13px;vertical-align:top;">
				Item Name ( Quantity )			</td>
			<td  style="font-weight:bold;font-size:13px;vertical-align:top;">
				Seller			</td>
			<td  style="font-weight:bold;font-size:13px;vertical-align:top;">Shipped Date&amp;<br>Shipping Service </td>
			<td nowrap style="font-weight:bold;font-size:13px;vertical-align:top;width:100px;">
				Send Message			</td>
			<td nowrap style="font-weight:bold;font-size:13px;vertical-align:top;width:80px">
			<!--( Amount+Giftcard1)<br>+<br>(Giftcard2+ShipCost)-->	Payment History	</td>
			<td  nowrap style="font-weight:bold;font-size:13px;vertical-align:top;">
				Payment/Ship Status			</td>
			<td nowrap style="font-weight:bold;font-size:13px;vertical-align:top;width:70px">
				Purchase Date			</td>
			
			<!--<td  colspan="2" align="" style="font-weight:bold;font-size:13px;vertical-align:top;">
				Action
			</td>-->
		</tr>
		<tr><td colspan="7"></td></tr>
		{section name=cus loop=$citem}
		<tr>
			<td align="left" valign="top" style="font-size:12px;padding-top:8px;">
				{$citem[cus].title|truncate:20}(<span style='font-size:12px;color:red;'>{$citem[cus].quantity}</span>)			</td>
			<td align="left" valign="top" style="font-size:12px;padding-top:8px;">
				{$citem[cus].first_name} {$citem[cus].last_name}({$citem[cus].username})			</td>
			<td align="left" valign="top" style="font-size:12px;padding-top:8px;">
                       {if $anObject->ship_status($citem[cus].s)==1 || $anObject->ship_status($citem[cus].s)==2}
                        {$anObject->ship_date_started($citem[cus].s)|date_format}
                       <br />{$anObject->ship_service($citem[cus].s)|ucfirst}
                      {else}
                     Not Shipped Yet.
                        {/if}
			</td>
			<td align="left" valign="top" style="font-size:12px;padding-top:8px;">
				<a href='contact_seller.php?sellerid={$citem[cus].seller_id}'>Send Message</a>			</td>
			<td align="left" valign="top" style="font-size:12px;padding-top:8px;">
	<b>Amount</b> ={if $citem[cus].amount!='0.00'} {$citem[cus].amount|convert_price}{else}Not Used{/if}<br>
<b>Giftcard1</b> ={if $citem[cus].gift_card1!='0.00'} {$citem[cus].gift_card1|convert_price}{else}Not Used{/if}<br>
<b> Giftcard2</b> ={if $citem[cus].gift_card2!='0.00'} {$citem[cus].gift_card2|convert_price}{else}Not Used{/if}<br>
<b>Shipping Cost </b>={if $citem[cus].ship_cost!='0.00'} {$citem[cus].ship_cost|convert_price}{else}Free{/if}

 <b><!--{$CURRENCY}--></b>			</td>
			<td align="left" valign="top" style="font-size:12px;padding-top:8px;">
				<b><a href="javascript:void(0);">{*if $citem[cus].shipping_status==1*}
				{if $anObject->ship_status($citem[cus].s)==1}
				Shipped but not delivered.
				{/if}
				{if $anObject->ship_status($citem[cus].s)==2}
				Delivered.
				{/if}</b>
				{if $anObject->ship_status($citem[cus].s)==0}
				Paid but not shipped.
				{/if}</a>{if $anObject->ship_status($citem[cus].s)==1}(<a href="buyitem.php?trans_id={$citem[cus].s}"><span style="color:#73B9B9;">Confirm Shipping</span></a>)	
				{/if}
				{if $anObject->ship_status($citem[cus].s)==2}  (<a href="buyer_leave_item_feedback.php"><span style="color:#73B9B9;">Leave Feedback</span></a>	)
				{/if}		</td>
			
			<td style="font-size:12px;padding-top:8px;">
				{$citem[cus].purchase_date|date_format}			</td>
			
			<!--<td style="font-size:12px;padding-top:8px;font-weight:bold;" colspan="2">
				<a href="leavefeedback.php?id={$citem[cus].item_id}&buyid={$citem[cus].buyer_id}&seller_id={$citem[cus].seller_id }">Leave feed-back</a>
				</a> 
			</td>-->
		</tr>
		{/section}
<tr>
			<td colspan='6' style="font-weight:bold;font-size:12px;vertical-align:top;align='left'">
				{$page_counter} records&nbsp;<span style="float:right;">
						{$pageLink}</span>
			</td>
		</tr>
		{else}
		<tr>
			<td style="font-weight:bold;font-size:15px;vertical-align:top;">
				You have not purchase any item..			</td>
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