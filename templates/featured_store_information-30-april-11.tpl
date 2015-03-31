{include file="header.tpl"}
{include file="header_search.tpl"}
<!--Start Middle-->
<div id="middleMain">
	<div id="insidemiddlemian">
		<div>
		<div class="clear"></div>
			<div class="buyermain">
				<!--Start item detail -->
				<div>
				<div class="shoppinghdinside" style="border-bottom:none;">{$username}</div>
				<div class="goToback"><a href='javascript://' onclick='history.go(-1)'>Go Back</a></div>
				<div class="clear"></div>
					<div class="iteminsidedetl">
					<div class="shoppingimgbox"><img src="{$baseUrl}getthumb.php?w=415&h=120&fromfile=uploads/store_logos/{$v_store_image}" onerror="this.src='{$baseUrl}images/item_small_img.jpg'; this.style.width='415px'; this.style.height='120px';" alt="" /></div>
						<div style='padding-top:20px;'>
							<div class="insideitemhd" >About the Shop</div>
							<div style="text-align:justify;">{$v_welcome}</div>
						</div>
							
						<div class="contactmain">
							<div class="insideitemhd">Contact Details</div>
							<div class="contactlable">Name</div>
							<div class="contactlabletext">{$f_name} {$l_name}</div>
							<div class="clear"></div>
							<div class="contactlable">Address1</div>
							<div class="contactlabletext">{$address1}</div>
							<div class="clear"></div>
							<div class="contactlable">Address2</div>
							<div class="contactlabletext">{$address2}</div>
							<div class="clear"></div>
							<div class="contactlable">City</div>
							<div class="contactlabletext">{$city}</div>
							<div class="clear"></div>
							<div class="contactlable">State</div>
							<div class="contactlabletext">{$state}</div>
							<div class="clear"></div>
							<div class="contactlable">Zip Code</div>
							<div class="contactlabletext">{$zipcode}</div>
							<div class="clear"></div>
							<div class="contactlable">Country</div>
							<div class="contactlabletext">{$user_country_name}</div>
							<div class="clear"></div>
						</div>
						{if $num_rows_items1>0}
						<!--Store category -->
						<div>
						<div class="insideitemhd">Store Catalogue</div>
							<div class="storeCategory">
								<div class="inidebgbox">
									{foreach name=cat from=$users_items_details item=val_items}
                            {*if $anObject->home_pageHaatedItems($val_items.show_item_id)==0*}
									<div class="storeCategorybox">
										<div class="categoryimgbox">
	<a href="item-details.php?details_item_value={$val_items.show_item_id}{if $val_items.coupon_code!='' && $val_items.start_date<=$date_forcheck && $val_items.coupon_status==1 && $val_items.end_date>=$date_forcheck}&d=1{/if}" title="{$val_items.title|ucfirst}">
										<img src="{$baseUrl}getthumb.php?w=103&h=86&fromfile=uploads/{$val_items.image1}" onerror="this.src='{$baseUrl}images/item_small_img.jpg'; this.style.width='103px'; this.style.height='86px';" width="103" height="86" alt="" />
										</a>
										</div>
										<div>
								<a href="item-details.php?details_item_value={$val_items.show_item_id}{if $val_items.coupon_code!=''&& $val_items.coupon_status==1  && $val_items.start_date<=$date_forcheck  && $val_items.end_date>=$date_forcheck}&d=1{/if}"
 title="{$val_items.title|ucfirst}">{$val_items.title|ucfirst|truncate:20}</a><br />
                                                                            <span style="color:red;">
                                                                            {$val_items.cost_item|convert_price}
                                                                            {if $val_items.discount_type==0}
                                                                            {assign var= 'disc_price' value=($val_items.discount_amount/100)*$val_items.cost_item }
                                                                            {else}
                                                                            {assign var= 'disc_price' value=$val_items.cost_item-$val_items.discount_amount }
                                                                            {/if}
                                                                            </span>
<br>
                                                                    {if $val_items.coupon_code!='' && $val_items.coupon_status==1  && $val_items.start_date<=$date_forcheck  && $val_items.end_date>=$date_forcheck}
                                                                    <span style="color:red;font-size:10px;">Discount applicable {*$val_items.disc_price|number_format:2:".":","*}
                                                                    </span>
                                                                    {/if}

				
                                                                <span>{*$val_items.cost_item|convert_price*}</span>
                                                               {if $val_items.hatting_status==1}
                                                                 <fieldset id="set1">
                                                                   {if $smarty.session.session_user_id ==''}
                                                                   <span style='color:#9ac243;'>&nbsp;&nbsp;
                                                                   <label title=" In order to negotiate online for this item on haating ,please log in. " ><b>Haat It </b></label>
                                                                   </span>
                                                                   {else}
                                                                   <span style='color:#9ac243;'>&nbsp;&nbsp;
                                                                   <label title=" Click on the item to negotiate online." ><b>Haat It </b></label>
                                                                   </span>{/if}{literal}<script >
                                                                   <code class="mix">$('#set1 *').tooltip();</code>
                                                                   </script>{/literal}
                                                                 </fieldset>
                                                                {/if}
                                                                {if $val_items.hatting_status!=1}
                                                               <span   style='color:#ffffff;'>&nbsp;&nbsp;<b>Haat It</b> </span>
                                                                {/if}

									  </div>
									</div>
									{if $smarty.foreach.cat.iteration%4==0}
									<div class="clear"></div>
									{/if}{*/if*}
									{/foreach}
									<div class="clear"></div>
									{if $pageLink}
									<div>
									{$page_counter} records&nbsp;&nbsp;&nbsp;
									<span style="float:right;padding-top:5px;height:20px;" class="admn_pagination_msg_board123">{$pageLink}</span>
									</div>
									{/if}
								</div>
							</div>									
						</div>
						<!--End category -->
						{/if}

						<div class="insideitemhd">Payment Mode</div>
						<div class="paymnMathodbdr">
							<div style="position:absolute; top:-15px; left:9px;"><img src="{$baseUrl}images/paypal_logo.jpg" alt="" /></div>								
							<div class="paypalimg"><img src="{$baseUrl}images/paypal_cart.jpg" alt="" /></div>
						</div>
					</div>
					{include file="store_riht_links.tpl"}
					<div class="clear"></div>
				</div>
				<!--End item detail -->		
			</div>
			<div class="gap"></div>
	</div>
</div>
<div class="clear"></div>
<!--End Middle-->
{include file="footer.tpl"}