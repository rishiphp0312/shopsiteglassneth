{include file="admin_top.tpl"}
<script language="javascript">
{literal}
function confirm_msg(id, parent_id)
{
	var message = "Do you really want to delete this category?";
	if(parent_id==0)
	{
		message += "\n This action also delete all child categories associated with this.";
		jAlert("You can not delete a parent category.",'Error');
		return false;	
	}
	jConfirm(message, 'Confirm', function(r) 
	{
		if(r)
		{
			location.href='admin_category.php?delete='+id;
		}
		else
		{
			return false;
		}	
	});
}
{/literal}
</script>
<table width="100%"  border="0" cellspacing="10" cellpadding="5">
	<tr>
	  <td valign="middle" class="bar">{$form_heading}</td>
	</tr>
	<tr>
	  <td align="left" valign="top" class="border1">
      <table width="100%" cellpadding="4" cellspacing="2" align="center">
       {if $categoryList}
		<tr class="listHeadRow">
                  <td>S. No.</td>
                  <td>{$name_label}</td>
		  <td>Parent</td>
		  <td>Commision  </td>
                  <td>Created On</td>
                  <td>Updated On </td>
                  <td>Status</td>
		  <td>Options</td>
		</tr>
		{foreach name=cat from=$categoryList item=category}
		<tr bgcolor="{cycle values='#f5f5f5,#e6e6e6'}">
          <td>
		  {if $smarty.request.pageNumber!="" && $smarty.request.pageNumber>1}
		  {assign var=pageconut value=$smarty.request.pageNumber-1}
		  {$smarty.const.ADMIN_PAGE_NUMBER*$pageconut+$smarty.foreach.cat.iteration}.
		  {else}
		  {$smarty.foreach.cat.iteration}.
		  {/if}
		  </td>
                  <td>{$category.name|clear_input}</td>
		  <td>{$parentCAT[$category.parent_id]}</td>
                  <td>{if $category.parent_id==0}{$category.commision}%{else}NA{/if}</td>

		  <td>{$category.createdOn|date_format:"%B %d, %Y"}</td>
                  <td>{$category.updatedOn|date_format:"%B %d, %Y"}</td>
                  <td>{if $category.status==1}Active{else}InActive{/if}</td>
		  <td><a href="{$add_link}?id={$category.category_id}" title="Edit" style="text-decoration:none;">
		  <img src="{$baseUrl}/images/edit_icon.png" alt="Edit" border="0" />
		  </a>&nbsp;&nbsp;<a href="javascript: void(0);" title="Delete" style="text-decoration:none;" 
		  onclick="confirm_msg({$category.category_id},{$category.parent_id});"><img src="{$baseUrl}/images/dlt_icon.png" alt="Delete" border="0" />
		  </a>		  
		  </td>
		</tr>
		{/foreach}
        <tr>
			<td colspan="7">
			<div style="float:left;">{$page_counter} records</div>
			<div class="admn_pagination_msg_board">
			<span style="float:right;">{$pageLink}</span>
			</div>
			</td>
        </tr>
		{else}
		<tr><td colspan="7"><div class="no_record_found">No record found...!</div></td></tr>
		{/if}
      </table>
</td>
	</tr>
</table>	  
{include file="admin_bottom.tpl"}