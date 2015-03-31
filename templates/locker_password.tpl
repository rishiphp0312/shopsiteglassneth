<html>
<head>
{include file="js_css_validation.tpl"}
</head>
{literal}
<script type="text/javascript">
function numbersonly(e){
var unicode=e.charCode? e.charCode : e.keyCode
if (unicode!=8){ //if the key isn't the backspace key (which we should allow)
if (unicode<48||unicode>57) //if not a number
return false; //disable key press
}
}
</script>

{/literal}
<style type="text/css">
<!--
@import url("{$baseUrl}css/stylesheet.css");
-->
</style>
<script src="{$baseUrl}js/jquery/jquery-1.3.2.min.js" type="text/javascript"></script>
<script src="{$baseUrl}js/function.js" type="text/javascript"></script>
<link rel="shortcut icon" href="{$baseUrl}favicon.ico" type="image/x-icon" />
{include file="js_css_validation.tpl"}
<body>
<form name="locker_password" id="locker_password" action='locker_password.php' method="post" >
	<table align='center' cellspacing='0' border='0' cellpadding='3' style='border:1px solid #cccccc;' width='100%' >
		<tr>
			<td colspan="2">{include file='error_msg_template.tpl'}</td>
		</tr>
		<tr>
			<td align='left' colspan="2" style='font-size:14px; font-weight:bold; font-family:Arial;text-align:left;color:RED;
			font-family:Times New Roman; '>
				Create Password for Locker
			</td>
		</tr>

		<tr>
			<td>Enter Password</td>
			<td align='left'>
				<input name="locker_pass"  id='locker_pass'  type="text" value="{$locker_password}" class="formInput required" >
				<input type='hidden' value='{$item_id_value}' name='item_value'>
			</td>
		</tr>
		<tr>
			<td>Confirm Password</td>
			<td align='left'>
				<input name="repassword" id='repassword' type="text" class="formInput required" equalto="#locker_pass" >
			</td>
		</tr>
		<tr>
			<td>Password Valid Till</td>
			<td align='left'>
				<select name="pass_expry" class='formInput'>
				<option value="7"> 1 Week</option>
				<option value="15"> 15 Day's</option>
				<option value="30">30 Day's</option>
				</select>
			</td>
		</tr>

		<tr>
			<td></td>
			<td style="padding:10px;">
				<input type='submit' value='submit'  name='submit' style='background-color:#FFCccc;border:1px solid #FFCccc;color:red; font-size:14px; font-weight:300; font-family:Arial; text-align:center;' >
			</td>
		</tr>
	</table>
</form>
</body>
</html>