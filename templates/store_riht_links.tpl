<!--Start right part -->
<div class="itemDetialfrmain">
	<div class="rightbox">
		<div class="rightboxhd">	{if $username!=''}{$username}{else}N/A{/if} Shop home info </div>
		<div class="whiteinsidebox">
			<div class="frboxinhd"><strong>{if $username!=''}{*$username*}{else}{*N/A*}{/if}</strong></div>
			<div class="rightimgbox"><a href="featured_store_information.php?id={$sellerid}"><img src="{$baseUrl}getthumb.php?w=105&h=130&fromfile=uploads/{$username}{if $sel_logo_status==2}/store_logos/{$store_logo}{else}/banners/{$banner_name}{/if}" onerror="this.src='{$baseUrl}images/item_small_img.jpg'; this.style.width='100px'; this.style.height='100px';" alt="" border="0" style="border:0px;" /></a></div>
			<div class="rightimgboxtext">
				<div>&nbsp;</div>
			</div>
			<div class="rightimgboxtext">
				<div><strong><br />
			
				</strong></div>
			</div>
			<div class="clear"></div>
			<div class="ratinglble">Rating :</div>
			<div class="ratinglblefr">{if $find_percentage!=''}<a href='viewfeedback.php?rating_seller_id={$sellerid}'>{$find_percentage}%</a>{else}0%{/if}</div>
			<div class="clear"></div>
			<div class="ratinglble">Opened on :</div>
			<div class="ratinglblefr">{if $reg_date!=''}{$reg_date|date_format}{else}N/A{/if}</div>
			<div class="clear"></div>
			<div class="ratinglble">Location :</div>
			<div class="ratinglblefr">{if $user_country_name!=''}{$user_country_name}{else}NA{/if}</div>
			<div class="clear"></div>
		</div>
	</div>
	<div class="rightbox">
		<div class="rightboxhd">{$username}</div>
		<div class="whiteinsidebox">
			<div class="quickLinkbox"><a href="contact_seller.php"><img src="{$baseUrl}images/my_email_icon.jpg" alt="" class="vAlign" /><b>Contact us</b> </a></div>
				<div class="quickLinkbox"><a href="shoppolicy_seller.php"><img src="{$baseUrl}images/my_shop_icon.jpg" alt="" class="vAlign" /><b> Shop Policies</b></a></div>
<div class="quickLinkbox"><a href="lockerform.php"><img src="{$baseUrl}images/locar_are_icon.jpg" alt="" class="vAlign" /><b> Locker Area</b></a></div>
		
			<div class="quickLinkbox"><a href="request_custom_item.php?id={$smarty.session.session_user_id}"><img src="{$baseUrl}images/my_work_shop_icon.jpg" alt="" class="vAlign" /><b> My Workshop(Custom Order)</b></a></div>
			<div class="quickLinkbox"><a href="giftcard.php?id={$smarty.session.session_user_id}"><img src="{$baseUrl}images/purches_gift_icon.jpg" alt="" class="vAlign" /><b> Purchase *Shops* Giftcard </b></a></div>
		</div>
	</div>	
</div>
<!--End right part -->