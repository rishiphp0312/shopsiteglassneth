<?php
include ("common_includes.php");
include ('../class/class.news_letter.inc');
include ("../class/class.item.inc");
include ("../class/class.user.inc");
include ('../include/country_state_cat.php');
include ("../class/class.category.inc");
include ("../include/adminsession.php.inc");
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

/// start of unregistered users //////
//create object of Class_NewsLetter class
$objNewsLetter = new Class_NewsLetter();

//selects users list to send email
$usersList = array();
$objNewsLetter->status = 1;//select oncy active
$objResUsers   = $objNewsLetter->selectNewsLetter();
$total_records_feature    = mysql_num_rows($objResUsers);
$smarty->assign('total_records_feature',$total_records_feature);

$pagination = new Pagination();
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

$objNewsLetter->pageLimit = $pageLimit;

//$url=$url."";

$pageLink = 
$pagination->getPageLinks($total_records_feature, $to, $url, $pageNumber,'', $showPrevNext);


// Assigning Pagination Links
 
$smarty->assign('pageLink',$pageLink);  
$objNewsLetter->pageLimit = $pageLimit; 

$objResItem1 = $objNewsLetter->selectNewsLetter();
$page_counter = $pagination->getPageCounter(mysql_num_rows($objResItem1));

if(mysql_num_rows($objResItem1)>0)
{
	while($UserRow = mysql_fetch_array($objResItem1))
	{
		$userList[]	= $UserRow;
	}
}
$smarty->assign('page_counter',$page_counter);
$smarty->assign('userList',$userList);

/// end of unregistered users //////

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

if($_SERVER['REQUEST_METHOD']=="POST")
{

	//post variables
	extract($_POST);
	
	$text1 = $_POST['text1'];
	$text2 = $_POST['text2'];
	$text3 = $_POST['text3'];
	ini_set('SMTP','mail.seologistics.com');
    ini_set('smtp_port','25');
    ini_set('sendmail_from','arun_chauhan@seologistics.com');
	
	$subject		= rteSafe($subject);
	$message		= rteSafe($message);
	$heading2       = $_POST['heading2'];
	$heading1       = $_POST['heading1'];
	$UserEmails_r[] = $_POST['UserEmails'];
	$heading3       = $_POST['heading3'];
	//$UserEmails_r_imp = implode(",",$UserEmails_r);
	//{$heading}
	//collect all email address's
	
	$emailTo = "";
	$product_1 = $_POST['product_1'];
	
	if(count($product_1)>0)
	{
	for($i=0;$i<count($product_1);$i++)
	{
	  $item_ids                  = $product_1[$i];	
	  $objItem->update_item_id   = $item_ids;	
	  $objResCatTotal            = $objItem->getItemImageDetails();
	  $num_rows_images           = mysql_num_rows($objResCatTotal);
	  if($num_rows_images>0)
	  {
	   while($arr_rows_images    = mysql_fetch_assoc($objResCatTotal))
		  {
	     $arremail_rows_title[]  = $arr_rows_images['title'];
	     $arremail_rows_images[] = $arr_rows_images['image1'];
		 $arremail_rows_ids[]    = $arr_rows_images['item_id'];
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
	
 
 if(count($_POST['UserEmails'])==0)
{
failure_msg("Error occured Please select atleast one user!!");
	 redirect("admin_send_news_letter_withitems.php");

}else
{
for($mail_i=0;$mail_i<count($_POST['UserEmails']);$mail_i++)
{

//echo '<br>';
//echo 'mail='.$mail_i;
$user_pass_url	= '';
$tbl_msg= "<table align='center'   cellpadding='4' width='100%' bgcolor='#F6FBFC' cellspacing='0' style='border :6px solid #F6FBFC;' >";
$tbl_msg .= "<tr><td style='font-size:13px;font-family:Verdana, Arial, Helvetica, sans-serif;font-weight:600;text-align:left;color:#000000;'>An interactive online marketplace for sellers and buyers of hand made items.</td></tr>";
$tbl_msg .= "<tr><td>";
$tbl_msg .= "<table align='center'  cellpadding='4' width='100%' bgcolor='#ffffff' cellspacing='2' border='0' >";
$tbl_msg .= "<tr><td  colspan='2' bgcolor='#ffffff'>&nbsp;</td></tr>";
//if(count($product_1)>0 && count($product_2)>0 && count($product_3)>0)


	if(count($product_1)>0)
	{
$tbl_msg .="<tr><td  colspan='2' bgcolor='#F3F1E6' style='font-family:Verdana, Arial, Helvetica, sans-serif;font-size:20px;font-weight:bold;color:#000000;text-align:center;' >".$heading1."</td></tr><tr>
<td bgcolor='#ffffff' colspan='2'  style='font-family:Verdana, Arial, Helvetica, sans-serif;font-size:12px;font-weight:500;color:#000000;text-align:left;'  >".$text1."</td>
</tr>";
$tbl_msg .="<tr bgcolor='#ffffff'><td colspan='2' style='border:1px solid #ECF9FF;'  valign='top' align='left' ><table bgcolor='#ffffff' align='center' cellpadding='0' cellspacing='15' width='99%' border='0' >";
$tbl_msg .="<tr bgcolor='#ffffff'>";


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
	   $anther_path = $baseUrl."item-details.php?details_item_value=";
	   
	   $pathstr= "<a href='".$anther_path.$arremail_rows_ids[$k]." '><img style='border:0px;' border='0' src=".$path." ></a>";
	    

        $count_val=$k+1;
		$colspan_value= 6-($count_val%5);
		if($count_val == count($product_1))
		$colspan=" colspan = $colspan_value";
		else
		$colspan=" ";
		
		$newtext = wordwrap($arremail_rows_title[$k],20, "<br />\n");
		
       //  echo 'newtxt--'.$newtext;


///////

$tbl_msg .="<td valign='top'  align='left' $colspan style='border:1px solid #D3D1BA;' ><table align='left' border='0' cellpadding='5' cellspacing='0'>
<tr bgcolor='#ffffff'><td valign='top' align='center' >".$pathstr."</td></tr>
<tr bgcolor='#ffffff'><td valign='top' align='center' style='font-family:Verdana, Arial, Helvetica, sans-serif;font-size:12px;font-weight:400;color:#814141;text-decoration: none;' ><a style='font-family:Verdana, Arial, Helvetica, sans-serif;font-size:12px;font-weight:400;color:#814141;text-decoration: none;' href='".$anther_path.$arremail_rows_ids[$k]."'>".$newtext."</a></td></tr></table></td>";




if($count_val%5==0)
	{
		$tbl_msg .="</tr><tr bgcolor='#ffffff'>";
	}
	if($count_val == count($product_1))
	{
		$tbl_msg .="</tr>";
	}

////

/*if($count_val%5==0 && ($count_val!= count($product_1)))
{
$tbl_msg .="</tr><tr bgcolor='#ffffff'>";
}
if(($count_val == count($product_1))&& $count_val%5!=0 )
{
$tbl_msg .="</tr>";
}
if(($count_val == count($product_1)) && $count_val%5==0)
{
$tbl_msg .="<tr bgcolor='#ffffff'><td>&nbsp;</td></tr>";
}
*/


}
$tbl_msg .="</table>";
$tbl_msg .="</td></tr>";
}

if(count($product_2)>0)
{
//if(count($product_1)>0)
$tbl_msg .="<tr ><td valign='top' bgcolor='#ffffff' colspan='2'  align='left'>&nbsp;</td></tr>";
$tbl_msg .="<tr><td colspan='2'   valign='top' bgcolor='#F3F1E6' style='font-family:Verdana, Arial, Helvetica, sans-serif;font-size:20px;font-weight:bold;color:#000000;text-align:center;'  align='left'>".$heading2."</td></tr><tr>
<td  colspan='2' bgcolor='#ffffff' style='font-family:Verdana, Arial, Helvetica, sans-serif;font-size:12px;font-weight:500;color:#000000;text-align:left;' >".$text2."</td></tr>";


$tbl_msg .="<tr bgcolor='#ffffff'><td colspan='2'  valign='top' align='left'  style='border:1px solid #ECF9FF;'  ><table bgcolor='#ffffff' align='center' cellpadding='0' cellspacing='15' width='99%' border='0' >";
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
	    
		$anther_path = $baseUrl."item-details.php?details_item_value=";
	    $pathstr= "<a href='".$anther_path.$arremail_rows_ids2[$u]." '><img border='0' style='border:0px;' src=".$path." ><a>";
	  
	   $newtext = wordwrap($arremail_rows_title2[$u],20, "<br />\n");

$tbl_msg .="<td valign='top' align='left'   $colspan style='border:1px solid #D3D1BA;'><table align='left' border='0' cellpadding='5' cellspacing='0'>
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

///
/*if($count_valu%5==0 && ($count_valu!= count($product_2)))
{
$tbl_msg .="</tr><tr bgcolor='#ffffff'>";
}
if(($count_valu == count($product_2))&& $count_valu%5!=0 )
{
$tbl_msg .="</tr>";
}
if(($count_valu == count($product_2)) && $count_valu%5==0)
{
$tbl_msg .="<tr bgcolor='#ffffff'><td>&nbsp;</td></tr>";
}*/

//




}

$tbl_msg .="</table>";
$tbl_msg .="</td></tr>";
}

/////// third tble code


if(count($product_3)>0)
{
//if(count($product_2)>0 && count($product_1)>0)
$tbl_msg .="<tr ><td valign='top' bgcolor='#ffffff' colspan='2'  align='left'>&nbsp;</td></tr>";
$tbl_msg .="<tr><td colspan='2' valign='top' bgcolor='#F3F1E6'style='font-family:Verdana, Arial, Helvetica, sans-serif;font-size:20px;font-weight:bold;color:#000000;text-align:center;'  align='left'>".$heading3."</td></tr><tr>
<td colspan='2' bgcolor='#ffffff' style='font-family:Verdana, Arial, Helvetica, sans-serif;font-size:12px;font-weight:500;color:#000000;text-align:left;'  >".$text3."</td></tr>";

$tbl_msg .="<tr bgcolor='#ffffff'><td valign='top' colspan='2'  align='left'  style='border:1px solid #ECF9FF;' ><table bgcolor='#ffffff' align='center' cellpadding='0' cellspacing='15' width='99%' border='0' >";
$tbl_msg .="<tr bgcolor='#ffffff'>";
for($u=0;$u<count($product_3);$u++)
{
  $count_valu=$u+1;

 if($arremail_rows_title3[$u]!='')
		{
			if($arremail_rows_images3[$u]!=''   )
			{
	$path = $baseUrl."getthumb.php?w=150&h=100&fromfile=uploads/".$arremail_rows_images3[$u];				}
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
	
	   //$pathstr= "<img src=".$path." >";
	   //$anther_path = $baseUrl."item-details.php?details_item_value=";
	   $anther_path = $baseUrl."item-details.php?details_item_value=";
	   $pathstr= "<a href='".$anther_path.$arremail_rows_ids3[$u]." '><img style='border:0px;' border='0' src=".$path." ><a>";
	
	   $newtext = wordwrap($arremail_rows_title3[$u],20, "<br />\n");

	$tbl_msg .="<td valign='top'  align='left' $colspan style='border:1px solid #D3D1BA;' ><table align='left' border='0' cellpadding='5' cellspacing='0'>
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
	
	///
/*if($count_valu%5==0 && ($count_valu!= count($product_3)))
{
$tbl_msg .="</tr><tr bgcolor='#ffffff'>";
}
if(($count_valu == count($product_3))&& $count_valu%5!=0 )
{
$tbl_msg .="</tr>";
}
if(($count_valu == count($product_3)) && $count_valu%5==0)
{
$tbl_msg .="<tr bgcolor='#ffffff'><td>&nbsp;</td></tr>";
}*/

//


}
$tbl_msg .="</table>";
$tbl_msg .="</td></tr>";
}

$emailTo = $UserEmails_r[0][$mail_i];
$user_pass_url = $baseUrl.'index.php?unsub_scri='.$emailTo;
$tbl_msg .="<tr BGCOLOR='#FFFFFF'><td colspan='2' >#linkClick#</td></tr>";

$tbl_msg .="</table>";
$tbl_msg .="</td></tr>";
$tbl_msg .= "<tr><td>&nbsp;</td></tr>";
$tbl_msg .="</table>";
//echo $tbl_msg;exit;

    // echo $tbl_msg;
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


		//update email template
		$objMail->mail_id      = 8;
		$objMail->mail_subject = $subject;
		$objMail->mail_content = $message;
	
  //  echo 'emto='.$emailTo = $UserEmails_r[0][$mail_i];
  	if($mail_i ==0)
  	{
		$mail_content = $mail_content1  =  str_replace("#message_content#",$mail_content2,$mail_content);
	}
	else{
		$mail_content = $mail_content1 ;
	}
	//You receive this message because you have subscribed for newsletter. If you
//wish to unsubscribed for newsletter <a>click here</a> to unsubscribe.

		  //  echo $mail_content;	
	$tbl_msg	=   str_replace("#linkClick#","You have received this newletter, since you have subscribed for it. If you wish to unsubscribe the newsletter, <a href='".$user_pass_url."'>click here </a> .",$tbl_msg); 	 
	$mail_content = str_replace("#tbl_msg#",$tbl_msg,$mail_content); 
	//if($mail_i==)
	//exit;
	$mail_content = str_replace("#unsub#",'',$mail_content); 
	//exit;
		 
		
      //  echo $mail_content;
	  if(count($product_1)==0 &&  count($product_2)==0 &&  count($product_3)==0)
	 {
	 failure_msg("Error occured Please select some items!");
	 redirect("admin_send_news_letter_withitems.php");
	 }
	  else
	 { $emailStatus = $emailObj->SendHtmlMail($emailTo,$subject,$mail_content,$mailFrom);
		}  // $txt_em.=$emailTo;
    //    $mail_content='';  
			
			
			
			}
		//echo	$emailTo;
			
				//echo 'em==='.$emailStatus;exit;
			
			if($emailStatus)
			{ 
		
		
				//redirect user
				success_msg("News letter with items has been sent successfully!");
			}
			else
			{
		        // failure_msg("Error occured while sending mail!");
			}
			
		}
			redirect("admin_send_news_letter_withitems.php");
		
	
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
$objResCatTotal_feature    = $objItem->getItemImageDetails_withothers();
$total_records_feature     = mysql_num_rows($objResCatTotal_feature);
$smarty->assign('total_records_feature',$total_records_feature);
// end implementation restrication to not to make more than 12 items featured//

if($total_records_feature >0)
{
	
	while($Row = mysql_fetch_array($objResCatTotal_feature))
	{
		$productList[]	    = $Row['title'].'    ['.$Row['username'].'--'.$Row['country'].']';
        $productListId[]	= $Row['item_id'];
		//$USERNAME[]         = $Row['username'];
		//$country[]          = $Row['country'];

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
