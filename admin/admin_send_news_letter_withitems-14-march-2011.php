<?php
include ("common_includes.php");
include ('../class/class.news_letter.inc');
include ("../class/class.item.inc");
include ("../class/class.user.inc");
include ('../include/country_state_cat.php');
include ("../class/class.category.inc");

//create mail class object
$objMail 	= new Class_Mail();

$objUser        = new Class_User();
$objItem	    = new Class_Item();
$objCategory    = new Class_Category();

// Creating object of SendEmailClass
$emailObj 	= new SendEmailClass;

//create object of Class_NewsLetter class
$objNewsLetter = new Class_NewsLetter();

//selects users list to send email
$usersList = array();
$objNewsLetter->status = 1;//select oncy active
$objResUsers   = $objNewsLetter->selectNewsLetter();
while($UserRow = mysql_fetch_array($objResUsers))
{
	$userList[]	= $UserRow;
}
$smarty->assign('userList',$userList);

//get monthly news letter email template
$objMail->mail_title	= "Email Template"; 
$MailRes 				= $objMail->selectMailTemplate();
$mailRowArr 			= mysql_fetch_array($MailRes);
$mail_subject 			= $mailRowArr['mail_subject'];  
$mail_content			= $mailRowArr['mail_content'];
$mail_content           = str_replace("#link#",$baseUrl,$mail_content);
//echo $mail_content;die;

//get monthly news Letter Content
$objMail->mail_title	= "News_Letterwith_items"; 
$MailRes2 				= $objMail->selectMailTemplate();
$mailRowArr2 			= mysql_fetch_array($MailRes2);
$mail_subject2 			= $mailRowArr2['mail_subject'];  
  $mail_content2			= $mailRowArr2['mail_content'];
$smarty->assign('mail_subject2',$mail_subject2);


if($_SERVER['REQUEST_METHOD']=="POST")
{

	//post variables
	extract($_POST);
	//ini_set('SMTP','mail.seologistics.com');
   // ini_set('smtp_port','25');
   // ini_set('sendmail_from','arun_chauhan@seologistics.com');
	
	$subject		= rteSafe($subject);
	$message		= rteSafe($message);
	
	//collect all email address's
	$emailTo = "";
	$chkbox_prd_ids = $_POST['chkbox_prd_ids'];
	//print_r($_POST['chkbox_prd_ids']);
	//exit;
	if(count($chkbox_prd_ids)>0)
	{
	for($i=0;$i<count($chkbox_prd_ids);$i++)
	{
	  $item_ids               = $chkbox_prd_ids[$i];	
	  $objItem->update_item_id            = $item_ids;	
	  $objResCatTotal         = $objItem->getItemImageDetails();
	  $num_rows_images        = mysql_num_rows($objResCatTotal);
	  if($num_rows_images>0)
	  {
	   while($arr_rows_images = mysql_fetch_assoc($objResCatTotal))
		  {
	     $arremail_rows_title[] = $arr_rows_images['title'];
	     $arremail_rows_images[] = $arr_rows_images['image1'];
		 $arremail_rows_ids[] = $arr_rows_images['item_id'];
		   }
	  
	  }
	
	}
	
     /* if(count($chkbox_prd_ids)%5==0 )
	  $x_xols = 5;
	  else
	  $x_xols = count($chkbox_prd_ids)%5;*/
	  
	  $tbl_msg =" <table width='800' cellpadding='2' bgcolor='#cccccc' cellspacing='1' border='0'>";
	  $tbl_msg .="<tr><td>";
	
      $tbl_msg =" <table width='790' cellpadding='2' cellspacing='2' bgcolor='#cccccc' border='0'>";
 	  $cnt=1;
	
	for($i=0;$i<4;$i++)
	{  
	  $objItem->item_id= $arremail_rows_ids[$k];
	  $objResCatTotal = $objItem->getbuyitem();
	  $total_records = mysql_num_rows($objResCatTotal);
	  if($total_records>0)
	  {
	  $sold_title= ' Sold ';
	  }
	  $tbl_msg .="<tr bgcolor='#ffffff'>";
	  for($k=5*$i;$k<(5+(5*$i));$k++)
	   {
	    //$fil_exit=!file_exists($baseUrl."uploads/".$arremail_rows_images[$k]);
	    if($arremail_rows_title[$k]!='')
		{
			if($arremail_rows_images[$k]!=''   )
			{
			$path = $baseUrl."getthumb.php?w=150&h=100&fromfile=uploads/".$arremail_rows_images[$k];		}
			else
			{
			$path = $baseUrl."images/item_small_img.jpg";
			}
			
		}
		else
		{
		    $pathstr= "&nbsp;";
		
		}
	
	   $pathstr= "<img src=".$path." >";
	   	   //  $cnt =$k*$i;  	  
	   $tbl_msg .="<td align='center' valign='top'>".$pathstr."</td>";
	   }
	  $anther_path = $baseUrl."item-details.php?details_item_value=";
	  $tbl_msg .="</tr>";
	  $tbl_msg .="<tr bgcolor='#ffffff'>";
	  for($k=5*$i;$k<(5+(5*$i));$k++)
	    {
	   $tbl_msg .="<td align='center' valign='top'><a href='".$anther_path.$arremail_rows_ids[$k]."'>".$arremail_rows_title[$k]."</a></td>";
	    }
	  $tbl_msg .="</tr>";
	
	  
	  }
	  
	
	   //else
	 
	  
     $tbl_msg .="</table>";
	 $tbl_msg .="</td></tr>";
	 $tbl_msg .="</table>";

	 }

	 $objUser->user_status     = 1;
	 //newsletter_status
     $objUser->subscribed_user = 1;
	 $objUser->isdeleted       = 0;
	 $result_user              = $objUser->selectUser();
	 $num_reslt_user           = mysql_num_rows($result_user);
	 if($num_reslt_user>0)
	  {
	   while($arr_reslt_array  = mysql_fetch_assoc($result_user))
		   {
	  $arremail_values_array[] = $arr_reslt_array['email'];
		    }
		}
	if(count($arremail_values_array)>0)
	{
	$imp_chkbox_prd_emailids  = implode(",",$arremail_values_array);
	$emailTo                  = $imp_chkbox_prd_emailids;
    }
	
	if(count($arremail_values_array)>0)
	{
		//update email template
		$objMail->mail_id      = 8;
		$objMail->mail_subject = $subject;
		$objMail->mail_content = $message;
	//	$mail_subject2         = $subject;
		
	
		//$objDBReturn	= $objMail->insertUpdateMailTemplate(); 
		  //$emailTo = 'rishi_kapoor@seologistics.com,santosh_ojha@seologistics.com';
	
		  if($objDBReturn->nErrorCode==0)
		  {
			//send contact us email
		  //  $mail_content = str_replace("#message_content#",$mail_content2,$mail_content);
		  

		  
		//  $message.="<p>Hi All,<br />We are glad to inform you that we are  sending news letters.<br />            &nbsp;</p>";
		  
		  $mail_content= str_replace("#message_content#",$message,$mail_content);
	      $mail_content = str_replace("#tbl_msg#",$tbl_msg,$mail_content);

		
		 // echo $mail_content;
		//  die;
		  // $mail_content= str_replace("#message_content#",$message,$mail_content);
		 
		  #tbl_msg
		
          
		   $emailStatus = $emailObj->SendHtmlMail($emailTo,$subject,$mail_content,$mailFrom);
		  
			if($emailStatus)
			{ 
			unset($arremail_rows_title);
			unset($arremail_rows_images);
			unset($arremail_rows_ids);
		
				//redirect user
				success_msg("News letter with items has been sent successfully!");
			}
			else
			{
				failure_msg("Error occured while sending email from this server. Please try again!");
			}
			redirect("admin_send_news_letter_withitems.php");
		}
	}//end of if($emailTo!="")
	else 
	{
		$error_msg = "Please select at least one contact email to send news letter.";
		$smarty->assign("mail_subject2",$subject);
	}
}
//$pageLimit=20;
$objItem->inventory_check  = 1;

$objItem->status           = 1;
//$objItem->hat_max_value    = 1;
//$objItem->recent_status   =303;
$objItem->request_item_id  = 0; // request items should not be displayed
//$objItem->hatting_status   = 0;
//$objItem->approve_store    = 1;
$objItem->delete_by_seller = 0; //0 not deleted by seller 1 means delete by seller
$objItem->locker_status    = 0;
$objItem->delete_restored  = 0; //0 for showing restored 1 means deleted by admin
$objItem->package_expired  = 0; //0 for showing active packg 1 means expired packge
$objResCatTotal_feature   = $objItem->getItemImageDetails();
$total_records_feature    = mysql_num_rows($objResCatTotal_feature);
$smarty->assign('total_records_feature',$total_records_feature);
// end implementation restrication to not to make more than 12 items featured//


$objResCatTotal = $objItem->getItemImageDetails();
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
{   $to	=	20;
	//$to	=	ADMIN_PAGE_NUMBER;
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

//$url=$url."Username=".$_REQUEST['Username']."&cost_item=".$_REQUEST['cost_item']."&title=".$_REQUEST['title']."&status=".$_REQUEST['status']."&inventory_alert=".$_REQUEST['inventory_alert']."&country_value=".$_REQUEST['country_value']."parentNAME=".$_REQUEST['parentNAME']."&category_id=".$_REQUEST['category_id']."&state=".$_REQUEST['state']."&sel_year=".$_REQUEST['sel_year']."&sel_month=".$_REQUEST['sel_month']."&sel_days=".$_REQUEST['sel_days'];
$pageLink = $pagination->getPageLinks($total_records, $to, $url, $pageNumber,'', $showPrevNext);
// Assigning Pagination Links
$smarty->assign('pageLink',$pageLink);         
#>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  End Code for END   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<#

//assign page limit
//$objUser->pageLimit = $pageLimit;
$objUser->pageLimit = $pageLimit;

$productList = array();

$objResItem = $objItem->getItemImageDetails();
$page_counter = $pagination->getPageCounter(mysql_num_rows($objResItem));
$smarty->assign('page_counter',$page_counter);

while($Row = mysql_fetch_array($objResItem))
{
	$productList[]	= $Row;
}
$smarty->assign('productList',$productList);

//assign error message
$smarty->assign("error_msg",$error_msg);


//display template and title
$smarty->assign('site_page_title',ADMIN_PAGE_MGMT);
$smarty->assign('site_title',$site_title);
$smarty->display('admin_send_news_letter_withitems.tpl');	
?>