<?php
/*
	    **************************** Creation Log ***************************************************************
	    File Name                   -  class.news_letter.inc
	    Module Name                 -  class
	    Project Name                -  Nethaat
	    Description                 -  Contain all functon for news letter
	    Version                     -  
	    Created by                  - 	Mahipal Adhikari 
	    Created on                  -   12-May-2010
		******************************** Update Log *************************************************************
		SNo		Version		Updated by			Updated on			Description
		*********************************************************************************************************
*/

class Class_NewsLetter
{
	//Function is used to get User details
	function selectNewsLetter()
	{
		$ObjClsDBInteraction = new class_dbconnector();

		$sSQL  ="SELECT * FROM tbl_news_letter";
		$sSQL .=" WHERE news_letter_id IS NOT NULL";
		if(isset($this->news_letter_id) && $this->news_letter_id!="")
		{
			$sSQL .= " AND news_letter_id = $this->news_letter_id";
		}
		if(isset($this->status) && $this->status!="")
		{
			$sSQL .= " AND status = $this->status";
		}
		$sSQL .=" ORDER BY news_letter_email";
		
		if(isset($this->pageLimit) && $this->pageLimit!="")
		{
			$sSQL .= $this->pageLimit;
		}	
		//echo $sSQL . ";<br><br><br>";
		$objRecordSet = $ObjClsDBInteraction -> select($sSQL);
		$ObjClsDBInteraction->connection_close();
		return $objRecordSet;
	}//end of function
	
	// this function is used get existing email
	function validateExisringEmail()
	{

		$ObjClsDBInteraction = new class_dbconnector();

		$sSQL = "SELECT news_letter_email FROM tbl_news_letter WHERE news_letter_id IS NOT NULL";
		if(isset($this->news_letter_email) && $this->news_letter_email!="")
		{
			$sSQL .= " AND news_letter_email = '$this->news_letter_email' ";
		}
		if(isset($this->news_letter_id) && $this->news_letter_id!="")
		{
			$sSQL .= " AND news_letter_id != $this->news_letter_id";
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
	
	//Function Insert/Update NewsLetter details
	function insertUpdateNewsLetter()
	{
		$ObjClsDBInteraction = new class_dbconnector();
		
		if(isset($this->news_letter_email))
		$arr["news_letter_email"]         = $this->news_letter_email;
		
		if(isset($this->news_letter_id) && $this->news_letter_id!="")
		{
			$arr["updatedOn"] = date("Y-m-d H:i:s"); 
			$sWhere = " news_letter_id = '$this->news_letter_id'";
			$nReturnValue = $ObjClsDBInteraction->insertUpdate( "tbl_news_letter", $arr, $sWhere);
		}
		else
		{
			$arr["createdOn"] = date("Y-m-d H:i:s");
			$nReturnValue = $ObjClsDBInteraction->insertUpdate( "tbl_news_letter", $arr, null);
		}
		$ObjClsDBInteraction->connection_close();
		return $nReturnValue;
	}//end of function
	
	//function delete
	function deleteNewsLetter()
	{
		$ObjClsDBInteraction = new class_dbconnector();
		
		if(isset($this->news_letter_id))
		{
			$sSQL ="DELETE FROM tbl_news_letter WHERE news_letter_id='$this->news_letter_id'"; 
		}
		$objRecordSet = $ObjClsDBInteraction->select( $sSQL );
		$ObjClsDBInteraction->connection_close();
		return $nReturnValue;
	}//end of function
	
}//end of class
?>