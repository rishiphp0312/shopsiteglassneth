{include file="admin_top.tpl"}
<script language="javascript">
{literal}
function confirm_msg(id,val)
{
//alert(val+'id');
if(val==1) 
	{
	jConfirm('Do you really want to delete this Item?', 'Confirm', function(r) 
	{
		if(r)
		{
			location.href='view_style.php?delete_item_value='+id;
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
	 
	
		  <!--<tr class="c1">
			<td bgcolor="#FFFFFF">Not Updated</td>
			<td width="19%" bgcolor="#FFFFFF"><select name="not_updated" id="not_updated">
			<option value="0">--Select--</option>
			<option value="3" {if $not_updated==3}selected{/if} >Last 3 Months</option>
			<option value="6" {if $not_updated==6}selected{/if}>Last 6 Months</option>
			<option value="12" {if $not_updated==12}selected{/if}>Last 12 Months</option>
			</select></td>
			<td bgcolor="#FFFFFF"></td>
			<td bgcolor="#FFFFFF"  nowrap>
		<input type="radio" name="status" value="1" {$chkActive}> Approved 
			<input type="radio" name="status" value="2" {$chkInActive}> Suspend <input type="radio" 
			name="status" value="12" {$chkBoth}> All</td>
			<td bgcolor="#FFFFFF">
			<input name="form_member_search" type="submit" id="form_member_search" class="button" 
			value="Search" />
			&nbsp; <input type="button" class="button" name="reset" 
			value="Clear Search" onClick="window.location='admin_reports_not_updatedproducts.php';" /></td>
		  </tr>-->
	
	
	<tr>
	<td align="right">
	<div style="float:left;">{$page_counter} Products</div> 
	<!--<input type="button" name="mail_all_users" value="Send Notification Email" class="button" onclick="window.location='admin_send_bulk_mail.php';" />
	 {if $usersList}
	 <input type="button" name="btnExport" value="Export Users" class="button" onclick="window.location='admin_export_users.php?{$smarty.server.QUERY_STRING}';" />
	{/if}
	</td> -->
	</tr>	
	<tr>
	  <td align="left" valign="top" class="border1">
      <table width="100%" cellpadding="4" cellspacing="2" align="center">
       {if $productList && $no_id_fetched!='0'}
		<tr class="listHeadRow"><td>S. No.</td>
                                        <td>Style</td>
		                                <td>Options</td>
		                        
		                       <!--<td>Status</td>-->
        </tr>
		{foreach name=prods from=$productList item=prod}
		
		<tr bgcolor="{cycle values='#f5f5f5,#e6e6e6'}">
          <td>
		  {if $smarty.request.pageNumber!="" && $smarty.request.pageNumber>1}
		  {assign var=pageconut value=$smarty.request.pageNumber-1}
		  {$smarty.const.ADMIN_PAGE_NUMBER*$pageconut+$smarty.foreach.prods.iteration}.
		  {else}
		  {$smarty.foreach.prods.iteration}.
		  {/if}		  </td>
          <td>
		 
		  {$prod.set_style|ucfirst}			  </td>
		  <td><a href="admin_add_style.php?style_id={$prod.style_id}	">	<img src="{$baseUrl}/images/edit_icon.png" alt="Edit" border="0" /></a>&nbsp;
		  <a href="javascript: void(0);" title="Delete" style="text-decoration:none;"
			   onclick="confirm_msg({$prod.style_id},{1});">
			  	<img src="{$baseUrl}/images/dlt_icon.png" alt="Delete" border="0" /></a>
		  
		 </td>
		  
		  <!--  <td>
		 {if $prod.status==0}
		  <a href="javascript: void(0);" title="Suspend It" style="text-decoration:none;" onclick="confirm_msg({$prod.item_id},{1});">Suspend</a>
		 &nbsp;|&nbsp;<a href="javascript: void(0);" title="Approve It" style="text-decoration:none;"onclick="confirm_msg({$prod.item_id},{2});">Approve</a>
		  {elseif $prod.status==1}
                  <a href="javascript: void(0);" title="Suspend it" style="text-decoration:none;" 
		  onclick="confirm_msg({$prod.item_id},{1});">Suspend</a>
                {elseif $prod.status==2}
                <a href="javascript: void(0);" title="Approve It" 
		style="text-decoration:none;" 
		 onclick="confirm_msg({$prod.item_id},{2});">Approve</a>

 {/if}
		  </td>-->
	    </tr>
		
		{/foreach}
        <tr>
			<td colspan="6">
			<div style="float:left;">{$page_counter} Products </div>
			 {if $pageLink}
			<div class="admn_pagination_msg_board">
			<span style="float:right;">{$pageLink}</span>			</div>
			 {/if}			</td>
        </tr>
		{else}
		
		<tr><td colspan="6"><div class="no_record_found">No record found...!</div></td></tr>
	
		{/if}
      </table>
</td>
	</tr>
</table>	  
{include file="admin_bottom.tpl"} 