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
		<div class="myItemtopbg">
			<div class="clear"></div>
		</div>
		
		<div class="myiteminsidemain">
		<table width="100%" cellpadding="3" cellspacing="3" border="0" >
	        <tr><td align='right' >
<a href='#my_account.php' onclick='history.go(-1)'>Go Back</a></td></tr>
		{if $num gt 0}
		<tr>
		<td style="vertical-align:top;">
		<form action="seller_custom_request.php" method="post">
		<table width="800" border="0" align="center" cellpadding="4" cellspacing="1" style=background-color:#616D7E;" >
	
		<tr  align="left" valign="top" style="background-color:#AFC7C7;">
			<td  style="font-weight:bold;font-size:13px;vertical-align:top;">
				Title			</td>
			<td  style="font-weight:bold;font-size:13px;vertical-align:top;">
				From			</td>
			<td  style="font-weight:bold;font-size:13px;vertical-align:top;">
				Ideal Price			</td>
			<td  style="font-weight:bold;font-size:13px;vertical-align:top;">
				Quantity			</td>
			<td  style="font-weight:bold;font-size:13px;vertical-align:top;">
				Dead-line			</td>
			<td  style="font-weight:bold;font-size:13px;vertical-align:top;">
				Apply date			</td>
			
			<td  style="font-weight:bold;font-size:13px;vertical-align:top;">
				Set Advance %			</td>
			
			<td  colspan="2" style="font-weight:bold;font-size:13px;vertical-align:top;">
				Action & Status			</td>
		</tr>
				{section name=cus loop=$citem}
		<tr align="left" valign="top"style="background-color:#ffffff;">
			
			<td style="font-size:12px;padding-top:8px;">
				<a href="view_profile_custom_user.php?id={$citem[cus].id|base64_encode}&buyid={$citem[cus].user_id|base64_encode}">{$citem[cus].title}</a>			</td>
			<td style="font-size:12px;padding-top:8px;">
				{$citem[cus].firstname}&nbsp;{$citem[cus].lastname}			</td>
			<td style="font-size:12px;padding-top:8px;">
				USD&nbsp;{$citem[cus].price}			</td>
			<td style="font-size:12px;padding-top:8px;">
				{$citem[cus].quantity}			</td>
			<td style="font-size:12px;padding-top:8px;">
				{$citem[cus].deadline}			</td>
			<td style="font-size:12px;padding-top:8px;">
				{$citem[cus].create_date|date_format}			</td>
			
			<td style="font-size:12px;padding-top:8px;text-align:center;">
			{if $citem[cus].agreestatus=="1"}
				{$citem[cus].advancepersantage}%
				
			{else}
				Not fix..
			{/if}</td>
			
			<td colspan="2" style="font-size:12px;padding-top:8px;font-weight:bold;">
				<input type="hidden" name="titleid1" value="{$citem[cus].id}">
				{if $citem[cus].agreestatus!="1"}
				<a href="seller_fix_persentage_amount.php?titleid={$citem[cus].id}">Accept</a>
				{else}
					{if $citem[cus].paymentstatus=="1"}
					{if $citem[cus].fully_prepared=="0" || $citem[cus].fully_prepared==""}
                                            <a style="color:green;" href="sell-an-item.php?id={$citem[cus].id}" >
							Create Item
						</a>


                                                {else}

                                          Process Completed
                        <br>{if $citem[cus].locker_status==0 || $citem[cus].locker_status==""}

                                <b>  ( Item is in Items List.)</b>
                                {else}
                                <b>  ( Item is in Locker.)</b>
				{/if}
                                            
                                                {/if}
                                
					{else}
						<span style="color:red;">Confirmed but not Paid </span>
					{/if} 
				{/if}

			</td>
		</tr>
		{/section}
 {if $num>0}
                        <tr style="background-color:#ffffff;">
			<td colspan='9' style="font-weight:bold;font-size:15px;vertical-align:top;">
			{$pageLink}</td></tr>
{/if}
		{else}
                  
<tr style="background-color:#ffffff;">
			<td style="font-weight:bold;font-size:15px;vertical-align:top;" >
				No request for custom item..
			</td>
		</tr>
		{/if}
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