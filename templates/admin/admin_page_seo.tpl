{include file="admin_top.tpl"}
  <table width="100%"  border="0" cellspacing="10" cellpadding="5">
	<tr>
	  <td valign="middle" class="bar">Meta Tags</td>
	</tr>
	<tr>
	  <td align="left" valign="top" class="border1">
	  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr><td>{include file='admin_error_msg_template.tpl'}</td></tr>
		<tr>
		  <td width="710" class="lback">
		  <form name="frmChangePassword" id="frmChangePassword" method="post" style="margin:0px;">
		   <input type="hidden" name="hdnOldPassord" id="hdnOldPassord" value="{$old_password}" />
			  <table width="100%" border="0" cellspacing="0" cellpadding="4">


<tr>
				  <td width="32%" align="left" class="text">Page Name:</td>
				  <td width="22%">
<select  name="page_name"  id="page_name" class="input required" style="width:175px">
					{html_options values=$metaPageValue output=$metaPageName selected=$productList_pagename}
				</select></td>
				  <td width="46%">&nbsp;</td>
				</tr>
				<tr>
				  <td width="32%" align="left"  valign='top' class="text">Title:</td>
				  <td width="22%"><input name="title" type="text"   class="input" style='width:400px;' id="title"  value="{$productList_metatitle}" /></td>
				  <td width="46%">&nbsp;</td>
				</tr>
				<tr>
				  <td width="32%" align="left" valign='top' class="text">Keywords:</td>
				  <td width="22%"><textarea name="Keywords" type="text"   class="input" id="Keywords"  style='width:400px;' rows='2' />{$productList_metakeywords}</textarea></td>
				  <td width="46%">&nbsp;<input type='hidden' value='{$meta_id}' name='meta_id'></td>
				</tr>
				<tr>
				  <td align="left" valign='top' class="text">Description :</td>
				  <td valign='top'><textarea  name='description' class="input"  style='width:400px;' rows='3'   />{$productList_metadescription}</textarea></td>
				  <td>&nbsp;</td>
				</tr>
				<tr>
				  <td>&nbsp;</td>
				  <td><input name="metatags" type="submit" class="button" value=" Save " />
					 <input name="cancel" type="reset" class="button" value="Cancel" onclick="window.location='admin_home.php'" /></td>
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