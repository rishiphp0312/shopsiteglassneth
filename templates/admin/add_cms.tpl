{include file="admin_top.tpl"}
  <table width="100%"  border="0" cellspacing="10" cellpadding="5">
	<tr>
	  <td valign="middle" class="bar">Add/Edit Static Page</td>
	</tr>
	<tr>
	  <td align="left" valign="top" class="border1">
	  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr><td>{include file='admin_error_msg_template.tpl'}</td></tr>
		<tr>
		  <td width="710" class="lback">
		  <form name="addCMSFrm" ID="addCMSFrm" action="" method="POST">
		     <table width="100%" border="0" cellspacing="0" cellpadding="4">
				<tr>
				  <td width="11%" align="left" class="text">Page Alias:</td>
				  <td width="83%"><input type="text" name="page_link_id" value="{$page_link_id|clear_input}" class="required input num_zip" style="width:400px;" maxlength="50"/>
                  Page alias shoud be unique. No space and Special characters allowed.
				  </td>
				  <td width="6%">&nbsp;</td>
				</tr>
				<tr>
				  <td width="11%" align="left" class="text">Page Title:</td>
				  <td width="83%"><input type="text" name="page_title" value="{$page_title_single|clear_input}" class="required input" style="width:400px;" maxlength="100"/>
                  </td>
				  <td width="6%">&nbsp;</td>
				</tr>
				<tr>
				  <td width="11%" align="left" class="text">Meta Title:</td>
				  <td width="83%"><input type="text" name="meta_title" value="{$meta_title|clear_input}" class="input" style="width:400px;" maxlength="100"/>
				  </td>
				  <td width="6%">&nbsp;</td>
				</tr>
				<tr>
				  <td width="11%" align="left" class="text">Meta Keywords:</td>
				  <td width="83%"><input type="text" name="meta_keywords" value="{$meta_keywords|clear_input}" class="input" style="width:400px;"/>
                  </td>
				  <td width="6%">&nbsp;</td>
				</tr>
				<tr>
				  <td width="11%" align="left" class="text">Meta Description:</td>
				  <td width="83%"><input type="text" name="meta_description" value="{$meta_description}" class="input" style="width:400px;" maxlength="100"/>
                  </td>
				  <td width="6%">&nbsp;</td>
				</tr>
				<tr>
				  <td align="left" class="text">Page Description:</td>
				  <td>{php} include("fck_cms.php"); {/php}
                  </td>
				  <td>&nbsp;</td>
				</tr>
				<tr>
				  <td>&nbsp;</td>
				  <td><input name="Submit" type="submit" class="button" value="Save"/>&nbsp;&nbsp;&nbsp;
			  <input name="Cancel" type="button" class="button" value="Cancel" onclick="window.location='admin_cms.php'"/></td>
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