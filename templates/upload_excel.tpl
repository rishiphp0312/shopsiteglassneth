{include file="header.tpl"}
{include file="js_css_validation.tpl"}
{include file="header_search.tpl"}
<script language="javascript">
{literal}

function show_rows(VAL)
	{
	
	if(VAL!=1)
		{
       document.getElementById('row_user').style.display='none';		
	   document.getElementById('row_pass').style.display='none';
	   document.getElementById('row_sign').style.display='none';
	   document.getElementById('row_merchant_id').style.display='';
	   
		}
	else
	 	{
	   document.getElementById('row_user').style.display='';		
	   document.getElementById('row_pass').style.display='';
	   document.getElementById('row_sign').style.display='';
	   document.getElementById('row_merchant_id').style.display='none';
	 	 }
		
	}


{/literal}
</script>
<!--Start Middle-->
	<div id="middleMain">
			{include file="left_category.tpl"}
		<div id="middleRtMain">
				<table width="95%" border="0" class="registerBg" style="width:620px;padding:0px;" align="left" cellpadding="3"  id="registerSUbHd" cellspacing="0">
				<tr><td align="left" valign="top"  class="registerSUbHd">Upload Item Details</td></tr>
		

		  <tr><td align="left" valign="top" >
					
				<form enctype="multipart/form-data" id="frmexcelItemdetails" name="frmexcelItemdetails" method="post">
					<table  border="0" style="width:600px;padding:0px;" align="left" cellpadding="5"  id="registerSUbHd" cellspacing="0">					
					  <tr><td colspan="4">{include file='error_msg_template.tpl'}</td></tr>					
			           <tr>
			             <td colspan="4"  align="left" valign="top"
                                   style='font-size:12px;font-weight:normal;color:#000000;' class="text">Click here to upload images<a href="zip_images.php">Upload</a></td>
		              </tr>
			           <tr>
			             <td colspan="4"  align="left" valign="top"
                                   style='font-size:12px;font-weight:normal;color:#000000;' class="text"><a href="download-new.php?down=1">Click here to download the excel sheet to view the format.</a></td>
	                  </tr>
					  
					  <tr>
			             <td colspan="4"  align="left" valign="top"
                                   style='font-size:12px;font-weight:normal;color:#000000;' class="text"><a href="download-new.php?down=2">Click here to download the CSV file to view the format.</a></td>
		              </tr>
					         <tr>
			             <td colspan="4"  align="left" valign="top"
                                   style='font-size:12px;font-weight:normal;color:#000000;' class="text">Download the above excel sheet and upload it after entering the data.</td>
		              </tr>
					    <tr>
			             <td colspan="4"  align="left" valign="top"
                                   style='font-size:12px;font-weight:normal;color:#000000;' class="text">There is one example how to enter the data .So kindly delete that row while adding your items.</td>
		              </tr>
			           <tr>
			             <td colspan="4"  align="left" valign="top"
                                   style='font-size:12px;font-weight:normal;color:#000000;' class="text">NOTE &nbsp;:&nbsp;[File extension should be .xls]</td>
		              </tr>
					  <tr>
			             <td colspan="2"  align="left" valign="top"
                                  style='font-size:12px;font-weight:bold;color:#804000;'class="text">Package Information</td> <td colspan="2"  align="left" valign="top"
                                  style='font-size:12px;font-weight:normal;color:#000000;'class="text"><table   style='font-size:12px;font-weight:normal;color:#000000;'>                         <tr>
								  <td align="left">
								  Package Max Limit								  </td>
								  <td align="left">
								  {if $num_rows_pacakage!=0}{$pkg_max_items}{else}25{/if}								  </td>
								  
								  </tr>
								  <tr>
								  <td align="left">
								  Already Having Total Items								  </td>
								  <td align="left">
								   {if $num_rows_items_available!=0}{$num_rows_items_available}{/if}								  </td>
								  </tr>
								  <tr>
								  <td align="left">
								  Item Limitations in Excel/Csv .								  </td>
								  <td align="left">
								  {if $num_rows_pacakage>0}
								  	 {if $num_rows_items_available < $pkg_max_items}                                     {$pkg_max_items-$num_rows_items_available}
								     {else}
								      Purchase Package to add further.
								     {/if}
									 {else}
						             {if $num_rows_items_available < 25}
									 {assign var='min_pkg_val' value='25'}
									    {$min_pkg_val-$num_rows_items_available}
									  {else}
									  Purchase Package to add further.
									  {/if}
								  {/if}								  </td>
								  </tr>
								  <tr>
								  <td align="left">								  </td>
								  <td align="left">								  </td>
								  </tr>
								  
								  </table></td>
		              </tr>
					  
			           <tr><td colspan="4" align="left" valign="top"
                                   style='font-size:12px;font-weight:bold;color:#804000;' class="text">
                                      Upload Excel Sheet  </td>
				    </tr>
                             <tr>	  <td align="left" valign="top" class="text"> <!--Upload Excel Sheet  :--> </td>
				  <td>&nbsp;</td>
				  <td colspan="2">
				  <input type="file" value="" class="required login_input" style="width:350px;"  name="excel_file_items" id="excel_file_items">				  </td>
					  </tr>  
					<tr>
					  <td>					  </td>
					  <td>&nbsp;</td>
					  <td colspan="2">
					  <input name="Exceldetails" type="submit" value="Upload" class="button" /> 
					  <input name="cancel" type="button" value="Cancel" class="button" onClick="window.location='my_account.php';" />					  </td>
					</tr>
				  </table>
				</form>
		  </td></tr>
		  </table>
			<!--</div>-->
		</div>
		<div class="clear"></div>
	</div>
<!--End Middle-->
{include file="footer.tpl"}