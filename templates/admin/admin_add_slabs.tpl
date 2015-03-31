{include file="admin_top.tpl"}
{literal}
<script>
function show_commsion()
{
var sel_val =  document.getElementById('parent_id').value;

if(sel_val==0)
document.getElementById('row_com_id').style.display='';
else
document.getElementById('row_com_id').style.display='none';

}

</script>
{/literal}

  <table width="100%"  border="0" cellspacing="10" cellpadding="5">
	<tr>
	  <td valign="middle" class="bar">{$form_heading}</td>
	</tr>
	<tr>
	  <td align="left" valign="top" class="border1">
	  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr><td>{#require_msg#}</td></tr>
		<tr><td>{include file='admin_error_msg_template.tpl'}</td></tr>
		<tr>
		  <td width="710" class="lback">
		  <form name="frmAdditemslabs" id="frmAdditemslabs" method="post" style="margin:0px;">

		 <table width="100%" border="0" cellspacing="0" cellpadding="4">
		  <tr>
		  <td width="8%" align="left" class="text" nowrap ><b>Package Name&nbsp;</b></td>
		  <td  width="1%" align='left'><b>:</b>
			  </td>
                 <td   align='left'>
		<input type='text' value='{$package_name}' class="input required" id='package_name'style='width:350px;' name='package_name'>
		  </td>
                 

		  </tr>
                  <tr>
		  <td width="8%" align="left" class="text"><b>Item Range&nbsp;</b></td>
	<td  width="1%" align='left'><b>:</b>
			  </td>
                 <td   align='left'>
		 <input type='text' id='start_item_range'class="input required" value='{$start_item_range}' style='width:40px;'  name='start_item_range'>
		 &nbsp;<b>To</b> &nbsp;<input type='text' class="input required" value='{$end_item_range}'id='end_item_range' style='width:40px;' name='end_item_range'>
		  </td>
		  

		  </tr>

                  
                   <tr>
                   <td valign='top' align='left' nowrap ><b>Subscription Plan</b> </td>
                   <td valign='top' align='left' nowrap ><b> :</b></td>


                   <td valign='top' align='left'width='40%' >
                   <table width='60%' align='left' cellspacing='2' border='0' cellpadding='2'>
                    <tr >
                           
                          
                    <td width='50%' align='left' style='border:1px solid #cccccc;'>
                   <table width='100%' align='left' cellspacing='2' border='0' cellpadding='2'>
                     <tr bgcolor='#cccccc'>
                            <td width='22%' align='left' ><b>Amount &nbsp; (USD)</b></td>
                            <td width='22%' align='left' ><b>Duration</b></td>
                     </tr>
                     <tr>

                            <td width='22%' align='left' ><input type="text"  style='width:50px;' id='amount_1month' name="amount_1month"  value="{$amount_1month}"   class="required input" size="40"/></td>
                            <td width='22%' align='left' >1 Month</td>
                     </tr>
                      <tr>

                            <td width='22%' align='left' >
<input type="text"  style='width:50px;' name="amount_6month"  value="{$amount_6month|clear_input}"  id='amount_6month'   class="required input" size="40"/></td>
                            <td width='22%' align='left' >6 Month</td>
                     </tr>
                     <tr>

                            <td width='22%' align='left' >
<input type="text"  style='width:50px;' name="amount_12month"  value="{$amount_12month|clear_input}" id='amount_12month'   class="required input" size="40"/></td>
                            <td width='22%' align='left' >1 Year</td>
                     </tr>
        
                    </table>
                    </td>
                   </tr>
                   
                    </table></td>
                    </tr>

                   <tr>
	           
		   <td colspan='0'  align='left'  >
                    &nbsp;</td>
              </tr>
                
              <tr>
                  <td  align='left' valign='top' ><b>Description</b>
                  </td>
                    <td  align='left' valign='top' ><b>:</b>
                  </td>
                    <td align='left'colspan='2' ><textarea name='description_text'id='description_text'  rows='3' cols='40'>{$description}</textarea>
                  </td>
              </tr>
   <tr><!--description-->
	           <td colspan='2' align="right" class="text"></td>
		<td  align="left" class="text">
<input type='submit' value='Save 'class="button"  name='add'>&nbsp;&nbsp;<input name="cancel" type="reset" class="button" value="Cancel" onclick="window.location='admin_view_slabs.php'" /></td>
		
		    </tr>
		    	</table>
		  </form></td>
		</tr>
	</table>
	</td>
	</tr>
</table>
{include file="admin_bottom.tpl"}