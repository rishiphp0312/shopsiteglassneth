{include file="header.tpl"}
{include file="js_css_validation.tpl"} 
<link href="{$baseUrl}css/cloud-zoom.css" rel="stylesheet" type="text/css" />
<script type="text/JavaScript" src="{$baseUrl}js/cloud-zoom.1.0.2.js"></script>
{include file="header_search.tpl"}
<script type="text/javascript" language="javascript">
{literal}
function discount_apply_coupon()
{
 var CD_ID = document.getElementById('coupon_code');
 if(CD_ID.value=='')
 {
 alert("If you donot have Coupon Code,please click link contact seller!! ");
 CD_ID.focus();
 return false;
 }
}
function haat_price_fun()
{// alert('haat');
  if(document.getElementById('bid_value').value=='')
  {
  alert('Haating price cannot be empty.Please enter price.!!');
  document.getElementById('bid_value').value='';
  return false;
  }
}
function check_quantity(FRM_NUM)
{
  if(FRM_NUM=='frm_buyhaat_qty_details')
  {
  if(parseInt(document.getElementById('requested_quantity').value)>parseInt(document.getElementById('available_quantity').value) )
  {
  alert('Requested quantity is greater than available stock.Please enter less quantity!!');
  document.getElementById('requested_quantity').value='';
  return false;
  }
  else if(document.getElementById('requested_quantity').value=='' )
  {
  alert('Please enter quantity!!');
  return false;
  }
  else
  {  document.frm_buyhaat_qty_details.submit();
     return true;
   }
  }
  if(FRM_NUM=='frm_normal_details')
  {
  if(parseInt(document.getElementById('requested_quantity').value)>parseInt(document.getElementById('available_quantity').value) )
  {// alert('gfgfg'+document.getElementById('available_quantity').value);
  alert('Requested quantity is greater than available stock.Please enter less quantity!!');
  document.getElementById('requested_quantity').value='';
  return false;
  }
  else if(document.getElementById('requested_quantity').value=='' )
  {
  alert('Please enter quantity!!');
  return false;
  }
  else
  {
  document.frm_normal_details.submit();
  return true;
   }
  }

}
function show_div(NUM)
{

    var STR="If you find this product has violated any copyright /IPR policy/is objectionable.Please report it.This function can be reported by a registered user only .";

    if(NUM==1)
    {
    document.getElementById('a_div1').style.display='none';
    document.getElementById('a_div0').style.display='';
    document.getElementById('div_txt').innerHTML=STR;
    }else
    {
    document.getElementById('a_div0').style.display='none';
    document.getElementById('a_div1').style.display='';
    document.getElementById('div_txt').innerHTML='';
    }
}
function shold_buyer(NUM)
{
	if(NUM==1)
	var STR="You must be the buyer to add items to your favourite!";
	else
        var STR="You must be the buyer to add shop!";
	return false;
}
function onload_inventoryalert(SEL_ID)
{
	alert("The quantity is null in inventory.Please contact the seller to update the quantity of items!. ");
	window.location='#contact_seller.php?id='+SEL_ID;
	return false;
}
{/literal}
</script>

{if $num_rows_items_qty_delete_by_admin_seller==0}
<div class="insidemiddlemian" style="border:0px solid #FF0000;height:400px;font-family:Arial, Helvetica, sans-serif;font-size:18px;color:#B36666;font-weight:700;text-align:center;padding-top:15px;">
{if $num_rows_items_qty_delete_by_admin_seller1!=0}
Item may be deleted by admin or seller or may be package expired or may be the quantity is null .
{else}
Item donot belong to this store .

{/if}
</div>
{else}
	{if $details_of_store_status!=0}<!-- 0 means store disabled-->
<!--Start Middle-->
<div id="middleMain">
	<div id="insidemiddlemian">
		<div>
<!-- below code added by rishi-->
                    {if $item_det_msg!=''}
                <div class="insidehd " style='font-size:12px;color:red;font-family:arial;text-align:center;' > { $item_det_msg} </div>
		    {/if}
<!-- above code added by rishi-->
                <div>
		{include file='error_msg_template.tpl'}
		<div class="clear"></div>
		</div>
               <div class="insidehd ">Item Details </div>
		<div class="clear"></div>
			<div class="buyermain">
				<!--Start item detail -->
				<div>
					<div class="iteminsidedetl">
						<div class="itemtopinsideText">{$users_items_details.title|ucfirst}</div>
						<div class="itemdtlimgbox">
							<div class="itemsmlimgmain" >	
								{if $users_items_details.image1!=''}
								<div class="itemsmlimg">
								<a href="uploads/{$users_items_details.image1}" class='cloud-zoom-gallery' title='Thumbnail 1' rel="useZoom: 'zoom1', smallImage: '{$baseUrl}getthumb.php?w=400&h=266&fromfile=uploads/{$users_items_details.image1}' ">
								<img src="{$baseUrl}getthumb.php?w=70&h=46&fromfile=uploads/{$users_items_details.image1}" alt="" border="0" class="itemimagebox" />
								</a>
								</div>
								{/if}
								
								{if $users_items_details.image2!=''}
								<div class="itemsmlimg">								<a href="uploads/{$users_items_details.image2}" class='cloud-zoom-gallery' title='Thumbnail 2' rel="useZoom: 'zoom1', smallImage: '{$baseUrl}getthumb.php?w=400&h=266&fromfile=uploads/{$users_items_details.image2}' ">
								<img src="{$baseUrl}getthumb.php?w=70&h=46&fromfile=uploads/{$users_items_details.image2}" alt="" border="0" class="itemimagebox" />
								</a>
								</div>
								{/if}

								{if $users_items_details.image3!=''}
								<div class="itemsmlimg">
								<a href="uploads/{$users_items_details.image3}" class='cloud-zoom-gallery' title='Thumbnail 3' rel="useZoom: 'zoom1', smallImage: '{$baseUrl}getthumb.php?w=400&h=266&fromfile=uploads/{$users_items_details.image3}' ">
								<img src="{$baseUrl}getthumb.php?w=70&h=46&fromfile=uploads/{$users_items_details.image3}" alt="" border="0" class="itemimagebox" />
								</a>
								</div>
								{/if}

								{if $users_items_details.image4!=''}
								<div class="itemsmlimg">
								<a href="uploads/{$users_items_details.image4}" class='cloud-zoom-gallery' title='Thumbnail 4' rel="useZoom: 'zoom1', smallImage: '{$baseUrl}getthumb.php?w=400&h=266&fromfile=uploads/{$users_items_details.image4}' ">
								<img src="{$baseUrl}getthumb.php?w=70&h=46&fromfile=uploads/{$users_items_details.image4}" alt="" border="0" class="itemimagebox" />
								</a>
								</div>
								{/if}

								{if $users_items_details.image5!=''}
								<div class="itemsmlimg">
								<a href="uploads/{$users_items_details.image5}" class='cloud-zoom-gallery' title='Thumbnail 5' rel="useZoom: 'zoom1', smallImage: '{$baseUrl}getthumb.php?w=400&h=266&fromfile=uploads/{$users_items_details.image5}' ">
								<img src="{$baseUrl}getthumb.php?w=70&h=46&fromfile=uploads/{$users_items_details.image5}" alt="" border="0" class="itemimagebox" />
								</a>
								</div>
								{/if}
																		
							</div>
							<div class="itemdetailimgbox" style='border:0px solid red;padding-left:1px;text-align:center;'>
								<div align="left" style='border:0px solid red;' >
								{if $users_items_details.image1!=''}
   <a href='{$baseUrl}getthumb.php?w=500&h=296&fromfile=uploads/{$users_items_details.image1}' class = 'cloud-zoom' id='zoom1' rel="adjustX: 10, adjustY:-4, softFocus:false">
								{/if}
                <img src="{$baseUrl}getthumb.php?w=400&h=230&fromfile=uploads/{$users_items_details.image1}" alt="{$users_items_details.title}"  border="0"  />
								{if $users_items_details.image1!=''}</a>{/if}
								</div>
							</div>
							<div class="clear"></div>
							
						</div>
						<div class="styleMain">
						<div class="styleLabel">Style:</div>
						<div class="styleLabelfr">{$all_style_names|ucfirst}</div>
						<div class="clear"></div>

						<div class="styleLabel">Color:</div>
						<div class="styleLabelfr">{$users_items_details.color|ucfirst}</div>
						<div class="clear"></div>
						</div>

						<div class="insideitemhd">About The Item</div>
						<div class="insidetexhight">{$users_items_details.description|text_format}</div>
						<div class="meterialbox">
							<div class="metalhd">Item Contents</div>
							<div class="meteriallink">{$users_items_details.material_used|ucfirst }</div>
						</div>
						<div class="meterialbox">
							<div class="metalhd">Care</div>
							<div class="meteriallink">{if $users_items_details.care!=''}{$users_items_details.care|ucfirst}{else}NA{/if} </div>
						</div>
						<div class="meterialbox">
							<div class="metalhd">Shipping Details</div>
							<div style="height:auto;">
							<table width="618px;" cellspacing="0" cellpadding="3" border="0" align="left">
								<tr>
								<td valign="top" colspan="3"><b>Source Country:</b> 
								{if $details_ofuser_information.country|ucfirst!=''}
								{$details_ofuser_information.country|ucfirst}
								{else}
								 N/A
								{/if}</td>
								</tr>
								{if $num_value_details!=0}
								<tr style="font-weight:bold;">
								<td width="25%" valign="top">Destination Countries</td>
								<td width="25%" valign="top">Shipping Cost</td>
								<td width="50%" valign="top">Comment</td>
								</tr>
								
								{foreach name=cat from=$show_all_options item=val_items}
								<tr>
								<td valign="top">{if $val_items.country!=''}{$val_items.country}{else}NA{/if}</td>
								<td valign="top">{if $val_items.ship_cost_country!=''}{$val_items.ship_cost_country|convert_price}{else}NA{/if}</td>
								<td valign="top">{if $val_items.comment!=''}{$val_items.comment}{else}NA{/if}</td>
								</tr>
								{/foreach}
								<tr>
								<td valign="top" nowrap="nowrap">Other Countries .</td>
								<td valign="top">
{if $users_items_details.allow_rest_country_status==1}
{$users_items_details.ship_allowcost|convert_price}{else}N/A{/if}</td>
								<td valign="top">{if $users_items_details.allow_rest_country_status==1}
								{$users_items_details.ship_allowcomment}{else}NA{/if}</td>
								</tr>
								{else}
								<tr>
								<td valign="top" colspan="3">No destination countries defined by seller.</td>
								</tr>
								{/if}
							</table>
							</div><div class="clear"></div>
							<div class="meteriallink"></div>
						</div>
						{if $sellers_number_of_items1!=0}
						<div class="insideitemhd" style="border-bottom:none;">Seller's Other Item</div>
						<div class="selleritembox" >
							{if $sellers_number_of_items1>5}
							<div class="sellscrimgfl"><a href="javascript://" id="prev1"><img src="{$baseUrl}images/scroll_arrow-fl.jpg" alt="" border="0" /></a></div>
							{/if}
						<div class="sellscrimgmid" id="scroll1"style='height:130px;'>
								<ul class="scrollContainer" style='height:130px;'>
								{foreach name='csdf' from=$sellers_withotheritems item=v}
                                   {*if $anObject->home_pageHaatedItems($v.item_id)==0*}
								<li class="scrollerBlock"style='height:130px;'><div class="slideImgbox" style='height:120px;'>
								<a href="item-details.php?details_item_value={$v.show_item_id}{if $v.coupon_code!='' && $v.coupon_status==1  && $v.start_date<=$date_forcheck  && $v.end_date>=$date_forcheck}&d=1{/if}" title="{$v.title}">
								<img src="{$baseUrl}getthumb.php?w=90&h=70&fromfile=uploads/{$v.image1}" onerror="this.src='{$baseUrl}images/item_small_img.jpg'; this.style.width='90px'; this.style.height='50px';" width="90" height="70" alt="" border="0"  class="slideImg"/>
</a><br />
								<div class="itemName"><a href="item-details.php?details_item_value={$v.show_item_id}{if $v.coupon_code!='' && $v.coupon_status==1  && $v.start_date<=$date_forcheck  && $v.end_date>=$date_forcheck}&d=1{/if}" title="{$v.title}">{$v.title|truncate:10:'...':true}</a><br />
								<span>{$v.cost_item|convert_price}</span>
								{if $v.hatting_status==1}
                                              <fieldset id="set2">
                                                 {if $smarty.session.session_user_id ==''}
                                                  <span style='color:#9ac243;'>&nbsp;&nbsp;
              <label title=" In order to negotiate online for this item on haating ,please log in. " ><b>Haat It </b></label> </span>
                              {else}
			<span style='color:#9ac243;'>&nbsp;&nbsp;
             <label title=" Click on the item to negotiate online." ><b>Haat It </b></label>
             </span>{/if}{literal}<script >
                                                                   <code class="mix">$('#set2 *').tooltip();</code>
                                                                   </script>{/literal}
                                                                 </fieldset>

                                                                  {/if}
				{if $v.hatting_status!=1}
                <span   style='color:#FFFFFF;line-height:12px;'> &nbsp; </span>
					{/if}
													    {if $v.coupon_code!='' && $v.coupon_status==1  && $v.start_date<=$date_forcheck  && $v.end_date>=$date_forcheck}
                                                                    <span style="color:red;font-size:9px;">Discount applicable {*$val_items.disc_price|number_format:2:".":","*}
                                                                    </span>
                                                                    {/if}


                                                               </div>
								</div></li>{*/if*}
								{/foreach}
								</ul>

             </div>
							
							{if $sellers_number_of_items1>5}
							<div class="sellscrimgfr">
							<a href="javascript://" id="next1">
                                                        <img src="{$baseUrl}images/scroll_arrow_fr1.jpg" alt="" border="0" /></a>
							</div>
							{/if}
                                                       <script language="JavaScript" type="text/JavaScript" src="{$baseUrl}js/jcarousellite.js"></script>						
							<script language="javascript" type="text/javascript">
							{literal}
							$(function() {
								$("#scroll1").jCarouselLite({
									btnNext: "#next1",
									btnPrev: "#prev1",
						       	    visible:{/literal}{$visble_val}{literal}
                                                            
                                                                 	});
								
							});
							{/literal}
							</script>
							<div class="clear"></div>
						</div>
						{/if}
						<div class="insideitemhd">Payment Mode</div>
							<div class="paymnMathodbdr">
								<div style="position:absolute; top:-15px; left:9px;"><img src="{$baseUrl}images/paypal_logo.jpg" alt="" /></div>								
								<div class="paypalimg"><img src="{$baseUrl}images/paypal_cart.jpg" alt="" /></div>
							</div>						
					</div>
					</div>
					<!--Start right part -->
                                     
					<div class="itemDetialfrmain">
						  {if $users_items_details.hatting_status!=1}
                                             <form name='frm_normal_details' action='shipping_details.php' method='get'>
                                               <div class="buyNow"  {if $result_coupon_exsist>0}style='padding-top:1px;padding-bottom:1px;height:auto;'{/if}>
                                                     <div style='border:0px solid red;width:225px;' >
                                                       <div class="buyNowtextfl"  >
  						         <span {if $result_coupon_exsist>0}style='text-decoration:line-through;font-size:12px;'{/if}>{$USD} {$users_items_details.cost_item|convert_number}<br />
							 {$users_items_details.cost_item|convert_price}<br />
                                                         </span>
                                                         {if $result_coupon_exsist==1 || $coupon_d==1}
                                                         <span style='font-size:12px;color:red;'>
                                                         <!--{$USD}-->{$str_amount_final|convert_price}.</span> <br />
                                                              {/if}                                             
							  In Stock Qty {$users_items_details.quantity_available}
                                                          </div>
  {if $users_items_details.hatting_status!=1 && $users_items_details.quantity_available!=0 && ($users_items_details.locker_status==0 ||($users_items_details.locker_status==1 && $users_items_details.locker_permission==1 )||($users_items_details.locker_status==1 && $users_items_details.locker_permission==0 && $num_customitem_details>0 ))  }
						         <div class="buyNowbtn">
                                                        <a  onClick="return check_quantity('frm_normal_details');" href="#shipping_details.php?item_id={$users_items_details.item_id}&seller_id={$users_items_details.seller_id}">
                                                        <img src="{$baseUrl}images/buy_bow_btn.jpg" alt="" border="0" /></a>
                                                         </div>
							{/if }
                                                        <div class="clear"></div>
                                                </div>
                                               <div style='border:0px solid red;width:225px;' ><!--Enter Quantity:&nbsp;-->
                                                <input type='hidden' value='1' name='requested_quantity' style='width:50px;' id='requested_quantity' >
                                                <input type='hidden' value='{$users_items_details.item_id}' name='item_id' id='item_id' >
                                                <input type='hidden' value='{$users_items_details.seller_id}' name='seller_id' id='seller_id' >
                                                <input type='hidden' value='{$users_items_details.quantity_available}' name='available_quantity' id='available_quantity' >
                                                  </div>
                                                </div>
                                                  </form>
                                                {/if}
 
                                          {if $users_items_details.hatting_status!=1 && $users_items_details.quantity_available!=0 }
                                          <!-start of discount  code-->
                                         {if $coupon_d_not_posted==1 }
                                         <div class="buyNow"style='padding-top:2px;' >
                                            <form name='frm' action='' method='post'>
                                                <table align='center' width='100%' border='0' cellspacing='0' cellpadding='0' >
                                                 <tr>
                                                   <td colspan='2' valign='top' align='left'style='font-size:2px;font-weight:bold;color:#000000;'>&nbsp;&nbsp;</td>
                                                  </tr>
                                                   <tr>
                                                   <td colspan='2' valign='top' align='left'style='font-size:12px;font-weight:bold;color:#000000;'>Enter Discount Coupon Code</td>
                                                  </tr>
                                                 <tr>
                                                   <td colspan='2' valign='top' align='left'style='font-size:12px;font-weight:bold;color:#000000;'>&nbsp;</td>
                                                  </tr>
                                                
                                                    <tr>
                                                   <td valign='top' align='left'>
												   <input type='hidden' value='1' name='coupon_d'>
                                                   <input type='hidden' value='{$details_item_value_listingid}' name='details_item_value'>
                                                   <input type='text' value='' name='coupon_code' id='coupon_code' > </td>
                                                   <td valign='top' align='left' >
                                     {if $users_items_details.quantity_available!=0 }              
                                      <input type='image' onclick="return discount_apply_coupon()" {if $smarty.session.session_user_id==''}disabled='true' {/if} value='Apply' src='images/apply_btn.jpg'>
                                     {else}
                                     No Quantity
                                     {/if}
                                 <input type='hidden' value='Apply' name='Apply'>
                                 <input type='hidden' value='{$details_item_value_listingid}' name='amount_after_discount'></td>
                                           </tr>
										  {if $smarty.session.session_user_id==''}
										   <tr><td align="left" valign="top" style='font-size:10px;color:red;text-align:left;'>Please login to enter discount coupon code.</td></tr>
										   {/if}
                                       </table>
                                            </form>
                                                 <div class="clear"></div>
                                                </div>
           {/if}
                                             <!-end of discount  code-->
                                       {/if}
                                             <!-start of haating code-->
           {if  $users_items_details.hatting_status==1}
        <div class="buyNow">               
          <div class="buyNowtextfl" style='float:left;border:0px solid red;width:223px;'>
              {if (($users_biditems_details_status==0 && $smarty.session.session_user_id!='')||$smarty.session.session_user_id=='')  && $users_items_details.hatting_status==1}
                                         <form name='frm_haat_price_fun' id='frm_haat_price_fun' action='' method='post'>
                                        <div style='font-size:13px;color:#000000;font-weight:bold;border:0px solid green;width:220px;'>
                                                        Post your price. </div>
                                         <div style='font-size:4px;color:red;font-weight:bold;border:0px solid green;width:220px;'>
                                               &nbsp;&nbsp; </div>
                                     <div style='border:0px solid red;width:220px;'>
                                     <div style='border:0px solid red;width:100px;float:left;' >
                                     In Stock qty {$users_items_details.quantity_available}&nbsp;
                                        {if $smarty.session.session_user_id==''}
                                             <input type='text' value='' disabled='true' name='bid_value' style='width:60px;' >
                                                   {else}
                                           <input type='text' value='' name='bid_value' class="required only_numericwithfloat" id='bid_value' style='width:60px;' >
                                                  {/if}
<br /><span style='font-size:11px;color:#663300;font-weight:lighter;font-family:Arial, Helvetica, sans-serif;'> Haat it price in USD.</span>
                                                   <input type='hidden' value='{$details_item_value_listingid}' name='details_item_value'>
												   
                                                                </div>
                                                               <div style='border:0px solid red;width:100px;float:right;' >
                                                               {if $users_items_details.quantity_available!=0}
															     <b>USD {$users_items_details.cost_item} </b> 
                                                               {if $smarty.session.session_user_id!=''}
                                                   <input type='image'  src='{$baseUrl}images/haat-it-btn.jpg'>
                                                               {else}
															 
															    <fieldset id="set1">
                                                               <label title=" In order to negotiate online for this item on haating ,please log in. " > 
															    <a href='login-hatting.php'> <img   src='{$baseUrl}images/haat-it-btn.jpg'></a>
                                                                    </label>{literal}<script >
                                                                   <code class="mix">$('#set1 *').tooltip();</code>                                                      </script>{/literal}</fieldset>
                                                                   {/if}
                                                                

                                                                   {else}
                                                                   No Quantity
                                                                   {/if}
                                                                   <input type='hidden' value='Post-Bid' name='bid_submit'>
                                                                   </div>
                                                                <div class="clear"></div>
                                                           </div>
                                                        
                                                    </form>
                  {/if}
                                        
            </div>
                                                       
              
                                 
    {if $users_items_details.hatting_status==1 && $users_biditems_details_status >0 && $users_items_details.quantity_available!=0 && $smarty.session.session_user_id!=''}
			   <form name='frm_buyhaat_qty_details' action='shipping_details.php' action='get'>
                                    <div class="buyNowbtn"  style='float:left;border:0px solid red;width:220px;'>
                                                   <div  style='float:left;border:0px solid red;width:210px;'>
                                  <div style='float:left;border:0px solid red;width:100px;' class="buyNowtextfl">
                                                   <span>{$USD} {$smarty.session.d_cost_item|convert_number}<br />
                                                    {$smarty.session.d_cost_item|convert_price}<br /></span>
                                                    In Stock qty {$users_items_details.quantity_available}
                                                    </div>
                                                    <div style='float:right;border:0px solid red;width:100px;' >
                                                    <a HREF="javascript://" onclick="return check_quantity('frm_buyhaat_qty_details');">
 <img  src="{$baseUrl}images/buy_bow_btn.jpg" alt="" border="0" /></a>
                                                   </div> <div class="clear"></div>
</div>
                                                   
                                                <div class="buyNowbtn"  style='float:left;border:0px solid red;width:220px;'>
<!--Enter quantity&nbsp;&nbsp;-->       <input type='hidden' value='1' name='requested_quantity' style='width:50px;' id='requested_quantity' >
                                                <input type='hidden' value='{$users_items_details.item_id}' name='item_id' id='item_id' >
                                                <input type='hidden' value='{$users_items_details.seller_id}' name='seller_id' id='seller_id' >
                                                <input type='hidden' value='{$users_items_details.quantity_available}' name='available_quantity' id='available_quantity' >
                                                </div>
                                     
                                    </div>
                           </form>
                   {/if}
                                                 	
				</div>
                            <div class="clear"></div>
{/if}




<!-- end of code-->
                                        	<div class="rightbox">
							<div class="rightboxhd">{$details_ofuser_information.username} info</div>
							<div class="whiteinsidebox">
								<div class="frboxinhd"><strong>{$details_ofuser_information.username}</strong></div>
								<div class="rightimgbox"><a href="http://{$add_this_name_www}.{if $smarty.server.HTTP_HOST=='www.nethaat.com'}{$details_ofuser_information.username}.{/if}{$add_this_name}/featured_store_information.php"><img src="{$baseUrl}getthumb.php?w=50&h=50&fromfile=uploads/store_logos/{$v_store_image}" alt="" border="0" class="rightimg" onerror="this.src='{$baseUrl}images/imagsamll.jpg'; this.style.width='50px'; this.style.height='50px';" /></a></div>
								<div class="rightimgboxtext">
									<div class="righticon"><a href="http://{$add_this_name_www}.{if $smarty.server.HTTP_HOST=='www.nethaat.com'}{$details_ofuser_information.username}.{/if}{$add_this_name}/featured_store_information.php"><img src="{$baseUrl}images/about_shop_img.jpg" alt="" /> About shop</a></div>
									<div class="righticon"><a href="http://{$add_this_name_www}.{if $smarty.server.HTTP_HOST=='www.nethaat.com'}{$details_ofuser_information.username}.{/if}{$add_this_name}/shoppolicy_seller.php"><img src="{$baseUrl}images/polices_icon.jpg" alt="" /> Policies</a></div>
									<div class="righticon"><a href="contact_seller.php?sellerid={$sellerid}"><img src="{$baseUrl}images/contact_icon.jpg" alt="" /> Contact us</a></div>
								</div>
								<div class="clear"></div>
								<div class="ratinglble">Rating :</div>
								<div class="ratinglblefr">{if $find_percentage!=''}<a href='viewfeedback.php?rating_seller_id={$sellerid}'>{$find_percentage}%</a>{else}0%{/if}</div>
								<div class="clear"></div>
								<div class="ratinglble">Location :</div>
								<div class="ratinglblefr">{if $details_ofuser_information.country!=''}{$details_ofuser_information.country|ucfirst}{else}NA{/if}</div>
								<div class="clear"></div>
							</div>
						</div>
						<div class="rightbox">
							<div class="rightboxhd">Quick links</div>
							<div class="whiteinsidebox">
								<div class="quickLinkbox"><a href="{if $smarty.session.session_user_id!=''}item-details.php?favorite_details_item_value={$details_item_value_listingid}{else}login.php{/if}"><img src="{$baseUrl}images/my_favourite_icon.jpg" alt="" class="vAlign" /> Add to my favorite items</a></div>
								<div class="quickLinkbox"><a href="{if $smarty.session.session_user_id!='' }item-details.php?add_to_shop={$details_ofuser_information.user_id_value}&details_item_value={$details_item_value_listingid}{else}login.php{/if}"><img src="{$baseUrl}images/my_shop_icon.jpg" alt="" class="vAlign" /> Add to my favorite shops</a></div>
								<div class="quickLinkbox"><a href="email-to-friend.php?details_item_value={$details_item_value_listingid}&item_name={$users_items_details.title|ucfirst}"><img src="{$baseUrl}images/my_email_icon.jpg" alt="" class="vAlign" /> Email to friend</a></div>
							</div>
						</div>
						<div class="rightbox">
							<div class="rightboxhd">Facts</div>
							<div class="whiteinsidebox">
								<div>Item uploaded on {$users_items_details.date_added|date_format:"%b %d, %Y" }<br />
								Product Id # {$details_item_value_listingid}<br />
								{$users_items_details.counter_view } clicks<br />
								<a id='a_div1' href='javascript://' onclick="return show_div('1')" >+</a><a style='display:none;' id='a_div0' href='javascript://' onclick="return show_div('0')" >+</a>&nbsp;&nbsp;<a href="{$baseUrl}contact_us.php?details_item_value={$details_item_value_listingid}&item_name={$users_items_details.title|ucfirst}">Report It</a></div>
							</div>
                                                      <div class="whiteinsidebox" id='div_txt' style='font-size:12px;color:red;font-weight:500px;font-family:arial;padding-top:1px;' >
								
							</div>
						</div>

<!-- Below code starts for replacement-->
                                               <div class="buyNow" >
						     <div class="buyNowtextfl" style='border:0px solid red;'>
                                                       {if $users_items_details.hatting_status==1 && $users_biditems_details_status >0 && $users_items_details.quantity_available!=0}
                  		                       <span  >{*haated price*}{$USD} {$smarty.session.d_cost_item|convert_number}<br>
							{$smarty.session.d_cost_item|convert_price}<br /></span>
                                                        {/if}
                                                {if $users_items_details.hatting_status!=1}
	                                      <span  {if $result_coupon_exsist>0}style='text-decoration:line-through;font-size:12px;'{/if}>{$USD} {$users_items_details.cost_item|convert_number}<br />
							{$users_items_details.cost_item|convert_price}<br /></span>
                                                       {if $result_coupon_exsist==1 || $coupon_d==1}
                                                        <span style='font-size:12px;color:red;'>
                                                        <!--{$USD}-->{$str_amount_final|convert_price}.
                                                              </span>
                                           <br />
                                                              {/if}
                                                 {/if}
                       {if $users_items_details.hatting_status==1 && $users_biditems_details_status ==0 && $users_items_details.quantity_available!=0}
                                                    <span >
                       {$USD} {$users_items_details.cost_item|convert_number}<br>{$users_items_details.cost_item|convert_price}<br />
                                                     </span>
                       {/if} In Stock qty {$users_items_details.quantity_available}
			    			        </div>
							<div class="buyNowbtn" style='border:0px solid red;' >
                                             {if $users_items_details.hatting_status==1 && $users_biditems_details_status >0 && $users_items_details.quantity_available!=0}
                         <!--    <a href="shipping_details.php?item_id={$users_items_details.item_id}&seller_id={$users_items_details.seller_id}">
                            <img src="{$baseUrl}images/buy_bow_btn.jpg" alt="" border="0" /></a>-->
							 {/if}
                        {if $users_items_details.hatting_status!=1  && $users_items_details.quantity_available!=0}
                           <!--  <a href="shipping_details.php?item_id={$users_items_details.item_id}&seller_id={$users_items_details.seller_id}">
                             <img src="{$baseUrl}images/buy_bow_btn.jpg" alt="" border="0" /></a>-->
			 {/if}</div>

                                   <div class="clear"></div>
						      </div>
					       </div>
                    <!-- above replacement code ends-->
			<!--End right part -->
					<div class="clear"></div>
        {else}
	<div class="insidemiddlemian" style="border:0px solid #FF0000 ;height:400px;font-family:Arial, Helvetica, sans-serif;font-size:18px;color:#B36666;font-weight:700;text-align:center;padding-top:15px;">Store is currently suspended by Admin.</div>
	{/if}
     	{/if} <!-- this if is closed for deleted or quantity equal to zero-->

			</div>
				<!--End item detail -->		
			</div>
			<div class="gap"></div>
	</div>
</div>
<div class="clear"></div>
<!--End Middle-->
{include file="footer.tpl"}
