{include file="admin_top.tpl"}
<script language="javascript">
{literal}
function confirm_msg(id)
{
	jConfirm('Do you really want to delete this page?', 'Confirm', function(r) 
	{
		if(r)
		{
			location.href='admin_cms.php?delete='+id;
		}
		else
		{
			return false;
		}	
	});
}
{/literal}
</script>
		 <table width="100%" cellpadding="5" cellspacing="10" align="center" border="0">
			<tr >
			  <td colspan="2" class="bar">
			  <a href="add_cms.php?page_id={$page_id_single}">{$page_title_single|clear_input}</a>&nbsp;
			  <span>Last Updated on {$posttime}</span>
			  <!--<a href="#" onclick="deleteCmsPage({$page_id_single});">-->
			  <div style="float:right;">
			  <a href="#" title="Delete Page" onclick="return confirm_msg({$page_id_single});">Delete Page</a>&nbsp;
			  <a href="add_cms.php?page_id={$page_id_single}" title="Edit Page">Edit Page</a>
			  </div>
			  </td>
			</tr>
			<tr>
			  <td valign="top" width="75%" style="padding:10px;" align="left">{$page_desc_single|clear_input}</td>
			  <td valign="top" width="25%">
			  <div style="border:1px solid #71890d; width:233px; height:auto;"><b style="padding-left:20px;">Pages:</b> <span style="padding-left:60px;"><a href="add_cms.php" title="Add New Page">Add New Page</a></span>
					   <div class="tx_ul">
						<ul >
					<!--<li><a href="admin_post_article.php">New page</a></li>-->
					{section name="l" loop="$page_id"}
						<li><a href="admin_cms.php?page_id={$page_id[l]}">{$page_title[l]|clear_input}</a></li>
					{/section}
				</ul>
				</div>
				</div>
				</td>
			</tr>
			</table>
{include file="admin_bottom.tpl"}