<?php
include ("common_includes.php");
include ("../include/adminsession.php.inc");
include ("../class/class.item.inc");
include ("../class/class.user.inc");
include ("../class/class.shipping.inc");
include ('../include/country_state_cat.php');
include ("../class/class.category.inc");

//assign static labels and heading
$smarty->assign("form_heading","Manage Shipping");

 $objItem        = new Class_Item();
 $objUser        = new Class_User();
 $objShip        = new Class_Shipping();
 $smarty->assign('array_for_id', array(1,2,3,4,5,6,7,8,9,10,11,12));
 $smarty->assign('array_for_month', array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'));

//create object of Item class
                        //	else
		        //	$objItem->sel_days = date('m');

                        if($_REQUEST['sel_days']!='' && $_REQUEST['sel_days']!=0)
			{
                        $sel_days  = $_REQUEST['sel_days'];
                        $sel_month = $_REQUEST['sel_month'];
                        $sel_year  = $_REQUEST['sel_year'];
                        $total_date = $sel_year.'-'.$sel_month.'-'.$sel_days;
                        $objShip->sel_days = $sel_days;
                        }
                      
			if($_REQUEST['sel_month']!=0 && $_REQUEST['sel_month']!='')
			$objShip->sel_month       = $_REQUEST['sel_month'];
		
                        if(isset($_REQUEST['sel_month']) && $_REQUEST['sel_month']!=0)
			{
                        $objShip->purchased_date  = "1";
                        $smarty->assign("chkActive","checked='checked'");
			}
                        if(isset($_REQUEST['sel_year']) && $_REQUEST['sel_year']!=0)
			$objShip->sel_year  = $_REQUEST['sel_year'];
			$smarty->assign("sel_year",$_REQUEST['sel_year']);

			$val_maonth_add    =  1;
			if($_REQUEST['sel_month']!=0)
			$smarty->assign("sel_month",$_REQUEST['sel_month']);
			//else
			//$smarty->assign("sel_month",date('m'));
                        if($_REQUEST['sel_year']!=0)
			$smarty->assign("sel_year",$_REQUEST['sel_year']);
	

			if($_REQUEST['status']==1)
			$smarty->assign("show_status",'NA');

			
                          if(isset($_REQUEST['country_value']) && $_REQUEST['country_value']!=0 && $_REQUEST['country_value']!='')
                        {
                                $objShip->country_value	=	trim($_REQUEST['country_value']);
                        }
                         if(isset($_REQUEST['ship_status']) && $_REQUEST['ship_status']!=0 && $_REQUEST['ship_status']!='')
                        {
                                $objShip->ship_status	=	trim($_REQUEST['ship_status']);
                                $smarty->assign("ship_status",trim($_REQUEST['ship_status']));
                        }

                        if($_REQUEST['country_value']!=0)
                        $smarty->assign("selectcountry",trim($_REQUEST['country_value']));
                        
	                if(isset($_REQUEST['state']) && trim($_REQUEST['state'])!="")
                        {
                                $objShip->state	=	trim($_REQUEST['state']);
                                $smarty->assign("state",trim($_REQUEST['state']));
                        }
                        if(isset($_REQUEST['title']) && trim($_REQUEST['title'])!="")
                          {
                                $objShip->title	=	trim($_REQUEST['title']);
                                $smarty->assign("title",trim($_REQUEST['title']));
                          }
                        if(isset($_REQUEST['Username']) && trim($_REQUEST['Username'])!="")
                          {
                                $objShip->username	=	trim($_REQUEST['Username']);
                                $smarty->assign("Username",trim($_REQUEST['Username']));
                          }
                          if(isset($_REQUEST['shipping_cost']) && trim($_REQUEST['shipping_cost'])!="")
                          {
                                $objShip->shipping_cost	=	trim($_REQUEST['shipping_cost']);
                                $smarty->assign("shipping_cost",trim($_REQUEST['shipping_cost']));
                          }



                      //  state
                        if(isset($_REQUEST['Zipcode']) && trim($_REQUEST['Zipcode'])!="")
                           {
                           $objShip->Zipcode	=	trim($_REQUEST['Zipcode']);
                           $smarty->assign("Zipcode",trim($_REQUEST['Zipcode']));
                           }

                        if(isset($_REQUEST['city']) && trim($_REQUEST['city'])!="")
                           {
                           $objShip->city	=	trim($_REQUEST['city']);
                           $smarty->assign("city",trim($_REQUEST['city']));
                           }

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





                        $upd_status             = $_REQUEST['upd_status'];
                        //Hand picked item
                        if($upd_status!='')
                        {
                           $objShip->ship_status = $_REQUEST['ship_status_value'];
                           $objShip->ship_id     = $upd_status;
                           $objShip->insertUpdateshipping();
                           success_msg("Shipping process is completed successfully!");
                           redirect('show_shipping_values.php');
                        }






		//set search request variables
		$smarty->assign("FirstName",trim($_REQUEST['FirstName']));
		$smarty->assign("LastName",trim($_REQUEST['LastName']));
		$smarty->assign("Email",trim($_REQUEST['Email']));


///////--code for  serching ends here



#>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  Code for pagination START   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<#
//select total recoords

$objResCatTotal = $objShip->getshippingdetails();
$sum=0;
$total_records  = mysql_num_rows($objResCatTotal);
if($total_records>0){
while($Row_1 = mysql_fetch_array($objResCatTotal))
{
	$tot_ship_cost	= $Row_1['shipping_cost']+$sum;
        $sum=$tot_ship_cost;
}
}
//echo 'tot_ship_cost=='.$tot_ship_cost;
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


 $url = basename($_SERVER['PHP_SELF'])."?Username=".$_REQUEST['Username']."&title=".$_REQUEST['title']."&shipping_cost=".$_REQUEST['shipping_cost']."&status=".$_REQUEST['status']."&Zipcode=".$_REQUEST['Zipcode']."&sel_days=".$_REQUEST['sel_days']."&sel_year=".$_REQUEST['sel_year']."&sel_month=".$_REQUEST['sel_month']."&parentNAME=".$_REQUEST['parentNAME']."&category_id=".$_REQUEST['category_id']."&country_value=".$_REQUEST['country_value']."&state=".$_REQUEST['state']."&ship_status=".$_REQUEST['ship_status']."&form_member_search=Search";
   
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

$productList = array();

$objResItem = $objShip->getshippingdetails();
$page_counter = $pagination->getPageCounter(mysql_num_rows($objResItem));
$smarty->assign('page_counter',$page_counter);

while($Row = mysql_fetch_array($objResItem))
{
	$productList[]	= $Row;
}
$smarty->assign('productList',$productList);

//display template and title

$smarty->assign('tot_ship_cost',$tot_ship_cost);
$smarty->assign('site_page_title',ADMIN_COMMON_TITLE);
$smarty->assign('site_title',$site_title);
$smarty->display('show_shipping_values.tpl');	
?>