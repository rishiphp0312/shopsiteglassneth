{include file="header.tpl"}
{include file="header_search.tpl"}
<!--Start Middle-->
<div id="middleMain">
{include file="js_css_validation.tpl"}

			<div class="giftCartMain">
				<div class="giftCartfl"><img src="images/naath-gift-cart.jpg" alt="" /></div>
				<div class="giftCartfr">
<form name='chk_balance_ofgiftcard' action='giftcard-balance.php' method='post' >
					<div class="entergiftcartno">Enter the giftcard code to check you balance.</div>
					<div class="requiredField">* Indicates required fields</div>
					<div class="cartlabletext">Gift Card # <span>*</span></div>
					<div class="cartlablefield"><input name="gift_card_code" type="text" value="" size="" class="cartinputbox" /></div>
					<div class="clear"></div>
					<div class="cartlabletext">&nbsp;</div>
					<div class="cartlablefield">
                                <input type='hidden' value='1' name='chk_bal_gift'>
                           <!--<input type='submit' value='Post' name='post'> -->
<input type="image" src="images/check-balance-btn.jpg" alt="" border="0" vspace="12" />
                 </div>
<div class="cartlabletext">&nbsp;</div>
					<div class="cartlablefield"  style='font-size:12px;color:#875c32;font-family:arial;text-align:left;' >
                        
{if $smarty.session.sess_balance_left_gift!=''}
                          Yours current balance is  <b>{$smarty.session.sess_balance_left_gift}&nbsp;USD</b>
{/if}
                 </div>
{if $smarty.session.sess_balance_left_gift!=''}
<div class="cartlablefield"  style='font-size:12px;color:#875c32;font-family:arial;text-align:left;border:0px solid red;' >
                          Seller's Name is  <b>{$smarty.session.sess_sellers_name}&nbsp;</b><br>
 Seller's Username is  <b>{$smarty.session.sess_username}&nbsp;</b>
                 </div>
{/if}

</form>					<div class="clear"></div>
			    </div>
				<div class="clear"></div>
			</div>
		</div>
          
		<!--End Middle-->
{include file="footer.tpl"}