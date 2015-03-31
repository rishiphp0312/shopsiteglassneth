<html>
<head>
<script language="javascript" src="calendar_us.js"></script>
<link rel="stylesheet" href="calendar.css">
<style type="text/css">
<!--
@import url("{$baseUrl}css/stylesheet.css");
-->
</style>
<script src="{$baseUrl}js/jquery/jquery-1.3.2.min.js" type="text/javascript"></script>
<script src="{$baseUrl}js/function.js" type="text/javascript"></script>
</head>
<link rel="shortcut icon" href="{$baseUrl}favicon.ico" type="image/x-icon" />
{include file="js_css_validation.tpl"}
<body>
<form name="testform" id="testform" action='shipping_start_details.php' method="post" >
<table align='center' cellspacing='0' border='0' cellpadding='3' style='border:1px solid #cccccc;' width='100%' >

<tr>
    
    <td colspan="2">{include file='error_msg_template.tpl'}</td>
    </tr>

<tr>
    <td width="30%" align='left' style='font-size:14px;font-weight:300;font-family:Arial;text-align:left;color:#000000;
    font-family:Times New Roman;'  >Service Name</td>
    <td width="70%" align='left' style='font-size:14px;font-weight:300;font-family:Arial;text-align:left;color:#000000;
    font-family:Times New Roman;'  ><input name="ship_name"  id='ship_name'  type="text" style="width:150px;"
    value="{$ship_name}" class='required' >
    <input type='hidden' value='{$smarty.request.upd_status}' name='ship_status_id'>
	  <input type='hidden' value='{$smarty.request.last_trans_id}' name='last_trans_id'></td>
</tr>
<tr>
    <td width="30%" align='left' style='font-size:14px;font-weight:300;font-family:Arial;text-align:left;color:#000000;
    font-family:Times New Roman;'  >Shipping Start Date</td>
    <td width="70%" align='left'><input type="text" name="Ship_Start" style="width:150px;" id='Ship_Start' />
						
						  {literal}
	<script language="JavaScript">
		var o_cal = new tcal ({
		// form name
		'formname': 'testform',
		// input name
		'controlname': 'Ship_Start'
	});
	
	// individual template parameters can be modified via the calendar variable
	o_cal.a_tpl.yearscroll = false;
	o_cal.a_tpl.weekstart = 1;
	
	</script>
		 {/literal}</td>
</tr>
   <tr>
    <td width="30%" align='left' style='font-size:14px;font-weight:300;font-family:Arial;text-align:left;color:#000000;
    font-family:Times New Roman;'  >Comment:</td>
    <td width="70%" align='left'   ><textarea name="comment" id="comment" rows="4" cols="30"></textarea>	
			<!--
<input type='hidden' value='{$ship_status_id}' name='ship_status_id' >
<input type='hidden' value='{$last_trans_id}' name='last_trans_id' >--></td>
</tr> 


<tr>
  <td colspan="2" align='center'>&nbsp;</td>
</tr>
<tr>
   <td colspan="2" align='center'><input type='submit' value='submit'
    style='background-color:#FFCccc;border:1px solid #FFCccc;color:red;font-size:14px;font-weight:300;font-family:Arial;text-align:center;' name='Update-quant'></td>
</tr>
</table>
</form>
</body>
</html>