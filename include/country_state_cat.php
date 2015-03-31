<?php
/*
	    **************************** Creation Log ***************************************************************
	    File Name                   -	country_state_cat.php
	    Module Name                 -	class
	    Project Name                -	
	    Description                 -	Contain all common things i.e. select country, states and category which
									-	are common throught the site. It is used to create dropdon box etc
	    Version                     -	1.0
	    Created by                  -	Mahipal Adhikari 
	    Created on                  -	11-May-2010
		******************************** Update Log *************************************************************
		SNo		Version		Updated by			Updated on			Description
		*********************************************************************************************************
*/


$objJob 		= new Class_Dynamic();

/***************************************** Country ***********************************/
//selects country details to make country drop down
$countryName	= array();
$countryID		= array();
$countryCode		= array();
$countryID_Code		= array();

$resCountry = $objJob->selectCountry();
while($resCountryRow = mysql_fetch_array($resCountry))
{   
	//$countryID_Code[] = $resCountryRow['id'].'_'.$resCountryRow['country_iso_code_2'];
	$countryID[] 	  = $resCountryRow['id'];
	$countryCode[] 	  = $resCountryRow['country_iso_code_2'];
	$countryName[]	  = $resCountryRow['country'];
}
//print_r($countryID_Code);
$smarty->assign('countryID',$countryID);
$smarty->assign('countryName',$countryName);
$smarty->assign('countryCode',$countryCode);
//$smarty->assign('countryCodeWithId',$countryID_Code);


/***************************************** State ***********************************/
//selects states details to make state drop down
/*
$stateName	= array();
$stateID		= array();
$resState = $objJob->selectStates();
while($resStateRow = mysql_fetch_array($resState))
{
	$stateID[] 		= $resStateRow['state_id'];
	$stateName[]	= $resStateRow['name'];
}
$smarty->assign('stateID',$stateID);
$smarty->assign('stateName',$stateName);
*/
//print_r($stateName);

/***************************************** Category ***********************************/
//selects categories details to make categories drop down
/*
$catName			= array();
$catID				= array();
$categoryNameArr	= array();
$resCat = $objJob->selectCatgeory();
while($resCatRow = mysql_fetch_array($resCat))
{
	//for list
	$catArr[]	= $resCatRow;
	
	//for single category to display
	$categoryNameArr[$resCatRow['category_id']]	= $resCatRow['name'];
	
	//for list box
	$catID[] 	= $resCatRow['category_id'];
	$catName[]	= $resCatRow['name'];
}
$smarty->assign('catArr',$catArr);
$smarty->assign('catID',$catID);
$smarty->assign('catName',$catName);
$smarty->assign('categoryNameArr',$categoryNameArr);

*/


/***************************************** Regions ***********************************/
// to make region drop down for Merchant Coupon
/*
$regionName	= array();
$regionID	= array();
$regionNameArr = array();
$resRegion	= $objJob->selectRegions();
while($resRegionRow = mysql_fetch_array($resRegion))
{
	//for list box	
	$regionID[] 	= $resRegionRow['region_id'];
	$regionName[]	= $resRegionRow['name'];
	//for single region to display
	$regionNameArr[$resRegionRow['region_id']]	= $resRegionRow['name'];
}
$smarty->assign('regionID',$regionID);
$smarty->assign('regionName',$regionName);
$smarty->assign('regionNameArr',$regionNameArr);
*/
?>
