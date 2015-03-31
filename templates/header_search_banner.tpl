<!--Start Logo-->
			
			<div id="logoMain" >
				<div class="logoLft" style="width:263px;">
				<a href='http://www.nethaat.com'><img  src="{$baseUrl}images/logo.jpg" alt="" class="logo" /></a>
				{if $smarty.session.session_user_id}
				<!--<div class="welcomeDetail">
				<b>Welcome!</b><br /> {$smarty.session.session_user_name}<br /><br />
				<b>Last Login:</b><br /> {$smarty.session.session_last_login} <br /><br />
				<br /><br />
				<a href="{$baseUrl}my_account.php" style='font-size:14px;font-weight:bold;' >My Account</a>
				</div>-->
				{/if}
				</div>
			<div style="width:680px;" id="wrap">

 

<div class="welcomeDetail" style="position:absolute; left:5px; color:#000; width:250px; text-align:left;">
	{if $smarty.session.session_user_id}
                                                                Welcome! <b>{$smarty.session.session_user_name}</b><br />

                                                                <b>Last Login:</b>{$smarty.session.session_last_login} <br /><br />

                                                                <a href="{$baseUrl}my_account.php" style='font-size:14px;font-weight:bold;' >My Account</a>{/if}                                                    </div>
<!--
<img src="{$baseUrl}images/banner/moth_day.jpg">
getthumb.php?w=90&h=70&
                -->	                             
        {if $banner_name!=''}
			{if $banner_status==2}
			<img src="{$baseUrl}uploads/{$username}/banners/{$banner_name}" />
			{else}
			<img src="{$baseUrl}getthumb.php?w=690&h=179&fromfile=uploads/{$username}/banners/{$banner_name}" />
		    {/if}
		{else}
			<img src="{$baseUrl}test-baner/artisans.jpg" />
			
		{/if}
		</div>

							  
							  <div class="clear"></div>
			</div>
		<!--End Logo-->
		