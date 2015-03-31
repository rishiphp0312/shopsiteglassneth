<?php
include ("common_includes.php");
include ('../class/class.news_letter.inc');
include ("../class/class.item.inc");
include ("../class/class.user.inc");
include ('../include/country_state_cat.php');
include ("../class/class.category.inc");
?>
<style>
.Class_headMail{font-family:Verdana, Arial, Helvetica, sans-serif;font-size:18px;font-weight:bold;color:#80D6FF;text-align:left;}
A:link {font-family:Verdana, Arial, Helvetica, sans-serif;font-size:12px;font-weight:400;color:#814141;text-decoration: none}
A:visited {font-family:Verdana, Arial, Helvetica, sans-serif;font-size:12px;font-weight:400;color:#814141;text-decoration: none}
A:active {font-family:Verdana, Arial, Helvetica, sans-serif;font-size:12px;font-weight:400;color:#814141;text-decoration: none}
</style>
<?

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

//get parent categories to create drop down
$parentID = array(0=>0);
$parentNAME = array(0=>'Top Level');
$parentRes = $objCategory->selectParentCatgeory();
while($parentRow = mysql_fetch_array($parentRes))
{
	$parentID[] = $parentRow['category_id'];
	$parentNAME[] = $parentRow['name'];
}
//print_r($parentNAME);
$smarty->assign("parentID",$parentID);
$smarty->assign("parentNAME",$parentNAME);
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
    //ini_set('smtp_port','25');
    //ini_set('sendmail_from','arun_chauhan@seologistics.com');
	
	$subject		= rteSafe($subject);
	$message		= rteSafe($message);
	$heading2       = $_POST['heading2'];
	$heading1       = $_POST['heading1'];
	
	$heading3       = $_POST['heading3'];
	
	//{$heading}
	//collect all email address's
	$emailTo = "";
	$product_1 = $_POST['product_1'];
	
	if(count($product_1)>0)
	{
	for($i=0;$i<count($product_1);$i++)
	{
	  $item_ids               = $product_1[$i];	
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
	
	}}
	
	$product_2 = $_POST['product_2'];


	if(count($product_2)>0)
	{
	for($i=0;$i<count($product_2);$i++)
	{
	  $item_ids                = $product_2[$i];	
	  $objItem->update_item_id = $item_ids;	
	  $objResCatTotal          = $objItem->getItemImageDetails();
	  $num_rows_images         = mysql_num_rows($objResCatTotal);
	  if($num_rows_images>0)
	  {
	   while($arr_rows_images  = mysql_fetch_assoc($objResCatTotal))
		  {
	     $arremail_rows_title2[]  = $arr_rows_images['title'];
	     $arremail_rows_images2[] = $arr_rows_images['image1'];
		 $arremail_rows_ids2[]    = $arr_rows_images['item_id'];
		   }
	  
	  }
	
	}}
	
			$product_3 = $_POST['product_3'];
/*				echo '<pre>';
				print_r($arremail_rows_ids);
				echo '</pre>';
				echo '<pre>';
				print_r($arremail_rows_ids2);
	echo '</pre>';
	exit;*/
	
	//exit;
	if(count($product_3)>0)
	{
	for($i=0;$i<count($product_3);$i++)
	{
	  $item_ids                = $product_3[$i];	
	  $objItem->update_item_id = $item_ids;	
	  $objResCatTotal          = $objItem->getItemImageDetails();
	  $num_rows_images         = mysql_num_rows($objResCatTotal);
	  if($num_rows_images>0)
	  {
	   while($arr_rows_images = mysql_fetch_assoc($objResCatTotal))
		  {
	     $arremail_rows_title3[]  = $arr_rows_images['title'];
	     $arremail_rows_images3[] = $arr_rows_images['image1'];
		 $arremail_rows_ids3[]    = $arr_rows_images['item_id'];
		   }
	  
	  }
	
	}}
	
     /* 
	 if(count($chkbox_prd_ids)%5==0 )
	  $x_xols = 5;
	  else
	  $x_xols = count($chkbox_prd_ids)%5;
	  */
	  
///
$tbl_msg= "<table align='center'  cellpadding='2' width='100%' bgcolor='#cccccc' cellspacing='0' border='0' >";
	if(count($product_1)>0)
$tbl_msg .="<tr><td bgcolor='#ffffff' style='font-family:Verdana, Arial, Helvetica, sans-serif;font-size:18px;font-weight:bold;color:#80D6FF;text-align:left;' >".$heading1."</td></tr>";

$tbl_msg .="<tr>
<td><table align='center' cellpadding='0' cellspacing='2' width='99%' border='0' bgcolor='#cccccc'  >";

$tbl_msg .="<tr bgcolor='#ffffff' >";
for($k=0;$k<count($product_1);$k++)
{
 if($arremail_rows_title[$k]!='')
		{
			if($arremail_rows_images[$k]!=''   )
			{
		$path = $baseUrl."getthumb.php?w=150&h=100&fromfile=uploads/".$arremail_rows_images[$k];		            }
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
	   $anther_path = $baseUrl."item-details.php?details_item_value=";
	    

        $count_val=$k+1;
		$colspan_value= 6-($count_val%5);
		if($count_val == count($product_1))
		$colspan=" colspan = $colspan_value";
		else
		$colspan=" ";
		
		$newtext = wordwrap($arremail_rows_title[$k],20, "<br />\n");
		

$tbl_msg .="<td  ".$colspan.">
<table align='center' border='0' cellpadding='3' cellspacing='0'>
<tr><td valign='top' align='center' >".$pathstr."</td></tr>
<tr><td valign='top' align='center' style='font-family:Verdana, Arial, Helvetica, sans-serif;font-size:12px;font-weight:400;color:#814141;text-decoration: none;' ><a style='font-family:Verdana, Arial, Helvetica, sans-serif;font-size:12px;font-weight:400;color:#814141;text-decoration: none;' href='".$anther_path.$arremail_rows_ids[$k]."'>".$newtext."</a></td></tr>
</table>
</td>";

if($count_val%5==0)
{
$tbl_msg .="</tr><tr bgcolor='#ffffff'>";
}
if($count_val == count($product_1))
{

$tbl_msg .="</tr>";

}




}
$tbl_msg .="</table>";
$tbl_msg .="</td></tr>";

if(count($product_2)>0)
{
if(count($product_1)>0)
$tbl_msg .="<tr ><td valign='top'bgcolor='#ffffff'  align='left'>&nbsp;</td></tr>";
$tbl_msg .="<tr><td valign='top' bgcolor='#ffffff' style='font-family:Verdana, Arial, Helvetica, sans-serif;font-size:18px;font-weight:bold;color:#80D6FF;text-align:left;'  align='left'>".$heading2."</td></tr>";
}
$tbl_msg .="<tr bgcolor='#ffffff'><td valign='top' align='left'  ><table bgcolor='#cccccc' align='center' cellpadding='0' cellspacing='2' width='99%' border='0' >";
$tbl_msg .="<tr bgcolor='#ffffff'>";
for($u=0;$u<count($product_2);$u++)
{
$count_valu=$u+1;

 if($arremail_rows_title2[$u]!='')
		{
			if($arremail_rows_images2[$u]!=''   )
			{
$path = $baseUrl."getthumb.php?w=150&h=100&fromfile=uploads/".$arremail_rows_images2[$u];	
	}
			else
			{
$path = $baseUrl."images/item_small_img.jpg";
			}
			
		}
		else
		{
		    $pathstr= "&nbsp;";
		
		}
		
		$colspan_value= 6-($count_valu%5);
		if($count_valu == count($product_2))
		$colspan=" colspan = $colspan_value";
		else
		$colspan=" ";
	
	   $pathstr= "<img src=".$path." >";
	   $anther_path = $baseUrl."item-details.php?details_item_value=";
	   $newtext = wordwrap($arremail_rows_title2[$u],20, "<br />\n");

$tbl_msg .="<td valign='top' align='left' $colspan ><table align='center' border='0' cellpadding='3' cellspacing='0'>
<tr bgcolor='#ffffff'><td valign='top' align='center' >".$pathstr."</td></tr>
<tr bgcolor='#ffffff'><td valign='top' align='center' style='font-family:Verdana, Arial, Helvetica, sans-serif;font-size:12px;font-weight:400;color:#814141;text-decoration: none;' ><a style='font-family:Verdana, Arial, Helvetica, sans-serif;font-size:12px;font-weight:400;color:#814141;text-decoration: none;' href='".$anther_path.$arremail_rows_ids2[$u]."'>".$newtext."</a></td></tr></table></td>";

if($count_valu%5==0)
{
$tbl_msg .="</tr><tr bgcolor='#ffffff'>";
}
if($count_valu == count($product_2))
{

$tbl_msg .="</tr>";

}




}
$tbl_msg .="</table>";
$tbl_msg .="</td></tr>";

/////// third tble code


if(count($product_3)>0)
{
if(count($product_2)>0 && count($product_1)>0)
$tbl_msg .="<tr ><td valign='top'bgcolor='#ffffff'  align='left'>&nbsp;</td></tr>";
$tbl_msg .="<tr><td valign='top' bgcolor='#ffffff'style='font-family:Verdana, Arial, Helvetica, sans-serif;font-size:18px;font-weight:bold;color:#80D6FF;text-align:left;'  align='left'>".$heading3."</td></tr>";
}
$tbl_msg .="<tr bgcolor='#ffffff'><td valign='top' align='left'  ><table bgcolor='#cccccc' align='center' cellpadding='0' cellspacing='2' width='99%' border='0' >";
$tbl_msg .="<tr bgcolor='#ffffff'>";
for($u=0;$u<count($product_3);$u++)
{
$count_valu=$u+1;

 if($arremail_rows_title3[$u]!='')
		{
			if($arremail_rows_images3[$u]!=''   )
			{
$path = $baseUrl."getthumb.php?w=150&h=100&fromfile=uploads/".$arremail_rows_images3[$u];		}
			else
			{
$path = $baseUrl."images/item_small_img.jpg";
			}
			
		}
		else
		{
		    $pathstr= "&nbsp;";
		
		}
		
		$colspan_value= 6-($count_valu%5);
		if($count_valu == count($product_3))
		$colspan=" colspan = $colspan_value";
		else
		$colspan=" ";
	
	   $pathstr= "<img src=".$path." >";
	   $anther_path = $baseUrl."item-details.php?details_item_value=";
	   $newtext = wordwrap($arremail_rows_title3[$u],20, "<br />\n");

$tbl_msg .="<td valign='top' align='left' $colspan ><table align='center' border='0' cellpadding='3' cellspacing='0'>
<tr bgcolor='#ffffff'><td valign='top' align='center' >".$pathstr."</td></tr>
<tr bgcolor='#ffffff'><td valign='top' align='center' style='font-family:Verdana, Arial, Helvetica, sans-serif;font-size:12px;font-weight:400;color:#814141;text-decoration: none;'><a style='font-family:Verdana, Arial, Helvetica, sans-serif;font-size:12px;font-weight:400;color:#814141;text-decoration: none;' href='".$anther_path.$arremail_rows_ids3[$u]."'>".$newtext."</a></td></tr></table></td>";

if($count_valu%5==0)
{
$tbl_msg .="</tr><tr bgcolor='#ffffff'>";
}
if($count_valu == count($product_3))
{
$tbl_msg .="</tr>";
}
}
$tbl_msg .="</table>";
$tbl_msg .="</td></tr>";
$tbl_msg .="</table>";
$tbl_msg;

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
//	$arremail_values_array=1;
	if(count($arremail_values_array)>0)
	{
		//update email template
		$objMail->mail_id      = 8;
		$objMail->mail_subject = $subject;
		$objMail->mail_content = $message;
	//	$mail_subject2         = $subject;
		
	
		//$objDBReturn	= $objMail->insertUpdateMailTemplate(); 
		// $emailTo = 'rishi_kapoor@seologistics.com,santosh_ojha@seologistics.com';
	
		  if($objDBReturn->nErrorCode==0)
		  {
		    $mail_content	  =  str_replace("#message_content#",$mail_content2,$mail_content);
		 // $mail_content = str_replace("#message_content#",$message,$mail_content);
		  //  echo $mail_content;		 
	      $mail_content = str_replace("#tbl_msg#",$tbl_msg,$mail_content);
		   // $mail_content= str_replace("#heading2#",$heading2,$mail_content);
		   // $mail_content= str_replace("#heading1#",$heading1,$mail_content);

		
		    
		  // $mail_content= str_replace("#message_content#",$message,$mail_content);
		 
		  #tbl_msg
		
          //      echo $mail_content;
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
$objResCatTotal_feature    = $objItem->getItemImageDetails();
$total_records_feature     = mysql_num_rows($objResCatTotal_feature);
$smarty->assign('total_records_feature',$total_records_feature);
// end implementation restrication to not to make more than 12 items featured//

if($total_records_feature >0)
{
	
	while($Row = mysql_fetch_array($objResCatTotal_feature))
	{
		$productList[]	    = $Row['title'];
        $productListId[]	= $Row['item_id'];

	}
}
$smarty->assign('productList',$productList);
$smarty->assign('productListId',$productListId);

//assign error message
$smarty->assign("error_msg",$error_msg);


//display template and title
$smarty->assign('site_page_title',ADMIN_PAGE_MGMT);
$smarty->assign('site_title',$site_title);
$smarty->display('admin_send_news_letter_withitems.tpl');	
?>