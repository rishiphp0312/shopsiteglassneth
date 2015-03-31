{include file="admin_header.tpl"}
<div id="content">
<table width="100%" cellpadding="4" cellspacing="2" align="center" border="0">
<tr>
  <td class="heading_strip" colspan="2"><div style="float:left;">{$form_heading}</div></td>
</tr>
 <tr>
 <td valign="top">
	 <table width="100%" cellpadding="4" cellspacing="2" align="center">
       <tr>
          <td class="left_txt_label">Name </td>
		  <td>{if $user.company_name==""}
		  {$user.first_name} {$user.last_name}
		  {else}
		  {$user.company_name}
		  {/if}</td>
	    </tr>
		<tr>
         <td class="left_txt_label">User Type </td>
         <td>{$userTypeArr[$user.user_type]}</td>
        </tr>
       <tr>
         <td class="left_txt_label">Email</td>
         <td>{$user.email}</td>
        </tr>
       <tr>
         <td class="left_txt_label">Password</td>
         <td>{$user.password}</td>
       </tr>
       {if $smarty.session.view_user_type==3}
	   <tr>
         <td class="left_txt_label">Business Name</td>
         <td>{$user.pb_name}</td>
        </tr>
       <tr>
         <td class="left_txt_label">Street Address </td>
         <td>{$user.street_address}</td>
        </tr>
       <tr>
         <td class="left_txt_label">City</td>
         <td>{$user.city}</td>
        </tr>
       <tr>
         <td class="left_txt_label">State</td>
         <td>{$user.state}</td>
        </tr>
       <tr>
         <td class="left_txt_label">Post Code </td>
         <td>{$user.postcode}</td>
        </tr>
       <tr>
         <td class="left_txt_label">Country</td>
         <td>{$user.country}</td>
        </tr>
	   {/if}
       <tr>
         <td class="left_txt_label">Registration Date </td>
         <td>{$user.registration_date|date_format:"%b %d, %Y"}</td>
        </tr>
	  </table>
</td>
<td valign="top">{include file="admin_users_details_links.tpl"}</td>
</tr>
</table>
</div>
</div>
<div style="clear:both"></div>
</div>
<div id="box_bottom"></div>
{include file="admin_footer.tpl"} 