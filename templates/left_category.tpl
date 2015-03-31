<div id="mdlLftMain">
	<div class="categoryHd"><img src="{$baseUrl}images/cat_bull.jpg" alt="" align="top" /> Categories</div>
	<div class="catListBdr" style='padding:3px 4px 15px 17px;'>
		{*
		<ul class="navLink">
			{if $leftCategories}
			{foreach name="leftCat" item="gCAT" from=$leftCategories}
			<li><a href="{$baseUrl}buyer.php?item_category_id={$gCAT.category_id}">{$gCAT.name}</a></li>
			{/foreach}
			{else}
			<li><a href="#">No categories found.</a></li>
			{/if}
		</ul>
		*}
                {if $smarty.server.PHP_SELF|basename=='index.php'}
		{php}include "catalouge_menu1.php";{/php}
                {else}
                {php}include "catalouge_menu.php";{/php}
                {/if}
	</div>
	{if $smarty.server.PHP_SELF|basename=='index.php' || $smarty.server.PHP_SELF|basename=='show_tutorial.php'}
	<div class="clear"></div>
	
	<div class="leftVideoBdr">
		<a href="{$baseUrl}show_tutorial.php" title="Lear more"><img src="{$baseUrl}images/nathaat_video.jpg" alt="Lear more" align="top" /></a>
	</div><div class="leftVideoHd"><a href='{$baseUrl}show_tutorial.php'><img src="{$baseUrl}images/cat_bull.jpg" alt="" align="top" /></a>
Click to watch video <br></div><div class="leftVideoHd" style='padding-top:0px;'>&nbsp;&nbsp;</div>
<div class="leftVideoHd"><a href='{$baseUrl}show_tutorial.php'><img src="{$baseUrl}images/cat_bull.jpg" alt="" align="top" /></a>
 How It Works</div>
	{/if}

	<div class="newsletterMain">
		<style type="text/css">
		<!--
		@import url("{$baseUrl}css/jquery.css");
		-->
		</style>
		<!-- Script for JS validation -->
		<script src="{$baseUrl}js/jquery/jquery.validate.min.js" type="text/javascript"></script>
		<script src="{$baseUrl}js/jquery/jquery.maskedinput-1.2.2.js" type="text/javascript"></script>
		<script src="{$baseUrl}js/jquery/jquery.alphanumeric.js" type="text/javascript"></script>
		<script src="{$baseUrl}js/formValidator.js" type="text/javascript"></script>
		<form name="frmNewsletter" id="frmNewsletter" method="post" action="{$baseUrl}newsletter.php">
		<div class="newsletter">join for newsletter</div>
		<div class="newsLetteBg"><input name="news_letter_email" type="text" value="enter your email address here..." class="newsLtrFld email required" onfocus="clearText(this)" onblur="replaceText(this)"/></div>
		<div class="subscribe"><input name="subscribe" type="image" src="{$baseUrl}images/subscribe.jpg"/></div>
		</form>
	</div>
</div>
<!--
<div  style='border:0px solid red;' >
<table width="135" border="0" align='left' cellpadding="2" cellspacing="0"
title="Click to Verify - This site chose VeriSign SSL for secure
e-commerce and confidential communications.">
<tr>
<td width="135" align="center" valign="top"><script
type="text/javascript"
src="https://seal.verisign.com/getseal?host_name=www.nethaat.com&amp;size=L&
amp;use_flash=YES&amp;use_transparent=YES&amp;lang=en"></script><br
/>
<a href="http://www.verisign.com/ssl-certificate/" target="_blank"
style="color:#000000; text-decoration:none; font:bold 7px
verdana,sans-serif; letter-spacing:.5px; text-align:center;
margin:0px; padding:0px;">ABOUT SSL CERTIFICATES</a></td>
</tr>
</table>
</div>-->