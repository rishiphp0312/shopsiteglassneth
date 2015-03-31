<?php /* Smarty version 2.6.18, created on 2012-02-28 11:12:10
         compiled from admin_left_link.tpl */ ?>
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
						<li><a href="admin_change_password.php" class="set_links">Change Password</a></li>
						<li><a href="admin_view_seo.php" class="set_links">Meta Tags</a></li>
<li><a href="admin_logout.php" class="set_links">Logout</a></li>
					</ul>
				</li>
				  <li><font class="subheading">Manage Mail Content</font>
					<ul>
					
						<li><a href="view_mail_listing.php" class="set_links">Mail Content Listing</a></li>
					</ul>
				</li>
				
		
		
	
				   <li><font class="subheading">Manage Excel/Csv  Files</font>
					<ul>
						<li>
		<a href="admin_upload_excel.php" class="set_links">Upload Excel or Csv</a>          </li>
					<li><a href="admin_upload_images.php" class="set_links">Upload Images</a></li>
					</ul>
				</li>
				<li><font class="subheading">Payment Configuration</font>
					<ul>
						<li><a href="add_payment.php" class="set_links">Account Configuration</a></li>
						<!--<li><a href="admin_set_quantity_listing.php" class="set_links">Paid Listing Items Cost & Quantity</a></li>
					--></ul>
				</li>
                               <li><font class="subheading">Manage Item Style</font>
					<ul>
						<li><a href="admin_add_style.php" class="set_links">Add New Style</a></li>
						<li><a href="view_style.php" class="set_links">Manage Style</a></li>
					</ul>
				</li>
				<li><font class="subheading">Payment Configuration</font>
					<ul>
						<li><a href="add_payment.php" class="set_links">Account Configuration</a></li>
						<!--<li><a href="admin_set_quantity_listing.php" class="set_links">Paid Listing Items Cost & Quantity</a></li>
					--></ul>
				</li>
				<li><font class="subheading">Category Management</font>
					<ul>
						<li><a href="admin_category.php" class="set_links">Manage Categories</a></li>
						<li><a href="admin_add_category.php" class="set_links">Add Category</a></li>
					</ul>
				</li>
				<li><font class="subheading">Ticket Management</font>
					<ul>
						<li><a href="admin_view_tickets.php" class="set_links">View Tickets</a></li>
					</ul>
				</li>
				<li><font class="subheading">Content Management</font>
					<ul>
						<li><a href="add_cms.php" class="set_links">Add Static Pages</a></li>
						<li><a href="admin_cms.php" class="set_links">Manage Static Pages</a></li>						
					</ul>
				</li>
				<li><font class="subheading">Member Management</font>
					<ul>
						<li><a href="admin_add_users.php" class="set_links">Add Member</a></li>
						<li><a href="admin_users.php" class="set_links">Manage Members</a></li>
						<li><a href="admin_approve_store.php" class="set_links">Manage Sellers/Stores</a></li>
						<li><a href="admin_send_bulk_mail.php" class="set_links">Send Email Notification</a></li>
					</ul>
				</li>
			    <li><font class="subheading">Product Management</font>
					<ul>
						<li><a href="admin_products_listing.php" class="set_links">Manage Products</a></li>
						<li><a href="admin_handpicked_listing.php" class="set_links">Manage Handpicked Items</a></li>
					</ul>
				</li>
			    <li><font class="subheading">Tutorial Management</font>

<ul>
						<li><a href="admin_tutorials.php" class="set_links">View Tutorials</a></li>
					
						<li><a href="admin_add_tutorial.php" class="set_links">Add/Edit Tutotial</a></li>
					</ul>
				</li>
                                  
				<li><font class="subheading">Manage News Letter</font>
					<ul>
						<li><a href="admin_news_letter.php" class="set_links">Subscribed Users</a></li>
						<li><a href="admin_send_news_letter.php" class="set_links">Send News Letter</a></li>				
						
						<li><a href="admin_send_news_letter_withitems.php" class="set_links">Send News Letter with Items</a></li>					
					</ul>
				</li>
				<li><font class="subheading">Manage Gift Cards</font>
					<ul>
						<!--<li><a href="add_giftcard.php" class="set_links">Create Gift Card </a></li>-->
						<li><a href="admin_gift_card.php" class="set_links">Gift Card Purchase History</a></li>						
					</ul>
				</li>
				<li><font class="subheading">Blog Management</font>
					<ul>
						<li><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
/blog/wp-login.php" class="set_links">Manage Blog</a></li>
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
						<li><a href="admin_reports_sold_products.php" class="set_links">Sold Products</a></li>
						<li><a href="show_shipping_values.php" class="set_links">Shipping Details</a></li>
						<li><a href="admin_reports_not_updatedproducts.php" class="set_links">Products Not Updated</a></li>
<li><a href="admin_item_commision_listing.php" class="set_links">Commision on Sold Products </a></li>
<li><a href="admin_reports_purchased_packages.php" class="set_links">Purchased Packages </a></li>
<li><a href="admin_report_items.php" class="set_links">Reported Items </a></li>

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