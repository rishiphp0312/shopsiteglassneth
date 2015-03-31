{include file="admin_top.tpl"}
<script language="javascript">
{literal}
function deleteTutorial(tute_id)
{
 	jConfirm('Do you really want to delete this tutorial?', 'Confirm', function(r) 
	{
		if(r)
		{
			window.location.href='admin_tutorials.php?action=delete&tute_id='+tute_id;
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
	  <td valign="middle" class="bar">Manage Tutorials</td>
	</tr>
	<tr>
	  <td align="left" valign="top" class="border1">
      <table width="100%" cellpadding="4" cellspacing="2" align="center">
       {if $tuteList}
	<tr class="listHeadRow">
          <td>S. No.</td>
          <td>Language</td>
	  <td>Tutorial</td>
	  <td>Created On</td>
	  <td>Modified On</td>
	  <td>Options</td>
	</tr>
	{foreach name=tutes from=$tuteList item=tute}
	<tr bgcolor="{cycle values='#f5f5f5,#e6e6e6'}">
	  <td>
	  {if $smarty.request.pageNumber!="" && $smarty.request.pageNumber>1}
	  {assign var=pageconut value=$smarty.request.pageNumber-1}
	  {$smarty.const.ADMIN_PAGE_NUMBER*$pageconut+$smarty.foreach.tutes.iteration}.
	  {else}
	  {$smarty.foreach.tutes.iteration}.
	  {/if}
	  </td>
          <td>{$tute.tute_language}</td>
	  <td>{$tute.tute_video}</td>
	  <td>{$tute.created|date_format:"%b %d, %Y"}</td>
	  <td>{$tute.modified|date_format:"%b %d, %Y"}</td>
	  <td>
		 <a href="admin_add_tutorial.php?tute_id={$tute.tute_id}" style="text-decoration:none;" title="Edit">
		 <img src="{$baseUrl}/images/edit_icon.png" alt="Edit" border="0" />
		 </a>&nbsp;
		 <a href="javascript: void(0);" title="Delete" style="text-decoration:none;" onclick="deleteTutorial({$tute.tute_id});">
		 <img src="{$baseUrl}/images/dlt_icon.png" alt="Delete" border="0" />
		 </a>
	    </td>
	</tr>
	{/foreach}
        <tr>
		<td colspan="6">
		<div style="float:left;">{$page_counter} tutorials</div>
		 {if $pageLink}
		<div class="admn_pagination_msg_board">
		<span style="float:right;">{$pageLink}</span>
		</div>
		 {/if}
		</td>
        </tr>
	{else}
	<tr><td><div class="no_record_found">No tutorials found...!</div></td></tr>
	{/if}
      </table>
</td>
</tr>
</table>	  
{include file="admin_bottom.tpl"} 