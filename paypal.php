<?php

/*  PHP Paypal IPN Integration Class Demonstration File
 *  4.16.2005 - Micah Carrick, email@micahcarrick.com
 *
 *  This file demonstrates the usage of paypal.class.php, a class designed  
 *  to aid in the interfacing between your website, paypal, and the instant
 *  payment notification (IPN) interface.  This single file serves as 4 
 *  virtual pages depending on the "action" varialble passed in the URL. It's
 *  the processing page which processes form data being submitted to paypal, it
 *  is the page paypal returns a user to upon success, it's the page paypal
 *  returns a user to upon canceling an order, and finally, it's the page that
 *  handles the IPN request from Paypal.
 *
 *  I tried to comment this file, aswell as the acutall class file, as well as
 *  I possibly could.  Please email me with questions, comments, and suggestions.
 *  See the header of paypal.class.php for additional resources and information.
*/

// Setup class
require_once('paypal.class.php');  // include the class file
$p = new paypal_class;             // initiate an instance of the class
$p->paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';   // testing paypal url
//$p->paypal_url = 'https://www.paypal.com/cgi-bin/webscr';     // paypal url

//get amount here from session
session_start();
mysql_connect("localhost","root","") ;
mysql_select_db("gatormatt");
 $amount = $_REQUEST['plan'];
//$amount = 50;

$_SESSION['FIRSTNAME']  = $_REQUEST['FIRSTNAME'];          
$_SESSION['LASTNAME']  = $_REQUEST['LASTNAME'];   
$_SESSION['EMAIL']  = $_REQUEST['EMAIL'];   
$_SESSION['USERNAME']  = $_REQUEST['USERNAME'];   
$_SESSION['PASSWORD']  = $_REQUEST['PASSWORD'];   

$_SESSION['MONTH']  = $_REQUEST['MONTH'];   
$_SESSION['DAY']  = $_REQUEST['DAY'];   
$_SESSION['YEAR']  = $_REQUEST['YEAR'];   
$_SESSION['state']  = $_REQUEST['state'];   
$_SESSION['zip']  = $_REQUEST['zip'];   
$_SESSION['city']  = $_REQUEST['city'];   
$date_of_birth =  $_REQUEST['YEAR'].'-'.$_REQUEST['MONTH'].'-'.$_REQUEST['DAY'];   
$_SESSION['date_of_birth_inses']  = $date_of_birth;
 $_SESSION['street']= $_REQUEST['street'];   
//$_SESSION['city']  = $_REQUEST['city'];   



// setup a variable for this script (ie: 'http://www.micahcarrick.com/paypal.php')
$this_script = 'http://localhost/laborgator/paypal_nvp/paypal.php';

// if there is not action variable, set the default action of 'process'
if (empty($_GET['action'])) $_GET['action'] = 'process';  

switch ($_GET['action']) {
    
   case 'process':      // Process and order...

      // There should be no output at this point.  To process the POST data,
      // the submit_paypal_post() function will output all the HTML tags which
      // contains a FORM which is submited instantaneously using the BODY onload
      // attribute.  In other words, don't echo or printf anything when you're
      // going to be calling the submit_paypal_post() function.
 
      // This is where you would have your form validation  and all that jazz.
      // You would take your POST vars and load them into the class like below,
      // only using the POST values instead of constant string expressions.
 
      // For example, after ensureing all the POST variables from your custom
      // order form are valid, you might have:
      //
      $p->add_field('first_name',  $_REQUEST['FIRSTNAME']);
     $p->add_field('last_name', $_REQUEST['LASTNAME']);
      //$bus_id = "anujsh_1208342525_biz@gmail.com";
	  $bus_id = "mahi_v_1241414817_biz@yahoo.co.in";	
      $p->add_field('business', $bus_id);
      $p->add_field('return', $this_script.'?action=success');
      $p->add_field('cancel_return', $this_script.'?action=cancel');
      $p->add_field('notify_url', $this_script.'?action=ipn');
      $p->add_field('item_name', 'Purchase Credit from Coupon Worm');
      $p->add_field('amount', $amount);

      $p->submit_paypal_post(); // submit the fields to paypal
      //$p->dump_fields();      // for debugging, output a table of all the fields
      break;
      
   case 'success':      // Order was successful...
   
      // This is where you would probably want to thank the user for their order
      // or what have you.  The order information at this point is in POST 
      // variables.  However, you don't want to "process" the order until you
      // get validation from the IPN.  That's where you would have the code to
      // email an admin, update the database with payment status, activate a
      // membership, etc.
        
      //get response in Session and redirect
	//  print_r($_POST);

	  //values from session
		
		$val_date_of_birth_inses = $_SESSION['date_of_birth_inses'];
		$val_FIRSTNAME = $_SESSION['FIRSTNAME'];
		$val_LASTNAME = $_SESSION['LASTNAME'];
		$val_EMAIL = $_SESSION['EMAIL'];
		$val_USERNAME = $_SESSION['USERNAME'];
		$val_PASSWORD = $_SESSION['PASSWORD'];
		$val_state = $_SESSION['state'];
		$val_city = $_SESSION['city'];
		$val_zip = $_SESSION['zip'];
		$val_street = $_SESSION['street'];
		
	  $qry_insert = "insert into users(ID,FIRSTNAME,LASTNAME,USERNAME,PASSWORD,EMAIL,CITY,STREET,STATE,ZIP,DOB) values(\"\",\"$val_FIRSTNAME\",\"$val_LASTNAME\",\"$val_USERNAME\",\"$val_PASSWORD\",\"$val_EMAIL\",\"$val_city\",\"$val_street\",\"$val_state\",\"$val_zip\",\"$val_date_of_birth_inses\") ";
	   mysql_query($qry_insert);

	  $_SESSION['paypal_response_msg'] = "Registration completed successfully!!";
      $_SESSION['paypal_response'] = $_POST;
       header("location: http://localhost/laborgator/register.php");
      	exit();
      /*echo "<html><head><title>Success</title></head><body><h3>Thank you for your order.</h3>";
      foreach ($_POST as $key => $value) { echo "$key: $value<br>"; }
      echo "</body></html>";
      */
      // You could also simply re-direct them to another page, or your own 
      // order status page which presents the user with the status of their
      // order based on a database (which can be modified with the IPN code 
      // below).
      
      break;
      
   case 'cancel':       // Order was canceled...
   $_SESSION['paypal_response_msg'] = "Registration failed !!";
         header("location: http://localhost/laborgator/register.php");
      	exit();
      	//header("location: paypal.php?action=cancel");
      //	exit();
      
   		// The order was canceled before being completed.
 	  	echo "<html><head><title>Canceled</title></head><body><h3>The order was canceled.</h3>";
      	echo "</body></html>";

      	break;
      
   case 'ipn':          // Paypal is calling page for IPN validation...
   
      // It's important to remember that paypal calling this script.  There
      // is no output here.  This is where you validate the IPN data and if it's
      // valid, update your database to signify that the user has payed.  If
      // you try and use an echo or printf function here it's not going to do you
      // a bit of good.  This is on the "backend".  That is why, by default, the
      // class logs all IPN data to a text file.
      
      if ($p->validate_ipn()) {
          
         // Payment has been recieved and IPN is verified.  This is where you
         // update your database to activate or process the order, or setup
         // the database with the user's order details, email an administrator,
         // etc.  You can access a slew of information via the ipn_data() array.
  
         // Check the paypal documentation for specifics on what information
         // is available in the IPN POST variables.  Basically, all the POST vars
         // which paypal sends, which we send back for validation, are now stored
         // in the ipn_data() array.
  
         // For this example, we'll just email ourselves ALL the data.
        // $subject = 'Instant Payment Notification - Recieved Payment';
        //// $to = 'mahipal@mindgenies.com';    //  your email
         $body =  "An instant payment notification was successfully recieved\n";
         $body .= "from ".$p->ipn_data['payer_email']." on ".date('m/d/Y');
         $body .= " at ".date('g:i A')."\n\nDetails:\n";
         
        // foreach ($p->ipn_data as $key => $value) { $body .= "\n$key: $value"; }
        // mail($to, $subject, $body);
      }
      break;
 }     

?>