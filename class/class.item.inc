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
		**********************************************************************************************************/



class Class_Item
{ 
//********************************* function by deepak nagar ********************//
 
/// deepak 24 june
//insertUpdategiftcard


//owner of custom item is always have permission to buy   
   
    function check_usercustom_itembuy()  {

         $obj_con = new class_dbconnector();

         $sSQL = "SELECT * FROM tbl_custom_request c, tbl_item_details i
                  WHERE c.id = i.request_item_id ";

          if(isset($this->owner_id))
          {
          $sSQL.= " AND c.user_id='$this->owner_id'"; // buyer id
          }
           if(isset($this->item_id))
          {
          $sSQL.= " AND i.item_id='$this->item_id'";
          }
          // 0 for not paid 1 for paid
         //echo $sSQL;

        //   '<br>';
          $RecordSet = $obj_con->select($sSQL);

          $obj_con->connection_close();

            return $RecordSet;
}

function getinvoice_commisiondetails()
{

         $obj_con = new class_dbconnector();

         $sSQL = "SELECT * FROM tbl_buyer_purchased_item AS c , tbl_users
             AS u,tbl_item_details as i  where c.seller_id = u.id and
             package_name='basic' and i.item_id = c.item_id  ";

          if(isset($this->seller_id))
          {
          $sSQL.= " AND c.seller_id='$this->seller_id'";
          }
          // 0 for not paid 1 for paid
          if(isset($this->status)) 
          {
          $sSQL.= " AND c.commision_status='$this->status'";
          }

          if(isset($this->date_value))
          {
          $today_date_val = date('Y-m-d');
          $sSQL.= " AND c.purchase_date BETWEEN ('$this->date_value' AND '$today_date_val') ";
          }

       
     // echo   $sSQL.= " order by c.seller_id desc ";
       //    echo '<br>';
            $RecordSet = $obj_con->select($sSQL);

            $obj_con->connection_close();

            return $RecordSet;
}


function insertUpdatetranstemp()
{

	$ObjClsDBInteraction = new class_dbconnector();
	
	if($this->message!='' )
	$arr["message_val"]   		= $this->message;
	
	if(isset($this->id) && $this->id!="")
	{
		$sWhere = " id = '$this->id'";
		
		$nReturnValue = $ObjClsDBInteraction->insertUpdate("temp", $arr, $sWhere);
	}
	else
	{   
	
		$nReturnValue = $ObjClsDBInteraction->insertUpdate("temp", $arr, null);
	}
		//print_r($arr);
	$nReturnValue ;

		
	$ObjClsDBInteraction->connection_close();
	return $nReturnValue;
}



//end of function

function insertUpdatepurchaseditemfeedback()
{
	$ObjClsDBInteraction = new class_dbconnector();
	
	if(isset($this->feedbackid1) && $this->feedbackid1!="")
	{
		$sWhere = " id = '$this->feedbackid1' "; 
		$arr["feedback_status"] = "1";
		$nReturnValue = $ObjClsDBInteraction->insertUpdate("tbl_buyer_purchased_item",$arr,$sWhere);
	}
			
	$nReturnValue ;

		
	$ObjClsDBInteraction->connection_close();
	return $nReturnValue;
}
//tbl_sellers_buyers




//select total items to be shown on site including locker items 
function select_total_items()
{
        $ObjClsDBInteraction = new class_dbconnector();
	//$sSQL = "SELECT * FROM tbl_category_master c,tbl_item_details i WHERE
        //i.parent_id=c.category_id and i.status=1  and i.delete_by_seller = 0 and i.delete_restored=0 ";
        $sSQL = "SELECT * FROM tbl_category_master c,tbl_item_details i WHERE
        i.parent_id=c.category_id and i.status=1  and i.delete_by_seller = 0  ";

        if(isset($this->seller_id) && $this->seller_id!='')
	$sSQL .= " AND i.seller_id= '$this->seller_id' ";

		//echo $sSQL . ";<br><br><br>";
	$objRecordSet = $ObjClsDBInteraction->select($sSQL);
	$ObjClsDBInteraction->connection_close();
	return $objRecordSet;
}//end of function

// commision on sold item

function insertUpdatecommisionitem()
{

	$ObjClsDBInteraction = new class_dbconnector();

        if(isset($this->commision_amount) && $this->commision_amount!='')
	$arr["commision_amount"]  	= $this->commision_amount;

	if(isset($this->commisionpaid_date) && $this->commisionpaid_date!='')
	$arr["commisionpaid_date"]  	 = date('Y-m-d');

	if(isset($this->commision_transaction) && $this->commision_transaction!='')
	$arr["commision_transaction"]  	 = $this->commision_transaction;

	if(isset($this->commisionvalues_returned) && $this->commisionvalues_returned!='')
	$arr["commisionvalues_returned"] = $this->commisionvalues_returned;
        
        if(isset($this->commision_status) && $this->commision_status!='')
	$arr["commision_status"] = $this->commision_status;

	if(isset($this->id) && $this->id!="")
	{
		$sWhere = " id in ($this->id)";
		//$arr["shiping_date"] = date("Y-m-d H:i:s");
		$nReturnValue = $ObjClsDBInteraction->insertUpdate("tbl_buyer_purchased_item", $arr, $sWhere);
	}
	else
	{
		//$arr["purchase_date"] = date("Y-m-d H:i:s");
		$nReturnValue = $ObjClsDBInteraction->insertUpdate("tbl_buyer_purchased_item", $arr, null);
	}

	$nReturnValue ;


	$ObjClsDBInteraction->connection_close();
	return $nReturnValue;
}
//******* purchased item ****


function insertUpdatepurchaseditem()
{

	$ObjClsDBInteraction = new class_dbconnector();
        
	if(isset($this->purchased_quantity ) && $this->purchased_quantity!='')
        $arr["quantity"]           = $this->purchased_quantity ;
        
        if(isset($this->total_cost_paid ) && $this->total_cost_paid!='')
        $arr["total_cost_paid"]           = $this->total_cost_paid ; // total amount paid on paypal

        if(isset($this->package_name) && $this->package_name!='')
        $arr["package_name"]           = $this->package_name;

	if(isset($this->shipping_cost) && $this->shipping_cost!='')
	$arr["ship_cost"]   		= $this->shipping_cost;

        if(isset($this->payment_status) && $this->payment_status!='')
	$arr["payment_status"]          = $this->payment_status;

	if(isset($this->item_id) && $this->item_id!='')
	$arr["item_id"]   		= $this->item_id;

	if(isset($this->buyer_id) && $this->buyer_id!='')
	$arr["buyer_id"]   		= $this->buyer_id;

	if(isset($this->seller_id) && $this->seller_id!='')
	$arr["seller_id"]   		= $this->seller_id;

	if(isset($this->amount) && $this->amount!='')
	$arr["amount"]   		= $this->amount;

        if(isset($this->commision) && $this->commision!='')
	$arr["commision_amount"]   		= $this->commision;

	if(isset($this->shipping_status) && $this->shipping_status!='')
	$arr["shipping_status"]   	 =  $this->shipping_status;

	if(isset($this->paymentmode)    &&  $this->paymentmode!='')
	$arr["paymentmode"]   		=   $this->paymentmode;



	if(isset($this->trans_id) && $this->trans_id!='')
	$arr["trans_id"]   		= $this->trans_id;

	if(isset($this->values_returned) && $this->values_returned!='')
	$arr["values_returned"]   	= $this->values_returned;
	
	if(isset($this->gift_card1) && $this->gift_card1!='')
	$arr["gift_card1"]   		= $this->gift_card1;

	if(isset($this->gift_card2) && $this->gift_card2!='')
	$arr["gift_card2"]   		= $this->gift_card2;
	

	//if(isset($this->gift_card2) && $this->gift_card2!='')
	//$arr["gift_card2"]   		= $this->gift_card2;
	

	if(isset($this->id) && $this->id!="")
	{
		$sWhere = " id = '$this->id'";
		// $arr["shiping_date"] = date("Y-m-d H:i:s");
		$nReturnValue = $ObjClsDBInteraction->insertUpdate("tbl_buyer_purchased_item", $arr, $sWhere);
	}
	else
	{   
		$arr["purchase_date"] = date("Y-m-d H:i:s"); 
		$nReturnValue = $ObjClsDBInteraction->insertUpdate("tbl_buyer_purchased_item", $arr, null);
	}
		
	$nReturnValue ;

		
	$ObjClsDBInteraction->connection_close();
	return $nReturnValue;
}

//******* end purchased item ****

//******** gift card  details
//******** gift card  details


function getgiftcard_detailadmin()
{

         $obj_con = new class_dbconnector();
 
         $sSQL = "SELECT * FROM tbl_giftcard AS g LEFT JOIN tbl_users AS u ON g.buyer_id = u.id  where 1=1 ";

             if(isset($this->username))
             {
             $username= trim($this->username,'');
             $sSQL.= " AND u.username = \"$username\"";
             }

             if(isset($this->user_id))
             {
             $sSQL.= " AND g.buyer_id='$this->user_id'";
             }


            if(isset($this->receiver))
            {
             $rec_name= trim($this->receiver,'');
             $sSQL.= " AND g.recivername = \"$rec_name\" ";
            }
	     if(isset($this->cardcode))
            {
                $sSQL.= " AND g.giftcardnumber='$this->cardcode'";
            }

            if(isset($this->pageLimit) && $this->pageLimit!="")
            {
              $sSQL .= $this->pageLimit;
            }
            
          // $sSQL;
            $RecordSet = $obj_con->select($sSQL);
            $obj_con->connection_close();
            return $RecordSet;
}
function getgiftcarddetailUser()
{	$obj_con = new class_dbconnector();

	//$sSQL = "SELECT * FROM tbl_giftcard as g left join tbl_reminder_giftcards_message as //rm_g on g.id= rm_g.giftcard_id  left join  tbl_reminders as rm on rm.rem_id=rm_g.rem_id  //where g.id is not null";

	$sSQL = "SELECT * FROM tbl_giftcard g,tbl_users u  where g.seller_id = u.id is not null";
	if(isset($this->cardcode))
	{
		$sSQL.= " AND giftcardnumber='$this->cardcode'";
	}
	
	
 	$sSQL.=" order by create_date desc";

	
   	//echo $sSQL;exit;
	$RecordSet = $obj_con->select($sSQL);
	$obj_con->connection_close();
	return $RecordSet;
}


function getgiftcarddetail()
{
// echo 	$this->seller_id;
//exit;
    $obj_con = new class_dbconnector();

	//$sSQL = "SELECT * FROM tbl_giftcard as g left join tbl_reminder_giftcards_message as //rm_g on g.id= rm_g.giftcard_id  left join  tbl_reminders as rm on rm.rem_id=rm_g.rem_id  //where g.id is not null";
	
	$sSQL = "SELECT *   FROM tbl_giftcard   where id is not null";
	if(isset($this->cardcode))
	{
		$sSQL.= " AND giftcardnumber='$this->cardcode'";
	}
	if(isset($this->user_id))
	{
		$sSQL.= " AND buyer_id='$this->user_id'";
	}
	if(isset($this->seller_id) && $this->seller_id!='' )
	{
		$sSQL.= " AND seller_id='$this->seller_id'";
	}
	
	if(isset($this->paidstatus))
	{
		$sSQL.= " AND paidstatus='$this->paidstatus'";
	}
	if(isset($this->id))
	{
		$sSQL.= " AND id='$this->id'";
	}
 	$sSQL.="  order by create_date desc";
	
	if(isset($this->pageLimit) && $this->pageLimit!="")
    {
    	$sSQL .= $this->pageLimit;
	}
  //echo  $sSQL;
  //exit;
	$RecordSet = $obj_con->select($sSQL);
	$obj_con->connection_close();
	return $RecordSet;
}

//******** item details

function getpurchaseitem()
{
	$obj_con = new class_dbconnector();

	$sSQL = "SELECT * FROM tbl_item_details where  item_id is not null";
	if(isset($this->seller_id))
	{
		$sSQL.= " AND seller_id='$this->seller_id'";
	}
	if(isset($this->item_id))
	{
		$sSQL.= " AND item_id = '$this->item_id'";
	}
	$sSQL;
	$RecordSet = $obj_con->select($sSQL);
	$obj_con->connection_close();
	return $RecordSet;
}

//Gift card
function insertUpdategiftcard()
{
	$ObjClsDBInteraction = new class_dbconnector();
	
	if(isset($this->name) && $this->name!='')
	$arr["recivername"]   		= $this->name;

	if(isset($this->buyerid) && $this->buyerid!='')
	$arr["buyer_id"]   		= $this->buyerid;
		
	if(isset($this->seller_id) && $this->seller_id!='')
	$arr["seller_id"]   		= $this->seller_id;

	if(isset($this->email) && $this->email!='')
	$arr["reciveremail"]   		= $this->email;

	if(isset($this->city) && $this->city!='')
	$arr["recivercity"]   		= $this->city;

	if(isset($this->reciverstate) && $this->reciverstate!='')
	$arr["reciverstate"]   		= $this->reciverstate;

	if(isset($this->country) && $this->country!='')
	$arr["recivercountry"]   	= $this->country;

	if(isset($this->paymentstatus) && $this->paymentstatus!='')
	$arr["paidstatus"]   		= $this->paymentstatus;

	if(isset($this->TRANSACTIONID) && $this->TRANSACTIONID!='')
	$arr["recivertransactionid"]   	= $this->TRANSACTIONID;

	if(isset($this->paid_amount) && $this->paid_amount!='')
	$arr["reciveramount"]   	= $this->paid_amount;

	if(isset($this->cvv2) && $this->cvv2!='')
	$arr["reciver_avc_code"]   		 = $this->cvv2;

	if(isset($this->avs_code) && $this->avs_code!='')
	$arr["recivercvv2"]   		         = $this->avs_code;

	if(isset($this->paid_amount_first_card) )
	$arr["reciveramount"]   		 = $this->paid_amount_first_card;
	
	if(isset($this->paid_amount_second_card) )
        {
        $arr["reciveramount"]   		 = $this->paid_amount_second_card;
         // exit;
	}

    if(isset($this->cardnumber) && $this->cardnumber!='')
	$arr["giftcardnumber"]   		 = $this->cardnumber;
	
	if(isset($this->giftcardnumber) && $this->giftcardnumber!='')
	$arr["giftcardnumber"]   		 = $this->giftcardnumber;
	                                  
	//echo 'cardno='.$this->cardnumber;
          //     echo    'giftcardnumber='.$this->giftcardnumber;
            //   echo  'check_condition='.$this->check_condition;

          // exit;
 	if(((isset($this->cardnumber) && $this->cardnumber!="")||(isset($this->giftcardnumber) && $this->giftcardnumber!="")) && $this->check_condition==1)
	{     //exit;

	$check_var=($this->giftcardnumber!="")?$this->giftcardnumber:$this->cardnumber;
		$sWhere = " giftcardnumber = '$check_var'";	
		$arr["gift_card_amount_alter_date"] = date("Y-m-d H:i:s"); 
		$nReturnValue = $ObjClsDBInteraction->insertUpdate("tbl_giftcard", $arr, $sWhere);
	}
	else
	{   
	
		$arr["create_date"] = date("Y-m-d H:i:s"); 
		$nReturnValue = $ObjClsDBInteraction->insertUpdate("tbl_giftcard", $arr, null);
	       $_SESSION['last_gift_id'] = mysql_insert_id();
		//exit;
	}
		
	$nReturnValue ;

		
	$ObjClsDBInteraction->connection_close();
	return $nReturnValue;
}
//get feedback detail for buyer and seller

function getTotalCommision_OnSoldItem()
{
	 $obj_con = new class_dbconnector();

	 $sSQL = "SELECT GROUP_CONCAT(CAST(id as CHAR)) as all_trans_ids,sum(commision_amount) as
             total_amt_commison  FROM  tbl_buyer_purchased_item where 1=1    ";




	if(isset($this->seller_id))
	{
	$sSQL.= "  AND seller_id='$this->seller_id' ";
	}

        $sSQL = $sSQL.' AND commision_status=0  group by seller_id ';
       
         //$sSQL;
         // '<br>';


	$RecordSet = $obj_con->select($sSQL);
	$obj_con->connection_close();
	return $RecordSet;
}

//show all purchased item
function getsolditem_withcommision()
{
	 $obj_con = new class_dbconnector();
	
	 $sSQL = "SELECT * ,catm.name as
             sub_cat_name,tbl_buyer_purchased_item.id s FROM  tbl_buyer_purchased_item,
        tbl_item_details,tbl_users,tbl_category_master catm WHERE
        tbl_buyer_purchased_item.item_id = tbl_item_details.item_id
        AND tbl_buyer_purchased_item.seller_id = tbl_users.id and
        catm.category_id=tbl_item_details.category_id   ";

	if(isset($this->item_id))
	{
	$sSQL.= "  AND 	tbl_buyer_purchased_item.item_id='$this->item_id' ";
	}

	if(isset($this->seller_id))
	{
	$sSQL.= "  AND tbl_buyer_purchased_item.seller_id='$this->seller_id' ";
	}
	
	if(isset($this->commision_status))
	{
	$sSQL.= "  AND tbl_buyer_purchased_item.commision_status='$this->commision_status' ";
	}
	if(isset($this->payment_status))
	{
	$sSQL.= "  AND tbl_buyer_purchased_item.payment_status='$this->payment_status' ";
	}
	
	
	if(isset($this->user_id))
	{
	$sSQL.= "  AND tbl_users.id='$this->user_id' ";
	}
	
	if(isset($this->buyer_id))
	{
	 $sSQL.= "  AND tbl_buyer_purchased_item.buyer_id='$this->buyer_id' ";
	}

	if(isset($this->category_id))
	{
	 $sSQL.= "  AND tbl_item_details.category_id='$this->category_id' ";
	}

	if(isset($this->first_name))
	{
	$sSQL.= "  AND tbl_users.first_name like '%$this->first_name%' ";
	}
    if(isset($this->country_value))
	{
	$sSQL.= "  AND tbl_users.country_id= '$this->country_value' ";
	}
        if(isset($this->state))
	{
	$sSQL.= "  AND tbl_users.state= '$this->state' ";
	}
        if(isset($this->city))
	{
	$sSQL.= "  AND tbl_users.city= '$this->city' ";
	}

	if(isset($this->title))
	{
	$sSQL.= "  AND tbl_item_details.title like '$this->title%' ";
	}

	if(isset($this->parent_category_id))
	{
	$sSQL.= "  AND tbl_item_details.parent_id = '$this->parent_category_id' ";
	}
        if(isset($this->cost_item))
	{
	$sSQL.= "  AND tbl_item_details.cost_item = $this->cost_item ";
	}
         
        
	if(isset($this->commision_amount))
	{
	$sSQL.= "  AND tbl_buyer_purchased_item.commision_amount  = '$this->commision_amount' ";
	}
      
     if(isset($this->paymentmode))
	{
	$sSQL.= "  AND tbl_buyer_purchased_item.paymentmode= '$this->paymentmode' ";
	}
	
    if(isset($this->sel_days) && $this->sel_days!=0 && $this->sel_month!=0)
	{
	$sSQL.= "  AND EXTRACT(DAY FROM tbl_buyer_purchased_item.purchase_date) = '$this->sel_days' ";
	}
        if(isset($this->sel_month) && $this->sel_month!=0)
	{
	$sSQL.= "  AND EXTRACT(MONTH FROM tbl_buyer_purchased_item.purchase_date) = '$this->sel_month' ";
	}
         if(isset($this->sel_year) && $this->sel_year!=0)
	{
	$sSQL.= "  AND EXTRACT(YEAR FROM tbl_buyer_purchased_item.purchase_date) = '$this->sel_year' ";
	}
        if(isset($this->purchased_date)&& $this->purchased_date==1)
	{
	  //$sSQL .= " AND ( EXTRACT(YEAR FROM tbl_buyer_purchased_item.purchase_date) =
	  //'$this->sel_year' AND  EXTRACT(MONTH FROM   tbl_buyer_purchased_item.purchase_date)='$this->sel_month') " ;
	}



	 /*
         if($this->purchased_date==12 ||$this->purchased_date=='')
	{
	  $sSQL .= " AND  DATE(tbl_buyer_purchased_item.purchase_date)=DATE(NOW()) ";
	}

       

	if($this->purchased_date==12 ||$this->purchased_date=='')
	{
	  $sSQL .= " AND  DATE(tbl_buyer_purchased_item.purchase_date)=DATE(NOW()) ";
	}
	
	
	
		
	if(isset($this->purchased_date)&& $this->purchased_date==2)
	{
	  $sSQL .= ' AND ( tbl_buyer_purchased_item.purchase_date between DATE_SUB(NOW(),INTERVAL 7 DAY ) AND NOW()) ';
	}

	*/
	
	if(isset($this->default_value))
	{
	  $sSQL .= '  order by  tbl_buyer_purchased_item.purchase_date desc ';
	}
    
    
	if(isset($this->pageLimit) && $this->pageLimit!="")
	{
		$sSQL .= $this->pageLimit;
	}
    // echo $sSQL; echo '<br>';
	

	$RecordSet = $obj_con->select($sSQL);
	$obj_con->connection_close();
	return $RecordSet;
}


//show all item
function getbuyitem()
{

	 $obj_con = new class_dbconnector();

	 $sSQL = "SELECT *,SUM(tbl_buyer_purchased_item.amount) as tot_purchase_cost ,tbl_users.id as seller_id ,tbl_buyer_purchased_item.id s, tbl_category_master.name tcm_sub_cat_name
	 FROM   tbl_buyer_purchased_item, tbl_item_details,tbl_users,tbl_country_master,tbl_category_master
         WHERE  tbl_buyer_purchased_item.item_id = tbl_item_details.item_id AND tbl_buyer_purchased_item.seller_id = tbl_users.id
         AND tbl_country_master.id = tbl_users.country_id and tbl_category_master.category_id = tbl_item_details.category_id ";

	if(isset($this->item_id))
	{
	$sSQL.= "  AND 	tbl_buyer_purchased_item.item_id='$this->item_id' ";
	}

	if(isset($this->seller_id))
	{
	$sSQL.= "  AND tbl_buyer_purchased_item.seller_id='$this->seller_id' ";
	}

	if(isset($this->payment_status))
	{
	$sSQL.= "  AND tbl_buyer_purchased_item.payment_status='$this->payment_status' ";
	}


	if(isset($this->user_id))
	{
	$sSQL.= "  AND tbl_users.id='$this->user_id' ";
	}

	if(isset($this->buyer_id))
	{
	 $sSQL.= "  AND tbl_buyer_purchased_item.buyer_id='$this->buyer_id' ";
	}

	if(isset($this->category_id))
	{
	 $sSQL.= "  AND tbl_item_details.category_id='$this->category_id' ";
	}

	if(isset($this->first_name))
	{
	$sSQL.= "  AND tbl_users.first_name like '%$this->first_name%' ";
	}

	if(isset($this->title))
	{
	$sSQL.= "  AND tbl_item_details.title like '$this->title%' ";
	}

	if(isset($this->cost_item))
	{
	$sSQL.= "  AND  tbl_item_details.cost_item =$this->cost_item ";
	}

	if(isset($this->purchased_cost))
	{
	$sSQL.= "  AND tbl_buyer_purchased_item.amount =$this->purchased_cost ";
	}
	if(isset($this->country_value))
	{
	$sSQL.= "  AND tbl_users.country_id = '$this->country_value' ";
	}
        if(isset($this->state))
	{
	$sSQL.= "  AND tbl_item_details.state = '$this->state' ";
	}

	if(isset($this->paymentmode))
	{
	$sSQL.= "  AND tbl_buyer_purchased_item.paymentmode= '$this->paymentmode' ";
	}

	if($this->purchased_date==12 ||$this->purchased_date=='')
	{
	 $sSQL .= " AND  DATE(tbl_buyer_purchased_item.purchase_date)=DATE(NOW()) ";
	}

	if($this->sel_year!='' && isset($this->sel_year)&& $this->purchased_date==1)
	{
	 $sSQL.= " AND  EXTRACT(YEAR FROM tbl_buyer_purchased_item.purchase_date)= '$this->sel_year' ";
	}
        if($this->sel_month!=0 && isset($this->sel_month)&& $this->purchased_date==1)
	{
	 $sSQL.= " AND  EXTRACT(MONTH FROM tbl_buyer_purchased_item.purchase_date)='$this->sel_month'";
	}
        if($this->sel_month!=0 && isset($this->sel_month)&& $this->sel_days!=0 && isset($this->sel_days)&& $this->purchased_date==1)
	{
	 $sSQL.= " AND  EXTRACT(DAY  FROM tbl_buyer_purchased_item.purchase_date)= '$this->sel_days' ";
	}

	if(isset($this->purchased_date)&& $this->purchased_date==1)
	{
	  //$sSQL .= " AND ( EXTRACT(YEAR FROM tbl_buyer_purchased_item.purchase_date) =
	  //'$this->sel_year' AND  EXTRACT(MONTH FROM tbl_buyer_purchased_item.purchase_date)='$this->sel_month') " ;
	}

	if(isset($this->purchased_date)&& $this->purchased_date==2)
	{
	  $sSQL .= ' AND ( tbl_buyer_purchased_item.purchase_date between DATE_SUB(NOW(),INTERVAL 7 DAY ) AND NOW()) ';
	}
        if(isset($this->shipping_status)&& $this->shipping_status!=0)
	{
            // 2 pending 1 completed
                   if($this->shipping_status==1)
                   $status_val =1;
                   else
                   $status_val =0;

	  $sSQL .= " AND ( tbl_buyer_purchased_item.shipping_status='$status_val' ) ";
	}

         $sSQL .= " group by tbl_buyer_purchased_item.id ";

	if(isset($this->default_value))
	{
	  $sSQL .= ' order by tbl_buyer_purchased_item.purchase_date desc ';
	}


	if(isset($this->pageLimit) && $this->pageLimit!="")
	{
		$sSQL .= $this->pageLimit;
	}
 //echo        $sSQL;
//echo     '<br>';

	$RecordSet = $obj_con->select($sSQL);
	$obj_con->connection_close();
	return $RecordSet;
}



//get feedback detail for buyer and seller
//for last month feedback
function lastmonth()
{
	$obj_con = new class_dbconnector();
	
	$sSQL = "SELECT * FROM tbl_item_feedback where id is not null";

	if(isset($this->user_id))
	{
		$sSQL.= " AND seller_id='$this->user_id'";
	}
	if(isset($this->user_id))
	{
		$sSQL.= " AND create_date >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH) group by feedback ";
	}
	$sSQL;
	$RecordSet = $obj_con->select($sSQL);
	$obj_con->connection_close();
	return $RecordSet;
}
function sixmonth()
{
	$obj_con = new class_dbconnector();
	
	$sSQL = "SELECT * FROM tbl_item_feedback where id is not null";

	if(isset($this->user_id))
	{
		$sSQL.= " AND seller_id='$this->user_id'";
	}
	if(isset($this->user_id))
	{
		$sSQL.= " AND create_date>= DATE_SUB(CURDATE(), INTERVAL 6 MONTH) ";
	}
	$sSQL;
	$RecordSet = $obj_con->select($sSQL);
	$obj_con->connection_close();
	return $RecordSet;
}
function twelvemonth()
{
	$obj_con = new class_dbconnector();
	
	$sSQL = "SELECT * FROM tbl_item_feedback where id is not null";

	if(isset($this->user_id))
	{
		$sSQL.= " AND seller_id='$this->user_id'";
	}
	if(isset($this->user_id))
	{
		$sSQL.= " AND create_date>= DATE_SUB(CURDATE(), INTERVAL 12 MONTH)";
	}
	$sSQL;
	$RecordSet = $obj_con->select($sSQL);
	$obj_con->connection_close();
	return $RecordSet;
}

function getfeedbackstore()
{
	$obj_con = new class_dbconnector();
	
	$sSQL = "SELECT tbl_item_feedback.*,tbl_users.* FROM tbl_item_feedback,tbl_users where tbl_item_feedback.seller_id = tbl_users.id ";

	if(isset($this->user_id))
	{
		$sSQL.= " AND tbl_item_feedback.seller_id='$this->user_id'";
	}

	if(isset($this->pageLimit) && $this->pageLimit!="")
	{
		$sSQL .= $this->pageLimit;
	}
	$sSQL;

	$RecordSet = $obj_con->select($sSQL);
	$obj_con->connection_close();
	return $RecordSet;
}


function getviewfeedbackseller()
{
	$obj_con = new class_dbconnector();
	
	$sSQL = "SELECT tbl_item_feedback.*,tbl_users.*,tbl_item_details.* FROM tbl_item_feedback,tbl_users,tbl_item_details where tbl_item_feedback.buyer_id = tbl_users.id and tbl_item_feedback.item_id = tbl_item_details.item_id";

	if(isset($this->user_id))
	{
		$sSQL.= " AND tbl_item_feedback.seller_id='$this->user_id'";
	}

	$sSQL.= " order by create_date desc ";

	if(isset($this->pageLimit) && $this->pageLimit!="")
	{
		$sSQL .= $this->pageLimit;
	}
	$sSQL;

	$RecordSet = $obj_con->select($sSQL);
	$obj_con->connection_close();
	return $RecordSet;
}

//for buyer
function getviewfeedback()
{
	$obj_con = new class_dbconnector();
	
	$sSQL = "SELECT tbl_item_feedback.*,tbl_users.*,tbl_item_details.* FROM tbl_item_feedback,tbl_users,tbl_item_details where tbl_item_feedback.seller_id = tbl_users.id and tbl_item_feedback.item_id = tbl_item_details.item_id";

	if(isset($this->user_id))
	{
		$sSQL.= " AND tbl_item_feedback.buyer_id='$this->user_id'";
	}
         $sSQL.= " order by tbl_item_feedback.create_date desc ";
	if(isset($this->pageLimit) && $this->pageLimit!="")
	{
		$sSQL .= $this->pageLimit;
	}
	$sSQL;

	$RecordSet = $obj_con->select($sSQL);
	$obj_con->connection_close();
	return $RecordSet;
}
//show all purchased item
function getfeedback()
{
	$obj_con = new class_dbconnector();
	
	$sSQL = "SELECT * FROM tbl_item_feedback where id is not null";

	if(isset($this->item_id))
	{
		$sSQL.= " AND item_id='$this->item_id'";
	}

	if(isset($this->seller_id))
	{
		$sSQL.= "  AND seller_id='$this->seller_id'";
	}
	
	if(isset($this->buyer_id))
	{
		$sSQL.= "  AND buyer_id='$this->buyer_id'";
	}

	if(isset($this->pageLimit) && $this->pageLimit!="")
	{
		$sSQL .= $this->pageLimit;
	}
	$sSQL;

	$RecordSet = $obj_con->select($sSQL);
	$obj_con->connection_close();
	return $RecordSet;
}
//inserting feedback on items
function insertUpdatefeedback()
{
	$ObjClsDBInteraction = new class_dbconnector();
	
	if(isset($this->item_id) && $this->item_id!='')
	$arr["item_id"]   		= $this->item_id;

	if(isset($this->buyer_id) && $this->buyer_id!='')
	$arr["buyer_id"]   		= $this->buyer_id;

	if(isset($this->seller_id) && $this->seller_id!='')
	$arr["seller_id"]   		= $this->seller_id;

	if(isset($this->comment) && $this->comment!='')
	$arr["comment"]   		= $this->comment;

	if(isset($this->feedback) && $this->feedback!='')
	$arr["feedback"]   		= $this->feedback;

	if(isset($this->feedbackid) && $this->feedbackid!="")
	{
		$sWhere = " id = '$this->feedbackid'";
		$arr["alter_date"] = date("Y-m-d H:i:s"); 
		$nReturnValue = $ObjClsDBInteraction->insertUpdate("tbl_item_feedback", $arr, $sWhere);
	}
	else
	{   
		$arr["create_date"] = date("Y-m-d H:i:s"); 
		$nReturnValue = $ObjClsDBInteraction->insertUpdate("tbl_item_feedback", $arr, null);
	}	
	$nReturnValue ;

		
		$ObjClsDBInteraction->connection_close();
		return $nReturnValue;
}
//end of function










// end deepak 21-june
function deleteFavItems()
{
	$ObjClsDBInteraction = new class_dbconnector();
	// $this->id;
	if(isset($this->id))
	{
		$sSQL ="DELETE  FROM tbl_buyer_favorite_item  WHERE id='$this->id'"; 
		
	}
	 $sSQL;
	
	$objRecordSet = $ObjClsDBInteraction->select( $sSQL );
	$ObjClsDBInteraction->connection_close();
	return $objRecordSet;
}//end of function

//get favorite items for my account page
function getallfavorite()
{
	$obj_con = new class_dbconnector();
	$sSQL = " SELECT tbl_buyer_favorite_item.*,tbl_item_details.* FROM   tbl_buyer_favorite_item, tbl_item_details  where tbl_buyer_favorite_item.item_id=  tbl_item_details.item_id ";

	if(isset($this->item_id))
	{
		$sSQL.= "  AND 	item_id='$this->item_id'";
	}

	if(isset($this->user_id))
	{
		$sSQL.= "  AND tbl_buyer_favorite_item.user_id='$this->user_id'";
	}
$sSQL.= " order  by create_date desc ";
	if(isset($this->pageLimit) && $this->pageLimit!="")
	{
		$sSQL .= $this->pageLimit;
	}
	$sSQL;

	$RecordSet = $obj_con->select($sSQL);
	$obj_con->connection_close();
	return $RecordSet;
}
//end of function
//get favorite items
function getfavorite()
{
	$obj_con = new class_dbconnector();
	$sSQL = " SELECT * FROM   tbl_buyer_favorite_item  where id IS NOT NULL ";
	if(isset($this->item_id))
	{
		$sSQL.= "  AND 	item_id='$this->item_id'";
	}

	if(isset($this->user_id))
	{
		 $sSQL.= "  AND 	user_id='$this->user_id'";
	}
	$sSQL;

	$RecordSet = $obj_con->select($sSQL);
	$obj_con->connection_close();
	return $RecordSet;
}
//end of function

//inserting favorite items
function insertUpdatefavorite()
{
	$ObjClsDBInteraction = new class_dbconnector();
	
	if(isset($this->user_id))
	$arr["user_id"]   		        = $this->user_id;
	
	if(isset($this->item_id) && $this->item_id!='')
	$arr["item_id"]   		        = $this->item_id;

	$getfav	="select * from tbl_buyer_favorite_item where item_id='$this->item_id' and user_id='$this->user_id'"	;
	$count=mysql_num_rows(mysql_query($getfav));
	if($count==0)
	{
		$arr["create_date"] = date("Y-m-d H:i:s"); 
		$nReturnValue = $ObjClsDBInteraction->insertUpdate("tbl_buyer_favorite_item", $arr, null);
	}	
	$nReturnValue ;

		
$ObjClsDBInteraction->connection_close();
return $nReturnValue;
}
//end of function

//********************************* function end by deepak nagar ********************


//show all items with discount
function getitems_withCoupons()
{
	$obj_con = new class_dbconnector();
	
	$sSQL = "SELECT *,GROUP_CONCAT(title) as title_name from tbl_genrate_coupon  c ,
	tbl_item_details i where c.item_id = i.item_id and status='1' and hatting_status=0 ";

	

	if(isset($this->seller_id))
	{
		$sSQL.= "  AND i.seller_id='$this->seller_id'";
	}
	
	 $sSQL.= " group by coupon_code order by coupon_date desc ";
	if(isset($this->pageLimit) && $this->pageLimit!="")
	{
		$sSQL .= $this->pageLimit;
	}
 
	//echo  $sSQL;

	$RecordSet = $obj_con->select($sSQL);
	$obj_con->connection_close();
	return $RecordSet;
}


// function to add  shop as favorite list 
function add_favorite_shops()
      {
        $ObjClsDBInteraction = new class_dbconnector();
       
	    if(isset($this->buyer_id) && $this->buyer_id!='')
		$arr["user_id"]   		= $this->buyer_id;

		if(isset($this->shop_id) && $this->shop_id!='')
		$arr["shop_id"]   		= $this->shop_id;

		if(isset($this->fav_shop_id) && $this->fav_shop_id!="")
		{
		$sWhere          = " fav_shop_id = '$this->fav_shop_id'";
		$arr["add_date"] = date("Y-m-d H:i:s"); 
		$nReturnValue    = $ObjClsDBInteraction->insertUpdate("tbl_favorite_shops", $arr,  $sWhere);
    	}
	     else
    	{   
		$arr["add_date"] = date("Y-m-d H:i:s"); 
		$nReturnValue    = $ObjClsDBInteraction->insertUpdate("tbl_favorite_shops", $arr, null);
	    }	
	   $nReturnValue ;

    	$ObjClsDBInteraction->connection_close();
		return $nReturnValue;
	} 

// end of function
// function to know whther particular shop is in favorite list or not
function favorite_shops()
{
	
		$obj_con = new class_dbconnector();
		
		$sSQL = " SELECT * FROM   tbl_favorite_shops f,tbl_users u  where 1=1 and f.shop_id  =u.id   ";
		
		if(isset($this->shop_id))
		{
			$sSQL.= "  AND 	 f.shop_id='$this->shop_id'";
		}
	
		if(isset($this->buyer_id))
		{
			$sSQL.= "  AND 	f.user_id='$this->buyer_id'";
		}
	
	      
             $sSQL.= " order by f.add_date desc " ;
 
/*
		$sSQL = " SELECT * FROM   tbl_favorite_shops  where 1=1     ";
		
		if(isset($this->shop_id))
		{
			$sSQL.= "  AND 	  	shop_id='$this->shop_id'";
		}
	
		if(isset($this->buyer_id))
		{
			$sSQL.= "  AND 	user_id='$this->buyer_id'";
		}
	
	      
          //      $sSQL.= " order by add_date desc " ;
	*/          
	
		$RecordSet = $obj_con->select($sSQL);
		$obj_con->connection_close();
		return $RecordSet;
	} 

// end of function




// function to know whther bid exsist for particular item or not for tht seller
function BIDEXSISTS_ITEM()
{
	
		 $obj_con = new class_dbconnector();
 
 
	

		$sSQL = " SELECT * FROM   tbl_user_hatting_details  where 1=1     ";
		
		if(isset($this->item_value))
		{
			$sSQL.= "  AND 	item_id='$this->item_value'";
		}
	    if(isset($this->hat_id) )
		{
			$sSQL.= "  AND 	hat_id ='$this->hat_id' ";
		}
		if(isset($this->buyer_id))
		{
			$sSQL.= "  AND 	user_id='$this->buyer_id'";
		}
	
	      
         $sSQL;
	
	
		$RecordSet = $obj_con->select($sSQL);
		$obj_con->connection_close();
		return $RecordSet;
	} 

// end of function

  // function to know how many  users bid on particular haated item
function InventoryCheckItem_MESSAGES()
{
	
		 $obj_con = new class_dbconnector();	

		$sSQL = " SELECT * FROM tbl_item_details  where 1=1 and 
                inventory_alert >= quantity_available and
                delete_by_seller =0    ";
		
		if(isset($this->loggeduser_id))
		{
			$sSQL.= "  AND 	seller_id='$this->loggeduser_id'";
		}
	     
      //   $sSQL;	
	
		$RecordSet = $obj_con->select($sSQL);
		$obj_con->connection_close();
		return $RecordSet;
	} 

/// function ends here



// function to know how many  users bid on particular haated item
function HaatedItem_BIDDetails()
{
	
		 $obj_con = new class_dbconnector();
 


		$sSQL = "SELECT * FROM tbl_user_hatting_details h, tbl_users u WHERE h.user_id = u.id	";
		
		if(isset($this->item_id) )
		{
			$sSQL.= "  AND 	h.item_id ='$this->item_id'";
		}
	
	
	       if(isset($this->buyer_id) )
		{
			$sSQL.= "  AND 	h.user_id ='$this->buyer_id'";
		}
	
                        $sSQL;
	
	
		$RecordSet = $obj_con->select($sSQL);
		$obj_con->connection_close();
		return $RecordSet;
	} 

/// function ends here

// function to know any bid accepted or not
function checkHaatedItem_accepted()
{
	
		$obj_con = new class_dbconnector();
 
		$sSQL = "SELECT * FROM tbl_user_hatting_details where bid_status=1  	";
		
		if(isset($this->item_id) )
		{
			$sSQL.= "  AND 	item_id ='$this->item_id' ";
		}
		
	
         // $sSQL;
	
		$RecordSet = $obj_con->select($sSQL);
		$obj_con->connection_close();
		return $RecordSet;
	} 

/// function ends here


// function for buyers  haated items list
function BuyHaatedItemDetails()
{
	
		 $obj_con = new class_dbconnector();
 


		$sSQL = "SELECT * FROM tbl_user_hatting_details h,tbl_item_details i   WHERE 
		1=1  and  i.item_id =   h.item_id ";
		
		if(isset($this->item_id) )
		{
			$sSQL.= "  AND 	i.item_id ='$this->item_id'";
		}
	
		if(isset($this->bid_status) )
		{
			$sSQL.= "  AND 	h.bid_status ='$this->bid_status'";
		}
	

	       if(isset($this->buyer_id) )
		{
			$sSQL.= "  AND 	h.user_id ='$this->buyer_id'";
		}
	                $sSQL.=' order by h.hat_id desc';
	// '<br>';
	
		$RecordSet = $obj_con->select($sSQL);
		$obj_con->connection_close();
		return $RecordSet;
	} 

// function for buyers  haated items list
function BuyerBIDHistory_Details()
{
	
		 $obj_con = new class_dbconnector();
 


		$sSQL = "SELECT * FROM tbl_user_hatting_details h,
		tbl_item_details i   WHERE 1=1  and  i.item_id =   h.item_id ";
		
		if(isset($this->item_id) )
		{
			$sSQL.= "  AND 	i.item_id ='$this->item_id'";
		}
	
		if(isset($this->bid_status) )
		{
			$sSQL.= "  AND 	h.bid_status ='$this->bid_status'";
		}
	

	       if(isset($this->buyer_id) )
		{
			$sSQL.= "  AND 	h.user_id ='$this->buyer_id'";


		}
            
           $sSQL .= " GROUP BY h.item_id "; 
	 $sSQL .= " order by  h.add_date desc "; 
	
		if(isset($this->pageLimit) && $this->pageLimit!="")
		{
			$sSQL .= $this->pageLimit;
		}
	
	         
      $sSQL;
	
	
		$RecordSet = $obj_con->select($sSQL);
		$obj_con->connection_close();
		return $RecordSet;
	} 


 function getHaatedItemImageDetails()
{
       $obj_con = new class_dbconnector();

		
		  	
		

     $sSQL = "SELECT * FROM  tbl_user_hatting_details  where  bid_status=1   ";
	
		if(isset($this->item_id) && ($this->item_id!=""))
		{
		
			$sSQL.= "  AND 	item_id ='$this->item_id'";
		}

                if(isset($this->buyer_id) && ($this->buyer_id!=""))
		{
		
			$sSQL.= "  AND 	user_id ='$this->buyer_id'";
		}
                
		 if(isset($this->paid_status) && ($this->paid_status!=""))
		{
		
			$sSQL.= "  AND 	paid_status ='$this->paid_status'";
		}
		

	//echo $sSQL;
	
		
   //   echo  $sSQL.'<br>';
		
	    $RecordSet = $obj_con->select($sSQL);
		$obj_con->connection_close();
		return $RecordSet;
	} 
	
function getBIDdetails()
	{
	        $obj_con = new class_dbconnector();
 


		$sSQL = "SELECT * FROM tbl_user_hatting_details   WHERE 
		1=1  ";
		
		if(isset($this->item_id) )
		{
			$sSQL.= "  AND 	item_id ='$this->item_id'";
		}
	
		if(isset($this->bid_status) )
		{
			$sSQL.= "  AND 	bid_status ='$this->bid_status'";
		}
	

	       if(isset($this->user_id) )
		{
			$sSQL.= "  AND 	user_id ='$this->user_id'";
		}
	
        	 $sSQL;
	
	
		$RecordSet = $obj_con->select($sSQL);
		$obj_con->connection_close();
		return $RecordSet;
	} 






function gethat_max_minvalue()
	{
	        $obj_con = new class_dbconnector();
 


		$sSQL = "SELECT hat_min_value,hat_max_value FROM tbl_item_details where 1=1  ";
		
		if(isset($this->item_id) )
		{
			$sSQL.= "  AND 	item_id ='$this->item_id'";
		}
	
		
	
        //$sSQL;
	
	
		$RecordSet = $obj_con->select($sSQL);
		$obj_con->connection_close();
		return $RecordSet;
	} 


	// function to know bid limits of user for particular item

// function to know bid limits of user for particular item
function getBIDlimit()
	{
	        $obj_con = new class_dbconnector();
 
		$sSQL = "SELECT count(*) as number_bids, bid_status , hat_min_value , hat_max_value FROM
		tbl_user_hatting_details as h , tbl_item_details as i  WHERE 1=1 and  
		h.item_id = i.item_id  ";
		
		if(isset($this->item_id))
		{
		$sSQL.= "  AND 	h.item_id ='$this->item_id'";
		}
	
		if(isset($this->buyer_id) )
		{
		$sSQL.= "  AND 	h.user_id ='$this->buyer_id'";
		}
	
         	$sSQL;
	       $sSQL = $sSQL.' group by i.item_id ';
	//exit;
		$RecordSet = $obj_con->select($sSQL);
		$obj_con->connection_close();
		return $RecordSet;
	} 

	//Function Insert/Update iTem with bidding cost by buyers for haating item
	function insertBID_Hatingitems()
	{
	
		$ObjClsDBInteraction = new class_dbconnector();
		
		if(isset($this->item_value))
		$arr["item_id"]   		        = $this->item_value;
		
		if(isset($this->bid_value) && $this->bid_value!='')
		$arr["cost_posted"]   		        = $this->bid_value;
		
		if(isset($this->user_id) && $this->user_id!='')
		$arr["user_id"]   		        = $this->user_id;
		
		if(isset($this->bid_status) && $this->bid_status!='')
		$arr["bid_status"]   		        = $this->bid_status;
	          
		if(isset($this->hat_id) && $this->hat_id!="")
		{     
		
			 $sWhere = "   	hat_id = '$this->hat_id'";
			 $arr["add_date"] = date("Y-m-d H:i:s"); 
			 $nReturnValue = $ObjClsDBInteraction->insertUpdate("tbl_user_hatting_details", $arr, $sWhere);
		
		
		}
		else
		{   
		       $arr["bid_status"]   		 	= 0; // inactive product
			
			$arr["add_date"] = date("Y-m-d H:i:s"); 
			$nReturnValue = $ObjClsDBInteraction->insertUpdate("tbl_user_hatting_details", $arr, null);
			$last_bid_value_id  = mysql_insert_id();
		        $_SESSION['hat_id_last_id']       = $last_bid_value_id;
		}
	         	$ObjClsDBInteraction->connection_close();
		return $nReturnValue;
	}//end of function


       
//Function Insert/Update iTem status if cost posted greter than minum cost  for haating item
	function changeBID_StatusHatingitems($bid_status)
	{
	
		$ObjClsDBInteraction = new class_dbconnector();
		
		if(isset($this->last_id))
		$arr["hat_id"]   		        = $this->last_id;
		if(isset($this->paid_status))
		$arr["paid_status"]   		        = $this->paid_status;
		
		
		if(isset($this->last_id) && $this->last_id!="")
		{
		
		 $sWhere                                   = "   hat_id = '$this->last_id'";
		 // $arr["add_date"]                       =    date("Y-m-d H:i:s"); 
		 $arr["bid_status"]   		 	           =    $bid_status; // inactive product
		 $nReturnValue = $ObjClsDBInteraction->insertUpdate("tbl_user_hatting_details", $arr, $sWhere);
		
		
		}
       	       $ObjClsDBInteraction->connection_close();
		return $nReturnValue;
	}//end of function


//Function Insert/Update iTem details for active,pending suspend
	
	
	
	
	function insertUpdateItem1($val_stat)
	{
		$ObjClsDBInteraction = new class_dbconnector();
		
 		if(isset($this->item_value) && $this->item_value!="")
		$arr["item_id"]       = $this->item_value;
		
		if(isset($this->care) && $this->care!="")
		$arr["care"]   	      = $this->care;
		
		if(isset($val_stat) && $val_stat!='')
		$arr["status"]        = $val_stat;
               
	       if(isset($this->hatting_status)&& $this->hatting_status==0)
		{
                $arr["hatting_status"] = $this->hatting_status;
                $arr["hatting_time"]   = date("Y-m-d H:i:s");
		}
		if(isset($this->hatting_status)&& $this->hatting_status!='')
		{	
		 $arr["hatting_status"] = $this->hatting_status;
                 $arr["hatting_time"]   = date("Y-m-d H:i:s");
		}
		
		if(isset($this->item_max_value)&& $this->item_max_value!='')
		{
		$arr["hat_max_value"]                   =  $this->item_max_value;
		}

                if(isset($this->item_min_value)&& $this->item_min_value!='')
		$arr["hat_min_value"]                   =  $this->item_min_value;

                if(isset($this->quantity_available))
		$arr["quantity_available"]              =  $this->quantity_available;
      
            

        	if(isset($this->item_value) && $this->item_value!="")
		{
		 $sWhere = "   	item_id = '$this->item_value'";
		 $arr["date_modified"] = date("Y-m-d H:i:s"); 
		 $nReturnValue = $ObjClsDBInteraction->insertUpdate("tbl_item_details", $arr, $sWhere);
		}
		else
		{
		$arr["status"]   		 	= 0; // inactive product
		$arr["date_added"] = date("Y-m-d H:i:s");
		$arr["date_modified"] = date("Y-m-d H:i:s"); 
		$nReturnValue = $ObjClsDBInteraction->insertUpdate("tbl_item_details", $arr, null);
			
		}
	       	$ObjClsDBInteraction->connection_close();
		return $nReturnValue;
	}
	//end of function
	
	
	// checkreplace2
	//Function to get number of items with images  for one seller
	function getNoOfItemswithImagesforpartcularseller()
	{
		$obj_con = new class_dbconnector();
		//$sSQL.= "SELECT item_id, cost_item, title, image1 FROM tbl_item_details i, tbl_users u WHERE id =seller_id ";
		$sSQL.= "SELECT * FROM tbl_item_details WHERE 1=1  ";

                if(isset($this->package_expired))
		{
		$sSQL.= " AND 	expired_package  ='$this->package_expired' ";
		}
                if(isset($this->item_id) )
		{
			$sSQL .= " AND	item_id!='$this->item_id'";
		}
		if(isset($this->seller_id) )
		{
			$sSQL .= " AND seller_id ='$this->seller_id'";
		}
		
		if(isset($this->inventory_check)&& $this->inventory_check==1)
		{
			$sSQL .= " AND quantity_available >0";
		}
		if(isset($this->locker_status))
		{
			$sSQL .= " AND locker_status = '$this->locker_status'";
		}
		if(isset($this->delete_restored))
		{
			$sSQL .= " AND delete_restored ='$this->delete_restored'";

		}
                if(isset($this->delete_by_seller))
		{
			$sSQL .= " AND delete_by_seller  ='$this->delete_by_seller'";

		}
                if(isset($this->hatting_status))
		{
			$sSQL .= " AND hatting_status ='$this->hatting_status'";

		}
                if(isset($this->status))
		{
			$sSQL .= " AND status ='$this->status'";

		}
		//echo $sSQL;
		$RecordSet = $obj_con->select($sSQL);
		$obj_con->connection_close();
		return $RecordSet;
	} 


        //Function to get number of items in sellers list
	function getNoOfItems()
	{
	        $obj_con = new class_dbconnector();

		$sSQL = "SELECT count(*) as number_items FROM tbl_item_details,tbl_users WHERE 
		id = seller_id  ";
		
		
		if(isset($this->seller_id) )
		{
			$sSQL.= "  AND 	seller_id ='$this->seller_id'";
		}
	
        	$sSQL;
		$RecordSet = $obj_con->select($sSQL);
		$obj_con->connection_close();
		return $RecordSet;
	} 
	


 function getItem_Detailsfourtimes()
	{    
	      $obj_con = new class_dbconnector();

	      $sSQL = "SELECT * FROM tbl_user_hatting_details  where item_id=\"$this->item_id\" AND 
	      bid_status=1  ";
		  
		  if(isset($this->poster_session_id) )
		{
			$sSQL.= "  AND 	user_id ='$this->poster_session_id'";
		}
			
              $sSQL;
	      $RecordSet = $obj_con->select($sSQL);
		$obj_con->connection_close();
		return $RecordSet;

	}


          
	   // checkreplace
	function getItemImageDetails_withdiscount()
	{    
		$obj_con = new class_dbconnector();

		$sSQL = "SELECT *,i.item_id as show_item_id  FROM tbl_item_details i Left join  tbl_genrate_coupon c on c.item_id = i.item_id where  i.quantity_available>0 AND i.status = 1  ";

         if(isset($this->seller_otheritem_id) )
		{
			$sSQL .= " AND	i.item_id!='$this->seller_otheritem_id'";
		}
	
		if(isset($this->seller_id))
		{
		$sSQL.= " AND 	i.seller_id ='$this->seller_id' ";
		}
        if(isset($this->hatting_status))
		{
		$sSQL.= " AND 	i.hatting_status ='$this->hatting_status' ";
		}
         if(isset($this->delete_by_seller))
		{
		$sSQL.= " AND 	i.delete_by_seller  ='$this->delete_by_seller' ";
		}
         if(isset($this->delete_restored))
		{
		$sSQL.= " AND 	i.delete_restored  ='$this->delete_restored' ";
		}
        if(isset($this->locker_status))
		{
		$sSQL.= " AND 	i.locker_status  ='$this->locker_status' ";
		}
    	if(isset($this->inventory_check)&& $this->inventory_check==1)
		{
			$sSQL .= " AND i.quantity_available >0 ";
		}
	
		if(isset($this->request_item_id) )
		{
		$sSQL.= " AND 	i.request_item_id  ='$this->request_item_id' ";
		}

	    if(isset($this->package_expired))
		{
		$sSQL.= " AND 	i.expired_package  ='$this->package_expired' ";
		}
                 // if item send into haat then coupon status will be 0 else 1
         if(isset($this->coupon_status))
		{
		$sSQL.= " AND c.coupon_status ='$this->coupon_status'";
		}
		if(isset($this->pageLimit) && $this->pageLimit!="")
		{
		$sSQL .= $this->pageLimit;
		}
	 // echo $sSQL;
		$RecordSet = $obj_con->select($sSQL);
		$obj_con->connection_close();
		return $RecordSet;
	}
	
	//// items sold by seller
	function sold_seller_items()
	{
	
	
	   $obj_con = new class_dbconnector();

 $sSQL = "SELECT * FROM tbl_item_details i,tbl_buyer_purchased_item b,
 tbl_users u WHERE b.item_id = i.item_id  AND b.seller_id=\"$this->seller_id\" AND b.buyer_id=u.id AND b.payment_status = 1 ";
		
	
	
      if(isset($this->default_value) && $this->default_value=='id')
		{
			$sSQL.= " order by b.id desc  ";
		}

		// sorting by title ascending

		if(isset($this->order_by_variable) && $this->order_by_variable=='title_asc')
		{
			$sSQL.= " order by i.title asc  ";
		}

		// sorting by title descending
		
		if(isset($this->order_by_variable) && $this->order_by_variable=='title_desc')
		{
			$sSQL.= " order by i.title desc  ";
		}
		if(isset($this->pageLimit) && $this->pageLimit!="")
		{
			$sSQL .= $this->pageLimit;
		}
		 $sSQL;
		$RecordSet = $obj_con->select($sSQL);
		$obj_con->connection_close();
		return $RecordSet;
	
	 }
//Function to get Discount Item  Details  
	function getDiscountItemDetails($today_date,$coupon_code)
	{
	
	        $obj_con = new class_dbconnector();

$sSQL = "SELECT * FROM tbl_item_details i, tbl_genrate_coupon c WHERE c.item_id = i.item_id AND coupon_code = \"$coupon_code\" AND i.inventory_alert < i.quantity_available
AND i.status =1 AND i.hatting_status = '0' AND end_date >= '$today_date' AND start_date <= '$today_date' ";
		
		

		if(isset($this->update_item_id))
		{
			$sSQL.= " AND i.item_id ='$this->update_item_id'";

		}	
		//by status
		if(isset($this->status)&& $this->status!='')
		{
			$sSQL.= " AND 	i.status ='$this->status'";
		}
		if(isset($this->seller_id) )
		{
			$sSQL.= " AND 	i.seller_id ='$this->seller_id'";
		}
		if(isset($this->hand_pickstatus)&&$this->hand_pickstatus!='' )
		{
			$sSQL.= " AND 	i.make_handpicked ='$this->hand_pickstatus'";
		}
	/*	if(isset($this->approve_store)&&$this->approve_store!='' )
		{
			$sSQL.= " AND 	i.approve_store ='$this->approve_store'";
		}
		*/
		
	//by inventory item check (should be greater than availble quantity)
	//by inventory item check ( availble quantity should be greater than > 0)
		
		/*
		if(isset($this->inventory_check)&& $this->inventory_check==1)
		{
			$sSQL.= " AND 	i.inventory_alert < i.quantity_available ";
		}
	   */
	   
		if(isset($this->inventory_check)&& $this->inventory_check==1)
		{
			$sSQL.= " AND 	i.quantity_available >0 ";
		}
	//by inventory item qunatity
		if(isset($this->inventory_alert_val)&& $this->inventory_alert_val!='')
		{
			$sSQL.= " AND 	i.inventory_alert ='$this->inventory_alert_val'";
		}
		
	//by cost item
		if(isset($this->cost_item_val)&& $this->cost_item_val!='')
		{
			$sSQL.= " AND 	i.cost_item =$this->cost_item_val ";
		}
		
	//by categoryid
		if(isset($this->category_id)&& $this->category_id!='')
		{
			$sSQL.= " AND 	i.category_id ='$this->category_id'";
		}

		//by title
		
		if(isset($this->title_val)&& $this->title_val!='')
		{
			$sSQL.= " AND 	i.title Like '$this->title_val%'";
		}
		
		//by sellers 
		
		if(isset($this->recent_status) && $this->recent_status==2)
		{
			$sSQL.= " AND 	 i.status=1  ";
		}
		  	
		if(isset($this->recent_status) && $this->recent_status==303)
		{
			$sSQL.= " AND 	 i.status!=3  ";
		}

                  // for showing haating items
		if(isset($this->hatting_status) && $this->hatting_status==1)
		{
			$sSQL.= " AND 	 i.hatting_status='$this->hatting_status'  ";
		}
		 
		  
		  // for not showing haating items

               if(isset($this->hatting_status) && $this->hatting_status==0)
		{
			$sSQL.= " AND 	 i.hatting_status='$this->hatting_status'  ";
		}

        $sSQL.= " group by i.item_id ";
		   // for haating dates registered
		if(isset($this->hatting_status) && $this->hatting_status==101)
		{
			$sSQL.= " order by i.hatting_date desc  ";
		}


		//page limit
		
		// sorting by handpicked_date descending with limit
		if(isset($this->val_limit) && $this->val_limit==1)
		{
			$sSQL.= " order by i.handpicked_date desc limit 0,12 ";
		}

		// sorting by handpicked_date descending
		if(isset($this->val_limit) && $this->val_limit==11)
		{
			$sSQL.= " order by i.handpicked_date desc  ";
		}

		// sorting by title ascending

		if(isset($this->order_by_variable) && $this->order_by_variable=='title_asc')
		{
			$sSQL.= " order by i.title asc  ";
		}

		// sorting by title descending
		
		if(isset($this->order_by_variable) && $this->order_by_variable=='title_desc')
		{
			$sSQL.= " order by i.title desc  ";
		}
		if(isset($this->order_by_variable) && $this->order_by_variable=='quantity_available_asc')
		{
			$sSQL.= " order by i.quantity_available 	 asc  ";
		}

		// sorting by quantity available
		if(isset($this->order_by_variable) && $this->order_by_variable=='quantity_available_desc')
		{
			$sSQL.= " order by i.quantity_available 	 desc  ";
		}
		

		// sorting by cost
		if(isset($this->order_by_variable) && $this->order_by_variable=='cost_asc')
		{
			$sSQL.= " order by i.cost_item asc  ";
		}


		if(isset($this->order_by_variable) && $this->order_by_variable=='cost_desc')
		{
			$sSQL.= " order by i.cost_item desc  ";
		}


		if(isset($this->recent_status) && $this->recent_status==1)
		{
			$sSQL.= " order by i.date_added desc limit 0,12 ";
		}
		if(isset($this->pageLimit) && $this->pageLimit!="")
		{
			$sSQL .= $this->pageLimit;
		}
	//echo $sSQL;
		$RecordSet = $obj_con->select($sSQL);
		$obj_con->connection_close();
		return $RecordSet;
	}
//Function to get Item Image Details  when doing basic search
	function getadvancedsearchResults()
	{
	
	
	  $obj_con = new class_dbconnector();

	   if(isset($this->scountry_value) && $this->scountry_value!=0)
	  {
	   $sSQL_insert= "  ,tbl_ship_item_countries siu  ";
	  }
          $sSQL = "SELECT * FROM tbl_item_details i,tbl_category_master cat_m ,tbl_users u ,tbl_item_style s,tbl_country_master cou_m  $sSQL_insert WHERE 1=1 AND  i.category_id=cat_m.category_id AND u.country_id =  cou_m.id AND u.id=i.seller_id   ";
          
		if(isset($this->Keywords) && $this->Keywords!='' )
		{ $sSQL.= " AND ( i.cost_item like '%$this->Keywords%'  OR  i.material_used like '%$this->Keywords%'  OR  i.title like '%$this->Keywords%' OR  i.description like '%$this->Keywords%')";

		}
         if(isset($this->scountry_value) && $this->scountry_value!=0)
         {
	$sSQL.= "  AND i.item_id= siu.item_id AND siu.country_id= \"$this->scountry_value\"  ";
                }
         	
		//by status
		if(isset($this->status)&& $this->status!='')
		{
		$sSQL.= " AND 	i.status ='$this->status'";
		}
		 
		if(isset($this->hand_pickstatus) )
		{
		$sSQL.= " AND 	make_handpicked ='$this->hand_pickstatus'";
		}
				
	//by inventory item check (should be greater than availble quantity)
		/*	
		if(isset($this->inventory_check)&& $this->inventory_check==1)
		{
			$sSQL.= " AND 	inventory_alert < quantity_available ";
		}
	*/
	
	//by inventory item check ( availble quantity should be greater than > 0)
		

	   
		if(isset($this->inventory_check)&& $this->inventory_check==1)
		{
		$sSQL.= " AND 	i.quantity_available >0 ";
		}
	
	    //by cost item
		
		if(isset($this->recent_status) && $this->recent_status==2)
		{
		$sSQL.= " AND 	 i.status=1  ";
		}
		if(isset($this->style_id) && $this->style_id!=0)
		{
		$sSQL.= "  AND 	 FIND_IN_SET($this->style_id,i.item_id_concat) ";
		}
	
		if(isset($this->cost_item) && $this->cost_item!='' && isset($this->cost_item2) && $this->cost_item2!='')
		{
		$sSQL.= "  AND 	 i.cost_item BETWEEN $this->cost_item AND $this->cost_item2  ";
		}
		
		if(isset($this->cost_item) && $this->cost_item!='' && $this->cost_item2=='')
		{
		$sSQL.= "  AND 	 i.cost_item=$this->cost_item ";
		}
		if(isset($this->item_country_id) && $this->item_country_id!=0)
		{
		$sSQL.= "  AND 	 u.country_id= \"$this->item_country_id\"  ";
		}
		if(isset($this->category_id) && $this->category_id!=0)
		{
		$sSQL.= "  AND 	 i.category_id= \"$this->category_id\"  ";
		}
		 		
			
	              // for showing haating items
		if(isset($this->hatting_status) && $this->hatting_status==1)
		{
		$sSQL.= " AND 	 hatting_status='$this->hatting_status'  ";
		}
		 		  
		  // for not showing haating items

               if(isset($this->hatting_status) && $this->hatting_status==0)
		{
		$sSQL.= " AND 	 hatting_status='$this->hatting_status'  ";
		}

                if(isset($this->color) && $this->color!='')
		{
		$sSQL.= " AND 	 i.color='$this->color'  ";
		}
                if(isset($this->delete_restored))
		{
		$sSQL.= " AND delete_restored ='$this->delete_restored'";

		}
                if(isset($this->delete_by_seller))
		{
		$sSQL.= " AND delete_by_seller ='$this->delete_by_seller'";

		}
                if(isset($this->package_expired))
		{
		$sSQL.= " AND expired_package ='$this->package_expired'";
		}

                 if(isset($this->locker_status))
		{
		$sSQL.= " AND locker_status ='$this->locker_status'";
		}
		//page limit
		

		$sSQL.= " group by i.item_id ";

		if($this->order_by_variable=='' && $this->recent_status!=1 &&  $this->val_limit!=1)
		{
			$sSQL.= " order by i.date_added desc  ";
		}
                


		if(isset($this->pageLimit) && $this->pageLimit!="")
		{
			$sSQL .= $this->pageLimit;
		}
        //echo    $sSQL;
            // '<br>';
	    $RecordSet = $obj_con->select($sSQL);
		$obj_con->connection_close();
		return $RecordSet;
	
	}

           //Function to get Item commission cost
            function getcommisioncost()
        	{
                /*


	        $obj_con = new class_dbconnector();

                $sSQL = "SELECT * FROM tbl_item_details i,tbl_category_master cat_m WHERE 1=1 AND  i.category_id=cat_m.category_id ";

		 
                if(isset($this->item_id) && $this->item_id!='' )
		{
			$sSQL.= " AND (i.item_id= '$this->item_id')";
		}
         	

                // $sSQL;
                 // '<br>';
                $RecordSet = $obj_con->select($sSQL);
		$obj_con->connection_close();
		return $RecordSet;
               */
                }

   //Function to get Item Image Details  when doing basic search
	function getbasicsearchResults()
	{
	
	
	        $obj_con = new class_dbconnector();

	  $sSQL = "SELECT * FROM tbl_item_details i,tbl_category_master cat_m ,tbl_users  tu WHERE 1=1
              AND  i.category_id=cat_m.category_id AND tu.id =i.seller_id ";
                 	
	
                  if(isset($this->search_Keywords) && $this->search_Keywords!='' )
		{
			$sSQL.= " AND (cat_m.name like '%$this->search_Keywords%'  OR
                                cat_m.description like '%$this->search_Keywords%' OR
                                i.cost_item like '%$this->search_Keywords%'  OR
                                i.material_used like '%$this->search_Keywords%'  OR
                                i.title like '%$this->search_Keywords%' OR
                                i.description like '%$this->search_Keywords%' OR
                                tu.username like '%$this->search_Keywords%' OR
                                tu.store_name like '%$this->search_Keywords%' OR
                                i.color like '%$this->search_Keywords%')";
		}
         	
		//by status
		 if(isset($this->status)&& $this->status!='')
		{
			$sSQL.= " AND 	i.status ='$this->status'";
		}
		 
		 if(isset($this->hand_pickstatus) )
		{
			$sSQL.= " AND 	make_handpicked ='$this->hand_pickstatus'";
		}
				
	//by inventory item check (should be greater than availble quantity)
		/*	
		if(isset($this->inventory_check)&& $this->inventory_check==1)
		{
			$sSQL.= " AND 	inventory_alert < quantity_available ";
		}
	*/
	
	//by inventory item check ( availble quantity should be greater than > 0)
		

	   
		if(isset($this->inventory_check)&& $this->inventory_check==1)
		{
			$sSQL.= " AND 	quantity_available >0 ";
		}
	
	//by cost item
		
		if(isset($this->recent_status) && $this->recent_status==2)
		{
			$sSQL.= " AND 	 i.status=1  ";
		}
		  	
		

                  // for showing haating items
		if(isset($this->hatting_status) && $this->hatting_status==1)
		{
			$sSQL.= " AND 	 hatting_status='$this->hatting_status'  ";
		}
		 
		  
		  // for not showing haating items

               if(isset($this->hatting_status) && $this->hatting_status==0)
		{
			$sSQL.= " AND 	 hatting_status='$this->hatting_status'  ";
		}

		//page limit
		



		if($this->order_by_variable=='' && $this->recent_status!=1 &&  $this->val_limit!=1)
		{
			$sSQL.= " order by date_added desc  ";
		}
                


		if(isset($this->pageLimit) && $this->pageLimit!="")
		{
			$sSQL .= $this->pageLimit;
		}
       //echo $sSQL;
       // '<br>';
	    $RecordSet = $obj_con->select($sSQL);
		$obj_con->connection_close();
		return $RecordSet;
	
	}
	
	//Function to get Item Image Details
        function getItemImageDetails_foradmin()
	{
	        $obj_con = new class_dbconnector();
            $sSQL = "SELECT *,tcm.name as tcm_name FROM tbl_item_details i,tbl_users u,
            tbl_category_master tcm,tbl_country_master t_co_m WHERE 1=1 AND u.id= i.seller_id AND tcm.category_id = i.category_id AND  t_co_m.id = u.country_id ";
 //  $sSQL = "SELECT * FROM tbl_item_details i,tbl_users u WHERE 1=1 AND u.id=i.seller_id ";
       
			 if(isset($this->state)&& $this->state!='' )
			{
			$sSQL.= " AND u.state = '$this->state'  ";
			}
				 
			 if(isset($this->city)&& $this->city!='' )
			{
			$sSQL.= " AND u.city = '$this->city'  ";
			}
           
		   if(isset($this->country_value)&& $this->country_value!=0 )
			{
			$sSQL.= " AND u.country_id = '$this->country_value'  ";
		    }
		  
		   if(isset($this->subcategories_exisit) && $this->subcategories_exisit!='' )
		   {
		    $sSQL.= " AND 	i.category_id in ($this->subcategories_exisit)";
		   }
           
		   if(isset($this->sel_days)&& $this->sel_days!='' )
	       {
	       $sSQL.= "  AND EXTRACT(DAY FROM i.date_added) = '$this->sel_days' ";
	       }
           
		   if(isset($this->sel_year)&& $this->sel_year!='' )
	        {
	        $sSQL.= "  AND EXTRACT(YEAR FROM i.date_added) = '$this->sel_year' ";
	        }
           
		    if(isset($this->sel_month)&& $this->sel_month!='' )
	        {
	        $sSQL.= "  AND EXTRACT(MONTH FROM i.date_added) = '$this->sel_month' ";
	        }
		
			
		if(isset($this->sel_days)&& $this->msel_days!='' )
	       {
	       $sSQL.= "  AND EXTRACT(DAY FROM i.date_modified) = '$this->msel_days' ";
	       }
           
		   if(isset($this->msel_year)&& $this->msel_year!='' )
	        {
	        $sSQL.= "  AND EXTRACT(YEAR FROM i.date_modified) = '$this->msel_year' ";
	        }
           
		    if(isset($this->msel_month)&& $this->msel_month!='' )
	        {
	        $sSQL.= "  AND EXTRACT(MONTH FROM i.date_modified) = '$this->msel_month' ";
	        }
 		if(isset($this->not_updated)&& $this->not_updated!='' )
		{
		$sSQL.= " AND i.date_modified <=DATE_SUB(NOW(),INTERVAL '$this->not_updated' MONTH) ";
		}
		if(isset($this->locker_status)&& $this->locker_status!='')
		{
	  	 $sSQL.= " AND 	 i.locker_status  ='$this->locker_status' ";
		}
                /*
                if(isset($this->purchased_date)&& $this->purchased_date==1)
                {
                $sSQL .= " AND ( EXTRACT(YEAR FROM i.date_added) =
              '$this->sel_year' AND  EXTRACT(MONTH FROM  i.date_added)='$this->sel_month') " ;
                }
                 */

                // for deleteion of seller
                // if(isset($this->delete_by_seller))
		//{
		//$sSQL.= " AND delete_by_seller ='$this->delete_by_seller' ";
		//}

		 if(isset($this->update_item_id)&& $this->update_item_id!='')
		 {
		 $sSQL.= " AND i.item_id ='$this->update_item_id'";
		 }
		// echo 'hh'.$this->title_val;


		if(isset($this->delete_restored)&& $this->delete_restored!='')
		{
		$sSQL.= " AND i.delete_restored ='$this->delete_restored'";
		}
                if(isset($this->delete_by_seller)&& $this->delete_by_seller!='')
		{
		$sSQL.= " AND i.delete_by_seller ='$this->delete_by_seller'";
		}
                if(isset($this->package_expired)&& $this->package_expired!='')
		{
		$sSQL.= " AND i.expired_package ='$this->package_expired'";
		}
              //  $objItem->package_expired  = 0;

		//by status
	        if(isset($this->status)&& $this->status!='')
		{
			$sSQL.= " AND 	i.status ='$this->status'";
		}
              
		 if(isset($this->seller_id) && $this->seller_id!='')
		{
			$sSQL.= " AND 	i.seller_id ='$this->seller_id'";
		}
		 if(isset($this->hand_pickstatus)&& $this->hand_pickstatus!='')
		{
			$sSQL.= " AND 	i.make_handpicked ='$this->hand_pickstatus'";
		}

		//by inventory item check (should be greater than availble quantity)
		if(isset($this->inventory_check)&& $this->inventory_check==1)
		{
			$sSQL.= " AND 	i.quantity_available>0 ";
		}


		//by inventory item qunatity
		if(isset($this->inventory_alert_val)&& $this->inventory_alert_val!='')
		{
			$sSQL.= " AND 	i.inventory_alert ='$this->inventory_alert_val'";
		}

		//by cost item
		if(isset($this->cost_item_val)&& $this->cost_item_val!='')
		{
			$sSQL.= " AND 	i.cost_item =$this->cost_item_val ";
		}
		//by parent category id
		if(isset($this->parent_id)&& $this->parent_id!='')
		{
			$sSQL .= " AND i.parent_id = '$this->parent_id'";
		}

		//by categoryid
               //$this->category_id;
		if(isset($this->category_id)&& $this->category_id!='')
		{
			$sSQL.= " AND 	i.category_id ='$this->category_id'";
		}

		//by title
		if(isset($this->title_val)&& $this->title_val!='')
		{
			$sSQL.= " AND 	i.title like '$this->title_val%'";
		}

		//by sellers
		if(isset($this->recent_status) && $this->recent_status==2)
		{
			$sSQL.= " AND 	 i.status=1  ";
		}

		if(isset($this->recent_status) && $this->recent_status==303)
		{
			$sSQL.= " AND 	 i.status!=3  ";
		}
                // for showing haating items
		if(isset($this->hatting_status) && $this->hatting_status==1)
		{
			$sSQL.= " AND 	 i.hatting_status='$this->hatting_status'  ";
		}

		// for not showing haating items

                if(isset($this->hatting_status) && $this->hatting_status==0)
		{
			$sSQL.= " AND  i.hatting_status='$this->hatting_status'  ";
		}


		// for haating dates registered
		if(isset($this->hatting_status) && $this->hatting_status==101)
		{
			$sSQL.= " order by i.hatting_date desc  ";
		}

		// sorting by handpicked_date descending
		if(isset($this->val_limit) && $this->val_limit==11)
		{
			$sSQL.= " order by i.handpicked_date desc  ";
		}
		// sorting by handpicked_date descending with limit
		if(isset($this->val_limit) && $this->val_limit==1)
		{

			$sSQL.= " order by i.handpicked_date desc limit 0,12 ";
		}

		// sorting by title ascending
		if(isset($this->order_by_variable) && $this->order_by_variable=='title_asc')
		{
			$sSQL.= " order by i.title asc  ";
		}

		// sorting by title descending
		if(isset($this->order_by_variable) && $this->order_by_variable=='title_desc')
		{
			$sSQL.= " order by i.title desc  ";
		}
		if(isset($this->order_by_variable) && $this->order_by_variable=='quantity_available_asc')
		{
			$sSQL.= " order by i.quantity_available  asc  ";
		}

		// sorting by quantity available
		if(isset($this->order_by_variable) && $this->order_by_variable=='quantity_available_desc')
		{
			$sSQL.= " order by i.quantity_available desc  ";
		}

		// sorting by cost
		if(isset($this->order_by_variable) && $this->order_by_variable=='cost_asc')
		{
			$sSQL.= " order by i.cost_item asc  ";
		}

		if(isset($this->order_by_variable) && $this->order_by_variable=='cost_desc')
		{
			$sSQL.= " order by i.cost_item desc  ";
		}
		if($this->order_by_variable=='' && $this->recent_status!=1 &&  $this->val_limit!=1)
		{
			$sSQL.= " order by i.date_added desc  ";
		}
                if(isset($this->orderexp_items_id) && $this->orderexp_items_id!='' )
		{
			$sSQL.= " order by i.item_id asc ";
		}

		if(isset($this->recent_status) && $this->recent_status==1)
		{
			$sSQL.= " order by i.date_added desc limit 0,12 ";
		}
                 if(isset($this->limit_max_items) && $this->limit_max_items!='' )
		{
			$sSQL.= " limit 0,$this->limit_max_items ";
		}
		if(isset($this->pageLimit) && $this->pageLimit!="")
		{
			$sSQL .= $this->pageLimit;
		}

	//echo 'lala=='.$sSQL;
	// '<br>';
		$RecordSet = $obj_con->select($sSQL);
		$obj_con->connection_close();
		return $RecordSet;
	}
        
        function getItemImageDetails_withothers()
	{   
	        $obj_con = new class_dbconnector();

	        $sSQL = "SELECT *,tid.title as tid_title,tcm.name as tcm_name FROM tbl_item_details tid,tbl_users tu, tbl_category_master tcm,tbl_country_master t_co_m WHERE 1=1 AND tu.id= tid.seller_id AND tcm.category_id = tid.category_id AND  t_co_m.id = tu.country_id";

		if(isset($this->subcategories_exisit) && $this->subcategories_exisit!='' )
		{
		$sSQL.= " AND 	tid.category_id in ($this->subcategories_exisit)";
		}
                if(isset($this->state)&& $this->state!='' )
		{
		$sSQL.= " AND tu.state = '$this->state'  ";
		}
             
               if(isset($this->city)&& $this->city!='' )
		{
		$sSQL.= " AND tu.city = '$this->city'  ";
		}
                if(isset($this->country_value)&& $this->country_value!=0 )
		{
		$sSQL.= " AND tu.country_id = '$this->country_value'  ";
		}
                
		if(isset($this->not_updated)&& $this->not_updated!='' )
		{
		$sSQL.= " AND date_modified <=DATE_SUB(NOW(),INTERVAL '$this->not_updated' MONTH) ";
		}
                if(isset($this->sel_days))
	        {
	        $sSQL.= "  AND EXTRACT(DAY FROM tid.date_modified) = '$this->sel_days' ";
	        }
                 if(isset($this->purchased_date)&& $this->purchased_date==1)
                {
           $sSQL .= " AND ( EXTRACT(YEAR FROM tid.date_modified) ='$this->sel_year' AND  EXTRACT(MONTH FROM  tid.date_modified)='$this->sel_month') " ;
                }
                 if(isset($this->locker_status))
		{
		$sSQL.= " AND 	 locker_status  ='$this->locker_status' ";
		}
		
                // for deleteion of seller
                 if(isset($this->update_item_id))
		{
		$sSQL.= " AND item_id ='$this->update_item_id'";
		}

		 if(isset($this->delete_restored))
		{
		$sSQL.= " AND delete_restored ='$this->delete_restored'";
		}
                 if(isset($this->delete_by_seller))
		{
		$sSQL.= " AND delete_by_seller ='$this->delete_by_seller'";
		}
                 if(isset($this->package_expired))
		{
		$sSQL.= " AND expired_package ='$this->package_expired'";
		}
              //  $objItem->package_expired  = 0;

		//by status
		 if(isset($this->status)&& $this->status!='')
		{
		$sSQL.= " AND 	tid.status ='$this->status'";
		}
		 if(isset($this->seller_id) )
		{
		$sSQL.= " AND 	seller_id ='$this->seller_id'";
		}
		if(isset($this->hand_pickstatus))
		{
		$sSQL.= " AND 	make_handpicked ='$this->hand_pickstatus'";
		}

		//by inventory item check (should be greater than availble quantity)
		if(isset($this->inventory_check)&& $this->inventory_check==1)
		{
		$sSQL.= " AND 	quantity_available>0 ";
		}


		//by inventory item qunatity
		if(isset($this->inventory_alert_val)&& $this->inventory_alert_val!='')
		{
		$sSQL.= " AND 	inventory_alert ='$this->inventory_alert_val'";
		}

		//by cost item
		if(isset($this->cost_item_val)&& $this->cost_item_val!='')
		{
		$sSQL.= " AND 	cost_item ='$this->cost_item_val'";
		}
		//by parent category id
		if(isset($this->parent_id)&& $this->parent_id!='')
		{
		$sSQL .= " AND tid.parent_id = '$this->parent_id'";
		}

		//by categoryid
		if(isset($this->category_id)&& $this->category_id!='')
		{
		$sSQL.= " AND 	tid.category_id ='$this->category_id'";
		}

		//by title
		if(isset($this->title_val)&& $this->title_val!='')
		{
		$sSQL.= " AND 	tid.title like '$this->title_val%' ";
		}

		//by sellers
		if(isset($this->recent_status) && $this->recent_status==2)
		{
		$sSQL.= " AND 	 tid.status=1  ";
		}

		if(isset($this->recent_status) && $this->recent_status==303)
		{
		$sSQL.= " AND 	 tid.status!=3  ";
		}
                // for showing haating items
		if(isset($this->hatting_status) && $this->hatting_status==1)
		{
		$sSQL.= " AND 	 hatting_status='$this->hatting_status'  ";
		}

		// for not showing haating items

                if(isset($this->hatting_status) && $this->hatting_status==0)
		{
		$sSQL.= " AND  hatting_status='$this->hatting_status'  ";
		}


		// for haating dates registered
		if(isset($this->hatting_status) && $this->hatting_status==101)
		{
		$sSQL.= " order by hatting_date desc  ";
		}

		// sorting by handpicked_date descending
		if(isset($this->val_limit) && $this->val_limit==11)
		{
		$sSQL.= " order by handpicked_date desc  ";
		}
		// sorting by handpicked_date descending with limit
		if(isset($this->val_limit) && $this->val_limit==1)
		{

		$sSQL.= " order by handpicked_date desc limit 0,12 ";
		}

		// sorting by title ascending
		if(isset($this->order_by_variable) && $this->order_by_variable=='title_asc')
		{
			$sSQL.= " order by title asc  ";
		}

		// sorting by title descending
		if(isset($this->order_by_variable) && $this->order_by_variable=='title_desc')
		{
			$sSQL.= " order by title desc  ";
		}
		if(isset($this->order_by_variable) && $this->order_by_variable=='quantity_available_asc')
		{
			$sSQL.= " order by quantity_available 	 asc  ";
		}

		// sorting by quantity available
		if(isset($this->order_by_variable) && $this->order_by_variable=='quantity_available_desc')
		{
			$sSQL.= " order by quantity_available 	 desc  ";
		}

		// sorting by cost
		if(isset($this->order_by_variable) && $this->order_by_variable=='cost_asc')
		{
			$sSQL.= " order by cost_item asc  ";
		}

		if(isset($this->order_by_variable) && $this->order_by_variable=='cost_desc')
		{
			$sSQL.= " order by cost_item desc  ";
		}
		if($this->order_by_variable=='' && $this->recent_status!=1 &&  $this->val_limit!=1)
		{
			$sSQL.= " order by date_added desc  ";
		}
                if(isset($this->orderexp_items_id) && $this->orderexp_items_id!='' )
		{
			$sSQL.= " order by item_id asc ";
		}

		if(isset($this->recent_status) && $this->recent_status==1)
		{
			$sSQL.= " order by date_added desc limit 0,12 ";
		}
                 if(isset($this->limit_max_items) && $this->limit_max_items!='' )
		{
			$sSQL.= " limit 0,$this->limit_max_items ";
		}
		if(isset($this->pageLimit) && $this->pageLimit!="")
		{
			$sSQL .= $this->pageLimit;
		}


		$RecordSet = $obj_con->select($sSQL);
		$obj_con->connection_close();
		return $RecordSet;
	}
	
	
	
	function getItemImageDetails()
	{
	   $obj_con = new class_dbconnector();

	   $sSQL = "SELECT * FROM tbl_item_details i WHERE 1=1  ";
				
		if(isset($this->subcategories_exisit) && $this->subcategories_exisit!='' )
		{
		$sSQL.= " AND 	category_id in ($this->subcategories_exisit)";
		}
		
		if(isset($this->allsteps_completed) && $this->allsteps_completed!='' )
		{
		$sSQL.= " AND 	allsteps_completed ='$this->allsteps_completed' ";
		}
       
	   if(isset($this->not_updated)&& $this->not_updated!='' )
		{
		$sSQL.= " AND date_modified <=DATE_SUB(NOW(),INTERVAL '$this->not_updated' MONTH) ";
		}
		 if(isset($this->locker_status))
		{
		$sSQL.= " AND 	 locker_status  ='$this->locker_status' ";
		}
	//	$objItem->hat_max_value    = 1;
		 if(isset($this->hat_max_value))
		{
		//$sSQL.= " AND 	 hat_max_value!  ='0' ";
		}
                // for deleteion of seller 
                // if(isset($this->delete_by_seller))
		//{
		//$sSQL.= " AND delete_by_seller ='$this->delete_by_seller' ";
		//}

		 if(isset($this->update_item_id) && $this->update_item_id!='')
		{
		$sSQL.= " AND item_id ='$this->update_item_id'";

		}	
		
		 if(isset($this->request_item_id))
		{
		$sSQL.= " AND request_item_id ='$this->request_item_id'";
		}
		
		 if(isset($this->delete_restored))
		{
		$sSQL.= " AND delete_restored ='$this->delete_restored'";
		}
       
	    if(isset($this->delete_by_seller))
		{
		$sSQL.= " AND delete_by_seller ='$this->delete_by_seller'";

		}
       
	    if(isset($this->package_expired))
		{
		$sSQL.= " AND expired_package ='$this->package_expired'";
		}
              //  $objItem->package_expired  = 0;
		
		//by status
		 if(isset($this->seller_id) )
		{
			$sSQL.= " AND 	seller_id ='$this->seller_id'";
		}
		 if(isset($this->hand_pickstatus))
		{
			$sSQL.= " AND 	make_handpicked ='$this->hand_pickstatus'";
		}
				
		//by inventory item check (should be greater than availble quantity)
		if(isset($this->inventory_check)&& $this->inventory_check==1)
		{
			$sSQL.= " AND 	quantity_available>0 ";
		}
	
		
		//by inventory item qunatity
		if(isset($this->inventory_alert_val)&& $this->inventory_alert_val!='')
		{
			$sSQL.= " AND 	inventory_alert ='$this->inventory_alert_val'";
		}
		
		//by cost item
		if(isset($this->cost_item_val)&& $this->cost_item_val!='')
		{
			$sSQL.= " AND 	cost_item ='$this->cost_item_val'";
		}
		//by parent category id
		if(isset($this->parent_id)&& $this->parent_id!='')
		{
			$sSQL .= " AND parent_id = '$this->parent_id'";
		}

		//by categoryid
		if(isset($this->category_id)&& $this->category_id!='')
		{
			$sSQL.= " AND 	category_id ='$this->category_id'";
		}

		//by title		
		if(isset($this->title_val)&& $this->title_val!='')
		{
			$sSQL.= " AND 	title ='$this->title_val'";
		}
		
		//by sellers		
		if(isset($this->recent_status) && $this->recent_status==2)
		{
			$sSQL.= " AND 	 status=1  ";
		}
		
		if(isset($this->status)&& $this->status!='')
		{
			$sSQL.= " AND 	status ='$this->status'";
		}
		
		if(isset($this->recent_status) && $this->recent_status==303)
		{
			$sSQL.= " AND 	 status!=3  ";
		}
                // for showing haating items
		if(isset($this->hatting_status) && $this->hatting_status==1)
		{
			$sSQL.= " AND 	 hatting_status='$this->hatting_status'  ";
		}
		 
		// for not showing haating items

        if(isset($this->hatting_status) && $this->hatting_status==0)
		{
			$sSQL.= " AND  hatting_status='$this->hatting_status'  ";
		}
                

		// sorting by title ascending
		if(isset($this->order_by_variable) && $this->order_by_variable=='title_asc')
		{
			$sSQL.= " order by title asc  ";
		}

		// sorting by title descending		
		if(isset($this->order_by_variable) && $this->order_by_variable=='title_desc')
		{
			$sSQL.= " order by title desc  ";
		}
		if(isset($this->order_by_variable) && $this->order_by_variable=='quantity_available_asc')
		{
			$sSQL.= " order by quantity_available 	 asc  ";
		}

		// sorting by quantity available
		if(isset($this->order_by_variable) && $this->order_by_variable=='quantity_available_desc')
		{
			$sSQL.= " order by quantity_available 	 desc  ";
		}		

		// sorting by cost
		if(isset($this->order_by_variable) && $this->order_by_variable=='cost_asc')
		{
			$sSQL.= " order by cost_item asc  ";
		}

		if(isset($this->order_by_variable) && $this->order_by_variable=='cost_desc')
		{
			$sSQL.= " order by cost_item desc  ";
		}

         if(isset($this->orderexp_items_id) && $this->orderexp_items_id!='' )
		{
			$sSQL.= " order by item_id asc ";
		}

       if($this->order_by_variable=='' && $this->recent_status!=1 &&  $this->val_limit!=1 && $this->hatting_status!=101)
		{
		$sSQL.= " order by date_added desc  ";
		}    
		if(isset($this->recent_status) && $this->recent_status==1 && $this->hatting_status!=101)
		{
		$sSQL.= " order by date_added desc limit 0,12 ";
		}
                // for haating dates registered
		if(isset($this->hatting_status) && $this->hatting_status==101)
		{
		$sSQL.= " order by hatting_time desc  ";
		}
		// for haating dates registered
		// sorting by handpicked_date descending
		if(isset($this->val_limit) && $this->val_limit==11 && $this->hatting_status!=101)
		{
		$sSQL.= " order by handpicked_date desc  ";
		}
		// sorting by handpicked_date descending with limit
		if(isset($this->val_limit) && $this->val_limit==1  && $this->hatting_status!=101)
		{
		$sSQL.= " order by handpicked_date desc limit 0,12 ";
		}


        if(isset($this->limit_max_items) && $this->limit_max_items!='' )
		{
			$sSQL.= " limit 0,$this->limit_max_items ";
		}
		if(isset($this->pageLimit) && $this->pageLimit!="")
		{
			$sSQL .= $this->pageLimit;
		}
	echo $sSQL;
		$RecordSet = $obj_con->select($sSQL);
		$obj_con->connection_close();
		return $RecordSet;
	} 
	
        



	//Function to get User Login Details  
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
		
		if(isset($this->status))
		{
			$sSQL.= " AND status = '$this->status'";
		}	
		
	 $sSQL ;
		//exit;
		$RecordSet = $obj_con->select( $sSQL );
		$obj_con->connection_close();
		return $RecordSet;
	} 
	
       //insert update of image of item
	function insertUpdateImage()
	{
	
		$ObjClsDBInteraction = new class_dbconnector();
		
       if(isset($this->suspend_item)) // 0 for image not added 1 for image added
		$arr["status"]                  = $this->suspend_item;
		
		
	//	 $objItem->allsteps_completed  = 'Active';
		 
		  if(isset($this->allsteps_completed))
		$arr["allsteps_completed"]       = 'Active';

       if(isset($this->image1))
		$arr["image1"]       = $this->image1;
		
		if(isset($this->image2))
		$arr["image2"]		= $this->image2;
		
		if(isset($this->image3))
		$arr["image3"]		= $this->image3;
				
		if(isset($this->image4))
		$arr["image4"]		= $this->image4;
		
		if(isset($this->image5))
		$arr["image5"]		= $this->image5;
		
		if(isset($this->counter_value))
		$arr["counter_view"]	= $this->counter_value;
		
		if(isset($this->update_item_id))
		$arr["item_id"]			= $this->update_item_id;
		
		if(isset($this->update_item_id) && $this->update_item_id!="")
		{
		 $arr["date_modified"] = date("Y-m-d H:i:s"); 
		$sWhere = " item_id = '$this->update_item_id'";
	        $nReturnValue = $ObjClsDBInteraction->insertUpdate("tbl_item_details", $arr, $sWhere);
		}
		else
		{
			$arr["reg_date"] = date("Y-m-d H:i:s");
			$nReturnValue = $ObjClsDBInteraction->insertUpdate("tbl_item_details", $arr, null);
		}
		$ObjClsDBInteraction->connection_close();
		return $nReturnValue;
	}//end of function

	// this function is used get existing email
	function validateExisringEmail()
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
		 $sSQL . ";<br><br><br>";
		
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
			$sSQL .= " AND id != $this->id";
		}
		// $sSQL . ";<br><br><br>";
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
	
	// this function is used get existing username
	function validateExisringUsername()
	{
		$ObjClsDBInteraction = new class_dbconnector();

		$sSQL = "SELECT username FROM tbl_users WHERE id IS NOT NULL";
		if(isset($this->username) && $this->username!="")
		{
			$sSQL .= " AND username = '$this->username' ";
		}
		if(isset($this->id) && $this->id!="")
		{
			$sSQL .= " AND id != $this->id";
		}
		 $sSQL . ";<br><br><br>";
	//	exit;
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
	

//Function Insert/Update iTem details for making it handpicked
	function insertUpdateItem_hand($val_stat)
	{
	
		$ObjClsDBInteraction = new class_dbconnector();
		
		
		
		if(isset($this->item_value))
		$arr["item_id"]   		        = $this->item_value;
		
		if(isset($val_stat))
		$arr["make_handpicked"]   		= $val_stat;

	
		if(isset($this->item_value) && $this->item_value!="")
		{
			 $sWhere = "   	item_id = '$this->item_value'";
			 $arr["handpicked_date"] = date("Y-m-d H:i:s"); 
			 $nReturnValue = $ObjClsDBInteraction->insertUpdate("tbl_item_details", $arr, $sWhere);
		
		
		}
		else
		{      	$arr["status"]   		 	= o; // inactive product
			$arr["date_added"] = date("Y-m-d H:i:s");
			$arr["date_modified"] = date("Y-m-d H:i:s"); 
			$nReturnValue = $ObjClsDBInteraction->insertUpdate("tbl_item_details", $arr, null);
			
		}
	         	$ObjClsDBInteraction->connection_close();
		return $nReturnValue;
	}//end of function

//Function Insert/Update expire iTem 

    function insertUpdateExpireItem()
	{
	    // 'imp-'.$this->implode_item_ids;
	    $ObjClsDBInteraction = new class_dbconnector();
        //$objItem->implode_expire_items = 1;
        // $objItem->implode_item_ids     =  $implode_item_id;
        if(isset($this->seller_id) && $this->seller_id!='')
		$seller_id               = $this->seller_id; // 1 for expiring items
		
        if(isset($this->expired_package))
		$arr["expired_package"]  = $this->expired_package;  // 1 for expiring items
  		
		if(isset($this->implode_item_ids) && $this->implode_item_ids!="" )
		{		
		 $sWhere = " item_id NOT IN ($this->implode_item_ids ) and seller_id = '$seller_id'";
		 //$arr["date_modified"] = date("Y-m-d H:i:s");
		 $nReturnValue = $ObjClsDBInteraction->insertUpdate("tbl_item_details", $arr, $sWhere);
		}
		else
		{
         //$arr["date_added"] = date("Y-m-d H:i:s");
         //$arr["date_modified"] = date("Y-m-d H:i:s");
		$nReturnValue = $ObjClsDBInteraction->insertUpdate("tbl_item_details", $arr, null);
		}
	        $ObjClsDBInteraction->connection_close();
		return $nReturnValue;
             
        }

        // Function to activate iTems

         function insertUpdateActivateItem()
	{ // 'imp-item-is'.$this->implode_item_ids;
                $ObjClsDBInteraction = new class_dbconnector();

                if(isset($this->seller_id) && $this->seller_id!='')
		$seller_id               = $this->seller_id;  // 1 for expiring items

                if(isset($this->expired_package))
		$arr["expired_package"]  = $this->expired_package;  // 1 for expiring items

                if(isset($this->implode_item_ids) && $this->implode_item_ids!="" )
		{
		 $sWhere = "   	item_id  IN ($this->implode_item_ids ) and seller_id = '$seller_id'";
		 //$arr["date_modified"] = date("Y-m-d H:i:s");
		 $nReturnValue = $ObjClsDBInteraction->insertUpdate("tbl_item_details", $arr, $sWhere);
		}
		else
		{
                //$arr["date_added"] = date("Y-m-d H:i:s");
               //$arr["date_modified"] = date("Y-m-d H:i:s");
		$nReturnValue = $ObjClsDBInteraction->insertUpdate("tbl_item_details", $arr, null);
		}
	        $ObjClsDBInteraction->connection_close();
		return $nReturnValue;

        }


	//Function Insert/Update iTem details
	function insertUpdateItem()
	{
		$ObjClsDBInteraction = new class_dbconnector();
		
		if(isset($this->delete_by_seller))
		$arr["delete_by_seller"]        = $this->delete_by_seller;
                
        if(isset($this->color))
		$arr["color"]                	= $this->color;

        if(isset($this->suspend_item)) // 0 when item added but not image uploaded
		$arr["status"]                	= $this->suspend_item;

        if(isset($this->request_item_id))
		$arr["request_item_id"]         = $this->request_item_id;
		
		if(isset($this->care))
		$arr["care"]                	= $this->care;
        
		if(isset($this->delete_restored))
		$arr["delete_restored"]         = $this->delete_restored;
				
		if(isset($this->item_id_concat))
		$arr["item_id_concat"]       	= $this->item_id_concat;
		
		if(isset($this->price))
		$arr["cost_item"]		= $this->price;
		
		if(isset($this->parent_id))
		$arr["parent_id"]		= $this->parent_id;

		if(isset($this->category_id))
		$arr["category_id"]		= $this->category_id;
		    
		if(isset($this->title))
		$arr["title"]			= $this->title;
				
		if(isset($this->allow_rest_country_status))
		$arr["allow_rest_country_status"] = $this->allow_rest_country_status;
		
		if(isset($this->ship_allowcost))
		$arr["ship_allowcost"] = $this->ship_allowcost;
		
		if(isset($this->ship_allowcomment))
		$arr["ship_allowcomment"] = $this->ship_allowcomment;
		   
		if(isset($this->domestic_ship_rate))
		$arr["domestic_ship_rate"]	= $this->domestic_ship_rate;

		if(isset($this->international_ship_rate))
		$arr["international_ship_rate"]	= $this->international_ship_rate;
           
		if(isset($this->allow_international))
		$arr["allow_international"]     =  $this->allow_international;
           
		if(isset($this->locker_status))
		$arr["locker_status"]   	= $this->locker_status;

 		if(isset($this->materials))
		$arr["material_used"]		= $this->materials;
				
		if(isset($this->description))
		$arr["description"]		= $this->description;
		
		if(isset($this->locker_permission))
		$arr["locker_permission"]   	= $this->locker_permission;

		if(isset($this->locker_buyer))
		$arr["locker_buyer"]   		= $this->locker_buyer;

		if(isset($this->user_id))
		$arr["seller_id"]		= $this->user_id;	
	
		if(isset($this->quantity))
		$arr["inventory_alert"]   	= $this->quantity;

		if(isset($this->item_value))
		$arr["item_id"]   		= $this->item_value;
		
		//quantity_available
		if(isset($this->quantity_available))
		$arr["quantity_available"] 	= $this->quantity_available;

		if(isset($this->unit_type))
		$arr["unit_type"]       	= $this->unit_type;

		if(isset($this->weight))
		$arr["weight"]   		= $this->weight;                
	
		//print_r($arr);
		if(isset($this->item_value) && $this->item_value!="" && $this->item_value!="0")
		{
			 $sWhere = "   	item_id = '$this->item_value'";
			 $arr["date_modified"] = date("Y-m-d H:i:s"); 
			 $nReturnValue = $ObjClsDBInteraction->insertUpdate("tbl_item_details", $arr, $sWhere);
		}
		else
		{      	
			$arr["date_added"] = date("Y-m-d H:i:s");
			$arr["date_modified"] = date("Y-m-d H:i:s"); 
			$nReturnValue = $ObjClsDBInteraction->insertUpdate("tbl_item_details", $arr, null);
			$last_id = mysql_insert_id();
		    $_SESSION['Last_id_row'] = $last_id;
		}
	        $ObjClsDBInteraction->connection_close();
		return $nReturnValue;
	}//end of function



function updateItemstore()
	{
	
	$ObjClsDBInteraction = new class_dbconnector();
	if(isset($this->approve_store))
		$arr["approve_store"]   		= $this->approve_store;
		
		if(isset($this->user_id) && $this->user_id!="")
		{
			 $sWhere = "   	seller_id  = '$this->user_id'";
			
			 $nReturnValue = $ObjClsDBInteraction->insertUpdate("tbl_item_details", $arr, $sWhere);
		
		
		}
		else
		{      	
			
		}
	         	$ObjClsDBInteraction->connection_close();
		return $nReturnValue;
	}//end of function
	function updateUseraddress()
	{
 $this->change_address;
	
	$ObjClsDBInteraction = new class_dbconnector();
		if(isset($this->change_address))
		{
			$arr["address1"]    	= $this->change_address;
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
        // function to delete coupon
       function deleteCoupons()
	{
		$ObjClsDBInteraction = new class_dbconnector();

		if(isset($this->del_coupon_id))
		{
			$sSQL ="DELETE  FROM tbl_genrate_coupon  WHERE coupon_id='$this->del_coupon_id'";
		}
		 $sSQL;

		$objRecordSet = $ObjClsDBInteraction->select( $sSQL );
		$ObjClsDBInteraction->connection_close();
		return $nReturnValue;
	}//end of function
	
	//function delete items
	function deleteHaatingItems()
	{
		$ObjClsDBInteraction = new class_dbconnector();
		
		if(isset($this->del_item_id))
		{
			$sSQL ="DELETE  FROM tbl_user_hatting_details  WHERE item_id='$this->del_item_id'"; 
		}
		 $sSQL;
		
		$objRecordSet = $ObjClsDBInteraction->select( $sSQL );
		$ObjClsDBInteraction->connection_close();
		return $nReturnValue;
	}//end of function


	//function delete items
	function deleteItems()
	{
		$ObjClsDBInteraction = new class_dbconnector();
		
		if(isset($this->del_item_id))
		{
			$sSQL ="DELETE  FROM tbl_item_details  WHERE item_id='$this->del_item_id'"; 
		}
		 $sSQL;
		
		$objRecordSet = $ObjClsDBInteraction->select( $sSQL );
		$ObjClsDBInteraction->connection_close();
		return $nReturnValue;
	}//end of function

	
     //  update particular image
	function particularImage()
	{
		$ObjClsDBInteraction = new class_dbconnector();
		
		if(isset($this->item_id)&& isset($this->col_id))
		{
			$sSQL ="update  tbl_item_details set image".$this->col_id."=''  WHERE item_id='$this->item_id'"; 
		}
		 $sSQL;
		
		$objRecordSet = $ObjClsDBInteraction->select( $sSQL );
		$ObjClsDBInteraction->connection_close();
		return $nReturnValue;
	}//end of function
	
	//-- Function to update user status
	function changeUserStatus()
	{
		$ObjClsDBInteraction = new class_dbconnector();
		$arr["status"]    	= $this->status;
		
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
	}//end of function
	

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
		//$sSQL . ";<br><br><br>";
		$objRecordSet = $ObjClsDBInteraction -> select($sSQL);
		$ObjClsDBInteraction->connection_close();
		return $objRecordSet;
	}
	
	//generate code	
	function generateVerifyCode($minlength=15, $maxlength=15, $useupper=true, $usespecial=false, $usenumbers=true) 
	{ 
		$charset = "abcdefghijklmnopqrstuvwxyz"; 
		
		if($useupper)   
			$charset .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ"; 
			
		if($usenumbers) 
			$charset .= "0123456789"; 
			
		if($usespecial) 
			$charset .= "~@#$%^*()_+-={}|][";   // Note: using all special characters this reads: "~!@#$%^&*()_+`-={}|\\]?[\":;'><,./"; 
			
		if($minlength > $maxlength) 
			$length = mt_rand ($maxlength, $minlength); 
		else
			$length = mt_rand ($minlength, $maxlength); 
			
		for($i = 0; $i < $length; $i++) 
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
		// $sSQL . ";<br><br><br>";
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
		
		// $sSQL . ";<br><br><br>";
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
		//$sSQL . ";<br><br><br>";
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
	
	 function insert_updatepaidItems_forlisting()
	{
		$ObjClsDBInteraction = new class_dbconnector();
		
		if(isset($this->seller_id))
		$arr["seller_id"]                = $this->seller_id;
		
		if(isset($this->amount))
		$arr["amount"]            	 = $this->amount;

		if(isset($this->trans_id))
		$arr["trans_id"]            	 = $this->trans_id;

		if(isset($this->values_returned))
		$arr["values_returned"]          = $this->values_returned;
		
		if(isset($this->address1))
		$arr["address1"]                 = $this->address1;

		if(isset($this->address2))
		$arr["address2"]                 = $this->address2;
		
		if(isset($this->city))
		$arr["city"]                     = $this->city;
		
		if(isset($this->zip))
		$arr["zip"]                      = $this->zip;

		if(isset($this->state))
		$arr["state"]                    = $this->state;

                if(isset($this->country_id))
		$arr["country_id"]               = $this->country_id;
		
		if(isset($this->cardnumber))
		$arr["credit_card_no"]           = $this->cardnumber;
		
		if(isset($this->pay_item_id) && $this->pay_item_id!="")
		{
			$arr["paid_date"]        = date("Y-m-d H:i:s"); 
			$sWhere = " pay_item_id  = '$this->pay_item_id'";
			 $nReturnValue = $ObjClsDBInteraction->insertUpdate("tbl_pay_item", $arr, $sWhere);
		}
		else
		{
		
			$arr["paid_date"] = date("Y-m-d H:i:s");
			$nReturnValue = $ObjClsDBInteraction->insertUpdate("tbl_pay_item", $arr, null);
		}
		$ObjClsDBInteraction->connection_close();
		return $nReturnValue;

	     }//end of function



            function getNoofpaidItems_forlisting()
            {

		$ObjClsDBInteraction = new class_dbconnector();

		$sSQL = "SELECT * FROM tbl_pay_item WHERE 1=1 ";
		
		
		if(isset($this->seller_id) && $this->seller_id!="")
		{
			$sSQL .= " AND seller_id = '$this->seller_id' ";
		}
		
		//$sSQL.";<br><br><br>";
		$objRecordSet = $ObjClsDBInteraction->select($sSQL);
		
		$ObjClsDBInteraction->connection_close();
		return $objRecordSet;
	     }//end of function


            function getNoofItems_perseller()
            {

		$ObjClsDBInteraction = new class_dbconnector();

		$sSQL = "SELECT count(*) as TOTAL_ITEMS FROM tbl_item_details WHERE 1=1 ";
		
		
		if(isset($this->seller_id) && $this->seller_id!="")
		{
			$sSQL .= " AND seller_id = '$this->seller_id' ";
		}
		
		//$sSQL.";<br><br><br>";
		$objRecordSet = $ObjClsDBInteraction->select($sSQL);
		
		$ObjClsDBInteraction->connection_close();
		return $objRecordSet;
	     }
	     //end of function

	     function get_sub_categories_seller()
	     {

		$ObjClsDBInteraction = new class_dbconnector();

		$sSQL = "SELECT *  FROM tbl_category_master WHERE 1=1 ";
		
		
		if(isset($this->main_cat_id) && $this->main_cat_id!="")
		{
			$sSQL .= " AND 	parent_id = '$this->main_cat_id' ";
		}
		
		//$sSQL.";<br><br><br>";
		$objRecordSet = $ObjClsDBInteraction->select($sSQL);
		
		$ObjClsDBInteraction->connection_close();
		return $objRecordSet;
	     }//end of function
	

	 function get_item_quantity()
	{

		$ObjClsDBInteraction = new class_dbconnector();

		$sSQL = "SELECT *  FROM tbl_set_quantity where qty_id=1 ";
		
		// $sSQL.";<br><br><br>";
		$objRecordSet = $ObjClsDBInteraction->select($sSQL);
		
		$ObjClsDBInteraction->connection_close();
		return $objRecordSet;
	     }//end of function
             /*
write function for haated items which can go for approval more than once
function getBIDlimit_approval()
	{
	        $obj_con = new class_dbconnector();

		$sSQL = "SELECT count(*) as number_bids,hat_min_value,hat_max_value FROM
		tbl_user_hatting_details as h ,tbl_item_details as i  WHERE
		1=1 and  h.item_id=i.item_id  and h.bid_status!=2 ";

		if(isset($this->item_id) )
		{
			$sSQL.= "  AND 	h.item_id ='$this->item_id'";
		}

		if(isset($this->buyer_id) )
		{
			$sSQL.= "  AND 	h.user_id ='$this->buyer_id'";
		}

        	$sSQL;
	        $sSQL = $sSQL.' group by i.item_id ';

		$RecordSet = $obj_con->select($sSQL);
		$obj_con->connection_close();
		return $RecordSet;
	}
*/
	
	
	// 
	


}//end of class
?>
