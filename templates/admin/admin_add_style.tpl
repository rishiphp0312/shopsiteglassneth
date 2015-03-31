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
	
	</tr>	
	<tr>
	  <td align="left" valign="top" class="border1">
      <table width="100%" cellpadding="4" border='0' cellspacing="2" align="center">
       <form name='frm_assign_style' id="frm_assign_style" action='' method='post'>
	<tr>
		 
		     
		  <td colspan='2' align='left' style='font-size:12px;font-family:arial;color:red;text-align:right;'>&nbsp;</td>
	</tr>
	<tr>
	        <td align='right' width='200' >Style <b>:</b></td>
		      
	        <td align='left' style='padding-right:25px;'><input type='text' value='{$arr_set_style}' id='set_style' style="width:150px;" class="input required"  name='set_style'></td>
	 </tr>
	 
	 <tr>
	       <td>&nbsp;</td>
		    
	      <td><input type='submit' value='Submit'  name='submit'></td>
	 </tr>
	</form>
		
      </table>
</td>
	</tr>
</table>	  
{include file="admin_bottom.tpl"} 