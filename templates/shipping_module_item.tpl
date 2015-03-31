{include file="header.tpl"}
{include file="js_css_validation.tpl"}
{include file="header_search.tpl"}
<!-- Jquery Fancy Box -->
<link rel="stylesheet" type="text/css" href="{$baseUrl}fancybox/jquery.fancybox-1.2.6.css" media="screen" />
<script type="text/javascript" src="{$baseUrl}fancybox/jquery.fancybox-1.2.6.pack.js"></script>
<script type="text/javascript" src="js/jquery/jquery-ui-1.7.1.custom.min.js"></script>
<script language="javascript" type="text/javascript">
{literal}
$(document).ready(function()
{
	$("a.item_quantity").fancybox({
	'hideOnContentClick': false,
	'frameWidth'			: 355,
	'frameHeight'			: 200
	});
});
{/literal}
</script>
		<!--End Logo-->
		
		{literal}
		<script language="javascript">
		function allow_ship_country()
		{var allow_row_ship_d = document.getElementById('allow_row_ship');
			
			//alert("div--"+divNum);
			if(document.getElementById('chk_rest_countries').checked == true)
  			allow_row_ship_d.style.display='';
  			else
			allow_row_ship_d.style.display='none';
  			
			//d.removeChild(olddiv);
		}
		
		
	//	var static int count_val;
		var count_val=0;
		function removeElement(divNum)
		{
			//alert("div--"+divNum);
  			var d = document.getElementById('myDiv');
  			var olddiv = document.getElementById('my'+divNum+'Div');
  			d.removeChild(olddiv);
		}
		
		function addElement()
		{
			//static int count_val=0;
			var ni = document.getElementById('myDiv');
			var numi = document.getElementById('theValue');
			var num = (document.getElementById('theValue').value-1)+ 2;
			var w = document.ship_info.country_value.selectedIndex;
			var country_id_sel = document.getElementById('country_value').value;
			var selected_text  = document.ship_info.country_value.options[w].text;
			numi.value = num;
			var newdiv = document.createElement('div');
			var divIdName = 'my'+num+'Div';
			newdiv.setAttribute('id',divIdName);
			//alert('num=='+num);
			if(num>0)
			document.getElementById('chk_allow_rest_row').style.display='';
             
					    //newdiv.setAttribute('style','background-color:red;border:0px solid red;');
		
			//alert('numnum'+document.getElementById('country_id_'+country_id_sel));

        		if(document.getElementById('country_id_'+country_id_sel)=='[object]'|| document.getElementById('country_id_'+country_id_sel)=='[object HTMLInputElement]')
			{
				alert('Country '+selected_text+' already added, please select another country.');
				return false;;
			}		
	
			var HTML_TXT="<div><table align='left' width='100%' border='1' cellpadding='1' cellspacing='1'><tr><td colspan='5' >&nbsp;</td></tr>";
                        HTML_TXT="<tr><td valign='top' align='left' id='show_country_name_'"+num+" width='20%' >"+selected_text+"</td><td valign='top' width='18%' align='left'>&nbsp;&nbsp;<input type='text' value='0.0' name='cost_ship[]' style='width:50px;' />&nbsp;<b>USD</b>&nbsp;</td><td valign='top' width='20%' align='left'>&nbsp;&nbsp;<input type='text' name='comment[]' id='comment[]' style='width:250px;' />";
			HTML_TXT +="<input type='hidden' id='country_id_"+country_id_sel+"' value='"+country_id_sel+"' name='country_hid_id[]'>";
			HTML_TXT +="</td>";
			HTML_TXT +="<td width='5%' valign='top' align='left'>&nbsp;&nbsp;<a href='javascript://' onclick='removeElement("+num+")'>Remove</a></td>";
			HTML_TXT +="</tr></table></div>";
                        HTML_TXT +="<div style='clear:both;'>&nbsp;</div>";
			newdiv.innerHTML = HTML_TXT;
			ni.appendChild(newdiv);
		
  		
		}
		
		
		
		function enter_amt_close(VAL)
		{
		    if(VAL==1)
			document.getElementById('div_ship_india').style.display="";
			if(VAL==0)
			document.getElementById('div_ship_india').style.display="none";

		}
		function enter_amt_close1(VAL)
		{
		if(VAL==1)
			document.getElementById('div_ship_international').style.display="";
			if(VAL==0)
			document.getElementById('div_ship_international').style.display="none";

		}

		function inter_div_show()
		{
	// 	alert(document.getElementById('id_chk_value').checked+'=international_div_id');
		if(document.getElementById('id_chk_value').checked==true)
		document.getElementById('international_div_id').style.display="";
		else
		document.getElementById('international_div_id').style.display="none";
		}

		function check_val()
		{
		
			if(document.getElementById('chk_rest_countries').checked == true)
  			{
			if(document.getElementById('ship_allowcost').value=='')
			 {
			 alert('Shipping Cost for rest of the countries cannot be blank.');
			 return false;
			 }		
			}
			
		}

		function lock_per_close()
		{
			document.getElementById('locker_permission').style.display="none";

		}
		function lock_per_open()
		{
			document.getElementById('locker_permission').style.display="block";

		}
		</script>
		{/literal}
				<!--Start Middle-->
				<div  id="middleMain">
		
				 {include file="left_category.tpl"}
			
				
				<div id="middleRtMain" style='border:0px solid red;' >
				
				<div class="mainHD" >
				Shipping Information</div>
				<div class="fr" style='padding-right:10px;font-weight:bold;' >
				<a href='#my_account.php' onclick='history.go(-1)'>Go Back</a></div>
			<div class="clear"></div>
					<!--start top tab-->
					<div>
							{include file='error_msg_template.tpl'}

						<div class="clear"></div>
					</div>
					<div >
						<span class="selItemtabinactive">Item Details </span>
						<span class="selItemtabinactive" >Upload Images</span>

						<span class="selItemtabative">
						<a href='{$baseUrl}shipping_module_item.php{if $item_id_value!=''}?item_id_value={$item_id_value}{/if}'>Shipping Info</a></span>
						<span class="selItemtabinactive">Review &amp; Post </span>
						
						<div class="clear"></div>
					</div>
					<!--End top tab-->
					<!--Start inside part -->
				<form name="ship_info" id="ship_info" method="post" >

					<div class="sellItemmian">
					
					<table align="center" cellpadding="0" cellspacing="0" border="0" width="100%">
					<tr>
                                        <td>
<span style="font-weight:bold;" class="classsmallTiTleTXT"></span>&nbsp;
<a class="item_quantity iframe" href="{$baseUrl}currency_converter.php?details_item_value={$smarty.get.details_item_value}" style='font-size:12px;' ><b>Currency Converter as to convert your currency to USD </b></a>
					      </span></td>
					<td  align="right" colspan="2" valign="top"
					
					style="font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight:700;" ><a href="http://fedex.com/ratefinder/home" target="_blank">Fedex Shipping Calculator</a></td>
					</tr><tr>  
					<td width="33%" align="right" colspan="3" valign="top" 
					
					style="font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight:700;" >&nbsp;</td>
					</tr>
					  <tr>  
					<td width="33%" align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight:700;" >Country&nbsp;:</td>
					<td width="50%" align="left" valign="top" >	<select  style="width:180px;font-size:12px;font-family:Arial, Helvetica, sans-serif;" class="formSel" name="country_value"  id="country_value">{html_options values=$countryID output=$countryName selected=$country_value}</select></td>
					<td width="17%"><input type="button" class="Class_Button_ris"	 value=" Add " name="add"  onclick="addElement();"/></td>
					</tr>
								
					<tr>
					<td></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					</tr>
						
					<tr>
					<td colspan="3" valign="top" align="left" >
					<table  align='left' width='100%' cellpadding='0' cellspacing='2'
					 border="0">
                                        <tr>
                                        <td valign='top' align='left' style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#AC5959;font-weight:700" width='15%' >Country</td>
                                        <td valign='top' width='14%' align='left' style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#AC5959;font-weight:700">Shipping Cost&nbsp;</td>
                                        <td valign='top' width='31%' align='left' style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#AC5959;font-weight:700">Comment&nbsp;</td></tr>
											
	
					<!--<tr id='allow_row_ship'{if $chk_rest_countries==1}
						 style="display:'';" {else} style="display:none;" {/if}>
					<td valign='top' colspan="3" align='left'  >
					<table width="100%" cellpadding="0" cellspacing="0" align="center" border="1">
					  <tr >
                                        <td  valign='top' align='left' style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#AC5959;font-weight:700" width='7%' ></td>
                                        <td valign='top' width='17%' align="right" style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#AC5959;font-weight:700">
										<input type='text' value="{$ship_allowcost}" id="ship_allowcost" name='ship_allowcost' style='width:50px;' />&nbsp;USD&nbsp;
										</td>
                                        <td valign='top' width='30%' align='center' style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#AC5959;font-weight:700;border:0px solid red;"><input type='text' name='ship_allowcomment' id='ship_allowcomment' value="{$ship_allowcomment}" style='width:250px;' />&nbsp;&nbsp;&nbsp;&nbsp;							
										</td></tr>
										  <tr >
                                        <td  valign='top' colspan="3" align='left' style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#AC5959;font-weight:700" width='7%' >&nbsp;</td></tr>
					</table>
					</td></tr>-->					
					</table>
					</td>
					</tr>
					</table>
					
					<div id="myDiv" style="height:auto;overflow:hidden;"> </div>	
					<!--<div id="myDiv" style="height:auto;overflow:hidden;">-->
			
		<table border='0'   align='left' width='100%' cellpadding='2' cellspacing='2'>
		
		
		
		<tr><td colspan="3" align="left"     >
              {if $num_value_details>0}
				{foreach name=cat from=$show_all_options item=val_items}
				<table border='0' align='left' width='100%' cellpadding='1' cellspacing='1'>
				<tr><td colspan='3' >&nbsp;</td></tr>
				<tr><td valign='top' align='left' width='20%' >{$val_items.country}</td>
				<td valign='top' width='18%' align='left'>
                 &nbsp;&nbsp;<input type='text' value='{$val_items.ship_cost_country}' name='cost_ship[]' style='width:50px;' />&nbsp;USD&nbsp;
				</td>
                 <td valign='top' width='20%' align='left'>&nbsp;&nbsp;<input type='text' name='comment[]' id='comment[]' value="{$val_items.comment}" style='width:250px;' /><input type='hidden' id='country_id_{$val_items.country_id}' value='{$val_items.country_id}' name='country_hid_id[]'>
				</td>
                <td width='5%' valign='top' align='left'>&nbsp;&nbsp;<a href='shipping_module_item.php?rem_ship_id={$val_items.ship_id}&item_id_value={$item_id_value}'>Remove</a></td>
                 </tr></table>
				 </td></tr>
				  </table>
				  <div class="clr"></div>
				{/foreach}
				{/if}
				<table border='0' 
				style="padding:0px 0px 0px 0px;border-top:0px;" align='left' width='100%' cellpadding='2' cellspacing='2'>
	    <tr  id='chk_allow_rest_row' {*if $chk_rest_countries==1*} {if $num_value_details>0} style="display:'';" {else}style="display:none;"{/if} >
					<td valign='top' style="padding-top:10px;" align='left'  nowrap="nowrap" >Other Countries.</td>
					<td valign='top' colspan="2" style="padding-top:10px;" width="65%" align='left'>
                      <input type="checkbox" {if $chk_rest_countries==1} checked="checked" {/if}  onclick="return allow_ship_country()" value="1"  name="chk_rest_countries" id='chk_rest_countries' /> &nbsp;{if $chk_rest_countries==1}Please uncheck to remove this.{/if}
					</td></tr>
		<tr  id='allow_row_ship'
		{if $chk_rest_countries==1} style="display:'';" {else} style="display:none;" {/if}>
					<td valign='top' colspan="3" align='left'  >
					<table width="100%"   cellpadding="0" cellspacing="0" align="left" border="0">
					  <tr >
                                        <td  valign='top' align='left' style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#AC5959;font-weight:700" width='5%' ></td>
                                        <td valign='top' width='19%' align="right" style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#AC5959;font-weight:700">
										<input type='text' value="{$ship_allowcost}" id="ship_allowcost" name='ship_allowcost' style='width:50px;' />&nbsp;USD&nbsp;&nbsp;&nbsp;&nbsp;
										</td>
                                        <td valign='top' width='30%' align='center' style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#AC5959;font-weight:700;border:0px solid red;"><input type='text' name='ship_allowcomment' id='ship_allowcomment' value="{$ship_allowcomment}" style='width:250px;' />&nbsp;&nbsp;&nbsp;&nbsp;							
										</td></tr>
										  <tr >
                                        <td  valign='top' colspan="3" align='left' style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#AC5959;font-weight:700" width='7%' >&nbsp;</td></tr>
					</table>
					</td></tr>
		</table>
<!--</div>-->
				<div class="clr"></div>
					
				  </div>	
					
<input type="hidden" value="0" id="theValue" />


						<div class="clr" ></div>
					
						<input type='hidden' value='{$item_id_value}' name='item_id_value'>
						
						
						<div class="clr">
						
						</div>	
						<div class="clr"></div>
						<div class="sellLabletext" style='border:0px solid red;'><input type='submit' class="Class_Button_ris" value='Submit' name='submit' onclick="return check_val();"  ></div><br />
					<div class="sellLabletext" style='border:0px solid red;'>
{if $prev_next_id_value!=''}
				<a href="upload_imgage.php?item_id_value={$prev_next_id_value}">
				<img src="images/previous_btn.jpg" alt="" hspace="5" vspace="8px" border="0" />
				</a>
				<a href="{$baseUrl}review-post.php{if $item_id_value!=''}?item_id_value={$item_id_value}{/if}">
				<img src="images/next_btn.jpg" alt="" vspace="8" border="0" /></a>
				{else}
				&nbsp;
				{/if}</div><br />
					
                        <div class="pricelableText">&nbsp;</div>
						<div class="pricelable">&nbsp;	</div>
						<div class="clr"></div>	
						<div  >
						<input type="hidden" name="locker_id" value="{$reqid}">
						<input type="hidden" name="locker_buyer" value="{$buyerid}">
						<input type="hidden" name="locker_permission" value="1">
						</div>
						
					</div>	
					</form>
					<!--End inside part -->
				</div>
			
			
			<div class="clear"></div>
			</div>
				{include file="footer.tpl"}