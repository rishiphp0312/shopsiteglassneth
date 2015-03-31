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
		  <form name="frmAddCategory" id="frmAddCategory" method="post" style="margin:0px;">
		    
		 <table width="100%" border="0" cellspacing="0" cellpadding="4">
		  <tr>
		  <td width="32%" align="left" class="text">Parent: *</td>
		  <td width="22%">
		  <select name="parent_id" id="parent_id"  class="required input" onchange='return show_commsion();' >
		  {html_options values=$parentID output=$parentNAME selected=$parent_id }
		  </select>
		  </td>
		  <td width="46%">&nbsp;</td>
		  </tr>
		   <tr>
	           <td width="32%" align="left" class="text">{$name_label}: *</td>
		   <td width="22%"><input type="text"  name="name"  value="{$name|clear_input}"   class="required input" size="40"/>
</td>
		    <td width="46%">&nbsp;</td>
		    </tr>
		    <tr>
		    <td width="32%" align="left" class="text">Description:</td>
		    <td width="22%"><textarea name="description" class="required" cols="30" rows="4">{$description|clear_input}</textarea></td>
		    <td width="46%">&nbsp; <input type="hidden" name="category_id" value="{$category_id}" /></td>
		    </tr>
                    <tr id='row_com_id'{if $parent_id!=0}style='display:none;' {/if} >
                    <td align="left" class="text" >Commision:</td>
                    <td><input type="text"  name="commision"  value="{$commision}"   class="input" size="40"/>
                    </td>
                    <td><b>(%)</b></td>
                    </tr>
                    <tr>
                    <td align="left" class="text">Status:</td>
                    <td>
                    <input type="checkbox" name="status" id="status" value="1" class="txtFeild1" {if $status==1}checked{/if}/>
                    </td><td>&nbsp;</td>
                    </tr>
		    <tr>
		    <td>&nbsp;</td>
		    <td><input name="save" type="submit" class="button" value="Save" />
		    <input name="cancel" type="reset" class="button" value="Cancel" onclick="window.location='{$return_link}'" /></td>
		    <td>&nbsp;</td>
		    </tr>
			</table>
		  </form></td>
		</tr>
	</table>
	</td>
	</tr>
</table>
{include file="admin_bottom.tpl"}