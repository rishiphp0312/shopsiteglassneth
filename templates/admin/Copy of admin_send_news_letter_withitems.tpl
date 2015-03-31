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
		<tr><td>{include file='admin_error_msg_template.tpl'}</td></tr>
		<tr>
		  <td width="710" class="lback">
	 <form name="frm_bulk_mailUser" ID="frm_bulk_mailUser" action="" method="POST">
      <table width="100%" cellpadding="4" cellspacing="4" align="center" border="0">
        <tr>
          <td colspan="2" class="heading_strip">
		  <div style="float:left; text-align:center; padding-left:25px;" class="error_msg">
		  	{$error_msg}
		  </div>
		  </td>
        </tr>
        <tr>
		<td valign="top" width="70%">
		<!-- START table for Message section -->
		<table align="left" cellpadding="4" cellspacing="4" border="0" width="100%">
		<tr>
		  <td colspan="2" style="font-weight:300;color:red;font-size:11px;">
		  Max 20 items can be send at once.		  </td>
		  </tr>
		<tr>
          <td width="60" style="font-weight:bold;">Subject : </td>
          <td><input type="text" name="subject" style="width:400px;" value="{$mail_subject2}" class="txtFeildTitle" maxlength="100"/>
          <div class="error_msg" id="error_subject"></div></td>
        </tr>
        <tr>
          <td valign="top" style="font-weight:bold;">Heading</td>
          <td>
		  <input type="text" value="" name="heading" id="heading" />
		  </td>
        </tr>
        <tr>
          <td valign="top" style="font-weight:bold;">Message :</td>
          <td>{php} include("fck_news_letter1.php"); {/php}
            <div class="error_msg" id="error_mail_content"></div></td>
        </tr>
		<tr>
			<td>&nbsp;</td>
			<td align="left">
			<input name="Submit" type="submit" class="button" value="Send News Letter"/>&nbsp;&nbsp;&nbsp;
			  <input name="Cancel" type="button" class="button" value="Cancel" onclick="window.location='admin_news_letter.php'"/>			</td>
		</tr>
		</table>
		<!-- END table for Message section -->
		</td>
		<!-- START table for User List section -->
		<td valign="top" width="30%">

		<table align="left" cellpadding="0" cellspacing="2" border="0" width="100%">
			<tr><td class="bar">Select Items</td></tr>
			<tr>
				<td align="left" valign="top" style="font-weight:bold;">&nbsp;</td>
				</tr>
			<tr>
			<td>
		
				<table align="left" cellpadding="0" cellspacing="2" border="0" width="100%">
				
				<tr>
					<td>
			<!--start items list-->
			<table align="center" width="100%" border="0"  cellpadding="0" cellspacing="0">
  <tr>
    <td>
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="border-left:1px solid #AFDDF7;border-right:1px solid #AFDDF7;border-bottom:1px solid #AFDDF7">
        <tr>
         
          <td valign="top">
<table width="100%"  border="0" cellspacing="1" cellpadding="1">


		
	<tr>
	  <td align="left" valign="top" class="border1">
      <table width="100%" cellpadding="1" cellspacing="2" align="center">
       {if $productList && $no_id_fetched!='0'}
		<tr class="listHeadRow">
   <td  align="left" valign="top">Products</td>
	<td  colspan="3" align="left" valign="top">
	<input type='checkbox' value="" onclick="return val_fun();" name="chk_boxselect_all" id='chk_boxselect_all'  >Select All
 								</td> <!--<td>Status</td>-->
        </tr>
		{foreach name=prods from=$productList item=prod}
		
		<tr align="left" valign="top" bgcolor="{cycle values='#f5f5f5,#e6e6e6'}">
          <td >  {$prod.title} </td>
	      <td colspan="2">
		  <input type="checkbox" value="{$prod.item_id}" name="chkbox_prd_ids[]" id='chkbox_prd_ids'>			  </td>
		</tr>
		
		{/foreach}
		   <tr align="left" valign="top">
			<td colspan="3">&nbsp;
		
			</td>
        </tr>
        <tr align="left" valign="top">
			<td colspan="3">
		
			 {if $pageLink}
			<div class="admn_pagination_msg_board">
		{$pageLink}	</div>
			 {/if}			<div style="float:left;">{$page_counter} Products </div>	</td>
        </tr>
		{else}
		
		<tr><td colspan="3"><div class="no_record_found">No record found...!</div></td></tr>
	
		{/if}
      </table>
</td>
	</tr>

</table>
</td></tr></table></td></tr></table>
			
									<!--end items list-->	</td>
				</tr>
				</table>			</td>
			</tr>
		</table>
		
		<!-- END table for User List section -->
		</td>
		</tr>
      </table>
    </form>
	</td>
		</tr>
	</table>
	</td>
	</tr>
</table>
<script language="javascript">fnc_checkAll(1);</script>
{include file="admin_bottom.tpl"}