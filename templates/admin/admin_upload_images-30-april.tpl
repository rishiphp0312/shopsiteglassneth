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
      <form enctype="multipart/form-data" id="adminfrmzipimagesItems" name="adminfrmzipimagesItems" method="post">

<tr>
			             <td colspan="2"  align="left" valign="top"
                                   style='font-size:12px;font-weight:normal;color:#000000;' class="text">NOTE &nbsp;:&nbsp;[File extension should be .zip]</td>
		              </tr>
					  
					  
			           <tr>
			             <td colspan="2" align="left" valign="top"
                                   style='font-size:12px;font-weight:normal;color:#000000;' class="text">[Its advisable to keep the image names unique.Otherwise it will replace the previous images ]</td>
		              </tr>
					    <tr>
			             <td colspan="2" align="left" valign="top"
                                   style='font-size:12px;font-weight:normal;color:#000000;' class="text">[Images Name example: 'username-14-jan-2011-5-pm-1.jpg' ]</td>
		              </tr>
					  <tr>
			             <td colspan="2" align="left" valign="top"
                                   style='font-size:12px;font-weight:normal;color:#000000;' class="text">[Images should be in one zip file.It should not be one another.example abc.zip should contain (images) if  abc.zip contains xyz.zip and xyz.zip contains images then images will not upload.]</td>
		              </tr>
  <tr>
			             <td colspan="2"  align="left" valign="top"
                                   style='font-size:12px;font-weight:normal;color:#000000;' class="text">[Max File Size Alllowed of Zip is 10 MB] </td>
		              </tr>
	<tr>
	        <td align='right' width='200' >Upload Images(Zip file) <b>:</b></td>
		      
	        <td align='left' style='padding-right:25px;'> <input type="file" value="" class="required login_input" style="width:350px;"  name="zip_file_images" id="zip_file_images">	</td>
	 </tr>
	 
	 <tr>
	       <td>&nbsp;</td>
		    
	      <td><input name="Exceldetails" type="submit" value="Upload" class="button" /> 
					  <input name="cancel" type="button" value="Cancel" class="button" onClick="window.location='admin_home.php';" />	</td>
	 </tr>
	</form>
		
      </table>
</td>
	</tr>
</table>	  
{include file="admin_bottom.tpl"} 