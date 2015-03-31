<?php /* Smarty version 2.6.18, created on 2011-11-26 09:41:09
         compiled from item-details.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'ucfirst', 'item-details.tpl', 131, false),array('modifier', 'text_format', 'item-details.tpl', 197, false),array('modifier', 'convert_price', 'item-details.tpl', 228, false),array('modifier', 'truncate', 'item-details.tpl', 263, false),array('modifier', 'convert_number', 'item-details.tpl', 333, false),array('modifier', 'date_format', 'item-details.tpl', 517, false),)), $this); ?>
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
<link href="<?php echo $this->_tpl_vars['baseUrl']; ?>
css/cloud-zoom.css" rel="stylesheet" type="text/css" />
<script type="text/JavaScript" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
js/cloud-zoom.1.0.2.js"></script>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header_search_banner.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script type="text/javascript" language="javascript">
<?php echo '
function discount_apply_coupon()
{
 var CD_ID = document.getElementById(\'coupon_code\');
 if(CD_ID.value==\'\')
 {
 alert("If you donot have Coupon Code,please click link contact seller!! ");
 CD_ID.focus();
 return false;
 }
}
function haat_price_fun()
{// alert(\'haat\');
  if(document.getElementById(\'bid_value\').value==\'\')
  {
  alert(\'Haating price cannot be empty.Please enter price.!!\');
  document.getElementById(\'bid_value\').value=\'\';
  return false;
  }
}
function check_quantity(FRM_NUM)
{
  if(FRM_NUM==\'frm_buyhaat_qty_details\')
  {
  if(parseInt(document.getElementById(\'requested_quantity\').value)>parseInt(document.getElementById(\'available_quantity\').value) )
  {
  alert(\'Requested quantity is greater than available stock.Please enter less quantity!!\');
  document.getElementById(\'requested_quantity\').value=\'\';
  return false;
  }
  else if(document.getElementById(\'requested_quantity\').value==\'\' )
  {
  alert(\'Please enter quantity!!\');
  return false;
  }
  else
  {  document.frm_buyhaat_qty_details.submit();
     return true;
   }
  }
  if(FRM_NUM==\'frm_normal_details\')
  {
  if(parseInt(document.getElementById(\'requested_quantity\').value)>parseInt(document.getElementById(\'available_quantity\').value) )
  {// alert(\'gfgfg\'+document.getElementById(\'available_quantity\').value);
  alert(\'Requested quantity is greater than available stock.Please enter less quantity!!\');
  document.getElementById(\'requested_quantity\').value=\'\';
  return false;
  }
  else if(document.getElementById(\'requested_quantity\').value==\'\' )
  {
  alert(\'Please enter quantity!!\');
  return false;
  }
  else
  {
  document.frm_normal_details.submit();
  return true;
   }
  }

}
function show_div(NUM)
{

    var STR="If you find this product has violated any copyright /IPR policy/is objectionable.Please report it.This function can be reported by a registered user only .";

    if(NUM==1)
    {
    document.getElementById(\'a_div1\').style.display=\'none\';
    document.getElementById(\'a_div0\').style.display=\'\';
    document.getElementById(\'div_txt\').innerHTML=STR;
    }else
    {
    document.getElementById(\'a_div0\').style.display=\'none\';
    document.getElementById(\'a_div1\').style.display=\'\';
    document.getElementById(\'div_txt\').innerHTML=\'\';
    }
}
function shold_buyer(NUM)
{
	if(NUM==1)
	var STR="You must be the buyer to add items to your favourite!";
	else
        var STR="You must be the buyer to add shop!";
	return false;
}
function onload_inventoryalert(SEL_ID)
{
	alert("The quantity is null in inventory.Please contact the seller to update the quantity of items!. ");
	window.location=\'#contact_seller.php?id=\'+SEL_ID;
	return false;
}
'; ?>

</script>

<?php if ($this->_tpl_vars['num_rows_items_qty_delete_by_admin_seller'] == 0): ?>
<div class="insidemiddlemian" style="border:0px solid #FF0000;height:400px;font-family:Arial, Helvetica, sans-serif;font-size:18px;color:#B36666;font-weight:700;text-align:center;padding-top:15px;">
<?php if ($this->_tpl_vars['num_rows_items_qty_delete_by_admin_seller1'] != 0): ?>
Item may be deleted by admin or seller or may be package expired or may be the quantity is null .
<?php else: ?>
Item donot belong to this store .
<?php endif; ?>
</div>
<?php else: ?>
	<?php if ($this->_tpl_vars['details_of_store_status'] != 0): ?><!-- 0 means store disabled-->
<!--Start Middle-->
<div id="middleMain">
	<div id="insidemiddlemian">
		<div>
<!-- below code added by rishi-->
                    <?php if ($this->_tpl_vars['item_det_msg'] != ''): ?>
                <div class="insidehd " style='font-size:12px;color:red;font-family:arial;text-align:center;' > <?php echo $this->_tpl_vars['item_det_msg']; ?>
 </div>
		    <?php endif; ?>
<!-- above code added by rishi-->
                <div>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'error_msg_template.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<div class="clear"></div>
		</div>
               <div class="insidehd ">Item Details </div>
		<div class="clear"></div>
			<div class="buyermain">
				<!--Start item detail -->
				<div>
					<div class="iteminsidedetl">
						<div class="itemtopinsideText"><?php echo ((is_array($_tmp=$this->_tpl_vars['users_items_details']['title'])) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
</div>
						<div class="itemdtlimgbox">
							<div class="itemsmlimgmain" >	
								<?php if ($this->_tpl_vars['users_items_details']['image1'] != ''): ?>
								<div class="itemsmlimg">
								<a href="uploads/<?php echo $this->_tpl_vars['users_items_details']['image1']; ?>
" class='cloud-zoom-gallery' title='Thumbnail 1' rel="useZoom: 'zoom1', smallImage: '<?php echo $this->_tpl_vars['baseUrl']; ?>
getthumb.php?w=400&h=266&fromfile=uploads/<?php echo $this->_tpl_vars['users_items_details']['image1']; ?>
' ">
								<img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
getthumb.php?w=70&h=46&fromfile=uploads/<?php echo $this->_tpl_vars['users_items_details']['image1']; ?>
" alt="" border="0" class="itemimagebox" />
								</a>
								</div>
								<?php endif; ?>
								
								<?php if ($this->_tpl_vars['users_items_details']['image2'] != ''): ?>
								<div class="itemsmlimg">								<a href="uploads/<?php echo $this->_tpl_vars['users_items_details']['image2']; ?>
" class='cloud-zoom-gallery' title='Thumbnail 2' rel="useZoom: 'zoom1', smallImage: '<?php echo $this->_tpl_vars['baseUrl']; ?>
getthumb.php?w=400&h=266&fromfile=uploads/<?php echo $this->_tpl_vars['users_items_details']['image2']; ?>
' ">
								<img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
getthumb.php?w=70&h=46&fromfile=uploads/<?php echo $this->_tpl_vars['users_items_details']['image2']; ?>
" alt="" border="0" class="itemimagebox" />
								</a>
								</div>
								<?php endif; ?>

								<?php if ($this->_tpl_vars['users_items_details']['image3'] != ''): ?>
								<div class="itemsmlimg">
								<a href="uploads/<?php echo $this->_tpl_vars['users_items_details']['image3']; ?>
" class='cloud-zoom-gallery' title='Thumbnail 3' rel="useZoom: 'zoom1', smallImage: '<?php echo $this->_tpl_vars['baseUrl']; ?>
getthumb.php?w=400&h=266&fromfile=uploads/<?php echo $this->_tpl_vars['users_items_details']['image3']; ?>
' ">
								<img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
getthumb.php?w=70&h=46&fromfile=uploads/<?php echo $this->_tpl_vars['users_items_details']['image3']; ?>
" alt="" border="0" class="itemimagebox" />
								</a>
								</div>
								<?php endif; ?>

								<?php if ($this->_tpl_vars['users_items_details']['image4'] != ''): ?>
								<div class="itemsmlimg">
								<a href="uploads/<?php echo $this->_tpl_vars['users_items_details']['image4']; ?>
" class='cloud-zoom-gallery' title='Thumbnail 4' rel="useZoom: 'zoom1', smallImage: '<?php echo $this->_tpl_vars['baseUrl']; ?>
getthumb.php?w=400&h=266&fromfile=uploads/<?php echo $this->_tpl_vars['users_items_details']['image4']; ?>
' ">
								<img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
getthumb.php?w=70&h=46&fromfile=uploads/<?php echo $this->_tpl_vars['users_items_details']['image4']; ?>
" alt="" border="0" class="itemimagebox" />
								</a>
								</div>
								<?php endif; ?>

								<?php if ($this->_tpl_vars['users_items_details']['image5'] != ''): ?>
								<div class="itemsmlimg">
								<a href="uploads/<?php echo $this->_tpl_vars['users_items_details']['image5']; ?>
" class='cloud-zoom-gallery' title='Thumbnail 5' rel="useZoom: 'zoom1', smallImage: '<?php echo $this->_tpl_vars['baseUrl']; ?>
getthumb.php?w=400&h=266&fromfile=uploads/<?php echo $this->_tpl_vars['users_items_details']['image5']; ?>
' ">
								<img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
getthumb.php?w=70&h=46&fromfile=uploads/<?php echo $this->_tpl_vars['users_items_details']['image5']; ?>
" alt="" border="0" class="itemimagebox" />
								</a>
								</div>
								<?php endif; ?>
																		
							</div>
							<div class="itemdetailimgbox" style='border:0px solid red;padding-left:1px;text-align:center;'>
								<div align="left" style='border:0px solid red;' >
								<?php if ($this->_tpl_vars['users_items_details']['image1'] != ''): ?>
   <a href='<?php echo $this->_tpl_vars['baseUrl']; ?>
getthumb.php?w=500&h=296&fromfile=uploads/<?php echo $this->_tpl_vars['users_items_details']['image1']; ?>
' class = 'cloud-zoom' id='zoom1' rel="adjustX: 10, adjustY:-4, softFocus:false">
								<?php endif; ?>
                <img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
getthumb.php?w=400&h=230&fromfile=uploads/<?php echo $this->_tpl_vars['users_items_details']['image1']; ?>
" alt="<?php echo $this->_tpl_vars['users_items_details']['title']; ?>
"  border="0"  />
								<?php if ($this->_tpl_vars['users_items_details']['image1'] != ''): ?></a><?php endif; ?>
								</div>
							</div>
							<div class="clear"></div>
							
						</div>
						<div class="styleMain">
						<div class="styleLabel">Style:</div>
						<div class="styleLabelfr"><?php echo ((is_array($_tmp=$this->_tpl_vars['all_style_names'])) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
</div>
						<div class="clear"></div>

						<div class="styleLabel">Color:</div>
						<div class="styleLabelfr"><?php echo ((is_array($_tmp=$this->_tpl_vars['users_items_details']['color'])) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
</div>
						<div class="clear"></div>
						</div>

						<div class="insideitemhd">About The Item</div>
						<div class="insidetexhight"><?php echo ((is_array($_tmp=$this->_tpl_vars['users_items_details']['description'])) ? $this->_run_mod_handler('text_format', true, $_tmp) : smarty_modifier_text_format($_tmp)); ?>
</div>
						<div class="meterialbox">
							<div class="metalhd">Item Contents</div>
							<div class="meteriallink"><?php echo ((is_array($_tmp=$this->_tpl_vars['users_items_details']['material_used'])) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
</div>
						</div>
						<div class="meterialbox">
							<div class="metalhd">Care</div>
							<div class="meteriallink"><?php if ($this->_tpl_vars['users_items_details']['care'] != ''): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['users_items_details']['care'])) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
<?php else: ?>NA<?php endif; ?> </div>
						</div>
						<div class="meterialbox">
							<div class="metalhd">Shipping Details</div>
							<div style="height:auto;">
							<table width="618px;" cellspacing="0" cellpadding="3" border="0" align="left">
								<tr>
								<td valign="top" colspan="3"><b>Source Country:</b> 
								<?php if (((is_array($_tmp=$this->_tpl_vars['details_ofuser_information']['country'])) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)) != ''): ?>
								<?php echo ((is_array($_tmp=$this->_tpl_vars['details_ofuser_information']['country'])) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>

								<?php else: ?>
								 N/A
								<?php endif; ?></td>
								</tr>
								<?php if ($this->_tpl_vars['num_value_details'] != 0): ?>
								<tr style="font-weight:bold;">
								<td width="25%" valign="top">Destination Countries</td>
								<td width="25%" valign="top">Shipping Cost</td>
								<td width="50%" valign="top">Comment</td>
								</tr>
								
								<?php $_from = $this->_tpl_vars['show_all_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['cat'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['cat']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['val_items']):
        $this->_foreach['cat']['iteration']++;
?>
								<tr>
								<td valign="top"><?php if ($this->_tpl_vars['val_items']['country'] != ''): ?><?php echo $this->_tpl_vars['val_items']['country']; ?>
<?php else: ?>NA<?php endif; ?></td>
								<td valign="top"><?php if ($this->_tpl_vars['val_items']['ship_cost_country'] != ''): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['val_items']['ship_cost_country'])) ? $this->_run_mod_handler('convert_price', true, $_tmp) : smarty_modifier_convert_price($_tmp)); ?>
<?php else: ?>NA<?php endif; ?></td>
								<td valign="top"><?php if ($this->_tpl_vars['val_items']['comment'] != ''): ?><?php echo $this->_tpl_vars['val_items']['comment']; ?>
<?php else: ?>NA<?php endif; ?></td>
								</tr>
								<?php endforeach; endif; unset($_from); ?>
								<tr>
								<td valign="top" nowrap="nowrap">Other Countries .</td>
								<td valign="top">
<?php if ($this->_tpl_vars['users_items_details']['allow_rest_country_status'] == 1): ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['users_items_details']['ship_allowcost'])) ? $this->_run_mod_handler('convert_price', true, $_tmp) : smarty_modifier_convert_price($_tmp)); ?>
<?php else: ?>N/A<?php endif; ?></td>
								<td valign="top"><?php if ($this->_tpl_vars['users_items_details']['allow_rest_country_status'] == 1): ?>
								<?php echo $this->_tpl_vars['users_items_details']['ship_allowcomment']; ?>
<?php else: ?>NA<?php endif; ?></td>
								</tr>
								<?php else: ?>
								<tr>
								<td valign="top" colspan="3">No destination countries defined by seller.</td>
								</tr>
								<?php endif; ?>
							</table>
							</div><div class="clear"></div>
							<div class="meteriallink"></div>
						</div>
						<?php if ($this->_tpl_vars['sellers_number_of_items1'] != 0): ?>
						<div class="insideitemhd" style="border-bottom:none;">Seller's Other Item</div>
						<div class="selleritembox" >
							<?php if ($this->_tpl_vars['sellers_number_of_items1'] > 5): ?>
							<div class="sellscrimgfl"><a href="javascript://" id="prev1"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/scroll_arrow-fl.jpg" alt="" border="0" /></a></div>
							<?php endif; ?>
						<div class="sellscrimgmid" id="scroll1"style='height:130px;'>
								<ul class="scrollContainer" style='height:130px;'>
								<?php $_from = $this->_tpl_vars['sellers_withotheritems']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['csdf'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['csdf']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['v']):
        $this->_foreach['csdf']['iteration']++;
?>
                                   								<li class="scrollerBlock"style='height:130px;'><div class="slideImgbox" style='height:120px;'>
								<a href="item-details.php?details_item_value=<?php echo $this->_tpl_vars['v']['show_item_id']; ?>
<?php if ($this->_tpl_vars['v']['coupon_code'] != '' && $this->_tpl_vars['v']['coupon_status'] == 1 && $this->_tpl_vars['v']['start_date'] <= $this->_tpl_vars['date_forcheck'] && $this->_tpl_vars['v']['end_date'] >= $this->_tpl_vars['date_forcheck']): ?>&d=1<?php endif; ?>" title="<?php echo $this->_tpl_vars['v']['title']; ?>
">
								<img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
getthumb.php?w=90&h=70&fromfile=uploads/<?php echo $this->_tpl_vars['v']['image1']; ?>
" onerror="this.src='<?php echo $this->_tpl_vars['baseUrl']; ?>
images/item_small_img.jpg'; this.style.width='90px'; this.style.height='50px';" width="90" height="70" alt="" border="0"  class="slideImg"/>
</a><br />
								<div class="itemName"><a href="item-details.php?details_item_value=<?php echo $this->_tpl_vars['v']['show_item_id']; ?>
<?php if ($this->_tpl_vars['v']['coupon_code'] != '' && $this->_tpl_vars['v']['coupon_status'] == 1 && $this->_tpl_vars['v']['start_date'] <= $this->_tpl_vars['date_forcheck'] && $this->_tpl_vars['v']['end_date'] >= $this->_tpl_vars['date_forcheck']): ?>&d=1<?php endif; ?>" title="<?php echo $this->_tpl_vars['v']['title']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['v']['title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 10, '...', true) : smarty_modifier_truncate($_tmp, 10, '...', true)); ?>
</a><br />
								<span><?php echo ((is_array($_tmp=$this->_tpl_vars['v']['cost_item'])) ? $this->_run_mod_handler('convert_price', true, $_tmp) : smarty_modifier_convert_price($_tmp)); ?>
</span>
								<?php if ($this->_tpl_vars['v']['hatting_status'] == 1): ?>
                                              <fieldset id="set2">
                                                 <?php if ($_SESSION['session_user_id'] == ''): ?>
                                                  <span style='color:#9ac243;'>&nbsp;&nbsp;
              <label title=" In order to negotiate online for this item on haating ,please log in. " ><b>Haat It </b></label> </span>
                              <?php else: ?>
			<span style='color:#9ac243;'>&nbsp;&nbsp;
             <label title=" Click on the item to negotiate online." ><b>Haat It </b></label>
             </span><?php endif; ?><?php echo '<script >
                                                                   <code class="mix">$(\'#set2 *\').tooltip();</code>
                                                                   </script>'; ?>

                                                                 </fieldset>

                                                                  <?php endif; ?>
				<?php if ($this->_tpl_vars['v']['hatting_status'] != 1): ?>
                <span   style='color:#FFFFFF;line-height:12px;'> &nbsp; </span>
					<?php endif; ?>
													    <?php if ($this->_tpl_vars['v']['coupon_code'] != '' && $this->_tpl_vars['v']['coupon_status'] == 1 && $this->_tpl_vars['v']['start_date'] <= $this->_tpl_vars['date_forcheck'] && $this->_tpl_vars['v']['end_date'] >= $this->_tpl_vars['date_forcheck']): ?>
                                                                    <span style="color:red;font-size:9px;">Discount applicable                                                                     </span>
                                                                    <?php endif; ?>


                                                               </div>
								</div></li>								<?php endforeach; endif; unset($_from); ?>
								</ul>

             </div>
							
							<?php if ($this->_tpl_vars['sellers_number_of_items1'] > 5): ?>
							<div class="sellscrimgfr">
							<a href="javascript://" id="next1">
                                                        <img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/scroll_arrow_fr1.jpg" alt="" border="0" /></a>
							</div>
							<?php endif; ?>
                                                       <script language="JavaScript" type="text/JavaScript" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
js/jcarousellite.js"></script>						
							<script language="javascript" type="text/javascript">
							<?php echo '
							$(function() {
								$("#scroll1").jCarouselLite({
									btnNext: "#next1",
									btnPrev: "#prev1",
						       	    visible:'; ?>
<?php echo $this->_tpl_vars['visble_val']; ?>
<?php echo '
                                                            
                                                                 	});
								
							});
							'; ?>

							</script>
							<div class="clear"></div>
						</div>
						<?php endif; ?>
						<div class="insideitemhd">Payment Mode</div>
							<div class="paymnMathodbdr">
								<div style="position:absolute; top:-15px; left:9px;"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/paypal_logo.jpg" alt="" /></div>								
								<div class="paypalimg"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/paypal_cart.jpg" alt="" /></div>
							</div>						
					</div>
					</div>
					<!--Start right part -->
                                     
					<div class="itemDetialfrmain">
						  <?php if ($this->_tpl_vars['users_items_details']['hatting_status'] != 1): ?>
                                             <form name='frm_normal_details' action='shipping_details.php' method='get'>
                                               <div class="buyNow"  <?php if ($this->_tpl_vars['result_coupon_exsist'] > 0): ?>style='padding-top:1px;padding-bottom:1px;height:auto;'<?php endif; ?>>
                                                     <div style='border:0px solid red;width:225px;' >
                                                       <div class="buyNowtextfl"  >
  						         <span <?php if ($this->_tpl_vars['result_coupon_exsist'] > 0): ?>style='text-decoration:line-through;font-size:12px;'<?php endif; ?>><?php echo $this->_tpl_vars['USD']; ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['users_items_details']['cost_item'])) ? $this->_run_mod_handler('convert_number', true, $_tmp) : smarty_modifier_convert_number($_tmp)); ?>
<br />
							 <?php echo ((is_array($_tmp=$this->_tpl_vars['users_items_details']['cost_item'])) ? $this->_run_mod_handler('convert_price', true, $_tmp) : smarty_modifier_convert_price($_tmp)); ?>
<br />
                                                         </span>
                                                         <?php if ($this->_tpl_vars['result_coupon_exsist'] == 1 || $this->_tpl_vars['coupon_d'] == 1): ?>
                                                         <span style='font-size:12px;color:red;'>
                                                         <!--<?php echo $this->_tpl_vars['USD']; ?>
--><?php echo ((is_array($_tmp=$this->_tpl_vars['str_amount_final'])) ? $this->_run_mod_handler('convert_price', true, $_tmp) : smarty_modifier_convert_price($_tmp)); ?>
.</span> <br />
                                                              <?php endif; ?>                                             
							  In Stock Qty <?php echo $this->_tpl_vars['users_items_details']['quantity_available']; ?>

                                                          </div>
  <?php if ($this->_tpl_vars['users_items_details']['hatting_status'] != 1 && $this->_tpl_vars['users_items_details']['quantity_available'] != 0 && ( $this->_tpl_vars['users_items_details']['locker_status'] == 0 || ( $this->_tpl_vars['users_items_details']['locker_status'] == 1 && $this->_tpl_vars['users_items_details']['locker_permission'] == 1 ) || ( $this->_tpl_vars['users_items_details']['locker_status'] == 1 && $this->_tpl_vars['users_items_details']['locker_permission'] == 0 && $this->_tpl_vars['num_customitem_details'] > 0 ) )): ?>
						         <div class="buyNowbtn">
                                                        <a  onClick="return check_quantity('frm_normal_details');" href="#shipping_details.php?item_id=<?php echo $this->_tpl_vars['users_items_details']['item_id']; ?>
&seller_id=<?php echo $this->_tpl_vars['users_items_details']['seller_id']; ?>
">
                                                        <img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/buy_bow_btn.jpg" alt="" border="0" /></a>
                                                         </div>
							<?php endif; ?>
                                                        <div class="clear"></div>
                                                </div>
                                               <div style='border:0px solid red;width:225px;' ><!--Enter Quantity:&nbsp;-->
                                                <input type='hidden' value='1' name='requested_quantity' style='width:50px;' id='requested_quantity' >
                                                <input type='hidden' value='<?php echo $this->_tpl_vars['users_items_details']['item_id']; ?>
' name='item_id' id='item_id' >
                                                <input type='hidden' value='<?php echo $this->_tpl_vars['users_items_details']['seller_id']; ?>
' name='seller_id' id='seller_id' >
                                                <input type='hidden' value='<?php echo $this->_tpl_vars['users_items_details']['quantity_available']; ?>
' name='available_quantity' id='available_quantity' >
                                                  </div>
                                                </div>
                                                  </form>
                                                <?php endif; ?>
 
                                          <?php if ($this->_tpl_vars['users_items_details']['hatting_status'] != 1 && $this->_tpl_vars['users_items_details']['quantity_available'] != 0): ?>
                                          <!-start of discount  code-->
                                         <?php if ($this->_tpl_vars['coupon_d_not_posted'] == 1): ?>
                                         <div class="buyNow"style='padding-top:2px;' >
                                            <form name='frm' action='' method='post'>
                                                <table align='center' width='100%' border='0' cellspacing='0' cellpadding='0' >
                                                 <tr>
                                                   <td colspan='2' valign='top' align='left'style='font-size:2px;font-weight:bold;color:#000000;'>&nbsp;&nbsp;</td>
                                                  </tr>
                                                   <tr>
                                                   <td colspan='2' valign='top' align='left'style='font-size:12px;font-weight:bold;color:#000000;'>Enter Discount Coupon Code</td>
                                                  </tr>
                                                 <tr>
                                                   <td colspan='2' valign='top' align='left'style='font-size:12px;font-weight:bold;color:#000000;'>&nbsp;</td>
                                                  </tr>
                                                
                                                    <tr>
                                                   <td valign='top' align='left'>
												   <input type='hidden' value='1' name='coupon_d'>
                                                   <input type='hidden' value='<?php echo $this->_tpl_vars['details_item_value_listingid']; ?>
' name='details_item_value'>
                                                   <input type='text' value='' name='coupon_code' id='coupon_code' > </td>
                                                   <td valign='top' align='left' >
                                     <?php if ($this->_tpl_vars['users_items_details']['quantity_available'] != 0): ?>              
                                      <input type='image' onclick="return discount_apply_coupon()" <?php if ($_SESSION['session_user_id'] == ''): ?>disabled='true' <?php endif; ?> value='Apply' src='images/apply_btn.jpg'>
                                     <?php else: ?>
                                     No Quantity
                                     <?php endif; ?>
                                 <input type='hidden' value='Apply' name='Apply'>
                                 <input type='hidden' value='<?php echo $this->_tpl_vars['details_item_value_listingid']; ?>
' name='amount_after_discount'></td>
                                           </tr>
										  <?php if ($_SESSION['session_user_id'] == ''): ?>
										   <tr><td align="left" valign="top" style='font-size:10px;color:red;text-align:left;'>Please login to enter discount coupon code.</td></tr>
										   <?php endif; ?>
                                       </table>
                                            </form>
                                                 <div class="clear"></div>
                                                </div>
           <?php endif; ?>
                                             <!-end of discount  code-->
                                       <?php endif; ?>
                                             <!-start of haating code-->
           <?php if ($this->_tpl_vars['users_items_details']['hatting_status'] == 1): ?>
        <div class="buyNow">               
          <div class="buyNowtextfl" style='float:left;border:0px solid red;width:223px;'>
              <?php if (( ( $this->_tpl_vars['users_biditems_details_status'] == 0 && $_SESSION['session_user_id'] != '' ) || $_SESSION['session_user_id'] == '' ) && $this->_tpl_vars['users_items_details']['hatting_status'] == 1): ?>
                                         <form name='frm_haat_price_fun' id='frm_haat_price_fun' action='' method='post'>
                                        <div style='font-size:13px;color:#000000;font-weight:bold;border:0px solid green;width:220px;'>
                                                        Post your price. </div>
                                         <div style='font-size:4px;color:red;font-weight:bold;border:0px solid green;width:220px;'>
                                               &nbsp;&nbsp; </div>
                                     <div style='border:0px solid red;width:220px;'>
                                     <div style='border:0px solid red;width:100px;float:left;' >
                                     In Stock qty <?php echo $this->_tpl_vars['users_items_details']['quantity_available']; ?>
&nbsp;
                                        <?php if ($_SESSION['session_user_id'] == ''): ?>
                                             <input type='text' value='' disabled='true' name='bid_value' style='width:60px;' >
                                                   <?php else: ?>
                                           <input type='text' value='' name='bid_value' class="required only_numericwithfloat" id='bid_value' style='width:60px;' >
                                                  <?php endif; ?>
<br /><span style='font-size:11px;color:#663300;font-weight:lighter;font-family:Arial, Helvetica, sans-serif;'> Haat it price in USD.</span>
                                                   <input type='hidden' value='<?php echo $this->_tpl_vars['details_item_value_listingid']; ?>
' name='details_item_value'>
												   
                                                                </div>
                                                               <div style='border:0px solid red;width:100px;float:right;' >
                                                               <?php if ($this->_tpl_vars['users_items_details']['quantity_available'] != 0): ?>
															     <b>USD <?php echo $this->_tpl_vars['users_items_details']['cost_item']; ?>
 </b> 
                                                               <?php if ($_SESSION['session_user_id'] != ''): ?>
                                                   <input type='image'  src='<?php echo $this->_tpl_vars['baseUrl']; ?>
images/haat-it-btn.jpg'>
                                                               <?php else: ?>
															 
															    <fieldset id="set1">
                                                               <label title=" In order to negotiate online for this item on haating ,please log in. " > 
															    <a href='login-hatting.php'> <img   src='<?php echo $this->_tpl_vars['baseUrl']; ?>
images/haat-it-btn.jpg'></a>
                                                                    </label><?php echo '<script >
                                                                   <code class="mix">$(\'#set1 *\').tooltip();</code>                                                      </script>'; ?>
</fieldset>
                                                                   <?php endif; ?>
                                                                

                                                                   <?php else: ?>
                                                                   No Quantity
                                                                   <?php endif; ?>
                                                                   <input type='hidden' value='Post-Bid' name='bid_submit'>
                                                                   </div>
                                                                <div class="clear"></div>
                                                           </div>
                                                        
                                                    </form>
                  <?php endif; ?>
                                        
            </div>
                                                       
              
                                 
    <?php if ($this->_tpl_vars['users_items_details']['hatting_status'] == 1 && $this->_tpl_vars['users_biditems_details_status'] > 0 && $this->_tpl_vars['users_items_details']['quantity_available'] != 0 && $_SESSION['session_user_id'] != ''): ?>
			   <form name='frm_buyhaat_qty_details' action='shipping_details.php' action='get'>
                                    <div class="buyNowbtn"  style='float:left;border:0px solid red;width:220px;'>
                                                   <div  style='float:left;border:0px solid red;width:210px;'>
                                  <div style='float:left;border:0px solid red;width:100px;' class="buyNowtextfl">
                                                   <span><?php echo $this->_tpl_vars['USD']; ?>
 <?php echo ((is_array($_tmp=$_SESSION['d_cost_item'])) ? $this->_run_mod_handler('convert_number', true, $_tmp) : smarty_modifier_convert_number($_tmp)); ?>
<br />
                                                    <?php echo ((is_array($_tmp=$_SESSION['d_cost_item'])) ? $this->_run_mod_handler('convert_price', true, $_tmp) : smarty_modifier_convert_price($_tmp)); ?>
<br /></span>
                                                    In Stock qty <?php echo $this->_tpl_vars['users_items_details']['quantity_available']; ?>

                                                    </div>
                                                    <div style='float:right;border:0px solid red;width:100px;' >
                                                    <a HREF="javascript://" onclick="return check_quantity('frm_buyhaat_qty_details');">
 <img  src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/buy_bow_btn.jpg" alt="" border="0" /></a>
                                                   </div> <div class="clear"></div>
</div>
                                                   
                                                <div class="buyNowbtn"  style='float:left;border:0px solid red;width:220px;'>
<!--Enter quantity&nbsp;&nbsp;-->       <input type='hidden' value='1' name='requested_quantity' style='width:50px;' id='requested_quantity' >
                                                <input type='hidden' value='<?php echo $this->_tpl_vars['users_items_details']['item_id']; ?>
' name='item_id' id='item_id' >
                                                <input type='hidden' value='<?php echo $this->_tpl_vars['users_items_details']['seller_id']; ?>
' name='seller_id' id='seller_id' >
                                                <input type='hidden' value='<?php echo $this->_tpl_vars['users_items_details']['quantity_available']; ?>
' name='available_quantity' id='available_quantity' >
                                                </div>
                                     
                                    </div>
                           </form>
                   <?php endif; ?>
                                                 	
				</div>
                            <div class="clear"></div>
<?php endif; ?>




<!-- end of code-->
                                        	<div class="rightbox">
							<div class="rightboxhd"><?php echo $this->_tpl_vars['details_ofuser_information']['username']; ?>
 info</div>
							<div class="whiteinsidebox">
								
								
								<div class="rightimgbox"><a href="http://<?php echo $this->_tpl_vars['add_this_name_www']; ?>
.<?php if ($_SERVER['HTTP_HOST'] == 'www.nethaat.com'): ?><?php echo $this->_tpl_vars['details_ofuser_information']['username']; ?>
.<?php endif; ?><?php echo $this->_tpl_vars['add_this_name']; ?>
/featured_store_information.php"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
getthumb.php?w=105&h=130&fromfile=uploads/<?php echo $this->_tpl_vars['details_ofuser_information']['username']; ?>
<?php if ($this->_tpl_vars['details_ofuser_information']['sel_logo_status'] == 2): ?>/store_logos/<?php echo $this->_tpl_vars['details_ofuser_information']['store_logo']; ?>
<?php else: ?>/banners/<?php echo $this->_tpl_vars['details_ofuser_information']['banner_name']; ?>
<?php endif; ?>" alt="" border="0"  onerror="this.src='<?php echo $this->_tpl_vars['baseUrl']; ?>
images/imagsamll.jpg'; this.style.width='50px'; this.style.height='50px';" /></a></div>
								<div class="rightimgboxtext" style="border:0px solid red;width:120px;">
									<div class="righticon"><a href="http://<?php echo $this->_tpl_vars['add_this_name_www']; ?>
.<?php if ($_SERVER['HTTP_HOST'] == 'www.nethaat.com'): ?><?php echo $this->_tpl_vars['details_ofuser_information']['username']; ?>
.<?php endif; ?><?php echo $this->_tpl_vars['add_this_name']; ?>
/featured_store_information.php"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/about_shop_img.jpg" alt="" /> About shop</a></div>
									<div class="righticon"><a href="http://<?php echo $this->_tpl_vars['add_this_name_www']; ?>
.<?php if ($_SERVER['HTTP_HOST'] == 'www.nethaat.com'): ?><?php echo $this->_tpl_vars['details_ofuser_information']['username']; ?>
.<?php endif; ?><?php echo $this->_tpl_vars['add_this_name']; ?>
/shoppolicy_seller.php"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/polices_icon.jpg" alt="" /> Policies</a></div>
									<div class="righticon"><a href="contact_seller.php?sellerid=<?php echo $this->_tpl_vars['sellerid']; ?>
"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/contact_icon.jpg" alt="" /> Contact us</a></div>
								</div>
								<div class="clear"></div>
								<div class="ratinglble">Rating :</div>
								<div class="ratinglblefr"><?php if ($this->_tpl_vars['find_percentage'] != ''): ?><a href='viewfeedback.php?rating_seller_id=<?php echo $this->_tpl_vars['sellerid']; ?>
'><?php echo $this->_tpl_vars['find_percentage']; ?>
%</a><?php else: ?>0%<?php endif; ?></div>
								<div class="clear"></div>
								<div class="ratinglble">Location :</div>
								<div class="ratinglblefr"><?php if ($this->_tpl_vars['details_ofuser_information']['country'] != ''): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['details_ofuser_information']['country'])) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
<?php else: ?>NA<?php endif; ?></div>
								<div class="clear"></div>
							</div>
						</div>
						<div class="rightbox">
							<div class="rightboxhd">Quick links</div>
							<div class="whiteinsidebox">
								<div class="quickLinkbox"><a href="<?php if ($_SESSION['session_user_id'] != ''): ?>item-details.php?favorite_details_item_value=<?php echo $this->_tpl_vars['details_item_value_listingid']; ?>
<?php else: ?>login.php<?php endif; ?>"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/my_favourite_icon.jpg" alt="" class="vAlign" /> Add to my favorite items</a></div>
								<div class="quickLinkbox"><a href="<?php if ($_SESSION['session_user_id'] != ''): ?>item-details.php?add_to_shop=<?php echo $this->_tpl_vars['details_ofuser_information']['user_id_value']; ?>
&details_item_value=<?php echo $this->_tpl_vars['details_item_value_listingid']; ?>
<?php else: ?>login.php<?php endif; ?>"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/my_shop_icon.jpg" alt="" class="vAlign" /> Add to my favorite shops</a></div>
								<div class="quickLinkbox"><a href="email-to-friend.php?details_item_value=<?php echo $this->_tpl_vars['details_item_value_listingid']; ?>
&item_name=<?php echo ((is_array($_tmp=$this->_tpl_vars['users_items_details']['title'])) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/my_email_icon.jpg" alt="" class="vAlign" /> Email to friend</a></div>
							</div>
						</div>
						<div class="rightbox">
							<div class="rightboxhd">Facts</div>
							<div class="whiteinsidebox">
								<div>Item uploaded on <?php echo ((is_array($_tmp=$this->_tpl_vars['users_items_details']['date_added'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%b %d, %Y") : smarty_modifier_date_format($_tmp, "%b %d, %Y")); ?>
<br />
								Product Id # <?php echo $this->_tpl_vars['details_item_value_listingid']; ?>
<br />
								<?php echo $this->_tpl_vars['users_items_details']['counter_view']; ?>
 clicks<br />
								<a id='a_div1' href='javascript://' onclick="return show_div('1')" >+</a><a style='display:none;' id='a_div0' href='javascript://' onclick="return show_div('0')" >+</a>&nbsp;&nbsp;<a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
contact_us.php?details_item_value=<?php echo $this->_tpl_vars['details_item_value_listingid']; ?>
&item_name=<?php echo ((is_array($_tmp=$this->_tpl_vars['users_items_details']['title'])) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
">Report It</a></div>
							</div>
                                                      <div class="whiteinsidebox" id='div_txt' style='font-size:12px;color:red;font-weight:500px;font-family:arial;padding-top:1px;' >
								
							</div>
						</div>

<!-- Below code starts for replacement-->
                                               <div class="buyNow" >
						     <div class="buyNowtextfl" style='border:0px solid red;'>
                                                       <?php if ($this->_tpl_vars['users_items_details']['hatting_status'] == 1 && $this->_tpl_vars['users_biditems_details_status'] > 0 && $this->_tpl_vars['users_items_details']['quantity_available'] != 0): ?>
                  		                       <span  ><?php echo $this->_tpl_vars['USD']; ?>
 <?php echo ((is_array($_tmp=$_SESSION['d_cost_item'])) ? $this->_run_mod_handler('convert_number', true, $_tmp) : smarty_modifier_convert_number($_tmp)); ?>
<br>
							<?php echo ((is_array($_tmp=$_SESSION['d_cost_item'])) ? $this->_run_mod_handler('convert_price', true, $_tmp) : smarty_modifier_convert_price($_tmp)); ?>
<br /></span>
                                                        <?php endif; ?>
                                                <?php if ($this->_tpl_vars['users_items_details']['hatting_status'] != 1): ?>
	                                      <span  <?php if ($this->_tpl_vars['result_coupon_exsist'] > 0): ?>style='text-decoration:line-through;font-size:12px;'<?php endif; ?>><?php echo $this->_tpl_vars['USD']; ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['users_items_details']['cost_item'])) ? $this->_run_mod_handler('convert_number', true, $_tmp) : smarty_modifier_convert_number($_tmp)); ?>
<br />
							<?php echo ((is_array($_tmp=$this->_tpl_vars['users_items_details']['cost_item'])) ? $this->_run_mod_handler('convert_price', true, $_tmp) : smarty_modifier_convert_price($_tmp)); ?>
<br /></span>
                                                       <?php if ($this->_tpl_vars['result_coupon_exsist'] == 1 || $this->_tpl_vars['coupon_d'] == 1): ?>
                                                        <span style='font-size:12px;color:red;'>
                                                        <!--<?php echo $this->_tpl_vars['USD']; ?>
--><?php echo ((is_array($_tmp=$this->_tpl_vars['str_amount_final'])) ? $this->_run_mod_handler('convert_price', true, $_tmp) : smarty_modifier_convert_price($_tmp)); ?>
.
                                                              </span>
                                           <br />
                                                              <?php endif; ?>
                                                 <?php endif; ?>
                       <?php if ($this->_tpl_vars['users_items_details']['hatting_status'] == 1 && $this->_tpl_vars['users_biditems_details_status'] == 0 && $this->_tpl_vars['users_items_details']['quantity_available'] != 0): ?>
                                                    <span >
                       <?php echo $this->_tpl_vars['USD']; ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['users_items_details']['cost_item'])) ? $this->_run_mod_handler('convert_number', true, $_tmp) : smarty_modifier_convert_number($_tmp)); ?>
<br><?php echo ((is_array($_tmp=$this->_tpl_vars['users_items_details']['cost_item'])) ? $this->_run_mod_handler('convert_price', true, $_tmp) : smarty_modifier_convert_price($_tmp)); ?>
<br />
                                                     </span>
                       <?php endif; ?> In Stock qty <?php echo $this->_tpl_vars['users_items_details']['quantity_available']; ?>

			    			        </div>
							<div class="buyNowbtn" style='border:0px solid red;' >
                                             <?php if ($this->_tpl_vars['users_items_details']['hatting_status'] == 1 && $this->_tpl_vars['users_biditems_details_status'] > 0 && $this->_tpl_vars['users_items_details']['quantity_available'] != 0): ?>
                         <!--    <a href="shipping_details.php?item_id=<?php echo $this->_tpl_vars['users_items_details']['item_id']; ?>
&seller_id=<?php echo $this->_tpl_vars['users_items_details']['seller_id']; ?>
">
                            <img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/buy_bow_btn.jpg" alt="" border="0" /></a>-->
							 <?php endif; ?>
                        <?php if ($this->_tpl_vars['users_items_details']['hatting_status'] != 1 && $this->_tpl_vars['users_items_details']['quantity_available'] != 0): ?>
                           <!--  <a href="shipping_details.php?item_id=<?php echo $this->_tpl_vars['users_items_details']['item_id']; ?>
&seller_id=<?php echo $this->_tpl_vars['users_items_details']['seller_id']; ?>
">
                             <img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
images/buy_bow_btn.jpg" alt="" border="0" /></a>-->
			 <?php endif; ?></div>

                                   <div class="clear"></div>
						      </div>
					       </div>
                    <!-- above replacement code ends-->
			<!--End right part -->
					<div class="clear"></div>
        <?php else: ?>
	<div class="insidemiddlemian" style="border:0px solid #FF0000 ;height:400px;font-family:Arial, Helvetica, sans-serif;font-size:18px;color:#B36666;font-weight:700;text-align:center;padding-top:15px;">Store is currently suspended by Admin.</div>
	<?php endif; ?>
     	<?php endif; ?> <!-- this if is closed for deleted or quantity equal to zero-->

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