<?php /* Smarty version 2.6.18, created on 2012-02-04 16:30:17
         compiled from header.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'config_load', 'header.tpl', 3, false),array('modifier', 'clear_input', 'header.tpl', 16, false),array('modifier', 'basename', 'header.tpl', 17, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php echo smarty_function_config_load(array('file' => "constants.conf"), $this);?>

<head>
<title>

<?php echo $this->_tpl_vars['site_page_title']; ?>


</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="content-style-type" content="text/css" />
<meta http-equiv="content-language" content="<?php echo $this->_tpl_vars['S_USER_LANG']; ?>
" />
<meta http-equiv="imagetoolbar" content="no" />
<meta name="resource-type" content="document" />
<meta name="distribution" content="global" />
<meta name="copyright" content="2010 <?php echo ((is_array($_tmp=$this->_tpl_vars['site_title'])) ? $this->_run_mod_handler('clear_input', true, $_tmp) : smarty_modifier_clear_input($_tmp)); ?>
" />
<?php if (((is_array($_tmp=$_SERVER['PHP_SELF'])) ? $this->_run_mod_handler('basename', true, $_tmp) : basename($_tmp)) == 'index.php'): ?>
<meta name="description" content="Nethaat is a Hand made items online marketplace for sellers & buyers of hand made items." />
<?php else: ?>
<meta name="description" content="<?php echo ((is_array($_tmp=$this->_tpl_vars['META_DESCRIPTION'])) ? $this->_run_mod_handler('clear_input', true, $_tmp) : smarty_modifier_clear_input($_tmp)); ?>
" />
<?php endif; ?>

<?php if (((is_array($_tmp=$_SERVER['PHP_SELF'])) ? $this->_run_mod_handler('basename', true, $_tmp) : basename($_tmp)) == 'index.php'): ?>
<meta name="keywords" content="Nethaat, Hand Made Items, Online handmade, Handmade online." />
<?php else: ?>
<meta name="keywords" content="<?php echo ((is_array($_tmp=$this->_tpl_vars['META_KEYWORDS'])) ? $this->_run_mod_handler('clear_input', true, $_tmp) : smarty_modifier_clear_input($_tmp)); ?>
" />
<?php endif; ?>

<meta name="generator" content="<?php echo ((is_array($_tmp=$this->_tpl_vars['site_title'])) ? $this->_run_mod_handler('clear_input', true, $_tmp) : smarty_modifier_clear_input($_tmp)); ?>
" />
<style type="text/css">
<!--
@import url("<?php echo $this->_tpl_vars['baseUrl']; ?>
css/stylesheet.css");
-->
</style>
<script src="<?php echo $this->_tpl_vars['baseUrl']; ?>
/js/jquery.js" type="text/javascript"></script>
<script src="<?php echo $this->_tpl_vars['baseUrl']; ?>
/js/function.js" type="text/javascript"></script>
<script src="<?php echo $this->_tpl_vars['baseUrl']; ?>
tool_lib/jquery.bgiframe.js" type="text/javascript"></script>
<script src="<?php echo $this->_tpl_vars['baseUrl']; ?>
tool_lib/jquery.dimensions.js" type="text/javascript"></script>
<script src="<?php echo $this->_tpl_vars['baseUrl']; ?>
tool_lib/jquery.tooltip.js" type="text/javascript"></script>
<script src="<?php echo $this->_tpl_vars['baseUrl']; ?>
tool_lib/chili-1.7.pack.js" type="text/javascript"></script>

<script src="<?php echo $this->_tpl_vars['baseUrl']; ?>
js/function.js" type="text/javascript"></script>
<link rel="shortcut icon" href="<?php echo $this->_tpl_vars['baseUrl']; ?>
favicon.ico" type="image/x-icon" />
<script type="text/javascript" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
js/jquery.cycle.all.2.74.js"></script>
<link rel="stylesheet" href="<?php echo $this->_tpl_vars['baseUrl']; ?>
css/jquery.tooltip.css" />
<link rel="stylesheet" href="<?php echo $this->_tpl_vars['baseUrl']; ?>
css/screen.css" />

<?php echo '
<script type="text/javascript">
function btn_show(d)
{
	 document.getElementById(d).style.display=\'block\';
}
function btn_hide(d)
{
	 document.getElementById(d).style.display=\'none\';
}
$(function(){
$(\'#set1 *\').tooltip();
$(\'#set2 *\').tooltip();
});

function MM_CheckFlashVersion(reqVerStr,msg){
  with(navigator){
    var isIE  = (appVersion.indexOf("MSIE") != -1 && userAgent.indexOf("Opera") == -1);
    var isWin = (appVersion.toLowerCase().indexOf("win") != -1);
    if (!isIE || !isWin){  
      var flashVer = -1;
      if (plugins && plugins.length > 0){
        var desc = plugins["Shockwave Flash"] ? plugins["Shockwave Flash"].description : "";
        desc = plugins["Shockwave Flash 2.0"] ? plugins["Shockwave Flash 2.0"].description : desc;
        if (desc == "") flashVer = -1;
        else{
          var descArr = desc.split(" ");
          var tempArrMajor = descArr[2].split(".");
          var verMajor = tempArrMajor[0];
          var tempArrMinor = (descArr[3] != "") ? descArr[3].split("r") : descArr[4].split("r");
          var verMinor = (tempArrMinor[1] > 0) ? tempArrMinor[1] : 0;
          flashVer =  parseFloat(verMajor + "." + verMinor);
        }
      }
      // WebTV has Flash Player 4 or lower -- too low for video
      else if (userAgent.toLowerCase().indexOf("webtv") != -1) flashVer = 4.0;

      var verArr = reqVerStr.split(",");
      var reqVer = parseFloat(verArr[0] + "." + verArr[2]);
  
      if (flashVer < reqVer){
        if (confirm(msg))
          window.location = "http://www.macromedia.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash";
      }
    }
  } 
}
function loder_onload()
{/*
var str ="<img src=\'images/icon_loading.gif\' alt=\'Please wait\' />";
document.write(str);
*/}



  var _gaq = _gaq || [];
  _gaq.push([\'_setAccount\', \'UA-20393916-1\']);
  _gaq.push([\'_setDomainName\', \'.nethaat.com\']);
  _gaq.push([\'_trackPageview\']);

  (function() {
    var ga = document.createElement(\'script\'); ga.type = \'text/javascript\'; ga.async = true;
    ga.src = (\'https:\' == document.location.protocol ? \'https://ssl\' : \'http://www\') + \'.google-analytics.com/ga.js\';
    var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(ga, s);
  })();
  

function createCookie(name,value,days)
 {
	if (days) {
		var date = new Date();
		date.setTime(date.getTime()+(days*24*60*60*1000));
		var expires = "; expires="+date.toGMTString();
	}
	else var expires = "";
	document.cookie = name+"="+value+expires+"; path=/";
}

</script>

'; ?>


</head>
<body <?php if ($this->_tpl_vars['page_base_name'] == 'show_tutorial.php'): ?>onload="MM_CheckFlashVersion('7,0,0,0','Content on this page requires a newer version of Macromedia Flash Player. Do you want to download it now?');"<?php endif; ?> 
  >
<div id="mainComment" >
	<!--//show_accountsb(NUM,ACC)
	onclick="return show_accounts('1','s')"

//show_accounts(NUM,ACC)
<!-- START DIV for success/Failure messages -->
	<?php if ($this->_tpl_vars['SUCCESS_MESSAGE'] != ""): ?>
		<div id="success_message">
		<b>Success! </b><?php echo $this->_tpl_vars['SUCCESS_MESSAGE']; ?>
.
		</div>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['ERROR_MESSAGE'] != ""): ?>
		<div id="error_message">
		<b>Failure! </b><?php echo $this->_tpl_vars['ERROR_MESSAGE']; ?>
.
		</div>
	<?php endif; ?>
	<!-- END DIV for success/Failure messages -->
		<!--Start Menu-->
			<div class="menuBg">
				<div class="fl"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/menu_lft_cone.jpg" alt="" /></div>
				<div class="fr"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/menu_rt_cone.jpg" alt="" /></div>
				<div class="menuLftMain" style="border:0px solid #FF0000;">
					<ul class="menuLink">
						<li><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
index.php">Home</a></li>
						<li><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
registration.php">Open A Store</a></li>
						<li><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
buyer.php">Buy</a></li>
						<li><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
hatting-items.php">Haating</a></li>
						<li><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
blog">Blog</a></li>
						<li  >
						<?php if ($_SESSION['session_user_id'] == ""): ?>
						<a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
login.php">Login</a>
						<?php else: ?>
						<a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
logout.php" 
						onclick="createCookie('cook_babys','c',0);createCookie('cook_baby','c',0);">Logout</a>
						<?php endif; ?>
						</li>
						<li  style="border:0px solid #00FF00;width:70px;" >					
					         <a href='<?php echo $this->_tpl_vars['baseUrl']; ?>
registration.php' >Signup</a>
						</li>
						<li class="last"  style="border:0px solid #00FF00;width:160px;">
					
					<a href='<?php echo $this->_tpl_vars['baseUrl']; ?>
advanced_serch.php'>Advanced Search</a> 
						
						</li>
					</ul>
				</div>	
				<div class="searchRt">
					<form name="frm" action="<?php echo $this->_tpl_vars['baseUrl']; ?>
keywords.php" method="get">
					
					<input name="search_Keywords" type="text" class="srhInputFld" value="Keywords" onfocus="clearText(this)" onblur="replaceText(this)" /> 
					<input name="" type="image" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/go.jpg" /> 
<!--<img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/srh_cart.jpg" alt="" class="vAlign" hspace="2" />-->
				</form>
				</div>			
				<div class="clear"></div>
			</div>
		<!--End Menu-->