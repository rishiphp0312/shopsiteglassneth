{include file="header.tpl"}
{include file="js_css_validation.tpl"}
{include file="header_search.tpl"}
		
		
		

		<!--Start Middle-->
		<div id="middleMain">
			<div>
				<span class="mainHD">My Account</span>
				<div class="registerBg">
					<div class="field">Username:</div>
					<div class="labal">{$smarty.session.session_user_name}<br /><span class="smallText">usernames cannot be changed, sorry!</span></div>
					<div class="clr"><img src="images/spacer.gif" height="1" width="1" /></div>
					<div class="field">Password:</div>
					<div class="labal">(hidden)<br /><span class="smallText">
			
					<a href="change_password.php" title="change your Password" >Change 
					Password</a>

				
					</span></div>
					<div class="clr"><img src="images/spacer.gif" height="1" width="1" /></div>
					<div class="field">Email:</div>
					<div class="labal">{$smarty.session.session_user_email_id}(confirmed)
					<br /><span  class="smallText">
					<a href="change_email.php" title="change your email" >Change your email</a>

					</span></div>
					<div class="clr"><img src="images/spacer.gif" height="1" width="1" /></div>
					<div class="field">Address:</div>
					<div class="labal">
					{$smarty.session.session_user_address}<br /> <span  class="smallText">
					<a href="change_address.php">Change your Address</a></span></div>
					<div class="clear"></div>
					<br />
					<!--{if $smarty.session.session_user_type==3}
					<div class="field">Payment Details:</div>
					<div class="labal">
					<span  class="smallText">
					<a href="change_payment_details.php">Change your payment details</a></span></div>
					{/if}
					<div class="clear"></div>
					-->
				</div>
			</div>
		</div>
		<!--End Middle-->
		{include file="footer.tpl"}
