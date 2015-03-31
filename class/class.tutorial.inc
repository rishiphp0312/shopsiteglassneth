<?php
	/*
	******************************** Creation Log *******************************************************************
	File Name                   -  class.tutorial.inc
	Module Name                 -  class
	Project Name                -  
	Description                 -  Contain all functon for Tutorial module
	Version                     -  
	Created by                  -  Mahipal Adhikari 
	Created on                  -  11-Oct-2010
	******************************** Update Log *********************************************************************
	SNo		Version		Updated by			Updated on			Description
	*****************************************************************************************************************
	*/

class Class_Tutorial
{
	//select tutorial
	function selectTutorials()
	{

		$ObjClsDBInteraction = new class_dbconnector();

		$sSQL = "SELECT * FROM tbl_tutorials WHERE tute_id IS NOT NULL";
		if(isset($this->tute_id) && $this->tute_id!="")
		{
			$sSQL .= " AND tute_id = $this->tute_id";
		}
		if(isset($this->tute_language) && $this->tute_language!="")
		{
			$sSQL .= " AND tute_language = '$this->tute_language'";
		}
		$sSQL .=" ORDER BY tute_language ASC ";

		if(isset($this->pageLimit) && $this->pageLimit!="")
		{
			$sSQL .= $this->pageLimit;
		}
		//echo $sSQL . ";<br><br><br>";
		$objRecordSet = $ObjClsDBInteraction -> select($sSQL);
		$ObjClsDBInteraction->connection_close();
		return $objRecordSet;
	}//end of function
	

	//insert and update tutorial
	function insertUpdateTutorial()
	{
		$ObjClsDBInteraction = new class_dbconnector();
		if(isset($this->tute_language))
		{
			$arr["tute_language"]	= $this->tute_language;
		}
		if(isset($this->tute_video))
		{
			$arr["tute_video"]    	= $this->tute_video;
		}
		if(isset($this->tute_id) && $this->tute_id!="")
		{
			$arr["modified"] = date("Y-m-d H:i:s");
			$sWhere = " tute_id = '$this->tute_id'";
			$nReturnValue = $ObjClsDBInteraction->insertUpdate("tbl_tutorials", $arr, $sWhere);
		}
		else
		{
			$arr["created"] = date("Y-m-d H:i:s");
			$nReturnValue = $ObjClsDBInteraction->insertUpdate("tbl_tutorials", $arr, null);	
		}
		$ObjClsDBInteraction->connection_close();
		return $nReturnValue;
	}//end of function
	

	//delete tutorial
	function deleteTutorial()
	{
		$ObjClsDBInteraction = new class_dbconnector();
		if($this->tute_id!="")
		{
			$sSQL ="DELETE FROM tbl_tutorials WHERE tute_id='$this->tute_id'"; 
		}
		$objRecordSet = $ObjClsDBInteraction->select( $sSQL );
		$ObjClsDBInteraction->connection_close();
		return $objRecordSet;
	}//end of function

}//end of class
?>