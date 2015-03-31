<?php /* Smarty version 2.6.18, created on 2011-05-11 09:31:29
         compiled from header_search_banner.tpl */ ?>
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
getthumb.php?w=90&h=70&
                -->	                             
        <?php if ($this->_tpl_vars['banner_name'] != ''): ?>
			<?php if ($this->_tpl_vars['banner_status'] == 2): ?>
			<img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
uploads/<?php echo $this->_tpl_vars['username']; ?>
/banners/<?php echo $this->_tpl_vars['banner_name']; ?>
" />
			<?php else: ?>
			<img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
getthumb.php?w=690&h=179&fromfile=uploads/<?php echo $this->_tpl_vars['username']; ?>
/banners/<?php echo $this->_tpl_vars['banner_name']; ?>
" />
		    <?php endif; ?>
		<?php else: ?>
			<img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
test-baner/artisans.jpg" />
			
		<?php endif; ?>
		</div>

							  
							  <div class="clear"></div>
			</div>
		<!--End Logo-->
		