<?php
include ('include/common.inc');
include ('class/class.user.inc');
include ('class/class.item.inc');
include ("class/class.package.inc");
include ("class/class.category.inc");
include ("include/authentiateUserLogin.php");
//include ('include/Pagination.Class.php'); // For pagination


//assign static labels and heading



 $delete_item_value_id = $_REQUEST['delete_item_value'];// start here for delete code

 $objUser           = new Class_User();
 $objItem           = new Class_Item();
 $objPackage        = new Class_Package();
//create object of Category class
 $objPackage->seller_id = $_SESSION['session_user_id'];
 $objResCatTotal = $objPackage->getPackagedetails();
//$num_rows       = mysql_num_rows($objResCatTotal);
//if($num_rows>0)
//{
  //while($CateRow = mysql_fetch_array($objResCatTotal))
  // {
     //$slabList[] = $CateRow;
   //}
//}


#>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  Code for pagination START   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<#
//3 = hold 1= active
  $pagination = new Pagination();


	if(!isset($_GET['pageNumber']))
	{
	  $pageNumber = 1;
	}
	else
	{
	  $pageNumber= $_GET['pageNumber'];
	}

	$num_rows_items     = mysql_num_rows($objResCatTotal);
	//number of records per page LIMIT
	if(isset($_GET['limit']) && is_numeric($_GET['limit']))
	{
	$to = trim($_GET['limit']);
	}
	else
	{
	$to = ADMIN_PAGE_NUMBER;
	}
	$from=($pageNumber-1)*$to;
	$showPrevNext = true;
//$url = "admin_category.php?start_date=$start_date&end_date=$end_date&business=$business";
	$url = basename($_SERVER['PHP_SELF'])."?serch_item_value=".$_REQUEST['serch_item_value'];
	if($pageNumber==1 || $pageNumber=='')
	{
		$counter=1;
	}
	else
	{
		$counter = $pageNumber+$from-($pageNumber-1);
	}
	//echo '$counter'.$counter;
	$pageLimit =" LIMIT $from,$to";
// echo 'url=-'.$url;
	$pageLink = $pagination->getPageLinks($num_rows_items, $to, $url, $pageNumber,"1&order_by=$order_by_asc_desc", $showPrevNext);
	// Assigning Pagination Links
	$smarty->assign('pageLink',$pageLink);
	#>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  Code for pagination END   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<#


	$objPackage->pageLimit = $pageLimit;
	$objPackage->seller_id = $_SESSION['session_user_id'];
        $objResCatTotal = $objPackage->getPackagedetails();
        $num_rows       = mysql_num_rows($objResCatTotal);
        if($num_rows>0)
        {
        while($CateRow = mysql_fetch_array($objResCatTotal))
         {
        $slabList[] = $CateRow;
         }
        }
        $smarty->assign("num_rows",$num_rows);
        $smarty->assign("slabList",$slabList);

	//echo $num_rows_items1;

	$page_counter = $pagination->getPageCounter($num_rows);

	//if(isset($this->pageLimit) && $this->pageLimit!="")
	//		$sSQL .= $this->pageLimit;
	$smarty->assign('page_counter',$page_counter);
	


        
        $smarty->assign("ListItem",'listItem_');
        $smarty->assign("title_asc",'title_asc');
        $smarty->assign("error_msg",$error_msg);
        $smarty->assign("update_msg",$update_msg);

        //display template
        $smarty->assign('site_page_title','Nethaat : Purchased History');
 
        $smarty->assign('site_title',$site_title);
        $smarty->display('package_history.tpl');
?>
