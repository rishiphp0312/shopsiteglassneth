<?php
/*
	    **************************** Creation Log *******************************
	    File Name                   -  class.dynamic.php
	    Module Name                 -  class
	    Project Name                -  Coupon Worm
	    Description                 -  display content dynamically, and this file will be used by smarty templates to display
	    							-  contents
	    Version                     -  
	    Created by                  -  Mahipal Adhikari 
	    Created on                  -  24-July-2009
		******************************** Update Log *************************************************************
		SNo		Version		Updated by			Updated on			Description
		*********************************************************************************************************
*/

class Class_Dynamic
{
	/**
	*	Truncate Long String.\
	*	Author: Mahipal Adhikari added on: 13 Nov 2009
	*	@param $string, $limit, $break, $pad
	*	return $string and $pad
	*/

  //  {$anObject->bid_history($val_items.item_id,$smarty.session.session_user_id) }
	function myTruncate($string, $limit, $break=" ", $pad="...") { 
		// return with no change if string is shorter than $limit  
		if(strlen($string) <= $limit) return $string; 
			$string = substr($string, 0, $limit);
			if(false !== ($breakpoint = strrpos($string, $break))) { 
			$string = substr($string, 0, $breakpoint); 
			} 
		return $string . $pad; 
	}
	function  buyer_username($buyer_id)
	{ $ObjClsDBInteraction = new class_dbconnector();
		{
                        //$objItem->item_id      =   $item_ids_hated ;
		$sSQL = "SELECT username FROM tbl_users where id =\"$buyer_id\"";
	    $objRecordSet = $ObjClsDBInteraction -> select($sSQL) or die("Error=>".mysql_error());
        $num_show_haated  =   mysql_num_rows($objRecordSet);
        if($num_show_haated>0){
		$arr_show_username = mysql_fetch_assoc($objRecordSet);
		$buyer_username    = $arr_show_username['username'];
		}
		        //echo '<br>';
			$ObjClsDBInteraction->connection_close();
			return $buyer_username;
                 }
        
	
	}
	function  chk_itemcustom($req_item_id)
	{ $ObjClsDBInteraction = new class_dbconnector();
		{
                        //$objItem->item_id      =   $item_ids_hated ;
		$sSQL = "SELECT paid_amount FROM tbl_custom_request where id =\"$req_item_id\"";
	    $objRecordSet = $ObjClsDBInteraction -> select($sSQL) or die("Error=>".mysql_error());
        $num_show_haated  =   mysql_num_rows($objRecordSet);
        if($num_show_haated>0){
		$arr_show_username = mysql_fetch_assoc($objRecordSet);
		$paid_amount    = $arr_show_username['paid_amount'];
		}
		        //echo '<br>';
			$ObjClsDBInteraction->connection_close();
			return $paid_amount;
                 }
        
	
	}
        function home_pageHaatedItems($item_id)
        {        $ObjClsDBInteraction = new class_dbconnector();
		{
                        //$objItem->item_id      =   $item_ids_hated ;
		$sSQL = "SELECT * FROM tbl_user_hatting_details where bid_status=1 AND item_id =\"$item_id\"";
	        $objRecordSet = $ObjClsDBInteraction -> select($sSQL) or die("Error=>".mysql_error());
                $num_show_haated  =   mysql_num_rows($objRecordSet);
                //echo '<br>';
			$ObjClsDBInteraction->connection_close();
			return $num_show_haated;
                 }
        
        }

	function bid_history($item_id,$user_id) { 
		$ObjClsDBInteraction = new class_dbconnector();
		{
			$item_id = $item_id;
			 $str='';
			$sSQL ="SELECT cost_posted,DATE_FORMAT(add_date, '%d %M %Y') as date_for
 FROM tbl_user_hatting_details WHERE item_id ='$item_id' and user_id='$user_id' order by add_date desc";
			
			//echo $sSQL . ";<br><br><br>";
			$objRecordSet = $ObjClsDBInteraction -> select($sSQL) or die("Error=>".mysql_error());
			while($resArrRow = mysql_fetch_array($objRecordSet))
			    {
				
			       $str.= '$ '.$resArrRow['cost_posted'].' -- '.$resArrRow['date_for'].'<br>';
			
			    }
			$ObjClsDBInteraction->connection_close();
				return $str;
		}
	}
        function custom_item_id_quantitypurchased($cust_id)
		{
		$ObjClsDBInteraction = new class_dbconnector();
		{
			$item_id = $cust_id;
			 $str='';
			$sSQL ="SELECT quantity_available   FROM tbl_item_details WHERE request_item_id ='$item_id' ";

			//echo $sSQL . ";<br><br><br>";
			$objRecordSet = $ObjClsDBInteraction -> select($sSQL) or die("Error=>".mysql_error());
			while($resArrRow = mysql_fetch_array($objRecordSet))
			    {

			       $str= $resArrRow['quantity_available'];

			    }
			$ObjClsDBInteraction->connection_close();
				return $str;
		    }
		}

        function custom_item_id($cust_id) {
		$ObjClsDBInteraction = new class_dbconnector();
		{
			$item_id = $cust_id;
			 $str='';
			$sSQL ="SELECT item_id   FROM tbl_item_details WHERE request_item_id ='$item_id' ";

			//echo $sSQL . ";<br><br><br>";
			$objRecordSet = $ObjClsDBInteraction -> select($sSQL) or die("Error=>".mysql_error());
			while($resArrRow = mysql_fetch_array($objRecordSet))
			    {

			       $str= $resArrRow['item_id'];

			    }
			$ObjClsDBInteraction->connection_close();
				return $str;
		}
	}

	function ship_status($trans_id) { 
		$ObjClsDBInteraction = new class_dbconnector();
		{

		$item_id = $trans_id;
			 $str='';
		 $sSQL ="SELECT ship_status,ship_service,date_add  FROM tbl_shipping_detail WHERE last_trans_id ='$trans_id' ";
			
			//echo $sSQL . ";<br><br><br>";
			$objRecordSet = $ObjClsDBInteraction -> select($sSQL) or die("Error=>".mysql_error());
			while($resArrRow = mysql_fetch_array($objRecordSet))
			    {
				
			       $str= $resArrRow['ship_status'];
			
			    }
			$ObjClsDBInteraction->connection_close();
				return $str;
		}
	}
	function ship_service($trans_id) { 
		$ObjClsDBInteraction = new class_dbconnector();
		{
			$item_id = $item_id;
			 $str='';
			$sSQL ="SELECT ship_service,date_add  FROM tbl_shipping_detail WHERE last_trans_id ='$trans_id' ";
			
			//echo $sSQL . ";<br><br><br>";
			$objRecordSet = $ObjClsDBInteraction -> select($sSQL) or die("Error=>".mysql_error());
			while($resArrRow = mysql_fetch_array($objRecordSet))
			    {
				
			       $str= $resArrRow['ship_service'];
			
			    }
			$ObjClsDBInteraction->connection_close();
				return $str;
		}
	}
	function ship_date_started($trans_id) { 
		$ObjClsDBInteraction = new class_dbconnector();
		{
			$item_id = $item_id;
			 $str='';
			$sSQL ="SELECT date_add  FROM tbl_shipping_detail WHERE last_trans_id ='$trans_id' ";
			
			//echo $sSQL . ";<br><br><br>";
			$objRecordSet = $ObjClsDBInteraction -> select($sSQL) or die("Error=>".mysql_error());
			while($resArrRow = mysql_fetch_array($objRecordSet))
			    {
				
			       $str= $resArrRow['date_add'];
			
			    }
			$ObjClsDBInteraction->connection_close();
				return $str;
		}
	}
	//select admin email ID
	function selectAdminMail()
	{
		$ObjClsDBInteraction = new class_dbconnector();
		$admin_user_id = 1;
		$sSQL ="SELECT admin_email FROM admin_user WHERE admin_user_id IS NOT NULL";
		if(isset($admin_user_id) && $admin_user_id !="")
		{
			$sSQL .= " AND admin_user_id  = $admin_user_id ";
		}
		//echo $sSQL . ";<br><br><br>";
		$objRecordSet = $ObjClsDBInteraction -> select($sSQL) or die("Error=>".mysql_error());
		$resArrRow = mysql_fetch_array($objRecordSet);
		$ObjClsDBInteraction->connection_close();
		
		return $resArrRow['admin_email'];
	}
	
	
	//function to get users total number of saved properties
	function getUserCountProperty()
	{
		$ObjClsDBInteraction = new class_dbconnector();
		if(isset($_SESSION['session_user_id']))
		{
			$user_id = $_SESSION['session_user_id'];
			$sSQL ="SELECT COUNT(id) AS user_property_count FROM tbl_users_property WHERE user_id IS NOT NULL";
			if(isset($user_id) && $user_id !="")
			{
				$sSQL .= " AND user_id  = $user_id ";
			}
			//echo $sSQL . ";<br><br><br>";
			$objRecordSet = $ObjClsDBInteraction -> select($sSQL) or die("Error=>".mysql_error());
			$resArrRow = mysql_fetch_array($objRecordSet);
			$ObjClsDBInteraction->connection_close();
			if($resArrRow['user_property_count'] > 0)
			{
				return $resArrRow['user_property_count'];
			}
			else
			{
				return 0;
			}	
		}
	}
	
	//function to get all active sub-categories
	function getCategories()
	{
		$ObjClsDBInteraction = new class_dbconnector();
		
		$sSQL ="SELECT category_id, name FROM tbl_category_master WHERE status=1";
		if(isset($category_id) && $category_id !="")
		{
			$sSQL .= " AND category_id = $category_id ";
		}
		$sSQL .= " AND parent_id!=0"; //do not display parent main categories
		$sSQL .= " ORDER BY name";
		//echo $sSQL . ";<br><br><br>";
		$objRecordSet = $ObjClsDBInteraction -> select($sSQL) or die("Error=>".mysql_error());
		$categories = array();
		while($resArrRow = mysql_fetch_array($objRecordSet))
		{
			$categories[] = $resArrRow;
		}
		$ObjClsDBInteraction->connection_close();
		return $categories;
	}
	//function to get all active categories
	function getAllCategories()
	{
		$ObjClsDBInteraction = new class_dbconnector();
		
		$sSQL ="SELECT category_id, parent_id, name FROM tbl_category_master WHERE status=1";
		if(isset($category_id) && $category_id !="")
		{
			$sSQL .= " AND category_id = $category_id ";
		}
		$sSQL .= " ORDER BY name";
		//echo $sSQL . ";<br><br><br>";
		$objRecordSet = $ObjClsDBInteraction -> select($sSQL) or die("Error=>".mysql_error());
		$categories = array();
		while($resArrRow = mysql_fetch_array($objRecordSet))
		{
			//$categories[] = $resArrRow;
			 $categories[$resArrRow['category_id']] = array('name'=>$resArrRow['name'], 'parent'=>$resArrRow['parent_id']);
		}
		$ObjClsDBInteraction->connection_close();
		return $categories;
	}
	//convert numbers
	//This function will conver 1000 to 1K or 2000 to 2k and so on
	function convert_number($x)
	{
		if(is_numeric($x))
		{
			if($x < 1000)
			{
			  return $x;  //return number if less than 1000
			}
			else if($x >1000 & $x<1000000)
			{
				$x = preg_replace("/[^0-9]/","",$x);
				$x = $x / 1000 . 'K'; 
				return $x;
			}
			else if ($x >1000000 & $x<100000000)
			{
				$x = preg_replace("/[^0-9]/","",$x);
				$x = $x / 1000000 . 'M'; 
				return $x;
			}
			else
			{
				$x = preg_replace("/[^0-9]/","",$x);
				$x = $x / 100000000 . 'B'; 
				return $x;
			}	
		}
		else
		{
			$x = $x .'is not a number';
			return $x;
		}
	}
	
	//get countries list
	function selectCountry()
	{
		$ObjClsDBInteraction = new class_dbconnector();
		$sSQL ="SELECT id, country,country_iso_code_2 FROM tbl_country_master WHERE status=1 ";
		if($this->id!='')
		{
		$sSQL .=" AND id ='$this->id'";
		}
		if($this->country_code!='')
		{
		$sSQL .=" AND country_iso_code_2='$this->country_code'";
		}
		
		$sSQL .= " ORDER BY country";
		//echo $sSQL . ";<br><br><br>";
		$objRecordSet = $ObjClsDBInteraction -> select($sSQL) or die("Error=>".mysql_error());
		$ObjClsDBInteraction->connection_close();
		return $objRecordSet;
	}
	
	
	function fetchitem_sold_date($last_id)
	{
		$ObjClsDBInteraction = new class_dbconnector();
		$sSQL ="SELECT purchase_date FROM tbl_buyer_purchased_item WHERE id=\"$last_id\" ";
	
		
		 $objRecordSet = $ObjClsDBInteraction->select($sSQL)or die("Error=>".mysql_error());         $resArrRow = mysql_fetch_array($objRecordSet);
		{
			$purchase_date  = $resArrRow['purchase_date'];
		}
		$ObjClsDBInteraction->connection_close();
		return $purchase_date;
		}
	
		function fetchCountryfromcode($country_code)
	{
		$ObjClsDBInteraction = new class_dbconnector();
		$sSQL ="SELECT id, country,country_iso_code_2 FROM tbl_country_master WHERE status=1 ";
		if($this->id!='')
		{
		$sSQL .=" AND id ='$this->id'";
		}
		if($country_code!='')
		{
		$sSQL .=" AND country_iso_code_2='$country_code'";
		}
		//echo $sSQL;
		 $objRecordSet = $ObjClsDBInteraction->select($sSQL)or die("Error=>".mysql_error());         $resArrRow = mysql_fetch_array($objRecordSet);
		{
			$country_name  = $resArrRow['country'];
		}
		$ObjClsDBInteraction->connection_close();
		return $country_name;
		}
	
	
	function selectCountryCurrency()
	{
		//set default currency code if currency code is null for a country
		$currency_code = "USD";
		$ObjClsDBInteraction = new class_dbconnector();
		$sSQL ="SELECT id, country, country_iso_code_2, currency_code FROM tbl_country_master";
		$sSQL .= " WHERE status=1 AND currency_code IS NOT NULL";
		if(isset($this->country_code) && $this->country_code!='')
		{
			$sSQL .=" AND country_iso_code_2 ='$this->country_code'";
		}		
		$sSQL .= " ORDER BY country_iso_code_2 ";
		 $sSQL . ";<br><br><br>";
		$objRecordSet = $ObjClsDBInteraction->select($sSQL);
		
		if(mysql_num_rows($objRecordSet)>0)
		{
			$resArr = mysql_fetch_array($objRecordSet);
			$currency_code = $resArr['currency_code'];
		}
                //echo 'currency-code'.$currency_code;
		$ObjClsDBInteraction->connection_close();
		return $currency_code;
	}
}//end of class
?>