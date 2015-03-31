<?php
/*
	    **************************** Creation Log ***************************************************************
	    File Name                   -  class.user.inc
	    Module Name                 -  class
	    Project Name                -  
	    Description                 -  Contain all functon for users
	    Version                     -  
	    Created by                  - 	Mahipal Adhikari 
	    Created on                  -   6-May-2010
		******************************** Update Log *************************************************************
		SNo		Version		Updated by			Updated on			Description
		*********************************************************************************************************
*/

class Class_Coupon
{ 

//function delete coupon codes 
	function deletepreviousCoupon()
	{
		$ObjClsDBInteraction = new class_dbconnector();
		
		if(isset($this->del_item_id))
		{
			$sSQL ="DELETE  FROM tbl_genrate_coupon  WHERE item_id='$this->del_item_id'"; 
		}
		 $sSQL;
		
		$objRecordSet = $ObjClsDBInteraction->select( $sSQL );
		$ObjClsDBInteraction->connection_close();
		return $nReturnValue;
	}//end of function


      //  Function Insert/Update coupon status=0 when send to haat
	function insertUpdateCouponStatus()
	{
		$ObjClsDBInteraction = new class_dbconnector();

		if(isset($this->coupon_status))
		$arr["coupon_status"]          = $this->coupon_status;
                //print_r($arr);exit;
		if(isset($this->item_id) && $this->item_id!="")
		{
			 $sWhere               = " item_id = '$this->item_id'";
			// $arr["coupon_date"] = date("Y-m-d H:i:s");
			 $nReturnValue = $ObjClsDBInteraction->insertUpdate("tbl_genrate_coupon", $arr, $sWhere);
		}
		else
		{
		       //$arr["bid_status"]   		 	= 0; // inactive product
        		//$arr["coupon_date"] = date("Y-m-d H:i:s");
			$nReturnValue = $ObjClsDBInteraction->insertUpdate("tbl_genrate_coupon", $arr, null);
		}
	         	$ObjClsDBInteraction->connection_close();
		return $nReturnValue;
	}//end of function



//Function Insert/Update coupon 
	function insertUpdateCoupon()
	{  
		$ObjClsDBInteraction = new class_dbconnector();
		
		if(isset($this->start_date))
		$arr["start_date"]   		        = $this->start_date;

		if(isset($this->end_date))
		$arr["end_date"]   		        = $this->end_date;
		
		if(isset($this->available_items_id))
		$arr["item_id"]   		        = $this->available_items_id;

                
		if(isset($this->type_discout))
		$arr["discount_type"]   		= $this->type_discout;


		if(isset($this->coupon_code) && $this->coupon_code!='')
		$arr["coupon_code"]   		        = $this->coupon_code;
		
		if(isset($this->seller_id) && $this->seller_id!='')
		$arr["seller_id"]   		        = $this->seller_id;
		
		
		if(isset($this->discount_amount) && $this->discount_amount!='')
		$arr["discount_amount"]   		= $this->discount_amount;
	
		if(isset($this->coupon_id) && $this->coupon_id!="")
		{
		
			 $sWhere                       = " coupon_id = '$this->coupon_id'";
			 $arr["coupon_date"] = date("Y-m-d H:i:s"); 
			 $nReturnValue = $ObjClsDBInteraction->insertUpdate("tbl_genrate_coupon", $arr, $sWhere);
		
		
		}
		else
		{   
		
		
		       //$arr["bid_status"]   		 	= 0; // inactive product
			
			$arr["coupon_date"] = date("Y-m-d H:i:s"); 
			$nReturnValue = $ObjClsDBInteraction->insertUpdate("tbl_genrate_coupon", $arr, null);
			
		}
	         	$ObjClsDBInteraction->connection_close();
		return $nReturnValue;
	}//end of function

// function to search records according to valid coupon code for buyer

function getCouponProductsSearch() 
{
	
	//SELECT * FROM `tbl_genrate_coupon` WHERE `coupon_code` = 'egjl1467' AND NOW( ) > `start_date`
//AND NOW( ) < `end_date`  $obj_con = new class_dbconnector();
 
 
	

		$sSQL = " SELECT * FROM   `tbl_genrate_coupon`  where 1=1     ";
		
	
	     

		 if(isset($this->coupon_code) )
		{
		$sSQL.= "   AND 	coupon_code ='$this->coupon_code'";
		}
	
		
		$sSQL.= "   AND 	( NOW() >=start_date' and NOW() =<end_date )";
		
		
		
		
	
	      
      $sSQL;
	
	
		$RecordSet = $obj_con->select($sSQL);
		$obj_con->connection_close();
		return $RecordSet;
	} 

// end of function



function getCouponExsistence() 
{
	
		 $obj_con = new class_dbconnector();
 
 
	

		$sSQL = " SELECT * FROM   `tbl_genrate_coupon`  where 1=1     ";
		
	
	       
	       if(isset($this->available_items_id) )
		{
		$sSQL.= "   AND 	item_id ='$this->available_items_id'";
		}
	
		if(isset($this->start_date) )
		{
		$sSQL.= "   AND 	((start_date  between '$this->start_date' and  '$this->end_date')";
		}
	        if(isset($this->end_date) )
		{
		$sSQL.= "   OR	(end_date  between '$this->start_date' and  '$this->end_date'))";
		}
		
	
	      
   $sSQL;
	
	
		$RecordSet = $obj_con->select($sSQL);
		$obj_con->connection_close();
		return $RecordSet;
	} 

// end of function




// function to know whther coupon  exsist or not 
function getCouponDetails() 
{
	
		 $obj_con = new class_dbconnector();
 
 
	

		$sSQL = " SELECT * FROM   `tbl_genrate_coupon`  where 1=1     ";
		
		if(isset($this->coupon_code))
		{
			$sSQL.= "  AND 	coupon_code='$this->coupon_code'";
		}
	
		
	
	      
         $sSQL;
	
	
		$RecordSet = $obj_con->select($sSQL);
		$obj_con->connection_close();
		return $RecordSet;
	} 

// end of function

// function to know whther coupon expires or not   exsist or not 
function getCouponDetails_expiredornot() 
{
	
		 $obj_con = new class_dbconnector();
 
              
	

		$sSQL = " SELECT * FROM   `tbl_genrate_coupon` 
		where 1=1  and  DATE(NOW())>=start_date and  DATE(NOW())<= end_date   ";
		
		if(isset($this->coupon_code))
		{
			$sSQL.= "  AND 	coupon_code='$this->coupon_code'";
		}
		if(isset($this->coupon_status))
		{
			$sSQL.= "  AND 	coupon_status='$this->coupon_status'";
		}

	
		if(isset($this->item_id))
		{
			$sSQL.= "  AND 	item_id='$this->item_id'";
		}
	
	      
               // echo $sSQL;
	
	//exit;
		$RecordSet = $obj_con->select($sSQL);
		$obj_con->connection_close();
		return $RecordSet;
	} 

}

?>
  
  
  
  





