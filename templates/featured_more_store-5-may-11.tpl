{include file="header.tpl"}
{include file="header_search.tpl"}
<!--Start Middle-->
<div id="middleMain">
{include file="left_category.tpl"}
<div id="middleRtMain">
<div>
<!--Start Tab Link-->

<div class="shopmain">
<span class="mainHD">Featured Store </span>
	<!--Start my items -->
	<div class="myitemmain">
		<div class="myItemtopbg">
		<form action="" name="frm" method="post">
			<div class="sortby">Sort by: 
				<select name="sortingid" class="inputsel" onchange="document.frm.submit();">
					<option value="">--select--</option>
					<option value="v_fetured_date">Date</option>
					<option value="username">Store Name</option>
					
				</select>
			</div>
			</form>
			<!--start page number -->
			<div class="bradcrum" style="padding:0px;">
			<table align='center' width='100%' cellpadding='0' cellspacing='0' border='0'>
			{if $pageLink}
			<tr>
				<td align='left' valign='middle' width='20%' >
				{$page_counter} records&nbsp;&nbsp;&nbsp;</td>
				<td align='left' valign='top' width='80%' >									
					<span style="float:right;padding-top:5px;height:20px;" class="admn_pagination_msg_board">{$pageLink}</span>
				</td>
			</tr>
			{else}
			<tr>
				<td  align='left' valign='middle'></td>
			</tr>
			{/if}
			</table>
		</div>
			<!--end page number -->
			<div class="clear"></div>
		</div>
		
		<div class="myiteminsidemain">
		<table width="100%" cellpadding="3" celspacing="3">
		<tr>
			<td  style="font-weight:bold;font-size:13px;">
				Store Image
			</td>
			<td style="font-weight:bold;font-size:13px;">
				 Store Name 
			</td>
			<td style="font-weight:bold;font-size:13px;">
				Owner Name 
			</td>
			<td style="font-weight:bold;font-size:13px;">
				City 
			</td>
			</tr>
		{if $record >0}	
		{ section name=featured loop=$store}
		<tr>
			<td>
				<a href="http://{$add_this_name_www}.{$store[featured].username}.{$add_this_name}/featured_store_information.php?id={$store[featured].id}">
				{if $store[featured].v_store_image ne '' }
				
					<img src='{$baseUrl}getthumb.php?w=150&h=50&fromfile=uploads/{$store[featured].v_store_image} 'align="middle" border="1" class="" style="padding:2px;vertical-align:top;">
				{else}
					<img src='images/no_img.jpg'  height="70" width="90" align="middle" border="1" class="" style="padding:2px;vertical-align:top;">

				{/if}
				</a>
			
			</td>
			<td style="font-weight:bold;">
				<a href="http://{$add_this_name_www}.{$store[featured].username}.{$add_this_name}/featured_store_information.php?id={$store[featured].id}"> {*$store[featured].store_name*}{$store[featured].username} </a>
			
			</td>
			<td>
				<a href="javascript:void(0);">
				 {$store[featured].first_name}-{$store[featured].last_name} </a> 
			
			</td>
			<td>
				<a href="javascript:void(0);"> {$store[featured].city}</a>
			</td>
		</tr>
				
		{/section}
		{else}
			<tr><td colspan="4">No Items here..!!</td></tr>
		{/if}
		</table>
		</div>
		<div class="myItemtopbg">
			<div class="sortby">Sort by: 
				<select name="sortingid" class="inputsel">
					<option value="v_fetured_date">Date</option>
					<option value="username">Store Name</option>
					
				</select>
			</div>
			<!--start page number -->
			<div class="bradcrum" style="padding:0px;">
				<table align='center' width='100%' cellpadding='0' cellspacing='0' border='0'>
				{if $pageLink}
				<tr>
					<td align='left' valign='middle' width='20%' >
					{$page_counter} records&nbsp;&nbsp;&nbsp;</td>
					<td align='left' valign='top' width='80%' >									
						<span style="float:right;padding-top:5px;height:20px;" class="admn_pagination_msg_board">{$pageLink}</span>
					</td>
				</tr>
				{else}
				<tr>
					<td  align='left' valign='middle'></td>
				</tr>
				{/if}
				</table>
			</div>
			<!--end page number -->
			<div class="clear"></div>
		</div>
	</div>	
	<!--End my items -->
</div>





</div>
</div>
<div class="clear"></div>
</div>
<!--End Middle-->
{include file="footer.tpl"}