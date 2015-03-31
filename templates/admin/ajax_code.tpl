<table align="center" cellpadding="0" cellspacing="0">
{if $Novalue!=1 }
<tr><td>
SubCategory:</td><td><select  name="category_id" id='category_id'  class="required input">
			
				  {html_options values=$SubCatID1 output=$SubCatNAME1 selected=$smarty.get.category_id  }
				 
				  </select></td>
				  </tr>
				  {else}
				 <tr><td colspan="2"><select  name="category_id" id='category_id' class="required input">
				  <option value="0">--select--</option>
				  </select></td>
				  </tr>
				  {/if}
				  </table>