<?php
include ('include/common.inc');
include ('class/class.user.inc');
include ('class/class.item.inc');
include ("include/authentiateUserLogin.php");
include ("class/class.shipping.inc");
include ('class/class.mail.inc');
include ('include/sendEmailClass.php');




//create object of Item class

$objItem	 = new Class_Item();
$objUser         = new Class_User();
$objShip         = new Class_Shipping();
$last_trans_id   = $_REQUEST['last_trans_id'];
$ship_status_id  = $_REQUEST['ship_status_id'];

if($ship_status_id!='')
{
        $objShip->ship_service = addslashes($_REQUEST['ship_name']);
	$objShip->ship_status  = 1;
	$objShip->ship_id      = $ship_status_id;
	$ship_date_exp         = explode("/",$_REQUEST['Ship_Start']);
	$ship_date_exp1        = $ship_date_exp[2].'-'.$ship_date_exp[0].'-'.$ship_date_exp[1];  
	$objShip->date_add     = $ship_date_exp1; //when shipping starts
	$objShip->comment      = addslashes($_REQUEST['comment']); //when shipping starts
	//$objItem	
	// sending mail once product been shipped  by seller
	
	
	//$item_id_value
	$objShip->ship_id                      =  $ship_status_id;
        $objShip->ship_status                  =  0;
	$shiping_details_query                 =  $objShip->getshippingdetails();
	$num_rows_ship_id                      =  mysql_num_rows($shiping_details_query);
	if($num_rows_ship_id >0)
	{
		$arr_rows_ship_id                  =  mysql_fetch_assoc($shiping_details_query);
		$item_name                         =  ucfirst($arr_rows_ship_id['title']);
		$shipping_cost                     =  ucfirst($arr_rows_ship_id['shipping_cost']);
		$seller_id                         =  $arr_rows_ship_id['seller_id'];
		$buyer_id                          =  $arr_rows_ship_id['buyer_id'];
	
	}
        // echo '<pre>';
        //print_r($arr_rows_ship_id);

	//echo $item_name;
        $objUser->id                           =  $seller_id;
        //exit;
	$selectUser_query                      =  $objUser->selectUser();
	$num_selectUser_query                  =  mysql_num_rows($selectUser_query);
	if($num_selectUser_query>0)
	{
		 $arr_fetch_user               =  mysql_fetch_assoc($selectUser_query);
	}
	 //echo 'send-'.$sender_name                          =  $arr_fetch_user['first_name'].' '.$arr_fetch_user['last_name'];

         $objUser->id                          =  $buyer_id;
	 $selectUser_query1                    =  $objUser->selectUser();
	 $num_selectUser_query1                =  mysql_num_rows($selectUser_query1);
	 if($num_selectUser_query1>0)
	 {
	    $arr_fetch_user1                  =  mysql_fetch_assoc($selectUser_query1);
	    $reciver_email                    =  $arr_fetch_user1['email'];
            $reciver_name                     =  $arr_fetch_user1['first_name'].' '.$arr_fetch_user1['last_name'];
	}
	
        //echo 'rec-em-'.$reciver_email.'---rec-nam'.$reciver_name;
        //exit;
	$objMail 	                              =  new Class_Mail();
	$objMail->mail_title	                      =  "Email Template";
        $MailTemplate			              =  $objMail->selectMailTemplate();
        $templateRowArr 		              =  mysql_fetch_array($MailTemplate);
        $mail_content			              =  $templateRowArr['mail_content'];
        $mail_content			              =  str_replace("#link#",$baseUrl,$mail_content);
	
	$objMail->mail_title   	                      =  "shipped_by_seller";
	$MailTemplate			              =  $objMail->selectMailTemplate();
	$templateRowArr 		              =  mysql_fetch_array($MailTemplate);
        $mail_content1			              =  $templateRowArr['mail_content'];
         //$recivers_name                             =  $arr_fetch_users_details['name'] ;
   
	$mail_content			              =  str_replace("#message_content#",$mail_content1,$mail_content);
	$mail_content			              =  str_replace("#link#",$baseUrl,$mail_content);
	$mail_content			              =  str_replace("#name#", $name_to,$mail_content);
	$subject 				      =  $templateRowArr['mail_subject'];  
	$subject			              =  str_replace("#sender_name#",$sender_name,$subject);	
	$mail_content			              =  str_replace("#reciver_name#",$reciver_name,$mail_content);	
	$mail_content			              =  str_replace("#sender_name#",$sender_name,$mail_content);	
        $mail_content			              =  str_replace("#comment#",$_REQUEST['comment'],$mail_content);
	
	
	//$event_message;
        $mail_content			              =  str_replace("#shipping_date#",$ship_date_exp1,$mail_content);
        $mail_content			              =  str_replace("#item_name#",$item_name,$mail_content);
        $mail_content			              =  str_replace("#shipping_cost#",$shipping_cost,$mail_content);
        $mail_content			              =  str_replace("#shipping_service#",$_REQUEST['ship_name'],$mail_content);

        $mail_content			              =  str_replace("#link#",$baseUrl,$mail_content);
        $mailFrom                                     =  "Nethaat";
        $to                                           =  $reciver_email;
        $emailObj 	                              =  new SendEmailClass;
      //$reciver_email
	$status = $emailObj->SendHtmlMail($to, $subject, $mail_content, $mailFrom);

	
	 $objShip->ship_status                  =  1;
       
	 $objDBReturn    = $objShip->insertUpdateshipping();
	 $objItem->id    = $last_trans_id;
         $objItem->shipping_status=1;
	 $objDBReturn1   = $objItem->insertUpdatepurchaseditem();

		if($objDBReturn->nErrorCode==0)
		{
		
          success_msg("Shipping process is completed successfully!");
		}
		else
		{
			$error_msg = "Error occured ...!Please try again";
				failure_msg("Error occured while adding shipping details");
		}
		//redirect("sell-an-item.php");
		//if($item_id_value=='')
		//redirect("upload_imgage.php");
		//else
		//redirect("upload_imgage.php?item_id_value=".$item_id_value);
	
	//
	echo "<script>window.parent.location.reload();</script>";
	echo "<script>parent.$.fn.fancybox.close();window.parent.location='seller_shipping_details.php';</script>";

    //redirect("seller_shipping_details.php");
}

if($item_id_value!='')
{
	$obj_item->update_item_id  =  $item_id_value;
	$odj_image_details_value   =  $obj_item->getItemImageDetails();
	$num_value_details         =  mysql_num_rows($odj_image_details_value);

	if($num_value_details >0)
	 {
		$arr_fetch_item_details	= mysql_fetch_assoc($odj_image_details_value);
		$quantity_available		= $arr_fetch_item_details['quantity_available'];
	 }
}

//$obj_item->quantity_available = $max_quantity;

$smarty->assign("quantity_available",$quantity_available);
$smarty->assign("item_id_value",$item_id_value);
$smarty->assign("last_trans_id",$last_trans_id);
$smarty->assign("ship_status_id",$ship_status_id);



//display template
$smarty->assign('site_page_title','Update Quantity');
$smarty->assign('site_title',$site_title);
$smarty->display('shipping_start_details.tpl');
?>