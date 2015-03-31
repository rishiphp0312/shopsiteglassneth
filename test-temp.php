
<!-- Validation and Common function -->
<script src="js/jquery/jquery-1.3.2.min.js" type="text/javascript"></script>
<script src="js/function.js" type="text/javascript"></script>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />

<script type="text/javascript" src="js/jquery.cycle.all.2.74.js"></script>
<link rel="stylesheet" href="css/jquery.tooltip.css" />
<link rel="stylesheet" href="css/screen.css" />
<script src="tool_lib/jquery.bgiframe.js" type="text/javascript"></script>
<script src="tool_lib/jquery.dimensions.js" type="text/javascript"></script>
<script src="tool_lib/jquery.tooltip.js" type="text/javascript"></script>
<script src="tool_lib/chili-1.7.pack.js" type="text/javascript"></script>





<script src="js/jquery/jquery.validate.min.js" type="text/javascript"></script>
<script src="js/jquery/jquery.maskedinput-1.2.2.js" type="text/javascript"></script>
<script src="js/jquery/jquery.alphanumeric.js" type="text/javascript"></script>
<script src="js/jquery/jquery.alerts.js" type="text/javascript"></script>
<script src="js/formValidator.js" type="text/javascript"></script>


<link rel="stylesheet" href="css/jquery.tooltip.css" />
<link rel="stylesheet" href="css/screen.css" />
<link rel="stylesheet" href="css/jquery.css" />
<link rel="stylesheet" href="css/jquery.alerts.css" />
<link rel="stylesheet" href="css/stylesheet.css" />



<script type="text/javascript">

$(document).ready(function() {
    $('.slideshow').cycle({
		fx: 'fade' // choose your transition type, ex: fade, scrollUp, shuffle, etc...
	});
});
</script>
<!--Start Logo-->

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="content-style-type" content="text/css" />

<meta http-equiv="content-language" content="" />
<meta http-equiv="imagetoolbar" content="no" />
<meta name="resource-type" content="document" />
<meta name="distribution" content="global" />
<meta name="copyright" content="2010 Nethaat" />
<meta name="description" content="" />

<table>
<tr>
<td>	
<div class="error" >
<img src="images/warning.gif" alt="Warning!" class="error_div_warning" align="middle" />
 <span>
<?php echo $error_msg;?>
</span>
<br clear="all"/>
</div>
<div id='update_msg' ><strong><?php echo $update_msg;?></strong></div>
<div id='error_warning_msg'>
<img src="images/warning_green.gif" alt="Warning!" class="error_div_warning" align="middle" /> <span style="color:#45941F"><?php echo $error_warning_msg;?></span>
</div>



</td></tr>

<script language="javascript">
function test()
{
	if(document.getElementById('testtemp').value=='')
	{
		document.getElementById('div_testtemp').innerHTML='PLease Enter the field';	
		document.getElementById('testtemp').style.backgroundColor='#FFEBE8';	
		return false;
	}
	else
	return true;
	
}

</script>
<form action="" name="frmtesttemp" id="frmtesttemp" method="post" onsubmit="return test();">


<tr><td>
	<div class="selllablefield">
	<input type="text" value="" name="testtemp" id="testtemp" class="required"  />
	</div>
	<span style="color:red;" id="div_testtemp"></span>
    <div >


</div>
</td></tr>
<tr><td>
<input type="submit" value="add" name="add" />

</td></tr>

</form>
</table>