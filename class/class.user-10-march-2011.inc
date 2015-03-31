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

class Class_User
{
//$details_item_value
   	function check_seller_buyerexsist()
	{
		$obj_con = new class_dbconnector();

		$sSQL = "SELECT * FROM `tbl_sellers_buyers` WHERE 1=1 AND
                ((sellers_id='$this->sellers_id' AND buyer_id='$this->buyer_id')OR
                (sellers_id='$this->buyer_id' AND buyer_id='$this->sellers_id' ) )";

                //echo  $sSQL;
                //exit;
		$RecordSet = $obj_con->select($sSQL);
		$obj_con->connection_close();
		return $RecordSet;

	}

	function getDetails_ofbuyersrequest()
	{
		$obj_con = new class_dbconnector();

		$sSQL = "SELECT * FROM tbl_sellers_buyers tsb,tbl_users tu  WHERE 1=1 AND
                (tsb.sellers_id='$this->sellers_id' ) and  tsb.request_status='$this->request_status' and  tsb.buyer_id= tu.id  ";

                //$sSQL =."";
               //  echo  $sSQL;
                //exit;
		$RecordSet = $obj_con->select($sSQL);
		$obj_con->connection_close();
		return $RecordSet;

	}
       	function getDetails_ofreportItem()
	{
		$obj_con = new class_dbconnector();

	//	$sSQL = "SELECT * FROM tbl_item_report tir , tbl_users tu , tbl_item_details tid
          //          WHERE 1=1 AND tir.buyer_id=tu.id AND tid.item_id = tir.item_id  ";

		$sSQL = "SELECT * FROM tbl_item_report tir , tbl_users tu , tbl_item_details tid
                  WHERE 1=1 AND tir.buyer_id=tu.id AND tid.item_id = tir.item_id  ";

                if(isset($this->reporter_id) && $this->reporter_id!="")
		{
		$sSQL .= " AND  tir.buyer_id='$this->reporter_id' ";
		}
               
                if(isset($this->item_id) && $this->item_id!="")
		{
		$sSQL .= " AND  tir.item_id='$this->item_id' ";
		}


                //$sSQL =."";
              //   echo  $sSQL;
                //exit;
		$RecordSet = $obj_con->select($sSQL);
		$obj_con->connection_close();
		return $RecordSet;

	}


function insertUpdate_reportItem()
{
		$ObjClsDBInteraction = new class_dbconnector();

		if(isset($this->reporter_id))
		$arr["buyer_id"]			= $this->reporter_id;

		if(isset($this->item_id))
		$arr["item_id"]			        = $this->item_id;

                if(isset($this->status))
		$arr["status"]			        = $this->status;

                if(isset($this->rep_id) && $this->rep_id!="" )
	        {                
		$sWhere = " rep_id = '$this->rep_id' ";
		$nReturnValue = $ObjClsDBInteraction->insertUpdate("tbl_item_report", $arr, $sWhere);
	        }else
                {
                $arr["rep_date"]			= date('Y-m-d H:i:s');
                $nReturnValue = $ObjClsDBInteraction->insertUpdate("tbl_item_report", $arr, $sWhere);
                }


	$nReturnValue ;


	$ObjClsDBInteraction->connection_close();
	return $nReturnValue;
}
function select_metaTags()
	{
		$obj_con = new class_dbconnector();

		$sSQL = "SELECT * FROM tbl_meta_tags  where 1=1 ";
                if(isset($this->page_id) && $this->page_id!="")
		{
		$sSQL .= "AND  page_name ='$this->page_id' ";
		}
                if(isset($this->meta_id) && $this->meta_id!="")
		{
		$sSQL .= "AND  meta_id ='$this->meta_id' ";
		}

              // echo  $sSQL;
               //exit;
		$RecordSet = $obj_con->select($sSQL);
		$obj_con->connection_close();
		return $RecordSet;

	}
	//function delete meta tag
	function deleteMetaTaglisting()
	{
		$ObjClsDBInteraction = new class_dbconnector();

		if(isset($this->meta_id)&& $this->meta_id!='')
		{
			$sSQL ="DELETE FROM tbl_meta_tags WHERE meta_id='$this->meta_id'";
		}
		$objRecordSet = $ObjClsDBInteraction->select( $sSQL );
		$ObjClsDBInteraction->connection_close();
		return $nReturnValue;
	}//end of function
function insertUpdate_metaTags()
{
		$ObjClsDBInteraction = new class_dbconnector();

		if(isset($this->page_name))
		$arr["page_name"]			= $this->page_name;
                
                if(isset($this->title))
		$arr["meta_title"]			= $this->title;

		if(isset($this->Keywords))
		$arr["meta_keywords"]		        = $this->Keywords;

                if(isset($this->description))
		$arr["meta_description"]		= $this->description;

                if(isset($this->meta_id) && $this->meta_id!="" )
	        {
		$sWhere = " meta_id = '$this->meta_id' ";
		$nReturnValue = $ObjClsDBInteraction->insertUpdate("tbl_meta_tags", $arr, $sWhere);
	        }else
                {
            //    $arr["rep_date"]			= date('Y-m-d H:i:s');
                $nReturnValue = $ObjClsDBInteraction->insertUpdate("tbl_meta_tags", $arr, $sWhere);
                }


	$nReturnValue ;


	$ObjClsDBInteraction->connection_close();
	return $nReturnValue;
}



function insertUpdatebuyers_requestseller()
{
		$ObjClsDBInteraction = new class_dbconnector();

		if(isset($this->buyer_id))
		$arr["buyer_id"]			= $this->buyer_id;

		if(isset($this->sellers_id))
		$arr["sellers_id"]			= $this->sellers_id;

                if(isset($this->request_status))
		$arr["request_status"]			= $this->request_status;

                if(isset($this->frnd_request_id) && $this->frnd_request_id!="" )
	        {$arr["date_add_frnd"]			= date('Y-m-d H:i:s');
		$sWhere = " frnd_id = '$this->frnd_request_id' ";
		$nReturnValue = $ObjClsDBInteraction->insertUpdate("tbl_sellers_buyers", $arr, $sWhere);
	        }else
                {$arr["date_add_frnd"]			= date('Y-m-d H:i:s');
            	$nReturnValue = $ObjClsDBInteraction->insertUpdate("tbl_sellers_buyers", $arr, $sWhere);
                }


	$nReturnValue ;


	$ObjClsDBInteraction->connection_close();
	return $nReturnValue;
}

	// functions added by deepak

       	function get_UserAddressDetails()
	{
		$obj_con = new class_dbconnector();

		$sSQL = "SELECT * FROM tbl_users WHERE id is not null";

		if(isset($this->seller_id) && $this->seller_id!="")
		{
			$sSQL .= " AND id='$this->seller_id' ";
		}

		//$date = date("Y-m-d H:i:s");
	


		$RecordSet = $obj_con->select($sSQL);
		$obj_con->connection_close();
		return $RecordSet;

	}
 
	// functions added by deepak

       	function getLockerUserDetails()
	{
		$obj_con = new class_dbconnector();
		
		$sSQL = "SELECT * FROM tbl_users WHERE id is not null";

		if(isset($this->seller_id) && $this->seller_id!="")
		{
			$sSQL .= " AND id='$this->seller_id' ";
		}

		if(isset($this->locker_password) )
		{
			$sSQL .= " AND locker_password='$this->locker_password'";
		}
		$date = date("Y-m-d H:i:s");
		if(isset($this->locker_last_date) && $this->locker_last_date!="")
		{
			$sSQL .=" AND '$date'<='$this->locker_last_date'";
		}
		

		$RecordSet = $obj_con->select( $sSQL );
		$obj_con->connection_close();
		return $RecordSet;

	}
 
 	/* ******************* start show custom message *************** */
        
	function getcustommessage()
	{
		$obj_con = new class_dbconnector();
		$sSQL = "SELECT * FROM  tbl_custom_message WHERE id IS NOT NULL";
		
		
		if(isset($this->custommessage_id) && $this->custommessage_id!="")
		{
			$sSQL .= " AND id='$this->custommessage_id' ";
		}
		if(isset($this->id) && $this->id!="")
		{
			$sSQL .= " AND message_id='$this->id' ";
		}

         if(isset($this->file_attached))
		$arr["file_attached"]       = $this->file_attached;
		
		if(isset($this->buyid) && $this->buyid!="")
		{
			$sSQL .= " AND buyer_id='$this->buyid'";
		}
	
		if(isset($this->pageLimit) && $this->pageLimit!="")
		{
			$sSQL .= $this->pageLimit;
		}
//echo $sSQL;
		$RecordSet = $obj_con->select( $sSQL );
		$obj_con->connection_close();
		return $RecordSet;

	}
	/* ******************* end show custom message *************** */
	/* ******************* start custom message *************** */
	function insertUpdatemessage()
	{
		$ObjClsDBInteraction = new class_dbconnector();
		
		if(isset($this->buyer_id))
		$arr["buyer_id"]			= $this->buyer_id;
				
		if(isset($this->seller_id))
		$arr["seller_id"]			= $this->seller_id;
		
		if(isset($this->message))
		$arr["message"]				= $this->message;
		
		if(isset($this->message_id))
		$arr["message_id"]			= $this->message_id;

		if(isset($this->user_type))
		$arr["user_type"]			= $this->user_type;
		
		 if(isset($this->file_attached))
		$arr["file_attached"]       = $this->file_attached;
		
		if(isset($this->reqid) && $this->reqid!="")
		{
			$sWhere = " id = '$this->reqid'";
			$nReturnValue = $ObjClsDBInteraction->insertUpdate("tbl_custom_message", $arr, $sWhere);
		}
		else
		{
			$arr["create_date"] = date("Y-m-d H:i:s");
			$nReturnValue = $ObjClsDBInteraction->insertUpdate("tbl_custom_message", $arr, null);	
		}
		$nReturnValue ;
		$ObjClsDBInteraction->connection_close();
		return $nReturnValue;
	}

	/* ******************* end custom message *************** */

	/* ******************* start custom item *************** */

	function getcustomitem()
	{
		$obj_con = new class_dbconnector();
	
		$sSQL = "SELECT username,tbl_custom_request.*,tbl_custom_request.id as 
        cust_item_id,tbl_custom_request.sellerid as seller_id, tbl_users.first_name
        as firstname,tbl_users.last_name as lastname FROM tbl_custom_request,
		tbl_users WHERE tbl_custom_request.id IS NOT NULL";
		
		if(isset($this->id) && $this->id!="")
		{
		$sSQL .= " AND tbl_custom_request.user_id='$this->id' and tbl_custom_request.sellerid=tbl_users.id ";
		}

		if(isset($this->tblid) && $this->tblid!="")
		{
		$sSQL .= " AND tbl_custom_request.id='$this->tblid' and tbl_custom_request.user_id=tbl_users.id ";
		}
	
		if(isset($this->sel_id) && $this->sel_id!="")
		{
		$sSQL .= " AND tbl_custom_request.sellerid='$this->sel_id' and tbl_custom_request.user_id=tbl_users.id";
		}

		if(isset($this->requestid) && $this->requestid!="")
		{
		$sSQL .= " AND tbl_custom_request.id='$this->requestid' and tbl_custom_request.user_id=tbl_users.id ";
		}

		if(isset($this->sortingid) && $this->sortingid!="")
		{
		$sSQL .=" ORDER BY usr.$this->sortingid DESC ";
		}
		$sSQL .=" order by create_date desc ";
		if(isset($this->pageLimit) && $this->pageLimit!="")
		{
		$sSQL .= $this->pageLimit;
		}
            // echo   $sSQL;
		$RecordSet = $obj_con->select( $sSQL );
		$obj_con->connection_close();
		return $RecordSet;

	}
	//*******************  end custom item ***************/
     function insertUpdatecustomrequest()
	{	
		$ObjClsDBInteraction = new class_dbconnector();
			
		if(isset($this->title))
		$arr["title"]			= $this->title;
                			
		if(isset($this->price))
		$arr["price"]			= $this->price;
		
		if(isset($this->quantity))
		$arr["quantity"]		= $this->quantity;
		
		if(isset($this->deadline))
		$arr["deadline"]		= $this->deadline;
		
		if(isset($this->description))
		$arr["description"]		= $this->description;

		if(isset($this->locker_status))
		$arr["locker_status"]   	= $this->locker_status;

		if(isset($this->tags))
		$arr["tags"]			= $this->tags;
		
		if(isset($this->fullname))
		$arr["fullname"]		= $this->fullname;
		
		if(isset($this->material))
		$arr["material"]		= $this->material;
		
		if(isset($this->street))
		$arr["street"]			= $this->street;
		
		if(isset($this->city))
		$arr["city"]			= $this->city;

		if(isset($this->state))
		$arr["state"]			= $this->state;
		
		
		if(isset($this->zipcode))
		$arr["zipcode"]			= $this->zipcode;

		if(isset($this->userid))
		$arr["user_id"]			= $this->userid;
		
		if(isset($this->country_value))
		$arr["country"]			= $this->country_value;

		if(isset($this->custom_logo))
		$arr["image1"]			= $this->custom_logo;

		if(isset($this->sellerid))
		$arr["sellerid"]		= $this->sellerid;
		
		if(isset($this->agreestatus))
		$arr["agreestatus"]			= $this->agreestatus;

		if(isset($this->adpersantage))
		$arr["advancepersantage"]		= $this->adpersantage;

		if(isset($this->paymentstatus))
		 $arr["paymentstatus"]			= $this->paymentstatus;

		if(isset($this->TRANSACTIONID))
		 $arr["transaction_id"]			= $this->TRANSACTIONID;

		if(isset($this->paid_amount))
		 $arr["paid_amount"]			= $this->paid_amount;

		if(isset($this->avs_code))
		 $arr["avs_code"]			= $this->avs_code;
		
		if(isset($this->text))
		 $arr["text"]				= $this->text;

		 if(isset($this->cvv2))
		 $arr["cvv2"]				= $this->cvv2;

		 if(isset($this->locker_status))
		 $arr["locker_status"]   		= $this->locker_status;
		 
		 if(isset($this->file_attached))
		 $arr["file_attached"]   		= $this->file_attached;
		
		 if(isset($this->fully_prepared))
		 $arr["fully_prepared"]   		= $this->fully_prepared;
	

//echo "select * from tbl_custom_request where title='".$arr["title"]."' AND id!='$this->//reqid'";
//exit;	
		if(isset($this->reqid) && $this->reqid!="")
		{ 
	
			$s=mysql_num_rows(mysql_query("select * from tbl_custom_request where title='".$arr["title"]."' AND id!='$this->reqid'"));
			//if($s<1)
			//{
				//exit;
				$arr["alter_date"] = date("Y-m-d H:i:s");
				$sWhere = " id = '$this->reqid'";
				$nReturnValue = $ObjClsDBInteraction->insertUpdate("tbl_custom_request", $arr, $sWhere);
		//	}
			
		}
		else
		{
			//$s=mysql_num_rows(mysql_query("select * from tbl_custom_request where title='".$arr["title"]."'"));
			//if($s<1)
			//{
				$arr["create_date"] = date("Y-m-d H:i:s");
				$nReturnValue = $ObjClsDBInteraction->insertUpdate("tbl_custom_request", $arr, null);
			//}
			
		}

		$nReturnValue ;
		
		$ObjClsDBInteraction->connection_close();
		return $nReturnValue;
	}

	function getcountry($id)
	{
		$obj_con = new class_dbconnector();
		$sSQL = mysql_query("SELECT country FROM tbl_country_master WHERE id='$id'");
		$cname=mysql_fetch_array($sSQL);
		$name=$cname['country'];
		$obj_con->connection_close();

		return $name;	
	}


	
	function getUserDetailsupdate()
	{

		$ObjClsDBInteraction = new class_dbconnector();
		
		if(isset($this->private_public_store))
		$arr["private_public_store"]	  = $this->private_public_store;
		
		if(isset($this->f_name))
		$arr["first_name"]		  = $this->f_name;
		
		if(isset($this->l_name))
		$arr["last_name"]		  = $this->l_name;
		
		if(isset($this->email))
		$arr["email"]			  = $this->email;

		if(isset($this->address1))
		$arr["address1"]		 = $this->address1;
		
		if(isset($this->address2))
		$arr["address2"]		 = $this->address2;
		
		if(isset($this->city))
		$arr["city"]			= $this->city;
		
		if(isset($this->zipcode))
		$arr["zipcode"]			= $this->zipcode;
		
		if(isset($this->state))
		$arr["state"]			= $this->state;
		
		if(isset($this->country_id))
		$arr["country_id"]		= $this->country_id;
		
		if(isset($this->phone1))
		$arr["phone1"]			= $this->phone1;
		
		if(isset($this->phone2))
		$arr["phone2"]			= $this->phone2;
		
		if(isset($this->paypal_email))
		$arr["paypal_email"]		= $this->paypal_email;
		
		if(isset($this->company_name))
		$arr["company_name"]		= $this->company_name;
		
		if(isset($this->company_address))
		$arr["company_address"]		= $this->company_address;
		
		if(isset($this->company_phone))
		$arr["company_phone"]		= $this->company_phone;
		
		if(isset($this->store_name))
		$arr["store_name"]		= $this->store_name;
		
		if(isset($this->company_desc))
		$arr["company_desc"]		= $this->company_desc;
		
		if(isset($this->security_question))
		$arr["security_question"]	= $this->security_question;
		
		if(isset($this->security_answer))
		$arr["security_answer"]		= $this->security_answer;
		
		if(isset($this->status))
		$arr["status"]   		= $this->status;
		
		if(isset($this->user_type))
		$arr["user_type"]		= $this->user_type;

		
		if(isset($this->payment_type))
		$arr["payment_type"]		= $this->payment_type;
        
		
		if(isset($this->welcome))
		$arr["v_welcome"]		= $this->welcome;

		if(isset($this->payment))
		$arr["v_payment"]		= $this->payment;

		if(isset($this->shipping))
		$arr["v_shipping"]		= $this->shipping;

		if(isset($this->refund))
		$arr["v_refund_exchange"]	= $this->refund;

		if(isset($this->additional))
		$arr["v_additional_info"]	= $this->additional;

                 if(isset($this->store_logo))
		$arr["v_store_image"]		= $this->store_logo;
		

//********************** Locker variabes **************************

		if(isset($this->locker_password))
		$arr["locker_password"]		= $this->locker_password;

		if(isset($this->locker_create_date))
		$arr["locker_create_date"]	= $this->locker_create_date;

		if(isset($this->locker_last_date))
		$arr["locker_last_date"]	= $this->locker_last_date;
		 // $objUser->city_value        = ''; 
	         // $objUser->country_value     = ''; 
	         //  $objUser->state_value       = '';
		if(isset($this->id) && $this->id!="")
		{
			 $sWhere = "id = '$this->id'";
			 $nReturnValue = $ObjClsDBInteraction->insertUpdate("tbl_users", $arr, $sWhere);
		}
		else
		{
			$arr["reg_date"] = date("Y-m-d H:i:s");
			$nReturnValue = $ObjClsDBInteraction->insertUpdate("tbl_users", $arr, null);
		}
		

		$ObjClsDBInteraction->connection_close();
		return $nReturnValue;


	}

	function getUserDetails()
	{
		$obj_con = new class_dbconnector();
		$sSQL = "SELECT * FROM tbl_users WHERE id='$this->id'";
		$RecordSet = $obj_con->select( $sSQL );
		$obj_con->connection_close();
		return $RecordSet;

	}
	//Function to get User Login Details  
	function getUserLoginDetails_deepak()    // made by deepak()
	{
		$obj_con = new class_dbconnector();

		$sSQL = "SELECT * FROM tbl_users WHERE id IS NOT NULL";
		
		if(isset($this->email))
		{
			$sSQL.= " AND email ='$this->email'";
		}	
		//by user name
		if(isset($this->username))
		{
			$sSQL.= " AND username ='$this->username'";
		}
		
		if(isset($this->password))
		{
			$sSQL.= " AND password = '$this->password'";
		}	
		
		if(isset($this->id))
		{
			$sSQL.= " AND id = '$this->id'";
		}	
		if(isset($this->deleted_user))
		{
		// 0 means not delete 1 means deletd
			$sSQL.= " AND isdeleted = '$this->deleted_user'";
		}	
		if(isset($this->status))
		{
			$sSQL.= " AND status = '$this->status'";
		}	
		
		 $sSQL . ";<br><br><br>";
	
		$RecordSet = $obj_con->select($sSQL);
		$obj_con->connection_close();
		return $RecordSet;
	} 
//**************  Deepak Nagar ****************************
	//select all store images
	function selectfeaturedimage()
	{
		$ObjClsDBInteraction = new class_dbconnector();

		$sSQL  = "SELECT * FROM tbl_users AS usr WHERE usr.id IS NOT NULL";
		$sSQL .= " AND usr.v_status='1' AND usr.status = '1' AND usr.user_type='3'";
		$sSQL .= " AND usr.approve_store='1' "; //not suspended
		$sSQL .= " ORDER BY usr.v_fetured_date DESC ";
		//$sSQL .= " LIMIT 0,4";
		//echo "<br />".$sSQL ."<br />";
		if(isset($this->pageLimit) && $this->pageLimit!="")
		{
			$sSQL .= $this->pageLimit;
		}
		$objRecordSet = $ObjClsDBInteraction->select($sSQL);
		$ObjClsDBInteraction->connection_close();
		return $objRecordSet;
	}//end of function

	//select all store images
	function selectallfeaturedimage()
	{
		$ObjClsDBInteraction = new class_dbconnector();
		$sSQL = "SELECT * FROM tbl_users AS usr WHERE usr.id IS NOT NULL";
		$sSQL .= " AND usr.v_status='1' AND usr.status = '1' AND usr.user_type='3'";
		
		if(isset($this->sortingid) && $this->sortingid!="")
		{
			$sSQL .=" ORDER BY usr.$this->sortingid DESC ";
		}
		if(isset($this->pageLimit) && $this->pageLimit!="")
		{
			$sSQL .= $this->pageLimit;
		}	
		$objRecordSet = $ObjClsDBInteraction -> select($sSQL);
		$ObjClsDBInteraction->connection_close();
		return $objRecordSet;
	}//end of function
		
//*************************  End by Deepak Nagar ***********************************	

	/// end by deepak





	//Function to get User Login Details  
	// may be used by rishi somewhere and deepak made his new function
	function getUserLoginDetails()
	{
		$obj_con = new class_dbconnector();

		$sSQL = "SELECT * FROM tbl_users WHERE id IS NOT NULL";
		
		if(isset($this->email))
		{
			$sSQL.= " AND email ='$this->email'";
		}	
		//by user name
		if(isset($this->username))
		{
			$sSQL.= " AND username ='$this->username'";
		}
		
		if(isset($this->password))
		{
			$sSQL.= " AND password = '$this->password'";
		}	
		
		if(isset($this->id))
		{
			$sSQL.= " AND id = '$this->id'";
		}	
		
		if(isset($this->deleted_user))
		{
		// 0 means not delete 1 means deletd
			$sSQL.= " AND isdeleted = '$this->deleted_user'";
		}	
		if(isset($this->status))
		{
			$sSQL.= " AND status = '$this->status'";
		}	
		
		  $sSQL ;
		
		$RecordSet = $obj_con->select( $sSQL );
		$obj_con->connection_close();
		return $RecordSet;
	} 

      
	//select all users list who bought items from particular seller
	function selectpreviousUser()
	{
		$ObjClsDBInteraction = new class_dbconnector();

		$sSQL = "SELECT * FROM tbl_buyer_purchased_item AS p, tbl_users AS u
  WHERE u.id = p.buyer_id and payment_status=1  ";

		//select particular user
		if(isset($this->seller_id) && $this->seller_id!="")
		{
			$sSQL .= "  AND p.seller_id =$this->seller_id";
		}
		//search by first name
		
	        $sSQL .= " GROUP BY p.buyer_id ";
		$objRecordSet = $ObjClsDBInteraction->select($sSQL);
		$ObjClsDBInteraction->connection_close();
		return $objRecordSet;
	}//end of function
	

	//select all users list
	function serchSeller_forgiftcard()
	{ 
		$ObjClsDBInteraction = new class_dbconnector();

		$sSQL = " SELECT *,usr.id as user_id_value,usr.status as usr_stat_val FROM tbl_users AS usr left join  tbl_country_master as cou_ma on (cou_ma.id =  usr.country_id ) where   usr.id IS NOT NULL ";

		//search by username
		if(isset($this->username) && $this->username!="")
		{
			$sSQL .= " AND usr.username LIKE '$this->username%'";
		}
		//search by first name
		if(isset($this->Active) && $this->Active=='Y')
		{
			$sSQL .= " AND usr.status = 1 ";
		}
		if(isset($this->Active) && $this->Active=='N')
		{
			$sSQL .= " AND usr.status = 0 ";
		}
		
		if(isset($this->sort_order) && $this->sort_order=='1')
		{
			$sSQL .= " ORDER BY usr.username desc ";
		}
		if(isset($this->pageLimit) && $this->pageLimit!="")
		{
			$sSQL .= " $this->pageLimit ";
		}

			//	echo $sSQL."<br />";
		$objRecordSet = $ObjClsDBInteraction->select($sSQL);
		$ObjClsDBInteraction->connection_close();
		return $objRecordSet;
	 }		
	

	//select all users list
	function selectUser()
	{ 
		$ObjClsDBInteraction = new class_dbconnector();

		$sSQL = " SELECT *,usr.id as user_id_value,usr.status as usr_stat_val FROM tbl_users AS usr left join  tbl_country_master as cou_ma on (cou_ma.id =  usr.country_id ) where   usr.id IS NOT NULL ";

 //	$sSQL = "SELECT *,usr.id as user_id_value,usr.status as usr_stat_val FROM tbl_users AS usr , tbl_country_master 
 // as cou_ma   where cou_ma.id = usr.country_id AND  usr.id IS NOT NULL ";

		if($this->approve_store!='' && isset($this->approve_store))
		{
		   $sSQL .= " AND usr.approve_store = $this->approve_store";
	
		}
        if(isset($this->sel_days))
         {
          $sSQL.= "  AND EXTRACT(DAY FROM  usr.reg_date) = '$this->sel_days' ";
          }
        if(isset($this->sel_year))
           {
           $sSQL .= " AND  EXTRACT(YEAR FROM usr.reg_date)= '$this->sel_year' ";                    
            }
         if(isset($this->sel_month))
           {           
           $sSQL .= " AND  EXTRACT(MONTH FROM usr.reg_date)='$this->sel_month' " ;
            }
     

                //select particular user
		if($this->store_name!='' && isset($this->store_name))
		{
		   $sSQL .= " AND usr.store_name LIKE '%$this->store_name%'";
	
		}
		if(isset($this->id) && $this->id!="")
		{
			$sSQL .= " AND usr.id = $this->id";
		}
		//search by username
		if(isset($this->username) && $this->username!="")
		{
			$sSQL .= " AND usr.username LIKE '$this->username%'";
		}
    //echo 'username_dom=='.$this->username_dom;
	if(isset($this->username_dom) && $this->username_dom!="")
		{
			$sSQL .= " AND  usr.username = '$this->username_dom'";
		}
                		//search by city
		if(isset($this->city) && $this->city!="")
		{
			$sSQL .= " AND usr.city LIKE '%$this->city%'";
		}
                		//search by state
		if(isset($this->state) && $this->state!="")
		{
			$sSQL .= " AND usr.state LIKE '%$this->state%'";
		}
                if(isset($this->country_value) && $this->country_value!=0)
		{
			$sSQL .= " AND usr.country_id = $this->country_value";
		}
//search by store name
	
		//search by first name
		if(isset($this->first_name) && $this->first_name!="")
		{
			$sSQL .= " AND usr.first_name LIKE '%$this->first_name%'";
		}
		//last name
		if(isset($this->last_name) && $this->last_name!="")
		{
			$sSQL .= " AND usr.last_name LIKE '%$this->last_name%'";
		}
		//search by email
		if(isset($this->email) && $this->email!="")
		{
			$sSQL .= " AND usr.email LIKE '%$this->email%'";
		}
		//do not display deleted records
		if(isset($this->show_deleted) && $this->show_deleted=="No")
		{
			$sSQL .= " AND usr.isdeleted = 0  " ;
		}
		//get users by user type
		if(isset($this->user_type) && $this->user_type!="")
		{
			$sSQL .= " AND usr.user_type = $this->user_type ";
		}
		//get user by registration start date
		if(isset($this->s_date) && isset($this->e_date))
		{
			$sSQL .= " AND DATE_FORMAT(usr.reg_date,'%Y/%m/%d') = '$this->s_date' ";
		}
		//if both dates exists
		if(isset($this->s_date) && isset($this->e_date))
		{
			$sSQL .= " AND (DATE_FORMAT(usr.reg_date,'%Y/%m/%d') BETWEEN '$this->s_date' AND '$this->e_date')";
		}
		//get user by status
		if(isset($this->user_status))
		{
			$sSQL .= " AND usr.status = $this->user_status";
		}
           
		if(isset($this->Active) && $this->Active=='Y')
		{
			$sSQL .= " AND usr.status = 1";
		}
		if(isset($this->Active) && $this->Active=='N')
		{
			$sSQL .= " AND usr.status = 0";
		}
		$sSQL .=" ORDER BY usr.reg_date ASC  ";
		
		//apply paging limit
		if(isset($this->pageLimit) && $this->pageLimit!="")
		{
			$sSQL .= $this->pageLimit;
		}
		//echo $sSQL."<br />";
		$objRecordSet = $ObjClsDBInteraction->select($sSQL);
		$ObjClsDBInteraction->connection_close();
		return $objRecordSet;
	}//end of function
	
	// this function is used get existing email
	function validateExisringEmail()
	{
		$ObjClsDBInteraction = new class_dbconnector();

		$sSQL = " SELECT email FROM tbl_users WHERE id IS NOT NULL ";
		if(isset($this->email) && $this->email!="")
		{
			$sSQL .= " AND email = '$this->email' ";
		}
		if(isset($this->id) && $this->id!="")
		{
			$sSQL .= " AND id != $this->id";
		}
	 $sSQL ;
		
	 $objRecordSet = $ObjClsDBInteraction -> select($sSQL);

                //echo 'num--'.mysql_num_rows($objRecordSet);

        if(mysql_num_rows($objRecordSet)>0)
		{
			$objRecordSet = true;
		}
		else
		{
			$objRecordSet = false;
		}
		// $objRecordSet ;
		//exit;
		$ObjClsDBInteraction->connection_close();
		return $objRecordSet;
	}//end of function
	
	// this function is used get existing paypal email
	function validateExisringPaypalEmail()
	{
		$ObjClsDBInteraction = new class_dbconnector();

		$sSQL = "SELECT paypal_email FROM tbl_users WHERE id IS NOT NULL";
		if(isset($this->paypal_email) && $this->paypal_email!="")
		{
			$sSQL .= " AND paypal_email = '$this->paypal_email' ";
		}
		if(isset($this->id) && $this->id!="")
		{
			$sSQL .= " AND id != $this->id ";
		}
		//echo $sSQL . ";<br><br><br>";
		$objRecordSet = $ObjClsDBInteraction->select($sSQL);
		if(mysql_num_rows($objRecordSet)>0)
		{
			$objRecordSet = true;
		}
		else
		{
			$objRecordSet = false;
		}
		$ObjClsDBInteraction->connection_close();
		return $objRecordSet;
	}//end of function
	
	// this function is used get existing username
	function validateExisringUsername()
	{
		$ObjClsDBInteraction = new class_dbconnector();

		$sSQL = " SELECT username FROM tbl_users WHERE id IS NOT NULL ";
		if(isset($this->username) && $this->username!="")
		{
			$sSQL .= " AND username = '$this->username' ";
		}
		if(isset($this->id) && $this->id!="")
		{
			$sSQL .= " AND id != $this->id";
		}
		//echo $sSQL . ";<br><br><br>";
	
		$objRecordSet = $ObjClsDBInteraction->select($sSQL);
		if(mysql_num_rows($objRecordSet)>0)
		{
			$objRecordSet = true;
		}
		else
		{
			$objRecordSet = false;
		}
		$ObjClsDBInteraction->connection_close();
		return $objRecordSet;
	}//end of function
	
	//Function Insert/Update user details
	function insertUpdateUser()
	{
	
		$ObjClsDBInteraction = new class_dbconnector();
		if(isset($this->add_myshops))
		$arr["add_myshops"]         = $this->add_myshops;
		
		if(isset($this->paypal_merchant_id))
		$arr["paypal_merchant_id"]         = $this->paypal_merchant_id;

		if(isset($this->add_to_favor))
		$arr["favorite_items"]      = $this->add_to_favor;

		if(isset($this->first_name))
		$arr["first_name"]          = $this->first_name;

		if(isset($this->payment_type))
		$arr["payment_type"]          = $this->payment_type;
		
		if(isset($this->API_USERNAME)  )
		$arr["API_USERNAME"]          = $this->API_USERNAME;
		
		if(isset($this->API_PASSWORD))
		$arr["API_PASSWORD"]          = $this->API_PASSWORD;
		
		if(isset($this->API_SIGNATURE))
		$arr["API_SIGNATURE"]          = $this->API_SIGNATURE;
		
		if(isset($this->Merchant_Id))
		$arr["Merchant_Id"]          = $this->Merchant_Id;		
		
		if(isset($this->last_name))
		$arr["last_name"]		    = $this->last_name;
		
		if(isset($this->username))
		$arr["username"]			= $this->username;
				
		if(isset($this->email))
		$arr["email"]				= $this->email;
		
		if(isset($this->password))
		$arr["password"]			= $this->password;
		
		if(isset($this->address1))
		$arr["address1"]			= $this->address1;
		
		if(isset($this->address2))
		$arr["address2"]			= $this->address2;
		
		if(isset($this->city))
		$arr["city"]				= $this->city;
		
		if(isset($this->zipcode))
		$arr["zipcode"]				= $this->zipcode;
		
		if(isset($this->state))
		$arr["state"]				= $this->state;
		
		if(isset($this->country_id))
		$arr["country_id"]			= $this->country_id;
		
		if(isset($this->phone1))
		$arr["phone1"]				= $this->phone1;
		
		if(isset($this->phone2))
		$arr["phone2"]				= $this->phone2;
		
		if(isset($this->paypal_email))
		$arr["paypal_email"]		= $this->paypal_email;
		
		if(isset($this->company_name))
		$arr["company_name"]		= $this->company_name;
		
		if(isset($this->company_address))
		$arr["company_address"]		= $this->company_address;
		
		if(isset($this->company_phone))
		$arr["company_phone"]		= $this->company_phone;
		
		if(isset($this->store_name))
		$arr["store_name"]			= $this->store_name;
		
		if(isset($this->company_desc))
		$arr["company_desc"]		= $this->company_desc;
		
		if(isset($this->security_question))
		$arr["security_question"]	= $this->security_question;
		
		if(isset($this->security_answer))
		$arr["security_answer"]		= $this->security_answer;
		
		if(isset($this->status))
		$arr["status"]   		 	= $this->status;
		
		if(isset($this->user_type))
		$arr["user_type"]			= $this->user_type;

		if(isset($this->city_value))
		$arr["city"]			    = $this->city_value;

		if(isset($this->country_value))
		$arr["country_id"]			= $this->country_value;

		if(isset($this->state_value))
		$arr["state"]			    = $this->state_value;                
		
		if(isset($this->welcome))
		$arr["v_welcome"]			= $this->welcome;

		if(isset($this->payment))
		$arr["v_payment"]			= $this->payment;

		if(isset($this->shipping))
		$arr["v_shipping"]			= $this->shipping;

		if(isset($this->refund))
		$arr["v_refund_exchange"]	= $this->refund;

		if(isset($this->additional))
		$arr["v_additional_info"]	= $this->additional;

		if(isset($this->fetured_date))
		$arr["v_fetured_date"]		= $this->fetured_date;
		
		if(isset($this->feturedstatus))
		$arr["v_status"]			= $this->feturedstatus;
		 
		if(isset($this->id) && $this->id!="")
		{
			 $sWhere = " id = '$this->id' ";
			 $nReturnValue = $ObjClsDBInteraction->insertUpdate("tbl_users", $arr, $sWhere);
		}
		else
		{
			$arr["reg_date"] = date("Y-m-d H:i:s");
			$nReturnValue = $ObjClsDBInteraction->insertUpdate("tbl_users", $arr, null);
		}
		
		$ObjClsDBInteraction->connection_close();
		return $nReturnValue;
	}//end of function



	function updateUseraddress()
	{
	
	
	$ObjClsDBInteraction = new class_dbconnector();
	     if(isset($this->change_address1))
	      {
	     $arr["address1"]    	= $this->change_address1;
	      }
             if(isset($this->change_address2))
	      {
	     $arr["address2"]    	= $this->change_address2;
	      }
             if(isset($this->change_state))
	      {
	     $arr["state"]    	= $this->change_state;
	      }
               if(isset($this->zipcode))
	      {
	     $arr["zipcode"]    	= $this->zipcode;
	      }

             if(isset($this->country_value))
	      {
	      $arr["country_id"]    	= $this->country_value;
	      }
	
	$sWhere = " id = '$this->id'";
	$nReturnValue = $ObjClsDBInteraction->insertUpdate("tbl_users", $arr, $sWhere);
		
	$ObjClsDBInteraction->connection_close();
	return $nReturnValue;
	
	}

                  
	function updateUserPassword()
	{
		$ObjClsDBInteraction = new class_dbconnector();
		if(isset($this->password))
		{
			$arr["password"]    	= $this->password;
		}	
		
		$sWhere = " id = '$this->id'";
		$nReturnValue = $ObjClsDBInteraction->insertUpdate("tbl_users", $arr, $sWhere);
		
		$ObjClsDBInteraction->connection_close();
		return $nReturnValue;
	}//end of function
	

	function updateUserEmail()
	{
		$ObjClsDBInteraction = new class_dbconnector();
		if(isset($this->email))
		{
			$arr["email"]    	= $this->email;
		}	
		
		$sWhere = " id = '$this->id'";
		$nReturnValue = $ObjClsDBInteraction->insertUpdate("tbl_users", $arr, $sWhere);
		
		$ObjClsDBInteraction->connection_close();
		return $nReturnValue;
	}//end of function
	
	//function delete
	function deleteUser()
	{
	//echo 'noid='.$this->id;
		$ObjClsDBInteraction = new class_dbconnector();
		
		if(isset($this->id)&& $this->id!='')
		{
			$sSQL ="DELETE FROM tbl_users WHERE id='$this->id'"; 
		}
	//	echo $sSQL;
		$objRecordSet = $ObjClsDBInteraction->select( $sSQL );
		$ObjClsDBInteraction->connection_close();
		return $nReturnValue;
	}//end of function
	 	

	
	//-- Function to update user status
	function changeUserStatus()
	{
		$ObjClsDBInteraction = new class_dbconnector();
	
		if(isset($this->status))
		$arr["status"]    	= $this->status;
		
		if(isset($this->approve_store))
		$arr["approve_store"]   = $this->approve_store;
		
		$sWhere = " id = '$this->id'";
		$nReturnValue = $ObjClsDBInteraction->insertUpdate( "tbl_users", $arr, $sWhere);
		
		$ObjClsDBInteraction->connection_close();
		return $nReturnValue;
	}//end of function
	
	//change user delete sattus
	function changeDeleteUserStatus()
	{
		$ObjClsDBInteraction = new class_dbconnector();
		$arr["isdeleted"]    = $this->isdeleted;
		$arr["deleted_date"] = date("Y-m-d H:i:s");
		$sWhere = " id = '$this->id'";
		$nReturnValue = $ObjClsDBInteraction->insertUpdate( "tbl_users", $arr, $sWhere);
		
		$ObjClsDBInteraction->connection_close();
		return $nReturnValue;
	}
	//end of function
	
	//Function is used to log user login dates
	function loggedUserLoginDates()
	{
		$ObjClsDBInteraction = new class_dbconnector();
		
		$arr = array();
		$arr["user_id"]				= $this->user_id; 
		$arr["login_date"]			= date("Y-m-d H:i:s");	
		$arr["login_ip"]     	 	= $_SERVER['REMOTE_ADDR'];
		
		//log all logins by user
		//$nReturnValue = $ObjClsDBInteraction->insertUpdate( "tbl_user_login_dates", $arr, null); //uncomment if wants whole login history
		
		//set last login
		$last_login			= date("Y-m-d H:i:s");
		//$sSQL = "UPDATE tbl_users SET last_login='".$last_login."' WHERE id='".$this->user_id;
		$sSQL ="UPDATE tbl_users SET last_login='$last_login' WHERE id ='$this->user_id'"; 
		$objRecordSet2 = $ObjClsDBInteraction -> select($sSQL);
		
		$ObjClsDBInteraction->connection_close();
		return $nReturnValue;
	}
		// function for details of user feedback
		function getdetailsOfUsertotalfeedback()
	{
		$ObjClsDBInteraction = new class_dbconnector();
		$sSQL = "SELECT count(feedback) as total FROM tbl_item_feedback 
		WHERE id is not null ";
		
		if($this->logged_user_id)
		$sSQL .= " AND seller_id ='$this->logged_user_id' ";
       // echo $sSQL.'  ';
		$objRecordSet = $ObjClsDBInteraction->select($sSQL);
		$ObjClsDBInteraction->connection_close();
		return $objRecordSet;
	
    }
		function getdetailsOfUserpostivefeedback()
	{
		$ObjClsDBInteraction = new class_dbconnector();
		$sSQL = "SELECT count(feedback) as total FROM tbl_item_feedback 
		WHERE id is not null AND feedback=1 ";
		
		if($this->logged_user_id)
		$sSQL .= " AND seller_id ='$this->logged_user_id' ";
        $sSQL.'  ';
		$objRecordSet = $ObjClsDBInteraction->select($sSQL);
		$ObjClsDBInteraction->connection_close();
		return $objRecordSet;
	
    }
	
	

	//Function is usede to get user login history
	function getUserLoginHistory()
	{
		$ObjClsDBInteraction = new class_dbconnector();

		$sSQL  ="SELECT * FROM tbl_user_login_dates WHERE user_id IS NOT NULL";
		if(isset($this->user_id) && $this->user_id!="")
		{
			$sSQL .= " AND user_id =$this->user_id";
		}
		$sSQL .=" ORDER BY login_date DESC";
		//apply paging limit
		if(isset($this->pageLimit) && $this->pageLimit!="")
		{
			$sSQL .= $this->pageLimit;
		}
		//echo $sSQL . ";<br><br><br>";
		$objRecordSet = $ObjClsDBInteraction -> select($sSQL);
		$ObjClsDBInteraction->connection_close();
		return $objRecordSet;
	}
	
	//generate code	
	function generateVerifyCode($minlength=15, $maxlength=15, $useupper=true, $usespecial=false, $usenumbers=true) 
	{ 
		$charset = "abcdefghijklmnopqrstuvwxyz"; 
		
		if ($useupper)   
			$charset .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ"; 
			
		if ($usenumbers) 
			$charset .= "0123456789"; 
			
		if ($usespecial) 
			$charset .= "~@#$%^*()_+-={}|][";   // Note: using all special characters this reads: "~!@#$%^&*()_+`-={}|\\]?[\":;'><,./"; 
			
		if ($minlength > $maxlength) 
			$length = mt_rand ($maxlength, $minlength); 
		else
			$length = mt_rand ($minlength, $maxlength); 
			
		for ($i = 0; $i < $length; $i++) 
			$key .= $charset[(mt_rand(0,(strlen($charset)-1)))]; 
		
		return $key; 
	}
		
	// this function is used get existing email in forget password
	function forgetValidateExisringEmail()
	{

		$ObjClsDBInteraction = new class_dbconnector();

		$sSQL = "SELECT email FROM tbl_users WHERE id IS NOT NULL";
		if(isset($this->email) && $this->email!="")
		{
			$sSQL .= " AND email = '$this->email' ";
		}
		if(isset($this->id) && $this->id!="")
		{
			$sSQL .= " AND id != $this->id";
		}
		//get users by user type
		if(isset($this->user_type) && $this->user_type!="")
		{
			$sSQL .= " AND user_type = $this->user_type";
		}
		//echo $sSQL . ";<br><br><br>";
		$objRecordSet = $ObjClsDBInteraction -> select($sSQL);
		if(mysql_num_rows($objRecordSet)>0)
		{
			$objRecordSet = true;
		}
		else
		{
			$objRecordSet = false;
		}
		$ObjClsDBInteraction->connection_close();
		return $objRecordSet;
	}//end of function
	
	//Function to get Admin User Login Details  
	function getAdminUserLoginDetails()
	{
		$obj_con = new class_dbconnector();

		$sSQL = "SELECT * FROM admin_user WHERE admin_user_id IS NOT NULL";
		
		if(isset($this->username))
		$sSQL.= " AND admin_user_name ='$this->username'";
		
		if(isset($this->password))
		$sSQL.= " AND password = '$this->password'";
		
		if(isset($this->admin_email))
		$sSQL.= " AND admin_email = '$this->admin_email'";
		
		if(isset($this->admin_user_id))
		$sSQL.= " AND admin_user_id = '$this->admin_user_id'";
		
		//echo $sSQL . ";<br><br><br>";
		$RecordSet = $obj_con->select( $sSQL );
		$obj_con->connection_close();
		return $RecordSet;
	}//end of function

	//Function Insert/Update Admin user details
	function insertUpdateAdminUser()
	{
		$ObjClsDBInteraction = new class_dbconnector();
		
		if(isset($this->admin_name))
		$arr["admin_name"]            	= $this->admin_name;
		
		if(isset($this->admin_user_name))
		$arr["admin_user_name"]         = $this->admin_user_name;
		
		if(isset($this->admin_email))
		$arr["admin_email"]            	= $this->admin_email;
        
		if(isset($this->API_USERNAME))
		$arr["API_USERNAME"]            = $this->API_USERNAME;

                if(isset($this->API_PASSWORD))
		$arr["API_PASSWORD"]            = $this->API_PASSWORD;

                 if(isset($this->API_SIGNATURE))
		$arr["API_SIGNATURE"]           = $this->API_SIGNATURE;
		
		 if(isset($this->paypal_merchant_id))
		$arr["paypal_merchant_id"]      = $this->paypal_merchant_id;

		 if(isset($this->Merchant_Id))
		$arr["Merchant_Id"]           = $this->Merchant_Id;
		
		if(isset($this->payment_type))
		$arr["payment_type"]           = $this->payment_type;
		
		if(isset($this->password))
		$arr["password"]            	= $this->password;
		
		if(isset($this->admin_user_id) && $this->admin_user_id!="")
		{
			$arr["registration_date"] = date("Y-m-d H:i:s"); 
			$sWhere = " admin_user_id = '$this->admin_user_id'";
			 $nReturnValue = $ObjClsDBInteraction->insertUpdate( "admin_user", $arr, $sWhere);
		}
		else
		{
			$arr["registration_date"] = date("Y-m-d H:i:s");
			$nReturnValue = $ObjClsDBInteraction->insertUpdate( "admin_user", $arr, null);
		}
		$ObjClsDBInteraction->connection_close();
		return $nReturnValue;
	}//end of function
	
	// this function is used validate admin email for forget password
	function validateAdminEmail()
	{

		$ObjClsDBInteraction = new class_dbconnector();

		$sSQL = "SELECT admin_email FROM admin_user WHERE admin_user_id IS NOT NULL";
		if(isset($this->admin_email) && $this->admin_email!="")
		{
			$sSQL .= " AND admin_email = '$this->admin_email' ";
		}
		if(isset($this->admin_user_id) && $this->admin_user_id!="")
		{
			$sSQL .= " AND admin_user_id != $this->admin_user_id";
		}
		//echo $sSQL . ";<br><br><br>";
		$objRecordSet = $ObjClsDBInteraction -> select($sSQL);
		if(mysql_num_rows($objRecordSet)>0)
		{
			$objRecordSet = true;
		}
		else
		{
			$objRecordSet = false;
		}
		$ObjClsDBInteraction->connection_close();
		return $objRecordSet;
	}//end of function
	



	// functions added by rishi

       	function getquantityDetails()
	{
		 $obj_con = new class_dbconnector();
		

		 $sSQL = "SELECT * FROM tbl_set_quantity WHERE qty_id is not null ";
                
		 if(isset($this->qty_id))
		  $sSQL .=  "    AND  	qty_id = '$this->qty_id'";

		

		$RecordSet = $obj_con->select( $sSQL );
		$obj_con->connection_close();
		return $RecordSet;

	}

	//Function  user details
	function insertUpdateReminder()
	{
		
		$ObjClsDBInteraction = new class_dbconnector();
		
		
		if(isset($this->rem_title))
		$arr["rem_title"]            	= $this->rem_title;

		if(isset($this->user_id))
		$arr["user_id"]            	= $this->user_id;
		

		if(isset($this->name))
		$arr["name"]            	= $this->name;
		
		if(isset($this->email_id))
		$arr["email_id"]            	= $this->email_id;
		
		
		if(isset($this->rem_day))
		$arr["rem_day"]            	= $this->rem_day;
		
		if(isset($this->rem_month))
		$arr["rem_month"]            	= $this->rem_month;
		
	

		if(isset($this->gift_card_id))
		$arr["gift_card_id"]            = $this->gift_card_id;

		if(isset($this->send_save))
		$arr["send_save"]            	= $this->send_save;
		
		if(isset($this->rem_id) && $this->rem_id!="")
		{       
			$arr["date_added"] = date("Y-m-d H:i:s"); 
			$sWhere = "  rem_id = $this->rem_id ";
			 $nReturnValue = $ObjClsDBInteraction->insertUpdate( "tbl_reminders", $arr, $sWhere);
		}
		else
		{
			$arr["date_added"] = date("Y-m-d H:i:s");
			$nReturnValue = $ObjClsDBInteraction->insertUpdate( "tbl_reminders", $arr, null);
		}
		$ObjClsDBInteraction->connection_close();
		return $nReturnValue;
	}
	//end of function
	

//start of function
function getdays_diff()  // for  date after 15 days from today
	{
		 $obj_con = new class_dbconnector();
		
		 $sSQL = "SELECT EXTRACT(YEAR FROM NOW()) as tod_year,EXTRACT(DAY FROM NOW()) as tod_day,
		 EXTRACT(MONTH FROM NOW()) as tod_mon,DATE_ADD(NOW(),INTERVAL 15 DAY) as fifte_day_date ,
		 EXTRACT(DAY FROM DATE_ADD(NOW(),INTERVAL 15 DAY)) as ext_day,
		 EXTRACT(MONTH FROM DATE_ADD(NOW(),INTERVAL 15 DAY)) as ext_month ";
                
		
		
               // echo $sSQL;
		$RecordSet = $obj_con->select($sSQL);
		$obj_con->connection_close();
		return $RecordSet;
	}
	//end of function


//start of function
function reminder_messagesListing()  // for  reminders listing
	{

		 $obj_con = new class_dbconnector();
		 
		 $sSQL = " SELECT *  FROM tbl_reminders as r,tbl_reminder_giftcards_message as g 
		 WHERE r.rem_id=g.rem_id and g.status=0  AND 1=1   ";
		 
		 if(isset($this->user_id) && $this->user_id!='')
		 $sSQL .=  "    AND  	r.user_id= '$this->user_id'";
		 
		 if(isset($this->rem_id) && $this->rem_id!='')
		 $sSQL .=  "    AND  	g.rem_gift_id= '$this->rem_id'";

		 if(isset($this->pageLimit) && $this->pageLimit!="")
		 {
					$sSQL .= $this->pageLimit;
		  }
       // echo $sSQL;
		$RecordSet = $obj_con->select( $sSQL );
		$obj_con->connection_close();
		return $RecordSet;

	}
//start of function
function auto_email_sendgiftcard()  // for  reminders listing
	{
		 $obj_con = new class_dbconnector();
		 
	
		 $sSQL = "SELECT *  FROM tbl_reminders as r,tbl_reminder_giftcards_message as g 
		 WHERE r.rem_id=g.rem_id and g.status=0  ";
		 
		  if(isset($this->tod_day))
		  $sSQL .=  "    AND  	rem_day >= '$this->tod_day'";

		  if(isset($this->tod_mon))
		  $sSQL .=  "    AND  	rem_month >= '$this->tod_mon'";
		 
		 if(isset($this->rem_id))
		  $sSQL .=  "    AND  	rem_id = '$this->rem_id'";

		  if(isset($this->rem_day))
		 $sSQL .=  "    AND   rem_day <= '$this->rem_day'";
		 
		 if(isset($this->implode_month))
		 $sSQL .=  "    AND   rem_month in ($this->implode_month) ";

		 if(isset($this->implode_days))
		 $sSQL .=  "    AND   rem_day in ( $this->implode_days) ";
			
		  if(isset($this->rem_month))
		 $sSQL .=  "    AND   rem_month <= '$this->rem_month'";

		 

     //   echo '<br />';
	//      echo $sSQL;
		$RecordSet = $obj_con->select($sSQL);
		$obj_con->connection_close();
		return $RecordSet;
	}
	//end of function

//start of function
function getreminderlisting()  // for  reminders listing
	{
		 $obj_con = new class_dbconnector();
		 
		 if($this->group_function!=1)
		 $sSQL = "SELECT *  FROM tbl_reminders WHERE rem_id is not null ";

                 if($this->group_function==1)
		 $sSQL = " SELECT * ,GROUP_CONCAT(email_id) as email_id_grp,
		 GROUP_CONCAT(name) as name_grp,GROUP_CONCAT(rem_day) as event_day_grp,
		 GROUP_CONCAT(rem_month) as event_month_grp,
		 GROUP_CONCAT(rem_title) as rem_title_grp  FROM tbl_reminders WHERE rem_id is not null    ";

	        	
		 if(isset($this->user_id))
		  $sSQL .=  "    AND  	user_id = '$this->user_id'";

		  if(isset($this->tod_day))
		  $sSQL .=  "    AND  	rem_day >= '$this->tod_day'";

		  if(isset($this->tod_mon))
		  $sSQL .=  "    AND  	rem_month >= '$this->tod_mon'";
		 
		 if(isset($this->rem_id))
		  $sSQL .=  "    AND  	rem_id = '$this->rem_id'";

		  if(isset($this->rem_day))
		 $sSQL .=  "    AND   rem_day <= '$this->rem_day'";
		 
		 if(isset($this->implode_month))
		 $sSQL .=  "    AND   rem_month in ($this->implode_month) ";

		 if(isset($this->implode_days))
		 $sSQL .=  "    AND   rem_day in ( $this->implode_days) ";
			
		  if(isset($this->rem_month))
		 $sSQL .=  "    AND   rem_month <= '$this->rem_month'";

		  if(isset($this->group_by_user_id) && $this->group_by_user_id==1 )
		 $sSQL .=  "    group by user_id";

		if($this->order_by_date==1)
		 $sSQL .=  "    order by date_added desc ";

	       	if(isset($this->pageLimit) && $this->pageLimit!="")
		{
			$sSQL .= $this->pageLimit;
		}
                //echo '<br>';echo $sSQL;
	 
		$RecordSet = $obj_con->select($sSQL);
		$obj_con->connection_close();
		return $RecordSet;
	}
	//end of function


function select_maxreminderId()  // for  max id reminders listing
	{
		 $obj_con = new class_dbconnector();
		 $sSQL = " SELECT max(rem_gift_id) as max_rem_id FROM tbl_reminder_giftcards_message  ";
		 $sSQL;
		 $RecordSet = $obj_con->select($sSQL);
		 $obj_con->connection_close();
		 return $RecordSet;
	}
	//end of function



//start of function
function select_savedgiftcard()  // for  reminders listing
	{
		 $obj_con = new class_dbconnector();
		 
	
		 $sSQL = " SELECT *  FROM tbl_reminder_giftcards_message  ";
		 
		  if(isset($this->rem_gift_id))
		  $sSQL .=  "    AND  	rem_gift_id >= '$this->rem_gift_id'";

		
	       $sSQL;
		$RecordSet = $obj_con->select($sSQL);
		$obj_con->connection_close();
		return $RecordSet;
	}
	//end of function

	function deletereminders() // for delete reminders
	{
		$ObjClsDBInteraction = new class_dbconnector();
		
		if(isset($this->del_rem_id))
		{
			$sSQL ="DELETE  FROM tbl_reminders  WHERE rem_id='$this->del_rem_id'"; 
		}
		 $sSQL;
		
		$objRecordSet = $ObjClsDBInteraction->select( $sSQL );
		$ObjClsDBInteraction->connection_close();
		return $nReturnValue;
	}
	//end of function
	


      	//Function Insert/Update reminders_with_messgae
	function insertUpdate_giftcard_message()
	{
		$ObjClsDBInteraction = new class_dbconnector();
		
		if(isset($this->message))
		$arr["message"]                	= $this->message;
		
		if(isset($this->rem_id))
		$arr["rem_id"]                	= $this->rem_id;

		if(isset($this->giftcard_id))
		$arr["giftcard_id"]             = $this->giftcard_id;

		if(isset($this->STATUS))
		$arr["STATUS"]             = $this->STATUS;         // 0 means saved and 1 send 
		
	      	if(isset($this->rem_gift_id) && $this->rem_gift_id!="")
		{
		$sWhere = " rem_gift_id = '$this->rem_gift_id'";
		$nReturnValue = $ObjClsDBInteraction->insertUpdate("tbl_reminder_giftcards_message", $arr, $sWhere);
		}
		else
		{
			
		$nReturnValue = $ObjClsDBInteraction->insertUpdate("tbl_reminder_giftcards_message", $arr, null);
		}
	        $_SESSION['reminder_giftcards_message_id'] = mysql_insert_id();  	
		$ObjClsDBInteraction->connection_close();
		return $nReturnValue;
	}
	//end of function
	
		//Function Insert/Update style
	function insertUpdatestyle()
	{
		$ObjClsDBInteraction = new class_dbconnector();
		if(isset($this->set_style))
		$arr["set_style"]                	= $this->set_style;
       
	    
		
		if(isset($this->style_id) && $this->style_id!="")
		{
		$sWhere = " style_id = '$this->style_id'";
		$nReturnValue = $ObjClsDBInteraction->insertUpdate("tbl_item_style", $arr, $sWhere);
		}
		else
		{
		$nReturnValue = $ObjClsDBInteraction->insertUpdate("tbl_item_style", $arr, null);
		}
		$ObjClsDBInteraction->connection_close();
		return $nReturnValue;
	}
	//end of function
	


// function add for listing 

	//function delete
	function deleteStylelisting()
	{
		$ObjClsDBInteraction = new class_dbconnector();
		if(isset($this->style_id))
		{
			$sSQL ="DELETE FROM tbl_item_style WHERE style_id='$this->style_id'"; 
		}
		$objRecordSet = $ObjClsDBInteraction->select( $sSQL );
		$ObjClsDBInteraction->connection_close();
		return $nReturnValue;
	}
	
	//end of function

   // functions added by rishi

	function getStylelisting()
	{
		$obj_con = new class_dbconnector();
		$sSQL = "SELECT * FROM tbl_item_style WHERE style_id is not null ";
		if(isset($this->style_id))
		{
			$sSQL .=" AND style_id = '$this->style_id'";
		}
		$sSQL .=" ORDER BY set_style ASC";
		if(isset($this->pageLimit) && $this->pageLimit!="")
		{
			$sSQL .= $this->pageLimit;
		}
		$RecordSet = $obj_con->select( $sSQL );
		$obj_con->connection_close();
		return $RecordSet;
	}

function getStylelisting1()
	{
		 $obj_con = new class_dbconnector();
		

		 $sSQL = "SELECT * FROM tbl_item_style WHERE style_id is not null ";
                
		 if(isset($this->set_style))
		   $sSQL .=  "    AND  	set_style= '$this->set_style'";
		   
		  $sSQL .=  "    AND  	style_id!= '$this->style_id'";

		

		$RecordSet = $obj_con->select( $sSQL );
		$obj_con->connection_close();
		return $RecordSet;

	}


      	//Function Insert/Update quantity
	function insertUpdatequantity()
	{
		$ObjClsDBInteraction = new class_dbconnector();
		
		if(isset($this->quantity_value))
		$arr["quantity_value"]            	= $this->quantity_value;

		if(isset($this->set_cost))
		$arr["cost_item"]                	= $this->set_cost;
		
	      
		
		if(isset($this->qty_id) && $this->qty_id!="")
		{
		$sWhere = " qty_id = '$this->qty_id'";
		$nReturnValue = $ObjClsDBInteraction->insertUpdate("tbl_set_quantity", $arr, $sWhere);
		}
		else
		{
			
		$nReturnValue = $ObjClsDBInteraction->insertUpdate("tbl_set_quantity", $arr, null);
		}
		$ObjClsDBInteraction->connection_close();
		return $nReturnValue;
	}
	//end of function
	
	
		// change paide item status 
	function changepaiditemstatus()
	{
		$ObjClsDBInteraction = new class_dbconnector();
		
		if(isset($this->value_status))
		$arr["paid_item_status"]			  = $this->value_status;
		
		
		
		
		if(isset($this->id) && $this->id!="")
		{
			 $sWhere = "id = '$this->id'";
			 $nReturnValue = $ObjClsDBInteraction->insertUpdate("tbl_users", $arr, $sWhere);
		}
		else
		{
			
			$nReturnValue = $ObjClsDBInteraction->insertUpdate("tbl_users", $arr, null);
		}

		$ObjClsDBInteraction->connection_close();
		return $nReturnValue;


	}

	//add by rishi for paid_item_status
}//end of class
?>
