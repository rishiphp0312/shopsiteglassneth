{include file="header.tpl"}
{include file="js_css_validation.tpl"}
{include file="header_search.tpl"}
<!-- Jquery Fancy Box -->
<link rel="stylesheet" type="text/css" href="{$baseUrl}fancybox/jquery.fancybox-1.2.6.css" media="screen" />
<script type="text/javascript" src="{$baseUrl}fancybox/jquery.fancybox-1.2.6.pack.js"></script>
<script type="text/javascript" src="js/jquery/jquery-ui-1.7.1.custom.min.js"></script>
{literal}
<SCRIPT language="JavaScript1.2">
$(document).ready(function()
{
	
	$("a.item_quantity").fancybox({
	'hideOnContentClick': false,
	'frameWidth'			: 625,
	'frameHeight'			: 500		
	});
});

</SCRIPT>
{/literal}
<!--Start Middle-->
	<div id="middleMain">
	{if $user_type==4}
	{assign var=user_buyer value="checked='checked'"}
	{else}
	{assign var=user_seller value="checked='checked'"}
	{/if}
	
	{if $agree}
	{assign var=agree value="checked='checked'"}
	{/if}
	{literal}
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
						
						
						//	alert(id+'id');
						xmlhttp=GetXmlHttpObject();
						//alert(xmlhttp+'id');
						if (xmlhttp==null)
						  {
						  alert ("Your browser does not support XMLHTTP!");
						  return;
						  }
						var url="response.php";
						url=url+'?data='+id+'&cate_id='+cate_id;
						//alert(id+'id');
						xmlhttp.onreadystatechange=function()
						{
						if(xmlhttp.readyState==4)
						  {
						  //alert(xmlhttp.responseText+'==text');
						  //document.getElementById('subcategory').style.display="block";
						  //document.getElementById('subcategory').style.float="left";

						  document.getElementById("state_ajax_id").innerHTML=xmlhttp.responseText;
						  setsubcategory(cate_id,sub_cat_id);
						  }
						}
						xmlhttp.open("GET",url,true);
						xmlhttp.send(null);
							
							
						}



</script>




						{/literal} 


			<div>
				<form id="frmRegister" name="frmRegister" class="formular" method="post" action="{$baseUrl}registration.php" autocomplete="off">
				<span class="mainHD">Create Your Nethaat Account</span>
				<div class="registerBg">
					<div class="registerSUbHd">Account Details<div class="reqField">*required</div></div>
					{include file='error_msg_template.tpl'}
					<div class="field">First Name:<span class="redClr">*</span></div>
					<div class="labal"><input type="text" name="first_name" id="first_name" 
					class="formInput required alph_num_space" maxlength="30" value="{$first_name}" /><br />
					
		</div>
					<div class="clr"><img src="images/spacer.gif" height="1" width="1" /></div>
					<div class="field">Last Name:<span class="redClr">*</span></div>
					<div class="labal"><input type="text" name="last_name" id="last_name" 
					class="formInput required alph_num_space" maxlength="30" value="{$last_name}" /><br />
					
		</div>
					<div class="clr"><img src="images/spacer.gif" height="1" width="1" /></div>
					<div class="field">Username:<span class="redClr">*</span></div>
					<div class="labal"><input type="text" name="username" id="username" class="formInput required alph_num" maxlength="30" value="{$username}" /><br /><span class="smallText">For seller user name is their shop name. So choose a user name which is unique since this cannot be changed. So brainstorm the name to fit into your identity of your shop.<br /><br />This will become your sub domain name like, http://username.nethaat.com. Use this subdomain name on your profile, your stationery, give it to your family and friends and let all know your presence on the web.</span></div>
					<div class="clr"><img src="images/spacer.gif" height="1" width="1" /></div>
					<div class="field">Email:<span class="redClr">*</span></div>
					<div class="labal"><input type="text" name="email" id="email" 
					class="formInput  email" value="{$email}" maxlength="60"  /><br />
					<span class="smallText">We will never share your email with any third party and will be used by us as per our privacy policy only.</span></div>
					<div class="clr"><img src="images/spacer.gif" height="1" width="1" /></div>
					<div class="field">Retype Your Email:<span class="redClr">*</span></div>
					<div class="labal"><input type="text" name="reemail" id="reemail" 
					equalto="#email" class="formInput email" maxlength="60" value="{$email}" /></div>
					<div class="clr"><img src="images/spacer.gif" height="1" width="1" /></div>
					<div class="field">Password:<span class="redClr">*</span></div>
					<div class="labal"><input type="password" name="password" id="password" class="formInput required" maxlength="40" value="{$password}" /></div>
					<div class="clr"><img src="images/spacer.gif" height="1" width="1" /></div>
					<div class="field">Retype Your Password:<span class="redClr">*</span></div>
					<div class="labal"><input type="password" name="repassword" id="repassword" equalto="#password" class="formInput required" maxlength="40" value="{$password}" /></div>

					<div class="clr"><img src="images/spacer.gif" height="1" width="1" /></div>
					<div class="field">Zipcode:<span class="redClr">*</span></div>
					<div class="labal">
<input type="text" name="zipcode" class="formInput required" maxlength="20" value="{$zipcode|clear_input}" /></div>

					<div class="clr"><img src="images/spacer.gif" height="1" width="1" /></div>
					<div class="field">City:<span class="redClr">*</span></div>
					<div class="labal">
<input type="text" name="city" class="formInput required" maxlength="50" id='city' value="{$city|clear_input}" /></div>

                                        <div class="clr"><img src="images/spacer.gif" height="1" width="1" /></div>
		             <div class="field">State:<span class="redClr">*</span></div>
					<div class="labal">
<input type="text" name="state" id='state' class="formInput required" maxlength="50" value="{$state|clear_input}" /></div>

                                        <div class="clr"><img src="images/spacer.gif" height="1" width="1" /></div>
		             <div class="field">Country :<span class="redClr">*</span></div>
					<div class="labal"><select class="formSel" name="country_id">
			{html_options values=$countryID output=$countryName selected=$country_id}
					</select></div>

                                        <div class="clr"><img src="images/spacer.gif" height="1" width="1" /></div>
		             
           <div class="field">Phone:<span class="redClr">*</span></div>
					<div class="labal"><input type="text" name="phone1" id="phone1"  
					class="formInput required only_numeric" maxlength="40" 
					value="{$phone1}" /></div>


						
										
					<div class="field">Artisians</div>
					<div class="labal">
					<table>
					<tr><td valign="top"><input type="radio" checked="checked" value="1" name="banner_val" /></td><td valign="top">
	<img  src="{$baseUrl}getthumb.php?w=300&h=100&fromfile=test-baner/artisans.jpg" /></td>
	               </tr></table>
					</div>
					<div class="clr"><img src="images/spacer.gif" height="1" width="1" /></div>					
					<div class="field">Artists</div>
					<div class="labal">
					<table>
					<tr><td valign="top">
					<input type="radio" value="2" name="banner_val" /></td><td valign="top">
	<img  src="{$baseUrl}getthumb.php?w=300&h=100&fromfile=test-baner/artists.jpg" /></td>
	               </tr></table>
					</div>
							<div class="clr"><img src="images/spacer.gif" height="1" width="1" /></div>					
					<div class="field">Designers</div>
					<div class="labal">
					<table>
					<tr><td valign="top">
					<input type="radio" value="3" name="banner_val" /></td><td valign="top">
	<img  src="{$baseUrl}getthumb.php?w=300&h=100&fromfile=test-baner/designeres.jpg" /></td>
	               </tr></table>
					</div>
							<div class="clr"><img src="images/spacer.gif" height="1" width="1" /></div>					
					<div class="field">Homemakers</div>
					<div class="labal">
					<table>
					<tr><td valign="top">
					
					<input type="radio" value="4" name="banner_val" /></td><td valign="top">
                 	<img  src="{$baseUrl}getthumb.php?w=300&h=100&fromfile=test-baner/homemakers.jpg" /></td>
	               </tr></table>
					</div>
					<div class="clr"><img src="images/spacer.gif" height="1" width="1" /></div>					
					<div class="field">Account Security Question:<span class="redClr">*</span></div>
					<div class="labal">
					<select class="formSel required" name="security_question" id="security_question">
						
					{html_options values=$securityQusValue output=$securityQusOut selected=$security_question}
					</select>
					</div>
					<div class="field" id='show_some'>Security Question Answer:<span class="redClr">*</span></div>
					<div class="labal"><input type="text" name="security_answer"
					id="security_answer" value="{$security_answer}" class="formInput required" maxlength="50" /></div>
				<!--	<div class="clr"><img src="images/spacer.gif" height="1" width="1" /></div>-->
			
					
					
					<div class="clr"><img src="images/spacer.gif" height="1" width="1" /></div>	

					<div class="labal"><input name="agree" id="agree" type="checkbox" {$agree} class="required" value="1" /><label for="agree"> I agree to <a  class="item_quantity" href="{$baseUrl}cms1.php?page=terms">terms of use</a></label></div>
					<div class="clr"><img src="images/spacer.gif" height="1" width="1" /></div>
					<div class="field"></div>
					<div class="labal"><input name="btnRegister" type="submit" value="Sign Up" class="btn" /></div>
					<div class="clr"><img src="images/spacer.gif" height="1" width="1" /></div>
				</div>
				</form>
			</div>
		</div>
<!--End Middle-->
{include file="footer.tpl"}