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
       <form name='frm_admin_upload_excel' id="frm_admin_upload_excel"  enctype="multipart/form-data" action='admin_upload_excel.php' method='post'>
	<tr>
	  <td colspan='2' align='left' style='font-size:12px;font-family:arial;color:red;text-align:right;'>&nbsp;</td>
	  </tr>
	       <tr>
			             <td colspan="2"  align="left" valign="top"
                                   style='font-size:12px;font-weight:normal;color:#000000;' class="text"><a href="../download-new.php?down=11">Click here to download the excel sheet to view the format.</a></td>
	                  </tr>
					  
					  <tr>
			             <td colspan="2"  align="left" valign="top"
                                   style='font-size:12px;font-weight:normal;color:#000000;' class="text"><a href="../download-new.php?down=22">Click here to download the CSV file to view the format.</a></td>
		              </tr>
				<tr>
			             <td colspan="4"  align="left" valign="top"
                                   style='font-size:12px;font-weight:normal;color:#000000;' class="text">Download the above excel sheet or csv file and upload it after entering the data.</td>
		              </tr>
					    <tr>
			             <td colspan="4"  align="left" valign="top"
                                   style='font-size:12px;font-weight:normal;color:#000000;' class="text">There is some example how to enter the data .So kindly delete those dummy data  row while adding your items.Leave the first row  in excel and csv as it is which describes the information to be filled below.</td>
		              </tr>
	<tr>
		 
		     
		  <td colspan='2' align='left' style='font-size:12px;font-family:arial;color:red;text-align:right;'>&nbsp;</td>
	</tr>
	<tr>
	        <td align='right' width='200' >Upload Excel/CSV <b>:</b></td>
		      
	        <td align='left' style='padding-right:25px;'><input type="file" value="" class="required login_input" style="width:350px;"  name="excel_file_items" id="excel_file_items"></td>
	 </tr>
	 
	 <tr>
	       <td>&nbsp;</td>
		    
	      <td>
		    <input name="Exceldetails" type="submit" value="Upload" class="button" /> 
					  <input name="cancel" type="button" value="Cancel" class="button" onClick="window.location='admin_home.php';" />		  </td>
	 </tr>
	</form>
      </table>
</td>
	</tr>
</table>	  
{include file="admin_bottom.tpl"} 