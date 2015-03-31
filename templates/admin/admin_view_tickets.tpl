{include file="admin_top.tpl"}
  <script language="JavaScript" src="../calendar_us.js"></script>
  <link rel="stylesheet" href="../calendar.css">
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
			location.href='admin_view_tickets.php?close_ticket_id='+id;
		}
		else
		{
			return false;
		}	
	});
	}


}
 

{/literal}
</script>
<table width="100%"  border="0" cellspacing="10" cellpadding="5">
	<tr>
	  <td valign="middle" class="bar">{$form_heading}</td>
	</tr>
	 <tr><td align="left" valign="top" class="border1">
	 <form action="" method="get" name="serch_tick" id="serch_tick">
	 <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#D5F1FF">
		
		  <tr class="c3">
			<td colspan="5" class="subheading">Search Tickets </td>
		  </tr>
					
		  <tr align="left" valign="top" class="c1">
			<td width="3%" bgcolor="#FFFFFF"><b>Status&nbsp;:</b></td>
			<td width="25%" colspan="2"  align="left"  nowrap bgcolor="#FFFFFF">

				<input type="radio" {if $serch_status=='' || $serch_status==2}checked="checked" {/if} value="2" name="serch_status"  />
				&nbsp;All &nbsp;&nbsp;<input type="radio"  {if $serch_status==1 && $serch_status!=''} checked="checked" {/if} value="1" name="serch_status" />&nbsp;Closed &nbsp;&nbsp;<input type="radio" {if $serch_status==0 && $serch_status!=''} checked="checked" {/if} value="0" name="serch_status" />Open&nbsp;&nbsp;							 </td>
		    <td  align="left"  nowrap bgcolor="#FFFFFF"><b>Request Type&nbsp;:&nbsp;</b>
			</select>			<select	class='required'  style="font-size:12px;" name='request_type' id='request_type' >
							{html_options values="$contactValue" output="$contactOut" selected="$contact"}
<!--<option value="0">--Select--</option>
							<option value="Payment" {if $request_type=='Payment'}'selected'{/if}>Payment</option>
								
							
							<option value="Shipping"{if $request_type=='Shipping'}'selected'{/if}>Shipping</option>
							<option value="Product"{if $request_type=='Product'}'selected'{/if}>Product</option>
							<option value="Suggestions" {if $request_type=='Suggestions'}'selected'{/if}>Suggestions</option>
							<option value="Queries" {if $request_type=='Queries'}'selected'{/if}>
Queries</option>-->
            </select></td>
		    <td  align="left"  nowrap bgcolor="#FFFFFF"><!--
<b>Priority&nbsp;:&nbsp;</b><select name="priority" style="font-size:12px;" >
			<option value="0">--Select--</option>
			<option value="Low" {if $priority=='Low'}'selected'{/if}>Low</option>
			<option value="Medium"  {if $priority=='Medium'}'selected'{/if}>Med</option>
			<option value="High"  {if $priority=='High'}'selected'{/if}>High</option>
</select>
--></td>
		    <td width="5%"  align="left"  nowrap bgcolor="#FFFFFF">
			
			<b>Ticket ID&nbsp; :</b> <input style="width:80px;" type="text" value="{$ticket_id}" name="ticket_id" /></td>
		  </tr>
		  <tr align="left" valign="top" class="c1">
			<td width="3%" nowrap="nowrap" bgcolor="#FFFFFF"><b>From Date &nbsp;:</b></td>
			<td width="25%"  align="left"  nowrap bgcolor="#FFFFFF">
			<input type="text" name="start_date" id='start_date' style="width:100px;" value="{$start_date}" />
						  {literal}
	<script language="JavaScript">
	var o_cal = new tcal ({
		// form name
		'formname': 'serch_tick',
		// input name
		'controlname': 'start_date'
	});
	
	// individual template parameters can be modified via the calendar variable
	o_cal.a_tpl.yearscroll = false;
	o_cal.a_tpl.weekstart = 1;
	
	</script>
		 {/literal}</td>
		    <td colspan="2"  align="left"  nowrap bgcolor="#FFFFFF"><b>To Date&nbsp;:</b> <input type="text" value="{$end_date}" style="width:100px;"
			 name="end_date" id="myOtherInput" class='required' />
&nbsp; {literal}
<script language="JavaScript">

	// whole calendar template can be redefined per individual calendar
	var A_CALTPL = {
		'months' : ['Jannuary', 'Febraury', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
		'weekdays' : [ 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa','Su'],
		'yearscroll': true,
		'weekstart': 0,
		'centyear'  : 70,
		'imgpath' : '../img/'
	}
	
	new tcal ({
		// if referenced by ID then form name is not required
		'controlname': 'myOtherInput'
	}, A_CALTPL);
	</script>
		 {/literal} 	</td>
		    <td colspan="2"  align="center"  nowrap bgcolor="#FFFFFF"><input type="submit" value="Search" name="search" class="button"  style="width:70px;" />&nbsp;&nbsp;&nbsp;		      <input type="button" class="button" name="reset" value="Clear Search" onclick="window.location='admin_view_tickets.php';" /></td>
	      </tr>
	  </table>	
	 </form>
	</td>
	</tr>
	<tr>
	<td align="right">
	<div style="float:left;">{$page_counter} Tickets </div> 
	<!--<input type="button" name="mail_all_users" value="Send Notification Email" class="button" onclick="window.location='admin_send_bulk_mail.php';" />
	 {if $usersList}
	 <input type="button" name="btnExport" value="Export Users" class="button" onclick="window.location='admin_export_users.php?{$smarty.server.QUERY_STRING}';" />
	{/if}
	</td> -->
	</tr>	
	<tr>
	  <td align="left" valign="top" class="border1">
      <table width="100%" cellpadding="4" cellspacing="2" align="center">
       {if $TicketList!=''}
		<tr align="left" valign="top" class="listHeadRow">
		<td valign="top" nowrap="nowrap">S. No.</td>
		     <td align="left" valign="top">Ticket ID</td>
                                        <td align="left" valign="top">Subject</td>
		                                <!--<td align="left" valign="top">Priority</td>-->
		                                <td align="left" valign="top" nowrap="nowrap">Request Type</td>
		                                <td valign="top" nowrap="nowrap">Status</td>
		                                <td valign="top" nowrap="nowrap">Date Ticket Created</td>
                                        <!--<td>Status</td>-->
		                       <td valign="top" nowrap="nowrap">Options</td>
		</tr>
		{foreach name=prods from=$TicketList item=prod}
		
		<tr align="left" valign="top" bgcolor="{cycle values='#f5f5f5,#e6e6e6'}">
          <td>
		  {if $smarty.request.pageNumber!="" && $smarty.request.pageNumber>1}
		  {assign var=pageconut value=$smarty.request.pageNumber-1}
		  {$smarty.const.ADMIN_PAGE_NUMBER*$pageconut+$smarty.foreach.prods.iteration}.
		  {else}
		  {$smarty.foreach.prods.iteration}.
		  {/if}		  </td>
		  <td align="left" valign="top">
		  {$prod.ticket_id}
		  </td>
          <td align="left" valign="top">
		
		  {$prod.subject|ucfirst}		  </td>
		 <!-- <td align="left" valign="top">
		  {if $prod.priority!=''}
		  {$prod.priority|ucfirst}
		  {else}
		  NA
		  {/if}
		  </td>-->
		  <td align="left" valign="top">
		    {if $prod.request_type!=''}
		  {$prod.request_type|ucfirst}
		  {else}
		  NA
		  {/if}
		 </td>
		  <td align="left" valign="top">{if $prod.status==0}Open{else}Closed{/if}</td>
		  <td align="left" valign="top">{$prod.date_genrated|date_format:"%b %d, %Y"}</td>
          <td nowrap>
			  <a href="admin_reply_ticket.php?ticket_id={$prod.ticket_id}" 
			  style="text-decoration:none;" title="Reply">
			  	<img src="{$baseUrl}/images/details_btn.jpg" alt="Reply Ticket" border="0" />			  </a> &nbsp; &nbsp;
			   <a href="javascript: void(0);" title=" Close Ticket " style="text-decoration:none;" onclick="confirm_msg({$prod.ticket_id},{5});">
			  	<img src="{$baseUrl}/images/close_icon.jpg" alt="Close Ticket" border="0" /></a>		</td>
		</tr>
		
		{/foreach}
        <tr>
			<td colspan="9">
			<div style="float:left;">{$page_counter} Tickets </div>
			 {if $pageLink}
			<div class="admn_pagination_msg_board">
			<span style="float:right;">{$pageLink}</span>			</div>
			 {/if}			</td>
        </tr>
		{else}
		
		<tr><td colspan="9"><div class="no_record_found">No record found...!</div></td></tr>
	
		{/if}
      </table>
</td>
	</tr>
</table>	  
{include file="admin_bottom.tpl"} 