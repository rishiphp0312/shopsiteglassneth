<html>
<head></head>
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
<form name="update-quantity" id="update-quantity" action='items_list.php' method="post" >
<table align='center' cellspacing='0' border='0' cellpadding='3' style='border:1px solid #cccccc;' width='90%' >

<tr>
    
    <td>{include file='error_msg_template.tpl'}</td>
    </tr>
<tr>
    <td align='left' style='font-size:14px;font-weight:300;font-family:Arial;text-align:left;color:RED;
    font-family:Times New Roman;'  >Update Quantity</td>
    </tr>
    
<tr>
   
    <td align='left'>	<input name="available_quantity" onkeypress='return numbersonly(event)' id='available_quantity'  type="text" style="width:100px;"
    value="{$quantity_available}" class='required' >
    <input type='hidden' value='{$item_id_value}' name='item_value'>
</td>
</tr>
  

<tr>
   
    <td align='center'><input type='submit' value='submit'
    style='background-color:#FFCccc;border:1px solid #FFCccc;color:red;font-size:14px;font-weight:300;
    font-family:Arial;text-align:center;' name='Update-quant'></td>
</tr>
</table>
</form>
</body>
</html>