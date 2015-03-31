{include file="header.tpl"}
{include file="header_search.tpl"}
<!--Start Middle-->
<div id="middleMain">
{*include file="left_category.tpl"*}
{literal}
<script>
function mypopup(FILE_NAM,VAL)
 {
// alert('vv=='+FILE_NAM);
 if(VAL==1)
 var Fil_redirect ='download1.php';
 else
 var Fil_redirect ='download.php';
 
  var FILE_NAM = FILE_NAM;
  mywindow = window.open(Fil_redirect+"?name_file="+FILE_NAM,"mywindow","menubar=1,resizable=1,width=350,height=250"); 
  // mywindow = window.open ("download.php","Nethaat","location=1,status=1,scrollbars=1, width=100,height=100");
  mywindow.moveTo(0,0);

 } 
</script>
{/literal}
<!--<div id="middleRtMain">-->
<div>
<!--Start Tab Link-->

<div class="shopmain">
<span class="mainHD">Request Details</span>
	<!--Start my items -->
	<div class="myitemmain">
		<div class="myItemtopbg" style='text-align:right;' ><a href='#' onclick='history.go(-1)'>Go Back</a>
			<div class="clear"></div>
		</div>
		
		<div class="myiteminsidemain">
		<table width="100%" cellpadding="3" celspacing="3" border="0" >

		{section name=cus loop=$citem}
		{if $smarty.session.session_user_type==4}
		{if $citem[cus].agreestatus=="1"}
		{if $citem[cus].paymentstatus!=1}
		<tr>
		<td colspan="2" align="right" style="font-weight:bold;font-size:15px;padding-right:50px;">
		<a href="advance_aggrement.php?itemid={$id}&buyerid={$buyid}">
		
		Advance payment & agreement..
		

		</a></td>
		</tr>{/if}{/if}{/if}

		<tr>
		{if $smarty.session.session_user_type==4}
		{if $citem[cus].paymentstatus!=1}
		<tr><td colspan="2" align="right" style="font-weight:bold;font-size:15px;padding-right:50px;">
		
		<a href="request_custom_item.php?requestid={$id}">Edit your item detail request</a></td></tr>{/if}{/if}

		{if $citem[cus].paymentstatus==1}
		<tr>
			<td colspan="2" align="center" style="font-weight:normal; font-size:12px;padding:5px;border:1px solid #907059 ">
			{if $smarty.session.session_user_type==4}
			You have{else}Buyer has{/if} been paid -<b>{$citem[cus].paid_amount} {$CURRENCY}</b> {if $smarty.session.session_user_type==4}to the seller and your{/if} Transaction id is - <b>{$citem[cus].transaction_id} </b> on <b> {$citem[cus].alter_date} </b> date.
			</td>
		</tr>
		{/if}
		{/section}
		<tr>

		<td style="vertical-align:top;padding-left:20px;vertical-align:top;">
		
		{section name=cus loop=$citem}
		<table width="500" cellpadding="3" celspacing="3" border="0" >
		<tr>
			<td  align="left" style="font-weight:bold;font-size:15px; vertical-align:top; width:180px;color:#8A5F40;" colspan="2"> Requested item detail</td>
		</tr>
		<tr>
			<td  style="font-weight:bold;font-size:13px; vertical-align:top; width:150px;">Title</td>
			<td style="font-size:12px;">{$citem[cus].title}</td>
		</tr>

		<tr>
			<td  style="font-weight:bold;font-size:13px; vertical-align:top; width:150px;">Image</td>
			<td style="font-size:12px;">
			
<img src="{$baseUrl}getthumb.php?w=150&h=100&fromfile={if $citem[cus].image1!=''}uploads/custom_item/{$citem[cus].image1}{else}images/no_img.jpg{/if}" alt="" border="0" class="buyerimg"  />			</td>
		</tr>

		<tr>
			<td  style="font-weight:bold;font-size:13px; vertical-align:top; width:150px;">Ideal price</td>
			<td style="font-size:12px;">{$citem[cus].price}	</td>
		</tr>

		<tr>
			<td  style="font-weight:bold;font-size:13px; vertical-align:top; width:150px;">Quantity</td>
			<td style="font-size:12px;">{$citem[cus].quantity}	</td>
		</tr>

		<tr>
			<td  style="font-weight:bold;font-size:13px; vertical-align:top; width:150px;">	Deadline	</td>
			<td style="font-size:12px;">{$citem[cus].deadline}	</td>
		</tr>
		
		<tr>
			<td  style="font-weight:bold;font-size:13px; vertical-align:top; width:150px;">	Description	</td>
			<td style="font-size:12px;">{$citem[cus].description}	</td>
		</tr>

		<tr>
			<td  style="font-weight:bold;font-size:13px; vertical-align:top; width:150px;">	Tags	</td>
			<td style="font-size:12px;">{$citem[cus].tags}	</td>
		</tr>

		<tr>
			<td  style="font-weight:bold;font-size:13px; vertical-align:top; width:150px;">	Material	</td>
			<td style="font-size:12px;">{$citem[cus].material}	</td>
		</tr>

		<tr>
			<td  style="font-weight:bold;font-size:13px;vertical-align:top; width:150px;">	Create date	</td>
			<td style="font-size:12px;">{$citem[cus].create_date|date_format}	</td>
		</tr>

		
		<tr>
			<td  style="font-weight:bold;font-size:13px; vertical-align:top; width:150px;">	Modify date	</td>
			<td style="font-size:12px;">{$citem[cus].alter_date|date_format}	</td>
		</tr>
		{if $citem[cus].file_attached!=''}
		<tr>
		  <td  style="font-weight:bold;font-size:13px; vertical-align:top; width:150px;">Attached File </td>
		  <td style="font-size:12px;">
<a href="download3.php?cust_id1={$citem[cus].id}">Nethaat-{$citem[cus].file_attached}</a>
					</td>
		  </tr>
		  {/if}
		</table>
		</td>
		<td style="vertical-align:top;">

		<table cellpadding="3" celspacing="3" border="0" width="400px">
		
		<tr>
			<td  style="font-weight:bold;font-size:14px; vertical-align:top; width:150px;color:#8A5F40;" colspan="2">Contact detail</td>
			
		</tr>
		<tr>
			<td  style="font-weight:bold;font-size:13px;vertical-align:top; width:150px;">	Full Name </td>
			<td style="font-size:12px;">{$citem[cus].fullname}</td>
		</tr>
		<tr>
			<td  style="font-weight:bold;font-size:13px; vertical-align:top; width:150px;">street</td>
			<td style="font-size:12px;">{$citem[cus].street}	</td>
		</tr>
		<tr>
			<td  style="font-weight:bold;font-size:13px; vertical-align:top; width:150px;">street</td>
			<td style="font-size:12px;">{$citem[cus].street}	</td>
		</tr>
		<tr>
			<td  style="font-weight:bold;font-size:13px; vertical-align:top; width:150px;">City</td>
			<td style="font-size:12px;">{$citem[cus].city}	</td>
		</tr>
		<tr>
			<td  style="font-weight:bold;font-size:13px; vertical-align:top; width:150px;">State</td>
			<td style="font-size:12px;">{$citem[cus].state}	</td>
		</tr>
		<tr>
			<td  style="font-weight:bold;font-size:13px; vertical-align:top; width:150px;">Zip code</td>
			<td style="font-size:12px;">{$citem[cus].zipcode}	</td>
		</tr>
		</table>
		</td>
		</tr>
		{/section}
		
		<tr>
		<td  colspan="2" style="padding-top:10px; ">
			<table width="850" cellpadding="3" celspacing="3" border="0">
			<tr>
				<td colspan="3" style="font-weight:bold;font-size:15px; vertical-align:top;border-bottom:1px solid #907059;padding-left:15px; ">
				Messages
				</td>
				
			</tr>
			{section name=custom loop=$msg}
			<tr bgcolor="#CCCCCC">
				<td style="font-weight:bold;font-size:13px; vertical-align:top;padding-top:10px;width:100px;padding-left:12px;">
				Message
				</td>
				<td style="font-weight:normal;font-size:12px; vertical-align:top;padding-top:10px;width:450px; ">
				{$msg[custom].message}
				</td> 
				<td style="font-weight:bold;font-size:11px; vertical-align:top;padding-top:10px;">{if $smarty.session.session_user_id==$msg[custom].user_type}Me{else}Response{/if}
				</td>
				
			</tr>
			
			<tr>
				<td style="font-weight:bold;font-size:13px; vertical-align:top;padding-top:0px;width:100px;padding-left:12px;">
				Posted Date
				</td>
				<td style="font-weight:normal;font-size:12px; vertical-align:top;padding-top:0px;width:450px; ">{$msg[custom].create_date}
				</td> 
				<td>
				{if $msg[custom].file_attached!=''}
				<a href="download3.php?cust_id={$msg[custom].id}">Nethaat-{$msg[custom].file_attached}</a>
				{/if}
				</td>
				
			</tr>
			<tr>
				<td colspan="3" style="font-weight:bold;font-size:13px; vertical-align:top;padding-top:0px;width:100px;padding-left:12px;">&nbsp;
				
				</td>
				
				
			</tr>
			{/section}
			</table>
		</td>
		
		</tr>
		<tr>
		<td  colspan="2" style="padding-top:10px; ">
		<form action="view_profile_custom_user.php" enctype='multipart/form-data' method="post" name="frmmessage">
			<table width="850" cellpadding="3" celspacing="3" border="0">
			<tr>
				<td colspan="3" style="font-weight:bold;font-size:15px; vertical-align:top;border-bottom:1px solid #907059;padding-left:15px; ">
				Post message				</td>
			</tr>
			<tr>
				<td style="font-weight:bold;font-size:13px; vertical-align:top;padding-top:10px;width:100px;padding-left:12px;">
				Message				</td>
				<td style="font-weight:normal;font-size:12px; vertical-align:top;padding-top:10px;width:450px;">
				<textarea cols="60" rows="3" name="message"></textarea>				</td> 
				<td><input type='hidden' value='{$get_id}' name='get_id' >
				<input type='hidden' value='{$buyid}' name='buyid' >
				</td>
			</tr>
			
			<tr>
			  <td style="font-weight:bold;font-size:13px; vertical-align:top;padding-top:10px;width:100px;padding-left:12px;">Attach File </td>
			  <td align="left"><input type='file' value='' name='attach_file'><br>
			 <span style="color:red;"> Please upload only .jpg,.gif,.txt,.xls,.doc,.png,.pdf files only.</span>			  </td>
			  <td></td>
			  </tr>
			<tr>
				<td style="">{section name=cus loop=$citem}
					<input type="hidden" name="msgid" value="{$citem[cus].id}">
					<input type="hidden" name="sellerid" value="{$citem[cus].sellerid}">
					<input type="hidden" name="user_id" value="{$citem[cus].user_id}">
					{/section}				</td>
				<td style="">
					<input type="submit" name="submit" value="POST">				</td> 
				<td></td>
			</tr>
			</table>
			</form>
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