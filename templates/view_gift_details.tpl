{include file="header.tpl"}
{include file="header_search.tpl"}
<!--Start Middle-->
<div id="middleMain">
{*include file="left_category.tpl"*}
<!--<div id="middleRtMain">-->
<div>
<!--Start Tab Link-->

<div class="shopmain">
<span class="mainHD">My Gift Card</span>
	<!--Start my items -->
	<div class="myitemmain">
		<div class="myItemtopbg">
			<div style='float:left;'>
			<span style="font-size:11px;">Information about all gift card's which has been purchased from me...</span>
			</div>
			<div  style='float:right;'>
			<a href='#my_account.php' onclick='history.go(-1)'>Go Back</a>
			</div>
			<div class="clear"></div>
		</div>
		
		<div class="myiteminsidemain">
		<table width="100%" cellpadding="3" celspacing="3" border="0" >
		{if $num gt 0}
		<tr>
		<td style="vertical-align:top;">
		<table width="100%" cellpadding="3" celspacing="3" border="0"  >
		
		<tr>
			<td  style="font-weight:bold;font-size:13px;vertical-align:top;width:120px;">Serial No </td>
			<td  style="font-weight:bold;font-size:13px;vertical-align:top;width:120px;">Receiver Name</td>
			<td  style="font-weight:bold;font-size:13px;vertical-align:top;width:200px;">
				Receiver Email			</td>
			<td style="width:150px;font-weight:bold;font-size:13px;vertical-align:top;width:100px;">
				 City			</td>
			<td nowrap style="font-weight:bold;font-size:13px;vertical-align:top;width:100px">
				 State			</td>
			<td nowrap style="font-weight:bold;font-size:13px;vertical-align:top;width:100px">
				Remaining Amount			</td>
			
			<td  align="" style="font-weight:bold;font-size:13px;vertical-align:top;">
				Send Date			</td>
			<!--<td  align="" style="font-weight:bold;font-size:13px;vertical-align:top;">
				Secret code
			</td>-->
			<!--<td  align="" style="font-weight:bold;font-size:13px;vertical-align:top;">
				Status
			</td>-->
		</tr>
		<tr><td colspan="9" ></td></tr>
		{section name=cus loop=$citem}
		<tr>
			<td style="font-size:12px;padding-top:4px;width:120px;">
			{if $smarty.request.pageNumber!="" && $smarty.request.pageNumber>1}
		  {assign var=pageconut value=$smarty.request.pageNumber-1}
		  {$smarty.const.ADMIN_PAGE_NUMBER*$pageconut+$smarty.section.cus.iteration}.
		  {else}
		  {$smarty.section.cus.iteration}.
		  {/if}
			
			
							</td>
			<td style="font-size:12px;padding-top:4px;width:120px;">{if $citem[cus].recivername!=''}{$citem[cus].recivername|ucfirst}{else}
			{$citem[cus].name|ucfirst}{/if}</td>
			<td style="font-size:12px;padding-top:4px;width:200px;">
				{$citem[cus].reciveremail}			</td>
			<td style="font-size:12px;padding-top:4px;">
				{if $citem[cus].recivercity!=''} {$citem[cus].recivercity}	{else}NA{/if}		</td>
			<td style="font-size:12px;padding-top:4px;">
				{if $citem[cus].reciverstate!=''} {$citem[cus].reciverstate}	
				{else}NA{/if}
				
						</td>
			
			<td style="font-size:12px;padding-top:4px;">
				{$citem[cus].reciveramount} <b>{$CURRENCY}</b>			</td>
			
			<td style="font-size:12px;padding-top:4px;">
				{$citem[cus].create_date|date_format}			</td>

			<!--<td style="font-size:12px;padding-top:4px;color:#996633">
				{$citem[cus].giftcardnumber}
			</td>-->
			
			<!--<td style="font-size:12px;padding-top:4px;font-weight:bold;">
				{if $citem[cus].gift_card_amount_alter_date!='0000-00-00 00:00:00'}
					<span style="color:green">Used at </span>
					{$citem[cus].gift_card_amount_alter_date|date_format}
				
				{else}
					<span style="color:red">Still Not Used </span>
				{/if}
				
			</td>-->
		</tr>
		{/section}
		<tr>
		<td colspan="7">&nbsp;
		</td></tr>
		<tr>
		<td colspan="7">
		<table align="center" cellpadding="0" cellspacing="0" border="0" width="100%">
		<tr>
			<td  style="font-weight:400;font-size:12px;vertical-align:top;color:#9C4E4E;">
				{$page_counter} records </td><td align="right" style="float:right;border:0px solid red;">
						{$pageLink}</span>
			</td>
		</tr>
		</table>
		</td>
		</tr>
		{else}
		<tr>
			<td colspan="7" style="font-weight:bold;font-size:15px;vertical-align:top;">
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