<?php
include ('include/common.inc');
include ('class/class.item.inc');
include ('class/class.user.inc');
include ('class/class.package.inc');
include ('class/class.category.inc');
include ('class/class.shipping.inc');
include ('class/class.mail.inc');
include ('include/country_state_cat.php');
include ('include/sendEmailClass.php');
include ('include/send-sms.php');


			$req = 'cmd=_notify-validate';

			foreach ($_POST as $key => $value) {
			$value = urlencode(stripslashes($value));
			$req .= "&$key=$value";
			}

			// post back to PayPal system to validate
			$header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
			$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
			$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
			$fp = fsockopen ('ssl://www.paypal.com', 443, $errno, $errstr, 30);

			$objItem        = new Class_Item();
            $objUser 	    = new Class_User();
            $objPackage 	= new Class_Package();
            $objMail 	    = new Class_Mail();
            $emailObj 	    = new SendEmailClass;

            $Obj_category             = new Class_Category();
			$message          	      = ob_get_contents();
			$payment_status           = $_POST['payment_status'];
			$payment_currency         = $_POST['mc_currency'];
			$txn_id                   = $_POST['txn_id'];
			$receiver_email           = $_POST['receiver_email'];
			$payer_email              = $_POST['payer_email'];
			$amount                   = $_POST['mc_gross'];
			$custom                   = $_POST['custom'];
			
			$explode_custom           = explode("##--0|0--##",$custom);
			
			$package_name             = $explode_custom[0];
			$package_min_items        = $explode_custom[1];
			$package_max_items        = $explode_custom[2];
			$seller_id                = $explode_custom[3];
			$duration_id              = $explode_custom[4];	           
         
			$payment_status           = $_POST['payment_status'];
			$payment_currency         = $_POST['mc_currency'];
			$txn_id                   = $_POST['txn_id'];
			$receiver_email           = $_POST['receiver_email'];
			$payer_email              = $_POST['payer_email'];
			$amount                   = $_POST['mc_gross'];


                        // mail('rishi_kapoor@seologistics.com','hi','custom='.$custom.'==explode_custom=='.$explode_custom);
			//$last_trans_id 	  = $objDBReturn->nIdentity;

		if (!$fp) {
// HTTP ERROR
} else {                $no_of_diffdays=0;
                        fputs ($fp, $header.$req);
                        $objPackage->seller_id       = $seller_id;
                        $objPackage->status          = 1;
                        $result_active_pkgs          = $objPackage->getPackagedetails();
                        $num_rowsactive_pkgs         = mysql_num_rows($result_active_pkgs);
                        if($num_rowsactive_pkgs>0)
                        {
                        $arr_active_pkgid            = mysql_fetch_assoc($result_active_pkgs);
                        $pkj_id_value                = $arr_active_pkgid['pack_id'];
                        $prev_pkg_exp_date           = $arr_active_pkgid['expiry_date'];
						$prev_pkg_min_items          = $arr_active_pkgid['min_items'];
					    $prev_pkg_max_items          = $arr_active_pkgid['max_items'];
						if($package_min_items==$prev_pkg_min_items && $prev_pkg_max_items==$package_max_items)    {
						$date1   = date('Y-m-d');
						$date2   = $prev_pkg_exp_date;
						$no_days = 60*60*24;
						$d1_days = strtotime($date1);
						$d2_days = strtotime($date2);						
						$no_of_diffdays = ceil(($d1_days-$d2_days)/$no_days);
						
						}
						
						
				     //	$prev_pkg_nomonth_date      = $arr_active_pkgid['time_month'];
				
mail('rishi_kapoor@seologistics.com','Hi','no_of_diffdays='.$no_of_diffdays.'=--date 1 ='.$date1.'=--date 2 ='.$date2.'=--d1 days ='.$d1_days.'=--d2 days='.$d2_days);
												 
                         $objPackage->pack_id        = $pkj_id_value;
                         $objPackage->status         =  0;
                         $objDBReturn                = $objPackage->insertUpdatePurchase_Package();
                        }
						
						/*if(($duration_id == 1 &&  $prev_pkg_nomonth_date=='1 Month')|| ($duration_id == 6 &&  $prev_pkg_nomonth_date=='6 Month')||($duration_id == 12 &&  $prev_pkg_nomonth_date=='12 Month'))
						{}*/
						$no_of_diffdays = trim($no_of_diffdays,'-');
						$no_of_diffdays = $no_of_diffdays+15;
						mail('rishi_kapoor@seologistics.com','hi','after exp='.$no_of_diffdays );
						if($duration_id==1)
			            $time_exp =date("Y-m-d", strtotime('+1 month '.$no_of_diffdays.' days'));						
						//$time_exp =date("Y-m-d", strtotime('+1 month 15 days'));
			
						if($duration_id==6)
						$time_exp =date("Y-m-d", strtotime('+6 month '.$no_of_diffdays.' days'));				
						//$time_exp =date("Y-m-d", strtotime("+6 month $no_of_diffdays  days"));						
						//$time_exp =date("Y-m-d", strtotime('+6 month 15 days'));
			
						if($duration_id==12)
						$time_exp =date("Y-m-d", strtotime('+12 month '.$no_of_diffdays.' days'));			
					//    $time_exp =date("Y-m-d", strtotime("+12 month $no_of_diffdays  days"));					
					//	$time_exp =date("Y-m-d", strtotime('+12 month 15 days'));

                        $objPackage->amount          = $amount;
						$objPackage->pack_id         = '';
                        $objPackage->status          = 1;
                        $objPackage->paymentmode     = 'direct paypal';
                        $objPackage->trans_id        = $txn_id;
                        $objPackage->values_returned = serialize($_POST);
                        $objPackage->package_name    = $package_name;
                        $objPackage->time_month      = $duration_id.' Month';
                        $objPackage->max_items       = $package_max_items;
                        $objPackage->min_items       = $package_min_items;
                        $objPackage->payment_status  = 1;
                        $objPackage->expiry_date     = $time_exp;
                        $objDBReturn                 = $objPackage->insertUpdatePurchase_Package();
                          /////----------activating expired items------------//////////
              
                    /////----------activating expired items------------//////////

                    $objItem->seller_id          = $seller_id;
                    $objItem->limit_max_items    = $package_max_items;
                    $objItem->orderexp_items_id  = 1; // asc order of first max items accord to pkg 
                    $objItem->order_by_variable  = 1; // order by variable pkg 
                    $get_items_ids               = $objItem->getItemImageDetails();
                    $num_items                   = mysql_num_rows($get_items_ids);
                    if($num_items>0)
                    {
                    while($arr_fetch_allitem_ids = mysql_fetch_assoc($get_items_ids))
                     {
                      $arr_allitem_ids[]         = $arr_fetch_allitem_ids['item_id'];
                     }
                      $implode_item_id           = implode(',',$arr_allitem_ids);
                    }
                     //mail('rishi_kapoor@seologistics.com','hi',$implode_item_id );
                   $objItem->expired_package    = 0;
                   $objItem->implode_item_ids   = $implode_item_id;
                    // $objItem->max_item        = $package_max_items;
                   $make_expire_items           = $objItem->insertUpdateActivateItem(); // function to activate items
                   //exit;
                   ///////----- end of code of activating expired items----------/////////
                   $objUser->id = $seller_id;
                   $UserRes = $objUser->getUserDetails();
                   if(mysql_num_rows($UserRes)>0)
				   {
				   $UserArr = mysql_fetch_array($UserRes);
                   $UserArr['email'];
                   $UserArr['username'];
                   $sellers_name = $UserArr['first_name'].' '.$UserArr['last_name'];
                   }
            
              
              		//******************************** Get email template ******************
				$objMail->mail_title	 = "Email Template";
				$MailTemplate		     = $objMail->selectMailTemplate();
				$templateRowArr 	     = mysql_fetch_array($MailTemplate);
				$mail_content		     = $templateRowArr['mail_content'];
		//		$mail_content		     = str_replace("#link#",'NetHaat',$mail_content);
                $mail_content	         = str_replace("#link#",$baseUrl,$mail_content);

      //********************************  Purchased_package email content **************
                
				$objMail->mail_title	= "Purchased_package";
				$MailRes 		        = $objMail->selectMailTemplate();
				$mailRowArr 		    = mysql_fetch_array($MailRes);
				$subject 		        = $mailRowArr['mail_subject'];
				//$subject		        = str_replace("#name#",$UserArr['username'],$subject);
				$message_content	    = $mailRowArr['mail_content'];

	//***************************  Replacing mail content *********************
                $mail_content           = str_replace("#message_content#",$message_content,$mail_content);
		        $mail_content           = str_replace("#seller_name#",$sellers_name,$mail_content);
                $mail_content           = str_replace("#package_cost#",$amount,$mail_content);
                $mail_content           = str_replace("#package_name#",$package_name,$mail_content);
                $mail_content           = str_replace("#expiry_date#",$time_exp,$mail_content);
                $mail_content           = str_replace("#max_items#",$package_max_items,$mail_content);
                $mail_content	    	= str_replace("#link#",$baseUrl,$mail_content);


		//***************************  Sending mail content *********************
 //               $emailStatus = $emailObj->SendHtmlMail('rishi_kapoor@seologistics.com',$subject,$mail_content,'Nethaat');

 $emailStatus 	= $emailObj->SendHtmlMail($UserArr['email'], $subject, $mail_content,'Nethaat');


}












?>