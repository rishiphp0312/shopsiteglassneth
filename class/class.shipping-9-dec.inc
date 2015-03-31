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

class Class_Shipping
{
	
 //tbl_ship_item_countries`
 
 function getshippingdetails_withspecificcountries()
	{/*
		$obj_con = new class_dbconnector();
		$sSQL = " SELECT * FROM  tbl_ship_item_countries  s , tbl_item_details  i WHERE i.item_id= s.item_id  ";
		
               if(isset($this->buyer_id) && $this->buyer_id!="")
		{
			$sSQL .=" AND buyer_id= $this->buyer_id ";
		}
		 if(isset($this->ship_id) && $this->ship_id!="")
		{
			$sSQL .=" AND ship_id= $this->ship_id ";
		}

              if(isset($this->seller_id) && $this->seller_id!="")
		{
			$sSQL .=" AND seller_id= $this->seller_id ";
		}
        $sSQL .=' order by s.ship_id desc ';
	       
	       if(isset($this->pageLimit) && $this->pageLimit!="")
		{
			$sSQL .= $this->pageLimit;
		}
 $sSQL ;
	
		
		$RecordSet = $obj_con->select($sSQL);
		$obj_con->connection_close();
		return $RecordSet;

	*/}
	
	function getshippingdetails()
	{
		$obj_con = new class_dbconnector();
                $sSQL =  " SELECT * FROM  tbl_shipping_detail  s ,tbl_item_details  i,tbl_country_master
                    cm,tbl_users u WHERE i.item_id= s.item_id and i.seller_id = u.id and
                   (cm.country_iso_code_2 = s.country_code ) ";

                 if(isset($this->username) && $this->username!="")
		 {
		 $sSQL .=" AND u.username= \"$this->username\" ";
		 }
                 if(isset($this->shipping_cost) && $this->shipping_cost!="")
		 {
		 $sSQL .=" AND s.shipping_cost= '$this->shipping_cost' ";
		 }
                 if(isset($this->sel_days))
	         {
	          $sSQL.= "  AND EXTRACT(DAY FROM s.date_add) = '$this->sel_days' ";
	         }

	         if(isset($this->purchased_date)&& $this->purchased_date==1)
	         {
	         $sSQL .= " AND ( EXTRACT(YEAR FROM s.date_add)='$this->sel_year' AND  EXTRACT(MONTH FROM  s.date_add) ='$this->sel_month') " ;
	          }
                 if(isset($this->buyer_id) && $this->buyer_id!="")
		 {
		$sSQL .=" AND buyer_id= $this->buyer_id ";
		 }
                 if(isset($this->title) && $this->title!="")
		 {
		$sSQL .=" AND i.title= \"$this->title\"";
		 }

		if(isset($this->ship_id) && $this->ship_id!="")
		{
		$sSQL .=" AND ship_id= $this->ship_id ";
		}
                if(isset($this->country_value) && $this->country_value!="")
		{
		$sSQL .=" AND cm.id= '$this->country_value' ";
		}
                if(isset($this->Zipcode) && $this->Zipcode!="")
		{
		$sSQL .=" AND s.dest_zip_code = '$this->Zipcode' ";
		}

                if(isset($this->city) && $this->city!="")
		{
		$sSQL .=" AND s.city= '$this->city' ";
		}
                 if(isset($this->ship_status) && $this->ship_status!=0)
		{

                 if($this->ship_status==1)
                         $ship_val =2;// deliveerd
                 else if($this->ship_status==2)
                         $ship_val = 0;//  pending
                 else if($this->ship_status==3)
                         $ship_val = 1;//in process

	 	$sSQL .=" AND s.ship_status = '$ship_val' ";
		}
		

                if(isset($this->seller_id) && $this->seller_id!="")
		{
		$sSQL .=" AND i.seller_id= $this->seller_id ";
		}
              //   $sSQL .='  s.ship_id desc ';
                $sSQL .=' order by s.ship_id desc ';
	       
	        if(isset($this->pageLimit) && $this->pageLimit!="")
		{
		$sSQL .= $this->pageLimit;
		}
                //echo $sSQL ;
	
		
		$RecordSet = $obj_con->select($sSQL);
		$obj_con->connection_close();
		return $RecordSet;

	}
	
	function deleteshipping_options()
	{
	//echo 'noid='.$this->id;
		$ObjClsDBInteraction = new class_dbconnector();
		$sSQL ="DELETE FROM tbl_ship_item_countries WHERE 1=1 ";
		if(isset($this->item_value)&& $this->item_value!='')
		{
			$sSQL .=" and item_id='$this->item_value'"; 
		}
		
		if(isset($this->ship_id)&& $this->ship_id!='')
		{
		$sSQL .=" and ship_id='$this->ship_id' ";
		}
	//	echo $sSQL;

		$objRecordSet = $ObjClsDBInteraction->select( $sSQL );
		$ObjClsDBInteraction->connection_close();
		return $nReturnValue;
	}
	function getshippingOptionsdetails()
	{
		$obj_con = new class_dbconnector();
		$sSQL = " SELECT *,s.cost_ship as ship_cost_country FROM  tbl_ship_item_countries  s , tbl_item_details  i,tbl_country_master cm WHERE i.item_id= s.item_id and s.country_id=cm.id   ";
		
         if(isset($this->item_value) && $this->item_value!="")
		{
			$sSQL .=" AND s.item_id= $this->item_value ";
		}
		 if(isset($this->buyer_id) && $this->buyer_id!="")
		{
			$sSQL .=" AND buyer_id= $this->buyer_id ";
		}
		 if(isset($this->ship_id) && $this->ship_id!="")
		{
			$sSQL .=" AND ship_id= $this->ship_id ";
		}

         if(isset($this->seller_id) && $this->seller_id!="")
		{
			$sSQL .=" AND seller_id= $this->seller_id ";
		}
        $sSQL .=' order by s.ship_id desc ';
	       
	    if(isset($this->pageLimit) && $this->pageLimit!="")
		{
			$sSQL .= $this->pageLimit;
		}
       $sSQL ;
	
		
		$RecordSet = $obj_con->select($sSQL);
		$obj_con->connection_close();
		return $RecordSet;

	}
		
	function insertUpdateshipping_options()
	{
		$ObjClsDBInteraction = new class_dbconnector();
		
		if(isset($this->user_id))
		$arr["user_id"]			        = $this->user_id;
		
		if(isset($this->cost_ship))
		$arr["cost_ship"]			    = $this->cost_ship;
		
		if(isset($this->comment))
		$arr["comment"]					= $this->comment;
		
		if(isset($this->item_value))
		$arr["item_id"]			        = $this->item_value;
							
		if(isset($this->total_cost))
		$arr["total_cost"]			    = $this->total_cost;
		
		if(isset($this->country_id))
		$arr["country_id"]			    = $this->country_id;
			       
	    if(isset($this->date_add))
	    $arr["date_add"] = date("Y-m-d H:i:s");
		
		if(isset($this->ship_id) && $this->ship_id!="")
		{
		$sWhere = " ship_id = '$this->ship_id'";
		$nReturnValue = $ObjClsDBInteraction->insertUpdate("tbl_ship_item_countries", $arr, $sWhere);
		}
		else
		{		
			    $arr["date_add"] = date("Y-m-d H:i:s");	
		$nReturnValue = $ObjClsDBInteraction->insertUpdate("tbl_ship_item_countries", $arr, null);	
		}
		$nReturnValue ;
		//exit;
		$ObjClsDBInteraction->connection_close();
		return $nReturnValue;
	
	
	}
	function insertUpdateshipping()
	{
		$ObjClsDBInteraction = new class_dbconnector();



		if(isset($this->shipping_cost))
		$arr["shipping_cost"]			= $this->shipping_cost;
		
		if(isset($this->comment))
		$arr["comment"]					= $this->comment;
		
		if(isset($this->ship_service))
		$arr["ship_service"]			= $this->ship_service;
		
		if(isset($this->date_add))
		$arr["date_add"]			= $this->date_add;
						
		if(isset($this->total_cost))
		$arr["total_cost"]			   = $this->total_cost;
		
		if(isset($this->buyer_id))
		$arr["buyer_id"]			   = $this->buyer_id;
		
		if(isset($this->item_id))
		$arr["item_id"]			        = $this->item_id;

		if(isset($this->shipping_address1))
		$arr["shipping_address1"]		= $this->shipping_address1;

		if(isset($this->shipping_address2))
		$arr["shipping_address2"]		= $this->shipping_address2;

		if(isset($this->dest_zip_code))
		$arr["dest_zip_code"]		        = $this->dest_zip_code;

		if(isset($this->country_code))
		$arr["country_code"]	                = $this->country_code;

		if(isset($this->city))
		$arr["city"]		                = $this->city;

                if(isset($this->billing_address1))
		$arr["billing_address1"]		= $this->billing_address1;

		if(isset($this->billing_address2))
		$arr["billing_address2"]		= $this->billing_address2;

		if(isset($this->bdest_zip_code))
		$arr["bdest_zip_code"]		        = $this->bdest_zip_code;

		if(isset($this->bcountry_code))
		$arr["bcountry_code"]	                = $this->bcountry_code;

		if(isset($this->bcity))
		$arr["bcity"]		                = $this->bcity;


                if(isset($this->quantity))
		$arr["quantity"]		        = $this->quantity;

		if(isset($this->ship_type))
		$arr["ship_type"]		        = $this->ship_type;

		if(isset($this->ship_status))
		$arr["ship_status"]		        = $this->ship_status;

		if(isset($this->last_trans_id))
		$arr["last_trans_id"]		        = $this->last_trans_id;
         
                if(isset($this->date_add) && $this->date_add==1)
		$arr["date_add"] = date("Y-m-d H:i:s");
		
		if(isset($this->ship_id) && $this->ship_id!="")
		{
			$sWhere = " ship_id = '$this->ship_id'";
			$nReturnValue = $ObjClsDBInteraction->insertUpdate("tbl_shipping_detail", $arr, $sWhere);
		}
		else
		{
			
			$nReturnValue = $ObjClsDBInteraction->insertUpdate("tbl_shipping_detail", $arr, null);	
		}
		$nReturnValue ;
		//exit;
		$ObjClsDBInteraction->connection_close();
		return $nReturnValue;
	}

function makeconfirmshipping() // when delivered finaly
	{
		$ObjClsDBInteraction = new class_dbconnector();
				
		if(isset($this->ship_status))
		$arr["ship_status"]		        = $this->ship_status;
		
		if(isset($this->last_trans_id) && $this->last_trans_id!="")
		{
		$sWhere = " last_trans_id = '$this->last_trans_id'";
		$nReturnValue = $ObjClsDBInteraction->insertUpdate("tbl_shipping_detail",$arr,$sWhere);
		}
		else
		{
		$nReturnValue = $ObjClsDBInteraction->insertUpdate("tbl_shipping_detail", $arr, null);		}
		$nReturnValue ;
		//exit;
		$ObjClsDBInteraction->connection_close();
		return $nReturnValue;
	}
	

	
	
}
//end of class
?>
