{include file="header.tpl"}
{include file="header_search.tpl"}
<!--Start Middle-->
<div id="middleMain">
{*include file="left_category.tpl"*}
<!--<div id="middleRtMain">-->
<div>
<!--Start Tab Link-->

<div class="shopmain">
<span class="mainHD">View Locker Items</span>
	<!--Start my items -->
	<div class="myitemmain">
		<div class="myItemtopbg">

			<!--start page number -->
		{$store_name}
			<!--end page number -->
			<div class="clear"></div>
		</div>

		<div class="myiteminsidemain">
		<table width="100%" cellpadding="2" cellspacing="2" border="0" >
		<tr>
		<td style="vertical-align:top;">
                {if $no_records>0}
		<table align='left' cellpadding='0'  cellspacing='0' width='670px;' border='0' >
	<tr>
	{foreach name=cat from=$users_items_details item=val_items}
		<td width='153' >
		{if $smarty.request.pageNumber!="" && $smarty.request.pageNumber>1}
			{*assign var=pageconut value=$smarty.request.pageNumber-1*)
		{else}
			{ *$smarty.foreach.cat.iteration*}
		{/if}
		<table align='center' cellpadding='0'  cellspacing='0' width='140px;' border='0' >
			<tr><td colspan='4'>&nbsp;</td></tr>
			<tr>
				<td align='center' valign='top' height='100'style='border:1px solid #cccccc;padding:5px;' >
					<a href="javascript:void()" >
					<img src="{$baseUrl}getthumb.php?w=150&h=100&fromfile={if $val_items.image1!=''}uploads/{$val_items.image1}" {else}images/no_img.jpg{/if}" alt="" border="0" class="buyerimg"/> </a>
				</td>
			</tr>
			<tr>
				<td align='center' valign='top' class="productNme">
					<a href="javascript:void();" >
						{$val_items.title|ucfirst}
					</a>
				</td>
			</tr>
			<tr>
				<td align='center' valign='top' class="priceText">
					Price &nbsp;:&nbsp;
					<span>{$USD}&nbsp;{$val_items.cost_item|number_format:2:".":","} </span>
				</td>
			</tr>
			<tr>
				<td align="left" valign="top" >
				<table align='center' cellpadding='0'  cellspacing='0' width='140px;' border='0' >
					<tr>
						<td align='left' valign='top' class="buynow">
							{if $val_items.locker_buyer==$smarty.session.session_user_id}
							<a href="item-details.php?details_item_value={$val_items.item_id}"  >
							<img src="images/buy_bow_icon.jpg" alt="" border="0" /></a>
							<a href="item-details.php?details_item_value={$val_items.item_id}" > Buy now</a>			<td align='right' valign='top'><span class="detailfr">
							<a href="item-details.php?details_item_value={$val_items.item_id}" >
							<img src="images/details_btn.jpg" alt="" border="0" /></a></span>
						</td>
							{elseif $val_items.locker_permission=="1"}
							<a href="item-details.php?details_item_value={$val_items.item_id}"  >
							<img src="images/buy_bow_icon.jpg" alt="" border="0" /></a>
							<a href="item-details.php?details_item_value={$val_items.item_id}" > Buy now</a>

						</td>
						<td align='right' valign='top'><span class="detailfr">
							<a href="item-details.php?details_item_value={$val_items.item_id}" >
							<img src="images/details_btn.jpg" alt="" border="0" /></a></span>
						</td>
						{else}
						{/if}
					</tr>
				</table>
				</td>
			</tr>
		</table>
		</td>
		{if $smarty.foreach.cat.iteration%4==0}
		</tr>
		<tr>
			<td colspan='4'>&nbsp;</td>
		</tr>
		<tr>
		{/if}
		{/foreach}
		</tr>
<tr>
			<td colspan='4'valign='top' >
&nbsp;</td></tr><tr>
			<td colspan='4'valign='top' >
&nbsp;</td></tr>		<tr>
			<td colspan='4'valign='top' ><table align='left' width='100%'
 cellpadding='0' cellspacing='0' border='0'>
	{if $no_records>0 }
	<tr>
		<td align='left' valign='middle' width='20%' >
			{$page_counter} records&nbsp;&nbsp;&nbsp;
		</td>
		<td align='left' valign='top' width='80%' >
			<span style="float:right;padding-top:5px;height:20px;" class="admn_pagination_msg_board">{$pageLink}</span>
		</td>
	</tr>
	{else}
	<tr>
		<td  align='left' valign='middle' style="text-align:center; color:red; font-size:14px;">
			No records found!!
		</td>
	</tr>
	{/if}
	</table></td>
		</tr>
	</table>
	{/if}
		</td>
		<td>
		<table>
		<tr>
			<td>{include file="store_riht_links.tpl"}</td>
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