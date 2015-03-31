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
				<tr><td align="left" valign="top"  class="registerSUbHd">Upload Images </td></tr>
		

		  <tr><td align="left" valign="top" >
					
				<form enctype="multipart/form-data" id="frmzipimagesItems" name="frmzipimagesItems" method="post">
					<table  border="0" style="width:600px;padding:0px;" align="left" cellpadding="5"  id="registerSUbHd" cellspacing="0">					
					  <tr><td colspan="4">{include file='error_msg_template.tpl'}</td></tr>					
			           
					  
					  
					         
					    
			           <tr>
			             <td colspan="4"  align="left" valign="top"
                                   style='font-size:12px;font-weight:normal;color:#000000;' class="text">[Max File Size Alllowed of Zip is 10 MB] </td>
		              </tr>
			           <tr>
			             <td colspan="4"  align="left" valign="top"
                                   style='font-size:12px;font-weight:normal;color:#000000;' class="text">NOTE &nbsp;:&nbsp;[File extension should be .zip]</td>
		              </tr>
					  
					  
			           <tr>
			             <td colspan="4" align="left" valign="top"
                                   style='font-size:12px;font-weight:normal;color:#000000;' class="text">[Its advisable to keep the image names unique.Otherwise it will replace the previous images ]</td>
		              </tr>
					    <tr>
			             <td colspan="4" align="left" valign="top"
                                   style='font-size:12px;font-weight:normal;color:#000000;' class="text">[Images Name example: 'username-14-jan-2011-5-pm-1.jpg' ]</td>
		              </tr>
			           <tr><td colspan="4" align="left" valign="top"
                                   style='font-size:12px;font-weight:bold;color:#804000;' class="text">
                                      Upload Zip file Images </td>
				    </tr>
                             <tr>
                               <td align="left" valign="top" class="text">&nbsp;</td>
                               <td>&nbsp;</td>
                               <td colspan="2">&nbsp;</td>
                             </tr>
                             <tr>	  <td align="left" valign="top" class="text"> <!--Upload Excel Sheet  :--> </td>
				  <td>&nbsp;</td>
				  <td colspan="2">
				  <input type="file" value="" class="required login_input" style="width:350px;"  name="zip_file_images" id="zip_file_images">				  </td>
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