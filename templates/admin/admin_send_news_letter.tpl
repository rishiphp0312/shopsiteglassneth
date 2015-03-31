{include file="admin_top.tpl"}
<script language="javascript" type="text/javascript">
{literal}
//function is used to check all/un check all ceckboxes
function fnc_checkAll(strChk)
{
	
	var inputs = document.getElementsByTagName('input');
    var checkboxes = [];
    //if(document.getElementById('checkAll').checked)
	if(strChk==1)
	{
		for (var i = 0; i < inputs.length; i++)
		{
	
			if (inputs[i].type == 'checkbox')
			{
				inputs[i].checked = true;
			}
		}
	}
	else
	{
		for (var i = 0; i < inputs.length; i++)
		{
	
			if (inputs[i].type == 'checkbox')
			{
				inputs[i].checked = false;
			}
		}
	}
}
{/literal}
</script>
  <table width="100%"  border="0" cellspacing="10" cellpadding="5">
	<tr>
	  <td valign="middle" class="bar">Send News Letter</td>
	</tr>
	<tr>
	  <td align="left" valign="top" class="border1">
	  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr><td>{include file='admin_error_msg_template.tpl'}</td></tr>
		<tr>
		  <td width="710" class="lback">
	 <form name="frm_bulk_mailUser" ID="frm_bulk_mailUser" action="" method="POST">
      <table width="100%" cellpadding="4" cellspacing="4" align="center" border="0">
        <tr>
          <td colspan="2" class="heading_strip">
		  <div style="float:left; text-align:center; padding-left:25px;" class="error_msg">
		  	{$error_msg}
		  </div>
		  </td>
        </tr>
        <tr>
		<td valign="top" width="70%">
		<!-- START table for Message section -->
		<table align="left" cellpadding="4" cellspacing="4" border="0" width="100%">
		<tr>
          <td width="60" style="font-weight:bold;">Subject : </td>
          <td><input type="text" name="subject" style="width:400px;" value="{$mail_subject2}" class="txtFeildTitle" maxlength="100"/>
          <div class="error_msg" id="error_subject"></div></td>
        </tr>
        <tr>
          <td valign="top" style="font-weight:bold;">Message :</td>
          <td>{php} include("fck_news_letter.php"); {/php}
            <div class="error_msg" id="error_mail_content"></div></td>
        </tr>
		<tr>
			<td>&nbsp;</td>
			<td align="left">
			<input name="Submit" type="submit" class="button" value="Send News Letter"/>&nbsp;&nbsp;&nbsp;
			  <input name="Cancel" type="button" class="button" value="Cancel" onclick="window.location='admin_news_letter.php'"/>
			</td>
		</tr>
		</table>
		<!-- END table for Message section -->
		</td>
		<!-- START table for User List section -->
		<td valign="top" width="30%">
		{if $userList}
		<table align="left" cellpadding="0" cellspacing="2" border="0" width="100%">
			<tr><td colspan="2" class="bar">Subscribed Users</td></tr>
			<tr>
				<td width="21%" style="font-weight:bold;">Select</td>
				<td width="79%"><a href="javascript: fnc_checkAll(1);">All</a> <a href="javascript: fnc_checkAll(0);">None</a></td>
			</tr>
			<tr>
			<td colspan="2">
			<div style="border:1px solid #AFDDF7; height:480px; overflow: auto;">
				<table align="left" cellpadding="0" cellspacing="2" border="0" width="100%">
				{foreach name=user from=$userList item=users}
				<tr>
					<td><input type="checkbox" name="UserEmails[]" value="{$users.news_letter_email}"/></td>
					<td>{$users.news_letter_email}</td>
				</tr>
				
				{/foreach}
					<tr>
					<td colspan="2">
	
					</td>
				</tr>
				</table>
			</div>
			</td>
			</tr>
		</table>
		{/if}
		<!-- END table for User List section -->
		</td>
		</tr>
      </table>
    </form>
	</td>
		</tr>
	</table>
	</td>
	</tr>
</table>
<script language="javascript">fnc_checkAll(1);</script>
{include file="admin_bottom.tpl"}