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
<script language="javascript">
{literal}
function confirm_msg(id,val)
{
//alert(val+'id');


 if(val==5)
	{
	jConfirm('Do you really want to Close this Ticket?', 'Confirm', function(r) 
	{
		if(r)
		{
			location.href='view_status_tickets.php?close_ticket_id='+id;
		}
		else
		{
			return false;
		}	
	});
	}



}

 

</SCRIPT>
			
{/literal}			

<div id="middleRtMain">
<div class="shopmain"  >

				<div class="mainHD fl" style="border:0px solid red;width:640px;" >
				<div style="border:0px solid red;width:130px;float:left;" >View Tickets</div><div style="border:0px solid red;width:500px;float:right;text-align:right;font-size:12px;">
				<form action="" method="get" name="serch_tick">
				<input type="radio" value="2" {if $serch_status=='' || $serch_status==2} checked="checked" {/if}  name="serch_status" />&nbsp;All &nbsp;&nbsp;<input type="radio"  {if $serch_status==1 && $serch_status!=''} checked="checked" {/if} value="1" name="serch_status" />&nbsp;Closed &nbsp;&nbsp;<input type="radio" {if $serch_status==0 && $serch_status!=''} checked="checked" {/if} value="0" name="serch_status" />Open&nbsp;&nbsp;<input type="submit" value="Search" name="search" class="Class_Button_ris" style="width:70px;" /></form>
				</div> </div>
				<div class="fr" style='padding-right:10px;padding-top:5px;font-weight:bold;' >
				<a href='#my_account.php'  onclick='history.go(-1)'>Go Back</a>&nbsp;&nbsp;
				<a href='add_reminder.php'></a>				</div>
				<div class="clear">
					<!--Start my items -->
					 {if $users_items_details}
					<div class="myitemmain">
					
					
						<div class="myItemtopbg" >
							<div class="titlelf"style="width:150px;" >Subject</div>
							<div class="itemimgbox" style="width:110px;border:0px solid #FF0000;">Priority
				</div>
							<div class="itemlf" style="width:120px;text-align:left;" >Date Added
							&nbsp;
						  </div>
						  	<div class="itemimgbox" style="width:90px;border:0px solid #FF0000;text-align:left;">Type
				</div>
							<div class="itemleftlf"  style='width:70px;' >Status</div>
							<div class="costlf" >&nbsp;</div>
							<div class="clear"></div>
						</div>
					{foreach name=cat from=$users_items_details item=val_items}
							<div class="myiteminsidemain" >
							<div class="titlelf"  >
							<div class="itmno" style="width:20px;">{if $smarty.request.pageNumber!="" && $smarty.request.pageNumber>1}
		  {assign var=pageconut value=$smarty.request.pageNumber-1}
		  {$smarty.const.ADMIN_PAGE_NUMBER*$pageconut+$smarty.foreach.cat.iteration}.
		  {else}
		  {$smarty.foreach.cat.iteration}.
		  {/if}</div>
							<div style="width:120px;border:0px solid #FF0000;float:left;">
				{$val_items.subject|ucfirst}</div>
							<div class="itemimgbox" style="width:30px;border:0px solid #FF0000;float:right;">
				{$val_items.priority|ucfirst}</div>
			
							<div class="clear"></div>
							</div>
							<div class="itemlf" style="border:0px solid red;width:150px;text-align:right;">
							{$val_items.date_genrated|date_format }&nbsp;	</div>
												<div class="itemleftlf" style='text-align:center;width:130px;'>
							{$val_items.request_type|ucfirst}
	</div>
								<div class="itemleftlf" style='text-align:center;width:50px;'>
							{if $val_items.status== 0}Open {else} Closed{/if}
	</div>
	<div class="costlf" style="width:100px;" >

<a href="show_ticketdetail.php?ticket_id={$val_items.ticket_id}"><img class='vAlign'  src='images/details_btn.jpg' border='0'></a>&nbsp;&nbsp;&nbsp;&nbsp;

<a href="javascript: void(0);" title=" Close Ticket " style="text-decoration:none;" onclick="confirm_msg({$val_items.ticket_id},{5});">
	<img class='vAlign' alt="Close Ticket" src='images/close_icon.jpg' border='0'></a>
<!--<a href="view_status_tickets.php?close_ticket_id={$val_items.ticket_id}" title="Close ticket"><img class='vAlign' alt="Close Ticket" src='images/close_icon.jpg' border='0'>

	</a>-->
	
	<br><br><br>
	

	</div>
							<div class="clear"></div>
						</div>
						
						
						
							{/foreach}
						
					
						<div class="itemimgbox" style='width:690px;'>
						{$page_counter} records&nbsp;&nbsp;&nbsp;&nbsp;<span style="float:right;">
						{$pageLink}</span>
							<div class="clear"></div>
					  </div>
							{else}
							<div class="itemimgbox" 
							style='color:red;font-size:14px;width:690px;'>
						No records found!!</span>
							<div class="clear"></div>
							</div>
							{/if}
	
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
