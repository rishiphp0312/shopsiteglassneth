<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
{config_load file="constants.conf"}
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{$site_title} :: {$site_page_title}</title>
<link rel="shortcut icon" href="{$baseUrl}favicon.gif" />
<style type="text/css">
<!--
@import url("{$baseUrl}css/admin_style.css");
@import url("{$baseUrl}css/simpletree.css");
@import url("{$baseUrl}css/jquery.css");
@import url("{$baseUrl}css/jquery.alerts.css");
-->
</style>


<!-- Script for JS validation -->
<script src="{$baseUrl}js/jquery/jquery-1.3.2.min.js" type="text/javascript"></script>
<script src="{$baseUrl}js/jquery/jquery.validate.min.js" type="text/javascript"></script>
<script src="{$baseUrl}js/jquery/jquery.maskedinput-1.2.2.js" type="text/javascript"></script>
<script src="{$baseUrl}js/jquery/jquery.alphanumeric.js" type="text/javascript"></script>
<script src="{$baseUrl}js/jquery/jquery.alerts.js" type="text/javascript"></script>
<script src="{$baseUrl}js/admin_formValidator.js" type="text/javascript"></script>
<script src="{$baseUrl}js/function.js" type="text/javascript"></script>

<!-- Jquery Fancy Box -->
<!--<link rel="stylesheet" type="text/css" href="{$baseUrl}fancybox/jquery.fancybox-1.2.6.css" media="screen" />
<script type="text/javascript" src="{$baseUrl}fancybox/jquery.fancybox-1.2.6.pack.js"></script>-->

<!-- Script for AJAX submit -->
<script type="text/javascript" src="{$baseUrl}js/build/yahoo-dom-event/yahoo-dom-event.js"></script>
<script type="text/javascript" src="{$baseUrl}js/build/connection/connection-min.js"></script>


<script type="text/javascript" src="{$baseUrl}js/simpletreemenu.js"> </script>
<link rel="shortcut icon" href="{$baseUrl}favicon.ico" />
{literal}
<!--
<script type="text/javascript">
	/*
	$(document).ready(function(){
		$("a.property_nbrhood").fancybox({
		'hideOnContentClick': false,
		'frameWidth'			: 455,
		'frameHeight'			: 300		
		});
	});
	*/
</script>
-->
{/literal}	
</head>
<body >
<table align="center" width="98%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="70" colspan="2" align="left" class="link">
	  <div style="margin-bottom:10px; margin-top:10px; float:left; text-decoration:none;">
	  	<img src="../images/logo.jpg" border="0" alt="Nethaat" onclick="window.location='{$baseUrl}';" style="cursor:pointer;" />	  </div>
	<div style="margin-right:5px; margin-top:60px; float:right; padding-bottom:10px">
	{if $smarty.session.session_admin_user_id!=""}
		<a href="admin_logout.php">Logout</a>
	{/if}	</div>	</td>
  </tr>
  {if $smarty.session.session_admin_user_id!=""}
  <tr bgcolor="#AFDDF7">
  <td height="25" class="err_msg" style="padding-right:5px;" align="right">&nbsp;
  
  </td>
    <td align="right" class="err_msg" style="padding-right:5px;">
	
  <i><b>Welcome</b> - {$smarty.session.session_admin_name}, Date - {$smarty.session.login_date} Time - {$smarty.session.login_time}</i>
  </td>
  </tr>
  {else}
  <tr bgcolor="#AFDDF7"><td colspan="2">&nbsp;</td></tr>
  {/if}
  <tr>
  <td colspan="2">
  <!-- START DIV for success/Failure messages -->
	{if $SUCCESS_MESSAGE!=""}
	<div id="success_message" style="width:960px;">
	<b>Success!</b> {$SUCCESS_MESSAGE}.	</div>
	{/if}
	{if $ERROR_MESSAGE!=""}
	<div id="error_message">
	<b>Failure!</b> {$ERROR_MESSAGE}.	</div>
	{/if}
	<!-- END DIV for success/Failure messages -->  </td>
  </tr>  
</table>
