{include file="header.tpl"}
{include file="js_css_validation.tpl"}
{include file="header_search.tpl"}

{literal}
<SCRIPT language="JavaScript1.2">
function confirm_msg(id, parent_id)
{
	var message = "Do you really want to delete this image?";
	//if(id==0)
	//{
	//	message += "\n This action also delete all child categories associated with this.";
	//	jAlert("You can not delete a parent category.",'Error');
	//	return false;	
	//}
	jConfirm(message, 'Confirm', function(r) 
	{
		if(r)
		{
			location.href='upload_imgage.php?unlink_this_img='+id+'&col_position='+parent_id;
		}
		else
		{
			return false;
		}	
	});
}


</SCRIPT>
			
{/literal}	
		<!--End Logo-->
		<!--Start Middle-->
		<div id="middleMain">
			
				
				{include file="left_category.tpl"}
		
		<!--Start Middle-->
		<div id="middleMain">
			
			<div id="middleRtMain" >
				<div>
				<div class="mainHD">Sell an Item</div>
				<div class="fr" style='padding-right:10px;font-weight:bold;' ><a href='#my_account.php' onclick='history.go(-1)'>Go Back</a></div>
			<div class="clear"></div>
					<!--start top tab-->
					<div>
					
						<span class="selItemtabinactive">Item Details </span>
						
						<span class="selItemtabative" >
						<a href='{$baseUrl}upload_imgage.php{if $item_id_value!=''}?item_id_value={$item_id_value}{/if}'>Upload Images</a> 
						</span>
						<span class="selItemtabinactive">Shipping Info</span>
	        				<span class="selItemtabinactive">Review &amp; Post </span>
						<!--	<span class="selItemtabinactive">
						<a href='#{$baseUrl}review-post.php'>Review &amp; Post</a> </span>-->
						<div class="clear"></div>
					</div>
					<!--End top tab-->
					<!--Start inside part -->
                                       <div class="sellItemmian" style='font-size:12px;text-align:left;color:red;font-family:arial;border-bottom:0px solid;'>
                                      <span style='color:#000000;'> Note&nbsp;:&nbsp;</span>Please Upload image to go further...</div>
						<!--Start find image -->
					<div class="sellItemmian">
						<!--Start find image -->
				<form name='frm_img_upload' action='' method='post' enctype='multipart/form-data'>
<div class="uploadhd" style='padding-top:0px;'><strong>Upload Images</strong>
<input type='hidden' value='{$item_id_value}' name='item_id_value'></div>
Use .jpg, .gif or .png files only and total size of all files should not be larger than 2MB or 2000KB .
Images around 1,000 pixels wide work best.<br /><br />
						<div class="browsbsection"><input name="upload_img_1" type="file" class="browsbtn" />
						<input type='hidden' name='removeimage1' value='{$showimage1}'></div>
						<div class="browsbsection"><input name="upload_img_2" type="file" class="browsbtn" />
                                                    <input type='hidden' name='removeimage2' value='{$showimage2}'></div>
						<div class="browsbsection"><input name="upload_img_3" type="file" class="browsbtn" />
                                                    <input type='hidden' name='removeimage3' value='{$showimage3}'></div>
						<div class="browsbsection"><input name="upload_img_4" type="file" class="browsbtn" />
                                                    <input type='hidden' name='removeimage4' value='{$showimage4}'></div>
						<div class="browsbsection"><input name="upload_img_5" type="file" class="browsbtn" />
                                                       <input type='hidden' name='removeimage5' value='{$showimage5}'></div>
						<!--End find image -->	
						<div class="uploadhd"><strong><!--Upload.--></strong></div>	
						<input name="text" type="submit" value="Upload"  class="Class_Button_ris"  />
					</form>
						<!--start your image -->
						<div class="uploadhd"><strong>Your Images</strong></div>
						<div class="yourImbmain">
							<div class="yourImgbox">
<img src="{if $showimage1!=''}{$baseUrl}getthumb.php?w=150&h=50&fromfile=uploads/{$showimage1}{else}images/no_img.jpg{/if}"  alt="" height='50'  class="yourImg"/>
                  <br>{if $showimage1!=''} <a onclick="confirm_msg({$item_id_value}, '1');" href='#upload_imgage.php?unlink_this_img={$item_id_value}&&col_position=1'>Remove</a>{/if}</div>
							<div class="yourImgbox"><img src="{if $showimage2!=''}{$baseUrl}getthumb.php?w=150&h=50&fromfile=uploads/{$showimage2}{else}images/no_img.jpg{/if}"  height='50'  alt=""  class="yourImg"/><br>{if $showimage2!=''}<a onclick="confirm_msg({$item_id_value}, '2');" href='#upload_imgage.php?unlink_this_img={$item_id_value}&&col_position=2'>Remove</a>{/if}</div>
							<div class="yourImgbox"><img src="{if $showimage3!=''}{$baseUrl}getthumb.php?w=150&h=50&fromfile=uploads/{$showimage3}{else}images/no_img.jpg{/if}"  height='50' alt=""
							class="yourImg"/><br>{if $showimage3!=''}<a onclick="confirm_msg({$item_id_value}, '3');"
							href='#upload_imgage.php?unlink_this_img={$item_id_value}&&col_position=3'>Remove</a>{/if}</div>
							<div class="yourImgbox">
							<img src="{if $showimage4!=''}{$baseUrl}getthumb.php?w=150&h=50&fromfile=uploads/{$showimage4}{else}images/no_img.jpg{/if}"  height='50' alt=""
							class="yourImg"/><br>{if $showimage4!=''}<a onclick="confirm_msg({$item_id_value}, '4');" 
							href='#upload_imgage.php?unlink_this_img={$item_id_value}&&col_position=4'>Remove</a>{/if}</div>
							<div class="yourImgbox">
							<img src="{if $showimage5!=''}{$baseUrl}getthumb.php?w=150&h=50&fromfile=uploads/{$showimage5}{else}images/no_img.jpg{/if}"
							height='50'alt=""  class="yourImg"/><br>{if $showimage5!=''}<a onclick="confirm_msg({$item_id_value}, '5');" 
							href='#upload_imgage.php?unlink_this_img={$item_id_value}&&col_position=5'>Remove</a>{/if}</div>
							
							<div class="clear"></div>
						</div>
						<!--end your image -->	
					</div>	
					<!--End inside part -->
				</div>
				<div align="right">
				{if $prev_next_id_value!=''&& $no_image_upload!=1 }
				<a href="sell-an-item.php?item_id_value={$prev_next_id_value}">
				<img src="images/previous_btn.jpg" alt="" hspace="5" vspace="8px" border="0" />
				</a><a href="shipping_module_item.php?item_id_value={$prev_next_id_value}">
				<img src="images/next_btn.jpg" alt="" vspace="8" border="0" /></a>
				{else}
				&nbsp;

				{/if}
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<!--End Middle-->
		{include file="footer.tpl"}