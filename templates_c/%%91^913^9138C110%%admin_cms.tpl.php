<?php /* Smarty version 2.6.18, created on 2012-02-28 11:12:22
         compiled from admin_cms.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'clear_input', 'admin_cms.tpl', 23, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin_top.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script language="javascript">
<?php echo '
function confirm_msg(id)
{
	jConfirm(\'Do you really want to delete this page?\', \'Confirm\', function(r) 
	{
		if(r)
		{
			location.href=\'admin_cms.php?delete=\'+id;
		}
		else
		{
			return false;
		}	
	});
}
'; ?>

</script>
		 <table width="100%" cellpadding="5" cellspacing="10" align="center" border="0">
			<tr >
			  <td colspan="2" class="bar">
			  <a href="add_cms.php?page_id=<?php echo $this->_tpl_vars['page_id_single']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['page_title_single'])) ? $this->_run_mod_handler('clear_input', true, $_tmp) : smarty_modifier_clear_input($_tmp)); ?>
</a>&nbsp;
			  <span>Last Updated on <?php echo $this->_tpl_vars['posttime']; ?>
</span>
			  <!--<a href="#" onclick="deleteCmsPage(<?php echo $this->_tpl_vars['page_id_single']; ?>
);">-->
			  <div style="float:right;">
			  <a href="#" title="Delete Page" onclick="return confirm_msg(<?php echo $this->_tpl_vars['page_id_single']; ?>
);">Delete Page</a>&nbsp;
			  <a href="add_cms.php?page_id=<?php echo $this->_tpl_vars['page_id_single']; ?>
" title="Edit Page">Edit Page</a>
			  </div>
			  </td>
			</tr>
			<tr>
			  <td valign="top" width="75%" style="padding:10px;" align="left"><?php echo ((is_array($_tmp=$this->_tpl_vars['page_desc_single'])) ? $this->_run_mod_handler('clear_input', true, $_tmp) : smarty_modifier_clear_input($_tmp)); ?>
</td>
			  <td valign="top" width="25%">
			  <div style="border:1px solid #71890d; width:233px; height:auto;"><b style="padding-left:20px;">Pages:</b> <span style="padding-left:60px;"><a href="add_cms.php" title="Add New Page">Add New Page</a></span>
					   <div class="tx_ul">
						<ul >
					<!--<li><a href="admin_post_article.php">New page</a></li>-->
					<?php unset($this->_sections['l']);
$this->_sections['l']['name'] = 'l';
$this->_sections['l']['loop'] = is_array($_loop=($this->_tpl_vars['page_id'])) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['l']['show'] = true;
$this->_sections['l']['max'] = $this->_sections['l']['loop'];
$this->_sections['l']['step'] = 1;
$this->_sections['l']['start'] = $this->_sections['l']['step'] > 0 ? 0 : $this->_sections['l']['loop']-1;
if ($this->_sections['l']['show']) {
    $this->_sections['l']['total'] = $this->_sections['l']['loop'];
    if ($this->_sections['l']['total'] == 0)
        $this->_sections['l']['show'] = false;
} else
    $this->_sections['l']['total'] = 0;
if ($this->_sections['l']['show']):

            for ($this->_sections['l']['index'] = $this->_sections['l']['start'], $this->_sections['l']['iteration'] = 1;
                 $this->_sections['l']['iteration'] <= $this->_sections['l']['total'];
                 $this->_sections['l']['index'] += $this->_sections['l']['step'], $this->_sections['l']['iteration']++):
$this->_sections['l']['rownum'] = $this->_sections['l']['iteration'];
$this->_sections['l']['index_prev'] = $this->_sections['l']['index'] - $this->_sections['l']['step'];
$this->_sections['l']['index_next'] = $this->_sections['l']['index'] + $this->_sections['l']['step'];
$this->_sections['l']['first']      = ($this->_sections['l']['iteration'] == 1);
$this->_sections['l']['last']       = ($this->_sections['l']['iteration'] == $this->_sections['l']['total']);
?>
						<li><a href="admin_cms.php?page_id=<?php echo $this->_tpl_vars['page_id'][$this->_sections['l']['index']]; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['page_title'][$this->_sections['l']['index']])) ? $this->_run_mod_handler('clear_input', true, $_tmp) : smarty_modifier_clear_input($_tmp)); ?>
</a></li>
					<?php endfor; endif; ?>
				</ul>
				</div>
				</div>
				</td>
			</tr>
			</table>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin_bottom.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>