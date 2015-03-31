{include file="header.tpl"}
{include file="js_css_validation.tpl"}

<!-- Jquery Fancy Box -->
<link rel="stylesheet" type="text/css" href="{$baseUrl}fancybox/jquery.fancybox-1.2.6.css" media="screen" />
<script type="text/javascript" src="{$baseUrl}fancybox/jquery.fancybox-1.2.6.pack.js"></script>
<script type="text/javascript" src="js/jquery/jquery-ui-1.7.1.custom.min.js"></script>
  <script language="JavaScript" src="calendar_us.js"></script>
{include file="header_search.tpl"}
<!--End Logo-->
<!--Start Middle-->
<!--rishi--><div id="middleMain">
{include file="left_category.tpl"}
{literal}
               
     
	<link rel="stylesheet" href="calendar.css">
<SCRIPT language="JavaScript1.2">
  
function confirm_msg(id, parent_id)
{
	var message = "Do you really want to delete this item?";
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
			location.href='my-haating-items-list.php?delete_item_value='+id;
		}
		else
		{
			return false;
		}	
	});
}




$(document).ready(function()
{
	
	$("a.item_quantity").fancybox({
	'hideOnContentClick': false,
	'frameWidth'			: 255,
	'frameHeight'			: 100		
	});
});







	</script>			
{/literal}			

<div id="middleRtMain">
	<div class="shopmain">
				<div class="mainHD fl" >Assign Coupon</div>
				<div class="fr" style='padding-right:10px;padding-top:5px;font-weight:bold;' ><a href='#my_account.php'  onclick='history.go(-1)'>Go Back</a></div>
				<div class="clear">
					<!--Start my items -->
					
					<div class="myitemmain"  >
					
					<form name="frmgenrate_coupon" id='frmgenrate_coupon' action='' method='post' >

						<div class="myItemtopbg" >
							<div class="titlelf" > 
							<!--<a href='my-haating-items-list.php?order_by={$title_asc}'><img src='images/arrow_top.gif'></a>&nbsp;
				<a href='my-haating-items-list.php?order_by={$title_desc}'><img src='images/arrow_btm.gif'></a> 
	--></div>
							
							<div class="itemlf"   >
			
							</div>
							<div class="itemleftlf"  style='width:200px;'>
							
							<!--<a href='my-haating-items-list.php?order_by=
							{$quantity_available_asc}'>
							<img src='images/arrow_top.gif'></a>&nbsp;
			<a href='my-haating-items-list.php?order_by={$quantity_available_desc}'>
							<img src='images/arrow_btm.gif'></a>
							<br><br>
							<a href='#'>Send it in Hatting</a>-->
							<!--quantity_available -->
							</div>
							<div class="costlf" >&nbsp;</div>
							<div class="clear"></div>
						</div>
						<div  >
					<div class="titlelf" style='font-weight:bold;' >Coupon Code
							</div>
							
							<div class="itemlf" style='color:red;' >{$coupon_code_str}
							<input type='hidden' value='{$coupon_code_str}'
							name='coupon_code_str'
							 />
							</div>
							<div class="itemleftlf"  style='width:200px;'>
							&nbsp;
							</div>
							<div class="costlf" >&nbsp;</div>
							<div class="clear"></div>
						</div>
						
						<div  style='border:0px solid red;width:620px;'  >
					<div class="titlelf" style='font-weight:bold;float:left;width:250px;' >
					Start Date&nbsp;&nbsp;
<input type="text" name="testinput" id='testinput' />
						  {literal}
	<script language="JavaScript">
	var o_cal = new tcal ({
		// form name
		'formname': 'frmgenrate_coupon',
		// input name
		'controlname': 'testinput'
	});
	
	// individual template parameters can be modified via the calendar variable
	o_cal.a_tpl.yearscroll = false;
	o_cal.a_tpl.weekstart = 1;
	
	</script>
		 {/literal}
							
						

				</div>			
							<div class="itemleftlf"  style='width:300px;font-weight:bold;float:right;'>
							End Date &nbsp;
							<input type="text" name="testinput2" id="myOtherInput" class='required' />
						&nbsp; {literal}
	<script language="JavaScript">

	// whole calendar template can be redefined per individual calendar
	var A_CALTPL = {
		'months' : ['Jannuary', 'Febraury', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
		'weekdays' : [ 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa','Su'],
		'yearscroll': true,
		'weekstart': 0,
		'centyear'  : 70,
		'imgpath' : 'img/'
	}
	
	new tcal ({
		// if referenced by ID then form name is not required
		'controlname': 'myOtherInput'
	}, A_CALTPL);
	</script>
		 {/literal} 	</div>
							<div class="costlf" >
				
							
							</div>
							<div class="clear"></div>
						</div>
						<div>
						&nbsp;
						</div>
						
						<div  >
					<div class="titlelf" style='font-weight:bold;' >Discount Type
							</div>
							
							<div class="itemlf" >
 <input checked type='radio' value='0' name='rad_discout'>In percent&nbsp;
                    <input type='radio' value='1' name='rad_discout'>&nbsp;In USD
							</div>
							<div class="itemleftlf"  style='width:200px;'>
							&nbsp;
							</div>
							<div class="costlf" >&nbsp;</div>
							<div class="clear"></div>
						</div>
						<div  >
					<div class="titlelf" style='font-weight:bold;' >Discount Amount
							</div>
							
							<div class="itemlf" ><input type='text'	value='' name='amount' class='required'>&nbsp;
							</div>
							<div class="itemleftlf"  style='width:200px;'>
							&nbsp;
							</div>
							<div class="costlf" >&nbsp;</div>
							<div class="clear"></div>
						</div>
						
						<div  >
					<div class="titlelf" style='font-weight:bold;' >Select Items 
					</div>
							
					<div class="itemlf" >
                                         <select style='font-size:11px;width:130px;'class='required'  name='available_items[]' id='available_items' MULTIPLE  size='10'>
                                         <option value='0'>--select--</option>
					  {foreach name=cat from=$item_details_value  item=val_items}
					     {if $val_items.title!=''}
					<option value='{$val_items.item_id}'>{$val_items.title|ucfirst}</option>
					     {/if}
					   {/foreach}
					 </select>
					</div>

					<div class="itemleftlf"  style='width:200px;'>
					 </div>
					<div class="costlf" >&nbsp;</div>
					<div class="clear"></div>
					<div class="itemleftlf"  style='width:200px;'>
					 </div>
					<div class="costlf" >&nbsp;</div>
					<div class="clear"></div>
					</div>
						
					<div  >
					<div class="titlelf" style='font-weight:bold;' >Select  UserName
					</div>
							
					<div class="itemlf" ><select style='font-size:11px;width:130px;'  
					name='user_ids_forcoupon[]' MULTIPLE  size='10'>
                                        <option value='0'>--select--</option>
					{foreach name=cat from=$user_details_value  item=val_items}
                                        {if $val_items.id!=''}
					<option value='{$val_items.id}'>{$val_items.username}</option>
					 {/if}
					{/foreach}
					</select>
					</div>

					<div class="itemleftlf"  style='width:200px;'>
					 </div>
					<div class="costlf" >&nbsp;</div>
					<div class="clear"></div>
					<div class="itemleftlf"  style='width:200px;'>
					 </div>
					<div class="costlf" >&nbsp;</div>
					<div class="clear"></div>
		
					</div>
						
					<div >
					<div class="titlelf" style='font-weight:bold;' >Email Id 
					</div>
							
					<div class="itemlf" >
					<input type='text' value='' name='email_id'>
					</div>

					<div class="itemleftlf"  style='width:200px;'>
					 </div>
					<div class="costlf" >&nbsp;</div>
					<div class="clear"></div>
					<div class="itemleftlf"  style='width:200px;'>
					 </div>
					<div class="costlf" style='width:480px;text-align:left;padding-top:5px;' >
					<input type='submit' name='add_value' value='Add' style='width:100px;font-size:12px;font-weight:bold;background-color:#7E354D;border:1px solid #7E354D;cursor:pointer;color:#ffffff;' 
					name='Add'></div>
					<div class="clear"></div>
					</div>
			
				
						
						</form>
						
						
						
					
						<div class="itemimgbox" style='width:690px;'>
						{*$page_counter*}<!-- records-->&nbsp;&nbsp;&nbsp;&nbsp;<span style="float:right;">
						{*$pageLink*}</span>
							<div class="clear"></div>
							</div>
							
							<div class="itemimgbox" 
							style='color:red;font-size:14px;width:690px;'>
					<!--	No records found!!--></span>
							<div class="clear"></div>
							</div>
							
	
							<div class="clear"></div>
						</div>
						
					
					</div>	
					
				<!--End my items -->
				
				
			</div>
			</div>
			<div class="clear"></div>
		</div>
		<!--End Middle-->
{include file="footer.tpl"}
