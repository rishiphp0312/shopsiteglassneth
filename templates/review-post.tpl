{include file="header.tpl"}
{include file="js_css_validation.tpl"}
{include file="header_search.tpl"}
		<!--End Logo-->
		<!--Start Middle-->
		<div id="middleMain">
			
				
				{include file="left_category.tpl"}
				
			
		<!--Start Middle-->
		<div id="middleMain">
			
			<div id="middleRtMain">
				<div>
				<div class="mainHD">Sell an Item</div>
				<div class="fr" style='padding-right:10px;font-weight:bold;' ><a href='#my_account.php' onclick='history.go(-1)' >Go Back</a></div>
			<div class="clear"></div>
					<!--start top tab-->
					<div>
						<span class="selItemtabinactive">Item Details</span>
						<span class="selItemtabinactive" >Upload Images </span>
						<span class="selItemtabinactive">Shipping Info</span>
						<span class="selItemtabative"><a href='#{$baseUrl}review-post.php'>Review &amp; Post</a> </span>
						<div class="clear"></div>
					</div>
					<!--End top tab-->
					<!--Start inside part -->
					<form name='frm' action='' method='post'>
					<div class="sellItemmian">
						<!--start review box -->
						<!--<div class="uploadhd"><strong>Review &amp; Post </strong></div>
						-->
						<!--<div class="reviwbox">
							 <strong>This listing will cost a non-refundable fee of $0.40.</strong><br />
							 By clicking Finish you agree to pay this listing fee.<br /><br />
							 Your listing will not be live on Etsy until you click Finish. It may take up to 24 hours for newly listed items to appear in Categories and Search.
						
						</div>-->
						<!--end review box -->
						<!--Start revie inside -->
						<div class="sellLabletext"><span>Item name
</span><br />
						</div>
						<div class="selllablefield">&nbsp;{if $title_value!=''}{$title_value|ucfirst}{else}NA{/if}</div>
						<div class="sellLabletext"><span>Item Detail</span><br />						
						</div>
						<div class="selllablefield">&nbsp;{if $description_value!=''}{$description_value}{else}NA{/if}</div>
						<div class="sellLabletext"><span>Item Contents</span><br />						
						</div>
						<div class="selllablefield">&nbsp;{if $material_used_value!=''}{$material_used_value}{$material_used_value}{else}NA{/if}</div>
						<div class="sellLabletext"><span>Care</span><br />
						
						</div>
						{$care}
						<div class="selllablefield">&nbsp;{if $care!=''}{$care}{else}NA{/if}</div>
						<div class="sellLabletext"><span>Category</span><br />
						</div>
						<div class="selllablefield">
						{if $subCatgeoryName!=''}{$subCatgeoryName}{else}NA{/if}</div>
						<div class="pricelableText"><strong>Price:</strong></div>
						<div class="pricelable">{if $cost_item_value!=''}{$USD} {$cost_item_value|number_format:2:".":","}  (each){else}NA{/if}
						</div>
						<div class="clr"></div>
						<div class="pricelableText" style='width:120px;border:0px solid red;' ><strong>Available Quantity :</strong></div>
						<div class="pricelable" style='width:200px;border:0px solid red;' >{$max_item_value}
						</div>
						<div class="clr"></div>
						
						
						<div class="sellLabletext"><span>Minimum quantity for notification.</span>&nbsp;&nbsp;&nbsp;{$inventory_alert_value} </div><br />
					        <!--<div class="pricelableText"><strong>Minimum quantity for notification :</strong></div>-->
						<div class="pricelable"> <input type="hidden" name="locker" value="{$locker_status}">
						</div>
						<div class="clr"></div>	
						 <!--<div class="sellLabletext"><span>&nbsp;</span>&nbsp;&nbsp;&nbsp;
						</div><br />
					       <div class="pricelableText">ion :</strong></div>-->
						<div class="pricelable"> <input type='submit' value='Save'  class="Class_Button_ris" name='Save'>
						</div>
						<div class="clr"></div>	
						<!--End revie inside -->	
					</div>
					</form>
					<!--End inside part -->
				</div>
				<div align="right">
				<a href="shipping_module_item.php?item_id_value={$item_id_value}">
				<img src="images/previous_btn.jpg" alt="" hspace="5" vspace="8px" border="0" />
				</a>
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<!--End Middle-->
		{include file="footer.tpl"}