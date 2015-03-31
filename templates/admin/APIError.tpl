{include file="admin_top.tpl"}
<script language="javascript">
{literal}
function confirm_msg(id,val)
{
//alert(val+'id');
if(val==1)
{
    jConfirm('Do you really want to Suspend this Item?', 'Confirm', function(r) 
	{
		if(r)
		{
			location.href='admin_products_listing.php?suspend_item_value='+id;
		}
		else
		{
			return false;
		}	
	});

}
else if(val==2)
{
 jConfirm('Do you really want to Approve this Item?', 'Confirm', function(r) 
	{
		if(r)
		{
			location.href='admin_products_listing.php?approve_item_value='+id;
		}
		else
		{
			return false;
		}	
	});
}

else if(val==6)
{
 jConfirm('Do you really want to make this Item Handpicked?', 'Confirm', function(r) 
	{
		if(r)
		{
			location.href='admin_products_listing.php?handpicked_item_value='+id;
		}
		else
		{
			return false;
		}	
	});
}
else 
	{
	jConfirm('Do you really want to delete this Item?', 'Confirm', function(r) 
	{
		if(r)
		{
			location.href='admin_products_listing.php?delete_item_value='+id;
		}
		else
		{
			return false;
		}	
	});
	}
}
{/literal}
</script>
<table width="100%"  border="0" cellspacing="10" cellpadding="5">
	<tr>
	  <td valign="middle" class="bar">{$form_heading}</td>
	</tr>
	
	
	<tr>
	  <td align="left" valign="top" class="border1">
      <table width="100%" cellpadding="4" cellspacing="2" align="center">
     
		
		
		
        <tr>
			<td colspan="8" style='background-color:#ffffff;'>
			<div style="float:left;"><span style='font-size:12px;color:red;'>Transation detail page(Error on page)</span> </div>
			
			
			
			</td>
        </tr>
	<tr>
			<td colspan="8" style='background-color:#ffffff;'>
			<b>Your details are </b>&nbsp;-
			
			
			</td>
        </tr>
<td style="vertical-align:top;">
		<table width="330" cellpadding="3" celspacing="3" border="0" align="center" >
		
		<tr>
			<td  style="font-weight:bold;font-size:13px;vertical-align:top;">
				Ackwoledgement
			</td>
			<td style="font-size:12px;padding-top:1px;text-align:left;">
				{$ACK} 
			</td>
		</tr>
		<tr>
			<td  style="font-weight:bold;font-size:13px;vertical-align:top;">
				Error code
			</td>
			<td style="font-size:12px;padding-top:1px;text-align:left;">
				{$errorCode} 
			</td>
		</tr>
		<tr>
			<td  style="font-weight:bold;font-size:13px;vertical-align:top;">
				Short Message
			</td>
			<td style="font-size:12px;padding-top:1px;text-align:left;">
				{$shortMessage} 
			</td>
		</tr>
		
		<tr>
			<td  style="font-weight:bold;font-size:13px;vertical-align:top;">
				Version
			</td>
			<td style="font-size:12px;padding-top:1px;text-align:left;">
				{$VERSION} 
			</td>
		</tr>
		<tr>
			<td  style="font-weight:bold;font-size:13px;vertical-align:top;">
				Correlation ID
			</td>
			<td style="font-size:12px;padding-top:1px;text-align:left;">
				{$CORRELATIONID} 
			</td>
		</tr>
		<tr>
			<td  style="font-weight:bold;font-size:13px;vertical-align:top;">
				Long Message
			</td>
			<td style="font-size:12px;">
				{$longMessage} 
			</td>
		</tr>
		</table>
		</td>
        </tr>

		
		
      </table>
</td>
	</tr>
</table>	  
{include file="admin_bottom.tpl"} 