<?php /* Smarty version 2.6.18, created on 2012-02-28 05:40:37
         compiled from admin_approve_store.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'admin_approve_store.tpl', 71, false),array('function', 'cycle', 'admin_approve_store.tpl', 129, false),array('modifier', 'date_format', 'admin_approve_store.tpl', 149, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin_top.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script language="javascript">
<?php echo '
function confirm_msg(id,VAL)
{
 if(VAL==1)
 var STR=\'restore\';
 else
 var STR=\'suspend\';

 jConfirm(\'Do you really want to \'+STR+\' this store?\', \'Confirm\', function(r)
 {
  
  if(r)
  {
   location.href=\'admin_approve_store.php?approve_id=\'+id+\'&approve_store=\'+VAL;
  }
  else
  {
   return false;
  }

 });
}


function makeFeatured(user_id, fetured_status)
{
	if(fetured_status==1)
	var strMsg=\'featured\';
	else
	var strMsg=\'un-featured\';

       jConfirm(\'Do you really want to \'+strMsg+\' this store?\', \'Confirm\', function(r)
	{
		if(r)
		{
			location.href="admin_approve_store.php?action=featured&user_id="+user_id+"&fetured_status="+fetured_status;
		}
		else
		{
			return false;
		}
	});
}
'; ?>

</script>
<table width="100%"  border="0" cellspacing="10" cellpadding="5">
	<tr>
	  <td valign="middle" class="bar">Manage Sellers/Stores</td>
	</tr>
	<tr><td align="left" valign="top" class="border1">
	<form name="searchUser" id="searchUser" action="" method="get">
	<table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#D5F1FF">
		  <tr>
			<td colspan="4" class="subheading">Search Stores/Sellers</td>
		  </tr>
		  <tr>
			<td bgcolor="#FFFFFF">Username:</td>
			<td bgcolor="#FFFFFF"><input name="username" type="text" id="username" class="input" value="<?php echo $this->_tpl_vars['username']; ?>
" /></td>
		<td bgcolor="#FFFFFF">	<!--Store Name:--></td>
			<td bgcolor="#FFFFFF"><!--<input name="store_name"
type="text" id="store_name" class="input" value="<?php echo $this->_tpl_vars['store_name']; ?>
" />--></td>
			<td bgcolor="#FFFFFF">Email:</td>
			<td bgcolor="#FFFFFF"><input name="Email" type="text" id="Email" class="input" value="<?php echo $this->_tpl_vars['Email']; ?>
" /></td>
		  </tr>
  <tr>
			<td bgcolor="#FFFFFF">Country:</td>
			<td bgcolor="#FFFFFF"><select  name="country_value"  id="country_value" class="input required" style="width:175px">
					<option values='0'>-- Select Country--</option>
<?php echo smarty_function_html_options(array('values' => $this->_tpl_vars['countryID'],'output' => $this->_tpl_vars['countryName'],'selected' => $this->_tpl_vars['selectcountry']), $this);?>

				</select></td>
			<td bgcolor="#FFFFFF">State:</td>
			<td bgcolor="#FFFFFF">
<input name="state" type="text" id="state" class="input" value="<?php echo $this->_tpl_vars['state']; ?>
" /></td>
			<td bgcolor="#FFFFFF" >City :

			&nbsp;</td><td bgcolor="#FFFFFF" ><input name="city" type="text" id="city" class="input" value="<?php echo $this->_tpl_vars['city']; ?>
" /> </td>
		  </tr>
 <tr>
			<td bgcolor="#FFFFFF">Date of<br> Registration</td>
			<td bgcolor="#FFFFFF" colspan='5' ><select style='font-size:12px;width:70px;'  name="sel_days">
                 <option value='0' >--Days--</option>
		 <?php echo smarty_function_html_options(array('values' => $this->_tpl_vars['no_of_days_curentmonth'],'output' => $this->_tpl_vars['no_of_days_curentmonth'],'selected' => $this->_tpl_vars['sel_days']), $this);?>

			</select>&nbsp;Day&nbsp;&nbsp;&nbsp;<select name="sel_month">
                       <option value='0' >--Month--</option>
		       <?php echo smarty_function_html_options(array('values' => $this->_tpl_vars['array_for_id'],'output' => $this->_tpl_vars['array_for_month'],'selected' => $this->_tpl_vars['sel_month']), $this);?>

			</select> Month&nbsp;&nbsp;&nbsp;
		    <select name="sel_year">
                  
		 <?php echo smarty_function_html_options(array('values' => $this->_tpl_vars['year_12'],'output' => $this->_tpl_vars['year_12'],'selected' => $this->_tpl_vars['sel_year']), $this);?>

			</select>&nbsp;Year</td>
			
		  </tr>
		  <tr>
			<td bgcolor="#FFFFFF">First Name:</td>
			<td bgcolor="#FFFFFF"><input name="FirstName" type="text" id="keywords" class="input" value="<?php echo $this->_tpl_vars['FirstName']; ?>
" /></td>
			<td bgcolor="#FFFFFF">Last Name:</td>
			<td bgcolor="#FFFFFF"><input name="LastName" type="text" id="keywords" class="input" value="<?php echo $this->_tpl_vars['LastName']; ?>
" /></td>
			<td bgcolor="#FFFFFF" colspan="2">
                        <input name="form_member_search" type="submit" id="form_member_search" class="button" value="Search" />
			&nbsp; <input type="button" class="button" name="reset" value="Clear Search" onclick="window.location='admin_approve_store.php';" /></td>
		  </tr>
	  </table>
	  </form>
	</td>
	</tr>
	<tr>
	<td align="right">
	<div style="float:left;"><?php echo $this->_tpl_vars['page_counter']; ?>
 Users</div> 
	</td>
	</tr>	
	<tr>
	  <td align="left" valign="top" class="border1">
      <table width="100%" cellpadding="4" cellspacing="2" align="center">
       <?php if ($this->_tpl_vars['usersList']): ?>
	<tr class="listHeadRow">
          <td>S. No.</td>
          <td>Username</td>
	  <td>Name</td>
	  <!--<td>Store Name</td>-->
	  <td>Country</td><td>State</td><td>City</td>
	  <td>Email</td>
	  <td>Registration Date</td>
          <td>Suspended</td>
	  <td>Featured</td>
	</tr>
	<?php $_from = $this->_tpl_vars['usersList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['users'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['users']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['user']):
        $this->_foreach['users']['iteration']++;
?>
	<tr bgcolor="<?php echo smarty_function_cycle(array('values' => '#f5f5f5,#e6e6e6'), $this);?>
">
	<td>
	  <?php if ($_REQUEST['pageNumber'] != "" && $_REQUEST['pageNumber'] > 1): ?>
	  <?php $this->assign('pageconut', $_REQUEST['pageNumber']-1); ?>
	  <?php echo @ADMIN_PAGE_NUMBER*$this->_tpl_vars['pageconut']+$this->_foreach['users']['iteration']; ?>
.
	  <?php else: ?>
	  <?php echo $this->_foreach['users']['iteration']; ?>
.
	  <?php endif; ?>
	  </td>
          <td>
	  <a href="admin_add_users.php?user_id=<?php echo $this->_tpl_vars['user']['user_id_value']; ?>
&user_type=<?php echo $this->_tpl_vars['user']['user_type']; ?>
" title="View Details" style="font-weight:normal;">
	  <?php echo $this->_tpl_vars['user']['username']; ?>

	  </a>
	  </td>
	  <td><?php echo $this->_tpl_vars['user']['first_name']; ?>
 <?php echo $this->_tpl_vars['user']['last_name']; ?>
</td>
	  <!--<td><?php echo $this->_tpl_vars['user']['store_name']; ?>
</td>  -->
	  <td><?php echo $this->_tpl_vars['user']['country']; ?>
</td>  
	  <td><?php echo $this->_tpl_vars['user']['state']; ?>
</td>  
	  <td><?php echo $this->_tpl_vars['user']['city']; ?>
</td>
	  <td><?php echo $this->_tpl_vars['user']['email']; ?>
</td>
	  <td><?php echo ((is_array($_tmp=$this->_tpl_vars['user']['reg_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%b %d, %Y") : smarty_modifier_date_format($_tmp, "%b %d, %Y")); ?>
</td>
          <td>
	  <?php if ($this->_tpl_vars['user']['approve_store'] == 1): ?>
	  <a href="javascript: void(0);" title="Suspend It" style="text-decoration:none;" onclick="confirm_msg(<?php echo $this->_tpl_vars['user']['user_id_value']; ?>
, 0);">No</a>
	  <?php else: ?>
	  <a href="javascript: void(0);" title="Restore It" style="text-decoration:none;" onclick="confirm_msg(<?php echo $this->_tpl_vars['user']['user_id_value']; ?>
, 1);">Yes</a>
	  <?php endif; ?>
	  </td>
	  <td>
	  <?php if ($this->_tpl_vars['user']['v_status'] == 1): ?>
	  <a href="javascript: void(0);" title="Un-Featured It" style="text-decoration:none;" onclick="makeFeatured(<?php echo $this->_tpl_vars['user']['user_id_value']; ?>
,0);">Yes</a>
	  <?php else: ?>
	  <a href="javascript: void(0);" title="Featured It" style="text-decoration:none;" onclick="makeFeatured(<?php echo $this->_tpl_vars['user']['user_id_value']; ?>
,1);">No</a>
	  <?php endif; ?>
	</td>
	</tr>
	<?php endforeach; endif; unset($_from); ?>
        <tr>
		<td colspan="8">
		<div style="float:left;"><?php echo $this->_tpl_vars['page_counter']; ?>
 Users</div>
		 <?php if ($this->_tpl_vars['pageLink']): ?>
		<div class="admn_pagination_msg_board"><span style="float:right;"><?php echo $this->_tpl_vars['pageLink']; ?>
</span></div>
		<?php endif; ?>
	</td>
        </tr>
		<?php else: ?>
		<tr><td colspan="8"><div class="no_record_found">No record found...!</div></td></tr>
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