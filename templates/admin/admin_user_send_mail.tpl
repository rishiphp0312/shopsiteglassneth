{include file="admin_top.tpl"}
<table width="100%"  border="0" cellspacing="10" cellpadding="5">
	<tr>
	  <td valign="middle" class="bar">Send Mail</td>
	</tr>
	  <td align="left" valign="top" class="border1">
      <form name="frm_user_send_mail" ID="frm_user_send_mail" action="" method="POST">
      <table width="100%" cellpadding="4" cellspacing="4" align="center" border="0">
        <tr>
		<td valign="top" width="70%">
		<!-- START table for Message section -->
		<table align="left" cellpadding="2" cellspacing="2" border="0" width="100%">
		<tr>
		<td style="font-weight:bold;">Mail To :</td>
		<td><input type="text" name="emailTo" style="width:480px;" value="{$emailTo}"
		class="txtFeildTitle" maxlength="100" readonly/></td>
		</tr>
		<tr>
          <td width="60" style="font-weight:bold;">Subject : </td>
          <td><input type="text" name="subject" style="width:480px;" value="{$mail_subject2}" class="txtFeildTitle" maxlength="100"/>
          <div class="error_msg" id="error_subject"></div></td>
        </tr>
        <tr>
          <td valign="top" style="font-weight:bold;">Message :</td>
          <td>{php} include("fck_send_mail_user.php"); {/php}
            <div class="error_msg" id="error_mail_content"></div></td>
        </tr>
		<tr>
			<td>&nbsp;</td>
			<td align="left">
			<input name="Submit" type="submit" class="button" value="Send Mail"/>&nbsp;&nbsp;&nbsp;
			  <input name="Cancel" type="button" class="button" value="Cancel" onclick="window.location='admin_users.php'"/>
			</td>
		</tr>
		</table>
		<!-- END table for Message section -->
		</td>
		</tr>
      </table>
    </form>
</td>
	</tr>
</table>	  
{include file="admin_bottom.tpl"} 