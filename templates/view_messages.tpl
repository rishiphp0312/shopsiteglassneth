{include file="header.tpl"}
{include file="header_search.tpl"}
<!--Start Middle-->
<div id="middleMain">
{*include file="left_category.tpl"*}
<!--<div id="middleRtMain">-->
<div>
<!--Start Tab Link-->

<div class="shopmain">
<span class="mainHD">View Message</span>
	<!--Start my items -->
	<div class="myitemmain">
		<div class="myItemtopbg">
			<span style="padding-left:745px;"><a href="message.php">Go To Inbox</a></span>
			<div class="clear"></div>
		</div>
		
		<div class="myiteminsidemain">
		<table width="100%" cellpadding="3" celspacing="3" border="0" >

		
		<tr>
		<td style="vertical-align:top;">
		<table width="100%" cellpadding="3" celspacing="3" border="0" align="center" >
		<tr>
			<td style="font-weight:bold;font-size:14px;width:15%;">
				Message From:
			</td>
			<td style="font-weight:bold;font-size:12px;color:#8A5F40;">
				{$f_name}-{$l_name} ( {$username} )
			</td>
			<td style=""></td>
		</tr>
		<tr>
			<td style="font-weight:bold;font-size:14px;width:15%;">Subject:</td>
			<td style="font-weight:bold;font-size:12px;color:#8A5F40;">
				{$subject}
			</td>
			<td style=""></td>
		</tr>
		<tr>
			<td style="vertical-align:top;font-weight:bold;font-size:14px;width:15%;">
				Message Body:
			</td>
			<td style="font-weight:normal;font-size:12px;width:70%">
				{$message}
			</td>
			<td style=""></td>
		</tr>
		<tr>
			<td style=""></td>
			<td style="font-weight:bold;font-size:14px;padding:10px;width:70%;color:black;" align="">
				<span style="border:1px solid #8A5F40;padding:5px;"><a href="reply_forward.php?msg_rpl_id={$msg_id}">&nbsp;&nbsp;REPLY&nbsp;</a> </span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="border:1px solid #8A5F40;padding:5px;"><a href="reply_forward.php?msg_fwd_id={$msg_id}">FORWARD</a></span>
			</td>
			<td style=""></td>
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