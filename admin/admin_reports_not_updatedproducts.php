<?php
include ("common_includes.php");
include ("../include/adminsession.php.inc");
include ("../class/class.item.inc");
include ("../class/class.user.inc");
include ('../include/country_state_cat.php');
include ("../class/class.category.inc");
//assign static labels and heading
$smarty->assign("form_heading","Manage  Products");

//create object of Item class
  $smarty->assign('array_for_id', array(1,2,3,4,5,6,7,8,9,10,11,12));
  $smarty->assign('array_for_month', array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'));

                        $objItem		= new Class_Item();
                        $objItem_delete	        = new Class_Item();
                        $objUser                = new Class_User();
                        $objCategory            = new Class_Category();

                         if(isset($_REQUEST['category_id']) && $_REQUEST['category_id']!=0)
						{
						$objItem->category_id	=	trim($_REQUEST['category_id'],'');
						$smarty->assign("category_id",$_REQUEST['category_id']);
						}

                        if(isset($_REQUEST['parent_id'])&& $_REQUEST['parent_id']!=0)
						{
						$objItem->parent_category_id	=	trim($_REQUEST['parent_id'],'');
						$smarty->assign("parent_category_id",$_REQUEST['parent_id']);
						}
								   
                        if(isset($_REQUEST['country_value']) && $_REQUEST['country_value']!=0 && $_REQUEST['country_value']!='')
                        {
                        $objItem->country_value	=	trim($_REQUEST['country_value']);
                        }
                         $smarty->assign("selectcountry",trim($_REQUEST['country_value']));
						if(isset($_REQUEST['state']) && trim($_REQUEST['state'])!="")
                        {
                        $objItem->state	=	trim($_REQUEST['state']);
                        }
                      //  state
                        $smarty->assign("state",trim($_REQUEST['state']));
                     
                        
                        for($i=1;$i<=12;$i++)
						{
							$month_12[]              = date('m'+$i);
						}
						if($_REQUEST['sel_year'])
						$smarty->assign("sel_year",$_REQUEST['sel_year']);
						else
						$smarty->assign("sel_year",date('Y'));

                        if($_REQUEST['sel_year']!='' && $_REQUEST['sel_month']!='')
                        $objItem->purchased_date =1;


                        if($_REQUEST['sel_days']!='' && $_REQUEST['sel_days']!=0)
						{
                        $sel_days  = $_REQUEST['sel_days'];
                        $objItem->sel_days = $sel_days;
                        }

                        if($_REQUEST['sel_year']!='' && $_REQUEST['sel_year']!=0)
						$objItem->sel_year = $_REQUEST['sel_year'];
						$smarty->assign("sel_year",$_REQUEST['sel_year']);
                        
                        if($_REQUEST['sel_month']!='')
						$objItem->sel_month = $_REQUEST['sel_month'];
						else
						$objItem->sel_month = date('m');
			
			
			
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
                        $val_maonth_add    =  1;

						if($_REQUEST['sel_month'])
						$smarty->assign("sel_month",$_REQUEST['sel_month']);
						else
						$smarty->assign("sel_month",date('m'));
			
									$smarty->assign("no_of_days_curentmonth",$arr_date_days);
						$smarty->assign("current_month",date('m')+1);
						$smarty->assign("month_12",$month_12);
						$smarty->assign("year_12",$year_12);
						$smarty->assign("FirstName",trim($_REQUEST['FirstName']));
						$smarty->assign("LastName",trim($_REQUEST['LastName']));
						$smarty->assign("Email",trim($_REQUEST['Email']));
                        $smarty->assign("cost_item",$cost_item);
                        $smarty->assign("sel_days",$sel_days);
                         if($_REQUEST['not_updated']!='' && $_REQUEST['not_updated']!=0)
                        {
                        $not_updated_last = $_REQUEST['not_updated'];
                        $objItem->not_updated	=	trim($_REQUEST['not_updated'],'');
                        $smarty->assign("not_updated",$_REQUEST['not_updated']);
                        }

                        
		        // get parent categories to create drop down
			// $parentID = array(0=>0);
			// $parentNAME = array(0=>'Top Level');
                       $parentRes = $objCategory->selectParentCatgeory();
                       while($parentRow = mysql_fetch_array($parentRes))
                         {
                                $parentID[] = $parentRow['category_id'];
                                $parentNAME[]      = $parentRow['name'];
                          }
                                        //print_r($parentNAME);
                        $smarty->assign("parentID",$parentID);
                        $smarty->assign("parentNAME",$parentNAME);
						if($_GET['parentNAME']!='' && $_GET['parentNAME']!=0 )
			                $objCategory->parent_id=$_GET['parentNAME'];
                        $CatgeoryRes = $objCategory->selectCatgeory1();
						while($SubCatgeoryRes = mysql_fetch_array($CatgeoryRes))
						{
							$SubCatID[]   = $SubCatgeoryRes['category_id'];
							$SubCatNAME[] = $SubCatgeoryRes['name'];
						}
						//print_r($parentNAME);
						$smarty->assign("SubCatID",$SubCatID);
						$smarty->assign("SubCatNAME",$SubCatNAME);
                        if(isset($_REQUEST['Username']))
                        {
                        $objUser->username	=	trim($_REQUEST['Username'],'');
                        $smarty->assign("Username",$_REQUEST['Username']);
                        $user_object    = $objUser->getUserLoginDetails();
                        $num_object     = mysql_num_rows($user_object);
                        if($num_object >0)
                        $reslt_fetch    = mysql_fetch_assoc($user_object);
                        //print_r($reslt_fetch);
                                //exit;
                                $sellers_id     = $reslt_fetch['id'];
                        //exit;
                        }




                    $delete_item_value_id     = trim($_REQUEST['delete_item_value']);
                    $suspend_item_value_id    = trim($_REQUEST['suspend_item_value']);
                    $approve_item_value_id    = trim($_REQUEST['approve_item_value']);
                    $handpicked_item_value_id = trim($_REQUEST['handpicked_item_value']);


        //Hand picked item





	 if($sellers_id!='' && $_REQUEST['Username']!='' )
	 {
	  $objItem->seller_id	=	$sellers_id ;
	 }
	 if($sellers_id=='' && $_REQUEST['Username']!='' )
	 {
	 $smarty->assign("no_id_fetched",'0');
	 }


	if(isset($_REQUEST['cost_item']))
	{
	$objItem->cost_item_val	=	trim($_REQUEST['cost_item'],'');
	$smarty->assign("cost_item",$_REQUEST['cost_item']);
	}

	if(isset($_REQUEST['status']) && $_REQUEST['status']=="1")
	{
	$objItem->status	=	"1";
	$smarty->assign("chkActive","checked='checked'");
	}
	else if(isset($_REQUEST['status']) && $_REQUEST['status']=="2")
	{
	$objItem->status	=	"2";
	$smarty->assign("chkInActive","checked='checked'");
	}
	else
	{
	$smarty->assign("chkBoth","checked='checked'");
	}
	

					
	if(isset($_REQUEST['title']))
	{
	$objItem->title_val	=	trim($_REQUEST['title'],'');
	$smarty->assign("blk_title",$_REQUEST['title']);
        }






		//set search request variables
	$smarty->assign("FirstName",trim($_REQUEST['FirstName']));
	$smarty->assign("LastName",trim($_REQUEST['LastName']));
	$smarty->assign("Email",trim($_REQUEST['Email']));





///////--code for  serching ends here



#>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  Code for pagination START   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<#
//select total recoords
        $objItem->recent_status   =303;

        $objResCatTotal = $objItem->getItemImageDetails_withothers();
        $total_records = mysql_num_rows($objResCatTotal);

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

   $url = basename($_SERVER['PHP_SELF'])."?title=".$_REQUEST['title']."&parentNAME=".$_REQUEST['parentNAME']."&category_id=".$_REQUEST['category_id']."&status=".$_REQUEST['status']."&sel_days=".$_REQUEST['sel_days']."&sel_year=".$_REQUEST['sel_year']."&sel_month=".$_REQUEST['sel_month']."&cost_item=".$cost_item."&country_value=".$_REQUEST['country_value']."&state=".$_REQUEST['state']."&ShippingStatus=".$_REQUEST['ShippingStatus']."&not_updated=".$_REQUEST['not_updated']."&form_member_search=Search";

    if($pageNumber==1 || $pageNumber=='')
    {
            $counter=1;
    }
    else
    {
            $counter = $pageNumber+$from-($pageNumber-1);
    }
    $pageLimit =" LIMIT $from,$to";
    $objItem->pageLimit = $pageLimit;

    $pageLink = $pagination->getPageLinks($total_records, $to, $url, $pageNumber,'', $showPrevNext);
    // Assigning Pagination Links
    $smarty->assign('pageLink',$pageLink);
    #>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  End Code for END   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<#

    //assign page limit
    $objUser->pageLimit = $pageLimit;

    $productList = array();
  
    $objResItem = $objItem->getItemImageDetails_withothers();
    $page_counter = $pagination->getPageCounter(mysql_num_rows($objResItem));
    $smarty->assign('page_counter',$page_counter);

    while($Row = mysql_fetch_array($objResItem))
    {
            $productList[]	= $Row;
    }
    $smarty->assign('productList',$productList);

    //display template and title
    $smarty->assign('site_page_title',ADMIN_COMMON_TITLE);
    $smarty->assign('site_title',$site_title);
    $smarty->display('admin_reports_not_updatedproducts.tpl');
?>