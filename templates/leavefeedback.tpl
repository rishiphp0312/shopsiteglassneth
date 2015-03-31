{include file="header.tpl"}
{include file="header_search.tpl"}
<!--Start Middle-->
<div id="middleMain">
{*include file="left_category.tpl"*}
<!--<div id="middleRtMain">-->
<div>
<!--Start Tab Link-->

<div class="shopmain">
<span class="mainHD">Leave feedback</span>
<span style='text-align:right;float:right;padding-right:10px;'><a href='#' onclick='history.go(-1)' >Go Back</a></span>

	<!--Start my items -->
	<div class="myitemmain">
		<div class="myItemtopbg">
			<div class="clear"></div>
		</div>
		
		<div class="myiteminsidemain">
		<table width="100%" cellpadding="3" celspacing="3" border="0" >
		<tr>
		<td style="vertical-align:top;">
		<form name="frmFeedback" method="post" action="leavefeedback.php">
		<table width="530" cellpadding="3" celspacing="3" border="0" align="center" >
		
		<tr>
			<td  style="font-weight:bold;font-size:13px;vertical-align:top;width:80px;">
				To
			</td>
			<td colspan="3" style="font-weight:bold;font-size:13px; vertical-align:top;width:100px;">
				{$f_name} {$l_name} ({$username})
			</td>
		</tr>
		<tr>
			<td  style="font-weight:bold;font-size:13px;vertical-align:top;width:80px;">
				Item
			</td>
			<td colspan="3" style="font-weight:bold;font-size:13px; vertical-align:top; width:100px;">
				{$title}
			</td>
		</tr>
		<tr>
			<td  style="font-weight:bold;font-size:13px; vertical-align:top; width:80px;">	Opinion	</td>
			<td  style="color:green;font-weight:bold;font-size:13px; vertical-align:top; width:100px;">
				<input type="radio" name="rate" value="1" {if $feedback=="1"}checked{/if} >Positive(+1)</td>
			<td style="font-weight:bold;font-size:13px; vertical-align:top;width:100px;">
				<input type="radio" name="rate" value="0" {if $feedback=="0"}checked{/if}>Neutral(0)
			</td>
			<td style="color:red;font-weight:bold;font-size:13px; vertical-align:top; width:100px;">
				<input type="radio" name="rate" value="-1" {if $feedback=="-1"}checked{/if}>Negative(-1)
			</td>
	
		</tr>
		<tr>
			<td  style="font-weight:bold;font-size:13px;vertical-align:top;width:80px;">
				Comment
			</td>
			<td colspan="3" style="font-weight:bold;font-size:13px; vertical-align:top; ">
				<textarea cols="75" rows="5" name="feedback">{$comment}</textarea>
			</td>
		</tr>
		<tr>
			<td>
				<input type="hidden" name="purchase_date" value="{$purchase_date}">
				<input type="hidden" name="itemid" value="{$itemid}">
				<input type="hidden" name="sellerid" value="{$seller_id}">
				<input type="hidden" name="buyerid" value="{$buyid}">
				<input type="hidden" name="feedbackid" value="{$feedbackid}">
			</td>
			<td colspan="3" style="padding:10px;	font-weight:bold;font-size:13px; vertical-align:top; ">
				<input type="submit" name="submit" value="Post">
			</td>
		</tr>
	
		
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