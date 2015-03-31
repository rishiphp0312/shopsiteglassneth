{include file="admin_top.tpl"}
<script language="javascript">
{literal}

function confirm_msg(id,parent_id)
{

    if(parent_id==1)
 {
	var message = "Do you really want to delete this Slab ?";
	jConfirm('Do you really want to delete this Slab?', 'Confirm', function(r)
	{
		if(r)
		{
			location.href='admin_view_slabs.php?del_slab_id='+id;
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
	<tr>
	  <td align="left" valign="top" class="border1">
      <table width="100%" cellpadding="4" cellspacing="2" align="center">
       {if $slabList}
	  <tr class="listHeadRow">
              <td align='left' >S. No.</td>
              <td align='left'>Package Name</td>
              <td align='left'>Item Range</td>
              <td align='left'>Monthly Cost </td>
              <td align='left'>6  Month Cost </td>
              <td align='left'>12 Month Cost </td>
              <td align='left'>Created On</td>
              <td align='left'>Options</td>
          </tr>
            {foreach name=cat from=$slabList item=category}
		<tr bgcolor="{cycle values='#f5f5f5,#e6e6e6'}">
          <td>
		  {if $smarty.request.pageNumber!="" && $smarty.request.pageNumber>1}
		  {assign var=pageconut value=$smarty.request.pageNumber-1}
		  {$smarty.const.ADMIN_PAGE_NUMBER*$pageconut+$smarty.foreach.cat.iteration}.
		  {else}
		  {$smarty.foreach.cat.iteration}.
		  {/if}
		  </td>
          <td align='left' >{$category.package_name|ucfirst}</td>
          <td align='left'>{$category.start_item}&nbsp;-&nbsp;{$category.end_item}</td>
          <td align='left'>USD &nbsp;{$category.amount_1month } </td>
          <td align='left'>USD &nbsp;{$category.amount_6month } </td>
          <td align='left'>USD &nbsp;{$category.amount_12month } </td>
          <td align='left'>{$category.date_added|date_format:"%B %d, %Y" }</td>
          <td align='left'><a href='admin_add_slabs.php?slab_id={$category.cat_com_id }'><img src="{$baseUrl}/images/edit_icon.png" alt="Edit" border="0" /></a>&nbsp;&nbsp;
<a href="javascript:void(0);" onclick="confirm_msg({$category.cat_com_id},'1')"  ><img src="{$baseUrl}/images/dlt_icon.png" alt="Delete" border="0" />
		  </a></td>
		  

		</tr>
		{/foreach}

      <tr>
			<td colspan="8">
			<div style="float:left;">{$page_counter} records</div>
			<div class="admn_pagination_msg_board">
			<span style="float:right;">{$pageLink}</span>
			</div>
			</td>
        </tr>
		{else}
		<tr><td colspan="8"><div class="no_record_found">No record found...!</div></td></tr>
		{/if}
      </table>
</td>
	</tr>
</table>
{include file="admin_bottom.tpl"}