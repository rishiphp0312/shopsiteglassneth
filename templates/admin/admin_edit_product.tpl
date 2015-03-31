{include file="admin_top.tpl"}
  <table width="100%"  border="0" cellspacing="10" cellpadding="5">
	<tr>
	  <td valign="middle" class="bar">Add/Edit Product</td>
	</tr>
	<tr>
	  <td align="left" valign="top" class="border1">
	  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr><td>{#require_msg#}</td></tr>
		<tr><td>{include file='admin_error_msg_template.tpl'} {if $smarty.request.user_id!=""}<div style="text-align:right; float:right;"><input type="button" name="mail_sel_users" value="Send Notification Email" class="button" onclick="window.location='admin_user_send_mail.php?user_id={$smarty.request.user_id}';" /></div>{/if}</td></tr>
		<tr>
		  <td width="710" class="lback">
		  <form name="frmEdit_Adm_prdouct" id="frmEdit_Adm_prdouct" method="post" style="margin:0px;">
		     <input type="hidden" name="forum_user_id" value="{$forum_user_id}" />
			 <table width="100%" border="0" cellspacing="0" cellpadding="4">
				 
				
				
				<tr>
				  <td width="32%" align="left" class="text">Title: *</td>
				  <td width="22%">
				  <input name="title" id='title'  type="text" value="{$title_value}" size=""
				  class="input required"  size="30"  /></td>
				  <td width="46%">&nbsp;</td>
				</tr>
				<tr>
				  <td width="32%" align="left" class="text">Available Quantity: *</td>
				  <td width="22%">
				  <input name="max_quantity" 	id='max_quantity' type="text" 
						 class="input required"  value="{$max_item_value}" 
						size="" /> 
				 
				  </td>
				  <td width="46%">&nbsp;</td>
				</tr>
				<tr>
				  <td align="left" class="text">Inventory Quantity:*</td>
				  <td>
				  <input name="quantity" type="text" id='quantity'
						class="input required" value="{$inventory_alert_value}"  size="" />
				</td>
				  <td>&nbsp;</td>
				</tr>
				<tr>
				  <td align="left" class="text">Cost: *</td>
				  <td>
				  <input name="price" id='price' type="text" class="input required" value="{$cost_item_value}" 
						size="" /> 
				</td>
				  <td>&nbsp;</td>
				</tr>
				<tr>
				  <td align="left" class="text" valign='top'>Description: </td>
				  <td>
				  <textarea name="description" cols="30" 
						rows="5" class="input">{$description_value}</textarea>
				</td>
				  <td>&nbsp;</td>
				</tr>
				<tr>
				  <td align="left" class="text" valign='top'>Material Used :</td>
				  <td>
				  <textarea name="materials"
						cols="30" rows="5"  class="input">{$material_used_value}</textarea>
				</td>
				  <td>&nbsp;</td>
				</tr>
			      <!--   <tr>
				  <td align="left" class="text">Minimum quantity :*</td>
				  <td>
				<input name="quantity" type="text" id='quantity'
						class="required input" value="{$inventory_alert_value}"  /> </td>
				  <td>&nbsp;</td>
				</tr>-->
				 <!--   <tr>
				  <td align="left" class="text">Minimum quantity :*</td>
				  <td>
				<input name="quantity" type="text" id='quantity'
						class="required input" value="{$inventory_alert_value}"  /> </td>
				  <td>&nbsp;</td>
				</tr>-->

				<tr>
				  <td>&nbsp;</td>
				  <td><input name="save" type="submit" class="button" value="Save" />
					  <input name="cancel" type="reset" class="button" value="Cancel"
					  onclick="window.location='admin_products_listing.php'" /></td>
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