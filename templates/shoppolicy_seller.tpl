{include file="header.tpl"}
{include file="header_search.tpl"}
<!--Start Middle-->
<div id="middleMain">
{*include file="left_category.tpl"*}
<!--<div id="middleRtMain">-->
<div>
<!--Start Tab Link-->

<div class="shopmain">
<span class="mainHD">Seller's Company Policies </span>
	<!--Start my items -->
	<div class="myitemmain">
		<div class="myItemtopbg">
		
			<!--start page number -->
		{$username}
			<!--end page number -->
			<div class="clear"></div>
		</div>
		
		<div class="myiteminsidemain">
		<table width="100%" cellpadding="3" celspacing="3" border="0" >
		<tr>
		<td style="vertical-align:top;">
		<table width="630" cellpadding="3" celspacing="3" border="0" >
		
		<tr>
			<td style="width:150px;font-weight:bold;font-size:13px;vertical-align:top;padding:8px;color:#8A5F40;">
				Owner Name 
			</td>
			<td style="">{$f_name} {$l_name}</td>
		</tr>
		
		<tr>
			<td  style="width:150px;font-weight:bold;font-size:13px;vertical-align:top;padding:8px;color:#8A5F40;">
				Welcome Note
			</td>
			<td style="">{$v_welcome} </td>
		</tr>
		<tr>
			<td style="width:150px;font-weight:bold;font-size:13px;vertical-align:top;padding:8px;color:#8A5F40;">
				Payment Method
			</td>
			<td style="">{$v_payment} </td>
		</tr>
		<tr>
			<td  style="width:150px;font-weight:bold;font-size:13px;vertical-align:top;padding:8px;color:#8A5F40;">
				Shipping Note
			</td>
			<td style="">{$v_shipping}</td>
		</tr>
		<tr>
			<td style="width:150px;font-weight:bold;font-size:13px;vertical-align:top;padding:8px;color:#8A5F40;">
				Refund and Exchange
			</td>
			<td style="">{$v_refund_exchange}</td>
		</tr>
		<tr>
			<td style="width:150px;font-weight:bold;font-size:13px;vertical-align:top;padding:8px;color:#8A5F40;">
				Additional info
			</td>
			<td  style="">{$v_additional_info}</td>
		</tr>
		</table>
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