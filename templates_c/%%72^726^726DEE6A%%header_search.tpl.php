<?php /* Smarty version 2.6.18, created on 2011-05-11 09:45:50
         compiled from header_search.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'basename', 'header_search.tpl', 78, false),)), $this); ?>
<!--Start Logo-->
			
			<div id="logoMain" >
				<div class="logoLft" style="width:263px;">
				<a href='http://www.nethaat.com'><img  src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/logo.jpg" alt="" class="logo" /></a>
				<?php if ($_SESSION['session_user_id']): ?>
				<!--<div class="welcomeDetail">
				<b>Welcome!</b><br /> <?php echo $_SESSION['session_user_name']; ?>
<br /><br />
				<b>Last Login:</b><br /> <?php echo $_SESSION['session_last_login']; ?>
 <br /><br />
				<br /><br />
				<a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
my_account.php" style='font-size:14px;font-weight:bold;' >My Account</a>
				</div>-->
				<?php endif; ?>
				</div>
			<div style="width:680px;" id="wrap">

 

<div class="welcomeDetail" style="position:absolute; left:5px; color:#000; width:250px; text-align:left;">
	<?php if ($_SESSION['session_user_id']): ?>
                                                                Welcome! <b><?php echo $_SESSION['session_user_name']; ?>
</b><br />

                                                                <b>Last Login:</b><?php echo $_SESSION['session_last_login']; ?>
 <br /><br />

                                                                <a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
my_account.php" style='font-size:14px;font-weight:bold;' >My Account</a><?php endif; ?>                                                    </div>
<!--
<img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/banner/moth_day.jpg">

                -->	                                

			<img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/banner/moth_day.jpg" />
		</div>
				<!--
				stop for 1 week
				<div id="wrap">
    <div class="slidetabs" style="display:none;">
    <a class="current" href="#">1</a>
    <a class="" href="#">2</a>
    <a href="#">3</a>
    <a href="#">4</a>
    <a href="#">5</a>
    </div>
    <div class="images">
        <div class="box" style="display: block;"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/banner.jpg" alt="" /></div>
        <div class="box"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/creativity.jpg" alt="" /></div>
        <div class="box"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/gifting.jpg" alt="" /></div>
        <div class="box"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/hatting.jpg" alt="" /></div>
        <div class="box"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/give-your-hand.jpg" alt="" /></div>
    </div>
    <div style="position:absolute; bottom:5px; right:5px;" id="pause"><a href="javascript://" onclick='$(".slidetabs").data("slideshow").stop();'><img src="images/pause_icon.png" alt="" border="0" onclick="btn_show('play'), btn_hide('pause')" /></a></div>
    <div style="position:absolute; bottom:5px; right:5px; display:none;" id="play"><a href="javascript://" onclick='$(".slidetabs").data("slideshow").play();'><img src="images/paly_icon.png" alt="" border="0" onclick="btn_show('pause'),btn_hide('play')" /></a></div>
   <?php echo '
    <script language="JavaScript">
    // What is $(document).ready ? See: http://flowplayer.org/tools/documentation/basics.html#document_ready
   
    $(function() {
    
    $(".slidetabs").tabs(".images > div", {
    
        // enable "cross-fading" effect
        effect: \'fade\',
        fadeOutSpeed: "slow",
    
        // start from the beginning after the last tab
        rotate: true
    
    // use the slideshow plugin. It accepts its own configuration
    }).slideshow();
    });
    </script>
'; ?>

   
</div>-->
							  
							  <div class="clear"></div>
			</div>
		<!--End Logo-->
		<?php if (((is_array($_tmp=$_SERVER['PHP_SELF'])) ? $this->_run_mod_handler('basename', true, $_tmp) : basename($_tmp)) == 'index.php'): ?>
		<div class="tagText">An interactive online marketplace for sellers and buyers of hand made items.</div>
		<div>
<a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
buyer.php?main_cat_id=1"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/artisans.jpg" alt="" border="0" style="margin-right:23px;"/></a>
<a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
buyer.php?main_cat_id=2"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/artists.jpg" alt="" style="margin-right:23px;"border="0"/></a>
<a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
buyer.php?main_cat_id=3"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/designers.jpg" alt="" border="0" style="margin-right:23px;" /></a>
<a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
buyer.php?main_cat_id=4"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/homemakers.jpg" style="margin-right:0px;" alt="" border="0" /></a></div>
		<?php endif; ?>		