{include file="header.tpl"}
{include file="js_css_validation.tpl"}
{include file="header_search.tpl"}
<script language="javascript" type="text/javascript">
{literal}
function selectSubCategories(parent_id)
{
   $("#respDiv").html("<img src='images/icon_loading.gif' alt='Please wait' />");
   $.ajax({
   type: "POST",
   url: "advanced_serch.php",
   data: "parent_id="+parent_id,
   success: function(response_data)
   {
     //alert( "response_data: " + response_data );
     $("#respDiv").html(response_data);
   }
 });

}
{/literal}
</script>
<!--Start Middle-->
<div id="middleMain">
{include file="left_category.tpl"}
<div id="middleRtMain">
	<div class="registerBg">
	<div class="registerSUbHd">Advanced Search</div>
	<form name="frm_adv_search" id="frm_adv_search" action="advanced_srch_results.php" method="get">
	<table align="center" cellpadding="3" cellspacing="2" border="0" width="80%">
	<tr>
	  <td width="23%" align="right" valign="top">Category</td>
	  <td width="3%" align="center" valign="top"><b>:</b></td>
	  <td width="74%" align="left" valign="top">
	  <select  class="input" name="parent_id" style="width:184px;" onchange="selectSubCategories(this.value);">
	  <option value="0">-- Select Category --</option>
	  {html_options values=$parentID output=$parentNAME selected=$category_id_value}
	  </select>
	  </td>
	</tr>
	<tr>
	  <td align="right" valign="top">Sub Category</td>
	  <td align="center" valign="top"><b>:</b></td>
	  <td align="left" valign="top" id="respDiv">
	  <select  class="input" name="category_id" style="width:184px;">
	  <option value="0">-- Select Sub Category --</option>
	  {*html_options values=$parentID output=$parentNAME selected=$category_id_value*}
	  </select>
	  </td>
	</tr>
	<tr>
	  <td align="right" valign="top">Color</td>
	  <td align="center" valign="top"><b>:</b></td>
	  <td align="left" valign="top"><input style="width:180px;" class="input" type='text' value='' name='color'></td>
	</tr>
	<tr>
	  <td align="right" valign="top">Price Range (USD)</td>
	  <td align="center" valign="top"><b>:</b></td>
	  <td align="left" valign="top"><input class="input" style="width:75px;" type='text' value='' name='cost1'>&nbsp;&nbsp;to&nbsp;&nbsp; <input class="input" style="width:75px;" type='text' value='' name='cost2'></td>
	</tr>
	<tr>
	  <td align="right" valign="top">Keywords</td>
	  <td align="center" valign="top"><b>:</b></td>
	  <td align="left" valign="top"><input class="input"  type='text' value='' style="width:180px;" name='Keywords'></td>
	</tr>
	<tr>
	  <td align="right" valign="top">Country</td>
	  <td align="center" valign="top"><b>:</b></td>
	  <td align="left" valign="top">
	  <select class="input" style="width:184px;" name="country_value" id="country_value">
	  <option value="0">-- Select Country --</option>
	  {html_options values=$countryID output=$countryName selected=$country_value}
	  </select>
	  </td>
	  </tr>
<tr>
	  <td align="right" valign="top">Shipping  Country</td>
	  <td align="center" valign="top"><b>:</b></td>
	  <td align="left" valign="top">
	  <select class="input" style="width:184px;" name="scountry_value" id="scountry_value">
	  <option value="0">-- Select Country --</option>
	  {html_options values=$countryID output=$countryName selected=$country_value}
	  </select>
	  </td>
	  </tr>
	<tr>
	  <td align="right" valign="top">Style</td>
	  <td align="center" valign="top"><b>:</b></td>
	  <td align="left" valign="top">
	  <select name="style_id" style="width:184px;" class="input">
	  <option value="0">-- Select Style --</option>
	  {html_options values=$styleId output=$styleNAME|ucfirst}
	  </select> </td>
	</tr>
	<tr>
	  <td align="right" valign="top"></td>
	  <td align="right" valign="top"></td>
	  <td align="left" valign="top"><input class='Class_Button_ris' type="submit" value="Search" name="Search"></td>
	  </tr>
	  </tr>
	</table>
	</form>
	</div>
		</div>
		<div class="clear"></div>
	</div>
<!--End Middle-->
{include file="footer.tpl"}