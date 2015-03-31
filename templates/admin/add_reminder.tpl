{include file="header.tpl"}
{include file="js_css_validation.tpl"}

<!-- Jquery Fancy Box -->
<link rel="stylesheet" type="text/css" href="{$baseUrl}fancybox/jquery.fancybox-1.2.6.css" media="screen" />
<script type="text/javascript" src="{$baseUrl}fancybox/jquery.fancybox-1.2.6.pack.js"></script>
<script type="text/javascript" src="js/jquery/jquery-ui-1.7.1.custom.min.js"></script>

{include file="header_search.tpl"}
<!--End Logo-->
<!--Start Middle-->
<!--rishi--><div id="middleMain">
{include file="left_category.tpl"}
{literal}
               
       <script language="JavaScript" src="calendar_us.js"></script>
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
				<div class="mainHD fl" >Add/Edit Reminder</div>
				<div class="fr" style='padding-right:10px;padding-top:5px;font-weight:bold;' ><a href='my_account.php'>Go Back</a></div>
				<div class="clear">
					<!--Start my items -->
					
					<div class="myitemmain"  >
					
					<form name="frmadd_reminder" id='frmadd_reminder' action='' method='post' >

						<div class="myItemtopbg" >
							<div class="titlelf" > 
						</div>
							
							<div class="itemlf"   >
			
							</div>
							<div class="itemleftlf"  style='width:200px;'>
							
							<!--quantity_available -->
							</div>
							<div class="costlf" >&nbsp;</div>
							<div class="clear"></div>
						</div>
						<div  >
					
							<div class="itemleftlf"  style='width:200px;'>
							&nbsp;
							</div>
							<div class="costlf" >&nbsp;</div>
							<div class="clear"></div>
						</div>
						
						<div  style='border:0px solid red;width:620px;'  >
				
							<div class="clear"></div>
						</div>
						<div>
						&nbsp;
						</div>
						
						<div  >
					<div class="titlelf" style='font-weight:bold;' >Ocassion / Event Name
							</div>
							
							<div class="itemlf" >
		<input type='text' class='required' value='{$reminders_details.rem_title}' style='width:200px;' name='event_name' id='event_name'>
							</div>
							<div class="itemleftlf"  style='width:200px;'>
							&nbsp;
							</div>
							<div class="costlf" >&nbsp;</div>
							<div class="clear"></div>
						</div>
						<div  >
					<div class="titlelf" style='font-weight:bold;' >Email
							</div>
							
							<div class="itemlf" ><input type='text'
							value='{$reminders_details.email_id}'style='width:200px;'  name='Email'
						id='Email'	class='required'>
							</div>
							<div class="itemleftlf"  style='width:200px;'>
							&nbsp;
							</div>
							<div class="costlf" >&nbsp;</div>
							<div class="clear"></div>
						</div>
						
						<div  >
					<div class="titlelf" style='font-weight:bold;' >Date of Reminder
							</div>
							
					<div class="itemlf" style='width:450px;' >
							<div style='width:100px;border:0px solid red;float:left;text-align:left;padding-left:2px;'>
						<select	style='font-size:11px;width:80px;' class='required'  name='event_day'
							id='event_day' >
                                                      <option value='0'>--Select Day--</option>
						      {foreach name=cat from=$array_days  item=val_items}
						    {if $val_items!=''}
						<option value='{$val_items}'{if $reminders_details.rem_day==$val_items}selected{/if}>{$val_items}</option>
							{/if}
							{/foreach}
						</select>
						</div>
						<div style='text-align:left;'>
						<select	style='font-size:11px;width:100px;'class='required'  name='event_month'
							id='event_month' >
                                                      <option value='0'>--Select Month--</option>
						      {foreach name=cat from=$array_month  item=val_items}
						    {if $val_items!=''}
						<option value='{$val_items}' {if $reminders_details.rem_month==$val_items}selected{/if} >{$val_items+1|date_value_month}</option>
							{/if}
							{/foreach}
						</select>
						</div>
						</div>

							
						
							<div class="itemleftlf"  style='width:200px;'>
					</div>
							<div class="costlf" >&nbsp;</div>
							<div class="clear"></div>
		
						</div>
						
						<div  >
					<div class="titlelf" style='font-weight:bold;' >Name of Relative/Friend
							</div>
							
							<div class="itemlf" >
				<input type='text' value='{$reminders_details.name}' class='required' style='width:200px;' id='name_of_relatives'
							name='name_of_relatives'>

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
				

							<div class="itemleftlf"  style='width:200px;'>
					  </div>
							<div class="costlf" >&nbsp;<input type='hidden' value='{$rem_id_value}' name='rem_id_value'>
							 </div>
							<div class="clear"></div>
							<div class="itemleftlf"  style='width:200px;'>
					  </div>
							<div class="costlf" style='width:480px;text-align:left;padding-top:5px;' >
							<input type='submit' name='add_value' value='Save' style='width:100px;font-size:12px;font-weight:bold;background-color:#7E354D;border:1px solid #7E354D;cursor:pointer;color:#ffffff;' >&nbsp;&nbsp;
							</div>
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
