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
				<div class="mainHD fl" >Compose Message</div>
				<div class="fr" style='padding-right:10px;padding-top:5px;font-weight:bold;' ><a href='my_account.php'>Go Back</a></div>
				<div class="clear">
					<!--Start my items -->
					
					<div class="myitemmain"  >
					
					<form name="frmgenrate_coupon" id='frmgenrate_coupon' action='' method='post' >

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
					<div class="titlelf" style='font-weight:bold;text-align:right;' >Message&nbsp;:
							</div>
							
							<div class="itemlf" >
							<textarea name='message' class='required' id='message' 
							rows='6' cols='50'>{$show_msg}</textarea>
							<input type='hidden' value='{$rem_id_value}' name='rem_id_value'>
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
							<div class="costlf" >&nbsp;</div>
							<div class="clear"></div>
							<div class="itemleftlf"  style='width:200px;'>
					  </div>
							<div class="costlf" style='width:480px;text-align:left;padding-top:5px;' >
							<input type='submit' name='add_value' value='Change' style='width:100px;font-size:12px;font-weight:bold;background-color:#7E354D;border:1px solid #7E354D;cursor:pointer;color:#ffffff;' >&nbsp;&nbsp;<!--<input type='submit' name='send_email' value='Send Email' style='width:100px;font-size:12px;font-weight:bold;background-color:#7E354D;border:1px solid #7E354D;cursor:pointer;color:#ffffff;'>-->
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>
