<?php /* Smarty version 2.6.18, created on 2011-05-01 15:37:40
         compiled from upload_imgage.tpl */ ?>
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

<?php echo '
<SCRIPT language="JavaScript1.2">
function confirm_msg(id, parent_id)
{
	var message = "Do you really want to delete this image?";
	//if(id==0)
	//{
	//	message += "\\n This action also delete all child categories associated with this.";
	//	jAlert("You can not delete a parent category.",\'Error\');
	//	return false;	
	//}
	jConfirm(message, \'Confirm\', function(r) 
	{
		if(r)
		{
			location.href=\'upload_imgage.php?unlink_this_img=\'+id+\'&col_position=\'+parent_id;
		}
		else
		{
			return false;
		}	
	});
}


</SCRIPT>
			
'; ?>
	
		<!--End Logo-->
		<!--Start Middle-->
		<div id="middleMain">
			
				
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "left_category.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		
		<!--Start Middle-->
		<div id="middleMain">
			
			<div id="middleRtMain" >
				<div>
				<div class="mainHD">Sell an Item</div>
				<div class="fr" style='padding-right:10px;font-weight:bold;' ><a href='#my_account.php' onclick='history.go(-1)'>Go Back</a></div>
			<div class="clear"></div>
					<!--start top tab-->
					<div>
					
						<span class="selItemtabinactive">Item Details </span>
						
						<span class="selItemtabative" >
						<a href='<?php echo $this->_tpl_vars['baseUrl']; ?>
upload_imgage.php<?php if ($this->_tpl_vars['item_id_value'] != ''): ?>?item_id_value=<?php echo $this->_tpl_vars['item_id_value']; ?>
<?php endif; ?>'>Upload Images</a> 
						</span>
						<span class="selItemtabinactive">Shipping Info</span>
	        				<span class="selItemtabinactive">Review &amp; Post </span>
						<!--	<span class="selItemtabinactive">
						<a href='#<?php echo $this->_tpl_vars['baseUrl']; ?>
review-post.php'>Review &amp; Post</a> </span>-->
						<div class="clear"></div>
					</div>
					<!--End top tab-->
					<!--Start inside part -->
                                       <div class="sellItemmian" style='font-size:12px;text-align:left;color:red;font-family:arial;border-bottom:0px solid;'>
                                      <span style='color:#000000;'> Note&nbsp;:&nbsp;</span>Please Upload image to go further...</div>
						<!--Start find image -->
					<div class="sellItemmian">
						<!--Start find image -->
				<form name='frm_img_upload' action='' method='post' enctype='multipart/form-data'>
<div class="uploadhd" style='padding-top:0px;'><strong>Upload Images</strong>
<input type='hidden' value='<?php echo $this->_tpl_vars['item_id_value']; ?>
' name='item_id_value'></div>
Use .jpg, .gif or .png files only and total size of all files should not be larger than 2MB or 2000KB .
Images around 1,000 pixels wide work best.<br /><br />
						<div class="browsbsection"><input name="upload_img_1" type="file" class="browsbtn" />
						<input type='hidden' name='removeimage1' value='<?php echo $this->_tpl_vars['showimage1']; ?>
'></div>
						<div class="browsbsection"><input name="upload_img_2" type="file" class="browsbtn" />
                                                    <input type='hidden' name='removeimage2' value='<?php echo $this->_tpl_vars['showimage2']; ?>
'></div>
						<div class="browsbsection"><input name="upload_img_3" type="file" class="browsbtn" />
                                                    <input type='hidden' name='removeimage3' value='<?php echo $this->_tpl_vars['showimage3']; ?>
'></div>
						<div class="browsbsection"><input name="upload_img_4" type="file" class="browsbtn" />
                                                    <input type='hidden' name='removeimage4' value='<?php echo $this->_tpl_vars['showimage4']; ?>
'></div>
						<div class="browsbsection"><input name="upload_img_5" type="file" class="browsbtn" />
                                                       <input type='hidden' name='removeimage5' value='<?php echo $this->_tpl_vars['showimage5']; ?>
'></div>
						<!--End find image -->	
						<div class="uploadhd"><strong><!--Upload.--></strong></div>	
						<input name="text" type="submit" value="Upload"  class="Class_Button_ris"  />
					</form>
						<!--start your image -->
						<div class="uploadhd"><strong>Your Images</strong></div>
						<div class="yourImbmain">
							<div class="yourImgbox">
<img src="<?php if ($this->_tpl_vars['showimage1'] != ''): ?><?php echo $this->_tpl_vars['baseUrl']; ?>
getthumb.php?w=150&h=50&fromfile=uploads/<?php echo $this->_tpl_vars['showimage1']; ?>
<?php else: ?>images/no_img.jpg<?php endif; ?>"  alt="" height='50'  class="yourImg"/>
                  <br><?php if ($this->_tpl_vars['showimage1'] != ''): ?> <a onclick="confirm_msg(<?php echo $this->_tpl_vars['item_id_value']; ?>
, '1');" href='#upload_imgage.php?unlink_this_img=<?php echo $this->_tpl_vars['item_id_value']; ?>
&&col_position=1'>Remove</a><?php endif; ?></div>
							<div class="yourImgbox"><img src="<?php if ($this->_tpl_vars['showimage2'] != ''): ?><?php echo $this->_tpl_vars['baseUrl']; ?>
getthumb.php?w=150&h=50&fromfile=uploads/<?php echo $this->_tpl_vars['showimage2']; ?>
<?php else: ?>images/no_img.jpg<?php endif; ?>"  height='50'  alt=""  class="yourImg"/><br><?php if ($this->_tpl_vars['showimage2'] != ''): ?><a onclick="confirm_msg(<?php echo $this->_tpl_vars['item_id_value']; ?>
, '2');" href='#upload_imgage.php?unlink_this_img=<?php echo $this->_tpl_vars['item_id_value']; ?>
&&col_position=2'>Remove</a><?php endif; ?></div>
							<div class="yourImgbox"><img src="<?php if ($this->_tpl_vars['showimage3'] != ''): ?><?php echo $this->_tpl_vars['baseUrl']; ?>
getthumb.php?w=150&h=50&fromfile=uploads/<?php echo $this->_tpl_vars['showimage3']; ?>
<?php else: ?>images/no_img.jpg<?php endif; ?>"  height='50' alt=""
							class="yourImg"/><br><?php if ($this->_tpl_vars['showimage3'] != ''): ?><a onclick="confirm_msg(<?php echo $this->_tpl_vars['item_id_value']; ?>
, '3');"
							href='#upload_imgage.php?unlink_this_img=<?php echo $this->_tpl_vars['item_id_value']; ?>
&&col_position=3'>Remove</a><?php endif; ?></div>
							<div class="yourImgbox">
							<img src="<?php if ($this->_tpl_vars['showimage4'] != ''): ?><?php echo $this->_tpl_vars['baseUrl']; ?>
getthumb.php?w=150&h=50&fromfile=uploads/<?php echo $this->_tpl_vars['showimage4']; ?>
<?php else: ?>images/no_img.jpg<?php endif; ?>"  height='50' alt=""
							class="yourImg"/><br><?php if ($this->_tpl_vars['showimage4'] != ''): ?><a onclick="confirm_msg(<?php echo $this->_tpl_vars['item_id_value']; ?>
, '4');" 
							href='#upload_imgage.php?unlink_this_img=<?php echo $this->_tpl_vars['item_id_value']; ?>
&&col_position=4'>Remove</a><?php endif; ?></div>
							<div class="yourImgbox">
							<img src="<?php if ($this->_tpl_vars['showimage5'] != ''): ?><?php echo $this->_tpl_vars['baseUrl']; ?>
getthumb.php?w=150&h=50&fromfile=uploads/<?php echo $this->_tpl_vars['showimage5']; ?>
<?php else: ?>images/no_img.jpg<?php endif; ?>"
							height='50'alt=""  class="yourImg"/><br><?php if ($this->_tpl_vars['showimage5'] != ''): ?><a onclick="confirm_msg(<?php echo $this->_tpl_vars['item_id_value']; ?>
, '5');" 
							href='#upload_imgage.php?unlink_this_img=<?php echo $this->_tpl_vars['item_id_value']; ?>
&&col_position=5'>Remove</a><?php endif; ?></div>
							
							<div class="clear"></div>
						</div>
						<!--end your image -->	
					</div>	
					<!--End inside part -->
				</div>
				<div align="right">
				<?php if ($this->_tpl_vars['prev_next_id_value'] != '' && $this->_tpl_vars['no_image_upload'] != 1): ?>
				<a href="sell-an-item.php?item_id_value=<?php echo $this->_tpl_vars['prev_next_id_value']; ?>
">
				<img src="images/previous_btn.jpg" alt="" hspace="5" vspace="8px" border="0" />
				</a><a href="shipping_module_item.php?item_id_value=<?php echo $this->_tpl_vars['prev_next_id_value']; ?>
">
				<img src="images/next_btn.jpg" alt="" vspace="8" border="0" /></a>
				<?php else: ?>
				&nbsp;

				<?php endif; ?>
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