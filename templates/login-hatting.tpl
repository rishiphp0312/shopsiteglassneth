{include file="header.tpl"}
{include file="js_css_validation.tpl"}
{include file="header_search.tpl"}
<!--Start Middle-->
	<div id="middleMain">
			<span class="mainHD">Sign In to Nethaat</span>
			<div class="loginOB" style='border:0px solid red;width:950px;padding:0px;text-align:left;float:left;'>
				<div style='border:0px solid yellow;width:940px;padding:5px;'>

				<div class="loginBg" style='height:340px;border:0px solid yellow;width:500px;padding:5px;float:left;'>
<form name="frmLogin" id="frmLogin" action="{$baseUrl}login-hatting.php" method="post">

					{include file='error_msg_template.tpl'}
					<div class="fl" style='border:0px solid green;padding: 0 2px 0 10px; width:210px;'>
					Username:<br />
					<input name="username" style='width:180px;margin-top:3px;' id="username" type="text" class="required formInput" value="{$username}" /><br /><br />
					Password:<br />
					<input name="password" style='width:180px;margin-top:3px;' id="password" type="password" class="required formInput" value="{$password}" /><br /><br />
					<!--<input name="rememberMe" type="checkbox" value="1" {$rememberMe}/>Stay signed in for one day<br /><br />-->
					<input name="Login" type="submit" value="Login" class="btn" /> <a href="{$baseUrl}forgot_password.php">Forgot your password?</a>
					</div>
					<div class="nymBg" style='border:0px solid green;padding:0 15px 0 2px;width:230px;'>
						<div class="top">Don't have an account?
						<span>No worries.</span>
						</div>
						<div class="bottom">
						<a href="{$baseUrl}registration.php">Create New Account</a>
						<span>It's easy!</span>
						</div>

					</div>
<div  style='border:0px solid yellow;width:500px;padding:5px;float:left;'>
&nbsp;</div><div  style='border:0px solid yellow;width:500px;padding:5px;float:left;'>
&nbsp;</div>                            			<div class="clear"></div>
				</form></div>
<div class="loginBg" style='border:0px solid yellow;width:380px;padding:5px;float:right;'>
<div>&nbsp;</div>

<div style='padding:1px;text-align:left;color:#000000;font-weight:bold;' >This is a place where we can negotiate the product for a right price.</div>
<div>&nbsp;</div>
<div style='padding:1px;text-align:left;color:#907059;font-weight:bold;font-family:verdana;font-size:15px;'>Haating Process:</div>
<div>&nbsp;</div>
<div class='style_log_haat'>(1)&nbsp;Login to access Haating.</div>
<div>&nbsp;</div>
<div class='style_log_haat'>(2)&nbsp;As a buyer , you are allowed once to haat (negotiate) for a particular
item from the seller and you get 3 chance to quote your price.</div>
<div>&nbsp;</div>
<div class='style_log_haat'>(3)&nbsp;The first price , which is in the sellers defined range is what you
pay.If you are'nt succesfull in three chances ,you are allowed to leave your best offer .</div>
<div>&nbsp;</div>
<div class='style_log_haat'>(4)&nbsp;If seller agrees for the offered price, the seller would send a checkout
page with acceptance of the price.</div>
<div>&nbsp;</div>
<div class='style_log_haat'>(5)&nbsp;Please checkout through the link and pay for the item.</div>
<div>&nbsp;</div>
</div>
<div class="clear"></div>
</div>
				

		<div class="clear"></div>
	</div>
	<script language="javascript" type="text/javascript">
	document.getElementById('username').focus();
	</script>
<!--End Middle-->
{include file="footer.tpl"}