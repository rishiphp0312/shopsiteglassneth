{include file="header.tpl"}
{include file="js_css_validation.tpl"}
{include file="header_search.tpl"}

<link rel="stylesheet" type="text/css" href="{$baseUrl}fancybox/jquery.fancybox-1.2.6.css" media="screen" />
<script type="text/javascript" src="{$baseUrl}fancybox/jquery.fancybox-1.2.6.pack.js"></script>

{literal}
<SCRIPT language="JavaScript1.2">
$(document).ready(function()
{
	$("a.locker_password").fancybox({
	'hideOnContentClick': false,
	'frameWidth'			: 455,
	'frameHeight'			: 200		
	});
});

</SCRIPT>
{/literal}	

<div id="middleMain">
{literal}
<script>
function check_val()
{
	var ava_qty = document.getElementById('max_quantity').value;
	var min_qty = document.getElementById('quantity').value;

	alert('ava_qty'+ava_qty);
	alert('min_qty'+min_qty);
	//if(min_qty > ava_qty)
	if(ava_qty < min_qty)
	{
	alert('jcjc')
	alert('Minimum Quantity cannot be greater than Available Quantity!!');
	return false;
	}else
	return true;
}

function upd_function(NUM,VAL)
{
  if(VAL=='b')
    {
	if(NUM==1 )
	{
		document.getElementById('tbl_hid_all_images_banner').style.display="none";
		document.getElementById('tbl_hid_all_upload_banner').style.display="";
	
	}
	if(NUM==2)
	{
		document.getElementById('tbl_hid_all_images_banner').style.display="";
		document.getElementById('tbl_hid_all_upload_banner').style.display="none";
	
	}
	
   }
    if(VAL=='s')
    {
		if(NUM==1 )
		{
		document.getElementById('upload_logo_row').style.display="none";
		}
		else
			{
		document.getElementById('upload_logo_row').style.display="";
		}
		
   }

}
function show_function()
{
	document.getElementById('showdiv').style.display="block";
	document.getElementById('upddiv').style.display="none";
}
</script>
{/literal}
{*include file="left_category.tpl"*}
<!--Start Middle-->
<div id="middleMain">
	<div id="middleRtMain" style="width:100%">
	<div >
	<span class="mainHD">Banner and Logo  Management</span>
		<!--start top tab-->
		<div>
			
			<div class="clear"></div>
		</div>
		
		<!--End top tab-->
		<!--Start inside part -->
	
		
		<div id="upddiv"  class="sellItemmian">
		
		<form  name="frmbanner_logo_upd_new" id="frmbanner_logo_upd_new" method="post" action="" enctype="multipart/form-data" >

		<table cellspacing="2" cellpadding="5" border="0" width="100%">

			<tr>
				<td>{include file='error_msg_template.tpl'}</td>
				<td align="right" style="font-weight:bold">
				
				
				</td>
			</tr>
			<tr>
				<td colspan="2" style="padding:20px;border-color: #D3BCA2 #D3BCA2 -moz-use-text-color;border-style: ridge;">
				<table cellspacing="3" cellpadding="3" border="0">
					
				<tr>
						
						<td align='left'  >
						<table border='0' width='100%'>
						<tr><td align="left" valign="top" >Upload Banner<input onClick="upd_function('1','b')"  type="radio" value="1" name="sel_banner" id="sel_banner" {if $UserRes_array_tpl.sel_banner_status==1}checked="checked"{/if}  >&nbsp;
						Pre Defined Banner
						<input onClick="upd_function('2','b')"  type="radio" 
						{if $UserRes_array_tpl.sel_banner_status==2 || $UserRes_array_tpl.sel_banner_status==0}checked="checked"{/if} value="2" name="sel_banner" id="sel_banner">&nbsp;
						
						</td></tr>
						</table>
					</td>
						<td colspan="2">&nbsp;
						<!--<input type="hidden" name="store_image_upd" value="{$v_store_image}">-->
						</td>
					</tr>
					
		
					
					
			
				<tr id="tbl_hid_all_images_banner" {if $UserRes_array_tpl.sel_banner_status==1} style="display:none;"{/if}  >
				<td colspan="4" align="left" >
					<table align="left" border="0">
					<tr>
				   	<td valign="top">Artisans</td>
				   <td valign="top">
					<input type="radio" {if $UserRes_array_tpl.predefine_banner==1} checked="checked"{/if} value="1" name="banner_val" /></td><td valign="top">
	<img  src="{$baseUrl}getthumb.php?w=300&h=100&fromfile=test-baner/artisans.jpg" /></td>
	               </tr>
					<tr>
				   	<td valign="top">Artists</td>
				   <td valign="top">
					<input type="radio" {if $UserRes_array_tpl.predefine_banner==2} checked="checked"{/if}  value="2" name="banner_val" /></td><td valign="top">
	<img  src="{$baseUrl}getthumb.php?w=300&h=100&fromfile=test-baner/artists.jpg" /></td>
	               </tr>
				   
					<tr>
						<td valign="top">Designers</td>
					<td valign="top">
					<input type="radio" {if $UserRes_array_tpl.predefine_banner==3} checked="checked"{/if}  value="3" name="banner_val" /></td><td valign="top">
	<img  src="{$baseUrl}getthumb.php?w=300&h=100&fromfile=test-baner/designeres.jpg" />
	</td>
	               </tr>
				   
				   
					<tr>	
					<td valign="top">Homemakers</td>
					<td valign="top">					
					<input type="radio" {if $UserRes_array_tpl.predefine_banner==4} checked="checked"{/if}  value="4" name="banner_val" />
					</td><td valign="top" >
                 	<img  src="{$baseUrl}getthumb.php?w=300&h=100&fromfile=test-baner/homemakers.jpg" /></td>
	               </tr>
				   </table>
					
					
					</td>
					
					</tr>
		<tr><td colspan="4">
		{if  $UserRes_array_tpl.sel_banner_status==1} <!-- upload banner-->
		<input type="hidden" value="{$UserRes_array_tpl.banner_name}" name="unlink_banner">
		{/if}
		{if  $UserRes_array_tpl.sel_logo_status==2} <!-- upload logo-->
		<input type="hidden" value="{$UserRes_array_tpl.store_logo}" name="unlink_logo">
		{/if}
		
		
		<input type="hidden" value="{$smarty.session.session_user_name}" name="username"></td>
		</tr>
					
				<tr >
						<td  colspan="2" >
						<span style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#d2a041;">[Note :Banner width should be less than 680px.]</span>
					 </td>
					
						
						
					</tr>
					<tr id="tbl_hid_all_upload_banner" {if $UserRes_array_tpl.sel_banner_status==1} style="display:'';"{else}style="display:none;" {/if}>
						<td  style="vertical-align:top;font-weight:bold">
						Upload Banner &nbsp;<input name="banner_upload" type="file" class="formInput" />&nbsp;
					 </td>
					
						<td align="right"><img src="uploads/{$UserRes_array_tpl.username}/banners/{$UserRes_array_tpl.banner_name}" width="100" height="120" ></td>
						
						
						
					</tr>
					<tr>
						
						<td align='left' colspan="2"  >
						<table  width='100%'  border="0">
						<tr>
						<td align="left" valign="top" >
						Make Current Banner as Logo<input type="radio"
						onClick="upd_function('1','s')"
						  	{if $UserRes_array_tpl.sel_logo_status==1 }checked="checked"{/if} value="1" name="sel_logo" id="sel_logo">&nbsp;Upload logo<input onClick="upd_function('2','s')" type="radio" value="2" 	{if $UserRes_array_tpl.sel_logo_status==2 || $UserRes_array_tpl.sel_logo_status==0}checked="checked"{/if} name="sel_logo" id="sel_logo">&nbsp;
					</td>	
						<td >&nbsp;</td>	</tr>
						<tr id='upload_logo_row'{if $UserRes_array_tpl.sel_logo_status==2} style="display:'';"{else}style="display:none;" {/if}  >
						<td style="vertical-align:top;font-weight:bold">Upload Logo 	&nbsp;&nbsp;&nbsp;<input name="logo_upload" type="file" class="formInput" /></td>
						<td align="right" ><img src="uploads/{$UserRes_array_tpl.username}/store_logos/{$UserRes_array_tpl.store_logo}" 
						width="100" height="120" >
										</td>
										<td >&nbsp;</td>
					
					    </tr>
						</table>
					</td>
						
					</tr>
					
					
					

				</table>
				</td>
			</tr>
			<tr><td colspan="2" align="left"><input type="submit" class='Class_Button_ris' name="submit" value="Update"></td></tr>
		</table>
		
		</form>
		</div>
		
		<!--End inside part -->
	</div>
						<div align="right">
						
						{if $item_id_value!=''}
	
	<a href="upload_imgage.php?item_id_value={$item_id_value}">
	<img src="images/next_btn.jpg" alt="" vspace="8" border="0" /></a>
	{else}
	&nbsp;
	{/if}
		
		
	<!--	</div>

	</div>

	

	</div>

</div>
<div class="clear"></div>
</div>
{*include file="footer.tpl"*}-->
</div>
</div>
<div class="clear"></div>
</div>

{include file="footer.tpl"}

{if $onload && $onload!=""}
<script language="javascript" type="text/javascript">
{$onload}
</script>
{/if}