{include file="admin_top.tpl"}
<script language="javascript" type="text/javascript">
{literal}
function val_fun()
{
var i=0;
var CHK = document.getElementById('chk_boxselect_all');
var FRMLEN = document.frm_bulk_mailUser.elements.length;
if(CHK.checked==true)
	{
	for(i=0;i<FRMLEN;i++)
	{
		if(document.frm_bulk_mailUser.elements[i].type=='checkbox')
		{
		 document.frm_bulk_mailUser.elements[i].checked=true;
		}
			
	}
	
	}
	if(CHK.checked==false)
	{
	for(i=0;i<FRMLEN;i++)
	{
		if(document.frm_bulk_mailUser.elements[i].type=='checkbox')
		{
		 document.frm_bulk_mailUser.elements[i].checked=false;
		}
			
	}
	
	
	}

}


//function is used to check all/un check all ceckboxes
function fnc_checkAll(strChk)
{
	
	var inputs = document.getElementsByTagName('input');
    var checkboxes = [];
    //if(document.getElementById('checkAll').checked)
	if(strChk==1)
	{
		for (var i = 0; i < inputs.length; i++)
		{
	
			if (inputs[i].type == 'checkbox')
			{
				inputs[i].checked = true;
			}
		}
	}
	else
	{
		for (var i = 0; i < inputs.length; i++)
		{
	
			if (inputs[i].type == 'checkbox')
			{
				inputs[i].checked = false;
			}
		}
	}
}
{/literal}
</script>
  <table width="100%"  border="0" cellspacing="10" cellpadding="5">
	<tr>
	  <td valign="middle" class="bar">Send News Letter</td>
	</tr>
	<tr>
	  <td align="left" valign="top" class="border1">
	  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
	  <tr><td>{#require_msg#}</td></tr>
		<tr>
		  <td style="font-family:Arial, Helvetica, sans-serif;text-align:left;color:#FF0000;font-size:12px;"> </td>
	    </tr>
		<tr><td>{include file='admin_error_msg_template.tpl'}</td></tr>
		<tr>
		  <td width="710" class="lback">
	 <form name="frm_bulk_mailUser" ID="frm_bulk_mailUser" action="" method="POST">
      <table width="100%" cellpadding="4" cellspacing="4" align="center" border="0">
        <tr>
          <td colspan="2" class="heading_strip">
		  <div style="float:left; text-align:center; padding-left:25px;" class="error_msg">
		  	{$error_msg}		  </div>		  </td>
        </tr>
		<tr>
		 <td >
		 <table><tr>
		  <td valign="top"  >
		{if $userList}
		<table align="left" cellpadding="0" cellspacing="2" border="0" width="100%">
			<tr>
			  <td colspan="2" class="bar">Subscribed Users  </td>
			</tr>
			<tr>
				<td width="21%" style="font-weight:bold;">Select</td>
				<td width="79%"><a href="javascript: fnc_checkAll(1);">All</a> <a href="javascript: fnc_checkAll(0);">None</a></td>
			</tr>
			<tr>
			<td colspan="2">
			<div style="border:1px solid #AFDDF7; height:300px; overflow: auto;">
				<table align="left" cellpadding="0" cellspacing="2" border="0" width="100%">
				{foreach name=user from=$userList item=users}
				<tr>
					<td><input type="checkbox" name="UserEmails[]" value="{$users.news_letter_email}"/></td>
					<td>{$users.news_letter_email}</td>
				</tr>
				{/foreach}
					<td colspan="2">
					{$page_counter} Products
	{$pageLink}					</td>
				</table>
			</div>			</td>
			</tr>
		</table>
		{/if}
		<!-- END table for User List section -->		</td></tr>
		  </table>		 </td>
		  </tr>
        <tr>
		<td valign="top" width="70%">
		<!-- START table for Message section -->
		<table align="left" cellpadding="4" cellspacing="4" border="0" width="100%">
		<tr>
		  <td colspan="4" style="font-weight:300;color:red;font-size:11px;">&nbsp;</td>
		  </tr>
		<tr>
          <td width="130" style="font-weight:bold;">Subject : </td>
          <td colspan="3"><input type="text" name="subject" style="width:300px;border:1px solid #CCCCCC;background-color:#ffffff;" value="{$mail_subject2}" class="txtFeildTitle" maxlength="100"/>
          <div class="error_msg" id="error_subject"></div></td>
        </tr>
		
		<tr align="left" valign="top">
		  <td colspan="2" style="font-weight:bold;">&nbsp;</td>
		  <td width="297" colspan="2" align="center"  style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#999999;text-align:center;font-size:14px;"> </td>
		  </tr>
		  <tr align="left" valign="top">
		  <td colspan="4" valign="top" align="left" >
		 <fieldset style="border:1px solid #AFDDF7;" >
<legend style="font-family:Arial, Helvetica, sans-serif;font-size:14px;color:#000000; text-align:left;" >Option1</legend>
<table width="100%" border="0" align="center" cellpadding="2" cellspacing="2">
  
  <tr align="center">
    <td colspan="2" align="left" valign="top">&nbsp;</td>
    <td valign="top" align="left"  style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#999999;text-align:left;font-size:12px;">Select Items&nbsp;</td>
  </tr>
  <tr>
    <td width="15%" rowspan="2" align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif;font-size:14px;color:#000000; text-align:left;" >Heading 1</td>
    <td width="50%" rowspan="2" align="left" valign="top">
	<table width="100%" align="center" cellpadding="2" cellspacing="2" border="0">
	
	
	
	<tr> <td width="195">
		  <input type="text" value="" style="width:300px;border:1px solid #CCCCCC;background-color:#ffffff;"  class="input required" name="heading1" id="heading1" />	
		  	  </td></tr>
		  <tr>
		    <td><textarea name="text1" rows="5" style="width:300px;border:1px solid #CCCCCC;background-color:#ffffff;"  cols="25"></textarea></td>
	    </tr>
		  <tr> <td width="195">
		   	  </td></tr>
	</table>	</td>
    <td width="35%" align="left" valign="top"><select name="product_1[]" style="width:330px;font-family:Arial, Helvetica, sans-serif;font-size:12px;"  id="product_1" multiple size="10"   >
		  {html_options values=$productListId  title=$productList output=$productList  }
		  </select>&nbsp;</td>
  </tr>
</table> </fieldset>		   </td>
		  </tr>
		  <tr align="left" valign="top">
		  <td colspan="4" valign="top" align="left" >
		 <fieldset style="border:1px solid #AFDDF7;" >
<legend style="font-family:Arial, Helvetica, sans-serif;font-size:14px;color:#000000; text-align:left;" >Option2</legend>
<table width="100%" border="0" align="center" cellpadding="2" cellspacing="0">
    <tr align="center">
    <td colspan="2" align="left" valign="top">&nbsp;</td>
    <td valign="top" align="left"  style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#999999;text-align:left;font-size:12px;">Select Items&nbsp;</td>
  </tr>
  <tr>
    <td width="15%" rowspan="2" align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif;font-size:14px;color:#000000; text-align:left;" >Heading 2 </td>
    <td width="50%" rowspan="2" align="left" valign="top">
	<table width="100%" align="center" cellpadding="2" cellspacing="2" border="0">
	
	
	
	<tr> <td width="195">
		  <input type="text" value="" style="width:300px;border:1px solid #CCCCCC;background-color:#ffffff;"  name="heading2" id="heading1" />		  </td></tr>
		  <tr>
		    <td><textarea name="text2" rows="5" style="width:300px;border:1px solid #CCCCCC;background-color:#ffffff;"  cols="25"></textarea></td>
	    </tr>
		  <tr> <td width="195">
		   	  </td></tr>
	</table>	</td>
    <td width="35%" align="left" valign="top"><select name="product_2[]" style="width:330px;font-family:Arial, Helvetica, sans-serif;font-size:12px;"  id="product_1" multiple size="10"   >
		  {html_options values=$productListId output=$productList  }
		  </select>&nbsp;</td>
  </tr>
</table> </fieldset>		   </td>
		  </tr>
		  
		  <tr align="left" valign="top">
		  <td colspan="4" valign="top" align="left" >
		 <fieldset style="border:1px solid #AFDDF7;" >
<legend style="font-family:Arial, Helvetica, sans-serif;font-size:14px;color:#000000; text-align:left;" >Option3</legend>
<table width="100%" border="0" align="center" cellpadding="2" cellspacing="0">
    <tr align="center">
    <td colspan="2" align="left" valign="top">&nbsp;</td>
    <td valign="top" align="left"  style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#999999;text-align:left;font-size:12px;">Select Items&nbsp;</td>
  </tr>
  <tr>
    <td width="15%" rowspan="3" align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif;font-size:14px;color:#000000; text-align:left;" >Heading 3 </td>
    <td width="50%" rowspan="3" align="left" valign="top">
	<table width="100%" align="center" cellpadding="2" cellspacing="2" border="0">
	
	
	
	<tr> <td width="195">
		  <input type="text" value="" style="width:300px;border:1px solid #CCCCCC;background-color:#ffffff;"  name="heading3" id="heading3" />		  </td></tr>
		  <tr>
		    <td><textarea name="text3"  cols="25" rows="5" id="text3" style="width:300px;border:1px solid #CCCCCC;background-color:#ffffff;"></textarea></td>
	    </tr>
		  <tr> <td width="195">
		   	  </td></tr>
	</table>	</td>
  </tr>
  
  <tr><td width="35%" align="left" valign="top"><select name="product_3[]" style="width:330px;font-family:Arial, Helvetica, sans-serif;font-size:12px;"  id="product_1" multiple size="10"   >
		  {html_options values=$productListId output=$productList  }
		  </select>&nbsp;</td>
  </tr>
</table> </fieldset>		   </td>
		  </tr>
		  
		  
	
        
        
    
		<tr align="left" valign="top">
		  <td colspan="4" style="height:4px;" >&nbsp;</td>
		</tr>
		
		
		<tr>
			<td>&nbsp;</td>
			<td colspan="3" align="left">
			
			<input name="Submit" type="submit" class="button" value="Send News Letter"/>&nbsp;&nbsp;&nbsp;
			  <input name="Cancel" type="button" class="button" value="Cancel" onclick="window.location='admin_news_letter.php'"/>			</td>
		</tr>
		</table>
		<!-- END table for Message section -->		</td>
		<!-- START table for User List section -->
		</tr>
      </table>
    </form>	</td>
		</tr>
	</table>
	</td>
	</tr>
</table>
<script language="javascript">fnc_checkAll(1);</script>
{include file="admin_bottom.tpl"}