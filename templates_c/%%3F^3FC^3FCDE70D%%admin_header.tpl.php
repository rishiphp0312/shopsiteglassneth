<?php /* Smarty version 2.6.18, created on 2012-02-26 10:08:18
         compiled from admin_header.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'config_load', 'admin_header.tpl', 3, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php echo smarty_function_config_load(array('file' => "constants.conf"), $this);?>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->_tpl_vars['site_title']; ?>
 :: <?php echo $this->_tpl_vars['site_page_title']; ?>
</title>
<link rel="shortcut icon" href="<?php echo $this->_tpl_vars['baseUrl']; ?>
favicon.gif" />
<style type="text/css">
<!--
@import url("<?php echo $this->_tpl_vars['baseUrl']; ?>
css/admin_style.css");
@import url("<?php echo $this->_tpl_vars['baseUrl']; ?>
css/simpletree.css");
@import url("<?php echo $this->_tpl_vars['baseUrl']; ?>
css/jquery.css");
@import url("<?php echo $this->_tpl_vars['baseUrl']; ?>
css/jquery.alerts.css");
-->
</style>


<!-- Script for JS validation -->
<script src="<?php echo $this->_tpl_vars['baseUrl']; ?>
js/jquery/jquery-1.3.2.min.js" type="text/javascript"></script>
<script src="<?php echo $this->_tpl_vars['baseUrl']; ?>
js/jquery/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?php echo $this->_tpl_vars['baseUrl']; ?>
js/jquery/jquery.maskedinput-1.2.2.js" type="text/javascript"></script>
<script src="<?php echo $this->_tpl_vars['baseUrl']; ?>
js/jquery/jquery.alphanumeric.js" type="text/javascript"></script>
<script src="<?php echo $this->_tpl_vars['baseUrl']; ?>
js/jquery/jquery.alerts.js" type="text/javascript"></script>
<script src="<?php echo $this->_tpl_vars['baseUrl']; ?>
js/admin_formValidator.js" type="text/javascript"></script>
<script src="<?php echo $this->_tpl_vars['baseUrl']; ?>
js/function.js" type="text/javascript"></script>

<!-- Jquery Fancy Box -->
<!--<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['baseUrl']; ?>
fancybox/jquery.fancybox-1.2.6.css" media="screen" />
<script type="text/javascript" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
fancybox/jquery.fancybox-1.2.6.pack.js"></script>-->

<!-- Script for AJAX submit -->
<script type="text/javascript" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
js/build/yahoo-dom-event/yahoo-dom-event.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
js/build/connection/connection-min.js"></script>


<script type="text/javascript" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
js/simpletreemenu.js"> </script>
<link rel="shortcut icon" href="<?php echo $this->_tpl_vars['baseUrl']; ?>
favicon.ico" />
<?php echo '
<!--
<script type="text/javascript">
	/*
	$(document).ready(function(){
		$("a.property_nbrhood").fancybox({
		\'hideOnContentClick\': false,
		\'frameWidth\'			: 455,
		\'frameHeight\'			: 300		
		});
	});
	*/
</script>
-->
'; ?>
	
</head>
<body >
<table align="center" width="98%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="70" colspan="2" align="left" class="link">
	  <div style="margin-bottom:10px; margin-top:10px; float:left; text-decoration:none;">
	  	<img src="../images/logo.jpg" border="0" alt="Nethaat" onclick="window.location='<?php echo $this->_tpl_vars['baseUrl']; ?>
';" style="cursor:pointer;" />	  </div>
	<div style="margin-right:5px; margin-top:60px; float:right; padding-bottom:10px">
	<?php if ($_SESSION['session_admin_user_id'] != ""): ?>
		<a href="admin_logout.php">Logout</a>
	<?php endif; ?>	</div>	</td>
  </tr>
  <?php if ($_SESSION['session_admin_user_id'] != ""): ?>
  <tr bgcolor="#AFDDF7">
  <td height="25" class="err_msg" style="padding-right:5px;" align="right">&nbsp;
  
  </td>
    <td align="right" class="err_msg" style="padding-right:5px;">
	
  <i><b>Welcome</b> - <?php echo $_SESSION['session_admin_name']; ?>
, Date - <?php echo $_SESSION['login_date']; ?>
 Time - <?php echo $_SESSION['login_time']; ?>
</i>
  </td>
  </tr>
  <?php else: ?>
  <tr bgcolor="#AFDDF7"><td colspan="2">&nbsp;</td></tr>
  <?php endif; ?>
  <tr>
  <td colspan="2">
  <!-- START DIV for success/Failure messages -->
	<?php if ($this->_tpl_vars['SUCCESS_MESSAGE'] != ""): ?>
	<div id="success_message" style="width:960px;">
	<b>Success!</b> <?php echo $this->_tpl_vars['SUCCESS_MESSAGE']; ?>
.	</div>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['ERROR_MESSAGE'] != ""): ?>
	<div id="error_message">
	<b>Failure!</b> <?php echo $this->_tpl_vars['ERROR_MESSAGE']; ?>
.	</div>
	<?php endif; ?>
	<!-- END DIV for success/Failure messages -->  </td>
  </tr>  
</table>