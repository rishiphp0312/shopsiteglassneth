<?php /* Smarty version 2.6.18, created on 2011-05-11 09:31:29
         compiled from featured_store_information.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'ucfirst', 'featured_store_information.tpl', 57, false),array('modifier', 'truncate', 'featured_store_information.tpl', 63, false),array('modifier', 'convert_price', 'featured_store_information.tpl', 65, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header_search_banner.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<!--Start Middle-->
<div id="middleMain">
	<div id="insidemiddlemian">
		<div>
		<div class="clear"></div>
			<div class="buyermain">
				<!--Start item detail -->
				<div>
				<div class="shoppinghdinside" style="border-bottom:none;"><?php echo $this->_tpl_vars['username']; ?>
</div>
				<div class="goToback"><a href='javascript://' onclick='history.go(-1)'>Go Back</a></div>
				<div class="clear"></div>
					<div class="iteminsidedetl">
					<!--<div class="shoppingimgbox"><img 
					
					src="<?php echo $this->_tpl_vars['baseUrl']; ?>
getthumb.php?w=415&h=120&fromfile=uploads/<?php echo $this->_tpl_vars['username']; ?>
/store_logos/<?php echo $this->_tpl_vars['store_logo']; ?>
" onerror="this.src='<?php echo $this->_tpl_vars['baseUrl']; ?>
images/item_small_img.jpg'; this.style.width='415px'; this.style.height='120px';" alt="" /></div>-->
						<div style='padding-top:20px;'>
							<div class="insideitemhd" >About the Shop</div>
							<div style="text-align:justify;"><?php echo $this->_tpl_vars['v_welcome']; ?>
</div>
						</div>
							
						<div class="contactmain">
							<div class="insideitemhd">Contact Details</div>
							<div class="contactlable">Name</div>
							<div class="contactlabletext"><?php echo $this->_tpl_vars['f_name']; ?>
 <?php echo $this->_tpl_vars['l_name']; ?>
</div>
							<div class="clear"></div>
							<div class="contactlable">Address1</div>
							<div class="contactlabletext"><?php echo $this->_tpl_vars['address1']; ?>
</div>
							<div class="clear"></div>
							<div class="contactlable">Address2</div>
							<div class="contactlabletext"><?php echo $this->_tpl_vars['address2']; ?>
</div>
							<div class="clear"></div>
							<div class="contactlable">City</div>
							<div class="contactlabletext"><?php echo $this->_tpl_vars['city']; ?>
</div>
							<div class="clear"></div>
							<div class="contactlable">State</div>
							<div class="contactlabletext"><?php echo $this->_tpl_vars['state']; ?>
</div>
							<div class="clear"></div>
							<div class="contactlable">Zip Code</div>
							<div class="contactlabletext"><?php echo $this->_tpl_vars['zipcode']; ?>
</div>
							<div class="clear"></div>
							<div class="contactlable">Country</div>
							<div class="contactlabletext"><?php echo $this->_tpl_vars['user_country_name']; ?>
</div>
							<div class="clear"></div>
						</div>
						<?php if ($this->_tpl_vars['num_rows_items1'] > 0): ?>
						<!--Store category -->
						<div>
						<div class="insideitemhd">Store Catalogue</div>
							<div class="storeCategory">
								<div class="inidebgbox">
									<?php $_from = $this->_tpl_vars['users_items_details']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['cat'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['cat']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['val_items']):
        $this->_foreach['cat']['iteration']++;
?>
                            									<div class="storeCategorybox">
										<div class="categoryimgbox">
	<a href="item-details.php?details_item_value=<?php echo $this->_tpl_vars['val_items']['show_item_id']; ?>
<?php if ($this->_tpl_vars['val_items']['coupon_code'] != '' && $this->_tpl_vars['val_items']['start_date'] <= $this->_tpl_vars['date_forcheck'] && $this->_tpl_vars['val_items']['coupon_status'] == 1 && $this->_tpl_vars['val_items']['end_date'] >= $this->_tpl_vars['date_forcheck']): ?>&d=1<?php endif; ?>" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['val_items']['title'])) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
">
										<img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
getthumb.php?w=103&h=86&fromfile=uploads/<?php echo $this->_tpl_vars['val_items']['image1']; ?>
" onerror="this.src='<?php echo $this->_tpl_vars['baseUrl']; ?>
images/item_small_img.jpg'; this.style.width='103px'; this.style.height='86px';" width="103" height="86" alt="" />
										</a>
										</div>
										<div>
								<a href="item-details.php?details_item_value=<?php echo $this->_tpl_vars['val_items']['show_item_id']; ?>
<?php if ($this->_tpl_vars['val_items']['coupon_code'] != '' && $this->_tpl_vars['val_items']['coupon_status'] == 1 && $this->_tpl_vars['val_items']['start_date'] <= $this->_tpl_vars['date_forcheck'] && $this->_tpl_vars['val_items']['end_date'] >= $this->_tpl_vars['date_forcheck']): ?>&d=1<?php endif; ?>"
 title="<?php echo ((is_array($_tmp=$this->_tpl_vars['val_items']['title'])) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['val_items']['title'])) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 20) : smarty_modifier_truncate($_tmp, 20)); ?>
</a><br />
                                                                            <span style="color:red;">
                                                                            <?php echo ((is_array($_tmp=$this->_tpl_vars['val_items']['cost_item'])) ? $this->_run_mod_handler('convert_price', true, $_tmp) : smarty_modifier_convert_price($_tmp)); ?>

                                                                            <?php if ($this->_tpl_vars['val_items']['discount_type'] == 0): ?>
                                                                            <?php $this->assign('disc_price', "(".($this->_tpl_vars['val_items']).".discount_amount/100)*".($this->_tpl_vars['val_items']).".cost_item"); ?>
                                                                            <?php else: ?>
                                                                            <?php $this->assign('disc_price', $this->_tpl_vars['val_items']['cost_item']-$this->_tpl_vars['val_items']['discount_amount']); ?>
                                                                            <?php endif; ?>
                                                                            </span>
<br>
                                                                    <?php if ($this->_tpl_vars['val_items']['coupon_code'] != '' && $this->_tpl_vars['val_items']['coupon_status'] == 1 && $this->_tpl_vars['val_items']['start_date'] <= $this->_tpl_vars['date_forcheck'] && $this->_tpl_vars['val_items']['end_date'] >= $this->_tpl_vars['date_forcheck']): ?>
                                                                    <span style="color:red;font-size:10px;">Discount applicable                                                                     </span>
                                                                    <?php endif; ?>

				
                                                                <span></span>
                                                               <?php if ($this->_tpl_vars['val_items']['hatting_status'] == 1): ?>
                                                                 <fieldset id="set1">
                                                                   <?php if ($_SESSION['session_user_id'] == ''): ?>
                                                                   <span style='color:#9ac243;'>&nbsp;&nbsp;
                                                                   <label title=" In order to negotiate online for this item on haating ,please log in. " ><b>Haat It </b></label>
                                                                   </span>
                                                                   <?php else: ?>
                                                                   <span style='color:#9ac243;'>&nbsp;&nbsp;
                                                                   <label title=" Click on the item to negotiate online." ><b>Haat It </b></label>
                                                                   </span><?php endif; ?><?php echo '<script >
                                                                   <code class="mix">$(\'#set1 *\').tooltip();</code>
                                                                   </script>'; ?>

                                                                 </fieldset>
                                                                <?php endif; ?>
                                                                <?php if ($this->_tpl_vars['val_items']['hatting_status'] != 1): ?>
                                                               <span   style='color:#ffffff;'>&nbsp;&nbsp;<b>Haat It</b> </span>
                                                                <?php endif; ?>

									  </div>
									</div>
									<?php if ($this->_foreach['cat']['iteration']%4 == 0): ?>
									<div class="clear"></div>
									<?php endif; ?>									<?php endforeach; endif; unset($_from); ?>
									<div class="clear"></div>
									<?php if ($this->_tpl_vars['pageLink']): ?>
									<div>
									<?php echo $this->_tpl_vars['page_counter']; ?>
 records&nbsp;&nbsp;&nbsp;
									<span style="float:right;padding-top:5px;height:20px;" class="admn_pagination_msg_board123"><?php echo $this->_tpl_vars['pageLink']; ?>
</span>
									</div>
									<?php endif; ?>
								</div>
							</div>									
						</div>
						<!--End category -->
						<?php endif; ?>

						<div class="insideitemhd">Payment Mode</div>
						<div class="paymnMathodbdr">
							<div style="position:absolute; top:-15px; left:9px;"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/paypal_logo.jpg" alt="" /></div>								
							<div class="paypalimg"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/paypal_cart.jpg" alt="" /></div>
						</div>
					</div>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "store_riht_links.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<div class="clear"></div>
				</div>
				<!--End item detail -->		
			</div>
			<div class="gap"></div>
	</div>
</div>
<div class="clear"></div>
<!--End Middle-->
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>