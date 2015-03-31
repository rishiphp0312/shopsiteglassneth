<?php
include ('include/common.inc');
define('DB_NAME', 'nhdb');

/** MySQL database username */
define('DB_USER', 'adminnhdb');

/** MySQL database password */
define('DB_PASSWORD', 'nhZAQ123');
define('DB_SERVER', 'localhost');

//	$DB_SERVER     			= "localhost"; 		// Database Server machine
//	$DB_LOGIN      			= "adminnhdb";        	// Database login
//	$DB_PASSWORD   			= "nhZAQ123"; 		// Database password
//	$DB_COMMON 			     = "nhdb";		// Database name		

//echo '<pre>';
//print_r(get_included_files());
//echo '</pre>';
    mysql_connect(DB_SERVER,DB_USER,DB_PASSWORD);
	mysql_select_db(DB_NAME);
	header("Content-Type: application/xml; charset=iso-8859-1");
    include("class/RSS.class.php");
	
	$rss = new RSS();
	echo $rss->GetFeed();
?>