{include file="header.tpl"}
{include file="header_search.tpl"}
<!--Start Middle-->
<link rel="stylesheet" type="text/css" href="css/include/stylesheet.css" />
<script type="text/javascript" src="include/function.js"></script>
{literal}
<script type="text/javascript">
checked=false;
function checkedAll (frm1) 
{
	var aa= document.getElementById('msg_inbox');
	if (checked == false)
	{
		checked = true
	}
	else
	{
		checked = false
	}
	for (var i =0; i < aa.elements.length; i++) 
	{
		aa.elements[i].checked = checked;
	}
}

function confirm_msg()
{
	var message = "Do you really want to delete this item?";
	jConfirm(message, 'Confirm', function(r) 
	{
		if(r)
		{
			//location.href='locker_items_seller.php?delete_item_value='+id;
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
</script>
{/literal}


<div id="middleMain">
{*include file="left_category.tpl"*}
<!--<div id="middleRtMain">-->
<div>
<!--Start Tab Link-->

<div class="shopmain">
<span class="mainHD">My Messages</span>
	<!--Start my items -->
	<div class="myitemmain">
		<div class="myItemtopbg" >
			<div style='float:left;' >My Inbox messages</div> &nbsp;&nbsp;
			<div style='float:right;'>
			<span  style='padding-left:15px;text-align:right;'><a href='#my_account.php'  onclick='history.go(-1)'>Go Back</a>
			</span></div>
			<div class="clear"></div>
		</div>
		
		<div class="myiteminsidemain"> <div style="display:block;" class="pad_ten" id="tab_6">
		    
		<div class="clear"></div>
		{if $pageLink}
		
		<table align='center' width='100%' cellpadding='0' cellspacing='0' border='0'>
			<tr>
				<td align='right' valign='middle' width='60%' >
					{$page_counter} records&nbsp;&nbsp;&nbsp;
				</td>
				<td align='left' valign='top' width='20%' >
				<span style="float:right;padding-top:5px;height:20px;" class="admn_pagination_msg_board">{$pageLink}</span>
				</td>
			</tr>
		</table>
		
		{/if}
		    <table width="100%" align="center" cellpadding="0" cellspacing="0" style="border:1px solid #8A5F40;padding:5px;">
			  <tr>
			    <td width="15%"  style="vertical-align:top;padding-top:50px;padding-left:20px;font-size:17px;border:0px solid red;"  align="left" class="">
				<ul style="padding:10px;">				  
				 <li style="padding-top:3px;"><a href="message.php" class="sel" id="b1" style='font-weight:500px;font-size:12px;' ><strong> Inbox ( {$num_in} )</strong></a></li>
				  <li style="padding-top:3px;"><strong><a href="sent_message.php" id="b2" style='font-weight:500px;font-size:12px;'>Sent </a></strong></li>
				  <li style="padding-top:3px;"><strong><a href="trash_message.php" id="b3" style='font-weight:500px;font-size:12px;' >Trash ( {$num_trash} )</a></strong></li>
				  <li style="padding-top:3px;"><strong><a href="compase_message.php" id="b4" style='font-weight:500px;font-size:12px;'>Compose </a></strong></li>
				 </ul>
				 
				</td>
				<td></td>
				<td valign="top" width="83%">				  
				  <div id="mailbox_1">
				  <form action="" method="get" name="msg_inbox" id="msg_inbox">
				  <table width="100%" align="right" cellpadding="4" cellspacing="1" bgcolor="#FFFFFF">
				    <tr>
					  <td colspan="4">
					  
					    <div style="padding:3px; background:#eeeeee; margin-bottom:5px;">
						  <div style="width:180px; float:left;">
						  <input name="search_text" type="text" style="width:110px;" />
						  <input name="search_message" type="submit" class='Class_Button_ris' value="Search" style="cursor:pointer;width:60px;" />
						  </div>
						  <div style="width:370px; float:right; text-align:right;">
						  <span style="font-size:10px;">Sort By </span>
						  <select name="sorting" style="padding:1px; font-size:10px;" onchange="document.msg_inbox.submit();">
						  
						  <option value="subject" {if $sorting=="subject"} selected="selected" {/if}>Subject </option>
						  <option value="sender_id" {if $sorting=="sender_id"} selected="selected" {/if}>Sender</option>
						  <option value="message_date" {if $sorting=="message_date"} selected="selected" {/if}>Date</option>
						  <option value="inbox_read" {if $sorting=="inbox_read"} selected="selected" {/if}>Read</option>
						  <option value="outbox_read" {if $sorting=="outbox_read"} selected="selected" {/if}>Unread</option>
						  </select> 


						  <span style="font-size:10px;">Order By</span>
						  <select name="order" style="padding:1px; font-size:10px;" onchange="document.msg_inbox.submit();">
						  <option value="asc" {if $order=="asc"} selected="selected" {/if}>Ascending </option>
						  <option value="desc" {if $order=="desc"} selected="selected" {/if}> Descending</option>
						  </select><span style="font-size:10px;">Entries Per Page</span> 
						  <select name="limit" style="padding:1px; font-size:10px;" onchange="document.msg_inbox.submit();">
						    
						    <option value="10" {if $limit=="10"} selected="selected" {/if}>10</option>
						    <option value="25" {if $limit=="25"} selected="selected" {/if}>25</option>
						    <option value="50" {if $limit=="50"} selected="selected" {/if}>50</option> 
						    <option value="100" {if $limit=="100"} selected="selected" {/if}>100</option>
						    </select><br />
						  </div>
						  <div class="clear"></div>
						</div>
					
					 <input name="chk_delete" type="submit" value="Delete" class="Class_Button_ris" /><!-- 
					  <input name="chk_read" type="submit" value="Mark as Read" class="Class_Button_ris" /> 
					 <input  name="chk_unread" type="submit" value="Mark as Unread" class="Class_Button_ris" /> -->
					  </td>
					</tr>

					<tr bgcolor="#e3e6d1">
					  <td width="22"><input name="main_check" type="checkbox" onclick="checkedAll(msg_inbox);" /></td>
					  <td width="50"><strong class="blue_clr">Sender Name</strong></td>
					  <td width="210"><strong class="blue_clr">Subject</strong></td>
					  <td width="90"><strong class="blue_clr">Date</strong></td>
					  
					</tr>
                                    {if $num_rows_items1>0}
					{section name="val" loop="$in_item"}
					<tr bgcolor="#e5f3f9">
					  <td><input name="checked_msg[]" id="checked_msg[]" value="{$in_item[val].subid}" type="checkbox" /></td>
					  {if $in_item[val].inbox_read==1}
						 <td >			{$in_item[val].username}
						 </td>
					  {else}
						<td style="font-weight:bold;">{$in_item[val].username}</td>
					  {/if}
					  {if $in_item[val].inbox_read==1}
						<td >
							<a href="view_messages.php?msg_id={$in_item[val].subid}" class="blue_link">	{$in_item[val].subject}
							</a>
						</td>
					  {else}
						<td style="font-weight:bold;">
							<a href="view_messages.php?msg_id={$in_item[val].subid}" class="blue_link">	{$in_item[val].subject}
							</a>
						</td>
					  {/if}
					  {if $in_item[val].inbox_read==1}
						<td >
							{$in_item[val].message_date}
						</td>
					  {else}
						<td style="font-weight:bold;">
							{$in_item[val].message_date}
						</td>
					  {/if}
					</tr>
					{/section}
                                        <tr>
					  <td colspan="4">
					  <!--<input name="chk_delete" type="submit" value="Delete"  class="Class_Button_ris"/>
					  <input name="chk_read" type="submit" value="Mark as Read"  class="Class_Button_ris" /> 
					  <input name="chk_unread" type="submit" value="Mark as Unread"  class="Class_Button_ris"/> -->
					  </td>
					</tr>
                                           {else}
<tr>
					  <td colspan="4" align='center'
  style='font-size:13px;color:#7e354d;text-align:center;' >&nbsp;No records found !!.
					  </td>
					</tr>
                                          {/if}

					
				  </table>
				  </form>
				  </div>
				  
				  
				</td>
			  </tr>
			</table>
		  
</div>
</div>
		<div class="myItemtopbg">
			
			<!--start page number -->
			<div class="bradcrum" style="padding:0px;">
			
			</div>
			<!--end page number -->
			<div class="clear"></div>
		</div>
	</div>	
	<!--End my items -->
</div>





</div>
<!--</div>-->
<div class="clear"></div>
</div>
<!--End Middle-->
{include file="footer.tpl"}