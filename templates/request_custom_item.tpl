{include file="header.tpl"}
{include file="header_search.tpl"}
<!--Start Middle-->
<div id="middleMain">
{include file="js_css_validation.tpl"}

{*include file="left_category.tpl"*}
<!--<div id="middleRtMain">-->
<div>
<!--Start Tab Link-->

<div class="shopmain">
<div style='width:800px;'>
<div style='width:500px;float:left;' ><span class="mainHD"  style='padding-left:2px;'>Edit your Item Detail Request </span></div>
<div style='width:100px;float:right;'><a href='#' onclick='history.go(-1)' >Go Back</a></span></div>
</div>
<div style='width:800px;'>
<div style='width:500px;float:left;'><span class="mainHD" style='padding-left:2px;font-size:12px;color:red;'>This request is for custom handmade items. </span></div>
<div style='width:100px;float:right;'><span style="padding-left:10px;color:red;font-size:10px;font-weight:bold;"> 
			* Required</span></div>
</div>

	<!--Start my items -->
	<div class="myitemmain">
		<div class="myItemtopbg" style=" color:red;font-size:10px;padding-left:1px;" >
		
			<!--start page number -->
		<br>
		
			<!--end page number -->
			<div class="clear"></div>
		</div>
		
		<div class="myiteminsidemain">
		<table width="100%" cellpadding="3" celspacing="3">
		<tr>
		<td >{include file="error_msg_template.tpl"}
		</td></tr>
		<tr>
		<td>
		<form id="frmRequest" name="frmRequest" class="formular" method="post" action="{$baseUrl}request_custom_item.php" enctype="multipart/form-data">
		<table width="630" cellpadding="3" celspacing="3">
		
		<tr>
			<td style="width:150px; font-weight:bold;font-size:13px; vertical-align:top;padding:8px;">Title<span style="color:red;">*</span> </td>
			<td style="width:350px"> <input type="text" name="title"  value="{$title}" class="formInput required"></td>
			<td>&nbsp;</td>
		</tr>
		
		<tr>
			<td  style="width:150px; font-weight:bold;font-size:13px; vertical-align:top;padding:8px;">Ideal Price<span style="color:red;">*</span> </td>
			<td style=""><input type="text" name="price" value="{$price}" class="formInput required alph_num" >USD</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td  style="width:150px; font-weight:bold;font-size:13px; vertical-align:top;padding:8px;">Quantity <span style="color:red;">*</span></td>
			<td style=""><input type="text" name="quantity" value="{$quantity}" class="formInput required alph_num"></td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td  style="width:150px;font-weight:bold;font-size:13px; vertical-align:top;padding:8px;">Deadline <span style="color:red;">*</span></td>
			<td style="">
			{html_select_date month_format="%b" start_year=2010 end_year=2012 field_order="DMY" time="$v_fdt"}
			<!--<input type="text" name="deadline" value="{$deadline}" class="formInput required alph_num">--></td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td style="width:150px;font-weight:bold;font-size:13px; vertical-align:top;padding:8px;">Description <span style="color:red;">*</span></td>
			<td style=""><textarea name="description" rows="7" cols="56" class="formInput required ">{$description}</textarea></td>
		</tr>
		<tr>
			<td style="width:150px;font-weight:bold;font-size:13px; vertical-align:top;padding:8px;">Tags <span style="color:red;">*</span></td>
			<td style=""><textarea name="tags" rows="4" cols="56" class="formInput required ">{$quantity}</textarea></td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td style="width:150px;font-weight:bold;font-size:13px; vertical-align:top;padding:8px;">Materials <span style="color:red;">*</span></td>
			<td style=""><textarea name="material" rows="4" cols="56" class="formInput required ">{$material}</textarea></td>
			<td>&nbsp;</td>
		</tr>
		{if $requestid==''}
		<tr>
		  <td style="width:150px;font-weight:bold;font-size:13px; vertical-align:top;" >Attach File </td>
		  <td align="left" valign="top" style="padding:11px;"><input type='file' value='' name='attach_file'><br>
			 <span style="color:red;"> Please upload only .jpg,.gif,.txt,.xls,.doc,.png,.pdf files only.</span></td>
		  <td>&nbsp;</td>
		  </tr>
		  {/if}
		<tr>
			<td style="width:150px;font-weight:bold;font-size:13px; vertical-align:top;" >Image <span style="color:red;">*</span></td>
			<td style="padding:11px;"><input type="file" name="image1" ><input type="hidden" name="hid" value="{$sellerid}" ><input type="hidden" name="reqhid" value="{$requestid}" ><input type="hidden" name="hidimage" value="{$image1}" ><!--<input type="file" name="image2" ><br><br><input type="file" name="image3"  >--><br />
			 <span style="color:red;">Please upload only .jpg,.gif,.png files only.</span></td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td  style="width:150px;font-weight:bold;font-size:15px; vertical-align:top;padding:8px;" colspan="2">Address <span style="color:red;">*</span></td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td  style="width:150px;font-weight:bold;font-size:13px; vertical-align:top;padding:8px;">Full Name<span style="color:red;">*</span></td>
			<td style=""><input type="text" name="fullname" value="{if $f_name==""} {$fullname}{else}{$f_name} {$l_name}{/if}" style="border:1px solid #ffffff;" class="formInput required " readonly="true"></td>
			<td>&nbsp;</td>
		</tr>	
		<tr>
			<td  style="width:150px;font-weight:bold;font-size:13px; vertical-align:top;padding:8px;">Street<span style="color:red;">*</span></td>
			<td style=""><input type="text"  style="border:1px solid #ffffff;" name="street" readonly="true" value="{if $street!=''}{$street}{else}N/A{/if}" class="formInput required "></td>
			<td>&nbsp;</td>
		</tr>	
		<tr>
			<td  style="width:150px;font-weight:bold;font-size:13px; vertical-align:top;padding:8px;">City<span style="color:red;">*</span></td>
			<td style=""><input type="text" style="border:1px solid #ffffff;" name="city" readonly="true" value="{$city}" class="formInput required "></td>
			<td>&nbsp;</td>
		</tr>	
		<tr>
			<td  style="width:150px;font-weight:bold;font-size:13px; vertical-align:top;padding:8px;">State<span style="color:red;">*</span></td>
			<td style=""><input type="text" name="state" style="border:1px solid #ffffff;" readonly="true" value="{$state}" class="formInput required "></td>
			<td>&nbsp;</td>
		</tr>	
		<tr>
			<td  style="width:150px;font-weight:bold;font-size:13px; vertical-align:top;padding:8px;">Zip Code<span style="color:red;">*</span></td>
			<td style=""><input type="text" name="zipcode" style="border:1px solid #ffffff;" readonly="true" value="{$zipcode}" class="formInput required alph_num"></td>
			<td>&nbsp;</td>
		</tr>	
		<tr>
			<td  style="width:150px;font-weight:bold;font-size:13px; vertical-align:top;padding:8px;">Country<span style="color:red;">*</span></td>
			<td style="">
				<select  class="formSel" name="country_value" style="border:1px solid #ffffff;" disabled="disabled" id="country_value">
				{html_options values=$countryID output=$countryName selected=$country_value}
				</select><input type="hidden" value="{$country_value}" name="country_value_hid" />		</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td  style="width:150px;font-weight:bold;font-size:13px; vertical-align:top;padding:8px;"></td>
			<td style="">{if $requestid == "" }<input name="btnRegister" type="submit" value="Submit" class="btn" />{else}<input name="btnRegister" type="submit" value="Update" class="btn" />{/if}</td>
			<td>&nbsp;</td>
		</tr>
		</table>
		</form>
		</td>
		{if $requestid == "" }
		<td style="vertical-align:top;">{include file="store_riht_links.tpl"}</td>
		{/if}
		</tr>
		</table>
		</div>
		<div class="myItemtopbg">
			
			<!--start page number -->
			<div class="bradcrum" style="padding:0px;">
				
			</div>
			<!--end page number -->
			<div class="clear"></div>
		</div>
	</div>	
	<!--End my items -->
</div>
</div>
<!--</div>-->
<div class="clear"></div>
</div>
<!--End Middle-->
{include file="footer.tpl"}