<?php 
session_start(); //added by mahipal
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head>
<title><?php bloginfo('name'); ?> <?php wp_title('::', true, 'left'); ?></title>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" />
<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/favicon.ico" />
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="Atom 1.0" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="stylesheet" href="<?php echo baseUrl?>css/stylesheet.css" type="text/css" />

<?php wp_head(); ?>
<script src="<?php echo baseUrl?>js/jquery/jquery-1.3.2.min.js" type="text/javascript"></script>
<script src="<?php echo baseUrl?>js/function.js" type="text/javascript"></script>
<link rel="shortcut icon" href="<?php echo baseUrl?>favicon.ico" />

<script type="text/javascript">
$(document).ready(function() {
    $('.slideshow').cycle({
		fx: 'fade' // choose your transition type, ex: fade, scrollUp, shuffle, etc...
	});
});
</script>
</head>

<body>
<div id="mainComment">
		<!--Start Menu-->
			<div class="menuBg">
				<div class="fl"><img src="<?php echo baseUrl?>images/menu_lft_cone.jpg" alt="" /></div>
				<div class="fr"><img src="<?php echo baseUrl?>images/menu_rt_cone.jpg" alt="" /></div>
				<div class="menuLftMain">
					<ul class="menuLink">
						<li><a href="<?php echo baseUrl?>">Home</a></li>
						<li><a href="<?php echo baseUrl.'registration.php'?>">Open A Store</a></li>
						<li><a href="<?php echo baseUrl.'buyer.php'?>">Buy</a></li>
						<li><a href="<?php echo baseUrl.'hatting-items.php'?>">Haating</a></li>
						<li><a href="<?php echo baseUrl?>blog">Blog</a></li>
						<li>
						<?php if ($_SESSION['session_user_id']==""){?>
						<a href="<?php echo baseUrl?>login.php">Login</a>
						<?php }else{?>
						<a href="<?php echo baseUrl?>logout.php">Logout</a>
						<?php } ?>
						</li>
						
						<li  style="border:0px solid #00FF00;width:70px;" >
					
					<a href='<?php echo baseUrl?>registration.php' >Signup</a> 
						
						</li>
						<li class="last"  style="border:0px solid #00FF00;width:140px;">
					
					<a href='<?php echo baseUrl?>advanced_serch.php'>Advanced Search</a> 
						
						</li>
					</ul>
				</div>
				<!--<div class="searchRt" >
					<form name="frm" action="{$baseUrl}keywords.php" method="get">
					
					<input name="search_Keywords" type="text" class="srhInputFld" value="Keywords" onfocus="clearText(this)" onblur="replaceText(this)" /> 
					<input name="" type="image" src="{$baseUrl}images/go.jpg" /> <img src="<?=baseUrl?>images/srh_cart.jpg" alt="" class="vAlign" hspace="2" />
				</form>
				</div>-->	
		<div class="searchRt">
			<form name="frm" action="{$baseUrl}keywords.php" method="get">
					<input name="" type="text" class="srhInputFld" value="Keywords" onfocus="clearText(this)" onblur="replaceText(this)" /> 
					<input name="" type="image" src="<?php echo baseUrl?>images/go.jpg" /> <img src="<?php echo baseUrl?>images/srh_cart.jpg" alt="" class="vAlign" hspace="2" />
					</form>
				</div>		
				<div class="clear"></div>
			</div>
		<!--End Menu-->
		<!--Start Logo-->
			<div id="logoMain">
				<div class="logoLft">
                                    <a href="<?php echo baseUrl?>"><img src="<?php echo baseUrl?>images/logo.jpg" alt="" class="logo" /></a>
				<?php if ($_SESSION['session_user_id']!=""){?>
				<div class="welcomeDetail">
				<b>Welcome!</b><br /> <?php echo$_SESSION['session_user_name'];?><br /><br />
				<b>Last Login:</b><br /> <?php echo$_SESSION['session_last_login'];?><br /><br />
				<!--<a href="<?php echo baseUrl?>dashboard.php">My Home Page</a><br /><br />-->
				<a href="<?php echo baseUrl?>my_account.php">My Account</a>
				</div>
				<?php } ?>
				</div>
				<div class="bannerRt"><img src="<?php echo baseUrl?>images/banner.jpg" alt="" /></div>
				<div class="clear"></div>
			</div>
		<!--End Logo-->
		
<!-- HEADER -->
<div id="wrapper">
	<div id="header_blog">
		<div id="raccoglitore">
			<div id="logo">
			<h1><a href="<?php echo get_option('home'); ?>" title="<?php bloginfo('description'); ?>"><?php bloginfo('name'); ?></a></h1>
			<!--<h2><?php //bloginfo('description'); ?></h2>-->
			</div>
			<div id="rss"><a href="<?php bloginfo('rss2_url'); ?>" >
			<!--<img alt="Share" src="<?php bloginfo('template_directory'); ?>/images/rss.png" /></a>--></div>
		</div>
	</div>
	<div id="content">
	<!-- END HEADER -->