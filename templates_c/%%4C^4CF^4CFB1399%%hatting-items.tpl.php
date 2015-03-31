<?php /* Smarty version 2.6.18, created on 2011-05-11 10:29:39
         compiled from hatting-items.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'hatting-items.tpl', 71, false),array('modifier', 'ucfirst', 'hatting-items.tpl', 71, false),array('modifier', 'convert_price', 'hatting-items.tpl', 73, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "js_css_validation.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header_search.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<!--End Logo-->
		<!--Start Middle-->
		<div id="middleMain">
			
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "left_category.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<!--Start Middle-->
		
			
			<div id="middleRtMain">
				<div style="border:0px solid #FF0000;">
				<div class="insidehd fl"><!--Buyer--></div>
				<!--start page number -->
				<?php if ($this->_tpl_vars['pageLink']): ?>
				<div class="bradcrum" style="width:650px;float:right;text-align:right;
				border:0px solid red;">
				
				<table align='center' width='100%' cellpadding='0' cellspacing='0' border='0'>
		
		<tr><td align='left' valign='middle' width='20%' >
					 <!--records-->&nbsp;&nbsp;&nbsp;</td>
					<td align='left' valign='top' width='80%' >									
						<span 
						style="float:right;padding-top:5px;height:20px;"
						<?php if ($this->_tpl_vars['pageLink'] != ''): ?> class="admn_pagination_msg_board" <?php endif; ?>>
						<?php echo $this->_tpl_vars['pageLink']; ?>
</span>
						

	</td></tr>
	
	</table>

				<!--
				
				<a href="#" class="sel">1</a><a href="#">2</a><a href="#">3</a><a href="#">
				4
				</a><a href="#">5</a><a href="#">6</a><a href="#">7</a> &nbsp;<strong>
				<img src="images/d_pre_icon.jpg" alt="" /> Prev</strong>
				<a href="#" class="npLink"><strong>Next <img src="images/next_icon.jpg" alt="" />
				</strong></a>
				-->
				
				</div><?php endif; ?>
				<!--end page number -->
				<div class="clear"></div>
					<div class="buyermain"  >
					<?php if ($this->_tpl_vars['no_records'] > 0): ?>
	<table align='center' cellpadding='0'  cellspacing='0' width='715px;' border='0' >
                                        <tr>
					<?php $_from = $this->_tpl_vars['users_items_details']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['cat'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['cat']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['val_items']):
        $this->_foreach['cat']['iteration']++;
?>
					
					<td width='140' >
		<?php if ($_REQUEST['pageNumber'] != "" && $_REQUEST['pageNumber'] > 1): ?>
		  		  <?php endif; ?>
		  
	<table align='center' cellpadding='0'  cellspacing='3' width='127px;'  border='0' >
					<tr><td colspan='4'>&nbsp;	
	</td></tr>
  <tr><td align='center' valign='top' height='100'
  style='border:1px solid #cccccc;padding:5px;height:103px;' >
	<a href="item-details.php?details_item_value=<?php echo $this->_tpl_vars['val_items']['item_id']; ?>
" ><img  src="<?php echo $this->_tpl_vars['baseUrl']; ?>
getthumb.php?w=150&h=100&fromfile=<?php if ($this->_tpl_vars['val_items']['image1'] != ''): ?>uploads/<?php echo $this->_tpl_vars['val_items']['image1']; ?>
<?php else: ?>images/item_small_img.jpg<?php endif; ?>" alt="" border="0" class="buyerimg"  /></a></td></tr>
 <tr><td align='center' valign='top' class="productNme"><a href="item-details.php?details_item_value=<?php echo $this->_tpl_vars['val_items']['item_id']; ?>
"><?php $this->assign('tit_trunc', ((is_array($_tmp=$this->_tpl_vars['val_items']['title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 20, "", true) : smarty_modifier_truncate($_tmp, 20, "", true))); ?><?php echo ((is_array($_tmp=$this->_tpl_vars['tit_trunc'])) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
</a></td></tr>
<tr><td align='center' valign='top' class="priceText">Price &nbsp;:&nbsp;<span>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['val_items']['cost_item'])) ? $this->_run_mod_handler('convert_price', true, $_tmp) : smarty_modifier_convert_price($_tmp)); ?>
   </span></td></tr>
<tr><td align='left' valign='top' >
    <table align='center' cellpadding='0'  cellspacing='0' width='127px;' border='0' >
		<tr>
		<td align='left' valign='top' class="buynow">
		<?php if ($_SESSION['session_user_id'] != '' && $_SESSION['session_user_type'] == 4): ?>
		<!--	
		<form name='frm' action='' method='post'>
        <input type='text' value='' name='bid_value' style='width:50px;' >
		<br><br>
		<input type='hidden' value='<?php echo $this->_tpl_vars['val_items']['item_id']; ?>
' name='item_value_id'>
		 <input type='submit' value='Post Bid' name='bid_submit' style='width:55px;' >
		</form>-->
			<a href="item-details.php?details_item_value=<?php echo $this->_tpl_vars['val_items']['item_id']; ?>
">
			<img src="images/buy_bow_icon.jpg" alt="" border="0" /></a>
			<a href="item-details.php?details_item_value=<?php echo $this->_tpl_vars['val_items']['item_id']; ?>
"> Buy now</a>
						<?php endif; ?>
						</td>
					<td align='right' valign='top'><span class="detailfr">
			<a href="item-details.php?details_item_value=<?php echo $this->_tpl_vars['val_items']['item_id']; ?>
" ><img src="images/details_btn.jpg" alt="" border="0" /></a></span>
					</td>
					</tr>
					</table>
					</td></tr>
				  </table>

					</td>
					
				
				
				<?php if ($this->_foreach['cat']['iteration']%4 == 0): ?>
				</tr><tr><td colspan='4'>&nbsp;</td></tr><tr>
				<?php endif; ?>
				<?php endforeach; endif; unset($_from); ?>
				</tr>
					<tr><td colspan='4'>&nbsp;</td></tr></table><?php endif; ?>
					
					</div>
					<!--start page number -->
					<div class="bradcrum" style="width:700px;">
					<!--<a href="#" class="sel">1</a><a href="#">2</a><a href="#">3</a><a href="#">4</a><a href="#">5</a>
					<a href="#">6</a><a href="#">7</a> &nbsp;<strong><img src="images/d_pre_icon.jpg" alt="" /> Prev</strong>
					<a href="#" class="npLink"><strong>Next <img src="images/next_icon.jpg" alt="" /></strong></a>
					-->
		<table align='center' width='100%' cellpadding='0' cellspacing='0' border='0'>
		<?php if ($this->_tpl_vars['no_records'] > 0): ?>
		<tr><td align='left' valign='middle' width='20%' >
					 &nbsp;&nbsp;&nbsp;</td>
					<td align='left' valign='top' width='80%' >									
						<span style="float:right;padding-top:5px;height:20px;" <?php if ($this->_tpl_vars['pageLink'] != ''): ?> class="admn_pagination_msg_board" <?php endif; ?>>
						<?php echo $this->_tpl_vars['pageLink']; ?>
</span>
						

	</td></tr>
	<?php else: ?>
<tr><td  align='left' valign='middle' style="text-align:center;color:red;font-size:14px;">
					No records found!!
						

	</td></tr>
	<?php endif; ?>
	</table>
	</div>
					
					<!--end page number -->
					</div>
			</div>	
			<div class="clear"></div>
		</div>
		<!--End Middle-->
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>