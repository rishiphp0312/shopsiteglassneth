<?php
include ('include/common.inc');
include ('class/class.user.inc');
include ('class/class.item.inc');
include ("include/authentiateUserLogin.php");
include ('class/class.mail.inc');
include ('include/sendEmailClass.php');

//include ('include/Pagination.Class.php'); // For pagination

 
//create user class object
	  $objUser = new Class_User();
          $objItem = new Class_Item();
	  $obj_item = new Class_Item();
	  	// sellers info starts
	  $objUser->id              = $_SESSION['session_user_id'];
	  $result_user              = $objUser->selectUser();
	  $num_user                 =  mysql_num_rows($result_user);
		if($num_user>0)
		{
		$arr_fetch_asoc_user_info = mysql_fetch_assoc($result_user);
		$seller_email_id          = $arr_fetch_asoc_user_info['email'];         // store image
		$seller_name              = $arr_fetch_asoc_user_info['first_name'].''.$arr_fetch_asoc_user_info['last_name']; 
		
	        }
	  
	  
	  $item_value_id              = $_REQUEST['item_id_value'];
	  $obj_item->item_id          = $item_value_id;	  
	  $Bid_accepted_item          = $obj_item->checkHaatedItem_accepted();
	  $num_rows_accepted_item     = mysql_num_rows($Bid_accepted_item);
	  
      //update bid status of below haated id 
      $approv_this_item_id        = $_REQUEST['approv_this_item_id'];
      if($approv_this_item_id!='')
	  {
	  $obj_item->hat_id               = $approv_this_item_id;
	  $Bid_accepted_item_det          = $obj_item->BIDEXSISTS_ITEM();
	  $num_rows_accepted_item_det     = mysql_num_rows($Bid_accepted_item_det);
	  if($num_rows_accepted_item_det>0)
	  {
	  $arr_accepted_item_det          = mysql_fetch_assoc($Bid_accepted_item_det);
	  $buyer_id                       = $arr_accepted_item_det['user_id'];
	  $bid_value                      = $arr_accepted_item_det['cost_posted'];
	  $item_id                        = $arr_accepted_item_det['item_id'];
	      
	  }
	  	  // //buyer info starts
	        $objUser->id              = $buyer_id;
		$result_user_buyer        = $objUser->selectUser();
		$num_user_buyer           = mysql_num_rows($result_user_buyer);
		if($num_user_buyer>0)
		{
		$arr_user_buyerinfo = mysql_fetch_assoc($result_user_buyer);
		$buyer_name         = $arr_user_buyerinfo['first_name'].''.$arr_user_buyerinfo['last_name'];
		$buyer_email        = $arr_user_buyerinfo['email'];
		
		
	        }

	
	      $objItem->update_item_id      =  $item_id;
	      $image_details_item           =  $objItem->getItemImageDetails();
      	      $num_rows_items               =  mysql_num_rows($image_details_item);
              if($num_rows_items>0)
		   {
		   $arr_items_array = mysql_fetch_array($image_details_item);
		   $item_mail_title = ucfirst($arr_items_array['title']);
    	           }
		
	  	
	   //email notification on last bid posted by buyer send to seller
	    $objMail 	                              =  new Class_Mail();
	    $objMail->mail_title	              =  "Email Template";
            $MailTemplate			      =  $objMail->selectMailTemplate();
            $templateRowArr 		              =  mysql_fetch_array($MailTemplate);
            $mail_content			      =  $templateRowArr['mail_content'];
            $mail_content			      =  str_replace("#link#",$baseUrl,$mail_content);
	
            $objMail->mail_title	              =  "Haating_accepted";
            $MailTemplate			      =  $objMail->selectMailTemplate();
            $templateRowArr 		              =  mysql_fetch_array($MailTemplate);
            $mail_content1			      =  $templateRowArr['mail_content'];
		
   //$recivers_name                      =  $arr_fetch_users_details['name'] ;
   
	$mail_content		      =  str_replace("#message_content#",$mail_content1,$mail_content);
	$mail_content		      =  str_replace("#link#",$baseUrl,$mail_content);	
	$mail_content                 =  str_replace("#amount#",$bid_value,$mail_content);
	$mail_content	              =  str_replace("#seller_name#",$seller_name,$mail_content);
	$mail_content	              =  str_replace("#buyer_name#",$buyer_name,$mail_content);
	$mail_content		      =  str_replace("#item_title#",$item_mail_title,$mail_content);
    //--http://localhost/nethaat/buyer-haated-items.php--//	
        $link_for_haated ="<a href=".$baseUrl."buyer-haated-items.php>Click here to buy this haated item.</a>";
	$mail_content		=  str_replace("#link_for_haated#",$link_for_haated,$mail_content);
	$subject 	        =  $templateRowArr['mail_subject'];  	
	   
	$subject		    =  str_replace("#item_name#",$item_mail_title,$subject);  
					
	$mailFrom            = 'Nethaat ';
	//$buyer_email     =  'rishi_kapoor@seologistics.com';
	//$buyer_email
	$emailObj 	= new SendEmailClass;
	 $mail_content;
	// $emailObj->SendHtmlMail($seller_email_id,$subject,$mail_content,$mailFrom);
	 $emailObj->SendHtmlMail($buyer_email,$subject,$mail_content,$mailFrom);
	


/// end of email notification

	  //buyer info
	  
	   $obj_item->hat_id           = $approv_this_item_id;
	   $obj_item->bid_status       = 1;
	   $haat_update_item           = $obj_item->insertBID_Hatingitems();
	   if($haat_update_item->nErrorCode==0)
		{
			success_msg("You has approved this bid successfully!");
		}//end of if
		else
		{
			failure_msg("Error occured while approving the bid");
		}
		redirect('my_account.php');
	  }

	  $item_value_id              = $_REQUEST['item_id_value'];
	  $obj_item->item_id          = $item_value_id;
	  $Bid_details_item           = $obj_item->HaatedItem_BIDDetails();
	  $num_rows_items1            = mysql_num_rows($Bid_details_item);
          
    $pagination = new Pagination();

    if(!isset($_GET['pageNumber']))
    {
            $pageNumber = 1;
    }
    else
    {
            $pageNumber= $_GET['pageNumber'];
    }
    //$num_rows_items     = mysql_num_rows($num_rows_items1);
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
    //$url = "admin_category.php?start_date=$start_date&end_date=$end_date&business=$business";
    $url = basename($_SERVER['PHP_SELF'])."?item_id_value=".$_REQUEST['item_id_value'];
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
    $pageLink = $pagination->getPageLinks($num_rows_items1, $to, $url, $pageNumber,"1&order_by=$order_by_asc_desc", $showPrevNext);
    // Assigning Pagination Links
    $obj_item->pageLimit = $pageLimit;
    $smarty->assign('pageLink',$pageLink);
          $item_value_id              = $_REQUEST['item_id_value'];
	  $obj_item->item_id          = $item_value_id;
	  $Bid_details_item           = $obj_item->HaatedItem_BIDDetails();
	  $num_rows_items_counter1    = mysql_num_rows($Bid_details_item);
    if($num_rows_items_counter1>0)
	     {
	     while($arr_items_array = mysql_fetch_array($Bid_details_item))
		       	{

			 $item_values_list[]=   $arr_items_array;

				 }

	      }

	 $objItem->update_item_id      =  $item_value_id;
	 $image_details_item           =  $objItem->getItemImageDetails();
         $num_rows_items               =  mysql_num_rows($image_details_item);

		if($num_rows_items>0)
		{
	        $arr_items_array = mysql_fetch_array($image_details_item);

		}

         $smarty->assign("items_details1",ucfirst($arr_items_array['title']));

         $smarty->assign("num_rows_accepted_item",$num_rows_accepted_item);
         $smarty->assign("users_items_details", $item_values_list);


    $page_counter = $pagination->getPageCounter($num_rows_items_counter1);

//if(isset($this->pageLimit) && $this->pageLimit!="")
//		$sSQL .= $this->pageLimit;
$smarty->assign('page_counter',$page_counter);

    #>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  Code for pagination END   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<#


//paging starts
 #>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  Code for pagination START   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<#
/*

$num_rows_items     = mysql_num_rows($image_details_item);
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
//$url = "admin_category.php?start_date=$start_date&end_date=$end_date&business=$business";
$url = basename($_SERVER['PHP_SELF'])."?";
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


$objItem->pageLimit = $pageLimit;
$obj_item->seller_id = $_SESSION['session_user_id'];
*/

//paging ends




	



//assign error/update message
//$title_asc$quantity_available_desc
$smarty->assign("error_msg",$error_msg);
$smarty->assign("update_msg",$update_msg);

//display template
$smarty->assign('site_page_title','My Bid Value List');
$smarty->assign('site_title',$site_title);
$smarty->display('view_bids.tpl');
?>
