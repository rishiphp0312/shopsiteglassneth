<?php
include ('include/common.inc');
include ("class/class.category.inc");
include ("class/class.item.inc");
include ('class/class.user.inc');
include ('class/class.package.inc');
//include ('class/class.mail.inc');
//sssssssssinclude ('include/sendEmailClass.php');
$obj_item       = new Class_Item();
$obj_item1       = new Class_Item();



   $objUser        = new Class_User();
 //  $item_id_value  = $_REQUEST['item_id_value'];
    $result_allusers=$objUser->selectUser();
	$num_users      = mysql_num_rows($result_allusers);
	if($num_users>0)
	{
	while($arr_all_users= mysql_fetch_assoc($result_allusers))
			{
		echo '<br>';
		echo $username=$arr_all_users['username'];
		echo '<br>';
	//	mkdir('uploads/'.$username,0755);
				echo $arr_all_users['user_id_value'];
					echo '<br>';
	    $obj_item->seller_id= $arr_all_users['user_id_value'];
		$resltitems= $obj_item->getItemImageDetails();    
        $num_items  = mysql_num_rows($resltitems);	
			if($num_items>0)
			{
			while($arr_all_items = mysql_fetch_assoc($resltitems))
							{
				   echo '<br>';
				   echo 'item-id='.$arr_all_items['item_id'];
				   echo '<br>';
					echo '<br>';
					echo 'image1='.$arr_all_items['image1'];
					echo '<br>';

			      echo	copy('uploads/'.$arr_all_items['image1'],'uploads/'.$username.'/'.$arr_all_items['image1']);
					echo '<br>';
					echo 'image2='.$arr_all_items['image2'];
													echo '<br>';

					echo copy('uploads/'.$arr_all_items['image2'],'uploads/'.$username.'/'.$arr_all_items['image2']);
				
					
					echo '<br>';
					echo 'image3='.$arr_all_items['image3'];
					echo '<br>';

					
				    echo copy('uploads/'.$arr_all_items['image3'],'uploads/'.$username.'/'.$arr_all_items['image3']);
				
					echo '<br>';
					echo 'image4='.$arr_all_items['image4'];
					echo '<br>';

				   echo copy('uploads/'.$arr_all_items['image4'],'uploads/'.$username.'/'.$arr_all_items['image4']);
				
					echo '<br>';
					echo 'image5='.$arr_all_items['image5'];
					echo '<br>';

					echo copy('uploads/'.$arr_all_items['image5'],'uploads/'.$username.'/'.$arr_all_items['image5']);
				
				    $obj_item1->update_item_id     = $arr_all_items['item_id'];
				    
					$obj_item1->image1=$username.'/'.$arr_all_items['image1'];

					$obj_item1->image2=$username.'/'.$arr_all_items['image2'];

					$obj_item1->image3=$username.'/'.$arr_all_items['image3'];

					$obj_item1->image4=$username.'/'.$arr_all_items['image4'];
				 	
				 	$obj_item1->image5=$username.'/'.$arr_all_items['image5'];
				 //	$obj_item1->insertUpdateImage();
						    


						}
					}
					
	
		}
	
	}
  
     //create item class object
    