{include file="admin_top.tpl"}

<table width="100%"  border="0" cellspacing="10" cellpadding="5">
	<tr>
	  <td valign="middle" class="bar">{$form_heading}</td>
	</tr>
	 
	
		  <!--<tr class="c1">
			<td bgcolor="#FFFFFF">Not Updated</td>
			<td width="19%" bgcolor="#FFFFFF"><select name="not_updated" id="not_updated">
			<option value="0">--Select--</option>
			<option value="3" {if $not_updated==3}selected{/if} >Last 3 Months</option>
			<option value="6" {if $not_updated==6}selected{/if}>Last 6 Months</option>
			<option value="12" {if $not_updated==12}selected{/if}>Last 12 Months</option>
			</select></td>
			<td bgcolor="#FFFFFF"></td>
			<td bgcolor="#FFFFFF"  nowrap>
		<input type="radio" name="status" value="1" {$chkActive}> Approved 
			<input type="radio" name="status" value="2" {$chkInActive}> Suspend <input type="radio" 
			name="status" value="12" {$chkBoth}> All</td>
			<td bgcolor="#FFFFFF">
			<input name="form_member_search" type="submit" id="form_member_search" class="button" 
			value="Search" />
			&nbsp; <input type="button" class="button" name="reset" 
			value="Clear Search" onClick="window.location='admin_reports_not_updatedproducts.php';" /></td>
		  </tr>-->
	
	
	<tr>
	<td align="right">

	<!--<input type="button" name="mail_all_users" value="Send Notification Email" class="button" onclick="window.location='admin_send_bulk_mail.php';" />
	 {if $usersList}
	 <input type="button" name="btnExport" value="Export Users" class="button" onclick="window.location='admin_export_users.php?{$smarty.server.QUERY_STRING}';" />
	{/if}
	</td> -->
	</tr>	
	<tr>
	  <td align="left" valign="top" class="border1">
      <table width="100%" cellpadding="4" cellspacing="2" align="center">
       {if $total_MailTemplates!='0'}
		<tr class="listHeadRow">
		                         <td>S. No.</td>
                                 <td>Subject</td>
		                         <td>Description</td>
								 <td>&nbsp;</td>
		                        
		                       <!--<td>Status</td>-->
        </tr>
	{foreach name=prods from=$mail_fetchcontent item=prod}
		
	  {if $prod.mail_subject!='Email Template'}		 
		
		<tr bgcolor="{cycle values='#f5f5f5,#e6e6e6'}">
          <td>
		  {$smarty.foreach.prods.iteration}.
		  </td>
          <td align="left" valign="top">
		  {$prod.mail_subject}	
		  </td>
		   <td align="left" valign="top">
		  {if $prod.mail_title=='Contact US'}Contact US {/if}	
		  {if $prod.mail_title=='Forgot Password'}When user Forget Password {/if}	
		  {if $prod.mail_title=='Admin Forgot Password'}When Admin Forget Password {/if}	
		  {if $prod.mail_title=='Registration'}When new user registers {/if}	
	      {if $prod.mail_title=='News Letter'}Newsletter without items{/if}	
		  {if $prod.mail_title=='Share and Email Item'}Forward items to other users.{/if}	
		  {if $prod.mail_title=='Inventory Notify'}Inventory Notification.{/if}	
		  {if $prod.mail_title=='Send Coupon'}Sending Coupon.{/if}	
		  {if $prod.mail_title=='Gift Card'}Sending Gift Card.{/if}	
		  {if $prod.mail_title=='Contact Seller'}Contact Seller.{/if}
		  {if $prod.mail_title=='Aniversay_Reminder_Giftcard'}Giftcard sent in Reminder Module.{/if}		
		  {if $prod.mail_title=='Auto_Email_Reminder'}Auto Email for Upcoming Events or reminders{/if}		
		  {if $prod.mail_title=='Auto_Email_Message'}Auto Email for Sending Messages {/if}			
		  {if $prod.mail_title=='shipped_by_seller'}When item is successfully shipped.{/if}	
		  {if $prod.mail_title=='Aniversay_Reminder'}Message on reminder.{/if}	
		  {if $prod.mail_title=='Send Ticket'}New Ticket is requested  .{/if}	
		  {if $prod.mail_title=='Send Reply'}Repy to Ticket Id.{/if}	
		  {if $prod.mail_title=='Send Reply Contact'}Unregisterd user when sends request or generate new ticket to admin on contact us page.{/if}
		  {if $prod.mail_title=='Haating_last'}Haating quote left by user in end.{/if}		
		  {if $prod.mail_title=='Haating_accepted'}When haating quote accepted by seller.{/if}		
		  {if $prod.mail_title=='invoice_commision_seller'}Auto Invoice of Commision on Sold Items. {/if}		
		  {if $prod.mail_title=='Auto_Email_Package_expiry_bfr15'}Email notification for package expiry.{/if}	
		   {if $prod.mail_title=='Purchased_package'}Email Notification on Purchasing package .{/if}			
		   {if $prod.mail_title=='Gift_Card_seller'}Email Notification on purchase of gift card. {/if}			
		   {if $prod.mail_title=='Custom_item_created'}Email Notification on creating custom item. {/if}		
		   {if $prod.mail_title=='Purchased_product_buyer'}Email Notification to buyer on product purchase. {/if}	
		    {if $prod.mail_title=='Purchased_product_seller'}Email Notification to seller on product purchase. {/if}		
			  {if $prod.mail_title=='News_Letterwith_items'}NewsLetter with items images. {/if}			
		    
			 
		    
		  
		   
		  
		  
		  
			
			<!--//Notification: Nethaat -->
		  </td>
		  <td align="left" valign="top">
		  <a href="{$baseUrl}admin/admin_edit_emailcontent.php?edit_id={$prod.mail_id}	">	<img src="../{$baseUrl}/images/edit_icon.png" alt="Edit" border="0" /></a>&nbsp;
		  <!--<a href="javascript: void(0);" title="Delete" style="text-decoration:none;"
			   onclick="confirm_msg({$prod.style_id},{1});">
			  	<img src="../{$baseUrl}/images/dlt_icon.png" alt="Delete" border="0" /></a>
		  -->
		 </td>

	    </tr>
		{/if}
	{/foreach}
        <tr>
			<td colspan="6">
			<div style="float:left;">{$page_counter}  </div>
			 {if $pageLink}
			<div class="admn_pagination_msg_board">
			<span style="float:right;">{$pageLink}</span>			</div>
			 {/if}			</td>
        </tr>
		{else}
		
		<tr><td colspan="6"><div class="no_record_found">No record found...!</div></td></tr>
	
		{/if}
      </table>
</td>
	</tr>
</table>	  
{include file="admin_bottom.tpl"} 