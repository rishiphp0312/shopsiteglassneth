<?php
include ("common_includes.php");
include ("../include/adminsession.php.inc");
include ("../class/class.item.inc");
include ("../class/class.user.inc");
include ('../include/country_state_cat.php');
include ("../class/class.category.inc");
$smarty->assign("anObject" , new Class_Dynamic() );


           //create object of Category class

           //assign static labels and heading
           $smarty->assign("form_heading","Manage Commision on Sold Products");
           $smarty->assign('array_for_id', array(1,2,3,4,5,6,7,8,9,10,11,12));
           $smarty->assign('array_for_month', array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'));

            $commision_status = $_REQUEST['commision_status'];
			$objItem     = new Class_Item();
			$objUser     = new Class_User();
			$objCategory = new Class_Category();
                       // echo  'category-id'.$_REQUEST['category_id'];
            if(isset($_REQUEST['category_id']) && $_REQUEST['category_id']!=0)
			{
			    $objItem->category_id	 =	trim($_REQUEST['category_id'],'');
			    $smarty->assign("category_id",$_REQUEST['category_id']);
			}
			if(isset($_REQUEST['parent_id'])&& $_REQUEST['parent_id']!=0)
			{
			     $objItem->parent_category_id =	trim($_REQUEST['parent_id'],'');
			     $smarty->assign("parent_category_id",$_REQUEST['parent_id']);
			}
			
			 $smarty->assign("commision_status",$commision_status);
               
        	 //get parent categories to create drop down
			 //$parentID = array(0=>0);
			 //$parentNAME = array(0=>'Top Level');
			  $parentRes = $objCategory->selectParentCatgeory();
              while($parentRow = mysql_fetch_array($parentRes))
              {
                          $parentID[] = $parentRow['category_id'];
                          $parentNAME[]      = $parentRow['name'];
               }
                                    //print_r($parentNAME);
                            $smarty->assign("parentID",$parentID);
                            $smarty->assign("parentNAME",$parentNAME);
                            $objCategory = new Class_Category();
                                        //get parent categories to create drop down
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



                            if($_REQUEST['sel_days']!='' && $_REQUEST['sel_days']!=0)
                            {
                            $sel_days  = $_REQUEST['sel_days'];
                            $sel_month = $_REQUEST['sel_month'];
                            $sel_year  = $_REQUEST['sel_year'];
                            $total_date = $sel_year.'-'.$sel_month.'-'.$sel_days;
                            $objItem->sel_days = $sel_days;
                            }

                            if($_REQUEST['sel_month']!=''&& $_REQUEST['sel_month']!=0)
                            {
                            $objItem->sel_month  = $_REQUEST['sel_month'];
                            $smarty->assign("sel_month",$_REQUEST['sel_month']);
                            $objItem->purchased_date	=	"1";
                            $smarty->assign("chkActive","checked='checked'");
                            }

                            if($_REQUEST['sel_year']!='')
                            $smarty->assign("sel_year",$_REQUEST['sel_year']);
                            else
                            $smarty->assign("sel_year",date('Y'));

                            if($_REQUEST['sel_year']!='')
                            $objItem->sel_year  = $_REQUEST['sel_year'];
                            $smarty->assign("sel_year",$_REQUEST['sel_year']);

                            $val_maonth_add    =  1;
			
			//|date_value_month
			//echo 'aa';
			//echo '<br>';
                        if($_REQUEST['cost_item']!='')
                        {
                        $cost_item              = trim($_REQUEST['cost_item'],'');
                        $objItem->cost_item 	= $cost_item ;
                        }
                        $commision_amount  = trim($_REQUEST['commision_amount'],'');
                        $smarty->assign("commision_amount",$commision_amount);
						
						

		

						if($_REQUEST['status']==1)
						$smarty->assign("show_status",'NA');
			
							 if(isset($_REQUEST['status']) && $_REQUEST['status']=="2")
						{
						$objItem->purchased_date	=	"2";
						$smarty->assign("chkInActive","checked='checked'");
						}
						else
						{
						$objItem->purchased_date==12;
						$smarty->assign("chkBoth","checked='checked'");
						}
                        //search by buyer or seller
                        if(isset($_REQUEST['country_value']) && $_REQUEST['country_value']!=0 && $_REQUEST['country_value']!='')
                        {
                        $objItem->country_value	=	trim($_REQUEST['country_value']);
                        }
                      //  state
                        $smarty->assign("selectcountry",trim($_REQUEST['country_value']));
	                if(isset($_REQUEST['state']) && trim($_REQUEST['state'])!="")
                        {
                        $objItem->state	=	trim($_REQUEST['state']);
                        }
                      //  state
                        $smarty->assign("state",trim($_REQUEST['state']));
                        if(isset($_REQUEST['city']) && trim($_REQUEST['city'])!="")
                        {
                        $objItem->city	=	trim($_REQUEST['city']);
                        }
                        $smarty->assign("city",trim($_REQUEST['city']));
						if($commision_status!=2)
						 {
						  $objItem->commision_status	=	$commision_status;
						 }
                        for($i=1;$i<=12;$i++)
			              {
		                  $month_12[]              = date('m'+$i);
			              }



						for($k=0;$k<=5;$k++)
						{
						// $date_current_year = mktime( 0, 0, 0, $debut_month, 1, date( 'Y', $date_time ) );
						$pass_year  = date('Y')-$k;					
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
					//echo 'sellers-id'.$sellers_id;
		
		
		
		
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

	            

                     if(isset($_REQUEST['parent_id'])&& $_REQUEST['parent_id']!=0)
					{
					//$objItem->parent_category_id	=	trim($_REQUEST['parent_id'],'');
					$smarty->assign("parent_category_id",$_REQUEST['parent_id']);
					}

                    $objItem->default_value=1;

                    if($_REQUEST['sel_year']!='' && $_REQUEST['sel_month']!='')
                    $objItem->purchased_date =1;

    #>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  Code for pagination START   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<#
    //select total recoords
                    if($commision_amount!='')
                    $objItem->commision_amount =  $commision_amount;

                   //  $cost_item


                     $objItem->payment_status=1;
                     $objResCatTotal = $objItem->getsolditem_withcommision();
                     $total_records = mysql_num_rows($objResCatTotal);
                     if($total_records>0)
                     {$sum=0;
                      while($Row_tot_sold_item = mysql_fetch_array($objResCatTotal))
                        {
                            $tot_commison_cost_item	= $Row_tot_sold_item['commision_amount']+$sum;
                            $sum                    = $tot_commison_cost_item;
                        }

                     }
                     $smarty->assign('tot_commison_cost_item',$tot_commison_cost_item);
                     $smarty->assign('productList',$productList);
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

                    $url = basename($_SERVER['PHP_SELF'])."?";
                    if($pageNumber==1 || $pageNumber=='')
                    {
                            $counter=1;
                    }
                    else
                    {                         $counter = $pageNumber+$from-($pageNumber-1);
                    }
                    $pageLimit =" LIMIT $from,$to";
                    $objItem->pageLimit = $pageLimit;
                    $url = basename($_SERVER['PHP_SELF'])."?parentNAME=".$_REQUEST['parentNAME']."&category_id=".$_REQUEST['category_id']."&status=".$_REQUEST['status']."&sel_year=".$_REQUEST['sel_year']."&sel_month=".$_REQUEST['sel_month']."&sel_days=".$_REQUEST['sel_days']."&cost_item=".$cost_item."&commision_amount=".$commision_amount."&country_value=".$_REQUEST['country_value']."&state=".$_REQUEST['state']."&commision_status=$commision_status&Username=".$_REQUEST['Username']."&form_member_search=Search";
                    $pageLink = $pagination->getPageLinks($total_records,$to,$url,$pageNumber,'', $showPrevNext);
                    // Assigning Pagination Links
                    //$objItem->pageLimit = $pageLimit;
                    $smarty->assign('pageLink',$pageLink);
            #>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  End Code for END   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<#

		//assign page limit
		
		$productList = array();
		//$objItem->recent_status   =303;
		$objResItem = $objItem->getsolditem_withcommision();
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
		
		$smarty->display('admin_item_commision_listing.tpl');
?>