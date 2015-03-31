<?php
/*
	    **************************** Creation Log ***************************************************************
	    File Name                   -  class.message.inc
	    Module Name                 -  class
	    Project Name                -  
	    Description                 -  Contain all functon for users
	    Version                     -  
	    Created by                  - Deepak Nagar 
	    Created on                  -   7-july-2010
		******************************** Update Log *************************************************************
		SNo		Version		Updated by			Updated on			Description
		*********************************************************************************************************
*/

class Class_Message
{
/* ******************* start By Deepak nagar *************** */

/* ******************* start viwing message function *************** */



	function getMessageDetails()
	{
		$obj_con = new class_dbconnector();
		
		$sSQL = "SELECT tbl_messages.*,tbl_user_messages.*,tbl_user_messages.id subid,tbl_users.* FROM tbl_user_messages,tbl_messages,tbl_users WHERE tbl_messages.id=tbl_user_messages.msg_id AND  tbl_users.id=tbl_user_messages.sender_id ";

		if(isset($this->msg_id) && $this->msg_id!="")
		{
			$sSQL .= " AND tbl_user_messages.id='$this->msg_id' ";
		}

		if(isset($this->msg_rpl_id) && $this->msg_rpl_id!="")
		{
			$sSQL .= " AND tbl_user_messages.id='$this->msg_rpl_id' ";
		}

		if(isset($this->msg_fwd_id) && $this->msg_fwd_id!="")
		{
			$sSQL .= " AND tbl_user_messages.id='$this->msg_fwd_id' ";
		}
	
		
		//echo $sSQL;

		$RecordSet = $obj_con->select( $sSQL );
		$obj_con->connection_close();
		return $RecordSet;

	}

	function getSendbox()
	{
		$obj_con = new class_dbconnector();
		
		$sSQL = "SELECT tbl_messages.*,tbl_user_messages.*,tbl_user_messages.id subid,tbl_users.* FROM tbl_user_messages,tbl_messages,tbl_users WHERE tbl_messages.id=tbl_user_messages.msg_id AND  tbl_users.id=tbl_user_messages.reciever_id AND tbl_user_messages.sender_deleted='0'";

		if(isset($this->sentid) && $this->sentid!="")
		{
			$sSQL .= " AND tbl_user_messages.sender_id='$this->sentid' ";
		}
		if(isset($this->sendsearch) && $this->sendsearch!="")
		{
			 $sSQL .= " AND ( tbl_messages.subject like '%$this->sendsearch' or tbl_users.username like '%$this->sendsearch' ) ";
		}

		
		if(isset($this->sorting) && $this->sorting!="")
		{
			$sSQL .= " ORDER BY $this->sorting $obj_msg->order";
		}
		else
		{
			$sSQL .= " ORDER BY message_date desc ";
		}

		 $sSQL;
		if(isset($this->pageLimit) && $this->pageLimit!="")
		{
			$sSQL .= $this->pageLimit;
		}
	//	echo '<br>';
		// echo $sSQL;

		$RecordSet = $obj_con->select($sSQL);
		$obj_con->connection_close();
		return $RecordSet;

	}

	function getinbox()
	{
		$obj_con = new class_dbconnector();
		
		$sSQL = "SELECT tbl_messages.*,tbl_user_messages.id subid,tbl_user_messages.*,tbl_users.* FROM tbl_user_messages,tbl_messages,tbl_users WHERE tbl_messages.id=tbl_user_messages.msg_id AND  tbl_users.id=tbl_user_messages.sender_id AND 1=1  ";

		if(isset($this->inboxid) && $this->inboxid!="")
		{
			$sSQL .= " AND tbl_user_messages.reciever_id='$this->inboxid' ";
		}
		
if(isset($this->reciever_deleted) && $this->reciever_deleted!="")
		{
			$sSQL .= " AND tbl_user_messages.reciever_deleted='$this->reciever_deleted' ";
		}

if(isset($this->sender_deleted) && $this->sender_deleted!="")
		{
			$sSQL .= " AND tbl_user_messages.sender_deleted='$this->sender_deleted' ";
		}
		if(isset($this->inboxsearch) && $this->inboxsearch!="")
		{
			$sSQL .= " AND (tbl_messages.subject like '%$this->inboxsearch%' or tbl_users.username like '%$this->inboxsearch%' ) ";
		}
		if(isset($this->inbox_read) && $this->inbox_read!="")
		{
			$sSQL .= " AND tbl_user_messages.inbox_read='$this->inbox_read' ";
		}
		
		if(isset($this->sorting) && $this->sorting!="")
		{
			$sSQL .= " ORDER BY $this->sorting $this->order";
		}
		else
		{
			$sSQL .= " ORDER BY message_date desc ";
		}

		if(isset($this->pageLimit_inbox) && $this->pageLimit_inbox!="")
		{
			$sSQL .= $this->pageLimit_inbox;
		}

		 $sSQL ; //AND tbl_user_messages.inbox_read ='0'

		$RecordSet = $obj_con->select( $sSQL );
		$obj_con->connection_close();
		return $RecordSet;

	}

	function gettrashbox()
	{
		$obj_con = new class_dbconnector();
		
		$sSQL = "SELECT tbl_messages.*,tbl_user_messages.id subid,tbl_user_messages.*,tbl_users.* FROM tbl_user_messages,tbl_messages,tbl_users WHERE tbl_messages.id=tbl_user_messages.msg_id AND  tbl_users.id=tbl_user_messages.sender_id AND tbl_user_messages.reciever_deleted='1' ";

		if(isset($this->trashid) && $this->trashid!="")
		{
			$sSQL .= " AND ( tbl_user_messages.reciever_id='$this->trashid' or  tbl_users.username='$this->trashid' )";
		}
		if(isset($this->sender_deleted) && $this->sender_deleted!="")
		{
			$sSQL .= " AND  tbl_user_messages.sender_deleted='$this->sender_deleted' ";
		}
		if(isset($this->reciever_deleted) && $this->reciever_deleted!="")
		{
			$sSQL .= " AND  tbl_user_messages.reciever_deleted='$this->reciever_deleted' ";
		}

		if(isset($this->trashsearch) && $this->trashsearch!="")
		{
			$sSQL .= " AND tbl_messages.subject like '%$this->trashsearch' ";
		}
		if(isset($this->inbox_read) && $this->inbox_read!="")
		{
			$sSQL .= " AND tbl_user_messages.inbox_read ='$this->inbox_read' ";
		}

		
		if(isset($this->sorting) && $this->sorting!="")
		{
			$sSQL .= " ORDER BY $this->sorting $this->order";
		}
		else
		{
			$sSQL .= " ORDER BY message_date desc ";
		}

		if(isset($this->pageLimit_trash) && $this->pageLimit_trash!="")
		{
			$sSQL .= $this->pageLimit_trash;
		}
	
//echo $sSQL;
		$RecordSet = $obj_con->select( $sSQL );
		$obj_con->connection_close();
		return $RecordSet;

	}
 /* ******************* start show custom message *************** */

/* ******************* start delete message function *************** */
	
	function deleteinboxmsg()
	{
		$ObjClsDBInteraction = new class_dbconnector();
		
		if(isset($this->id))
		{
			$sSQL ="DELETE FROM tbl_user_messages WHERE id='$this->id'"; 
		}
		$objRecordSet = $ObjClsDBInteraction->select( $sSQL );
		$ObjClsDBInteraction->connection_close();
		return $nReturnValue;
	}//end of function
	
/* ******************* end delete message function *************** */
	
	
/* ******************* start Insert/Update message function *************** */
	
	function insertUpdatemessage()
	{
		$ObjClsDBInteraction = new class_dbconnector();
		
		
		
		
		if(isset($this->subject))
		$arr["subject"]            	= $this->subject;
		
		if(isset($this->message))
		$arr["message"]         = $this->message;

		if(isset($this->id) && $this->id!="")
		{
			$sWhere = " id = '$this->id'";
			 $nReturnValue = $ObjClsDBInteraction->insertUpdate( "tbl_messages", $arr, $sWhere);
		}
		else
		{
			$arr["message_date"] = date("Y-m-d H:i:s");
			$nReturnValue = $ObjClsDBInteraction->insertUpdate( "tbl_messages", $arr, null);
			//return $msg_id=mysql_insert_id();

		}
		$ObjClsDBInteraction->connection_close();
		return $nReturnValue;
	}
/* ******************* TOTAL RECORD Insert/Update message function  *************** */

	function insertUpdatemessage_sub()
	{
		$ObjClsDBInteraction = new class_dbconnector();
		
		if(isset($this->id))
		$arr["id"]            	= $this->id;

		if(isset($this->msg_id))
		$arr["msg_id"]            	= $this->msg_id;
		
		if(isset($this->reciverid))
		$arr["reciever_id"]         = $this->reciverid;

		if(isset($this->sender_id))
		$arr["sender_id"]            	= $this->sender_id;
		
		if(isset($this->sender_deleted))
		$arr["sender_deleted"]         = $this->sender_deleted;
		
		if(isset($this->inbox_read))
		$arr["inbox_read"]         = $this->inbox_read;

		if(isset($this->outbox_read))
		$arr["outbox_read"]            	= $this->outbox_read;
		
		if(isset($this->is_spam))
		$arr["is_spam"]         = $this->is_spam;

		if(isset($this->reciever_deleted))
		echo $arr["reciever_deleted"]         = $this->reciever_deleted;

		//echo $this->message_trash;
		if(isset($this->message_trash) && $this->message_trash!="")
		{
			
			$sWhere = " id = '$this->message_trash'";
			 $nReturnValue = $ObjClsDBInteraction->insertUpdate( "tbl_user_messages", $arr, $sWhere);
		}
		else
		{
			$nReturnValue = $ObjClsDBInteraction->insertUpdate( "tbl_user_messages", $arr, null);
		}
		
		$ObjClsDBInteraction->connection_close();
		return $nReturnValue;
	}
	
/* ******************* end Insert/Update message function *************** */

/* ******************* End By Deepak nagar *************** */
}//end of class
?>
