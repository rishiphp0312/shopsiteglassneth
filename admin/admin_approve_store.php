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
$smarty->assign('array_for_id', array(1,2,3,4,5,6,7,8,9,10,11,12));
 $smarty->assign('array_for_month', array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'));

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
if(isset($_REQUEST['username']) && trim($_REQUEST['username'])!="")
{
	$objUser->username	=	trim($_REQUEST['username']);
           $smarty->assign("username",$_REQUEST['username']);
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
             if($_REQUEST['sel_days']!='' && $_REQUEST['sel_days']!=0)
			{
                        $sel_days  = $_REQUEST['sel_days'];
                        $sel_month = $_REQUEST['sel_month'];
                      
                        $total_date = $sel_year.'-'.$sel_month.'-'.$sel_days;
                        $objUser->sel_days = $sel_days;
             }

			if($_REQUEST['sel_month']!=''&& $_REQUEST['sel_month']!=0)
			$objUser->sel_month = $_REQUEST['sel_month'];
			//else
			//$objUser->sel_month = date('m');

            $sel_year  = $_REQUEST['sel_year'];
		    if($_REQUEST['sel_year']!='')
			$objUser->sel_year  = $_REQUEST['sel_year'];
			else
			$objUser->sel_year  = date('Y');
		
			if($_REQUEST['sel_year']!='')
            $smarty->assign("sel_year",$_REQUEST['sel_year']);
			else
			$smarty->assign("sel_year",date('Y'));
           // $smarty->assign("sel_year",$_REQUEST['sel_year']);

			$val_maonth_add    =  1;
			if($_REQUEST['sel_month'])
			$smarty->assign("sel_month",$_REQUEST['sel_month']);
			



                      //  if($_REQUEST['sel_year']!='' && $_REQUEST['sel_month']!='')
                       // $objUser->purchased_date =1;

            for($i=1;$i<=12;$i++)
			{
		        $month_12[]              = date('m'+$i);
			}



			for($k=0;$k<=5;$k++)
			{
			$pass_year  = date('Y')-$k;
	    	        // $date_current_year = mktime( 0, 0, 0, $debut_month, 1, date( 'Y', $date_time ) );
                        $year_12[]  = date("Y", mktime(0, 0, 0, date('m'),date('d'), $pass_year));
			}

                        $num_of_daysinmonth = cal_days_in_month(CAL_GREGORIAN,date('m'), date('Y')); // 31
                        for($date_values=1;$date_values<=$num_of_daysinmonth;$date_values++)
                        {
                            if($date_values<10)
                              $date_values='0'.$date_values;
                              $arr_date_days[]= $date_values;
                        }
                        $smarty->assign("no_of_days_curentmonth",$arr_date_days);
			$smarty->assign("current_month",date('m')+1);
			$smarty->assign("month_12",$month_12);
			$smarty->assign("year_12",$year_12);
			$smarty->assign("FirstName",trim($_REQUEST['FirstName']));
			$smarty->assign("LastName",trim($_REQUEST['LastName']));
			$smarty->assign("Email",trim($_REQUEST['Email']));
                        $smarty->assign("cost_item",$cost_item);
                        $smarty->assign("sel_days",$sel_days);


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
$objResCatTotal = $objUser->selectUser();
$pagination = new Pagination();


if(!isset($_REQUEST['pageNumber']))
{
	$pageNumber = 1;
}
else
{
	$pageNumber= $_REQUEST['pageNumber'];
}
$num_rows = mysql_num_rows($objResCatTotal);
//number of records per page LIMIT
if(isset($_REQUEST['limit']) && is_numeric($_REQUEST['limit']))
{
	$to	= trim($_REQUEST['limit']);
}
else
{
	$to	=	ADMIN_PAGE_NUMBER;
}	
$from=($pageNumber-1)*$to;
$showPrevNext = true;
//$url = "company.php?start_date=$start_date&end_date=$end_date&business=$business";
//$url = "admin_country.php?limit=".$to;
$url = basename($_SERVER['PHP_SELF'])."?FirstName=".$_REQUEST['FirstName']."&LastName=".$_REQUEST['LastName']."&Email=".$_REQUEST['Email']."&status=".$_REQUEST['status'].'&city='.$_REQUEST['city'].'&state='.$_REQUEST['state'].'&country_value='.$_REQUEST['country_value'].'&sel_days='.$_REQUEST['sel_days'].'&sel_month='.$_REQUEST['sel_month'].'&sel_year='.$sel_year.'&username='.$_REQUEST['username'].'&store_name='.$_REQUEST['store_name'];
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

$objResUser = $objUser->selectUser();
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
$smarty->display('admin_approve_store.tpl');	
?>
