<?php
include ("common_includes.php");
include ("../include/adminsession.php.inc");
include ("../class/class.item.inc");
include ("../class/class.user.inc");
include ("../class/class.package.inc");
include ('../include/country_state_cat.php');
include ("../class/class.category.inc");


//assign static labels and heading
$smarty->assign("form_heading","Manage Purchased Packages");
$smarty->assign('array_for_id', array(1,2,3,4,5,6,7,8,9,10,11,12));
$smarty->assign('array_for_month', array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'));


//create object of Item class

$objItem	        = new Class_Item();
$objUser                = new Class_User();
$objPackage             = new Class_Package();
$delete_item_value_id   = trim($_REQUEST['delete_item_value']);
$upd_status             = $_REQUEST['upd_status'];


//set search request variables
$smarty->assign("FirstName",trim($_REQUEST['FirstName']));
$smarty->assign("LastName",trim($_REQUEST['LastName']));
$smarty->assign("Email",trim($_REQUEST['Email']));

 if($_REQUEST['package_cost']!='')
 {
 $package_cost               =  trim($_REQUEST['package_cost'],'');
 $objPackage->package_cost   =  $package_cost;
 $smarty->assign("package_cost",$package_cost);
 }
 if($_REQUEST['sel_days']!='' && $_REQUEST['sel_days']!=0)
 {
   $sel_days  = $_REQUEST['sel_days'];
   $sel_month = $_REQUEST['sel_month'];
   $sel_year  = $_REQUEST['sel_year'];
   $total_date = $sel_year.'-'.$sel_month.'-'.$sel_days;
   $objPackage->sel_days = $sel_days;
   $smarty->assign("sel_days",$_REQUEST['sel_days']);
   }
                        //	else
		        //	$objItem->sel_days = date('m');

if($_REQUEST['sel_month']!='' && $_REQUEST['sel_month']!=0)
$objPackage->sel_month   = $_REQUEST['sel_month'];

if($_REQUEST['sel_month'] && $_REQUEST['sel_month']!=0)
$smarty->assign("sel_month",$_REQUEST['sel_month']);



if($_REQUEST['sel_year']!='')
$smarty->assign("sel_year",$_REQUEST['sel_year']);
else
$smarty->assign("sel_year",date('Y'));

if($_REQUEST['sel_year']!='')
$objPackage->sel_year  = $_REQUEST['sel_year'];

$smarty->assign("sel_year",$_REQUEST['sel_year']);
$val_maonth_add    =  1;

$select_date = $_REQUEST['select_date'];

if(isset($_REQUEST['select_date']) && trim($_REQUEST['select_date'])!="")
$objPackage->select_date=$select_date;
$smarty->assign("select_date",$_REQUEST['select_date']);





if(isset($_REQUEST['country_value']) && $_REQUEST['country_value']!="0" && $_REQUEST['country_value']!='')
{
   $objPackage->country_value	=	trim($_REQUEST['country_value']);

}
                      //  state
$smarty->assign("selectcountry",trim($_REQUEST['country_value']));

if(isset($_REQUEST['username']) && trim($_REQUEST['username'])!="")
{
$objPackage->username	=	trim($_REQUEST['username']);
   
}
                      //  state
$smarty->assign("username",trim($_REQUEST['username']));

if(isset($_REQUEST['state']) && trim($_REQUEST['state'])!="")
   {
   $objPackage->state	=	trim($_REQUEST['state']);
   }
if(isset($_REQUEST['city']) && trim($_REQUEST['city'])!="")
   {
   $objPackage->city	=	trim($_REQUEST['city']);
   }
   $smarty->assign("state",trim($_REQUEST['state']));
   $smarty->assign("city",trim($_REQUEST['city']));

//city


   
   //else

   $smarty->assign("select_date",$select_date);
   //  state


                        if($_REQUEST['cost_item']!='')
                        {
                        $cost_item              = trim($_REQUEST['cost_item'],'');

                        $objPackage->cost_item 	=	$cost_item ;
                        }
                        $commision_amount  = trim($_REQUEST['commision_amount'],'');
                        $smarty->assign("commision_amount",$commision_amount);

			if($_REQUEST['status']==1)
			$smarty->assign("show_status",'NA');

		
		
///////--code for  serching ends here



#>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  Code for pagination START   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<#
//select total recoords

$objResCatTotal = $objPackage->getPackagedetails();
$total_records  = mysql_num_rows($objResCatTotal);
if($total_records>0){
    $sum=0;
  while($Row_val = mysql_fetch_array($objResCatTotal))
                        {
                       $tot_purchase_cost_packg = $Row_val['amount']+ $sum;
                       $sum=$tot_purchase_cost_packg;
                        }
}
$smarty->assign("tot_purchase_cost_packg",$tot_purchase_cost_packg);
$pagination = new Pagination();

//set page number
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
$from			= ($pageNumber-1)*$to;
$showPrevNext	= true;

$url = basename($_SERVER['PHP_SELF'])."?parentNAME=".$_REQUEST['parentNAME']."&category_id=".$_REQUEST['category_id']."&status=".$_REQUEST['status']."&sel_year=".$_REQUEST['sel_year']."&sel_month=".$_REQUEST['sel_month']."&sel_days=".$_REQUEST['sel_days']."&cost_item=".$cost_item."&commision_amount=".$commision_amount."&country_value=".$_REQUEST['country_value']."&state=".$_REQUEST['state']."&username=".$_REQUEST['username']."&package_cost=".$package_cost."&form_member_search=Search&select_date=".$select_date;
if($pageNumber==1 || $pageNumber=='')
{
	$counter=1;
}
else
{
	$counter = $pageNumber+$from-($pageNumber-1);
}
$pageLimit =" LIMIT $from,$to";

$pageLink = $pagination->getPageLinks($total_records,$to,$url,$pageNumber,'',$showPrevNext);
// Assigning Pagination Links

$objShip->pageLimit = $pageLimit;

//assign page limit
//$objUser->pageLimit = $pageLimit;
$smarty->assign('pageLink',$pageLink);

#>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  End Code for END   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<#

//assign page limit
//$objUser->pageLimit = $pageLimit;
                       
                        //search by buyer or seller

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
                              $date_values    = '0'.$date_values;
                              $arr_date_days[]= $date_values;
                        }
                        $smarty->assign("no_of_days_curentmonth",$arr_date_days);
			$smarty->assign("current_month",date('m')+1);
			$smarty->assign("month_12",$month_12);
			$smarty->assign("year_12",$year_12);

                       
	
                        $productList = array();
                        $objPackage->pageLimit = $pageLimit;
                        $objResItem   = $objPackage->getPackagedetails();
                        $page_counter = $pagination->getPageCounter(mysql_num_rows($objResItem));
                        $smarty->assign('page_counter',$page_counter);

                        while($Row = mysql_fetch_array($objResItem))
                        {
                                $productList[]	= $Row;
                        }
                        $smarty->assign('productList',$productList);
                        $smarty->assign('page_some',mysql_num_rows($objResItem));
                        //display template and title
                        $smarty->assign('site_page_title',ADMIN_COMMON_TITLE);
                        $smarty->assign('site_title',$site_title);
                        $smarty->display('admin_reports_purchased_packages.tpl');
?>