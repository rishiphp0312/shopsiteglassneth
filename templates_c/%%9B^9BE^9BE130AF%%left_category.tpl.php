<?php /* Smarty version 2.6.18, created on 2011-05-11 10:29:40
         compiled from left_category.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'basename', 'left_category.tpl', 15, false),)), $this); ?>
<div id="mdlLftMain">
	<div class="categoryHd"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/cat_bull.jpg" alt="" align="top" /> Categories</div>
	<div class="catListBdr" style='padding:3px 4px 15px 17px;'>
		                <?php if (((is_array($_tmp=$_SERVER['PHP_SELF'])) ? $this->_run_mod_handler('basename', true, $_tmp) : basename($_tmp)) == 'index.php'): ?>
		<?php include "catalouge_menu1.php"; ?>
                <?php else: ?>
                <?php include "catalouge_menu.php"; ?>
                <?php endif; ?>
	</div>
	<?php if (((is_array($_tmp=$_SERVER['PHP_SELF'])) ? $this->_run_mod_handler('basename', true, $_tmp) : basename($_tmp)) == 'index.php' || ((is_array($_tmp=$_SERVER['PHP_SELF'])) ? $this->_run_mod_handler('basename', true, $_tmp) : basename($_tmp)) == 'show_tutorial.php'): ?>
	<div class="clear"></div>
	
	<div class="leftVideoBdr">
		<a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
show_tutorial.php" title="Lear more"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/nathaat_video.jpg" alt="Lear more" align="top" /></a>
	</div><div class="leftVideoHd"><a href='<?php echo $this->_tpl_vars['baseUrl']; ?>
show_tutorial.php'><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/cat_bull.jpg" alt="" align="top" /></a>
Click to watch video <br></div><div class="leftVideoHd" style='padding-top:0px;'>&nbsp;&nbsp;</div>
<div class="leftVideoHd"><a href='<?php echo $this->_tpl_vars['baseUrl']; ?>
show_tutorial.php'><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/cat_bull.jpg" alt="" align="top" /></a>
 How It Works</div>
	<?php endif; ?>

	<div class="newsletterMain">
		<style type="text/css">
		<!--
		@import url("<?php echo $this->_tpl_vars['baseUrl']; ?>
css/jquery.css");
		-->
		</style>
		<!-- Script for JS validation -->
		<script src="<?php echo $this->_tpl_vars['baseUrl']; ?>
js/jquery/jquery.validate.min.js" type="text/javascript"></script>
		<script src="<?php echo $this->_tpl_vars['baseUrl']; ?>
js/jquery/jquery.maskedinput-1.2.2.js" type="text/javascript"></script>
		<script src="<?php echo $this->_tpl_vars['baseUrl']; ?>
js/jquery/jquery.alphanumeric.js" type="text/javascript"></script>
		<script src="<?php echo $this->_tpl_vars['baseUrl']; ?>
js/formValidator.js" type="text/javascript"></script>
		<form name="frmNewsletter" id="frmNewsletter" method="post" action="<?php echo $this->_tpl_vars['baseUrl']; ?>
newsletter.php">
		<div class="newsletter">join for newsletter</div>
		<div class="newsLetteBg"><input name="news_letter_email" type="text" value="enter your email address here..." class="newsLtrFld email required" onfocus="clearText(this)" onblur="replaceText(this)"/></div>
		<div class="subscribe"><input name="subscribe" type="image" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/subscribe.jpg"/></div>
		</form>
	</div>
</div>
<!--
<div  style='border:0px solid red;' >
<table width="135" border="0" align='left' cellpadding="2" cellspacing="0"
title="Click to Verify - This site chose VeriSign SSL for secure
e-commerce and confidential communications.">
<tr>
<td width="135" align="center" valign="top"><script
type="text/javascript"
src="https://seal.verisign.com/getseal?host_name=www.nethaat.com&amp;size=L&
amp;use_flash=YES&amp;use_transparent=YES&amp;lang=en"></script><br
/>
<a href="http://www.verisign.com/ssl-certificate/" target="_blank"
style="color:#000000; text-decoration:none; font:bold 7px
verdana,sans-serif; letter-spacing:.5px; text-align:center;
margin:0px; padding:0px;">ABOUT SSL CERTIFICATES</a></td>
</tr>
</table>
</div>-->