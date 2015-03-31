<?php /* Smarty version 2.6.18, created on 2011-05-11 09:31:29
         compiled from store_riht_links.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'store_riht_links.tpl', 21, false),)), $this); ?>
<!--Start right part -->
<div class="itemDetialfrmain">
	<div class="rightbox">
		<div class="rightboxhd">	<?php if ($this->_tpl_vars['username'] != ''): ?><?php echo $this->_tpl_vars['username']; ?>
<?php else: ?>N/A<?php endif; ?> Shop home info </div>
		<div class="whiteinsidebox">
			<div class="frboxinhd"><strong><?php if ($this->_tpl_vars['username'] != ''): ?><?php else: ?><?php endif; ?></strong></div>
			<div class="rightimgbox"><a href="featured_store_information.php?id=<?php echo $this->_tpl_vars['sellerid']; ?>
"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
getthumb.php?w=105&h=130&fromfile=uploads/<?php echo $this->_tpl_vars['username']; ?>
<?php if ($this->_tpl_vars['sel_logo_status'] == 2): ?>/store_logos/<?php echo $this->_tpl_vars['store_logo']; ?>
<?php else: ?>/banners/<?php echo $this->_tpl_vars['banner_name']; ?>
<?php endif; ?>" onerror="this.src='<?php echo $this->_tpl_vars['baseUrl']; ?>
images/item_small_img.jpg'; this.style.width='100px'; this.style.height='100px';" alt="" border="0" style="border:0px;" /></a></div>
			<div class="rightimgboxtext">
				<div>&nbsp;</div>
			</div>
			<div class="rightimgboxtext">
				<div><strong><br />
			
				</strong></div>
			</div>
			<div class="clear"></div>
			<div class="ratinglble">Rating :</div>
			<div class="ratinglblefr"><?php if ($this->_tpl_vars['find_percentage'] != ''): ?><a href='viewfeedback.php?rating_seller_id=<?php echo $this->_tpl_vars['sellerid']; ?>
'><?php echo $this->_tpl_vars['find_percentage']; ?>
%</a><?php else: ?>0%<?php endif; ?></div>
			<div class="clear"></div>
			<div class="ratinglble">Opened on :</div>
			<div class="ratinglblefr"><?php if ($this->_tpl_vars['reg_date'] != ''): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['reg_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
<?php else: ?>N/A<?php endif; ?></div>
			<div class="clear"></div>
			<div class="ratinglble">Location :</div>
			<div class="ratinglblefr"><?php if ($this->_tpl_vars['user_country_name'] != ''): ?><?php echo $this->_tpl_vars['user_country_name']; ?>
<?php else: ?>NA<?php endif; ?></div>
			<div class="clear"></div>
		</div>
	</div>
	<div class="rightbox">
		<div class="rightboxhd"><?php echo $this->_tpl_vars['username']; ?>
</div>
		<div class="whiteinsidebox">
			<div class="quickLinkbox"><a href="contact_seller.php"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/my_email_icon.jpg" alt="" class="vAlign" /><b>Contact us</b> </a></div>
				<div class="quickLinkbox"><a href="shoppolicy_seller.php"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/my_shop_icon.jpg" alt="" class="vAlign" /><b> Shop Policies</b></a></div>
<div class="quickLinkbox"><a href="lockerform.php"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/locar_are_icon.jpg" alt="" class="vAlign" /><b> Locker Area</b></a></div>
		
			<div class="quickLinkbox"><a href="request_custom_item.php?id=<?php echo $_SESSION['session_user_id']; ?>
"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/my_work_shop_icon.jpg" alt="" class="vAlign" /><b> My Workshop(Custom Order)</b></a></div>
			<div class="quickLinkbox"><a href="giftcard.php?id=<?php echo $_SESSION['session_user_id']; ?>
"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/purches_gift_icon.jpg" alt="" class="vAlign" /><b> Purchase *Shops* Giftcard </b></a></div>
		</div>
	</div>	
</div>
<!--End right part -->