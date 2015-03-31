<?php
include ("common_includes.php");
include ("../include/adminsession.php.inc");
include ("../class/class.item.inc");
include ("../class/class.user.inc");

include ("../class/class.category.inc");
			$objItem		 = new Class_Item();
			$objUser         = new Class_User();
			$objCategory = new Class_Category();
						
			$objCategory = new Class_Category();
			//echo 'val-'.$_GET['val_main'];
		 //get parent categories to create drop down
		  
		    if($_GET['val_main']!='' && $_GET['val_main']!=0 )
			$objCategory->parent_id=$_GET['val_main'];
			else
			$smarty->assign("Novalue",'1');
			
			$CatgeoryRes11 = $objCategory->selectCatgeory1();
			while($SubCatgeoryRes11 = mysql_fetch_array($CatgeoryRes11))
			{
				$SubCatID1[]   = $SubCatgeoryRes11['category_id'];
				$SubCatNAME1[] = $SubCatgeoryRes11['name'];
			}
			//print_r($parentNAME);
			$smarty->assign("SubCatID1",$SubCatID1);
			$smarty->assign("SubCatNAME1",$SubCatNAME1);
			 $smarty->display('ajax_code.tpl');	
?>