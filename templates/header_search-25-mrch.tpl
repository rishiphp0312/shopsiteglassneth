<!--Start Logo-->
			
			<div id="logoMain">
				<div class="logoLft">
				<a href='{$baseUrl}'><img src="{$baseUrl}images/logo.jpg" alt="" class="logo" /></a>
				{if $smarty.session.session_user_id}
				<div class="welcomeDetail">
				<b>Welcome!</b><br /> {$smarty.session.session_user_name}<br /><br />
				<b>Last Login:</b><br /> {$smarty.session.session_last_login} <br /><br />
				<!--<a href="{$baseUrl}dashboard.php">My Home Page</a>--><br /><br />
				<a href="{$baseUrl}my_account.php" style='font-size:14px;font-weight:bold;' >My Account</a>
				</div>
				{/if}
				</div>
			
				<div id="wrap">
    <div class="slidetabs" style="display:none;">
    <a class="current" href="#">1</a>
    <a class="" href="#">2</a>
    <a href="#">3</a>
    <a href="#">4</a>
    <a href="#">5</a>
    </div>
    <div class="images">
        <div class="box" style="display: block;"><img src="images/banner.jpg" alt="" /></div>
        <div class="box"><img src="images/creativity.jpg" alt="" /></div>
        <div class="box"><img src="images/gifting.jpg" alt="" /></div>
        <div class="box"><img src="images/hatting.jpg" alt="" /></div>
        <div class="box"><img src="images/give-your-hand.jpg" alt="" /></div>
    </div>
    <div style="position:absolute; bottom:5px; right:5px;" id="pause"><a href="javascript://" onclick='$(".slidetabs").data("slideshow").stop();'><img src="images/pause_icon.png" alt="" border="0" onclick="btn_show('play'), btn_hide('pause')" /></a></div>
    <div style="position:absolute; bottom:5px; right:5px; display:none;" id="play"><a href="javascript://" onclick='$(".slidetabs").data("slideshow").play();'><img src="images/paly_icon.png" alt="" border="0" onclick="btn_show('pause'),btn_hide('play')" /></a></div>
   {literal}
    <script language="JavaScript">
    // What is $(document).ready ? See: http://flowplayer.org/tools/documentation/basics.html#document_ready
    $(function() {
    
    $(".slidetabs").tabs(".images > div", {
    
        // enable "cross-fading" effect
        effect: 'fade',
        fadeOutSpeed: "slow",
    
        // start from the beginning after the last tab
        rotate: true
    
    // use the slideshow plugin. It accepts its own configuration
    }).slideshow();
    });
    </script>
{/literal}
   
</div>
							  
							  <div class="clear"></div>
			</div>
		<!--End Logo-->
		{if $smarty.server.PHP_SELF|basename=='index.php'}
		<div class="tagText">An interactive online marketplace for sellers and buyers of hand made items.</div>
		<div>
<a href="{$baseUrl}buyer.php?main_cat_id=1"><img src="{$baseUrl}images/artisans.jpg" alt="" border="0" style="margin-right:23px;"/></a>
<a href="{$baseUrl}buyer.php?main_cat_id=2"><img src="{$baseUrl}images/artists.jpg" alt="" style="margin-right:23px;"border="0"/></a>
<a href="{$baseUrl}buyer.php?main_cat_id=3"><img src="{$baseUrl}images/designers.jpg" alt="" border="0" style="margin-right:23px;" /></a>
<a href="{$baseUrl}buyer.php?main_cat_id=4"><img src="{$baseUrl}images/homemakers.jpg" style="margin-right:0px;" alt="" border="0" /></a></div>
		{/if}		