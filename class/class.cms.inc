<?php
/*
	    ******************************** Creation Log ***********************************************************
	    File Name                   -  class.cms.inc
	    Module Name                 -  class
	    Project Name                -  
	    Description                 -  Contain all functon for CMS pages
	    Version                     -  
	    Created by                  -  Mahipal Adhikari 
	    Created on                  -  13-Nov-2009
		******************************** Update Log *************************************************************
		SNo		Version		Updated by			Updated on			Description
		*********************************************************************************************************
*/

class Class_CMS
{
	
	function Class_CMS()
	 {
		/*GLOBAL $def_page_size,$CompanyCountry,$searh;		
    	$this->PageSize = $def_page_size;
    	$this->company_country = $CompanyCountry;
    	$this->search = $searh;*/
    	
	 }//end of function
	 
	//Function is used to get cms page details
	function selectCmsPage()
	{

		$ObjClsDBInteraction = new class_dbconnector();

		$sSQL = "SELECT * FROM admin_post_page WHERE page_id IS NOT NULL";
		//get by page id
		if(isset($this->page_id) && $this->page_id!="")
		{
			$sSQL .= " AND page_id = $this->page_id";
		}
		//get by page link id
		if(isset($this->page_link_id) && $this->page_link_id!="")
		{
			$sSQL .= " AND page_link_id = '$this->page_link_id'";
			//$sSQL .= " OR description LIKE '%$this->page_title%'";
		}
		//get by page title
		if(isset($this->page_title) && $this->page_title!="")
		{
			$sSQL .= " AND page_title LIKE '%$this->page_title%'";
			//$sSQL .= " OR description LIKE '%$this->page_title%'";
		}
		if(isset($this->page_title1) && $this->page_title1!="")
		{
		 	$sSQL .= " OR page_title LIKE '%$this->page_title1%'";
		 	//$sSQL .= " OR description LIKE '%$this->page_title1%'";
		}
		$sSQL .=" ORDER BY page_title"; 
		//echo $sSQL . ";<br><br><br>";
		$objRecordSet = $ObjClsDBInteraction -> select($sSQL);
		$ObjClsDBInteraction->connection_close();
		return $objRecordSet;
	}//end of function
	
	//Function Insert/Update CMS page details
	function insertUpdateCmsPage()
	{
		$ObjClsDBInteraction = new class_dbconnector();
		
		if(isset($this->page_link_id))
		$arr["page_link_id"]           	= $this->page_link_id;
		
		if(isset($this->page_title))
		$arr["page_title"]            	= $this->page_title;
		
		if(isset($this->meta_title))
		$arr["meta_title"]            	= $this->meta_title;
		
		if(isset($this->meta_keywords))
		$arr["meta_keywords"]          	= $this->meta_keywords;
		
		if(isset($this->meta_description))
		$arr["meta_description"]        = $this->meta_description;
		
		if(isset($this->description))
		$arr["description"]				= $this->description;
		
		if(isset($this->page_id) && $this->page_id!="")
		{
			 $arr["posttime"]= date("Y-m-d H:i:s");
			 $sWhere = " page_id = '$this->page_id'";
			 $nReturnValue = $ObjClsDBInteraction->insertUpdate( "admin_post_page", $arr, $sWhere);
		}
		else
		{
			$arr["posttime"] = date("Y-m-d H:i:s");
			$nReturnValue = $ObjClsDBInteraction->insertUpdate( "admin_post_page", $arr, null);
		}
		$ObjClsDBInteraction->connection_close();
		return $nReturnValue;
	}//end of function
	
	//Function to Delete cms pages
	function deleteCmsPage()
	{
		$ObjClsDBInteraction = new class_dbconnector();
		if($this->page_id!="")
		{
			$sSQL ="DELETE FROM admin_post_page WHERE page_id='$this->page_id'"; 
		}
		//print $sSQL;
		$objRecordSet = $ObjClsDBInteraction->select( $sSQL );
		$ObjClsDBInteraction->connection_close();
		return $objRecordSet;
	}//end of function

}//end of class
?>