<?php
include ("common_includes.php");
include ("../include/adminsession.php.inc");
include ("../class/class.item.inc");
include ("../class/class.user.inc");
include ('../include/country_state_cat.php');
include ("../class/class.category.inc");
//assign static labels and heading
$smarty->assign("form_heading","Manage Products");

//create object of Item class
$objItem	    = new Class_Item();
$objItem_delete	= new Class_Item();
$objUser        = new Class_User();
$objCategory    = new Class_Category();
$objItem->recent_status   =303;
$smarty->assign('array_for_id', array(1,2,3,4,5,6,7,8,9,10,11,12));
$smarty->assign('array_for_month', array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'));

 if(isset($_REQUEST['country_value']) && $_REQUEST['country_value']!=0 && $_REQUEST['country_value']!='')
             {
             $objItem->country_value = trim($_REQUEST['country_value']);
             }
                      //  state
            $smarty->assign("selectcountry",trim($_REQUEST['country_value']));
	        if(isset($_REQUEST['state']) && trim($_REQUEST['state'])!="")
            {
             $objItem->state	      = trim($_REQUEST['state']);
            }
                     //  state
            $smarty->assign("state",trim($_REQUEST['state']));
            if(isset($_REQUEST['city']) && trim($_REQUEST['city'])!="")
            {
             $objItem->city	     = trim($_REQUEST['city']);
            }
            $smarty->assign("city",trim($_REQUEST['city']));
                    
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
                     // 	$objItem->category_id	 =	trim($_REQUEST['category_id'],'');

	         if(isset($_REQUEST['category_id']) && $_REQUEST['category_id']!=0)
			{
			   $objItem->category_id        = trim($_REQUEST['category_id'],'');
			   $smarty->assign("category_id",$_REQUEST['category_id']);
			}
			 if(isset($_REQUEST['parent_id'])&& $_REQUEST['parent_id']!=0)
			{
			   $objItem->parent_category_id = trim($_REQUEST['parent_id'],'');
			   $smarty->assign("parent_category_id",$_REQUEST['parent_id']);
			}


                       

//echo 'objcat-'.$objItem->category_id	=	trim($_REQUEST['category_id'],'');
	
                     if(isset($_REQUEST['Username']))
                     {
                        $objUser->username	=	trim($_REQUEST['Username'],'');
                        $smarty->assign("Username",$_REQUEST['Username']);
                        $user_object    = $objUser->getUserLoginDetails();
                        $num_object     = mysql_num_rows($user_object);
                        if($num_object >0)
                        $reslt_fetch    = mysql_fetch_assoc($user_object);
                        $sellers_id     = $reslt_fetch['id'];
                     
					     
                      }

                     if($_REQUEST['sel_days']!='' && $_REQUEST['sel_days']!=0)
			          {
                        $sel_days  = $_REQUEST['sel_days'];
                        $sel_month = $_REQUEST['sel_month'];
                        $sel_year  = $_REQUEST['sel_year'];
                        $total_date = $sel_year.'-'.$sel_month.'-'.$sel_days;
                        $objItem->sel_days = $sel_days;
                        }
                        //	else
		                //	$objItem->sel_days = date('m');
                        $objItem->default_value=1;

						if($_REQUEST['sel_month']!=0)
						$objItem->sel_month = $_REQUEST['sel_month'];
						//else
			            //$objItem->sel_month = date('m');

                      //  if($_REQUEST['sel_year']!=0)
						   if($_REQUEST['sel_year']!='')
							$objItem->sel_year  = $_REQUEST['sel_year'];
							else
							$objItem->sel_year  = date('Y');
							if($_REQUEST['sel_year']!='')
							$smarty->assign("sel_year",$_REQUEST['sel_year']);
							else
							$smarty->assign("sel_year",date('Y'));
						    //$smarty->assign("sel_year",$_REQUEST['sel_year']);

						$val_maonth_add    =  1;
						if($_REQUEST['sel_month'])
						$smarty->assign("sel_month",$_REQUEST['sel_month']);
                        //if($_REQUEST['sel_year']!=0 && $_REQUEST['sel_month']!=0)
                        // $objItem->purchased_date =1;
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

						$suspend_item_value_id     = trim($_REQUEST['suspend_item_value']);
						$approve_item_value_id     = trim($_REQUEST['approve_item_value']);
						$handpicked_item_value_id  = trim($_REQUEST['handpicked_item_value']);
	
	
						//Hand picked item
						if($handpicked_item_value_id!='')
						{
			
						$objItem_delete->item_value = $handpicked_item_value_id;
						$objItem_delete->insertUpdateItem_hand('1');
			
						success_msg("Item has been made handpicked successfully!");
						redirect('admin_products_listing.php');
				
				
						}

				
						//suspend item
						if($suspend_item_value_id!='')
						{
						$objItem_delete->item_value = $suspend_item_value_id;
						$objItem_delete->insertUpdateItem1('2');
						success_msg("Item has been suspended successfully!");
						redirect('admin_products_listing.php');
						}
						//approve item
						if($approve_item_value_id!='')
						{
						$objItem_delete->item_value = $approve_item_value_id;
						$objItem_delete->insertUpdateItem1('1');
						success_msg("Item has been approved successfully!");
						redirect('admin_products_listing.php');
						}
						$delete_item_value_id1     = trim($_REQUEST['delete_item_value1']); //delete
						$delete_item_value_id0     = trim($_REQUEST['delete_item_value0']); // restore
				
			
						//delete item 
						if($delete_item_value_id1!='')
						{
							$objItem_delete->item_value       = $delete_item_value_id1;
							$objItem_delete->delete_restored  = 1;
							$objItem_delete->insertUpdateItem();
							if($removeItem->nErrorCode==0)
							{
								success_msg("Item has been deleted successfully!");
							}
							else
							{
								failure_msg("Error occured while deleting selected item. Please try again later.");
							}
							redirect('admin_products_listing.php');
							
						}
			
					//restored item 
					if($delete_item_value_id0!='')
					{
						$objItem_delete->item_value       = $delete_item_value_id0;
						$objItem_delete->delete_restored  = 0;
						$removeItem                       = $objItem_delete->insertUpdateItem();
					
							/*
						$objItem_delete->update_item_id = $delete_item_value_id1;
							$image_details_item1            = $objItem_delete->getItemImageDetails();
						$num_rows_items1                = mysql_num_rows($image_details_item1);
						
						$objItem_delete->del_item_id = $delete_item_value_id;
						$removeItem                  = $objItem_delete->deleteItems();
							*/
						if($removeItem->nErrorCode==0)
						{
							success_msg("Item has been restored successfully!");
						}
						else
						{
							failure_msg("Error occured while restoring selected item. Please try again later.");
						}
						
						success_msg("Item has been restored successfully!");
					
						redirect('admin_products_listing.php');
						
					}
	
	
	
					if($sellers_id!='' && $_REQUEST['Username']!='')
					{
					 $objItem->seller_id	=	$sellers_id ;
					}
					if($sellers_id=='' && $_REQUEST['Username']!='')
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
						//$objItem->status	=	"1";
					$objItem->package_expired	=	"1";
					$smarty->assign("chkActive","checked='checked'");
					}
					else if(isset($_REQUEST['status']) && $_REQUEST['status']=="2")
					{
					$objItem->status	=	"2";
					$smarty->assign("chkInActive","checked='checked'");
					}
					else
					{
						//$objUser->Active	=	"YN";
					$smarty->assign("chkBoth","checked='checked'");
					}
						
					if(isset($_REQUEST['inventory_alert']))
					{
					$objItem->inventory_alert_val	=	trim($_REQUEST['inventory_alert'],'');
					$smarty->assign("inventory_alert",$_REQUEST['inventory_alert']);
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

 //$objItem->getItemImageDetails_withothers()
// start implementation restrication to not to make more than 12 items featured//
$objItem->hand_pickstatus = 1;
$objResCatTotal_feature   = $objItem->getItemImageDetails_foradmin();
$total_records_feature    = mysql_num_rows($objResCatTotal_feature);
$smarty->assign('total_records_feature',$total_records_feature);
// end implementation restriction to not to make more than 12 items featured//

$objItem->hand_pickstatus ='';
$objResCatTotal = $objItem->getItemImageDetails_foradmin();
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

$url = basename($_SERVER['PHP_SELF'])."?";
if($pageNumber==1 || $pageNumber=='')
{
	$counter=1;
}
else
{
	$counter = $pageNumber+$from-($pageNumber-1);
}
$pageLimit =" LIMIT $from,$to ";
$objItem->pageLimit = $pageLimit;

$url=$url."Username=".$_REQUEST['Username']."&cost_item=".$_REQUEST['cost_item']."&title=".$_REQUEST['title']."&status=".$_REQUEST['status']."&inventory_alert=".$_REQUEST['inventory_alert']."&country_value=".$_REQUEST['country_value']."parentNAME=".$_REQUEST['parentNAME']."&category_id=".$_REQUEST['category_id']."&state=".$_REQUEST['state']."&sel_year=".$_REQUEST['sel_year']."&sel_month=".$_REQUEST['sel_month']."&sel_days=".$_REQUEST['sel_days'];
$pageLink = $pagination->getPageLinks($total_records, $to, $url, $pageNumber,'', $showPrevNext);
// Assigning Pagination Links
$smarty->assign('pageLink',$pageLink);         
#>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  End Code for END   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<#

//assign page limit
$objUser->pageLimit = $pageLimit;

$productList = array();

$objResItem = $objItem->getItemImageDetails_foradmin();
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
$smarty->display('admin_products_listing.tpl');	
?>