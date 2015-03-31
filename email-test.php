<p><strong>Dear #recivers_name#,</strong></p>
        <p>#sender_name# has contact you.<br />
               Message: #message#<br />
			  Click here to buy or view this item<a href="#link#item_detail.php?details_item_value=#item_id#">#Item_name#</a>
		
        <p><strong>Thanks,<br />
        Nethaat Team</strong></p>
		$details_item_value         =  $_REQUEST['details_item_value'];
	$link_url="http://".$_SERVER['HTTP_HOST']."/nethaat/item-details.php?details_item_value=".$details_item_value ;
	$frinds_email = $_POST['frinds_email'];
		 $yours_email	= $_POST['yours_email'];
		$yours_name	= $_POST['yours_name'];
		$frinds_email = $_POST['frinds_email'];
		$message      = $_POST['message_post'];
		$message.="<br><br><a href='".$link_url."'>".$link_url."</a>"; 
		$to      =  $frinds_email;
		$subject =   $_POST['yours_name'];
		$headers = "From: myplace@here.com\r\n";
		$headers .= "Reply-To: myplace2@here.com\r\n";
		$headers .= "Return-Path: myplace@here.com\r\n";

