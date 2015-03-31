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

class Class_Package
{

//function delete package
	function deletepackage()
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

//Function Insert/Update Package
	function insertUpdatePurchase_Package()
	{
		$ObjClsDBInteraction       = new class_dbconnector();
                // status
                if(isset($this->status) )
		$arr["status"]   	    = $this->status;

                if(isset($this->trans_id) && $this->trans_id!='')
		$arr["trans_id"]   	    = $this->trans_id;

                if(isset($this->seller_id))
		$arr["seller_id"]   	    = $this->seller_id;

                if(isset($this->values_returned) && $this->values_returned!='')
		$arr["values_returned"]     = $this->values_returned;
                
                if(isset($this->package_name))
		$arr["pack_name"]           = $this->package_name;

                if(isset($this->min_items))
		$arr["min_items"]           = $this->min_items;

                if(isset($this->max_items))
		$arr["max_items"]           = $this->max_items;

                if(isset($this->payment_status))
		$arr["payment_status"]	    = $this->payment_status;
                		          	
                if(isset($this->expiry_date) && $this->expiry_date!='')
		$arr["expiry_date"]   	    = $this->expiry_date;

                if(isset($this->AVSCODE) && $this->AVSCODE!='')
		$arr["AVSCODE"]   	    = $this->AVSCODE;
                
                if(isset($this->CVV2MATCH) && $this->CVV2MATCH!='')
		$arr["CVV2MATCH"]   	    = $this->CVV2MATCH;

                if(isset($this->time_month) && $this->time_month!='')
		$arr["time_month"]   	    = $this->time_month;

                if(isset($this->amount))
		$arr["amount"]              = $this->amount;
        	
                if(isset($this->paymentmode))
		$arr["paymentmode"]   	    = $this->paymentmode;


		if(isset($this->pack_id) && $this->pack_id!="")
		{
		$sWhere       = " pack_id = '$this->pack_id'";
		$nReturnValue = $ObjClsDBInteraction->insertUpdate("tbl_purchase_package",$arr, $sWhere);
		}
		else
		{	
		$arr["date_purchased"] = date("Y-m-d H:i:s");
		$nReturnValue = $ObjClsDBInteraction->insertUpdate("tbl_purchase_package", $arr, null);
		}
	        $ObjClsDBInteraction->connection_close();
		return $nReturnValue;
	}//end of function

// function to search package 

function getPackagedetails()
{
        $obj_con = new class_dbconnector();
        $curnt_date = date('Y-m-d');

		$sSQL = " SELECT *,p.status as pack_status,u.id as user_id from tbl_purchase_package p,tbl_users u  where 1=1 and p.seller_id= u.id ";

         if(isset($this->pack_id) && $this->pack_id!='')
		 $sSQL .= " AND  p.pack_id='$this->pack_id'";

        if(isset($this->seller_id) && $this->seller_id!='')
		$sSQL .= " AND  p.seller_id='$this->seller_id'";
                
        if(isset($this->status)&& $this->status!='')
		$sSQL .= " AND  p.status='$this->status'";

        if(isset($this->package_cost)&& $this->package_cost!='')
		$sSQL .= " AND   p.amount = $this->package_cost ";


        if(isset($this->payment_status) && $this->payment_status!='')
		$sSQL .= " AND  p.payment_status='$this->payment_status'";

        if(isset($this->check_expiry) && $this->check_expiry==15)
		$sSQL .= " AND  DATE_SUB(p.expiry_date ,INTERVAL 15 DAY)  ='$curnt_date'";

         if(isset($this->check_expiry) && $this->check_expiry==2)
		$sSQL .= " AND  DATE_SUB(p.expiry_date ,INTERVAL 2 DAY)  ='$curnt_date'";


                if(isset($this->country_value)&& $this->country_value!='')
	        {
	         $sSQL.= "  AND u.country_id= '$this->country_value' ";
	        }
                if(isset($this->state)&& $this->state!='')
                {
                 $sSQL.= "  AND u.state= '$this->state' ";
                 }
                 if(isset($this->username)&& $this->username!='')
                 {
                 $sSQL.= "  AND u.username = '$this->username' ";
                 }
           
                if(isset($this->sel_days)&& $this->select_date==0 && isset($this->sel_month) && $this->sel_month!='')
                 {
                $sSQL.= "  AND EXTRACT(DAY FROM p.date_purchased) = '$this->sel_days' ";
                 }
                if(isset($this->sel_days)&& $this->select_date==1 && isset($this->sel_month) && $this->sel_month!='')
                 {
                $sSQL.= "  AND EXTRACT(DAY FROM p.expiry_date) = '$this->sel_days' ";
                 }
                  
                //if(isset($this->purchased_date)&& $this->purchased_date==1&& $this->select_date==0)
                 if(isset($this->sel_month)&& $this->sel_month!='' && $this->select_date==0)
                 {
	        $sSQL .= "  AND  EXTRACT(MONTH FROM p.date_purchased)='$this->sel_month' " ;
                 }

                if(isset($this->sel_month)&& $this->sel_month!='' && $this->select_date==1)
                 {
                $sSQL.= "  AND EXTRACT(MONTH FROM p.expiry_date) = '$this->sel_month' ";
                 }

                 if(isset($this->sel_year)&& $this->sel_year!=''&& $this->select_date==0)
                 {
	        $sSQL .= " AND EXTRACT(YEAR FROM  p.date_purchased)='$this->sel_year'  " ;
                 }
                 if(isset($this->sel_year)&& $this->sel_year!='' && $this->select_date==1)
                 {
                $sSQL.= "  AND EXTRACT(YEAR FROM p.expiry_date) = '$this->sel_year' ";
                 }


           /* if(isset($this->purchased_date)&& $this->purchased_date==1&& $this->select_date==1)
                    {
	  $sSQL .= " AND ( EXTRACT(YEAR FROM  p.expiry_date) =
	  '$this->sel_year' AND  EXTRACT(MONTH FROM p.expiry_date)='$this->sel_month') " ;
                        }
*/
                        //
        if(isset($this->check_expiry) && $this->check_expiry==1)
		$sSQL .= " AND  p.expiry_date ='$curnt_date'";

                //$check_expiry
                $sSQL .=' order by p.pack_id desc ';
                 //$arr["seller_id"]   		= $this->seller_id;
                if(isset($this->pageLimit) && $this->pageLimit!="")
                {
                    $sSQL .= $this->pageLimit;
                }
               //    echo
          // echo $sSQL;
          // echo '<br>';
               //if(isset($this->type_discout))
		//$arr["discount_type"]   		= $this->type_discout;
             //   echo  $sSQL;
		$RecordSet = $obj_con->select($sSQL);
		$obj_con->connection_close();
		return $RecordSet;
	}

// end of function











}

?>









