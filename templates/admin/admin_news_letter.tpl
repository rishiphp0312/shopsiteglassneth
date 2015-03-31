{include file="admin_header.tpl"}
<div id="content">
      <table width="100%" cellpadding="4" cellspacing="2" align="center">
        <tr>
          <td colspan="7" class="heading_strip">
		  <div style="float:left;">{$form_heading}</div> 
		  <div style="float:left; text-align:center; padding-left:25px;" class="error_msg" id="dispaly_suc_msg">
		  	{$update_msg}
		  </div> 
		  <div style="text-align:right;">
		  <a href="{$add_link}" style=" color:#009933; text-decoration:underline;" >{$add_label}</a>
		  </div>
		  </td>
        </tr>
        {if $categoryList}
		<tr class="listHeadRow">
          <td>S. No.</td>
          <td>Email Address</td>
		  <td>Created On</td>
          <td>Updated On </td>
          <td>Status</td>
		  <td>Options</td>
		</tr>
		{foreach name=cat from=$categoryList item=category}
		<tr bgcolor="{cycle values='#fafafa,#f5f5f5'}">
          <td>
		  {if $smarty.request.pageNumber!="" && $smarty.request.pageNumber>1}
		  {assign var=pageconut value=$smarty.request.pageNumber-1}
		  {$smarty.const.ADMIN_PAGE_NUMBER*$pageconut+$smarty.foreach.cat.iteration}
		  {else}
		  {$smarty.foreach.cat.iteration}.
		  {/if}
		  </td>
          <td>{$category.news_letter_email}</td>
		  <td>{$category.createdOn|date_format:"%B %d, %Y"}</td>
          <td>{$category.updatedOn|date_format:"%B %d, %Y"}</td>
          <td>{if $category.status==1}Active{else}InActive{/if}</td>
		  <td>
		  <!--<a href="javascript: void(0);" title="Edit" style="text-decoration:none;">
		  <img src="{$baseUrl}/images/edit_icon.png" alt="Edit" border="0" />
		  </a>&nbsp;&nbsp; -->
		  <a href="javascript: void(0);" title="Delete" style="text-decoration:none;" onclick="deleteRecord({$category.news_letter_id},'{$smarty.server.PHP_SELF|basename}');">
		  <img src="{$baseUrl}/images/dlt_icon.png" alt="Delete" border="0" />
		  </a></td>
		</tr>
		{/foreach}
       <tr>
			<td colspan="7">
				<div class="admn_pagination_msg_board">
					<span style="float:right;">{$pageLink}</span>
				</div>
			</td>
		</tr>
		{else}
		<tr><td colspan="7"><div class="cmps_scmsg">No record found...!</div></td></tr>
		{/if}
      </table>
</div>
{include file="admin_footer.tpl"} 