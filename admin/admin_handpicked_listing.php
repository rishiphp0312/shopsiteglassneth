<?php
include ("common_includes.php");
include ("../include/adminsession.php.inc");
include ("../class/class.item.inc");
include ("../class/class.user.inc");
include ('../include/country_state_cat.php');
include ("../class/class.category.inc");

//assign static labels and heading
$smarty->assign("form_heading","Manage Featured Products");

//create object of Item class
$objItem	= new Class_Item();
$objItem_delete	= new Class_Item();
$objUser        = new Class_User();
$objCategory    = new Class_Category();
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




			

			$val_maonth_add    =  1;
			
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
                      //	$objItem->category_id	 =	trim($_REQUEST['category_id'],'');


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

                        $objItem->default_value=1;

                        

                        if(isset($_REQUEST['Username']))
                        {
                        $objUser->username	=	trim($_REQUEST['Username'],'');
                        $smarty->assign("Username",$_REQUEST['Username']);
                        $user_object    = $objUser->getUserLoginDetails();
                        $num_object     = mysql_num_rows($user_object);
                        if($num_object >0)
                        $reslt_fetch    = mysql_fetch_assoc($user_object);
                        $sellers_id     = $reslt_fetch['id'];
                        //exit;
						                        //print_r($reslt_fetch);
                                //exit;

                        }
                        for($i=1;$i<=12;$i++)
						{
		       			 $month_12[]              = date('m'+$i);
						}
						
                        if($_REQUEST['sel_year']!='')
						$smarty->assign("sel_year",$_REQUEST['sel_year']);
						else
						$smarty->assign("sel_year",date('Y'));
						
						if($_REQUEST['sel_year']!='')
						$sel_year  = $_REQUEST['sel_year'];
						else
						$sel_year  = date('Y');
						
						
						if($_REQUEST['msel_year'] )
						$smarty->assign("msel_year",$_REQUEST['msel_year']);
						else
						$smarty->assign("msel_year",date('Y'));
						
						if($_REQUEST['msel_year'] )
						$msel_year = $_REQUEST['msel_year'];
						else
						$msel_year = date('Y');
						
						
						

                        //if($_REQUEST['sel_year']!='' && $_REQUEST['sel_month']!='')
                       // $objItem->purchased_date =1;


                        if($_REQUEST['sel_days']!='' && $_REQUEST['sel_days']!=0)
						{
                        $sel_days  = $_REQUEST['sel_days'];
                        $objItem->sel_days = $sel_days;
                        $smarty->assign("sel_days",$sel_days);
                        }
						
						 if($_REQUEST['msel_days']!='' && $_REQUEST['msel_days']!=0)
						{
                        $msel_days  = $_REQUEST['msel_days'];
                        $objItem->msel_days = $msel_days;
                        $smarty->assign("msel_days",$msel_days);
                        }

                        if($_REQUEST['sel_year']!='')
		        		$objItem->sel_year = $_REQUEST['sel_year'];
                        else
                        $objItem->sel_year = date('Y');
						$smarty->assign("sel_year",$_REQUEST['sel_year']);
						
						
						if($_REQUEST['msel_year']!='')
		        		$objItem->msel_year = $_REQUEST['msel_year'];
                        else
                        $objItem->msel_year = date('Y');
						$smarty->assign("msel_year",$_REQUEST['msel_year']);
						

                        if($_REQUEST['sel_month']!='' && $_REQUEST['sel_month']!=0)
						$objItem->sel_month = $_REQUEST['sel_month'];
						
						if($_REQUEST['msel_month']!='' && $_REQUEST['msel_month']!=0)
						$objItem->msel_month = $_REQUEST['msel_month'];
			//else
			//$objItem->sel_month = date('m');



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

						if($_REQUEST['sel_month'] )
						$smarty->assign("sel_month",$_REQUEST['sel_month']);
						
						if($_REQUEST['msel_month'] )
						$smarty->assign("msel_month",$_REQUEST['msel_month']);
						
			
						$smarty->assign("no_of_days_curentmonth",$arr_date_days);
						$smarty->assign("current_month",date('m')+1);
						$smarty->assign("month_12",$month_12);
						$smarty->assign("year_12",$year_12);
						$smarty->assign("FirstName",trim($_REQUEST['FirstName']));
						$smarty->assign("LastName",trim($_REQUEST['LastName']));
						$smarty->assign("Email",trim($_REQUEST['Email']));
                        $smarty->assign("cost_item",$cost_item);
                        $smarty->assign("sel_days",$sel_days);
						$smarty->assign("msel_days",$msel_days);




						$delete_item_value_id = trim($_REQUEST['delete_item_value']);
						$suspend_item_value_id = trim($_REQUEST['suspend_item_value']);
						$approve_item_value_id = trim($_REQUEST['approve_item_value']);
						$soft_handpicked_item_value_id = trim($_REQUEST['soft_handpicked_item_value']);  
						


//suspend item
if($suspend_item_value_id!='')
{	
	$objItem_delete->item_value = $suspend_item_value_id;
	$objItem_delete->insertUpdateItem1('2');
	success_msg("Item has been suspended successfully!");
	redirect('admin_handpicked_listing.php');
}
//approve item
if($approve_item_value_id!='')
{
	$objItem_delete->item_value = $approve_item_value_id;
	$objItem_delete->insertUpdateItem1('1');
	success_msg("Item has been approved successfully!");
	redirect('admin_handpicked_listing.php');
}

//delete item
if($delete_item_value_id!='')
{
	$objItem_delete->update_item_id = $delete_item_value_id;
    $image_details_item1            = $objItem_delete->getItemImageDetails();
	$num_rows_items1                = mysql_num_rows($image_details_item1);
	
	if($num_rows_items1>0)
	{
		$arr_items_array = mysql_fetch_assoc($image_details_item1);
		if($arr_items_array['image1']!='')
		{
			$remove_image1   = $arr_items_array['image1'];
			@unlink('uploads/thumbs/'.$remove_image1);
			@unlink('uploads/'.$remove_image1);
		}
		if($arr_items_array['image2']!='')
		{
			$remove_image2   = $arr_items_array['image2'];
			@unlink('uploads/thumbs/'.$remove_image2);
			@unlink('uploads/'.$remove_image2);
		}

		if($arr_items_array['image3']!='')
		{
			$remove_image3   = $arr_items_array['image3'];
			@unlink('uploads/thumbs/'.$remove_image3);
			@unlink('uploads/'.$remove_image3);
		}

		if($arr_items_array['image4']!='')
		{
			$remove_image4   = $arr_items_array['image4'];
			@unlink('uploads/thumbs/'.$remove_image4);
			@unlink('uploads/'.$remove_image4);
		}

		if($arr_items_array['image5']!='')
		{
			$remove_image5   = $arr_items_array['image5'];
			@unlink('uploads/thumbs/'.$remove_image5);
			@unlink('uploads/'.$remove_image5);
		}
	}
	$objItem_delete->del_item_id = $delete_item_value_id;
	$removeItem                  = $objItem_delete->deleteItems();
		
	if($removeItem->nErrorCode==0)
	{
		success_msg("Item has been deleted successfully!");
	}
	else
	{
		failure_msg("Error occured while deleting selected item. Please try again later.");
	}
	redirect('admin_handpicked_listing.php');
}



///////--code for searching starts 
//print_r($_POST);
//exit;



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
//if(isset($this->hand_pickstatus)&&$this->hand_pickstatus!='' 
$objItem->hand_pickstatus =1;
$objResCatTotal = $objItem->getItemImageDetails_foradmin();
$total_records  = mysql_num_rows($objResCatTotal);

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
	$to	= ADMIN_PAGE_NUMBER;
}
$from			= ($pageNumber-1)*$to;
$showPrevNext	        = true;

$url = basename($_SERVER['PHP_SELF'])."?";
$url=$url."Username=".$_REQUEST['Username']."&cost_item=".$_REQUEST['cost_item']."&title=".$_REQUEST['title']."&status=".$_REQUEST['status']."&inventory_alert=".$_REQUEST['inventory_alert']."&country_value=".$_REQUEST['country_value']."parentNAME=".$_REQUEST['parentNAME']."&category_id=".$_REQUEST['category_id']."&state=".$_REQUEST['state']."&sel_year=".$sel_year."&sel_month=".$_REQUEST['sel_month']."&sel_days=".$_REQUEST['sel_days'];

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

$pageLink = $pagination->getPageLinks($total_records, $to, $url, $pageNumber, '', $showPrevNext);
// Assigning Pagination Links
$smarty->assign('pageLink',$pageLink);         
#>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  End Code for END   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<#

//assign page limit
//msel_year
// remove item from handpicked list Hand picked item
if($soft_handpicked_item_value_id!='')
{
//    exit;
	
	$objItem_delete->item_value = $soft_handpicked_item_value_id;
    $objItem_delete->hand_state = 0;
	$objItem_delete->insertUpdateItem_hand('0');
	
	success_msg("Item has been deleted from handpicked Items !");
	//redirect('admin_products_listing.php');
	//$url = basename($_SERVER['PHP_SELF'])."?";
$url="Username=".$_REQUEST['Username']."&cost_item=".$_REQUEST['cost_item']."&title=".$_REQUEST['title']."&status=".$_REQUEST['status']."&inventory_alert=".$_REQUEST['inventory_alert']."&country_value=".$_REQUEST['country_value']."parentNAME=".$_REQUEST['parentNAME']."&category_id=".$_REQUEST['category_id']."&state=".$_REQUEST['state']."&sel_year=".$sel_year."&sel_month=".$_REQUEST['sel_month']."&sel_days=".$_REQUEST['sel_days'];

    redirect("admin_handpicked_listing.php?$url");

    
}
 $pass_url_infun="Username=".$_REQUEST['Username']."&cost_item=".$_REQUEST['cost_item']."&title=".$_REQUEST['title']."&status=".$_REQUEST['status']."&inventory_alert=".$_REQUEST['inventory_alert']."&country_value=".$_REQUEST['country_value']."parentNAME=".$_REQUEST['parentNAME']."&category_id=".$_REQUEST['category_id']."&state=".$_REQUEST['state']."&sel_year=".$sel_year."&sel_month=".$_REQUEST['sel_month']."&sel_days=".$_REQUEST['sel_days'];

$smarty->assign('pass_url_infun',$pass_url_infun);

//$url


$productList = array();
$objItem->hand_pickstatus=1;
$objItem->recent_status   =303;
$objResItem   = $objItem->getItemImageDetails_foradmin();
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
$smarty->display('admin_handpicked_listing.tpl');	
?>