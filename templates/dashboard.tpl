{include file="header.tpl"}
{include file="js_css_validation.tpl"}
{include file="header_search.tpl"}
		<!--End Logo-->
		<!--Start Middle-->
		<div id="middleMain">
			{include file="left_category.tpl"}
			<div id="middleRtMain">
				<div class="shopmain">
				<span class="mainHD" >Dashboard</span>
					<!--Start inside part -->
					<div class="deshboardmmian">

					<div class="deshinhd">My Account Summary </div>
						<div class="deshimgmin">
							<div class="deshimgfl"><a href="#" class="imgbox"><img src="images/my-mass-icon.jpg" alt=""  border="0" /></a></div>
							<div class="deshimgfrtext"><a href="#">View My Messages</a></div>
							<div class="clear"></div>
						</div>
						<!--<div class="deshimgmin">
							<div class="deshimgfl"><a href="#" class="imgbox"><img src="images/view_outstanding_icon.jpg" alt=""  border="0" /></a></div>
							<div class="deshimgfrtext"><a href="#">View Outstanding Payments</a></div>
							<div class="clear"></div>
						</div>
						-->
						<div class="deshimgmin">
							<div class="deshimgfl"><a href="#" class="imgbox"><img src="images/edit_acc_icon.jpg" alt=""  border="0" /></a></div>
							<div class="deshimgfrtext"><a href="my_account_detail.php">My Account Details</a></div>
							<div class="clear"></div>
						</div>
						<div class="deshimgmin">
							<div class="deshimgfl"><a href="#" class="imgbox"><img src="images/feed_back_icon.jpg" alt=""  border="0" /></a></div>
							<div class="deshimgfrtext"><a href="#">Leave Feedback</a></div>
							<div class="clear"></div>
						</div>
						<div class="deshimgmin">
							<div class="deshimgfl"><a href="#" class="imgbox"><img src="images/view_feed_back_icon.jpg" alt=""  border="0" /></a></div>
							<div class="deshimgfrtext"><a href="#">View Feedback</a></div>
							<div class="clear"></div>
						</div>
					<div class="clear"></div>
					{if $smarty.session.session_user_type==3}
						<div class="deshinhd">My Seller Account</div>
							<div class="deshimgmin">
								<div class="deshimgfl"><a href="{$baseUrl}sell-an-item.php" class="imgbox"><img src="images/sell_item_icon.jpg" alt="" border="0"  /></a></div>
								<div class="deshimgfrtext"><a href="{$baseUrl}sell-an-item.php">Sell My Item</a></div>
								<div class="clear"></div>
						</div>
						<div class="deshimgmin">
							<div class="deshimgfl"><a href="#" class="imgbox"><img src="images/my_sold_icon.jpg" alt="" border="0" /></a></div>
							<div class="deshimgfrtext"><a href="#">My Sold Items</a></div>
							<div class="clear"></div>
						</div>
						<!--
						<div class="deshimgmin">
							<div class="deshimgfl"><a href="#" class="imgbox"><img src="images/detail_icon.jpg" alt="" border="0" /></a></div>
							<div class="deshimgfrtext"><a href="#">View Winner Detials</a></div>
							<div class="clear"></div>
						</div>
						<div class="deshimgmin">
							<div class="deshimgfl"><a href="#" class="imgbox"><img src="images/email_icon.jpg" alt="" /></a></div>
							<div class="deshimgfrtext"><a href="#">Items Notification E-mails</a></div>
							<div class="clear"></div>
						</div>
						-->
						<div class="deshimgmin">
							<div class="deshimgfl"><a href="#" class="imgbox"><img src="images/my_active_icon.jpg" alt=""  border="0" /></a></div>
							<div class="deshimgfrtext"><a href="#">My Active Items</a></div>
							<div class="clear"></div>
						</div>
						<div class="deshimgmin">
							<div class="deshimgfl"><a href="#" class="imgbox"><img src="images/my-panding_icon.jpg" alt="" border="0" /></a></div>
							<div class="deshimgfrtext"><a href="#">My Pending Items</a></div>
							<div class="clear"></div>
						</div>
						<div class="clear"></div>
						<div class="deshimgmin">
							<div class="deshimgfl"><a href="#" class="imgbox"><img src="images/my_close_icon.jpg" alt="" border="0" /></a></div>
							<div class="deshimgfrtext"><a href="#">My Closed Items</a></div>
							<div class="clear"></div>
						</div>
						<div class="deshimgmin">
							<div class="deshimgfl"><a href="#" class="imgbox"><img src="images/sespended_icon.jpg" alt="" border="0" /></a></div>
							<div class="deshimgfrtext"><a href="#">My Suspended Items</a></div>
							<div class="clear"></div>
						</div>
						<div class="deshimgmin">
							<div class="deshimgfl"><a href="items_list.php" class="imgbox"><img src="images/my_active_icon.jpg" alt=""  border="0" /></a></div>
							<div class="deshimgfrtext"><a href="items_list.php">My Items List</a></div>
							<div class="clear"></div>
						</div>
						<div class="deshimgmin">
							<div class="deshimgfl">&nbsp;
							</div>
							<div class="deshimgfrtext">&nbsp;</div>
							<div class="clear"></div>
						</div>
						<div class="deshimgmin">
							<div class="deshimgfl">&nbsp;
							</div>
							<div class="deshimgfrtext">&nbsp;</div>
							<div class="clear"></div>
						</div>
						<div class="deshimgmin">
							<div class="deshimgfl">&nbsp;</div>
							<div class="deshimgfrtext">&nbsp;</div>
							<div class="clear"></div>
						</div>
					<div class="clear"></div>
					{/if}

					{if $smarty.session.session_user_type==4}
					<div class="deshinhd">My Buyer Account</div>
						<div class="deshimgmin">
							<div class="deshimgfl"><a href="#" class="imgbox"><img src="images/watching_icon.jpg" alt="" border="0" /></a></div>
							<div class="deshimgfrtext"><a href="#">My Favorite (Items)</a></div>
							<div class="clear"></div>
						</div>
						<div class="deshimgmin">
							<div class="deshimgfl"><a href="#" class="imgbox"><img src="images/place_bide_icon.jpg" alt="" border="0" /></a></div>
							<div class="deshimgfrtext"><a href="#">My Placed Bids</a></div>
							<div class="clear"></div>
						</div>
						<div class="deshimgmin">
							<div class="deshimgfl"><a href="#" class="imgbox"><img src="images/buyer_icon.jpg" alt="" border="0" /></a></div>
							<div class="deshimgfrtext"><a href="#">My Buyer History</a></div>
							<div class="clear"></div>
						</div>
						<!--
						<div class="deshimgmin">
							<div class="deshimgfl"><a href="#" class="imgbox"><img src="images/action_watch_icon.jpg" alt="" border="0" /></a></div>
							<div class="deshimgfrtext"><a href="#">My Auction Watch</a></div>
							<div class="clear"></div>
						</div>
						-->
					<div class="clear"></div>
					{/if}
					</div>	
					<!--End inside part -->
				</div>
				
			</div>
			<div class="clear"></div>
		</div>
		<!--End Middle-->
{include file="footer.tpl"}