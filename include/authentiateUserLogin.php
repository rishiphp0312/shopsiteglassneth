<?php
//validate user login sesion here
//echo  $_SESSION["SESSION_REQUEST_URL"] ;
//echo '<br>';
//echo "URI=".$page = $_SERVER['REQUEST_URI'];
//exit;
if(!isset($_SESSION['session_user_id'] ) && $_SESSION['session_user_id'] =="")
{//exit;
	//get referer to redirect user to that particular page
	//$_SESSION["SESSION_REDIRECT_URL"] = $_SERVER["HTTP_REFERER"];
	//$req_url = split("/",$_SERVER['REQUEST_URI']);
	//$_SESSION["SESSION_REQUEST_URL"] = $req_url[count($req_url)-1];
	
	 $_SESSION["SESSION_REQUEST_URL"] = $_SERVER['REQUEST_URI'];
	 //exit;
     //	basename($_SERVER['REQUEST_URI']);
     //  exit;
	//redirect user to login page
        if(basename($_SERVER['REQUEST_URI'])=='hatting-items.php')
        header("location: login-hatting.php?logout=no");
	else
	header("location: login.php?logout=no");
	exit;
}
?>