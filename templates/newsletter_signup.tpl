{include file="header.tpl"}
	<div>
		<div class="first_block">
			<div class="about_block_new">
			<div class="abt_lft_new"></div>
			<div class="abt_mid_new" style="width:680px;">
				<div class="green_arrow">Newsletter Signup</div>
			</div>
			<div class="abt_right_new"></div>
			
			<div class="abt_back_new" style="min-height:315px; .min-height:325px;">
				<div class="abt_txt_new">
					Sign up for our free monthly e-newsletter and receive new tips on how to save and how to get the most out of your money.  With each e-newsletter, you will also enjoy updated online savings features.					
					<div class="bot_google">
						<form name="newsLetterSignup" id="newsLetterSignup" class="searching_form" method="post">
						<table width="70%" cellpadding="0" cellspacing="10" border="0" style="font-size:12px;">
							<tr><td colspan="2" style="height:8px;"></td></tr>
							<tr>
								<td colspan="2">{include file="error_msg_template.tpl"}</td>
							</tr>
							<tr>
								<td align="right">* E-mail ID:</td>
								<td><input type="text" name="news_letter_email" id="news_letter_email" style="width:235px;" class="required email" /></td>
							</tr>
							<tr>
								<td align="right">* Confirm E-mail ID:</td>
								<td><input type="text" name="c_news_letter_email" style="width:235px;" class="required" equalTo="#news_letter_email" /></td>
							</tr>
							<tr>
								<td align="right">&nbsp;</td>
								<td><input type="image" src="images/signup.gif" height="28" width="79" alt="Signup" title="Signup" /></td>
							</tr>
						</table>
						</form>
					</div>
				</div>
			</div>
			<div class="abt_bot_new"></div>
			
			{include file="bottom_advertise.tpl"}
		</div>
		</div>
		{include file="member_login.tpl"}
	</div>
{include file="footer.tpl"}