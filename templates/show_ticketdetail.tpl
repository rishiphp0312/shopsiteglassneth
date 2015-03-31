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
<SCRIPT language="JavaScript1.2">
 function make_itactive()
{ 
alert('Item should be  active for haating');
return false;
}
function confirm_msg(id, parent_id)
{
	var message = "Do you really want to delete this reminder?";
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
			location.href='view_reminders.php?delete_item_value='+id;
		}
		else
		{
			return false;
		}	
	});
}
function  delete_chk()
{
	var DEL_VAL= confirm("Are you sure you want to delete?");
	if(DEL_VAL==true)
	return true;
	else
	return false;
}
function poponload(VAL)
{
	//alert('ss');
	testwindow= window.open ("add_quantity.php?item_id_value="+VAL, "mywindow","location=1,status=1,scrollbars=1,width=300,height=200");
	testwindow.moveTo(100,100);
}

$(document).ready(function()
{
	
	$("a.item_quantity").fancybox({
	'hideOnContentClick': false,
	'frameWidth'			: 255,
	'frameHeight'			: 100		
	});
});

</SCRIPT>
			
{/literal}			

<div id="middleRtMain">
<div class="shopmain"  >

				<div class="mainHD fl" > Tickets Details </div>
				<div class="fr" style='padding-right:10px;padding-top:5px;font-weight:bold;' >
				<a onClick="history.go(-1)" href='#'>Go Back</a>&nbsp;&nbsp;
								</div>
				<div class="clear">
					<!--Start my items -->
	
					<div class="myitemmain">
					
					<div class="myiteminsidemain"  >
					<div class="titlelf" style="width:600px;">
							<div class="itmno" style="width:90px;float:left;border:0px solid red;" ><strong>Ticket ID &nbsp;:</strong>
							</div>
							<div class="itemimgbox" style="width:500px;float:right;text-align:left;padding-left:0px;border:0px solid red;" >{$ticket_id}
				</div>
							<div class="clear"></div>
							</div>
							<div class="titlelf" style="width:600px;">
							<div class="itmno" style="width:90px;float:left;border:0px solid red;" ><strong>Subject &nbsp;:</strong>
							</div>
							<div class="itemimgbox" style="width:500px;float:right;text-align:left;padding-left:0px;border:0px solid red;" >{$ticket_subject}
				</div>
							<div class="clear"></div>
							</div>
							<div class="titlelf" style="font-size:3px;">
						&nbsp;
							</div>
							<div class="titlelf" style="width:600px;">
							<div class="itmno" style="width:90px;float:left;border:0px solid red;" ><strong>Message &nbsp;:</strong>
							</div>
							<div class="itemimgbox" style="width:500px;float:right;text-align:left;padding-left:0px;border:0px solid red;" >{$ticket_message}
				</div>
							<div class="clear"></div>
							</div>
							<div class="titlelf" style="font-size:3px;">
						&nbsp;
							</div>
							<div class="titlelf" style="width:600px;">
							<div class="itmno" style="width:90px;float:left;border:0px solid red;" ><strong>Status &nbsp;:</strong>
							</div>
							<div class="itemimgbox" style="width:500px;float:right;text-align:left;padding-left:0px;border:0px solid red;" >{$ticket_status}
				</div>
							<div class="clear"></div>
							</div>
							<div class="titlelf" style="font-size:3px;">
						&nbsp;
							</div>
							<div class="titlelf" style="width:600px;">
							<div class="itmno" style="width:90px;float:left;border:0px solid red;" ><strong>Priority &nbsp;:</strong>
							</div>
							<div class="itemimgbox" style="width:500px;float:right;text-align:left;padding-left:0px;border:0px solid red;" >{$ticket_priority}
				</div>
							<div class="clear"></div>
							</div>
							<div class="titlelf" style="font-size:3px;">
						&nbsp;
							</div>
							<div class="titlelf" style="width:600px;">
							<div class="itmno" style="width:100px;float:left;border:0px solid red;" ><strong>Date Posted&nbsp;:</strong>
							</div>
							<div class="itemimgbox" style="width:490px;float:right;text-align:left;padding-left:0px;border:0px solid red;" >{$ticket_generated|date_format}
				</div>
							<div class="clear"></div>
							</div>
							<div class="titlelf" style="font-size:3px;">
						&nbsp;
							</div>
							<div class="titlelf" style="width:600px;">
							&nbsp;
							<div class="clear"></div>
							</div>
							<div class="titlelf" style="width:600px;">
							
							
							<div class="clear"></div>
							</div>
						
							<div class="clear"></div>
						</div>
						<!--<div class="myItemtopbg" >
							<div class="titlelf" >Message</div>
							
							<div class="itemlf"   > Date Posted
						
						  </div>
							<div class="itemleftlf"  style='width:200px;' >Posted By</div>
							<div class="costlf" >&nbsp;</div>
							<div class="clear"></div>
						</div>-->
										 {if $users_items_details}
					{foreach name=cat from=$users_items_details item=val_items}
							<div class="myiteminsidemain"  >
							<div class="titlelf" style="width:600px;">
							<div class="itmno" style="width:90px;float:left;border:0px solid red;" ><strong>Message &nbsp;:&nbsp;</strong>
							</div>
							<div class="itemimgbox" style="width:500px;float:right;text-align:left;padding-left:0px;border:0px solid red;" >{$val_items.message|ucfirst}
				</div>
							<div class="clear"></div>
							</div>
							<div class="titlelf" style="width:600px;">
							&nbsp;
							<div class="clear"></div>
							</div>
							<div class="titlelf" style="width:600px;">
							&nbsp;
							<div class="clear"></div>
							</div>
							<div class="titlelf" style="width:600px;">
							<div class="itmno" style="width:200px;float:left;border:0px solid red;font-weight:lighter;font-size:11px;color:#666666;" >Posted By &nbsp;&nbsp;:&nbsp;&nbsp; {if $val_items.user_id==0}Admin{else}Me{/if}
								</div>
							<div class="itmno" style="width:250px;float:right;text-align:right;padding-left:0px;border:0px solid red;font-weight:lighter;font-size:11px;color:#666666;" >Date Posted &nbsp;:&nbsp; {$val_items.date_genrated|date_format}
				</div>
							<div class="clear"></div>
							</div>
						
							<div class="clear"></div>
						</div>
						
						
						
							{/foreach}
						
					
						
							{else}
							<!--<div class="myiteminsidemain" style="color:#FF0000;text-align:center;font-family:Arial, Helvetica, sans-serif;font-size:12px;"  >
						No Reply !!</span>
							<div class="clear"></div>
							</div>-->
							{/if}
	                      <div class="itemimgbox" style='font-size:14px;width:690px;'>
						  <form action="" method="post" name="frm_reply_ticket">
						<table align="center" cellpadding="0" cellspacing="0" border="0" width="100%">
						
						
						<tr>
						<td width="23%" align="left" valign="top" style='font-size:12px;font-family:Arial, Helvetica, sans-serif;color:#333333;text-align:left;font-weight:bold;'>&nbsp;</td>
						<td width="77%" align="left" valign="top" >&nbsp;</td>
						</tr>
						{if $ticket_status_row==0}
						<tr>
						<td valign="top" align="left" style='font-size:12px;font-family:Arial, Helvetica, sans-serif;color:#333333;text-align:left;font-weight:bold;'> Reply&nbsp;:&nbsp;</td>
						<td valign="top" align="left" ><textarea name="message" rows="10" cols="60" ></textarea></td></tr>
						<tr>
						  <td valign="top" align="left" style='font-size:12px;font-family:Arial, Helvetica, sans-serif;color:#333333;text-align:left;font-weight:bold;'>Close Ticket</td>
						  <td valign="top" align="left" ><input type="checkbox" value="1" name='chk_close'> </td>
						  </tr>
						 
						<tr>
						<td valign="top" align="left" style='font-size:12px;font-family:Arial, Helvetica, sans-serif;color:#333333;text-align:left;font-weight:bold;'> <input type="hidden" value="{$ticket_id}" name="ticket_id"></td>
						<td valign="top" align="left" >&nbsp;					</td></tr>
						<tr>
						<td valign="top" align="left" style='font-size:12px;font-family:Arial, Helvetica, sans-serif;color:#333333;text-align:left;font-weight:bold;'>&nbsp; </td>
						<td valign="top" align="left" >
						<input type="submit"  class='Class_Button_ris'  value=" Post " name="submit"></td></tr>
						 {/if}
						</table>
						</form>
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
