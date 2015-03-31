<?php /* Smarty version 2.6.18, created on 2011-12-17 12:17:44
         compiled from items_list.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'ucfirst', 'items_list.tpl', 125, false),array('modifier', 'convert_price', 'items_list.tpl', 147, false),array('modifier', 'date_format', 'items_list.tpl', 184, false),)), $this); ?>
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

<!-- Jquery Fancy Box -->
<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['baseUrl']; ?>
fancybox/jquery.fancybox-1.2.6.css" media="screen" />
<script type="text/javascript" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
fancybox/jquery.fancybox-1.2.6.pack.js"></script>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header_search.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<!--End Logo-->
<!--Start Middle-->
<!--rishi--><div id="middleMain">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "left_category.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php echo '
<SCRIPT language="JavaScript1.2">
 function make_itactive()
{ 
alert(\'Item should be  active for haating\');
return false;
}
function confirm_msg(id, parent_id)
{
	var message = "Do you really want to delete this item?";
	//if(id==0)
	//{
	//	message += "\\n This action also delete all child categories associated with this.";
	//	jAlert("You can not delete a parent category.",\'Error\');
	//	return false;	
	//}
         //alert(id+\'=id\');
	jConfirm(message, \'Confirm\', function(r) 
	{
		if(r)
		{
			location.href=\'items_list.php?delete_item_value=\'+id;
		}
		else
		{
			return false;
		}	
	});
}
function  delete_chk()
{
	var DEL_VAL= confirm("Are you sure you want to delete?");
	if(DEL_VAL==true)
	return true;
	else
	return false;
}
function poponload(VAL)
{
	//alert(\'ss\');
	testwindow= window.open ("add_quantity.php?item_id_value="+VAL, "mywindow","location=1,status=1,scrollbars=1,width=300,height=200");
	testwindow.moveTo(100,100);
}

$(document).ready(function()
{
	
	$("a.item_quantity").fancybox({
	\'hideOnContentClick\': false,
	\'frameWidth\'			: 255,
	\'frameHeight\'			: 100		
	});
});

</SCRIPT>
			
'; ?>
			

<div id="middleRtMain">
<div class="shopmain"  >

				<div style="border:0px solid #FF0000;width:650px;" class="mainHD fl" >
				<div style="width:250px;float:left;" >				
				My Items List
				</div><div style="width:420px;float:right;text-align:center;font-size:12px;color:#333333;border:0px solid red;" ><form name="frm_serch" action="" method="get">
				<input type="radio" name="serch_item_value" checked="checked" <?php if ($this->_tpl_vars['serch_item_value_chk'] == 0 || $this->_tpl_vars['serch_item_value_chk'] == ''): ?>checked<?php endif; ?>  value="0" />All &nbsp;
				<input type="radio" name="serch_item_value" <?php if ($this->_tpl_vars['serch_item_value_chk'] == 1): ?>checked<?php endif; ?> value="1" />Active&nbsp;	<input <?php if ($this->_tpl_vars['serch_item_value_chk'] == 3): ?>checked<?php endif; ?> type="radio" name="serch_item_value" value="3"  />Hold&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="Search" class="Class_Button_ris name" style="width:80px;" name="search" />
				</form>
				</div>
				</div>
				<div class="fr" style='padding-right:10px;padding-top:5px;font-weight:bold;' ><a href='#my_account.php' onclick='history.go(-1)'>Go Back</a></div>
				<div class="clear">
					<!--Start my items -->
					 <?php if ($this->_tpl_vars['users_items_details']): ?>
					<div class="myitemmain">
					
					
						<div class="myItemtopbg" >
							<div class="titlelf" >Title 
							<a href='items_list.php?order_by=<?php echo $this->_tpl_vars['title_asc']; ?>
'><img src='images/arrow_top.gif'></a>&nbsp;
							<a href='items_list.php?order_by=<?php echo $this->_tpl_vars['title_desc']; ?>
'><img src='images/arrow_btm.gif'></a> 
	</div>
							
							<div class="itemlf"   >Cost
			<a href='items_list.php?order_by=<?php echo $this->_tpl_vars['cost_asc']; ?>
'><img src='images/arrow_top.gif'></a>&nbsp;
			<a href='items_list.php?order_by=<?php echo $this->_tpl_vars['cost_desc']; ?>
'><img src='images/arrow_btm.gif'></a> </div>
			<div class="itemleftlf"  style='width:200px;' >Available Quantity<a href='items_list.php?order_by=<?php echo $this->_tpl_vars['quantity_available_asc']; ?>
'><img src='images/arrow_top.gif'></a>&nbsp;
				<a href='items_list.php?order_by=<?php echo $this->_tpl_vars['quantity_available_desc']; ?>
'><img src='images/arrow_btm.gif'></a>
							<!--<br><br><a href='#'>Send it in Hatting</a>-->
							<!--quantity_available -->
							</div>
							<div class="costlf" >&nbsp;</div>
							<div class="clear"></div>
						</div>
						
						
						
						
			<?php $_from = $this->_tpl_vars['users_items_details']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['cat'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['cat']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['val_items']):
        $this->_foreach['cat']['iteration']++;
?>
				
						<div class="myiteminsidemain"  >
							<div class="titlelf">
							<div class="itmno"><?php if ($_REQUEST['pageNumber'] != "" && $_REQUEST['pageNumber'] > 1): ?>
		  <?php $this->assign('pageconut', $_REQUEST['pageNumber']-1); ?>
		  <?php echo @ADMIN_PAGE_NUMBER*$this->_tpl_vars['pageconut']+$this->_foreach['cat']['iteration']; ?>
.
		  <?php else: ?>
		  <?php echo $this->_foreach['cat']['iteration']; ?>
.
		  <?php endif; ?></div>
							<div >
			
	<a href="item-details.php?details_item_value=<?php echo $this->_tpl_vars['val_items']['item_id']; ?>
"><img  src="<?php if ($this->_tpl_vars['val_items']['image1'] != ''): ?><?php echo $this->_tpl_vars['baseUrl']; ?>
getthumb.php?w=150&h=50&fromfile=uploads/<?php echo $this->_tpl_vars['val_items']['image1']; ?>
<?php else: ?>images/item_small_img.jpg<?php endif; ?>" alt="" <?php if ($this->_tpl_vars['val_items']['image1'] == ''): ?>height='50' width="100"<?php endif; ?>  border='0'  class="itemimg handle" /></a>
							<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<a href="item-details.php?details_item_value=
	<?php echo $this->_tpl_vars['val_items']['item_id']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['val_items']['title'])) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
</a></div>
							<div class="clear"></div>
							</div>
							<div class="itemlf" style='border:0px solid red;'>
<?php if ($this->_tpl_vars['val_items']['locker_status'] != 0 && $this->_tpl_vars['val_items']['hatting_status'] == 0 && $this->_tpl_vars['val_items']['request_item_id'] == 0): ?>
  Locker Item's cannot be send into Haating.<br>
<?php endif; ?>
<?php if ($this->_tpl_vars['val_items']['request_item_id'] != 0): ?>
  Requested Custom Item .<br>
<?php endif; ?>
<?php if ($this->_tpl_vars['val_items']['status'] != 1 && $this->_tpl_vars['val_items']['hatting_status'] == 0): ?>
  Inactive Item cannot be send in haating.<br>
<?php endif; ?>
        <span style='text-align:left;'>
		<?php if ($this->_tpl_vars['val_items']['request_item_id'] == 0): ?>
			<?php if ($this->_tpl_vars['val_items']['status'] != 3): ?><br>
	<a title='Put this item on  Hold' alt='Put this item on  Hold' href="items_list.php?put_hold_item=<?php echo $this->_tpl_vars['val_items']['item_id']; ?>
">Put On Hold</a>
	        <?php else: ?>
	<a title='Remove this item on  Hold' alt='Remove this item on  Hold' href="items_list.php?remove_hold_item=<?php echo $this->_tpl_vars['val_items']['item_id']; ?>
">Remove Hold</a>
	       <?php endif; ?>
	   <?php endif; ?>
	</span>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ((is_array($_tmp=$this->_tpl_vars['val_items']['cost_item'])) ? $this->_run_mod_handler('convert_price', true, $_tmp) : smarty_modifier_convert_price($_tmp)); ?>

	<br><br>
	<?php if ($this->_tpl_vars['val_items']['hatting_status'] == 0 && $this->_tpl_vars['val_items']['status'] != 1): ?>
	<a href="#items_list.php?make_item_haat=<?php echo $this->_tpl_vars['val_items']['item_id']; ?>
" onclick="return make_itactive();" >Add to Haating List</a>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['val_items']['hatting_status'] == 0 && $this->_tpl_vars['val_items']['status'] == 1 && $this->_tpl_vars['val_items']['request_item_id'] == 0 && $this->_tpl_vars['val_items']['locker_status'] == 0): ?>
	<a href="items_list.php?make_item_haat=<?php echo $this->_tpl_vars['val_items']['item_id']; ?>
" >Add to Haating</a>
	<?php else: ?>
        <a href="#items_list.php?make_item_haat=<?php echo $this->_tpl_vars['val_items']['item_id']; ?>
" >&nbsp;</a>
        <?php endif; ?>
	</div>
							<div class="itemleftlf">
							<?php if ($this->_tpl_vars['val_items']['quantity_available'] == ''): ?> 0
							<?php else: ?> <?php echo $this->_tpl_vars['val_items']['quantity_available']; ?>

							<?php endif; ?>&nbsp;&nbsp;&nbsp;
<?php if ($this->_tpl_vars['val_items']['inventory_alert'] >= $this->_tpl_vars['val_items']['quantity_available']): ?>
	<blink><a class="item_quantity" href="<?php echo $this->_tpl_vars['baseUrl']; ?>
add_quantity.php?item_id_value=<?php echo $this->_tpl_vars['val_items']['item_id']; ?>
">
	Update Quantity</a></blink>
	<?php else: ?>
		<a class="item_quantity" href="<?php echo $this->_tpl_vars['baseUrl']; ?>
add_quantity.php?item_id_value=<?php echo $this->_tpl_vars['val_items']['item_id']; ?>
">
	Update Quantity</a>
	<?php endif; ?><br><span style='font-size:12px;color:#000000;background-color:#cccccc;font-weight:bold;'>
<?php if ($this->_tpl_vars['val_items']['expired_package'] == 1): ?>&nbsp;Package Expired.&nbsp;<br>
<?php endif; ?><?php if ($this->_tpl_vars['val_items']['delete_restored'] == 1): ?>&nbsp;Item deleted by Admin.&nbsp;<br>
<?php endif; ?>
</span>&nbsp;
	</div>
	<div class="costlf" >
<a href="sell-an-item.php?item_id_value=<?php echo $this->_tpl_vars['val_items']['item_id']; ?>
"><img class='vAlign'  src='images/edit_btn.jpg' border='0'>
	</a>
	<a href="item-details.php?details_item_value=<?php echo $this->_tpl_vars['val_items']['item_id']; ?>
"><img src="images/details_btn.jpg" alt="" class="editImg" /></a>&nbsp;&nbsp;<a 
	onclick="confirm_msg(<?php echo $this->_tpl_vars['val_items']['item_id']; ?>
, '');" href="#items_list.php?delete_item_value=<?php echo $this->_tpl_vars['val_items']['item_id']; ?>
" title="Delete">
	<img src="images/delete_btn.jpg" alt="" class="editImg" /></a>
	<br><br><br>
	
	<span class="itemlf" ><span style="color:#CC0033">
	<?php if ($this->_tpl_vars['val_items']['date_modified'] != ''): ?>Last Modified<?php endif; ?></span><?php if ($this->_tpl_vars['val_items']['date_modified'] != ''): ?>
	<b>:</b><?php endif; ?><?php echo ((is_array($_tmp=$this->_tpl_vars['val_items']['date_modified'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</span>
	<br>
	<?php if ($this->_tpl_vars['val_items']['status'] != 3): ?>Current Status<?php endif; ?><span style="color:red;padding-left:5px;"><?php if ($this->_tpl_vars['val_items']['status'] == 0): ?>Pending <?php endif; ?><?php if ($this->_tpl_vars['val_items']['status'] == 1): ?>Active <?php endif; ?>
	<?php if ($this->_tpl_vars['val_items']['status'] == 2): ?>Suspend<?php endif; ?>	<?php if ($this->_tpl_vars['val_items']['status'] == 3): ?>Hold<?php endif; ?></span></div>
							<div class="clear"></div>
						</div>
						
						
						
							<?php endforeach; endif; unset($_from); ?>
						
					
						<div class="itemimgbox" style='width:690px;'>
						<?php echo $this->_tpl_vars['page_counter']; ?>
 records&nbsp;&nbsp;&nbsp;&nbsp;<span style="float:right;">
						<?php echo $this->_tpl_vars['pageLink']; ?>
</span>
							<div class="clear"></div>
							</div>
							<?php else: ?>
							<div class="itemimgbox" 
							style='color:red;font-size:14px;width:690px;'>
						No records found!!</span>
							<div class="clear"></div>
							</div>
							<?php endif; ?>
	
							<div class="clear"></div>
						</div>
						
					
					</div>	
					
				<!--End my items -->
				
				
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