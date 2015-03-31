{include file="admin_top.tpl"}
<table width="100%"  border="0" cellspacing="10" cellpadding="5">
<tr>
  <td valign="middle" class="bar">Add/Edit Tutorial</td>
</tr>
<tr>
  <td align="left" valign="top" class="border1">
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr><td>{#require_msg#}</td></tr>
	
	<tr>
	<tr><td>{include file='admin_error_msg_template.tpl'}</td></tr>
	<td width="710" class="lback">
	<form name="frmAddtutorial" id="frmAddtutorial" enctype='multipart/form-data' method="post" style="margin:0px;">
		<input type="hidden" name="forum_user_id" value="{$forum_user_id}" />
		<table width="100%" border="0" cellspacing="0" cellpadding="4">
		<tr><td style="color:red;"><b>Note: </b>Only FLV file extension is allowed.</td></tr>
		<tr>
			<td width="32%">Tutorial Language: *</td>
			<td width="22%"><input name="tute_language" type="text" class="input required alph_num" id="tute_language" value="{$tute_language}" maxlength="100' /></td>
			<td width="46%">&nbsp;</td>
		</tr>
		<tr>
			<td>Tutorial Video: *</td>
			<td><input name="tute_video" type="file"  class="input" id="tute_video" />{if $tute_video}video available{/if}</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>
				<input name="save_flv" type="submit" class="button" value="Save" />
				<input name="cancel" type="reset" class="button" value="Cancel" onclick="window.location='admin_tutorials.php'" />
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