{include file="header.tpl"}
{include file="js_css_validation.tpl"}
{include file="header_search.tpl"}
		<!--End Logo-->
		<!--Start Middle-->
		<div id="middleMain">
			
				
		{include file="left_category.tpl"}
		
	
<!--Start Middle-->

	<div id="middleRtMain">
		<div class="shopmain">
		<div style='width:140px;float:left;'>
		<span class="mainHD">Shop Policies</span>
		</div>
		<div style='width:550px;float:right;text-align:left;'>
<a href="{$baseURL}shoppolicy_seller.php?&sellerid={$smarty.session.session_user_id}">Click here</a> to see how your public Shop Policies page looks.
		<span style='padding-left:45px;text-align:right;'><a href='#my_account.php' onclick='history.go(-1)'>Go Back</a></span></div><br /><br />
			<!--Start inside part -->

			<form action="shop-policies.php" method="post" >
			<div class="sellItemmian">
		<!--	You may provide shop policies to help your customers make a more informed purchase. Etsy encourages all sellers to post shop policies. Before writing your own policies, be sure to familiarize yourself with Etsy's policies: The DOs and DON'Ts and Terms of Use. Your shop policies must not contradict Etsy's site-wide policies.
				<br />
				<br />
				We have listed examples of common policy considerations for each category below. For ideas on writing shop policies, see this Storque article.
				<br />
				<br />-->
				<div class="sellLabletext">
					<span>Welcome</span>
					<br />
						<span class='classsmallTiTleTXT'>Welcome note for buyers and information about the store, yourself.</span>
				</div>
				<div class="selllablefield">
					<textarea name="welcome" cols="" rows="" class="textfield"> {$v_welcome}</textarea>
				</div>
			  <div class="sellLabletext">
					<span>Payment</span><br />
				  <span class='classsmallTiTleTXT'>Payment process, terms, cancellation policy paypal, others.</span>				</div>
				<div class="selllablefield">
					<textarea name="payment" cols="" rows="" class="textfield" >{$v_payment} </textarea>
				</div>		
				<div class="sellLabletext">
					<span>Shipping</span><br />
						<span class='classsmallTiTleTXT'> Methods, Insurance, International customs terms.</span>
				</div>
				<div class="selllablefield">
					<textarea name="shipping" cols="" rows="" class="textfield" > {$v_shipping}</textarea>
				</div>	
				<div class="sellLabletext">
					<span>Refunds and Exchanges</span><br />
				<span class='classsmallTiTleTXT'>Put your store terms of refund and exchange.</span>

				<!--<span class='classsmallTiTleTXT'> Terms, eligible items, damages, losses, etc.</span>--></div>
				<div class="selllablefield">
					<textarea name="refund" cols="" rows="" class="textfield" > {$v_refund_exchange}</textarea>
				</div>	
				<div class="sellLabletext">
					<span>Additional Information</span><br />
					<span class='classsmallTiTleTXT'>Packing, Custom orders, Wholesale, Guarantees.</span>
					<!--<span class='classsmallTiTleTXT'> Additional policies, FAQs, Alchemy &amp; custom orders, wholesale &amp; consignment, guarantees, etc.</span>--></div>
				<div class="selllablefield">
					<textarea name="additional" cols="" rows="" class="textfield" > {$v_additional_info}</textarea>
				</div>	
				<div>
					<input type="hidden" name="hid">
					<input type='image'  src="images/submit_btn.jpg" alt="" border="0" vspace="5" />
				</div>
			</div>	
			</form>
			<!--End inside part -->
		</div>
		
	</div>
	<div class="clear"></div>
</div>
<!--End Middle-->

{include file="footer.tpl"}