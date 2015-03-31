<?php
include ("common_includes.php");
include ("../include/adminsession.php.inc");
include ("../class/class.user.inc");
include ("../class/class.item.inc");
include ('../include/country_state_cat.php');
//create object of User class
$objUser = new Class_User();

$objItem = new Class_Item();

//assign static labels and heading
$smarty->assign("form_heading","Manage Store");

$objUser->show_deleted = "Yes";//do not display deleted records
//search by first name
if(isset($_REQUEST['country_value']) && trim($_REQUEST['country_value'])!="")
{
	$objUser->country_value	=	trim($_REQUEST['country_value']);
}
if(isset($_REQUEST['city']) && trim($_REQUEST['city'])!="")
{
	$objUser->city	=	trim($_REQUEST['city']);
}
if(isset($_REQUEST['state']) && trim($_REQUEST['state'])!="")
{
	$objUser->state	=	trim($_REQUEST['state']);
}

if(isset($_REQUEST['FirstName']) && trim($_REQUEST['FirstName'])!="")
{
	$objUser->first_name	=	trim($_REQUEST['FirstName']);
}
//search by last name
if(isset($_REQUEST['LastName']) && trim($_REQUEST['LastName'])!="")
{
	$objUser->last_name	=	trim($_REQUEST['LastName']);
}
//search by Email
if(isset($_REQUEST['Email']) && trim($_REQUEST['Email'])!="")
{
	$objUser->email	=	trim($_REQUEST['Email']);
}
//search by buyer or seller
if(isset($_REQUEST['user_type']) && trim($_REQUEST['user_type'])!="")
{
	$objUser->user_type	=	trim($_REQUEST['user_type']);
}
if(isset($_REQUEST['store_name']) && trim($_REQUEST['store_name'])!="")
{
	$objUser->store_name	=	trim($_REQUEST['store_name']);
}
//store_name

//search by Active Status
if (isset($_REQUEST['status']) && $_REQUEST['status']=="Y")
{
    $objUser->Active	=	"Y";
    $smarty->assign("chkActive","checked='checked'");
}
else if (isset($_REQUEST['status']) && $_REQUEST['status']=="N")
{
    $objUser->Active	=	"N";
    $smarty->assign("chkInActive","checked='checked'");
}
else
{
    //$objUser->Active	=	"YN";
    $smarty->assign("chkBoth","checked='checked'");
}


//set search request variables
$smarty->assign("selectcountry",trim($_REQUEST['country_value']));
$smarty->assign("state",trim($_REQUEST['state']));
$smarty->assign("city",trim($_REQUEST['city']));
$smarty->assign("FirstName",trim($_REQUEST['FirstName']));
$smarty->assign("LastName",trim($_REQUEST['LastName']));
$smarty->assign("Email",trim($_REQUEST['Email']));

$smarty->assign("store_name",$_REQUEST['store_name']);


#>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  Code for pagination START   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<#
//select total recoords
 //$objUser->user_type =3;
$objResCatTotal = $objUser->getDetails_ofreportItem();
$pagination = new Pagination();


if(!isset($_GET['pageNumber']))
{
	$pageNumber = 1;
}
else
{
	$pageNumber= $_GET['pageNumber'];
}
$num_rows = mysql_num_rows($objResCatTotal);
//number of records per page LIMIT
if(isset($_GET['limit']) && is_numeric($_GET['limit']))
{
	$to	= trim($_GET['limit']);
}
else
{
	$to	=	ADMIN_PAGE_NUMBER;
}
$from=($pageNumber-1)*$to;
$showPrevNext = true;
//$url = "company.php?start_date=$start_date&end_date=$end_date&business=$business";
//$url = "admin_country.php?limit=".$to;
$url = basename($_SERVER['PHP_SELF'])."?FirstName=".$_GET['FirstName']."&LastName=".$_GET['LastName']."&Email=".$_GET['Email']."&status=".$_GET['status']."&city=".$_GET['city']."&state=".$_GET['state']."&country_value=".$_GET['country_value'];
if($pageNumber==1 || $pageNumber=='')
{
	$counter=1;
}
else
{
	$counter = $pageNumber+$from-($pageNumber-1);
}
$pageLimit =" LIMIT $from,$to";
$pageLink = $pagination->getPageLinks($num_rows, $to, $url, $pageNumber, '', $showPrevNext);
// Assigning Pagination Links
$smarty->assign('pageLink',$pageLink);
#>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  End Code for END   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<#

//assign page limit
$objUser->pageLimit = $pageLimit;

//selects category list
$usersList = array();

 $objUser->email=trim($_REQUEST['Email']);
//$objUser->email=trim($_REQUEST['Email']);

$objResUser = $objUser->getDetails_ofreportItem();
$page_counter = $pagination->getPageCounter(mysql_num_rows($objResUser));
$smarty->assign('page_counter',$page_counter);

if(mysql_num_rows($objResUser)>0)
{
while($UserRow = mysql_fetch_array($objResUser))
{
	$usersList[]	= $UserRow;
}
$smarty->assign('usersList',$usersList);
}

//echo "<br>arr cnt=".count($usersList);

//delete user permanantely
if(isset($_POST['delete_record']) && $_POST['delete_record']!="")
{
	/*
	$objUser->id = $_POST['user_id'];
	$objDBReturn = $objUser->deleteUser();
	if($objDBReturn->nErrorCode==0)
	{
		echo "1";//success
		exit;
	}
	else
	{
		echo "2";//failure
		exit;
	}*/
}//end of if

//update user status
if(isset($_REQUEST['approve_id']) && $_REQUEST['approve_id']!="")
{

	$objUser->id            = $_REQUEST['approve_id'];
	$objUser->approve_store = $_REQUEST['approve_store'];
	$objDBReturn            = $objUser->changeUserStatus();


        $objItem->approve_store = $_REQUEST['approve_store'];
	$objItem->user_id       = $_REQUEST['approve_id'];
	$objDBReturn1           = $objItem->updateItemstore();

    //echo $objDBReturn->nErrorCode."--nErrorCode-- &nAffectedRows--& ".$objDBReturn->nAffectedRows;
	//exit;
	if($objDBReturn1->nErrorCode==0)
	{
		if($_REQUEST['approve_store']==1)
		{
			 $strStatus = "Activated";
		}else
		{
		     $strStatus = "Deactivated";
		}

		success_msg("Store has been $strStatus successfully!");
		//echo "1";//success
		//exit;
	}
	else
	{
	//exit;
		failure_msg("Error occured while updating store status, please try again later");
		//echo "2";//failure
		//exit;
	}
	redirect("admin_approve_store.php");
}//end of if
//update store featured status
if(isset($_REQUEST['action']) && $_REQUEST['action']=="featured")
{
 $objUser->id            = $_REQUEST['user_id'];
 $objUser->fetured_date  = date("Y-m-d H:i:s"); //date("d/m/y : H:i:s",time());
 $objUser->feturedstatus = $_REQUEST['fetured_status'];

 $objDBReturn = $objUser->insertUpdateUser();

    if($objDBReturn->nErrorCode==0)
 {
  if($_REQUEST['fetured_status']==1)
  {
       $strStatus = "Featured";
  }
  else
  {
       $strStatus = "Un-Featured";
  }
  success_msg("Store has been $strStatus successfully!");
  //echo "1";//success or failure
  //exit;
 }
 else
 {
  failure_msg("Error occured while updating store status, please try again later");
  //echo "2";//success or failure
  // exit;
 }
   echo "<script>window.location = 'admin_approve_store.php'</script>";
}//end of if


//change user delete status
if(isset($_POST['delete_status']) && $_POST['delete_status']!="")
{
	$objUser->isdeleted = $_POST['delete_status'];
	$user_id = $_POST['user_id'];
	$objUser->id = $user_id;
	$objDBReturn2 = $objUser->deleteUser();
	//$objDBReturn2 = $objUser->changeDeleteUserStatus();

	if($objDBReturn2->nErrorCode==0 )
	{
		if($_POST['delete_status']==1)
		{
			$strStatus = "deleted";
		}
		else
		{
			$strStatus = "restored";
		}

		success_msg("User has been $strStatus successfully!");
		echo "1";//success
		exit;
	}
	else
	{
		failure_msg("Error occured while deleting user, please try again later");
		echo "2";//failure
		exit;
	}
	//header()
}//end of if


//display template and title
$smarty->assign('site_page_title',ADMIN_COMMON_TITLE);
$smarty->assign('site_title',$site_title);
$smarty->display('admin_report_items.tpl');
?>
