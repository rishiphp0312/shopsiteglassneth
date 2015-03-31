<table width="200" border="0" cellpadding="0" cellspacing="0" style="margin-top:10px">
	<tr>
		<td height="25" align="left" style="width:188px; padding-left:10px" class="bar">
			<a href="javascript:ddtreemenu.flatten('treemenu1', 'expand')">Open All</a> | <a href="javascript:ddtreemenu.flatten('treemenu1', 'contact')">Close All</a>
		</td>
	</tr>
	<tr>
		<td height="10" align="left" valign="top" bgcolor="#FFFFFF"></td>
	</tr>
	<tr>
		<td align="left" valign="top" bgcolor="#FFFFFF" style="width:188px; padding-left:10px;padding-top:10px" class="border">
			<ul id="treemenu1" class="treeview" style="margin-left:0; padding-left:0">

				<li><font class="subheading">Main Setting</font>
					<ul>
						<li><a href="admin_home.php" class="set_links">Admin Home</a></li>
						<li><a href="admin_account.php" class="set_links">Admin Account</a></li>
						<li><a href="add_payment.php" class="set_links">Payment Configuration</a></li>
						<li><a href="admin_change_password.php" class="set_links">Change Password</a></li>
						<li><a href="admin_set_quantity_listing.php" class="subheading">Paid Listing Items Cost & Quantity</a></li>
						<li><a href="admin_add_style.php" class="subheading">Add Style</a></li>
						<li><a href="view_style.php" class="subheading">View Style</a></li>


						<li><a href="admin_logout.php" class="set_links">Logout</a></li>

					</ul>
				</li>
				<li><font class="subheading">Manage Subscription Slabs</font>
					<ul>
						<li><a href="admin_view_slabs.php" class="subheading">View Slabs</a></li>
						<li><a href="admin_add_slabs.php" class="subheading">Add/Edit Slabs</a></li>

				       </ul>
                              </li>
                                <li><font class="subheading">Reports</font>
					<ul>
						<li><a href="admin_reports_sold_products.php" class="subheading">Manage Sold Products Reports</a></li>
						<li><a href="admin_approve_store.php" class="set_links">Manage Store</a></li>
						<li><a href="show_shipping_values.php" class="set_links">Shipping Details</a></li>
						<li><a href="admin_reports_not_updatedproducts.php" class="subheading">Manage Not Updated Products Reports</a></li>

					</ul>
				</li>
				<li><font class="subheading">Category Management</font>
					<ul>
						<li><a href="admin_category.php" class="subheading">Manage Categories</a></li>
						<li><a href="admin_add_category.php" class="subheading">Add Category</a></li>
					</ul>
				</li>
				<li><font class="subheading">Ticketing Management</font>
					<ul>
						<li><a href="admin_view_tickets.php" class="subheading">View Tickets</a></li>

					</ul>
				</li>
					<li><font class="subheading">Member Management</font>
					<ul>
						<li><a href="admin_add_users.php" class="set_links">Add Member</a></li>
						<li><a href="admin_users.php" class="set_links">Manage Members</a></li>
						<li><a href="admin_send_bulk_mail.php" class="set_links">Send Email Notification</a></li>
					</ul>
				</li>



                               <li><font class="subheading">Product Management</font>
					<ul>
						<li><a href="admin_products_listing.php" class="subheading">Manage Products</a></li>



						<li><a href="admin_handpicked_listing.php" class="set_links">Manage Handpicked Items</a></li>
					</ul>

				</li>

				<!--<li><font class="subheading">Product Management</font>
					<ul>
						<li><a href="admin_products_listing.php" class="subheading">Manage Products</a></li>

						<li><a href="admin_approve_store.php" class="set_links">Manage Store</a></li>
						<li><a href="admin_handpicked_listing.php" class="set_links">Manage Handpicked</a></li>
					</ul>

				</li>-->
				<li><font class="subheading">Content Management</font>
					<ul>
						<li><a href="add_cms.php" class="subheading">Add Static Pages</a></li>
						<li><a href="admin_cms.php" class="subheading">Manage Static Pages</a></li>
					</ul>
				</li>
				<li><font class="subheading">Tutorial Management</font>
					<ul>

						<li><a href="add_tutorial.php" class="subheading">Manage Tutotial</a></li>
					</ul>
				</li>
				<!--
				<li><font class="subheading">Home Page Sections</font>
					<ul>
						<li><a href="#" class="subheading">Featured Store</a></li>
						<li><a href="#" class="subheading">Hand Picked Items</a></li>
					</ul>
				</li>
				-->
				<li><font class="subheading">Manage News Letter</font>
					<ul>
						<li><a href="admin_news_letter.php" class="subheading">Subscribed Users</a></li>
						<li><a href="admin_send_news_letter.php" class="subheading">Send News Letter</a></li>
					</ul>
				</li>
				<li><font class="subheading">Manage Gift Cards</font>
					<ul>
						<!--<li><a href="add_giftcard.php" class="subheading">Create Gift Card </a></li>-->
						<li><a href="admin_gift_card.php" class="subheading">View Gift Card Purchase History</a></li>
					</ul>
				</li>
				<li><font class="subheading">Blog Management</font>
					<ul>
						<li><a href="{$baseUrl}/blog/wp-login.php" class="subheading">Manage Blog</a></li>
					</ul>
				</li>

			</ul>
			<script type="text/javascript">
			//ddtreemenu.createTree(treeid, enablepersist, opt_persist_in_days (default is 1))
			ddtreemenu.createTree("treemenu1", true);
			</script>
		</td>
	</tr>
</table>