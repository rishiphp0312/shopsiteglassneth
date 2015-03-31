{include file="header.tpl"}
{include file="js_css_validation.tpl"}
{include file="header_search.tpl"}
		<!--End Logo-->
		<!--Start Middle-->
		<div id="middleMain">
			
			{include file="left_category.tpl"}
		<!--Start Middle-->
		
			
			<div id="middleRtMain">
				<div>
				<div class="insidehd fl"><!--Buyer--></div>
				<!--start page number -->
				{if $pageLink}
<div class="bradcrum" 
style="width:600px;float:right;text-align:right;border:0px solid red;">
				
				<table align='center' width='100%' cellpadding='0' cellspacing='0' border='0'>
		
		<tr><td align='left' valign='middle' width='25%' >
					{*$page_counter*} &nbsp;&nbsp;&nbsp;</td>
					<td align='left' valign='top' width='80%' >									
						<span style="float:right;padding-top:5px;height:20px;" class="admn_pagination_msg_board">
						{$pageLink}</span>
						

	</td></tr>
	
	</table>

				<!--
				
				<a href="#" class="sel">1</a><a href="#">2</a><a href="#">3</a><a href="#">
				4
				</a><a href="#">5</a><a href="#">6</a><a href="#">7</a> &nbsp;<strong>
				<img src="images/d_pre_icon.jpg" alt="" /> Prev</strong>
				<a href="#" class="npLink"><strong>Next <img src="images/next_icon.jpg" alt="" />
				</strong></a>
				-->
				
				</div>{/if}
				<!--end page number -->
				<div class="clear"></div>
					<div class="buyermain" >
					{if $no_records>0}
				<table align='center' cellpadding='0'  cellspacing='0' 
					width='715px;' border='0' >
					<tr><td style=''>
					<!--<a href='advanced_serch.php'>Advanced Search</a> 
					-->
					</td></tr>
                                        <tr>
					{foreach name=cat from=$users_items_details item=val_items}
					<td width='140' >
					{if $smarty.request.pageNumber!="" && $smarty.request.pageNumber>1}
		
		  {/if}
	<table align='center' cellpadding='0'  cellspacing='0' 	width='127px;' border='0' >
	<tr><td colspan='4'>&nbsp;</td></tr>
    <tr><td align='center' valign='top' height='100'style='border:1px solid #cccccc;padding:5px;' ><a href="item-details.php?details_item_value={$val_items.item_id}" ><img src="{$baseUrl}getthumb.php?w=150&h=100&fromfile={if $val_items.image1!=''}uploads/{$val_items.image1}{else}images/item_small_img.jpg{/if}"  alt="" border="0" class="buyerimg" /></a></td></tr>
<tr><td align='center' valign='top' class="productNme">
<a href="item-details.php?details_item_value={$val_items.item_id}" >
{assign var ='tit_first' value=$val_items.title|ucfirst}{$tit_first|truncate:20}</a></td></tr>
	 <tr><td align='center' valign='top' class="priceText">Price &nbsp;:&nbsp;<span>
				&nbsp;{$val_items.cost_item|convert_price}<br>
USD {$val_items.cost_item|convert_number}   </span></td></tr>
			<tr><td align='left' valign='top' >
<table align='center' cellpadding='0' cellspacing='0' width='127px;' border='0' >
					<tr>
					<td align='left' valign='top' class="buynow">
			<a href="item-details.php?details_item_value={$val_items.item_id}"  >
			<img src="images/buy_bow_icon.jpg" alt="" border="0" /></a>
		<a href="item-details.php?details_item_value={$val_items.item_id}" > Buy now</a></td>
			<td align='right' valign='top'><span class="detailfr">
			<a href="item-details.php?details_item_value={$val_items.item_id}" >
			<img src="images/details_btn.jpg" alt="" border="0" /></a></span>
					</td>
					</tr>
					</table>
					</td></tr>
				  </table>

					</td>
				
				</td>
				{if $smarty.foreach.cat.iteration%4==0}
				</tr><tr><td colspan='4'>&nbsp;</td></tr><tr>
				{/if}
				{/foreach}
				</tr>
					<tr><td colspan='4'>&nbsp;</td></tr></table>{/if}
					
					</div>
					<!--start page number -->
					<div class="bradcrum" style="width:700px;">
					<!--<a href="#" class="sel">1</a><a href="#">2</a><a href="#">3</a><a href="#">4</a><a href="#">5</a>
					<a href="#">6</a><a href="#">7</a> &nbsp;<strong><img src="images/d_pre_icon.jpg" alt="" /> Prev</strong>
					<a href="#" class="npLink"><strong>Next <img src="images/next_icon.jpg" alt="" /></strong></a>
					-->
		<table align='center' width='100%' cellpadding='0' cellspacing='0' border='0'>
		{if $no_records>0 }
		<tr><td align='left' valign='middle' width='20%' >
					{*$page_counter*} &nbsp;&nbsp;&nbsp;</td>
					
					<td align='left' valign='top' width='80%' >									
						<span style="float:right;padding-top:5px;height:20px;"  {if $pageLink!=''} class="admn_pagination_msg_board" {/if}>
						{$pageLink}</span>
						

	</td></tr>
	{else}
<tr><td  align='left' valign='middle' style="text-align:center;color:red;font-size:14px;">
					No records found!!
						

	</td></tr>
	{/if}
	</table>
	</div>
					
					<!--end page number -->
					</div>
			</div>	
			<div class="clear"></div>
		</div>
		<!--End Middle-->
		{include file="footer.tpl"}