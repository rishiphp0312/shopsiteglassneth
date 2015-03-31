{include file="header.tpl"}
{include file="header_search.tpl"}
<!--Start Middle-->

<link rel="stylesheet" type="text/css" href="css/include/stylesheet.css" />
<script type="text/javascript" src="include/function.js"></script>
<div id="middleMain">
{*include file="left_category.tpl"*}
<!--<div id="middleRtMain">-->
<div>
<!--Start Tab Link-->

<div class="shopmain">
<span class="mainHD">My Messages</span>
	<!--Start my items -->
	<div class="myitemmain">
		<div class="myItemtopbg">
			Compose New message
			<div class="clear"></div>
		</div>
		
		<div class="myiteminsidemain"> 
		<div style="display:block;" class="pad_ten" id="tab_6">
		
		    
		<div class="clear"></div>
		    <table width="100%" align="center" cellpadding="0" cellspacing="0" style="border:0px solid #8A5F40;padding:5px;">
			  <tr>
			    <td width="15%"  style="vertical-align:top;padding-top:50px;padding-left:20px;font-size:17px;border:0px solid red;" width="12%" align="left" class="">
				<ul style="padding:10px;">				  
				 <li style="padding-top:3px;"><a href="message.php" class="sel" id="b1" style='font-weight:500px;font-size:12px;'  ><strong> Inbox ( {$num_in} )</strong></a></li>
				  <li style="padding-top:3px;"><strong><a href="sent_message.php" id="b2" style='font-weight:500px;font-size:12px;'  >Sent </a></strong></li>
				  <li style="padding-top:3px;"><strong><a href="trash_message.php" id="b3" style='font-weight:500px;font-size:12px;' >Trash ( {$num_trash} )</a></strong></li>
				  <li style="padding-top:3px;"><strong><a href="compase_message.php" id="b4" style='font-weight:500px;font-size:12px;'  >Compose </a></strong></li>
				 </ul>
				 
				</td>
				<td></td>
				<td valign="top" width="83%">				  
				  <div id="mailbox_1">
				  <table width="100%" align="right" cellpadding="4" cellspacing="1" bgcolor="#FFFFFF"></table>
				  </div>
				  
				  <div id="mailbox_4" style="display:block;">
				  <form action="" method="post">
				  <table width="80%" align="left"  cellpadding="4" cellspacing="0" style="border:1px solid #8A5F40;padding:5px;">
					<tr>
					  <td width="80"><strong>Recipient :</strong></td>
					  <td width="380">
					{if $msg_rpl_id==""}
					<select	style='font-size:11px;width:300px;'  name='user_ids_for_message[]' MULTIPLE  size='10' class="formInput">
				<option value='0'selected>--select--</option>
                 {foreach name=cat from=$user_details_value  item=val_items}
					{if $val_items.buyer_id!=''}
					<option value='{$val_items.buyer_id}'>{$val_items.username}</option>{/if}{/foreach}
					</select>
					{else}
					<input class="formInput" name="reciver" type="text" style="width:290px;" value="{$username}" />
					{/if}
					</td>
					</tr>
					<tr>
					  <td><strong>Subject :</strong></td>
					  <td><input class="formInput" name="sub" type="text" style="width:290px;" value="{$subject}" />
					  <input  name="reciver_id" type="hidden"  value="{$reciver_id}" />
					  </td>
					</tr>
					<tr>
					  <td valign="top"><strong>Message :</strong></td>
					  <td><textarea name="message" cols="5" rows="5" style="width:290px;" class="formInput"> {$message}</textarea></td>
					</tr>
					<tr>
					  <td></td>
					  <td><input type="submit"  class="Class_Button_ris" value="SEND MESSAGE" name="post"></td>
					</tr>
				  </table>
				  </form>
				  </div>
				  
				</td>
			  </tr>
			</table>
		  
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