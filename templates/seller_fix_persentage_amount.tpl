{include file="header.tpl"}
{include file="header_search.tpl"}
<!--Start Middle-->
<div id="middleMain">
{*include file="left_category.tpl"*}
<!--<div id="middleRtMain">-->
<div>
<!--Start Tab Link-->

<div class="shopmain">
<span class="mainHD">Set Percentage here for item</span>
	<!--Start my items -->
	<div class="myitemmain">
		<div class="myItemtopbg">
			<div class="clear"></div>
		</div>
		
		<div class="myiteminsidemain">
		<table width="100%" cellpadding="3" celspacing="3" border="0" >
		
		<tr>
		<td style="vertical-align:top;">
		<form action="seller_fix_persentage_amount.php" method="post">
		<table width="630" cellpadding="3" celspacing="3" border="0" align="center" >
		<tr>
			<td colspan="2">The item is - <b>{$title}</b> and the final amount for each quantity of this item is - <b>$ {$price} </b><br> 
			The deadline of this item is <b>{$deadline} USD</b> and total number or quantities are - <b>{$quantity} . </b><br>
			<br>	
			Here you can fix your percentage in form of advance money.<br>
			<br></td>
			
		</tr>
		<tr>
			<td width="150" style="font-size:12px;font-weight:bold;"> Fix percentage Amount :</td>
			<td >
				<select name="adpersantage">
					<option value="5">5</option>
					<option value="10">10</option>
					<option value="15">15</option>
					<option value="20">20</option>
					<option value="25">25</option>
					<option value="30">30</option>
					<option value="35">35</option>
					<option value="40">40</option>
					<option value="45">45</option>
					<option value="50">50</option>
				</select>
			
			</td>
		</tr>
		
		<tr><td><input type="hidden" name="titleid" value="{$titleid}"></td><td><input type="submit" name="submit" value="SET PERCENTAGE"></td></tr>
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