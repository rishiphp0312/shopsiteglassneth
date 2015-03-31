<?php /* Smarty version 2.6.18, created on 2011-12-09 18:30:33
         compiled from index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'ucfirst', 'index.tpl', 21, false),array('modifier', 'truncate', 'index.tpl', 25, false),array('modifier', 'convert_price', 'index.tpl', 25, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header_search.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<!--Start Middle-->
<div id="middleMain"> 
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "left_category.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<div id="middleRtMain" >
		<!--End Tab Link-->
			<div class="gap" style="height:5px;"></div>
			<div class="imgCatSec">
				<div class="catItemBg">
					<div class="catItemHed">
<img src="images/cat_hdbull.jpg" alt="" class="vAlign" /> Featured Items</div>
						<div class="clear"></div>
				</div>
				<div class="grpImgBotBdr">
					<?php if ($this->_tpl_vars['every_thing_handpicked_all']): ?>
					<?php $_from = $this->_tpl_vars['every_thing_handpicked_all']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['csdf'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['csdf']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['v']):
        $this->_foreach['csdf']['iteration']++;
?>
					                                         <div class="imgLftBdr">
					<div><a href="item-details.php?details_item_value=<?php echo $this->_tpl_vars['v']['item_id']; ?>
" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['v']['title'])) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
getthumb.php?w=150&h=100&fromfile=uploads/<?php echo $this->_tpl_vars['v']['image1']; ?>
" onerror="this.src='<?php echo $this->_tpl_vars['baseUrl']; ?>
images/item_small_img.jpg'; this.style.width='150px'; this.style.height='100px';" alt="<?php echo ((is_array($_tmp=$this->_tpl_vars['v']['title'])) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
" class="catImgBdr" /></a></div>
					<div class="imgText">
					<a href="item-details.php?details_item_value=<?php echo $this->_tpl_vars['v']['item_id']; ?>
" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['v']['title'])) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
"><strong>
           <?php $this->assign('prd_nameh', ((is_array($_tmp=$this->_tpl_vars['v']['title'])) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp))); ?>
     <?php echo ((is_array($_tmp=$this->_tpl_vars['prd_nameh'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 20) : smarty_modifier_truncate($_tmp, 20)); ?>
</strong></a><br /><?php echo ((is_array($_tmp=$this->_tpl_vars['v']['cost_item'])) ? $this->_run_mod_handler('convert_price', true, $_tmp) : smarty_modifier_convert_price($_tmp)); ?>

                               <?php if ($this->_tpl_vars['v']['hatting_status'] == 1): ?>
                          <fieldset id="set1">
   <?php if ($_SESSION['session_user_id'] == ''): ?>
  <span style='color:#9ac243;font-weight:normal;'>&nbsp;&nbsp;
  <label title=" In order to negotiate online for this item on haating ,please log in. " ><b>Haat It </b></label>
  </span>
   <?php else: ?>
  <span style='color:#9ac243;'>&nbsp;&nbsp;
  <label title=" Click on the item to negotiate online." ><b>Haat It </b></label>
  </span><?php endif; ?><?php echo '<script language="javascript" >
  <code class="mix">$(\'#set1*\').tooltip();</code>
   </script>'; ?>

</fieldset> <?php endif; ?> </div>
					<div class="imgTextDesc"><a href="item-details.php?details_item_value=<?php echo $this->_tpl_vars['v']['item_id']; ?>
" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['v']['title'])) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['v']['description'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 20, '...', true, true) : smarty_modifier_truncate($_tmp, 20, '...', true, true)); ?>
</a></div>
					</div>
					<?php if ($this->_foreach['csdf']['iteration']%4 == 0): ?>
					<div class="clear"></div>
					<?php endif; ?>
                                       					<?php endforeach; endif; unset($_from); ?>
					<?php else: ?>
					<div>No featured items listed.</div>
					<?php endif; ?>
					<div class="clear"></div>
					<?php if ($this->_tpl_vars['total_hand_picked'] == 12): ?>
					<div style='text-align:right;'><!--<a href="handpicked-list.php">More</a>--></div>
					<?php endif; ?>
				</div>
			</div>
			<div class="imgCatSec">
				<div class="catItemBg">
					<div class="catItemHed"><img src="images/cat_hdbull.jpg" alt="" class="vAlign" /> New Items</div>
				
					<div class="clear"></div>
				</div>
				<div class="grpImgBotBdr">
		<?php if ($this->_tpl_vars['every_recent_product_all']): ?>
		<?php $_from = $this->_tpl_vars['every_recent_product_all']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['csdfall1'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['csdfall1']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['v_r']):
        $this->_foreach['csdfall1']['iteration']++;
?>
		                <div class="imgLftBdr">
		<div><a href="item-details.php?details_item_value=<?php echo $this->_tpl_vars['v_r']['item_id']; ?>
" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['v_r']['title'])) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
getthumb.php?w=150&h=100&fromfile=uploads/<?php echo $this->_tpl_vars['v_r']['image1']; ?>
" onerror="this.src='<?php echo $this->_tpl_vars['baseUrl']; ?>
images/item_small_img.jpg'; this.style.width='150px'; this.style.height='100px';" alt="<?php echo ((is_array($_tmp=$this->_tpl_vars['v_r']['title'])) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
" class="catImgBdr" /></a></div>
		<div class="imgText">
		<a href="item-details.php?details_item_value=<?php echo $this->_tpl_vars['v_r']['item_id']; ?>
" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['v_r']['title'])) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
"><strong>
<?php $this->assign('prd_name', ((is_array($_tmp=$this->_tpl_vars['v_r']['title'])) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp))); ?>
                 <?php echo ((is_array($_tmp=$this->_tpl_vars['prd_name'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 20) : smarty_modifier_truncate($_tmp, 20)); ?>
</strong></a><br />
                 <?php echo ((is_array($_tmp=$this->_tpl_vars['v_r']['cost_item'])) ? $this->_run_mod_handler('convert_price', true, $_tmp) : smarty_modifier_convert_price($_tmp)); ?>


<?php if ($this->_tpl_vars['v_r']['hatting_status'] == 1): ?>
 <fieldset id="set2">
   <?php if ($_SESSION['session_user_id'] == ''): ?>
  <span style='color:#9ac243;font-weight:normal;'>&nbsp;&nbsp;
  <label title=" In order to negotiate online for this item on haating ,please log in. " ><b>Haat It </b></label>
  </span>
   <?php else: ?>
  <span style='color:#9ac243;'>&nbsp;&nbsp;
  <label title=" Click on the item to negotiate online." ><b>Haat It </b></label>
  </span><?php endif; ?><?php echo '<script >
  <code class="mix">$(\'#set2 *\').tooltip();</code>
   </script>'; ?>

</fieldset>

 <?php endif; ?>  </div>
		  <div class="imgTextDesc"><a href="item-details.php?details_item_value=<?php echo $this->_tpl_vars['v_r']['item_id']; ?>
" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['v_r']['title'])) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['v_r']['description'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 20, '...', true, true) : smarty_modifier_truncate($_tmp, 20, '...', true, true)); ?>
</a></div>
		  </div>
		  <?php if ($this->_foreach['csdfall1']['iteration']%4 == 0): ?>
		  <div class="clear"></div>
		  <?php endif; ?>
                 					<?php endforeach; endif; unset($_from); ?>
					<?php else: ?>
					<div>No items listed.</div>
					<?php endif; ?>
					<div class="clear"></div>
					<?php if ($this->_tpl_vars['total_recent_listed'] == 12): ?>
					<div style='text-align:right;'><a href="buyer.php">More</a></div>
					<?php endif; ?>
				</div>
			</div>
			<div class="imgCatSec">
				<div class="catItemBg">
					<div class="catItemHed"><img src="images/cat_hdbull.jpg" alt="" class="vAlign" /> Featured Stores</div>							
					<div class="clear"></div>
				</div>
				<div class="grpImgBotBdr">
					<?php if ($this->_tpl_vars['store']): ?>
					<?php $_from = $this->_tpl_vars['store']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['store_list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['store_list']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['store']):
        $this->_foreach['store_list']['iteration']++;
?>
					<div class="imgLftBdr">
						<div><a href="http://<?php echo $this->_tpl_vars['add_this_name_www']; ?>
.<?php if ($_SERVER['HTTP_HOST'] == 'www.nethaat.com'): ?><?php echo $this->_tpl_vars['store']['username']; ?>
.<?php endif; ?><?php echo $this->_tpl_vars['add_this_name']; ?>
/featured_store_information.php" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['store']['username'])) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
getthumb.php?w=150&h=100&fromfile=uploads/<?php echo $this->_tpl_vars['store']['v_store_image']; ?>
" onerror="this.src='<?php echo $this->_tpl_vars['baseUrl']; ?>
images/item_small_img.jpg'; this.style.width='150px'; this.style.height='100px';" alt="<?php echo ((is_array($_tmp=$this->_tpl_vars['store']['username'])) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
" class="catImgBdr" /></a></div>
						<div class="imgText"><a href="http://<?php echo $this->_tpl_vars['add_this_name_www']; ?>
.<?php if ($_SERVER['HTTP_HOST'] == 'www.nethaat.com'): ?><?php echo $this->_tpl_vars['store']['username']; ?>
.<?php endif; ?><?php echo $this->_tpl_vars['add_this_name']; ?>
/featured_store_information.php" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['store']['username'])) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
"><strong><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['store']['username'])) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 20) : smarty_modifier_truncate($_tmp, 20)); ?>
</strong></a></div>
						<div class="imgTextDesc"><a href="http://<?php echo $this->_tpl_vars['add_this_name_www']; ?>
.<?php if ($_SERVER['HTTP_HOST'] == 'www.nethaat.com'): ?><?php echo $this->_tpl_vars['store']['username']; ?>
.<?php endif; ?><?php echo $this->_tpl_vars['add_this_name']; ?>
/featured_store_information.php" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['store']['username'])) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['store']['company_desc'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 20, '...', true, true) : smarty_modifier_truncate($_tmp, 20, '...', true, true)); ?>
</a></div> 
					</div>
					<?php if ($this->_foreach['store_list']['iteration']%4 == 0): ?>
					<div class="clear"></div>
					<?php endif; ?>
					<?php endforeach; endif; unset($_from); ?>
					<?php else: ?>
					<div>No featured store listed.</div>
					<?php endif; ?>
					<div class="clear"></div>
					<?php if ($this->_tpl_vars['rows'] == 13): ?>
					<div style='text-align:right;'><a href="featured_more_store.php">More</a></div>
					<?php endif; ?>
				<!--</div>
				
				
				
			</div>
		</div>
	</div>
	<div class="clear"></div>

</div>




-->
</div>
			</div>
			
			<div class="imgCatSec">
				<div class="catItemBg">
					<div class="catItemHed"><img src="images/cat_hdbull.jpg" alt="" class="vAlign" /> Recent Post</div>							
					<div class="clear"></div>
				</div>
				<div class="grpImgBotBdr" style="float:left;">
				<?php echo $this->_tpl_vars['blog']; ?>

				<div class="clear"></div>
				</div>
				
				
			</div>
			
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