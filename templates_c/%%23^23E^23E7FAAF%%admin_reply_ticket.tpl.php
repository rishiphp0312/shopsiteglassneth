<?php /* Smarty version 2.6.18, created on 2012-03-05 17:52:22
         compiled from admin_reply_ticket.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'ucfirst', 'admin_reply_ticket.tpl', 83, false),array('modifier', 'date_format', 'admin_reply_ticket.tpl', 114, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin_top.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php echo '
<SCRIPT language="JavaScript1.2">
function page_url(PAGE_NAME)
{
window.location.href=PAGE_NAME;

}
function confirm_msg(id, parent_id)
{
	var message = "Do you really want to delete this image?";
	//if(id==0)
	//{
	//	message += "\\n This action also delete all child categories associated with this.";
	//	jAlert("You can not delete a parent category.",\'Error\');
	//	return false;	
	//}
	jConfirm(message, \'Confirm\', function(r) 
	{
		if(r)
		{
			location.href=\'admin_view_product_detail.php?unlink_this_img=\'+id+\'&col_position=\'+parent_id;
		}
		else
		{
			return false;
		}	
	});
}


</SCRIPT>
			
'; ?>
	

  <table width="100%"  border="0" cellspacing="10" cellpadding="5">
	<tr>
	  <td valign="middle" class="bar">View Ticket Detail</td>
	</tr>
	<tr>
	  <td align="left" valign="top" class="border1">
	  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr><td></td></tr>
		<tr></tr>
		<tr>
		  <td width="710" class="lback">
		 
			 <table width="100%" border="0" cellspacing="0" cellpadding="4">
				 
					
			<!--	  <tr>
				  <td colspan='3' width="32%" align="left" class="text"> <input name="approve" type="submit" class="button" value="Approve" />
					&nbsp;  <input name="suspend" type="submit" class="button" value="Suspend" />
					 &nbsp; <input name="cancel" type="reset" class="button" value="Cancel" 
					  onclick="window.location='admin_products_listing.php'" />
			</td>
				  
				</tr>-->
				 
				 <tr valign="top">
				   <td align="left" class="text"><b>Username&nbsp; :</b></td>
				   <td align='left'><?php echo $this->_tpl_vars['username_reciver']; ?>
</td>
				   <td width="20%" align='right' class="text" ><b>Email&nbsp; :</b> </td>
			       <td width="25%" align='left' class="text" ><?php echo $this->_tpl_vars['email_from_reciver']; ?>
</td>
			    </tr>
												 <tr align="left" valign="top">
				   <td class="text"><b>Name&nbsp; :</b></td>
				   <td><?php echo $this->_tpl_vars['name_from_reciver']; ?>
</td>
				   <td align="right" ><b>Phone No&nbsp; :</b></td>
			       <td align="left" ><?php echo $this->_tpl_vars['phone_no']; ?>
</td>
			   </tr>
			   
			   
					
			   				 
				<tr align="left" valign="top">
				  <td width="17%" class="text"><b>Request Type&nbsp;:</b> </td>
				  <td width="38%"> <?php if ($this->_tpl_vars['request_type'] != ''): ?>
		  <?php echo ((is_array($_tmp=$this->_tpl_vars['request_type'])) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>

		  <?php else: ?>
		  NA
		  <?php endif; ?>				</td>
				

		
				  <td align="right" valign="top"><b>Priority&nbsp;:</b></td>
		          <td><?php if ($this->_tpl_vars['priority'] != ''): ?>
		  <?php echo ((is_array($_tmp=$this->_tpl_vars['priority'])) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>

		  <?php else: ?>
		  NA
		  <?php endif; ?></td>
			   </tr>
			   
				<tr align="left" valign="top">
				  <td width="17%" class="text"></td>
				  <td width="38%">				  </td>
				

		
				  <td colspan="2">			</td>
			   </tr>
				<tr align="left" valign="top">
				  <td width="17%" class="text"><b>Status&nbsp;:</b></td>
				  <td width="38%">
				<?php if ($this->_tpl_vars['status'] == 0): ?>Open <?php else: ?>Closed <?php endif; ?></td>
				

		
				  <td align="right"><b>Date Created : </b></td>
			      <td><?php echo ((is_array($_tmp=$this->_tpl_vars['date_genrated'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</td>
			   </tr>
				<tr align="left" valign="top">
				  <td width="17%" class="text"><b>Subject&nbsp;:</b> </td>
				  <td colspan="3"><?php echo $this->_tpl_vars['subject']; ?>
				</td>
			   </tr>
				 <tr align="left" valign="top">
				  <td width="17%" class="text"><b>Message&nbsp; :</b></td>
				  <td colspan="3"><?php echo $this->_tpl_vars['message']; ?>
				</td>
			   </tr>
				
				<tr align="left" valign="top">
				  <td class="text">&nbsp;</td>
				  <td></td>
				  <td colspan="2">&nbsp;</td>
			   </tr>
				 <?php if ($this->_tpl_vars['num_rows_items1'] > 0): ?>
			<?php $_from = $this->_tpl_vars['ticket_reply_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['cat'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['cat']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['val_items']):
        $this->_foreach['cat']['iteration']++;
?>
				
				<tr>
				  <td colspan="4" align="left" class="text" style="padding:0px;">
				  <table align="center" width="100%" cellpadding="4" cellspacing="0" 
				  border="0">  
				    <tr align="left" valign="top">
				        <td width="13%" colspan="4" bgcolor="#ECF5FF">&nbsp;</td>
				  </tr>
				  
				  <tr align="left" valign="top">
				        <td class="text" width="17%" ><b>Reply&nbsp;:</b></td>
						<td colspan="3" align="left" valign="top"><?php echo ((is_array($_tmp=$this->_tpl_vars['val_items']['message'])) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
</td>
				  </tr>
				  
				  <tr align="left" valign="top">
				        <td width="13%"><b>Posted On&nbsp;:</b></td>
						<td width="60%" valign="top"><?php echo ((is_array($_tmp=$this->_tpl_vars['val_items']['date_genrated'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%b %d, %Y") : smarty_modifier_date_format($_tmp, "%b %d, %Y")); ?>
</td>
				        <td width="13%"><b>Posted By&nbsp;: </b></td>
				        <td width="14%" valign="top"><?php if ($this->_tpl_vars['val_items']['user_id'] == 0): ?>Admin<?php else: ?>User<?php endif; ?></td>
				  </tr>
				  </table>				  </td>
				</tr>
								<?php endforeach; endif; unset($_from); ?>
				
				<?php else: ?>
				  <!--<tr>
				<td colspan="3" align="left" class="text" style="text-align:center;font-size:12px;font-family:Arial, Helvetica, sans-serif;font-weight:400;color:#FF0000;">
				  No reply found!!</td>
				</tr>-->
				<?php endif; ?>
				<tr>
				
				  <td colspan="4" class="text" align="left" valign="top" >&nbsp;</td></tr>
					<tr>
					<form name="frm_rep_ticket"  action="" method="post">
				  <td colspan="4" class="text" align="left" valign="top"  <?php if ($this->_tpl_vars['status'] == 0): ?>style="border:1px solid #AF6161;"<?php endif; ?>>
				  <?php if ($this->_tpl_vars['status'] == 0): ?>
				  
				 <table align="center" width="100%" cellpadding="3" cellspacing="0" border="0">
				 
				 <tr style="background-color:#EEEEEE;">
				   <td colspan="2" align="left" valign="top" style="font-family:Verdana, Arial, Helvetica, sans-serif;font-size:14px;font-weight:bold;color:#804040;text-align:left;">Post Reply</td>
				   <td align="left" valign="top">&nbsp;</td>
				   </tr>
				 
				 
				 <tr>
				       <td colspan="2" align="left" valign="top"><b>Message&nbsp;&nbsp;</b><b>:</b></td>
					   <td width="89%" align="left" valign="top"><textarea name="message" rows="10" cols="50"></textarea></td>
				</tr>
				 <tr>
				   <td width="15%" align="left" valign="top" nowrap><b>Close Ticket</b>&nbsp;<b>:</b></td>
				   <td width="1%" align="left" valign="top">&nbsp;</td>
				   <td align="left" valign="top"><input type="checkbox" value="1" name="chk_close"></td>
				   </tr>
				 <tr>
				        <td align="left" valign="top"><input type="hidden"  name="ticket_id" value="<?php echo $this->_tpl_vars['ticket_id']; ?>
"></td>
						
				        <td align="left" valign="top">&nbsp;</td>
				        <td align="left" valign="top">
						<input class="button"   type="submit" value=" Post "
						 name="submit">&nbsp;&nbsp;		<input class="button"   type="button" onClick="window.location.href='admin_view_tickets.php'"  value=" Cancel " name="submit">				</td>
				 </tr>
				 </table>
				 <?php endif; ?>				  </td></form>
				</tr>
			</table>
		  </td>
		</tr>
	</table>
	</td>
	</tr>
</table>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin_bottom.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>