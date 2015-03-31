<?php
include ("common_includes.php");
include ("../include/adminsession.php.inc");
include ("../class/class.user.inc");
include ('../include/country_state_cat.php');

//create object of User class
$objUser = new Class_User();

//assign static labels and heading
$smarty->assign("form_heading","Manage Members");
$ACT_VAL               = $_REQUEST['ACT_VAL'];
$user_id               = $_REQUEST['user_id'];
$smarty->assign('array_for_id', array(1,2,3,4,5,6,7,8,9,10,11,12));
$smarty->assign('array_for_month', array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'));

     if($ACT_VAL!='' && $user_id!='')
	{
	
	$objUser->id     	= $user_id;
	if($ACT_VAL!=99 && $ACT_VAL!=100 )
	{
	    $objUser->status 	= $ACT_VAL;
	    $objDBReturn     	= $objUser->changeUserStatus();
	}
	
	if($ACT_VAL==99 || $ACT_VAL==100 )
	{
	
		if($ACT_VAL==99)
		$objUser->isdeleted = 0;
		
		if($ACT_VAL==100)
		$objUser->isdeleted = 1;
	
        $objDBReturn2 = $objUser->changeDeleteUserStatus();
	
	}
	//// change user status
	
	/// remove status
		
	if($objDBReturn->nErrorCode==0 || $objDBReturn2->nErrorCode==0 )
	{
		if($ACT_VAL==1)
		{
			$strStatus = "Activated";
		}
                else if($ACT_VAL==99)
		{
			$strStatus = "Restored";
		}
		else if($ACT_VAL==100)
		{
			$strStatus = "Deleted";
		}
		else
		{
			$strStatus = "De-Activated";
		}
		success_msg("User has been $strStatus successfully!");
		
	}
	else 
	{
		failure_msg("Error occured while updating user status, please try again later");
	
	}
	redirect("admin_users.php");

	
	
	}
$objUser->show_deleted = "Yes";//do not display deleted records
//search by first name
if(isset($_REQUEST['FirstName']) && trim($_REQUEST['FirstName'])!="")
{
	$objUser->first_name	=	trim($_REQUEST['FirstName']);
}
if(isset($_REQUEST['store_name']) && trim($_REQUEST['store_name'])!="")
{
	$objUser->store_name	=	trim($_REQUEST['store_name']);
}

//search by last name
if(isset($_REQUEST['LastName']) && trim($_REQUEST['LastName'])!="")
{
	$objUser->last_name	=	trim($_REQUEST['LastName']);
}
//search by Email
if(isset($_REQUEST['Email']) && trim($_REQUEST['Email'])!="")
{
	$objUser->email	        =	trim($_REQUEST['Email']);
}
if(isset($_REQUEST['username']) && trim($_REQUEST['username'])!="")
{
	$objUser->username	=	trim($_REQUEST['username']);
    $smarty->assign("username",$_REQUEST['username']);
}
//search by buyer or seller
if(isset($_REQUEST['user_type']) && trim($_REQUEST['user_type'])!="")
{
	$objUser->user_type	=	trim($_REQUEST['user_type']);
}

//search by buyer or seller
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
$smarty->assign("store_name",$_REQUEST['store_name']);
if($_REQUEST['user_type']==4)
{
	$smarty->assign("user_type_assign_buyer","checked='checked'");

}
if($_REQUEST['user_type']==3)
{
	$smarty->assign("user_type_assign_seller","checked='checked'");

}

            if($_REQUEST['sel_days']!='' && $_REQUEST['sel_days']!=0)
			{
            $objUser->sel_days = $sel_days;
            }
                        
			if($_REQUEST['sel_month']!='' && $_REQUEST['sel_month']!=0)
			$objUser->sel_month = $_REQUEST['sel_month'];
			
            $sel_year           = $_REQUEST['sel_year'];
          
		    if($_REQUEST['sel_year']!='')
			$objUser->sel_year  = $_REQUEST['sel_year'];
			else
			$objUser->sel_year  = date('Y');
			
                        
            if($_REQUEST['sel_year']!='')
            $smarty->assign("sel_year",$_REQUEST['sel_year']);
			else
			 $smarty->assign("sel_year",date('Y'));
			

			$val_maonth_add    =  1;
			if($_REQUEST['sel_month']&& $_REQUEST['sel_month']!=0)
			$smarty->assign("sel_month",$_REQUEST['sel_month']);
			



                        //$objUser->purchased_date =1;

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






//set search request variables
$smarty->assign("selectcountry",trim($_REQUEST['country_value']));
$smarty->assign("state",trim($_REQUEST['state']));
$smarty->assign("city",trim($_REQUEST['city']));
$smarty->assign("FirstName",trim($_REQUEST['FirstName']));
$smarty->assign("LastName",trim($_REQUEST['LastName']));
$smarty->assign("Email",trim($_REQUEST['Email']));


#>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  Code for pagination START   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<#
//select total recoords
$objResCatTotal = $objUser->selectUser();
$num_rows = mysql_num_rows($objResCatTotal);
$pagination = new Pagination();


if(!isset($_GET['pageNumber']))
{
	$pageNumber = 1;
}
else
{
	$pageNumber= $_GET['pageNumber'];
}

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
$url = basename($_SERVER['PHP_SELF'])."?FirstName=".$_REQUEST['FirstName']."&LastName=".$_REQUEST['LastName']."&Email=".$_REQUEST['Email']."&status=".$_REQUEST['status'].'&city='.$_GET['city'].'&state='.$_REQUEST['state'].'&country_value='.$_GET['country_value'].'&sel_days='.$_REQUEST['sel_days'].'&sel_month='.$_REQUEST['sel_month'].'&sel_year='.$_REQUEST['sel_year'].'&username='.$_GET['username'].'&store_name='.$_GET['store_name'];
if($pageNumber==1 || $pageNumber=='')
{
	$counter=1;
}
else
{
	$counter = $pageNumber+$from-($pageNumber-1);
}
$pageLimit =" LIMIT $from,$to";
$pageLink = $pagination->getPageLinks($num_rows,$to,$url,$pageNumber,'',$showPrevNext);
// Assigning Pagination Links
$smarty->assign('pageLink',$pageLink);    
#>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  End Code for END   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<#

//assign page limit

$objUser->pageLimit = $pageLimit;
//selects category list
$usersList      = array();

$objUser->email = trim($_REQUEST['Email']);
//$objUser->email=trim($_REQUEST['Email']);

$objResUser     = $objUser->selectUser();
$page_counter   = $pagination->getPageCounter(mysql_num_rows($objResUser));
$smarty->assign('page_counter',$page_counter);

//echo "sss=".mysql_num_rows($objResUser);
while($UserRow = mysql_fetch_array($objResUser))
{
	$usersList[]	= $UserRow;
}
$smarty->assign('usersList',$usersList);


//echo "<br>arr cnt=".count($usersList);

//delete user permanantely


//change user delete status
if(isset($_REQUEST['delete_status']) && $_REQUEST['delete_status']!="")
{
	$objUser->isdeleted = $_POST['delete_status'];
	//$user_id		    = $_REQUEST['delete'];
	$objUser->id 		= $_POST['user_id'];
	// $objDBReturn2 	    = $objUser->deleteUser();
	$objDBReturn2 = $objUser->changeDeleteUserStatus();
	//exit;
	if($objDBReturn2->nErrorCode==0 )
	{
	
		success_msg("User has been deleted successfully!");
		
	}
	else 
	{
		failure_msg("Error occured while deleting user, please try again later");
		
	}
	redirect("admin_users.php");
	//header()
}//end of if


//display template and title
$smarty->assign('site_page_title',ADMIN_COMMON_TITLE);
$smarty->assign('site_title',$site_title);
$smarty->display('admin_users.tpl');	
?>
