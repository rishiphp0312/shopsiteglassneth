<?php
//include all common fils here
include ('smartyInit.php.inc'); //smarty object
include ('constants.php.inc'); // constant 
include ('class/dbconnector.inc'); //DB connection file

include ('fckeditor/SP_replace.php'); // FCK editor
include ('include/functions.php'); //common functions
include ('class/class.dynamic.php'); //display dynamic content from template
include ('include/Pagination.Class.php'); // For pagination
session_set_cookie_params(0, '/', '.nethaat.com'); 

//create object of dynamic class

 $name_after_domain     =  $_SERVER['HTTP_HOST'];
 //echo '<br>';
 $curent_page           =  $_SERVER['PHP_SELF'];
 $base_curent_page      = basename($curent_page);
 $exp_name_after_domain = explode(".",$name_after_domain);
if($name_after_domain=='www.nethaat.com' )
{
}
else
{
if($base_curent_page!='featured_store_information.php')
   {//echo 'lala';
    $add_this_name_red         =   'featured_store_information.php';
    // header("Location:$add_this_name_red");
	redirect($add_this_name_red);
    }
}

$objDynamic = new Class_Dynamic();
$smarty->assign("objDynamic",$objDynamic);

//get categories to display in left panel
$leftCategories = $objDynamic->getAllCategories();
//$smarty->assign("leftCategories",$leftCategories);

//set default currency
define(DEFAULT_CURRENCY, "USD");
$smarty->assign('USD', DEFAULT_CURRENCY);

//enable for caching
//$smarty->caching = 1;
//$smarty->cache_lifetime = 300;

//get user details from cookie
$userName= "";
$password = "";
$rememberMe = "";
if(isset($_COOKIE['Nethaat']))
{
	$userName = urldecode($_COOKIE['Nethaat']['username']);
	$password = urldecode($_COOKIE['Nethaat']['password']);
	$rememberMe = "checked";
}
$userName = ($userName)?$userName:"";
$password = ($password)?$password:"";
$rememberMe = ($rememberMe)?$rememberMe:"";

$smarty->assign('email',$userName);
$smarty->assign('password',$password);
$smarty->assign('rememberMe',$rememberMe);

//set success/failure messages
if(isset($_SESSION['SUCCESS_MESSAGE']))
{
	$smarty->assign('SUCCESS_MESSAGE',$_SESSION['SUCCESS_MESSAGE']);
	unset($_SESSION['SUCCESS_MESSAGE']);
}
if(isset($_SESSION['ERROR_MESSAGE']))
{
	$smarty->assign('ERROR_MESSAGE',$_SESSION['ERROR_MESSAGE']);
	unset($_SESSION['ERROR_MESSAGE']);
}
//get Administrator Email
$admin_email = $objDynamic->selectAdminMail();

//PHP Rate Converter function based on Yahoo Finance Rates
//PHP Rate Converter function based on Yahoo Finance Rates
function YahooFinanceConverter($a, $from, $to)
{
	$YAHOO_URL = 'http://finance.yahoo.com/d/quotes.csv?e=.csv&f=sl1d1t1&s=%s%s=X';
	$fo = @fopen(sprintf($YAHOO_URL,$from,$to), 'r');
	if ($fo)
	{
		$response = fgets($fo, 4096);
		fclose($fo);
		//print_r($response);
		$array = explode(',',$response);
		if(strval($array[1]) > 0)
		{
			$rate = strval($a)*strval($array[1]);
			//$rate = number_format($rate, 2, '.', ',');
			return $rate;
		}
	}
	return false;
}


//unset($_SESSION['nethaat_user_session']);
//now first check user IP/Currency session, and create session
if(!isset($_SESSION['nethaat_user_session']) && $_SESSION['nethaat_user_session']=="")
{
	//select user IP address to get User Country code and Currency code
	$country_code = getIPAdressInfomation($_SERVER['REMOTE_ADDR']);

	//unset session first if already exists and set new user session
	unset($_SESSION['nethaat_user_session']);
	//$_SESSION['nethaat_user_session']['country_code'] = $country_code;

	if(isset($country_code) && $country_code!="")
	{
		//get currency code
		$objDynamic->country_code = $country_code;
		$currency_code = $objDynamic->selectCountryCurrency();

		$amount = 1;
		$from	= DEFAULT_CURRENCY; //from currency
		$to		= $currency_code; //to currency

		$currency_rate = YahooFinanceConverter($amount, $from, $to);
		if($currency_rate===false)
		{
			//echo "Can't process the conversion";
			//if did not receive currency from Yahoo then set defaults
			$currency_rate = 1;
			$currency_code = "USD";
		}
		else
		{
			//echo $currency_rate;
		}
		/*
		//now include currency converter class and create object
		include_once('currency_class.php');
		$c = new JOJO_Currency_yahoo();

		//Amount to convert
		$amount = (int)1;

		// Get rate
		$rate = $c->getRate($from, $to, true);

		// Total price (to 2 decemial points)
		$total = number_format(($rate*$amount),2);
		*/

		$_SESSION['nethaat_user_session']['currency_code'] = $currency_code;
		$_SESSION['nethaat_user_session']['currency_rate'] = $currency_rate;
	}
}?>