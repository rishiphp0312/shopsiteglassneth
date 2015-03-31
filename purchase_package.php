<?php
include ('include/common.inc');
include ('class/class.user.inc');
include ('class/class.item.inc');
include ("class/class.category.inc");
include ("include/authentiateUserLogin.php");
include ('class/class.package.inc');
//include ('include/Pagination.Class.php'); // For pagination


//assign static labels and heading



 $delete_item_value_id = $_REQUEST['delete_item_value'];// start here for delete code

 $objUser        = new Class_User();
 $objItem        = new Class_Item();
 $objCategory    = new Class_Category();
 $objPackage     =  new Class_Package();
 $str_show_cat_with_commisiion='';
$result_parent_cat_comm = $objCategory->selectParentCatgeory();
$num_parent_cat_comm    = mysql_num_rows($result_parent_cat_comm) ;
if($num_parent_cat_comm>0)
{
    while($arr_fetch_parent_categ = mysql_fetch_assoc($result_parent_cat_comm))
    {
        $str_show_cat_with_commisiion .= ucfirst($arr_fetch_parent_categ['name']).' = '.$arr_fetch_parent_categ['commision'].'%<br>';

    }

}
 $smarty->assign('str_show_cat_with_commisiion',$str_show_cat_with_commisiion);
//create object of Category class

$objResCatTotal = $objCategory->selectSlabs();
$num_rows       = mysql_num_rows($objResCatTotal);
if($num_rows>0)
{
  while($CateRow = mysql_fetch_array($objResCatTotal))
   {
     $slabList[] = $CateRow;
   }
}
        /////////----- purchase package---------////////

        $objPackage->seller_id = $_SESSION['session_user_id'];
        $objPackage->status    = 1;
        $result_package        = $objPackage->getPackagedetails();
        $num_rows_pacakage     = mysql_num_rows($result_package);
      //  $num_rows_pacakage=0;
        $smarty->assign('num_rows_pacakage',$num_rows_pacakage); // if =0
        if($num_rows_pacakage>0)
        {
          $arr_package_details = mysql_fetch_array($result_package);
          $pkg_max_items       = $arr_package_details['max_items'];
          $pkg_pack_name       = $arr_package_details['pack_name'];
          $pkg_exp_date        = $arr_package_details['expiry_date'];

        }
        //$pkg_max_items         =25;
        if($num_rows_pacakage>0)
        {
          $smarty->assign('pkg_max_items',$pkg_max_items);
          $smarty->assign('pkg_pack_name',$pkg_pack_name);
          $smarty->assign('pkg_exp_date',$pkg_exp_date);
        } // pkg_max_items if pkg active
        else
        {
          $smarty->assign('pkg_max_items',25);
          $smarty->assign('pkg_pack_name','Basic');
          $smarty->assign('pkg_exp_date','N/A');
         }// pkg_max_items if pkg active
        


        $objPackage->status        = 0;
        $result_package_exp        = $objPackage->getPackagedetails();
        $num_rows_pacakage_exp     = mysql_num_rows($result_package_exp);
       // $num_rows_pacakage_exp=0;
        $smarty->assign('num_rows_pacakage_exp',$num_rows_pacakage_exp); // if =0
        if($num_rows_pacakage_exp>0)
        {
          $arr_package_details_exp = mysql_fetch_array($result_package_exp);
          $pkg_max_items_exp       = $arr_package_details_exp['max_items'];
          $pkg_pack_name_exp       = $arr_package_details_exp['pack_name'];
          $pkg_exp_date_prev       = $arr_package_details_exp['expiry_date'];
       
        }
        if($num_rows_pacakage_exp>0)
        {
          $smarty->assign('pkg_max_items_exp',$pkg_max_items_exp);
          $smarty->assign('pkg_pack_name_exp',$pkg_pack_name_exp);
          $smarty->assign('pkg_exp_date_prev',$pkg_exp_date_prev);
        } // pkg_max_items if pkg active
        else
        {
          $smarty->assign('pkg_max_items_exp','');
          $smarty->assign('pkg_pack_name_exp','No Previous Package ');
          $smarty->assign('pkg_exp_date_prev','N/A');

          }// pkg_max_items if pkg active
         $smarty->assign('num_rows_pacakage_exp',$num_rows_pacakage_exp);

         // echo '<br>';
         // code below to get total no of items of sellers 
         $objItem->seller_id       =  $det_seller_id;
         $total_items_available    =  $objItem->select_total_items();
         $num_rows_items_available =  mysql_num_rows($total_items_available);
         $smarty->assign('num_rows_items_available',$num_rows_items_available); // if>25
         
         //$num_rows_items_available = 102;

         // echo 'num_rows_items_available_'.$num_rows_items_available;
         // echo '<br>';
         // echo 'pkg_max_'.$pkg_max_items;
         //  $objPackage     =

         //if($num_rows_pacakage==0 && $num_rows_items_available<25)
         //$msg_show = "Yours current plan is basic 0-25 items.";
         //if($num_rows_pacakage==0 && $num_rows_items_available>25)
         // $msg_show = "You need to purchase package.";
        //if($num_rows_pacakage==1 && $num_rows_items_available>$pkg_max_items)
           //     You can add {$pkg_max_items} items after purchasing package.

               
        // if($num_rows_pacakage==0 && $num_rows_items_available>=25)
          // {
             // failure_msg("Please purchase package to add more itemss!!");
              //redirect("purchase_package.php");
           //}
        // if($num_rows_pacakage==1 && $num_rows_items_available>=$pkg_max_items )
        //   {
         //     failure_msg("Please purchase package to add more itemss!!");
          //    redirect("purchase_package.php");
           //}
///////// purchase package

$smarty->assign("num_rows",$num_rows);
$smarty->assign("slabList",$slabList);
//get user details if user logged in
if(isset($_SESSION['session_user_id'])&& $_SESSION['session_user_id']!="")
{

      $objUser->id = $_SESSION['session_user_id'];
     
}

$smarty->assign("ListItem",'listItem_');
$smarty->assign("title_asc",'title_asc');
$smarty->assign("error_msg",$error_msg);
$smarty->assign("update_msg",$update_msg);

//display template
$smarty->assign('site_page_title','Purchase Package List');
$smarty->assign('site_title',$site_title);
$smarty->display('purchase_package.tpl');
?>
