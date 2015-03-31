{include file="admin_top.tpl"}
<table width="100%"  border="0" cellspacing="10" cellpadding="5">
<tr>
  <td valign="middle" class="bar">Add/Edit Tutorial Videos</td>
</tr>
<tr>
  <td align="left" valign="top" class="border1">
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr><td>{#require_msg#}</td></tr>
	
	<tr>
		<td width="710" class="lback">
	<form name="frmAddtutorial" id="frmAddtutorial" 
enctype='multipart/form-data' method="post" style="margin:0px;">
		<input type="hidden" name="forum_user_id" value="{$forum_user_id}" />
		<table width="100%" border="0" cellspacing="0" cellpadding="4">
		
		<tr>
			<td width="32%" align="left" class="text">Upload Flash Video: *</td>
			<td width="22%">
				<input name="flv_tutorial" type="file"  class="input required alph_num" 
				id="flv_tutorial" size="30" value="{$tut_path}" />
			</td>
			<td width="46%"><span style='font-size:10px;color:red;text-align:left;'>file should be .flv</span></td>
		</tr>
		
		




		

		<tr>
			<td>&nbsp;</td>
			<td>
				<input name="save_flv" type="submit" class="button" value="Save" />
				<input name="cancel" type="reset" class="button" value="Cancel" onclick="window.location='admin_users.php'" />
			</td>
			<td>&nbsp;</td>
		</tr>
	</table>
	</form>
	</td>
	</tr>
</table>
</td>
</tr>
</table>
{include file="admin_bottom.tpl"}