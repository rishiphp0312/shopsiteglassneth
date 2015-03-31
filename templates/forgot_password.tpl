{include file="header.tpl"}
{include file="js_css_validation.tpl"}
{include file="header_search.tpl"}
<!--Start Middle-->
	<div id="middleMain">
			<span class="mainHD">Forgot Password</span>
			<div class="loginOB">
			<div style="padding: 5px 0 15px 0; font-size:14px; color:#8A5F40;">If you have forgotten your username OR password simply enter in your email address below.
			<br />Your login details will be emailed to you and your password will be reset.</div>
				<form name="frmForgotPwd" id="frmForgotPwd" method="post" autocomplete="off">
				<div class="loginBg">
					{include file='error_msg_template.tpl'}
					<div class="fl">
					Email:<br />
					<input name="email" id="email" type="text" class="required email formInput" value="{$email}" /><br />
					<!--Security Question:<br /><br />
					<select class="formSel required" name="security_question" id="security_question">
						{html_options values=$securityQusValue output=$securityQusOut selected=$security_question}
					</select><br /><br />
					Your Answer:<br />
					<input name="security_answer" id="security_answer" type="password" class="required formInput" value="{$security_answer}" /><br /><br />-->
					<br /><br /><input name="Login" type="submit" value="Submit" class="btn" /> <a href="{$baseUrl}login.php">Login</a>
					</div>
					<div class="nymBg">
						<div style="padding-top:20px; font-size:16px;">
						Before submitting your request, enter the same Email address you provided during sign up. You we will receive an email with new password.
						</div>
					</div>
					<div class="clear"></div>
				</div>
				</form>
			</div>
		<div class="clear"></div>
	</div>
<!--End Middle-->
{include file="footer.tpl"}