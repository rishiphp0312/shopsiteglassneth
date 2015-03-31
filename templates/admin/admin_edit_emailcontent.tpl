{include file="admin_top.tpl"}
  <table width="100%"  border="0" cellspacing="10" cellpadding="5">
	<tr>
	  <td valign="middle" class="bar">Add/Edit Email Content</td>
	</tr>
	<tr>
	  <td align="left" valign="top" class="border1">
	  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr><td>{*#require_msg#*}</td></tr>
		<tr><td>{include file='admin_error_msg_template.tpl'} </td></tr>
		<tr>
		  <td width="710" class="lback">
		  <form name="frmEdit_email_content" id="frmEdit_email_content" method="post" style="margin:0px;">
		     <input type="hidden" name="edit_id" value="{$smarty.request.edit_id}" />
			 <table width="100%" border="0" cellspacing="0" cellpadding="4">
				 
				
				
		
				<tr>
				  <td colspan="2" align="left" valign='top' class="text">NOTE&nbsp; :&nbsp;[<span style="font-family:Arial, Helvetica, sans-serif;font-size:11px;color:#FF0000">&nbsp;Please donot change the content in between #content#.These are dynamic content.</span>	]</td>
				  <td>&nbsp;</td>
			    </tr>
				<tr>
				  <td align="left" class="text" valign='top'>&nbsp;</td>
				  <td>&nbsp;</td>
				  <td>&nbsp;</td>
			    </tr>
				<tr>
				  <td align="left" class="text" valign='top'>Subject: </td>
				  <td>
				 <input name="subject" 	id='subject' type="text"  class="input required" style="width:320px;"  value="{$mail_subject}" size="" />				  </td>
				  <td>&nbsp;</td>
				</tr>
				<tr>
				  <td align="left" class="text" valign='top'>Mail Content:</td>
				  <td>
				  
				  {php} include("fck_email_letter.php"); {/php}
				 <!-- <textarea name="mail_content" cols="30" rows="10" style="width:320px;"  class="input">{$mail_content}</textarea>	-->			</td>
				  <td>&nbsp;</td>
				</tr>


				<tr>
				  <td>&nbsp;</td>
				  <td><input name="save" type="submit" class="button" value="Save" />
					  <input name="cancel" type="reset" class="button" value="Cancel"
					  onclick="window.location='admin_products_listing.php'" /></td>
				  <td>&nbsp;</td>
				</tr>
			</table>
		  </form></td>
		</tr>
	</table>
	</td>
	</tr>
</table>
{include file="admin_bottom.tpl"}