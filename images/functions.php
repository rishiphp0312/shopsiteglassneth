<?php
/**
 * This file contains all common functions used in application
 */

function redirect($page)
{
	if(!headers_sent())
	{
		header("location:$page");
	}	
	else
	{
		echo "<script>location.href='$page'</script>";
	}
	exit;	
}

function check_country($country_code,$match_array=array())
{
    
	$exsist_inarray          = in_array($country_code,$match_array);	
    return $exsist_inarray;
}


/**
 * This function is used to calculate age
 *
 * @param string $birthday
 * @return int
 */
function birthday($birthday)
{
	list($year,$month,$day) = explode("-",$birthday);
	$year_diff = date("Y") - $year;
	$month_diff = date("m") - $month;
	$day_diff = date("d") - $day;
	if ($month_diff < 0) $year_diff--;
	elseif (($month_diff==0) && ($day_diff < 0)) $year_diff--;
	return $year_diff;
}

//change date format to yyyy-mm-dd
function changeDateFormat($date)
{
	list($month,$day,$year) = explode("/",$date);
	$newDate = $year."-".$month."-".$day;
	return $newDate;
}

/**
 * create rendom password
 *
 * @param int $length
 * @return string
 */
function generatePassword($length=8)
{
	$chars = "234567890abcdefghijkmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$i = 0;
	$password = "";
	while ($i <= $length)
	{
		$password .= $chars{mt_rand(0,strlen($chars))};
		$i++;
	}
	return $password;
}
/**
 * Move file from one directory to another directory
 *
 * @param string $file (full source file path)
 * @param string $newFolder (full destination path)
 * @return string
 */
function moveFile($file, $newFolder) 
{
    if (!is_dir($newFolder)) 
    {
        return 'Move to folder '.$newFolder.' does not exist';
    }
    
    $newFolder = (in_array(substr($newFolder, -1), array('/', '\\')) ? $newFolder : $newFolder.'/');
    
    if (is_file($file)) 
    {
        $filename = basename($file);
        rename($file, $newFolder.$filename);
        return 'File '.$filename.' moved to '.$newFolder;
    }
    return 'File '.$file.' does not exist';
}
function clearInput($strText)
{
    //returns safe code for preloading in the RTE
	$tmpString = trim($strText);

	/*
	//convert all types of single quotes
	$tmpString = str_replace(chr(145), chr(39), $tmpString);
	$tmpString = str_replace(chr(146), chr(39), $tmpString);
	$tmpString = str_replace("'", "&#39;", $tmpString);

	//convert all types of double quotes
	$tmpString = str_replace(chr(147), chr(34), $tmpString);
	$tmpString = str_replace(chr(148), chr(34), $tmpString);

	//replace carriage returns & line feeds
	$tmpString = str_replace(chr(10), " ", $tmpString);
	$tmpString = str_replace(chr(13), " ", $tmpString);
    */
	$tmpString = htmlentities($tmpString);
	return $tmpString;
}
function rteSafe($strText)
{
    //returns safe code for preloading in the RTE
	$tmpString = trim($strText);

	//convert all types of single quotes
	$tmpString = str_replace(chr(145), chr(39), $tmpString);
	$tmpString = str_replace(chr(146), chr(39), $tmpString);
	$tmpString = str_replace("'", "&#39;", $tmpString);

	//convert all types of double quotes
	$tmpString = str_replace(chr(147), chr(34), $tmpString);
	$tmpString = str_replace(chr(148), chr(34), $tmpString);

	//replace carriage returns & line feeds
	$tmpString = str_replace(chr(10), " ", $tmpString);
	$tmpString = str_replace(chr(13), " ", $tmpString);
    
	//$tmpString = htmlentities($tmpString);
	return $tmpString;
}
/**
 * generate dates between two given dates
 *
 * @param date $fromDate
 * @param date $toDate
 * @return array
 */
function generateDates($fromDate="",$toDate="")
{
	$dateArr = array();
	//$fromDate	= "01-07-2009";
	//$toDate		= "15-07-2009";  
	$fromDateTS	= strtotime($fromDate);
	$toDateTS	= strtotime($toDate);
	
	$cnt	=	1;
	for ($currentDateTS = $fromDateTS; $currentDateTS <= $toDateTS; $currentDateTS += (60 * 60 * 24)) 
	{
		// use date() and $currentDateTS to format the dates in between
		$currentDateStr = date("Y-m-d",$currentDateTS);
		$dateArr[$cnt] = $currentDateStr;
		$cnt++;
	}
	//print_r($dateArr);
	return $dateArr;
}

/**
* session success flash message
**/
function success_msg($msg)
{
	//echo "sssss=".$msg." session=".$_SESSION['SUCCESS_MESSAGE'];
	if(isset($msg))
	{
		$_SESSION['SUCCESS_MESSAGE'] = $msg;
	}	//echo "sssss=".$msg." session=".$_SESSION['SUCCESS_MESSAGE'];die;
}
/**
* session failure flash message
**/
function failure_msg($msg)
{
	if(isset($msg))
	{
		$_SESSION['ERROR_MESSAGE'] = $msg;
		//echo "sssss=".$msg." session=".$_SESSION['ERROR_MESSAGE'];die;
	}
}

function validateUserName($value, $min=3, $max=30)
{
	//!preg_match("/^[a-zA-Z0-9]+([_.a-zA-Z0-9]+)*$/"
	
	if(!isset($value) || trim($value)=='' || strlen($value)<$min || strlen($value)>$max || !preg_match("/^[a-zA-Z0-9]+([a-zA-Z0-9]+)*$/", $value))
	{
		return false; //$field.'|'.$errorMessage
	}
	else
	{
		return true; //$field.'|'
	}
}

function getIPAdressInfomation($userip)
{
	//set default country code if API fails
	$country_code = "US";
	
	$url = "http://ipinfodb.com/ip_query.php?ip=".$userip."&timezone=true";
	//$url="http://www.geobytes.com/IpLocator.htm?GetLocation&IpAddress=".$userip;
	
	$ch = curl_init($url); 
	curl_setopt($ch, CURLOPT_HEADER, 0); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	//curl_setopt($ch, CURLOPT_POSTFIELDS,$request); 
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	$xml_resp = curl_exec($ch);
	curl_close($ch);
	//print $xml_resp;
	$xml = simplexml_load_string($xml_resp);
	/*
	print "<pre>";
	print_r($xml);
	print "</pre>";
	*/
	
	//echo "country=".$xml->CountryName.' code='.$xml->CountryCode;
	$country_code = $xml->CountryCode;
	return $country_code;
}
?>