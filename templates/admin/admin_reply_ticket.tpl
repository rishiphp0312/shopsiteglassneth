{include file="admin_top.tpl"}

{literal}
<SCRIPT language="JavaScript1.2">
function page_url(PAGE_NAME)
{
window.location.href=PAGE_NAME;

}
function confirm_msg(id, parent_id)
{
	var message = "Do you really want to delete this image?";
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
			location.href='admin_view_product_detail.php?unlink_this_img='+id+'&col_position='+parent_id;
		}
		else
		{
			return false;
		}	
	});
}


</SCRIPT>
			
{/literal}	

  <table width="100%"  border="0" cellspacing="10" cellpadding="5">
	<tr>
	  <td valign="middle" class="bar">View Ticket Detail</td>
	</tr>
	<tr>
	  <td align="left" valign="top" class="border1">
	  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr><td>{*#require_msg#*}</td></tr>
		<tr></tr>
		<tr>
		  <td width="710" class="lback">
		 
			 <table width="100%" border="0" cellspacing="0" cellpadding="4">
				 
					
			<!--	  <tr>
				  <td colspan='3' width="32%" align="left" class="text"> <input name="approve" type="submit" class="button" value="Approve" />
					&nbsp;  <input name="suspend" type="submit" class="button" value="Suspend" />
					 &nbsp; <input name="cancel" type="reset" class="button" value="Cancel" 
					  onclick="window.location='admin_products_listing.php'" />
			</td>
				  
				</tr>-->
				 
				 <tr valign="top">
				   <td align="left" class="text"><b>Username&nbsp; :</b></td>
				   <td align='left'>{$username_reciver}</td>
				   <td width="20%" align='right' class="text" ><b>Email&nbsp; :</b> </td>
			       <td width="25%" align='left' class="text" >{$email_from_reciver}</td>
			    </tr>
				{*assign var='str' value='Contact to Nethaat'*}
				{*if $subject==$str*}
				 <tr align="left" valign="top">
				   <td class="text"><b>Name&nbsp; :</b></td>
				   <td>{$name_from_reciver}</td>
				   <td align="right" ><b>Phone No&nbsp; :</b></td>
			       <td align="left" >{$phone_no}</td>
			   </tr>
			   
			   
					
			   {*/if*}
				 
				<tr align="left" valign="top">
				  <td width="17%" class="text"><b>Request Type&nbsp;:</b> </td>
				  <td width="38%"> {if $request_type!=''}
		  {$request_type|ucfirst}
		  {else}
		  NA
		  {/if}				</td>
				

		
				  <td align="right" valign="top"><b>Priority&nbsp;:</b></td>
		          <td>{if $priority!=''}
		  {$priority|ucfirst}
		  {else}
		  NA
		  {/if}</td>
			   </tr>
			   
				<tr align="left" valign="top">
				  <td width="17%" class="text"></td>
				  <td width="38%">				  </td>
				

		
				  <td colspan="2">			</td>
			   </tr>
				<tr align="left" valign="top">
				  <td width="17%" class="text"><b>Status&nbsp;:</b></td>
				  <td width="38%">
				{if $status==0}Open {else}Closed {/if}</td>
				

		
				  <td align="right"><b>Date Created : </b></td>
			      <td>{$date_genrated|date_format}</td>
			   </tr>
				<tr align="left" valign="top">
				  <td width="17%" class="text"><b>Subject&nbsp;:</b> </td>
				  <td colspan="3">{$subject}				</td>
			   </tr>
				 <tr align="left" valign="top">
				  <td width="17%" class="text"><b>Message&nbsp; :</b></td>
				  <td colspan="3">{$message}				</td>
			   </tr>
				
				<tr align="left" valign="top">
				  <td class="text">&nbsp;</td>
				  <td></td>
				  <td colspan="2">&nbsp;</td>
			   </tr>
				 {if $num_rows_items1>0}
			{foreach name=cat from=$ticket_reply_list item=val_items}
				
				<tr>
				  <td colspan="4" align="left" class="text" style="padding:0px;">
				  <table align="center" width="100%" cellpadding="4" cellspacing="0" 
				  border="0">  
				    <tr align="left" valign="top">
				        <td width="13%" colspan="4" bgcolor="#ECF5FF">&nbsp;</td>
				  </tr>
				  
				  <tr align="left" valign="top">
				        <td class="text" width="17%" ><b>Reply&nbsp;:</b></td>
						<td colspan="3" align="left" valign="top">{$val_items.message|ucfirst}</td>
				  </tr>
				  
				  <tr align="left" valign="top">
				        <td width="13%"><b>Posted On&nbsp;:</b></td>
						<td width="60%" valign="top">{$val_items.date_genrated|date_format:"%b %d, %Y"}</td>
				        <td width="13%"><b>Posted By&nbsp;: </b></td>
				        <td width="14%" valign="top">{if $val_items.user_id==0}Admin{else}User{/if}</td>
				  </tr>
				  </table>				  </td>
				</tr>
								{/foreach}
				
				{else}
				  <!--<tr>
				<td colspan="3" align="left" class="text" style="text-align:center;font-size:12px;font-family:Arial, Helvetica, sans-serif;font-weight:400;color:#FF0000;">
				  No reply found!!</td>
				</tr>-->
				{/if}
				<tr>
				
				  <td colspan="4" class="text" align="left" valign="top" >&nbsp;</td></tr>
					<tr>
					<form name="frm_rep_ticket"  action="" method="post">
				  <td colspan="4" class="text" align="left" valign="top"  {if $status==0}style="border:1px solid #AF6161;"{/if}>
				  {if $status==0}
				  
				 <table align="center" width="100%" cellpadding="3" cellspacing="0" border="0">
				 
				 <tr style="background-color:#EEEEEE;">
				   <td colspan="2" align="left" valign="top" style="font-family:Verdana, Arial, Helvetica, sans-serif;font-size:14px;font-weight:bold;color:#804040;text-align:left;">Post Reply</td>
				   <td align="left" valign="top">&nbsp;</td>
				   </tr>
				 
				 
				 <tr>
				       <td colspan="2" align="left" valign="top"><b>Message&nbsp;&nbsp;</b><b>:</b></td>
					   <td width="89%" align="left" valign="top"><textarea name="message" rows="10" cols="50"></textarea></td>
				</tr>
				 <tr>
				   <td width="15%" align="left" valign="top" nowrap><b>Close Ticket</b>&nbsp;<b>:</b></td>
				   <td width="1%" align="left" valign="top">&nbsp;</td>
				   <td align="left" valign="top"><input type="checkbox" value="1" name="chk_close"></td>
				   </tr>
				 <tr>
				        <td align="left" valign="top"><input type="hidden"  name="ticket_id" value="{$ticket_id}"></td>
						
				        <td align="left" valign="top">&nbsp;</td>
				        <td align="left" valign="top">
						<input class="button"   type="submit" value=" Post "
						 name="submit">&nbsp;&nbsp;		<input class="button"   type="button" onClick="window.location.href='admin_view_tickets.php'"  value=" Cancel " name="submit">				</td>
				 </tr>
				 </table>
				 {/if}				  </td></form>
				</tr>
			</table>
		  </td>
		</tr>
	</table>
	</td>
	</tr>
</table>
{include file="admin_bottom.tpl"}