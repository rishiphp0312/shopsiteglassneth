<?php /* Smarty version 2.6.18, created on 2012-01-22 08:54:16
         compiled from registration.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'clear_input', 'registration.tpl', 135, false),array('function', 'html_options', 'registration.tpl', 150, false),)), $this); ?>
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
<?php echo '
<SCRIPT language="JavaScript1.2">
$(document).ready(function()
{
	
	$("a.item_quantity").fancybox({
	\'hideOnContentClick\': false,
	\'frameWidth\'			: 625,
	\'frameHeight\'			: 500		
	});
});

</SCRIPT>
'; ?>

<!--Start Middle-->
	<div id="middleMain">
	<?php if ($this->_tpl_vars['user_type'] == 4): ?>
	<?php $this->assign('user_buyer', "checked='checked'"); ?>
	<?php else: ?>
	<?php $this->assign('user_seller', "checked='checked'"); ?>
	<?php endif; ?>
	
	<?php if ($this->_tpl_vars['agree']): ?>
	<?php $this->assign('agree', "checked='checked'"); ?>
	<?php endif; ?>
	<?php echo '
	<script language="javascript">

						function GetXmlHttpObject()
							{
							if (window.XMLHttpRequest)
							  {
							  // code for IE7+, Firefox, Chrome, Opera, Safari
							  return new XMLHttpRequest();
							  }
							if (window.ActiveXObject)
							  {
							  // code for IE6, IE5
							  return new ActiveXObject("Microsoft.XMLHTTP");
							  }
							return null;
							}

						var xmlhttp;

						function setcategory(id,cate_id,sub_cat_id)
						{
						
						
						//	alert(id+\'id\');
						xmlhttp=GetXmlHttpObject();
						//alert(xmlhttp+\'id\');
						if (xmlhttp==null)
						  {
						  alert ("Your browser does not support XMLHTTP!");
						  return;
						  }
						var url="response.php";
						url=url+\'?data=\'+id+\'&cate_id=\'+cate_id;
						//alert(id+\'id\');
						xmlhttp.onreadystatechange=function()
						{
						if(xmlhttp.readyState==4)
						  {
						  //alert(xmlhttp.responseText+\'==text\');
						  //document.getElementById(\'subcategory\').style.display="block";
						  //document.getElementById(\'subcategory\').style.float="left";

						  document.getElementById("state_ajax_id").innerHTML=xmlhttp.responseText;
						  setsubcategory(cate_id,sub_cat_id);
						  }
						}
						xmlhttp.open("GET",url,true);
						xmlhttp.send(null);
							
							
						}



</script>




						'; ?>
 


			<div>
				<form id="frmRegister" name="frmRegister" class="formular" method="post" action="<?php echo $this->_tpl_vars['baseUrl']; ?>
registration.php" autocomplete="off">
				<span class="mainHD">Create Your Nethaat Account</span>
				<div class="registerBg">
					<div class="registerSUbHd">Account Details<div class="reqField">*required</div></div>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'error_msg_template.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<div class="field">First Name:<span class="redClr">*</span></div>
					<div class="labal"><input type="text" name="first_name" id="first_name" 
					class="formInput required alph_num_space" maxlength="30" value="<?php echo $this->_tpl_vars['first_name']; ?>
" /><br />
					
		</div>
					<div class="clr"><img src="images/spacer.gif" height="1" width="1" /></div>
					<div class="field">Last Name:<span class="redClr">*</span></div>
					<div class="labal"><input type="text" name="last_name" id="last_name" 
					class="formInput required alph_num_space" maxlength="30" value="<?php echo $this->_tpl_vars['last_name']; ?>
" /><br />
					
		</div>
					<div class="clr"><img src="images/spacer.gif" height="1" width="1" /></div>
					<div class="field">Username:<span class="redClr">*</span></div>
					<div class="labal"><input type="text" name="username" id="username" class="formInput required alph_num" maxlength="30" value="<?php echo $this->_tpl_vars['username']; ?>
" /><br /><span class="smallText">For seller user name is their shop name. So choose a user name which is unique since this cannot be changed. So brainstorm the name to fit into your identity of your shop.<br /><br />This will become your sub domain name like, http://username.nethaat.com. Use this subdomain name on your profile, your stationery, give it to your family and friends and let all know your presence on the web.</span></div>
					<div class="clr"><img src="images/spacer.gif" height="1" width="1" /></div>
					<div class="field">Email:<span class="redClr">*</span></div>
					<div class="labal"><input type="text" name="email" id="email" 
					class="formInput  email" value="<?php echo $this->_tpl_vars['email']; ?>
" maxlength="60"  /><br />
					<span class="smallText">We will never share your email with any third party and will be used by us as per our privacy policy only.</span></div>
					<div class="clr"><img src="images/spacer.gif" height="1" width="1" /></div>
					<div class="field">Retype Your Email:<span class="redClr">*</span></div>
					<div class="labal"><input type="text" name="reemail" id="reemail" 
					equalto="#email" class="formInput email" maxlength="60" value="<?php echo $this->_tpl_vars['email']; ?>
" /></div>
					<div class="clr"><img src="images/spacer.gif" height="1" width="1" /></div>
					<div class="field">Password:<span class="redClr">*</span></div>
					<div class="labal"><input type="password" name="password" id="password" class="formInput required" maxlength="40" value="<?php echo $this->_tpl_vars['password']; ?>
" /></div>
					<div class="clr"><img src="images/spacer.gif" height="1" width="1" /></div>
					<div class="field">Retype Your Password:<span class="redClr">*</span></div>
					<div class="labal"><input type="password" name="repassword" id="repassword" equalto="#password" class="formInput required" maxlength="40" value="<?php echo $this->_tpl_vars['password']; ?>
" /></div>

					<div class="clr"><img src="images/spacer.gif" height="1" width="1" /></div>
					<div class="field">Zipcode:<span class="redClr">*</span></div>
					<div class="labal">
<input type="text" name="zipcode" class="formInput required" maxlength="20" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['zipcode'])) ? $this->_run_mod_handler('clear_input', true, $_tmp) : smarty_modifier_clear_input($_tmp)); ?>
" /></div>

					<div class="clr"><img src="images/spacer.gif" height="1" width="1" /></div>
					<div class="field">City:<span class="redClr">*</span></div>
					<div class="labal">
<input type="text" name="city" class="formInput required" maxlength="50" id='city' value="<?php echo ((is_array($_tmp=$this->_tpl_vars['city'])) ? $this->_run_mod_handler('clear_input', true, $_tmp) : smarty_modifier_clear_input($_tmp)); ?>
" /></div>

                                        <div class="clr"><img src="images/spacer.gif" height="1" width="1" /></div>
		             <div class="field">State:<span class="redClr">*</span></div>
					<div class="labal">
<input type="text" name="state" id='state' class="formInput required" maxlength="50" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['state'])) ? $this->_run_mod_handler('clear_input', true, $_tmp) : smarty_modifier_clear_input($_tmp)); ?>
" /></div>

                                        <div class="clr"><img src="images/spacer.gif" height="1" width="1" /></div>
		             <div class="field">Country :<span class="redClr">*</span></div>
					<div class="labal"><select class="formSel" name="country_id">
			<?php echo smarty_function_html_options(array('values' => $this->_tpl_vars['countryID'],'output' => $this->_tpl_vars['countryName'],'selected' => $this->_tpl_vars['country_id']), $this);?>

					</select></div>

                                        <div class="clr"><img src="images/spacer.gif" height="1" width="1" /></div>
		             
           <div class="field">Phone:<span class="redClr">*</span></div>
					<div class="labal"><input type="text" name="phone1" id="phone1"  
					class="formInput required only_numeric" maxlength="40" 
					value="<?php echo $this->_tpl_vars['phone1']; ?>
" /></div>


						
										
					<div class="field">Artisians</div>
					<div class="labal">
					<table>
					<tr><td valign="top"><input type="radio" checked="checked" value="1" name="banner_val" /></td><td valign="top">
	<img  src="<?php echo $this->_tpl_vars['baseUrl']; ?>
getthumb.php?w=300&h=100&fromfile=test-baner/artisans.jpg" /></td>
	               </tr></table>
					</div>
					<div class="clr"><img src="images/spacer.gif" height="1" width="1" /></div>					
					<div class="field">Artists</div>
					<div class="labal">
					<table>
					<tr><td valign="top">
					<input type="radio" value="2" name="banner_val" /></td><td valign="top">
	<img  src="<?php echo $this->_tpl_vars['baseUrl']; ?>
getthumb.php?w=300&h=100&fromfile=test-baner/artists.jpg" /></td>
	               </tr></table>
					</div>
							<div class="clr"><img src="images/spacer.gif" height="1" width="1" /></div>					
					<div class="field">Designers</div>
					<div class="labal">
					<table>
					<tr><td valign="top">
					<input type="radio" value="3" name="banner_val" /></td><td valign="top">
	<img  src="<?php echo $this->_tpl_vars['baseUrl']; ?>
getthumb.php?w=300&h=100&fromfile=test-baner/designeres.jpg" /></td>
	               </tr></table>
					</div>
							<div class="clr"><img src="images/spacer.gif" height="1" width="1" /></div>					
					<div class="field">Homemakers</div>
					<div class="labal">
					<table>
					<tr><td valign="top">
					
					<input type="radio" value="4" name="banner_val" /></td><td valign="top">
                 	<img  src="<?php echo $this->_tpl_vars['baseUrl']; ?>
getthumb.php?w=300&h=100&fromfile=test-baner/homemakers.jpg" /></td>
	               </tr></table>
					</div>
					<div class="clr"><img src="images/spacer.gif" height="1" width="1" /></div>					
					<div class="field">Account Security Question:<span class="redClr">*</span></div>
					<div class="labal">
					<select class="formSel required" name="security_question" id="security_question">
						
					<?php echo smarty_function_html_options(array('values' => $this->_tpl_vars['securityQusValue'],'output' => $this->_tpl_vars['securityQusOut'],'selected' => $this->_tpl_vars['security_question']), $this);?>

					</select>
					</div>
					<div class="field" id='show_some'>Security Question Answer:<span class="redClr">*</span></div>
					<div class="labal"><input type="text" name="security_answer"
					id="security_answer" value="<?php echo $this->_tpl_vars['security_answer']; ?>
" class="formInput required" maxlength="50" /></div>
				<!--	<div class="clr"><img src="images/spacer.gif" height="1" width="1" /></div>-->
			
					
					
					<div class="clr"><img src="images/spacer.gif" height="1" width="1" /></div>	

					<div class="labal"><input name="agree" id="agree" type="checkbox" <?php echo $this->_tpl_vars['agree']; ?>
 class="required" value="1" /><label for="agree"> I agree to <a  class="item_quantity" href="<?php echo $this->_tpl_vars['baseUrl']; ?>
cms1.php?page=terms">terms of use</a></label></div>
					<div class="clr"><img src="images/spacer.gif" height="1" width="1" /></div>
					<div class="field"></div>
					<div class="labal"><input name="btnRegister" type="submit" value="Sign Up" class="btn" /></div>
					<div class="clr"><img src="images/spacer.gif" height="1" width="1" /></div>
				</div>
				</form>
			</div>
		</div>
<!--End Middle-->
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>