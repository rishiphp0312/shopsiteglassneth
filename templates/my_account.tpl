{include file="header.tpl"}
{*include file="js_css_validation.tpl"*}
{*include file="header_search.tpl"*}


<script language="javascript" type="text/javascript">
{literal}

function show_accountsb(NUM,ACC)
{
//alert('cxc');
if(NUM==2 && ACC== 'b')
{
createCookie('cook_baby','c',0);
document.getElementById('a_showb').style.display='';
document.getElementById('a_hideb').style.display='none';
document.getElementById('div_buyer_acc1').style.display='none';
}
else
{
//alert('dsd');
document.getElementById('a_showb').style.display='none';
document.getElementById('a_hideb').style.display='';
document.getElementById('div_buyer_acc1').style.display='';
createCookie('cook_baby','b',2);
}

}
function show_accounts(NUM,ACC)
{

if(NUM==1 && ACC== 's')
{createCookie('cook_babys','s',2);

document.getElementById('a_shows').style.display='none';
document.getElementById('a_hides').style.display='';
document.getElementById('div_seller_acc1').style.display='';
document.getElementById('div_seller_acc2').style.display='';
document.getElementById('div_seller_acc3').style.display='';
document.getElementById('div_seller_acc4').style.display='';
document.getElementById('div_seller_acc5454').style.display='';

//document.getElementById('div_seller_acc1').innerHTML='';
//document.getElementById('div_buyer_acc1').style.display='none';
//document.getElementById('div_seller_acc1').style.height='0px;';

}
else {
createCookie('cook_babys','c',0);
document.getElementById('a_shows').style.display='';
document.getElementById('a_hides').style.display='none';
document.getElementById('div_seller_acc1').style.display='none';
document.getElementById('div_seller_acc2').style.display='none';
document.getElementById('div_seller_acc3').style.display='none';
document.getElementById('div_seller_acc4').style.display='none';
document.getElementById('div_seller_acc5454').style.display='none';
}

}
function check_item_bforeadd(pkg_status,items_avail,max_items)
{
     if(max_items==100)
      {
      var str_pkg_name ="You cannot upload the new items further since your existing Master package allow 100 items space only.To continue uploading new item ,either remove items from my item list to create the space or upgrade to Master pro  from your purchase package module in your account. ";

      }
      if(max_items==500)
      {
    var str_pkg_name ="You cannot upload the new items further since your existing Pro Master package allows 500 items space only.To continue uploading new item , either remove items from my item list to create the space or contact admin@nethaat.com for further assistance.";

      }
       //alert('xx'+pkg_status+','+items_avail+','+max_items);
   if(pkg_status==0 && items_avail>=25)
   {
   alert('Please purchase package to add more items!!');
   window.location = 'purchase_package.php';
   return false;
    }
  else if(pkg_status==1 && items_avail>=max_items )
   {
   alert(str_pkg_name);
   window.location = 'purchase_package.php';
   return false;
    }
  else
   {
    window.location = 'sell-an-item.php';
    return true;
   }
}
{/literal}
</script>

<!--num_rows_items_available-->
		<!--End Logo-->
		<!--Start Middle-->
		<div id="middleMain">
			{include file="left_category.tpl"}
			<div id="middleRtMain">
			{if $item_name_exsist >0  }
			<div class="shopmain" style='font-size:12px;color:red;' >Please update the available quantity of these  items : <span style='color:#000000;'>{$item_name_comma}.</span><a href='items_list.php'>Click here to update quantity.</a>
			</div>
			{/if}
			{if $num_inbox>0}
			<div class="shopmain" style='font-size:12px;color:red;' >
			<!--<div style='font-size:12px;color:red;width:200px;float:left;'>-->
			<img src="images/icons/inbox-myaccount.GIF" />&nbsp;<a href="message.php">( {$num_inbox} New mails. )</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			{if $SubscribedUsers==0}
			<!--<a href='my_account.php?subuser=1'>Enable </a>Click here to enable  Newsletter Status.-->
			{else}
			<!--<a href='my_account.php?subuser=0'>Disable </a>Click here to disable  Newsletter Status.-->
			{/if}
			
			<!--</div>-->
			<!--
			<div style='font-size:12px;color:red;width:400px;float:right;'>xcxk
			</div>
			-->
			</div>
			{/if}
				<div class="shopmain">
<!--Start inside part -->
				<div class="deshboardmmian">
                                <div class="acSection" style='border:0px solid red;background-color:#cccccc;' >
				  <div class="commonhd" style='border:0px solid red;width:200px;'>My Account Summary</div>
		
                                        <div class="commonSec">
						<div class="deshimgmin" >
							<div class="deshimgfl"><a href="message.php" class="imgbox"><img src="images/icons/view_my_message.jpg" alt=""  border="0" /></a></div>
							<div class="deshimgfrtext"><a href="message.php">View My Messages</a></div>
							<div class="clear"></div>
						</div>
						
						
					 {* if $smarty.session.session_user_type!=3*} <!-- for buyer-->
						<div class="deshimgmin" style='background-color:#eeeeee;'>
							<div class="deshimgfl"><a href="view_reminders.php" class="imgbox"><img src="images/icons/view-add_reminders.jpg" alt=""  border="0" /></a></div>
							<div class="deshimgfrtext"><a href="view_reminders.php">View/ADD Reminders</a></div>
							<div class="clear"></div>
						</div>
						{*/if*}
						<div class="deshimgmin" style='background-color:#eeeeee;'>
							<div class="deshimgfl"><a href="my_account_detail.php" class="imgbox"><img src="images/icons/my_account_detail.jpg" alt=""  border="0" /></a></div>
							<div class="deshimgfrtext"><a href="my_account_detail.php">My Account Details</a></div>
							<div class="clear"></div>
						</div>
						 {* if $smarty.session.session_user_type!=3*} <!-- // for buyer -->
						<div class="deshimgmin" style='background-color:#eeeeee;'>
							<div class="deshimgfl"><a href="buyer_leave_item_feedback.php" class="imgbox"><img src="images/icons/leave_feedback.jpg" alt=""  border="0" /></a></div>
							<div class="deshimgfrtext">
							<a href="buyer_leave_item_feedback.php">Leave Feedback</a></div>
							<div class="clear"></div>
						</div>
                             <div class="clear"></div>
						{*/if*}
						<!--<div class="deshimgmin">
							<div class="deshimgfl"><a href="#" class="imgbox"><img src="images/view_feed_back_icon.jpg" alt=""  border="0" /></a></div>
							<div class="deshimgfrtext"><a href="#">View Feedback</a></div>
							<div class="clear"></div>
						</div>-->
						<div class="deshimgmin">
							<div class="deshimgfl"><a href="viewfeedback.php" class="imgbox"><img src="images/icons/view_feedback.jpg" alt=""  border="0" /></a></div>
							<div class="deshimgfrtext"><a href="viewfeedback.php">View Feedback</a></div>
							<div class="clear"></div>
						</div>
						
                                              <div class="deshimgmin">
							<div class="deshimgfl"><a href="reminder_message_list.php" class="imgbox"><img src="images/icons/view_feedback.jpg" alt=""  border="0" /></a></div>
							<div class="deshimgfrtext"><a href="reminder_message_list.php">View /Edit Reminder's Message</a></div>
							<div class="clear"></div>
						</div>
						<div class="deshimgmin">
							<div class="deshimgfl"><a href="genrate_ticket.php" class="imgbox"><img src="images/icons/request_ticket.jpg" alt=""  border="0" /></a></div>
							<div class="deshimgfrtext"><a href="genrate_ticket.php">Request Ticket</a></div>
							<div class="clear"></div>
						</div>
						<div class="deshimgmin">
							<div class="deshimgfl"><a href="banner-manage.php" class="imgbox"><img src="images/icons/request_ticket.jpg" alt=""  border="0" /></a></div>
							<div class="deshimgfrtext"><a href="banner-manage.php">Manage Banner and Logo</a></div>
							<div class="clear"></div>
						</div>
						<!--<div class="deshimgmin">
							<div class="deshimgfl"><a href="compase_message.php" class="imgbox"><img src="images/icons/frnd-request.jpeg" alt=""  border="0" /></a></div>
							<div class="deshimgfrtext"><a href="compase_message.php">Pending Requests </a></div>
							<div class="clear"></div>
						</div>-->
					
					<div class="clear"></div>
				</div>
                               </div>
               <div id='seller_top'  style='padding-top:1px;'>&nbsp;&nbsp;</div>
                {*if $smarty.session.session_user_type==3*}<!-- for seller-->
       <div class="sellerhd" >My Seller's Account &nbsp;&nbsp;
		<span style="font-size:11px;">
		<a id='a_hides' onclick="return show_accounts('2','s')" {if $smarty.cookies.cook_babys=='s'}style="display:'';"{else}style="display:none;"{/if} href="#">Hide</a>&nbsp; <a id='a_shows' {if $smarty.cookies.cook_babys=='s'}style="display:none;"{else}style="display:'';"{/if}  onclick="return show_accounts('1','s')" href="#seller_top">Show</a></span>  </div>
                               <div class="acSection"  {if $smarty.cookies.cook_babys=='s'}style="border:0px solid green;height:200px;padding-top:1px;background-color:#fff6f0;display:'';"{else}  style='border:0px solid green;height:200px;padding-top:1px;background-color:#fff6f0;display:none;'{/if} id='div_seller_acc1'>
						
						<div class="sellerSec"   >
						<div class="deshimgmin">
	<div class="deshimgfl"><!--
<a href="javascript:// " onclick="return check_item_bforeadd({$num_rows_pacakage},{$num_rows_items_available},{$pkg_max_items});"   class="imgbox">-->

<a  href="{$baseUrl}sell-an-item.php" class="imgbox">

						<img src="images/icons/sell_my_item.jpg" alt="" border="0"  /></a></div>
						<div class="deshimgfrtext"><a href="{$baseUrl}sell-an-item.php">Sell My Item</a></div>
						<div class="clear"></div>
						</div>
				
				                <div class="deshimgmin">
						<div class="deshimgfl"><a href="seller_sold_item.php" class="imgbox"><img src="images/icons/my_sold_item.jpg" alt="" border="0" /></a></div>
						<div class="deshimgfrtext"><a href="seller_sold_item.php">My Sold Items</a></div>
						<div class="clear"></div>
						</div>
						
						
					        <div class="deshimgmin">
						<div class="deshimgfl"><a href="seller_active_items.php" class="imgbox"><img src="images/icons/my_active_items.jpg" alt=""  border="0" /></a></div>
						<div class="deshimgfrtext"><a href="seller_active_items.php">My Active Items</a></div>
						<div class="clear"></div>
					        </div>
                                                <div class="deshimgmin">
						<div class="deshimgfl"><a href="items_list.php" class="imgbox"><img src="images/icons/my_item_list.jpg" alt=""  border="0" /></a></div>
						<div class="deshimgfrtext"><a href="items_list.php">My Items List</a></div>
						<div class="clear"></div>
					        </div>
					
									
				                <div class="deshimgmin">
						<div class="deshimgfl"><a href="seller_shipping_details.php" class="imgbox"><img src="images/icons/shipping_detail.jpg" alt="" border="0" /></a></div>
						<div class="deshimgfrtext"><a href="seller_shipping_details.php">View/Add Shipping Details</a></div>
						<div class="clear"></div>
						</div>
						<div class="deshimgmin">
						<div class="deshimgfl"><a href="view_gift_details.php" class="imgbox"><img src="images/icons/gift-certificate.jpg" alt="" border="0" /></a></div>
						<div class="deshimgfrtext"><a href="view_gift_details.php">Gift Certificate Details</a></div>
						<div class="clear"></div>
						</div>
					         <div class="deshimgmin">
						<div class="deshimgfl"><a href="commision_items_listing.php" class="imgbox"><img src="images/icons/payment_detail.jpg" alt="" border="0" /></a></div>
						<div class="deshimgfrtext"><a href="commision_items_listing.php">Commision Details</a></div>
						<div class="clear"></div>
						</div>
                                                <div class="deshimgmin">
						<div class="deshimgfl"><a href="change_payment_details.php" class="imgbox"><img src="images/icons/payment.jpg" alt="" border="0" /></a></div>
						<div class="deshimgfrtext"><a href="change_payment_details.php">Payment Details</a></div>
						<div class="clear"></div>
						</div>
						<div class="deshimgmin">
						<div class="deshimgfl"><a href="upload_excel.php" class="imgbox"><img src="images/icons/sell_my_item.jpg" alt="" border="0" /></a></div>
						<div class="deshimgfrtext">
						<a href="upload_excel.php">
						Add Excel Sheet Details
						</a></div>
						<div class="clear"></div>
						</div>
                                         </div>
				   </div>
                                   <div class="acSection" style='padding:1px;' >&nbsp;</div>
                                  <div class="acSection" {if $smarty.cookies.cook_babys=='s'}style="border:0px solid green;height:150px;padding-top:1px;background-color:#fff6f0;display:'';"{else}style='border:0px solid green;height:150px;padding-top:1px;background-color:#fff6f0;display:none;'{/if} id='div_seller_acc2' >				    <div class="sellerhd">My Seller's Store Detail</div>
				      <div class="sellerSec">
					
					<div class="deshimgmin">
							<div class="deshimgfl"><a href="store_info.php" class="imgbox"><img src="images/icons/store_information.jpg" alt=""  border="0" /></a></div>
							<div class="deshimgfrtext"><a href="store_info.php">Store Information</a></div>
							<div class="clear"></div>
					</div>
                                     
					<div class="deshimgmin">
						<div class="deshimgfl"><a href="shop-policies.php" class="imgbox"><img src="images/icons/shopping_icon.jpg" alt=""  border="0" /></a></div>
						<div class="deshimgfrtext"><a href="shop-policies.php">Shop Policy</a></div>
						<div class="clear"></div>
					</div>
					 <div class="deshimgmin">
							<div class="deshimgfl">
							<a href="locker_items_seller.php" class="imgbox">
						<img src="images/icons/view_locker_area.jpg" alt="" border="0" /></a>
							</div>
							<div class="deshimgfrtext">
							<a href="locker_items_seller.php">View Locker  Area </a></div>
							<div class="clear"></div>
						</div>
				
						 <div class="deshimgmin">
							<div class="deshimgfl">
								<a href="seller_custom_request.php" class="imgbox">
						<img src="images/icons/my_workshop.jpg" alt="" border="0" /></a>
							</div>
							<div class="deshimgfrtext"><a href="seller_custom_request.php">My Workshop </a></div>
							<div class="clear"></div>
						</div>
						<div class="clear"></div>
						<div class="deshimgmin">
							<div class="deshimgfl" style='text-align:center;'>
							<a href="shoppolicy_seller.php" class="imgbox">
						        <img src="images/icons/shop-policy-preview.GIF" alt="" border="0" />
                                                        </a></div>
						        <div class="deshimgfrtext">
                                                        <a href="shoppolicy_seller.php">Shop Policy Preview </a></div>
							<div class="clear"></div>
						      </div>
						
                                                <div class="deshimgmin">
						    <div class="deshimgfl"  style='text-align:center;'>
							<a href="package_history.php" class="imgbox">
						        <img src="images/icons/package_his_icon'.jpg" alt="" border="0" />
                                                        </a>
							</div>
							<div class="deshimgfrtext">
                                                        <a href="package_history.php">Package History </a>
                                                        </div>
							<div class="clear"></div>
						      </div>
                                            <div class="deshimgmin">
						    <div class="deshimgfl"  style='text-align:center;'>
							<a href="purchase_package.php" class="imgbox">
						        <img src="images/icons/purchase_icon.jpg" alt="" border="0" />
                                                        </a>
							</div>
							<div class="deshimgfrtext">
                                                        <a href="purchase_package.php">Purchase Package </a>
                                                        </div>
							<div class="clear"></div>
						      </div>
 <div class="deshimgfl" style='text-align:center;'>
							  <a href="my_handpicked_items.php" class="imgbox">
						        <img src="images/icons/icon_textedit.png" alt="" border="0" />
                                                        </a>
							</div>
							<div class="deshimgfrtext">
                                                        <a href="my_handpicked_items.php">My Featured Items </a>
                                                        </div>
							<div class="clear"></div>
						      </div>
						</div>

  <div class="clear"></div>
                                    
<div class="acSection" style='padding-top:3px;'>&nbsp;</div>
			       <div class="acSection" 
				   {if $smarty.cookies.cook_babys=='s'}style="width:675px;border:0px solid green;height:100px;padding-top:1px;background-color:#fff6f0;display:'';"{else}
				   style="width:675px;border:0px solid green;height:100px;padding-top:1px;background-color:#fff6f0;display:none;"{/if}id='div_seller_acc4' >
				   <div class="sellerhd" style='width:670px;'>Coupons Details</div>
				      <div class="sellerSec">						
						 <div class="deshimgmin">
							<div class="deshimgfl">
							<a href="genrate_coupon.php" class="imgbox">
						<img src="images/icons/create_coupon.jpg" alt="" border="0" /></a>
							</div>
							<div class="deshimgfrtext">
							<a href="genrate_coupon.php">Create Coupon </a></div>
							<div class="clear"></div>
						</div>
						 <div class="deshimgmin">
							<div class="deshimgfl">
							<a href="view-coupons.php" class="imgbox">
						<img src="images/icons/view_coupon_detail.jpg" alt="" border="0" /></a>
							</div>
							<div class="deshimgfrtext">
							<a href="view-coupons.php">View Coupon Details </a></div>
							<div class="clear"></div>
						</div>
					</div>
                                </div>
								<br />
								<div class="acSection" 
				   {if $smarty.cookies.cook_babys=='s'}style="width:675px;border:0px solid green;height:100px;padding-top:1px;background-color:#fff6f0;display:'';"{else}
				   style="width:675px;border:0px solid green;height:100px;padding-top:1px;background-color:#fff6f0;display:none;"{/if}id='div_seller_acc5454' >
				   <div class="sellerhd" style='width:670px;'>Haating Details</div>
				      <div class="sellerSec">						
						 <div class="deshimgmin">
						 
						 <div class="deshimgfl"><a href="my-haating-items-list.php" class="imgbox"><img src="images/icons/my_haating_item_list.jpg" alt="" border="0" /></a></div>
							<div class="deshimgfrtext"><a href="my-haating-items-list.php">My Haating Items List</a></div>
						 
							
							
							<div class="clear"></div>
						</div>
						 <div class="deshimgmin">
							
							
							<div class="clear"></div>
						</div>
					</div>
                                </div>
     
                               <div class="acSection" style='width:670px;padding:1px;background-color:#FFFFFF;'>&nbsp;</div>
                                <div class="acSection" id='div_seller_acc3' style="display:none;" >
				   
				             
                                   </div>

					{*if $smarty.session.session_user_type==4*} <!-- for buyer-->
			           <div class="acSection" id='buyer_top'  >
				      <div class="buyerhd">My Buying Account &nbsp;&nbsp;
					  <span style="font-size:11px;"><a id='a_hideb' onclick="return show_accountsb('2','b')" {if $smarty.cookies.cook_baby=='b'}style="display:'';"{else}style="display:none;"{/if}  href="#">Hide</a>&nbsp;
					   <a id='a_showb' {if $smarty.cookies.cook_baby=='b'}style="display:none;"{else}style="display:'';"{/if}   onclick="return show_accountsb('1','b')" href="#buyer_top ">Show</a></span> </div>
				     <div class="buyerSec" id='div_buyer_acc1' 
					 {if $smarty.cookies.cook_baby=='b'}style="display:'';"{else} style="display:none;"{/if}>
                                     
						
					
						
						
						<div class="deshimgmin">
							<div class="deshimgfl"><a href="my-buyer-favorite-items.php" class="imgbox"><img src="images/icons/my-favourite-items.jpg" alt="" border="0" /></a></div>
							<div class="deshimgfrtext"><a href="my-buyer-favorite-items.php">My Favorite Items</a></div>
							<div class="clear"></div>
						</div>
						<div class="deshimgmin">
							<div class="deshimgfl"><a href="buyitem.php" class="imgbox"><img src="images/icons/my_buying_history.jpg" alt="" border="0" /></a></div>
							<div class="deshimgfrtext"><a href="buyitem.php">My Buying History</a></div>
							<div class="clear"></div>
						</div>
						
						<div class="deshimgmin">
							<div class="deshimgfl"><a href="bid_history.php" class="imgbox"><img src="images/icons/my_haating_history.jpg" alt="" border="0" /></a></div>
							<div class="deshimgfrtext"><a href="bid_history.php">My Haating History</a></div>
							<div class="clear"></div>
						</div>
						
						<div class="deshimgmin">
							<div class="deshimgfl"><a href="buyer-haated-items.php" class="imgbox"><img src="images/icons/my_haating_item_list.jpg" alt="" border="0" /></a></div>
							<div class="deshimgfrtext"><a href="buyer-haated-items.php">My Haated Items List</a></div>
							<div class="clear"></div>
						</div>
                                                <div class="clear"></div>
						<div class="deshimgmin">
							<div class="deshimgfl"><a href="my-buyer-shop-items.php" class="imgbox"><img src="images/icons/my_favourite_shops.jpg" alt="" border="0" /></a></div>
							<div class="deshimgfrtext"><a href="my-buyer-shop-items.php"> My Favorite Shops </a></div>
							<div class="clear"></div>
						</div>
						<div class="deshimgmin">
							<div class="deshimgfl"><a href="buyer_custom_request.php" class="imgbox">
						<img	src="images/icons/my_workshop.jpg"  alt="" border="0" /></a></div>
							<div class="deshimgfrtext"><a href="buyer_custom_request.php">My Custom Item Request  </a></div>
							<div class="clear"></div>
						</div>
						<div class="deshimgmin">
							<div class="deshimgfl"><a href="buyer_giftcard.php" class="imgbox">
							<img src="images/icons/my_gift-card.jpg" alt="" border="0" /></a></div>
							<div class="deshimgfrtext"><a href="buyer_giftcard.php">My Gift Card  </a></div>
							<div class="clear"></div>
						</div>
					
					
					
					
					<div class="clear"></div>
					</div>
                                     </div>
</div>
                                       {* if $smarty.session.session_user_type!=3*}
					<div class="deshinhd">Upcoming Events </div>
			<div class="selleritembox">
			{if $num_rows_items1>0}
          		<div class="sellscrimgfl_rem" >
	          	{if $num_rows_items1>5}
		        <a href="#" id="prev1"><img  vspace='20'  src="{$baseUrl}images/scroll_arrow-fl.jpg" alt="" border="0" /></a>
		       {/if}
		        </div>
		<div class="sellscrimgmid" id="scroll1"  style='height:auto;border:0px solid red;width:620px;'  >
	
		<ul class="scrollContainer1">
	 {foreach name=cat from=$users_items_details item=val_items}	
		<li class="scrollerBlock"style='height:auto;' >
		<div  class="slideImgbox" style='height:auto;' >
	        <span style='font-size:11px;color:#000000;text-align:center;'>{if $val_items.name!=''}
                {$val_items.name|ucfirst}
		{/if}</span>
	        <br>
		{if $val_items.rem_title!=''}
		{$val_items.rem_title|ucfirst}
	        {/if}
		<br>
	        <span style='color:red;font-size:10px;'>
                {$val_items.rem_day}&nbsp;{$val_items.rem_month+1|date_value_month}
		</span><br>
		<a href="add_reminder_message.php?rem_id_value={$val_items.rem_id}">Send/Save Message</a>		
		<br>
		<a href="events_gift_cards.php?rem_id_value={$val_items.rem_id}">Send/Save Giftcard</a>
		</div>
	 </li>
	 

	 {/foreach}
	 </ul>
		</div>
		<div class="sellscrimgfr_rem"> 
		{if $num_rows_items1>5}
		<a href="#" id="next1"><img vspace='20' src="images/scroll_arrow_fr1.jpg" alt="" border="0" /></a>
		{/if}
		</div>
		<script src="{$baseUrl}js/jcarousellite.js"></script>						
		{literal}
		<script>
		$(function() {
		$("#scroll1").jCarouselLite({
					btnNext: "#next1",
					btnPrev: "#prev1",
					visible: {/literal}{$val_visble}
					{literal}});
					});
			</script>
		{/literal}
		<div class="clear"></div>
	{else}
<span style='font-size:12px;color:red;font-family:arial;'>	No upcoming events 
	</span>
	{/if}</div>
	{*/if*}
					
						<div class="deshimgmin">
							<div  style='padding:1px;' >&nbsp;</div>
							<div class="clear"></div>
						</div>
					 
						
						
					
					<div class="clear"></div>
					{*/if*}
					</div>	
					<!--End inside part -->
				</div>
				
			</div>
			<div class="clear"></div>
		</div>
		<!--End Middle-->
{include file="footer.tpl"}