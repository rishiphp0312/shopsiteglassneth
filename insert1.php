<?php
include ('include/common.inc');

include ('class/class.mail.inc');
//include ('class/crypto_class.php');
include ('class/class.news_letter.inc');

include ("class/class.item.inc");
include ("class/class.user.inc");



$objUser		= new Class_User();
$objNewsLetter = new Class_NewsLetter();

$resUser        = $objUser->selectUser();
echo mysql_num_rows($resUser);
if(mysql_num_rows($resUser))
{
 while($resUserRow   = mysql_fetch_array($resUser))
  {
   $arr_user_email[] = $resUserRow['email'];
  }
}

echo '<pre>';
print_r($arr_user_email);
echo '</pre>';



//selects users list to send email
$usersList_newsarr = array();
//select oncy active
$objResUsers       = $objNewsLetter->selectNewsLetter();
$total_records_feature    = mysql_num_rows($objResUsers);
if($total_records_feature>0)
{
 while($arr_feature_records = mysql_fetch_assoc($objResUsers))
   {
     $usersList_newsarr[]   = $arr_feature_records['news_letter_email'];
  
    }
 
}
 
for($i=0;$i<count($arr_user_email);$i++)
  {echo '<br>';
     echo $regs_user =  $arr_user_email[$i];
	 echo '<br>';
	   echo in_array($regs_user,$usersList_newsarr);
     if(in_array($regs_user,$usersList_newsarr)!=1)
	 {
	
	 	$objNewsLetter->news_letter_email  = rteSafe($regs_user);
		$objNewsLetter->status =1;				
		$objDBReturn = $objNewsLetter->insertUpdateNewsLetter();	
		
	 }
	 //$usersList_newsarr[$i]
  }

?>
