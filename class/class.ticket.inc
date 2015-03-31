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

class Class_Ticket
{ 

// function to know whther coupon  exsist or not 
function getTicketDetails() 
{
		 $obj_con = new class_dbconnector();
 

		$sSQL = " SELECT * FROM   `tbl_ticket`  where 1=1     ";
		
		if(isset($this->ticket_id))
		{
			$sSQL.= "  AND 	ticket_id='$this->ticket_id'";
		}
		
		if(isset($this->request_type))
		{
			$sSQL.= "  AND 	request_type='$this->request_type'";
		}
		if(isset($this->priority))
		{
			$sSQL.= "  AND 	priority='$this->priority'";
		}
		if(isset($this->start_date) && $this->end_date=='')
		{
			$sSQL.= "  AND 	DATE(date_genrated) >= '$this->start_date'";
		}
		if(isset($this->start_date) && $this->end_date!='')
		{
			$sSQL.= "  AND 	DATE(date_genrated) >= '$this->start_date' and DATE(date_genrated) <= '$this->end_date'  ";
		}
		
		if(isset($this->status))
		{
			$sSQL.= "  AND 	status='$this->status'";
		}
		if(isset($this->user_id))
		{
			$sSQL.= "  AND 	user_id='$this->user_id'";
		}
		
		if($this->order_date_genrated==1 &&  isset($this->order_date_genrated))
		{
			$sSQL.= "  order by date_genrated desc ";
		}
	
		if(isset($this->pageLimit) && $this->pageLimit!="")
		{
			$sSQL .= $this->pageLimit;
		}
	
	      
       $sSQL;
	//echo '<br>';
	
		$RecordSet = $obj_con->select($sSQL);
		$obj_con->connection_close();
		return $RecordSet;
	} 

// end of function
function getTicketReplyDetails() 
{
	
		 $obj_con = new class_dbconnector();
 
 
	

		$sSQL = " SELECT * FROM   `tbl_ticket_messages`  where 1=1     ";
		
		if(isset($this->ticket_id))
		{
			$sSQL.= "  AND ticket_id='$this->ticket_id'";
		}
		
		if($this->order_date_genrated==1 &&  isset($this->order_date_genrated))
		{
			$sSQL.= "  order by  date_genrated asc ";
		}
	
		
	
	      
        $sSQL;
	
	
		$RecordSet = $obj_con->select($sSQL);
		$obj_con->connection_close();
		return $RecordSet;
	} 

// end of function



//function delete Ticket codes 
	function deleteTicket()
	{
		$ObjClsDBInteraction = new class_dbconnector();
		
		if(isset($this->del_item_id))
		{
			$sSQL ="DELETE  FROM tbl_ticket  WHERE item_id='$this->del_item_id'"; 
		}
		 $sSQL;
		
		$objRecordSet = $ObjClsDBInteraction->select( $sSQL );
		$ObjClsDBInteraction->connection_close();
		return $nReturnValue;
	}//end of function

//Function Insert/Update coupon 
	function insertUpdateTicket()
	{  
		$ObjClsDBInteraction = new class_dbconnector();
		
		
		if(isset($this->request_type))
		$arr["request_type"]   	   = $this->request_type;
		
		if(isset($this->message))
		$arr["message"]   		   = $this->message;
		
		if(isset($this->subject) && $this->subject!='')
		$arr["subject"]   	       = $this->subject;
		
		if(isset($this->email_id) && $this->email_id!='')
		$arr["email_id"]   	       = $this->email_id;
		
		if(isset($this->first_name) && $this->first_name!='')
		$arr["first_name"]   	       = $this->first_name;
		
		if(isset($this->last_name) && $this->last_name!='')
		$arr["last_name"]   	       = $this->last_name;	
			
		if(isset($this->phone_no) && $this->phone_no!='')
		$arr["phone_no"]   	       = $this->phone_no;	
					
		if(isset($this->status) && $this->status!='')
		$arr["status"]   	       = $this->status;

		if(isset($this->priority) && $this->priority!='')
		$arr["priority"]   	       = $this->priority;			
		
		if(isset($this->user_id) && $this->user_id!='')
		$arr["user_id"]   		   = $this->user_id;	
		
		if(isset($this->ticket_id) && $this->ticket_id!="")
	    {
		$sWhere = " ticket_id = '$this->ticket_id'";	
		$arr["date_closed"]   = date("Y-m-d H:i:s"); 
		$nReturnValue = $ObjClsDBInteraction->insertUpdate("tbl_ticket", $arr, $sWhere);
	    }
	   else
	    { 
		$arr["date_genrated"] = date("Y-m-d H:i:s");
		$nReturnValue = $ObjClsDBInteraction->insertUpdate("tbl_ticket", $arr, null);
		$_SESSION['ticket_id'] = mysql_insert_id();
		$ObjClsDBInteraction->connection_close();
	    }
		return $nReturnValue;
	}
	//end of function

/// function to reply the ticket

function insertUpdateReplyTicket()
	{  
		$ObjClsDBInteraction = new class_dbconnector();
		
		
		if(isset($this->ticket_id))
		$arr["ticket_id"]   	   = $this->ticket_id;
		
		if(isset($this->message))
		$arr["message"]   		   = $this->message;

		if(isset($this->user_id))
		$arr["user_id"]   		   = $this->user_id;

		//$arr["date_genrated"] = date("Y-m-d H:i:s"); 
		$arr["date_genrated"]      = date("Y-m-d"); 
		$nReturnValue = $ObjClsDBInteraction->insertUpdate("tbl_ticket_messages", $arr, null);
			$_SESSION['ticket_id'] = mysql_insert_id();
		    	$ObjClsDBInteraction->connection_close();
		return $nReturnValue;
	}//end of function



// function to know whther coupon expires or not   exsist or not 

}

?>
  
  
  
  





