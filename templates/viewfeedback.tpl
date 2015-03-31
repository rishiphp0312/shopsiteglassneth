{include file="header.tpl"}
{include file="header_search.tpl"}
<!--Start Middle-->
<div id="middleMain">
{*include file="left_category.tpl"*}
<!--<div id="middleRtMain">-->
<div>
<!--Start Tab Link-->

<div class="shopmain">
<span class="mainHD">View Feedback</span>
	<!--Start my items -->
	<div class="myitemmain">
		<div class="myItemtopbg" style='text-align:right;'><a href='#my_account.php' onclick='history.go(-1)' >Go Back</a>&nbsp;
			<div class="clear"></div>
		</div>
		
		<div class="myiteminsidemain">
		<table width="100%" cellpadding="3" cellspacing="3" border="0" >
		
		<tr>
		
		<td style="vertical-align:top;">
		{if $smarty.session.session_user_type =="4"}
		{if $num>0}
		<table width="530" cellpadding="3" cellspacing="3" border="0" align="center" >
		{section name=item loop=$citem}
		<tr>
			<td rowspan="2" align="left" style="font-weight:bold;font-size:13px; vertical-align:top;text-align:center;padding-top:8px;">
				{if $citem[item].feedback=="-1"}
					<span style="color:red;"> ( {$citem[item].feedback} )</span>
				{/if}
				{if $citem[item].feedback=="1"}
					<span style="color:green;"> ( +{$citem[item].feedback} )</span>
				{/if}
				{if $citem[item].feedback=="0"}
					<span style="">( {$citem[item].feedback} )</span>
				{/if}
			</td>
			<td style="vertical-align:top;">
				<span style="font-size:12px;color:#8A5F40;">
<b>{$citem[item].username} </b> </span>: (sent feedback on-<b>{$citem[item].create_date|date_format}</b>
 for <b><a href="item-details.php?details_item_value={$citem[item].item_id}">{$citem[item].title}</a> </b>)
			</td>
                  
		</tr>

		<tr>
			<td style="vertical-align:top;padding-bottom:6px;width:400px;">
			<span style="font-weight:bold; font-size:14px; vertical-align:top;">Comment : </span>
                        <span style="font-size:12px; vertical-align:top;">{$citem[item].comment}.</span>
			</td>
		</tr>
<tr><td colspan='3'style='border-bottom:1px solid ##8A5F40;' ></td></tr>
		{/section}
		</table>
		{else}
			<span style="font-weight:bold; font-size:15px; vertical-align:top;">
                        Item feedback not available..</span>
		{/if}

		{else}

		{if $num>0}
		<table width="530" cellpadding="3" cellspacing="3" border="0" align="center" >
		{section name=item loop=$citem}
		<tr>
			<td rowspan="2" align="left" style="font-weight:bold;font-size:13px; vertical-align:top;text-align:center;padding-top:8px;">
				{if $citem[item].feedback=="-1"}
					<span style="color:red;"><img src="images/negative.gif"></span>
				{/if}
				{if $citem[item].feedback=="1"}
					<span style="color:green;"> <img src="images/positive.gif"></span>
				{/if}
				{if $citem[item].feedback=="0"}
					<span style=""><img src="images/neutral.gif"></span>
				{/if}
			</td>
			<td style="vertical-align:top;">
				<span style="font-size:12px;color:#8A5F40;"> <b> {$citem[item].username} </b> </span>: (sent feedback on-<b>{$citem[item].create_date|date_format}</b> for <b><a href="item-details.php?details_item_value={$citem[item].item_id}">{$citem[item].title}</a> </b>)
			</td>
		</tr>
		<tr>
			<td style="vertical-align:top;padding-bottom:6px;width:400px;">
				<span style="font-weight:bold; font-size:14px; vertical-align:top;"> Comment : </span><span style="font-size:12px; vertical-align:top;"> {$citem[item].comment}.</span>
			</td>
		</tr>
		{/section}
		</table>
		{else}
			<span style="font-weight:bold; font-size:15px; vertical-align:top;">No feedback for Item ..</span>
		{/if}
		{/if}
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