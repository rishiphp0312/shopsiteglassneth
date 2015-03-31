<?php
/*
	    **************************** Creation Log *******************************
	    File Name                   -  class.mail.inc
	    Module Name                 -  class
	    Project Name                -  Coupon Worm
	    Description                 -  Contain all functon for mail functionality
	    Version                     -  
	    Created by                  - 	Mahipal Adhikari 
	    Created on                  -   04-June-2009
		******************************** Update Log *************************************************************
		SNo		Version		Updated by			Updated on			Description
		*********************************************************************************************************
*/

class Class_Mail
{
	
	function Class_Mail()
	 {
		/*GLOBAL $def_page_size,$CompanyCountry,$searh;		
    	$this->PageSize = $def_page_size;
    	$this->company_country = $CompanyCountry;
    	$this->search = $searh;*/
    	
	 }
	 
	//Function is used to get mail format
	function selectMailTemplate()
	{

		$ObjClsDBInteraction = new class_dbconnector();

		$sSQL = "select * from tbl_mail where mail_id IS NOT NULL";
		if(isset($this->mail_id) && $this->mail_id!="")
		{
			$sSQL .= " AND mail_id = $this->mail_id";
		}
		if(isset($this->mail_title) && $this->mail_title!="")
		{
			$sSQL .= " AND mail_title='$this->mail_title'";
			//$sSQL .= " AND mail_title LIKE '%$this->mail_title%'";
		}
		//echo $sSQL . ";<br><br><br>";
		$objRecordSet = $ObjClsDBInteraction -> select($sSQL);
		$ObjClsDBInteraction->connection_close();
		return $objRecordSet;
	}//end of function
	
	//Function Insert/Update user details
	function insertUpdateMailTemplate()
	{
		$ObjClsDBInteraction = new class_dbconnector();
		
		if(isset($this->mail_title))
		$arr["mail_title"]            	= $this->mail_title;
		
		if(isset($this->mail_subject))
		$arr["mail_subject"]			= $this->mail_subject;
		
		if(isset($this->mail_content))
		$arr["mail_content"]			= $this->mail_content;
		
		if(isset($this->mail_id) && $this->mail_id!="")
		{
			 $sWhere = " mail_id = '$this->mail_id'";
			 $nReturnValue = $ObjClsDBInteraction->insertUpdate( "tbl_mail", $arr, $sWhere);
		}
		else
		{
			//$arr["registration_date"] = date("Y-m-d H:i:s");
			$nReturnValue = $ObjClsDBInteraction->insertUpdate( "tbl_mail", $arr, null);
		}
		$ObjClsDBInteraction->connection_close();
		return $nReturnValue;
	}//end of function
	
	//function delete
	function deleteMailTemplate()
	{
		$ObjClsDBInteraction = new class_dbconnector();
		
		if(isset($this->mail_id))
		{
			$sSQL ="delete from tbl_mail where mail_id='$this->mail_id'"; 
		}
		$objRecordSet = $ObjClsDBInteraction->select( $sSQL );
		$ObjClsDBInteraction->connection_close();
		return $nReturnValue;
	}//end of function
	
}//end of class
?>