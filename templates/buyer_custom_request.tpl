{include file="header.tpl"}
{include file="header_search.tpl"}
<!--Start Middle-->
<div id="middleMain">
{*include file="left_category.tpl"*}
<!--<div id="middleRtMain">-->
<div>
<!--Start Tab Link-->

<div class="shopmain">
<span class="mainHD">My Custom Item Request</span>
	<!--Start my items -->
	<div class="myitemmain">
		<div class="myItemtopbg" style='text-align:right;'><a href='#my_account.php' onclick='history.go(-1)'>Go Back</a>
			<div class="clear"></div>
		</div>
		
		<div class="myiteminsidemain">
		<table width="100%" cellpadding="3" cellspacing="3" border="0" >
		{if $num gt 0}
		<tr>
		<td style="vertical-align:top;">
		<table width="830" border="0" bgcolor='#737CA1' align="center" cellpadding="3" cellspacing="1" >
		<!--98AFC7-->
		<tr align="left" valign="top" height='30'BGCOLOR="#AFC7C7" >
			<td  style="font-weight:bold;font-size:13px;vertical-align:top;">
				To			</td>
			<td  style="font-weight:bold;font-size:13px;vertical-align:top;">Advance Amount Paid </td>
			<td  style="font-weight:bold;font-size:13px;vertical-align:top;width:100px;">
				Title			</td>
			<td  style="font-weight:bold;font-size:13px;vertical-align:top;width:50px">
				Price			</td>
			<td  style="font-weight:bold;font-size:13px;vertical-align:top;">
				Requested Quantity			</td>
			<td  style="font-weight:bold;font-size:13px;vertical-align:top;width:100px">
				Dead-line			</td>
			<td  style="font-weight:bold;font-size:13px;vertical-align:top;width:100px">
				Apply date			</td>
			<td  colspan="2" style="font-weight:bold;font-size:13px;vertical-align:top;">
				Action			</td>
		</tr>
		<!--<tr bgcolor='#ffffff' align="left" valign="top" >
		<td colspan='8' >&nbsp;</td>
                </tr>-->
		{section name=cus loop=$citem}
		<tr bgcolor='#ffffff'HEIGHT='40' >
			<td valign="MIDDLE" nowrap style="font-size:12px;width:110px;border:0px solid red;">
				{$citem[cus].firstname} {$citem[cus].lastname}&nbsp;({$citem[cus].username})			</td>
			<td valign="MIDDLE" nowrap style="font-size:12px;width:110px;border:0px solid red;">&nbsp;{if $citem[cus].paid_amount!=''} &nbsp;{$citem[cus].paid_amount|convert_price}{else}Not Paid Yet {/if}</td>
			<td nowrap align="left" valign="MIDDLE" style="font-size:12px;">
				<a href="view_profile_custom_user.php?id={$citem[cus].cust_item_id|base64_encode}&buyid={$citem[cus].user_id|base64_encode}">{$citem[cus].title}</a></td>
			<td nowrap valign="MIDDLE" style="font-size:12px;">
				{$citem[cus].price|convert_price}			</td>
			<td valign="MIDDLE" style="font-size:12px;text-align:center;">
				{$citem[cus].quantity}			</td>
			<td valign="MIDDLE" style="font-size:12px;border:0px solid red;">
				{$citem[cus].deadline}			</td>
			<td valign="MIDDLE" style="font-size:12px;border:0px solid red;">
				{$citem[cus].create_date|date_format}			</td>
			<td valign="MIDDLE" nowrap style="font-size:12px;font-weight:bold;"
 colspan="2">
<a href="view_profile_custom_user.php?id={$citem[cus].id|base64_encode}&buyid={$citem[cus].user_id|base64_encode}"> View Detail</a>|
{if $citem[cus].agreestatus=="1"}
				Confirmed 
			{if $citem[cus].paymentstatus==1}and Paid
			{else}
			<a  href="advance_aggrement.php?itemid={$citem[cus].id}&buyerid={$citem[cus].user_id|base64_encode}">
				Go for advance payment			</a>
			{/if} 
			{else}
			In-Process
			{/if}
				</a>
{if $citem[cus].fully_prepared==1 && $anObject->custom_item_id($citem[cus].id)!='' && $anObject->custom_item_id_quantitypurchased($citem[cus].id)!=0 && 
$anObject->custom_item_id_quantitypurchased($citem[cus].id)!=''}
 <a href='item-details.php?details_item_value={$anObject->custom_item_id($citem[cus].id)}'>Buy Now </a>({$anObject->custom_item_id_quantitypurchased($citem[cus].id)} Items in Stock)
            {/if}			</td>
		</tr>
		{/section}
		{else}
		<tr>
			<td colspan="2" style="font-weight:bold;font-size:15px;vertical-align:top;">
				No request for custom item..			</td>
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