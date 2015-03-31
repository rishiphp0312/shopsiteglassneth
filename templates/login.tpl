{include file="header.tpl"}
{include file="js_css_validation.tpl"}
{include file="header_search.tpl"}
<!--Start Middle-->
	<div id="middleMain">
			<span class="mainHD">Sign In to Nethaat</span>
			<div class="loginOB">
				<form name="frmLogin" id="frmLogin" action="{$baseUrl}login.php" method="post">
				<div class="loginBg">
					{include file='error_msg_template.tpl'}
					<div class="fl">
					Username:<br />
					<input name="username" id="username" type="text" class="required formInput" value="{$username}" /><br /><br />
					Password:<br />
					<input name="password" id="password" type="password" class="required formInput" value="{$password}" /><br /><br />
					<!--<input name="rememberMe" type="checkbox" value="1" {$rememberMe}/>Stay signed in for one day<br /><br />-->
					<input name="Login" type="submit" value="Login" class="btn" /> <a href="{$baseUrl}forgot_password.php">Forgot your password?</a>
					</div>
					<div class="nymBg">
						<div class="top">
						Don't have an account?
						<span>No worries.</span>
						</div>
						<div class="bottom">
						<a href="{$baseUrl}registration.php">Create New Account</a>
						<span>It's easy!</span>
						</div>
					</div>
					<div class="clear"></div>
				</div>
				</form>
			</div>
		<div class="clear"></div>
	</div>
	<script language="javascript" type="text/javascript">
	document.getElementById('username').focus();
	</script>
<!--End Middle-->
{include file="footer.tpl"}