<?php /* Smarty version 2.6.18, created on 2011-12-17 20:37:16
         compiled from sell-an-item.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'sell-an-item.tpl', 143, false),)), $this); ?>
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
<!-- Jquery Fancy Box -->
<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['baseUrl']; ?>
fancybox/jquery.fancybox-1.2.6.css" media="screen" />
<script type="text/javascript" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
fancybox/jquery.fancybox-1.2.6.pack.js"></script>
<script type="text/javascript" src="js/jquery/jquery-ui-1.7.1.custom.min.js"></script>
<div id="middleMain">
<script language="javascript" type="text/javascript">
<?php echo '		
$(document).ready(function()
{
	$("a.item_quantity").fancybox({
	\'hideOnContentClick\': false,
	\'frameWidth\'			: 355,
	\'frameHeight\'			: 200		
	});
});

function enter_amt_close(VAL)
{
	if(VAL==1)
	document.getElementById(\'div_ship_india\').style.display="";
	if(VAL==0)
	document.getElementById(\'div_ship_india\').style.display="none";

}

function enter_amt_close1(VAL)
{
	if(VAL==1)
	document.getElementById(\'div_ship_international\').style.display="";
	if(VAL==0)
	document.getElementById(\'div_ship_international\').style.display="none";

}

function check_val()
{
	var ava_qty = parseInt(document.getElementById(\'max_quantity\').value);
	var min_qty = parseInt(document.getElementById(\'quantity\').value);
	if(ava_qty < min_qty)
	{
		alert(\'Minimum Quantity cannot be greater than Available Quantity!!\');
		return false;
	}
	else
	{
		return true;
	}
}

function lock_per_close()
{
	document.getElementById(\'locker_permission\').style.display="none";

}

function lock_per_open()
{
	document.getElementById(\'locker_permission\').style.display="block";
}

//function is used to create sub-category drop down
function selectSubCategories(parent_id, category_id)
{
   $("#respDiv").html("<img src=\'images/icon_loading.gif\' alt=\'Please wait\' />");
   $.ajax({
   type: "GET",
   url: "sell-an-item.php",
   data: "parent_id="+parent_id+"&category_id="+category_id,
   success: function(response_data)
   {
     //alert( "response_data: " + response_data );
     $("#respDiv").html(response_data);
   }
 });
}
'; ?>

</script>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "left_category.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<!--Start Middle-->
		<div id="middleMain">
				
				<div id="middleRtMain">
				<div style="border:0px solid #FF0000;width:700px;" >
				<div class="mainHD">Sell an Item</div>
				<div class="fr" style='padding-right:10px;font-weight:bold;' ><a href='#my_account.php' onclick='history.go(-1)'>Go Back</a></div>
			<div class="clear"></div>
					<!--start top tab-->
					<div>
							<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'error_msg_template.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

						<div class="clear"></div>
					</div>
					<div>
						<span class="selItemtabative"><a href='<?php echo $this->_tpl_vars['baseUrl']; ?>
sell-an-item.php<?php if ($this->_tpl_vars['item_id_value'] != ''): ?>?item_id_value=<?php echo $this->_tpl_vars['item_id_value']; ?>
<?php endif; ?>'>Item Details</a> </span>
					        <span class="selItemtabinactive" >Upload Images</span>
						<span class="selItemtabinactive">Shipping Info</span>
						<span class="selItemtabinactive">Review &amp; Post </span>
						
						<div class="clear"></div>
					</div>
					<!--End top tab-->
					<!--Start inside part -->
				<form name="sell-itemform"  id="sell-itemform" method="post" >

					<div class="sellItemmian">
						<div class="sellLabletext"><span>Item Name
</span><br />
						<span class="classsmallTiTleTXT" style="font-weight:100;font-size:11px;">Give the best name of this item.</span></div>
						
						<div class="selllablefield">
						<input name="title" id='title'  type="text" <?php if ($this->_tpl_vars['title'] != ""): ?>value="<?php echo $this->_tpl_vars['title']; ?>
"<?php else: ?>
						value="<?php echo $this->_tpl_vars['title_value']; ?>
"<?php endif; ?> size=""
						class="required sellinputBox"/>
						</div>
						<div class="sellLabletext" style="float:left;padding-bottom:4px;"><span>Item Detail
</span><br />
					<span class="classsmallTiTleTXT" style="font-weight:100;font-size:11px;">Describe the item in detail like the process how it was made, its uniqueness etc.</span>
						</div>
						<div class="selllablefield"><textarea name="description" cols="30" 
						rows="5" class="required textfield"><?php if ($this->_tpl_vars['description_value'] != ""): ?><?php echo $this->_tpl_vars['description_value']; ?>
<?php endif; ?></textarea></div>
					<div class="sellLabletext" style="float:left;padding-bottom:0px;"><span>Care
</span></div>	
                                     <div class="sellLabletext" style="float:left;padding-bottom:4px;">
                              <span class="classsmallTiTleTXT">Please mention any specific care to be taken while handling this item.
                             </span></div>
					<div class="selllablefield">
	<textarea name="care" cols="30" rows="5" class="textfield"><?php if ($this->_tpl_vars['care'] != ""): ?><?php echo $this->_tpl_vars['care']; ?>
<?php endif; ?></textarea></div>
						<div class="sellLabletext" style='text-align:left;'><span>Item Contents</span><br />
						<span class="classsmallTiTleTXT">List the contents used in item for the buyer to know.</span>
						</div>
						<div class="selllablefield"><textarea name="materials"
						cols="" rows="" class="required textfield"><?php if ($this->_tpl_vars['material'] != ""): ?><?php echo $this->_tpl_vars['material']; ?>
<?php else: ?><?php echo $this->_tpl_vars['material_used_value']; ?>
<?php endif; ?></textarea></div>
						
						<div class="sellLabletext"><span>Category</span><br />
						<span class="classsmallTiTleTXT">Select the category this item fits in below category text.</span></div>
						<div class="selllablefield">
						<select name="parent_id" id="parent_id" style="width:204px;" class="required priceinputbox " onchange="selectSubCategories(this.value, 0);">
						<option value="">-- Select Category --</option>
						<?php echo smarty_function_html_options(array('values' => $this->_tpl_vars['parentID'],'output' => $this->_tpl_vars['parentNAME'],'selected' => $this->_tpl_vars['parent_id']), $this);?>

						</select>
						</div>

						<div class="sellLabletext"><span>Sub Category</span><br />
						<span class="classsmallTiTleTXT">Select sub-category this item fits in.</span></div>
						<div class="selllablefield" id="respDiv">
						<select name="category_id" class="required priceinputbox" style="width:204px;">
						<option value="">-- Select Sub Category --</option>
												</select>
						</div>
						<div class="sellLabletext" >
						
						   <div class="sellLabletext" style="width:570px;float:right;border:0px solid red;">
						   <span class="sellLabletext"> Styles</span>
							<br />
							<span style="font-family:Arial, Helvetica, sans-serif;color:#666666;font-weight:100;font-size:11px;text-align:left;padding-left:4px;">
							Select the style statement to the item for buyers to find you item by style.
						   </span></div>
						   

						</div>
						<div class="selllablefield" style="text-align:left;float:left;border:0px solid red;">
					
				 <div style="width:600px;float:right;text-align:left;border:0px solid red;">
						    <select multiple="multiple" id="style_id" size="4" name="style_id[]" class="required input"><?php echo smarty_function_html_options(array('values' => $this->_tpl_vars['styleId'],'output' => $this->_tpl_vars['styleNAME'],'selected' => $this->_tpl_vars['style_id_value']), $this);?>

						 </select><br />
						 <span style="font-family:Arial, Helvetica, sans-serif;font-size:11px; color:#FF0000;">Use CTRL Key to select more than one option.</span><br /><br />
					      </div>
						 
					  </div>
					<!--  <div class="selllablefield" style="text-align:left;float:left;border:0px solid red;">
					
				 <div style="width:600px;float:right;text-align:left;border:0px solid red;">
						    <select multiple="multiple" id="style_id" size="4" name="style_id[]" class="required input"><?php echo smarty_function_html_options(array('values' => $this->_tpl_vars['styleId'],'output' => $this->_tpl_vars['styleNAME'],'selected' => $this->_tpl_vars['style_id_value']), $this);?>

						 </select><br />
						 <span style="font-family:Arial, Helvetica, sans-serif;font-size:11px; color:#FF0000;">Use CTRL Key to select more than one option.</span><br /><br />
					      </div>
						  
					  </div>-->
					 <!-- <div style="width:600px;border:1px solid red;" >
						   <div class="pricelableText" style='width:100px;float:left;border:0px solid red;'><strong>Price</strong></div>
						<div class="pricelable" style='width:500px;float:right;border:0px solid red;' >$ <input name="price" id='price' style="width:120px;" type="text" class="required sellinputBox" <?php if ($this->_tpl_vars['cost_item'] != ""): ?>value="<?php echo $this->_tpl_vars['cost_item']; ?>
"<?php else: ?> value="<?php echo $this->_tpl_vars['cost_item_value']; ?>
"<?php endif; ?> size="" /> (each)
							     </div>
						</div>-->
						<div class="sellLabletext" style="text-align:left;float:left;border:0px solid red;">
					 <div style="width:50px;float:left;text-align:left;border:0px solid red;">   <span class="sellLabletext">Price</span></div>
				 
						  
					  </div>
					   
					  <div class="sellLabletext" style="text-align:left;float:left;border:0px solid red;">
					 
				 <div style="width:500px;float:left;text-align:left;border:0px solid red;padding-left:3px;">
						 <span style="font-weight:bold;" class="classsmallTiTleTXT">USD</span> 
						 <input name="price" id='price' style="width:120px;" <?php if ($this->_tpl_vars['request_item_id'] != 0 || $this->_tpl_vars['reqid'] != ""): ?> readonly="true"<?php endif; ?>type="text" class="required priceinputbox" <?php if ($this->_tpl_vars['cost_item'] != ""): ?>value="<?php echo $this->_tpl_vars['cost_item']; ?>
"<?php else: ?> value="<?php echo $this->_tpl_vars['cost_item_value']; ?>
"<?php endif; ?> size="" />  <span style="font-weight:100;" class="classsmallTiTleTXT">(each)</span>&nbsp;&nbsp;&nbsp;
<a class="item_quantity iframe" href="<?php echo $this->_tpl_vars['baseUrl']; ?>
currency_converter.php?details_item_value=<?php echo $_GET['details_item_value']; ?>
" style='font-size:12px;' >Currency Converter as to convert your currency to USD </a>
					      </span></div>
						  
					  </div>
						<div class="clr"></div>
                     <?php if ($this->_tpl_vars['num_value_TOTdetails'] == 0 && $this->_tpl_vars['item_id_value'] == '' && $this->_tpl_vars['store_name_user'] == ''): ?>			
			<!--<div class="sellLabletext" style='width:150px;border:0px solid red;' >
				<span class="sellLabletext">		Store Name&nbsp;</span></div>
						<div class="pricelableText" style='width:450px;border:0px solid red;' >
						</div>
						<div class="pricelableText" style='width:50px;border:0px solid red;' >
						
						
						</div>-->
						
						<!--<div class="pricelable" >
						<div style='width:453px;border:0px solid red;float:left;padding-left:5px;'>
						<input name="store_name" id="store_name" type="text" class="required"	style="width:190px;" value="" />
						 </div>
						
						
						</div>	-->
						
						<?php endif; ?>
						<div class="sellLabletext" style='width:150px;border:0px solid red;' > <span class="sellLabletext">Available Quantity&nbsp;</span></div>
						<div class="pricelableText" style='width:450px;border:0px solid red;' ><!--<strong>Weight of Quantity :</strong>-->
						</div>
						<div class="pricelableText" style='width:50px;border:0px solid red;' >
						<!--<strong>Unit</strong>-->
						
						</div>
						
						<div class="pricelable" >
						<div style='width:453px;border:0px solid red;float:left;padding-left:5px;'>
						  <input name="max_quantity" id="max_quantity" 	
						  <?php if ($this->_tpl_vars['request_item_id'] != 0 || $this->_tpl_vars['reqid'] != ""): ?> readonly="true"<?php endif; ?>
						type="text" class="priceinputbox required"	style="width:70px;" 
						<?php if ($this->_tpl_vars['quantity'] != ""): ?>value="<?php echo $this->_tpl_vars['quantity']; ?>
"<?php else: ?>	value="<?php echo $this->_tpl_vars['max_item_value']; ?>
"<?php endif; ?> />
						</div>
						
						
						</div>
						<div class="sellLabletext" 
				style='width:150px;border:0px solid red;padding-bottom:0px;' > <span class="sellLabletext">Color&nbsp;</span></div>
						<div class="pricelable" >
						<div style='width:603px;border:0px solid red;float:left;'>
						<div> <span class="classsmallTiTleTXT" style="padding-bottom:8px;padding-left:6px;" >Mention the color of this item for the buyer to find the item by color and for writing multiple colors use comma.</span> </div>
						<div style="padding-top:5px;padding-left:4px;"> 
						 <input name="color" id='color' type="text" class="priceinputbox required" style="width:300px;"		<?php if ($this->_tpl_vars['color'] != ""): ?>value="<?php echo $this->_tpl_vars['color']; ?>
"<?php endif; ?> />&nbsp;&nbsp;
				</div>
				</div>
					
					
						</div>
						<div class="clr"></div>
						<?php if ($this->_tpl_vars['reqid'] == "" && $this->_tpl_vars['request_item_id'] == 0): ?>
						<div class="sellLabletext">
						<span class="sellLabletext">Minimum Quantity </span>
						</div>
						<div class="pricelableText classsmallTiTleTXT"  style='width:500px;font-size:11px;padding-left:3px;' ><span class="classsmallTiTleTXT" style="font-size:11px;">Please enter minimum quantity to get inventory alert notification.</span></div>
						<div class="pricelable" style='padding-left:3px;'> 
						<input name="quantity" type="text" id='quantity'
						class="priceinputbox required" value="<?php echo $this->_tpl_vars['inventory_alert_value']; ?>
"  size="" />
						
						</div>
						<?php endif; ?>
						<div class="clr"></div>
					      <?php if ($this->_tpl_vars['hatting_status'] != 1 && ( $this->_tpl_vars['reqid'] == "" && $this->_tpl_vars['request_item_id'] == 0 )): ?>
						<div class="sellLabletext"><span>Do you want to add this item for locker area ?.</span></div><br />
						<div class="pricelableText" style='width:200px;' >Yes
<input type="radio" name="lock" <?php if ($this->_tpl_vars['locker_status'] == 1): ?>checked <?php endif; ?> value="1" onclick="lock_per_open();"> &nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;No <input <?php if ($this->_tpl_vars['locker_status'] == 0 || $_REQUEST['item_id_value'] == ''): ?>checked <?php endif; ?> type="radio" name="lock" value="0"	 onclick="lock_per_close();" ></div>
						<?php endif; ?>

						<div class="clr"></div>
					
					<!--	<div class="sellLabletext">
						<span>Shipping </span></div><br />
						<div class="pricelableText" style='width:200px;' >
						<strong>India &nbsp;:</strong>&nbsp;<strong>Free 
						<input type="radio" name="india_ship_rad" <?php if ($this->_tpl_vars['domestic_ship_rate'] == 0): ?> checked <?php endif; ?>value="0"  
						onclick="enter_amt_close('0');"> &nbsp;&nbsp;Paid 
						<input type="radio" name="india_ship_rad" <?php if ($this->_tpl_vars['domestic_ship_rate'] != 0): ?> checked <?php endif; ?> value="1"
                                   onclick="enter_amt_close('1');" 
						></strong>
						&nbsp;&nbsp;<br>
						<div style='padding:8px;<?php if ($this->_tpl_vars['domestic_ship_rate'] == 0): ?> display:none;<?php endif; ?>width:120px;border:0px solid red;' id='div_ship_india'>
						Amount <b>$</b>&nbsp;&nbsp;
						<input type='text' style='width:50px;' 
						value='<?php echo $this->_tpl_vars['domestic_ship_rate']; ?>
' name='ship_india' id='ship_india'></div>
						</div>
                                              -->
						<div class="clr"></div>

					<!--	<div class="sellLabletext"><span>Shipping </span></div><br />-->

						<!--<div class="pricelableText" style='width:200px;' >
						<strong>International &nbsp;:</strong>&nbsp;
						<strong>Free <input type="radio" name="international_ship_rad" <?php if ($this->_tpl_vars['international_ship'] == 0): ?>checked <?php endif; ?>value="0"
						onclick="enter_amt_close1('0');"> 
						&nbsp;&nbsp;Paid <input type="radio" <?php if ($this->_tpl_vars['international_ship'] != 0): ?> checked <?php endif; ?>
						name="international_ship_rad" value="1"	onclick="enter_amt_close1('1');" 
						></strong>
						&nbsp;&nbsp;<br>
						<div style='padding:8px;<?php if ($this->_tpl_vars['international_ship'] == 0): ?>display:none;<?php endif; ?>width:120px;border:0px solid red;' id='div_ship_international'>
						Amount <b>$</b>&nbsp;&nbsp;
						<input type='text' style='width:50px;' value='<?php echo $this->_tpl_vars['international_ship']; ?>
' 
						name='ship_international' id='ship_international'></div>
						</div>-->

						<div class="clr"></div>
                           <?php if ($this->_tpl_vars['hatting_status'] != 1 && ( $this->_tpl_vars['reqid'] == "" && $this->_tpl_vars['request_item_id'] == 0 )): ?>
						<div id="locker_permission" <?php if ($this->_tpl_vars['locker_status'] == 0): ?>style="display:none;"<?php else: ?>style="display:'';" <?php endif; ?>>
						<div class="sellLabletext">
                                                <span>Please give permission for locker item to viewer..</span></div><br />
                             			<div class="pricelableText" style='width:300px;' >
										<strong>View only <input type="radio" name="lock_permi" value="0" <?php if ($this->_tpl_vars['locker_permission'] == 0 || $_REQUEST['item_id_value'] == ''): ?>checked <?php endif; ?> > &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;View & Buy <input type="radio" name="lock_permi" <?php if ($this->_tpl_vars['locker_permission'] == 1): ?>checked <?php endif; ?> value="1"></strong></div>
						</div>
                                                <?php endif; ?>
						<div class="clr"><input type='hidden' value='<?php echo $this->_tpl_vars['item_id_value']; ?>
' name='item_id_value'>
						
						</div>	
						<div class="clr"></div>
						<div class="sellLabletext"><input type='submit'   class="Class_Button_ris"
						value='Submit' name='submit' onclick="return check_val();"  ></div><br />
						<div class="pricelableText">&nbsp;</div>
						<div class="pricelable">&nbsp;	</div>
						<div class="clr"></div>	
						<div >
						<input type="hidden" name="locker_id" value="<?php echo $this->_tpl_vars['reqid']; ?>
">
						<input type="hidden" name="locker_buyer" value="<?php echo $this->_tpl_vars['buyerid']; ?>
">
						<input type="hidden" name="locker_permission" value="1">
						<input type="hidden" name="adv_amount" value="<?php echo $this->_tpl_vars['adv_amount']; ?>
">
						<input type="hidden" name="bal_amt" value="<?php echo $this->_tpl_vars['bal_amt']; ?>
">
						
						</div>
						
					</div>	
					</form>
					<!--End inside part -->
				</div>
				<div align="right">
				<?php if ($this->_tpl_vars['item_id_value'] != ''): ?>
				<a href="upload_imgage.php?item_id_value=<?php echo $this->_tpl_vars['item_id_value']; ?>
">
				<img src="images/next_btn.jpg" alt="" vspace="8" border="0" />
				</a>
				<?php else: ?>
				&nbsp;
				<?php endif; ?>
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<?php if ($this->_tpl_vars['parent_id'] != ""): ?>
		<script language="javascript" type="text/javascript">
		selectSubCategories(<?php echo $this->_tpl_vars['parent_id']; ?>
, <?php echo $this->_tpl_vars['category_id_value']; ?>
);
		</script>
		<?php endif; ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>