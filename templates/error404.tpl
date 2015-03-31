{include file="header.tpl"}
<meta http-equiv="refresh" content="10; URL={$baseUrl}">
{include file="header_search.tpl"}
<!--Start Middle-->
	<div style="padding:0 0 0 0;">
			{*include file="left_category.tpl"*}
		<div style="padding:0 0 0 0;">
		<div class="border_full" style="margin-top:10px;">
          <div>
            <div class="green_rep">ERROR</div>
          </div>
		  	<div style="padding:10px;" >
			  <div style="color:#FF9933; margin:20px 10px;">
			   <img src="{$baseUrl}images/alert_icon.jpg" alt="" align="absmiddle" style="margin-right:10px;"  />
			   <span style="font-size:18px; font-weight:bold;">Sorry! for inconvenience...</span><br /><br />
			   <div class="loc_list" style="margin-left:20px; width:820px; margin-top:0px;">
			   		<br />
					<span style="color:#292323;">You have reached a page that has changed or no longer exists.<br />Sorry, we could not find the page you were looking for. Maybe it's moved, or maybe the URL is incorrect, or maybe you performed an illegal operation.</span><br /><br />
					<span style="color:#000033; font-weight:bold;"><img src="{$baseUrl}images/error-loading.gif" alt="" align="absmiddle" style="margin-right:10px;"  /> Page will automatically redirect to home page within few seconds.</span><br /><br />
					<span style="font-weight:bold;">Things to try:</span>
					<ul>
						<li><a href="#">Check that the URL you entered is correct.</a></li>
						<li><a href="#">Try searching our site for the topic you were looking for.</a></li>
						<li><a href="#">Return to our home page and use the navigation menu to find what you need.</a></li>
						<li><a href="#">Contact us and we'll if we can point you in the right direction.</a></li>
					</ul>
				</div>
			   <div style="clear:both;"></div>
			  </div>
			 </div>
        </div>
      </div>
		<div class="clear"></div>
	</div>
<!--End Middle-->
{include file="footer.tpl"}