<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
{config_load file="constants.conf"}
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{$site_title} :: {$site_page_title}</title>
<link rel="shortcut icon" href="{$baseUrl}favicon.gif" />
<style type="text/css">
<!--
@import url("{$baseUrl}css/admin_style.css");
@import url("{$baseUrl}css/simpletree.css");
@import url("{$baseUrl}css/jquery.css");
@import url("{$baseUrl}css/jquery.alerts.css");
-->
</style>


<!-- Script for JS validation -->
<script src="{$baseUrl}js/jquery/jquery-1.3.2.min.js" type="text/javascript"></script>
<script src="{$baseUrl}js/jquery/jquery.validate.min.js" type="text/javascript"></script>
<script src="{$baseUrl}js/jquery/jquery.maskedinput-1.2.2.js" type="text/javascript"></script>
<script src="{$baseUrl}js/jquery/jquery.alphanumeric.js" type="text/javascript"></script>
<script src="{$baseUrl}js/jquery/jquery.alerts.js" type="text/javascript"></script>
<script src="{$baseUrl}js/admin_formValidator.js" type="text/javascript"></script>
<script src="{$baseUrl}js/function.js" type="text/javascript"></script>

<!-- Jquery Fancy Box -->
<!--<link rel="stylesheet" type="text/css" href="{$baseUrl}fancybox/jquery.fancybox-1.2.6.css" media="screen" />
<script type="text/javascript" src="{$baseUrl}fancybox/jquery.fancybox-1.2.6.pack.js"></script>-->

<!-- Script for AJAX submit -->
<script type="text/javascript" src="{$baseUrl}js/build/yahoo-dom-event/yahoo-dom-event.js"></script>
<script type="text/javascript" src="{$baseUrl}js/build/connection/connection-min.js"></script>


<script type="text/javascript" src="{$baseUrl}js/simpletreemenu.js"> </script>
<link rel="shortcut icon" href="{$baseUrl}favicon.ico" />
{literal}
<script>
function val_fun()
{
var i=0;
var CHK = document.getElementById('chk_boxselect_all');
var FRMLEN = document.frmval_items.elements.length;
if(CHK.checked==true)
	{
	for(i=0;i<FRMLEN;i++)
	{
		if(document.frmval_items.elements[i].type=='checkbox')
		{
		 document.frmval_items.elements[i].checked=true;
		}
			
	}
	
	}
	if(CHK.checked==false)
	{
	for(i=0;i<FRMLEN;i++)
	{
		if(document.frmval_items.elements[i].type=='checkbox')
		{
		 document.frmval_items.elements[i].checked=false;
		}
			
	}
	
	
	}

}
</script>

<!--
<script type="text/javascript">
	/*
	$(document).ready(function(){
		$("a.property_nbrhood").fancybox({
		'hideOnContentClick': false,
		'frameWidth'			: 455,
		'frameHeight'			: 300		
		});
	});
	*/
</script>
-->
{/literal}	
</head>
<body >


<table align="center" width="100%" border="0"  cellpadding="0" cellspacing="0">
  <tr>
    <td>
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="border-left:1px solid #AFDDF7;border-right:1px solid #AFDDF7;border-bottom:1px solid #AFDDF7">
        <tr>
         
          <td valign="top">
<table width="100%"  border="0" cellspacing="1" cellpadding="1">

<form name="frmval_items" action="" method="post">
		
	<tr>
	  <td align="left" valign="top" class="border1">
      <table width="100%" cellpadding="1" cellspacing="2" align="center">
       {if $productList && $no_id_fetched!='0'}
		<tr class="listHeadRow">
                                        <td  align="left" valign="top">Products</td>
		                        <td  colspan="3" align="left" valign="top">
								<input type='checkbox' value="" name="chk_boxselect_all" id='chk_boxselect_all' onclick="return val_fun();" >Select All
 								</td> <!--<td>Status</td>-->
        </tr>
		{foreach name=prods from=$productList item=prod}
		
		<tr align="left" valign="top" bgcolor="{cycle values='#f5f5f5,#e6e6e6'}">
          <td >  {$prod.title} </td>
	      <td colspan="2">
		  <input type="checkbox" value="{$prod.item_id}" name="chkbox_prd_ids[]" id='chkbox_prd_ids'> 	  </td>
		</tr>
		
		{/foreach}
		   <tr align="left" valign="top">
			<td colspan="3">
		
		&nbsp;	</td>
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
	</form>
</table>
</td></tr></table></td></tr></table>	  
{*include file="admin_bottom.tpl"*} 