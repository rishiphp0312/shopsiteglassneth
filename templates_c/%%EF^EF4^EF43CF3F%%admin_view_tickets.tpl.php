<?php /* Smarty version 2.6.18, created on 2012-03-05 17:52:17
         compiled from admin_view_tickets.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'admin_view_tickets.tpl', 52, false),array('function', 'cycle', 'admin_view_tickets.tpl', 147, false),array('modifier', 'ucfirst', 'admin_view_tickets.tpl', 160, false),array('modifier', 'date_format', 'admin_view_tickets.tpl', 176, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin_top.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
  <script language="JavaScript" src="../calendar_us.js"></script>
  <link rel="stylesheet" href="../calendar.css">
  <script language="javascript">
  <?php echo '
function confirm_msg(id,val)
{
//alert(val+\'id\');


 if(val==5)
	{
	jConfirm(\'Do you really want to Close this Ticket?\', \'Confirm\', function(r) 
	{
		if(r)
		{
			location.href=\'admin_view_tickets.php?close_ticket_id=\'+id;
		}
		else
		{
			return false;
		}	
	});
	}


}
 

'; ?>

</script>
<table width="100%"  border="0" cellspacing="10" cellpadding="5">
	<tr>
	  <td valign="middle" class="bar"><?php echo $this->_tpl_vars['form_heading']; ?>
</td>
	</tr>
	 <tr><td align="left" valign="top" class="border1">
	 <form action="" method="get" name="serch_tick" id="serch_tick">
	 <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#D5F1FF">
		
		  <tr class="c3">
			<td colspan="5" class="subheading">Search Tickets </td>
		  </tr>
					
		  <tr align="left" valign="top" class="c1">
			<td width="3%" bgcolor="#FFFFFF"><b>Status&nbsp;:</b></td>
			<td width="25%" colspan="2"  align="left"  nowrap bgcolor="#FFFFFF">

				<input type="radio" <?php if ($this->_tpl_vars['serch_status'] == '' || $this->_tpl_vars['serch_status'] == 2): ?>checked="checked" <?php endif; ?> value="2" name="serch_status"  />
				&nbsp;All &nbsp;&nbsp;<input type="radio"  <?php if ($this->_tpl_vars['serch_status'] == 1 && $this->_tpl_vars['serch_status'] != ''): ?> checked="checked" <?php endif; ?> value="1" name="serch_status" />&nbsp;Closed &nbsp;&nbsp;<input type="radio" <?php if ($this->_tpl_vars['serch_status'] == 0 && $this->_tpl_vars['serch_status'] != ''): ?> checked="checked" <?php endif; ?> value="0" name="serch_status" />Open&nbsp;&nbsp;							 </td>
		    <td  align="left"  nowrap bgcolor="#FFFFFF"><b>Request Type&nbsp;:&nbsp;</b>
			</select>			<select	class='required'  style="font-size:12px;" name='request_type' id='request_type' >
							<?php echo smarty_function_html_options(array('values' => ($this->_tpl_vars['contactValue']),'output' => ($this->_tpl_vars['contactOut']),'selected' => ($this->_tpl_vars['contact'])), $this);?>

<!--<option value="0">--Select--</option>
							<option value="Payment" <?php if ($this->_tpl_vars['request_type'] == 'Payment'): ?>'selected'<?php endif; ?>>Payment</option>
								
							
							<option value="Shipping"<?php if ($this->_tpl_vars['request_type'] == 'Shipping'): ?>'selected'<?php endif; ?>>Shipping</option>
							<option value="Product"<?php if ($this->_tpl_vars['request_type'] == 'Product'): ?>'selected'<?php endif; ?>>Product</option>
							<option value="Suggestions" <?php if ($this->_tpl_vars['request_type'] == 'Suggestions'): ?>'selected'<?php endif; ?>>Suggestions</option>
							<option value="Queries" <?php if ($this->_tpl_vars['request_type'] == 'Queries'): ?>'selected'<?php endif; ?>>
Queries</option>-->
            </select></td>
		    <td  align="left"  nowrap bgcolor="#FFFFFF"><!--
<b>Priority&nbsp;:&nbsp;</b><select name="priority" style="font-size:12px;" >
			<option value="0">--Select--</option>
			<option value="Low" <?php if ($this->_tpl_vars['priority'] == 'Low'): ?>'selected'<?php endif; ?>>Low</option>
			<option value="Medium"  <?php if ($this->_tpl_vars['priority'] == 'Medium'): ?>'selected'<?php endif; ?>>Med</option>
			<option value="High"  <?php if ($this->_tpl_vars['priority'] == 'High'): ?>'selected'<?php endif; ?>>High</option>
</select>
--></td>
		    <td width="5%"  align="left"  nowrap bgcolor="#FFFFFF">
			
			<b>Ticket ID&nbsp; :</b> <input style="width:80px;" type="text" value="<?php echo $this->_tpl_vars['ticket_id']; ?>
" name="ticket_id" /></td>
		  </tr>
		  <tr align="left" valign="top" class="c1">
			<td width="3%" nowrap="nowrap" bgcolor="#FFFFFF"><b>From Date &nbsp;:</b></td>
			<td width="25%"  align="left"  nowrap bgcolor="#FFFFFF">
			<input type="text" name="start_date" id='start_date' style="width:100px;" value="<?php echo $this->_tpl_vars['start_date']; ?>
" />
						  <?php echo '
	<script language="JavaScript">
	var o_cal = new tcal ({
		// form name
		\'formname\': \'serch_tick\',
		// input name
		\'controlname\': \'start_date\'
	});
	
	// individual template parameters can be modified via the calendar variable
	o_cal.a_tpl.yearscroll = false;
	o_cal.a_tpl.weekstart = 1;
	
	</script>
		 '; ?>
</td>
		    <td colspan="2"  align="left"  nowrap bgcolor="#FFFFFF"><b>To Date&nbsp;:</b> <input type="text" value="<?php echo $this->_tpl_vars['end_date']; ?>
" style="width:100px;"
			 name="end_date" id="myOtherInput" class='required' />
&nbsp; <?php echo '
<script language="JavaScript">

	// whole calendar template can be redefined per individual calendar
	var A_CALTPL = {
		\'months\' : [\'Jannuary\', \'Febraury\', \'March\', \'April\', \'May\', \'June\', \'July\', \'August\', \'September\', \'October\', \'November\', \'December\'],
		\'weekdays\' : [ \'Mo\', \'Tu\', \'We\', \'Th\', \'Fr\', \'Sa\',\'Su\'],
		\'yearscroll\': true,
		\'weekstart\': 0,
		\'centyear\'  : 70,
		\'imgpath\' : \'../img/\'
	}
	
	new tcal ({
		// if referenced by ID then form name is not required
		\'controlname\': \'myOtherInput\'
	}, A_CALTPL);
	</script>
		 '; ?>
 	</td>
		    <td colspan="2"  align="center"  nowrap bgcolor="#FFFFFF"><input type="submit" value="Search" name="search" class="button"  style="width:70px;" />&nbsp;&nbsp;&nbsp;		      <input type="button" class="button" name="reset" value="Clear Search" onclick="window.location='admin_view_tickets.php';" /></td>
	      </tr>
	  </table>	
	 </form>
	</td>
	</tr>
	<tr>
	<td align="right">
	<div style="float:left;"><?php echo $this->_tpl_vars['page_counter']; ?>
 Tickets </div> 
	<!--<input type="button" name="mail_all_users" value="Send Notification Email" class="button" onclick="window.location='admin_send_bulk_mail.php';" />
	 <?php if ($this->_tpl_vars['usersList']): ?>
	 <input type="button" name="btnExport" value="Export Users" class="button" onclick="window.location='admin_export_users.php?<?php echo $_SERVER['QUERY_STRING']; ?>
';" />
	<?php endif; ?>
	</td> -->
	</tr>	
	<tr>
	  <td align="left" valign="top" class="border1">
      <table width="100%" cellpadding="4" cellspacing="2" align="center">
       <?php if ($this->_tpl_vars['TicketList'] != ''): ?>
		<tr align="left" valign="top" class="listHeadRow">
		<td valign="top" nowrap="nowrap">S. No.</td>
		     <td align="left" valign="top">Ticket ID</td>
                                        <td align="left" valign="top">Subject</td>
		                                <!--<td align="left" valign="top">Priority</td>-->
		                                <td align="left" valign="top" nowrap="nowrap">Request Type</td>
		                                <td valign="top" nowrap="nowrap">Status</td>
		                                <td valign="top" nowrap="nowrap">Date Ticket Created</td>
                                        <!--<td>Status</td>-->
		                       <td valign="top" nowrap="nowrap">Options</td>
		</tr>
		<?php $_from = $this->_tpl_vars['TicketList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['prods'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['prods']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['prod']):
        $this->_foreach['prods']['iteration']++;
?>
		
		<tr align="left" valign="top" bgcolor="<?php echo smarty_function_cycle(array('values' => '#f5f5f5,#e6e6e6'), $this);?>
">
          <td>
		  <?php if ($_REQUEST['pageNumber'] != "" && $_REQUEST['pageNumber'] > 1): ?>
		  <?php $this->assign('pageconut', $_REQUEST['pageNumber']-1); ?>
		  <?php echo @ADMIN_PAGE_NUMBER*$this->_tpl_vars['pageconut']+$this->_foreach['prods']['iteration']; ?>
.
		  <?php else: ?>
		  <?php echo $this->_foreach['prods']['iteration']; ?>
.
		  <?php endif; ?>		  </td>
		  <td align="left" valign="top">
		  <?php echo $this->_tpl_vars['prod']['ticket_id']; ?>

		  </td>
          <td align="left" valign="top">
		
		  <?php echo ((is_array($_tmp=$this->_tpl_vars['prod']['subject'])) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
		  </td>
		 <!-- <td align="left" valign="top">
		  <?php if ($this->_tpl_vars['prod']['priority'] != ''): ?>
		  <?php echo ((is_array($_tmp=$this->_tpl_vars['prod']['priority'])) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>

		  <?php else: ?>
		  NA
		  <?php endif; ?>
		  </td>-->
		  <td align="left" valign="top">
		    <?php if ($this->_tpl_vars['prod']['request_type'] != ''): ?>
		  <?php echo ((is_array($_tmp=$this->_tpl_vars['prod']['request_type'])) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>

		  <?php else: ?>
		  NA
		  <?php endif; ?>
		 </td>
		  <td align="left" valign="top"><?php if ($this->_tpl_vars['prod']['status'] == 0): ?>Open<?php else: ?>Closed<?php endif; ?></td>
		  <td align="left" valign="top"><?php echo ((is_array($_tmp=$this->_tpl_vars['prod']['date_genrated'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%b %d, %Y") : smarty_modifier_date_format($_tmp, "%b %d, %Y")); ?>
</td>
          <td nowrap>
			  <a href="admin_reply_ticket.php?ticket_id=<?php echo $this->_tpl_vars['prod']['ticket_id']; ?>
" 
			  style="text-decoration:none;" title="Reply">
			  	<img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
/images/details_btn.jpg" alt="Reply Ticket" border="0" />			  </a> &nbsp; &nbsp;
			   <a href="javascript: void(0);" title=" Close Ticket " style="text-decoration:none;" onclick="confirm_msg(<?php echo $this->_tpl_vars['prod']['ticket_id']; ?>
,<?php echo 5; ?>
);">
			  	<img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
/images/close_icon.jpg" alt="Close Ticket" border="0" /></a>		</td>
		</tr>
		
		<?php endforeach; endif; unset($_from); ?>
        <tr>
			<td colspan="9">
			<div style="float:left;"><?php echo $this->_tpl_vars['page_counter']; ?>
 Tickets </div>
			 <?php if ($this->_tpl_vars['pageLink']): ?>
			<div class="admn_pagination_msg_board">
			<span style="float:right;"><?php echo $this->_tpl_vars['pageLink']; ?>
</span>			</div>
			 <?php endif; ?>			</td>
        </tr>
		<?php else: ?>
		
		<tr><td colspan="9"><div class="no_record_found">No record found...!</div></td></tr>
	
		<?php endif; ?>
      </table>
</td>
	</tr>
</table>	  
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin_bottom.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> 