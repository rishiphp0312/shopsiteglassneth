{include file="header.tpl"}
{include file="js_css_validation.tpl"}
{include file="header_search.tpl"}
		<!--End Logo-->
		<!--Start Middle-->
		<div id="middleMain">

			{include file="left_category.tpl"}
		<!--Start Middle-->


			<div >
			<div id="middleRtMain">
			<div class="insidehd fl"><!--Buyer--></div>
			<div class="clear"></div>
			<div class="buyermain" >
		<form name='frm_email_to_friend' id='frm_email_to_friend'  action='' method='post'>

<div class="insidehd ">Email To Friend </div>
<div class="insidehd ">&nbsp; </div>
<div >

<table align='center' cellpadding='0' cellspacing='0' width='600' border='0'>
<tr>
     <td align='left' class="classbig_blackTiTleTXT" >&nbsp;</td>
     <td>&nbsp;</td>
     <td class="classbig_blackTiTleTXT"  align='left' >&nbsp;</td>
</tr>
<tr>
     <td align='left' class="classbig_blackTiTleTXT" > Friend's Email</td>
     <td>&nbsp;</td>
     <td class="classbig_blackTiTleTXT"  align='left' >Friend's Name</td>
</tr>
<tr>
   <td align='left'><input type='text' value='' style='width:200px;'class="required" name='frinds_email'></td>
   <td>&nbsp;</td>
   <td align='left'><input type='text' value='' style='width:200px;' class="required" name='friend_name'></td>
</tr>
<tr>
   <td colspan='3'>&nbsp;</td>
</tr>
<tr>
     <td align='left' class="classbig_blackTiTleTXT"  >Your's  Email</td>
     <td>&nbsp;</td>
     <td class="classbig_blackTiTleTXT"  align='left'>Your's Name</td>
</tr>
<tr>
   <td align='left'>
   <input type='text' value='' style='width:200px;' class="required" name='yours_email'>
   </td>
   <td>&nbsp;</td>
   <td align='left'><input type='text' value='' class="required" style='width:200px;' name='yours_name'></td>
</tr>
<tr>
   <td colspan='3'>&nbsp;</td>
</tr>
<tr>
   <td colspan='3'class="classbig_blackTiTleTXT"  align='left'>Message</td>
</tr>
<tr>
   <td colspan='3' align='left' ><textarea class="required" name='message_post' rows='5' cols='60'></textarea></td>
</tr>
<tr>
   <td colspan='3'>&nbsp;</td>
</tr><tr>
   <td colspan='3'>&nbsp;</td>
</tr>
<tr> <input type='hidden' value='{$item_name_value}' name='item_name_value'>
<input type='hidden' value='{$details_item_value}' name='details_item_value'>
   <td colspan='3' align='left' ><input type='submit' value='Send ' name='send'></td>
</tr>
<tr>
   <td colspan='3'>&nbsp;</td>
</tr><tr>
   <td colspan='3'>&nbsp;</td>
</tr>
</table>










						</form>	</table>
	</div>

					<!--end page number -->
					</div>
			</div>
			<div class="clear"></div>
		</div>
		<!--End Middle-->
<!--End Middle-->
		{include file="footer.tpl"}