<?php
session_start();
?>
<script language="javascript">
function val
</script>
<table width="100%" border="1" align="left" cellpadding="0" cellspacing="0">
  <tr>
  <td colspan="6" align="left" valign="top" style="color:#AF6161;font-family:Arial, Helvetica, sans-serif;font-size:13px;text-align:left;font-weight:bold;" >Pay Cost </td>
  </tr>
  <tr>
    <td colspan="6">&nbsp;</td>
  </tr>
  

  <tr>
    <td align="left" valign="top" colspan="6">
	<form action="paypal-direct.php" method="get" name="paypal_frm_get" >
	<table width="100%" align="center" cellpadding="0" cellspacing="0" border="1">
	<tr>
	            <td width="24%">&nbsp;</td>
		        <td width="59%">&nbsp;</td>
			    <td width="17%">&nbsp;</td>
	</tr>
	<tr>
	            <td>Enter amount </td>
		        <td>
				<input type="text" name="amount" id='amount' value=""  />
				</td>
			    <td>
				<input type='hidden' value='USD' id='curency_code' name='curency_code'>
			    <input type='hidden' value='paytest.php'  name='return'>
				<input type='hidden' value='api_error1.php'  name='cancel_return'>
				</td>
	</tr><tr>
	            <td>&nbsp;</td>
		        <td>&nbsp;</td>
			    <td>&nbsp;</td>
	</tr><tr>
	            <td>&nbsp;</td>
		        <td><input type="submit" value="Post" name="post" /></td>
			    <td>&nbsp;</td>
	</tr>	
	<tr>
	            <td>&nbsp;</td>
		        <td>&nbsp;</td>
			    <td>&nbsp;</td>
	</tr>
	</table>
	
	</form>
	
	</td>
  </tr>
  <tr>
  <td colspan="6" align="left" valign="top" style="color:#AF6161;font-family:Arial, Helvetica, sans-serif;font-size:13px;text-align:left;font-weight:bold;">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6">&nbsp;</td>
  </tr>
  
   <tr>
    <td colspan="6">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6">&nbsp;</td>
  </tr>
</table>
