<?php
/*
	**************************** Creation Log **********************************************************************
	File Name                   -  class.category.inc
	Module Name                 -  class
	Project Name                -  
	Description                 -  Contain all functon for category,keywords,job function, country and state table
	Version                     -  
	Created by                  -  Mahipal Adhikari 
	Created on                  -  5-May-2010
	******************************** Update Log ********************************************************************
	SNo		Version		Updated by			Updated on			Description
	****************************************************************************************************************
*/

class Class_Category
{
     //------------->>>>>.slabs with subscription<<<<----------
       function deleteSlabs()
	{

		$ObjClsDBInteraction = new class_dbconnector();


                if(isset($this->slab_id) && $this->slab_id!="")
		{
	$sSQL ="DELETE FROM tbl_subscription_slabs WHERE cat_com_id='$this->slab_id' ";
		}


		 $sSQL . ";<br><br><br>";
		$objRecordSet = $ObjClsDBInteraction->select($sSQL);
		$ObjClsDBInteraction->connection_close();
		return $objRecordSet;


         }
        function selectSlabs()
	{

		$ObjClsDBInteraction = new class_dbconnector();

		$sSQL = "SELECT * FROM tbl_subscription_slabs WHERE 1=1 ";
		//select subscription  for slabs
		if(isset($this->slab_id) && $this->slab_id!="")
		{
			$sSQL .= " AND cat_com_id = '$this->slab_id' ";
		}




		//$sSQL .= " AND status=1";
                $sSQL .= " ORDER BY cat_com_id asc ";

		if(isset($this->pageLimit) && $this->pageLimit!="")
		$sSQL .= $this->pageLimit;

		 $sSQL . ";<br><br><br>";
		$objRecordSet = $ObjClsDBInteraction -> select($sSQL);
		$ObjClsDBInteraction->connection_close();
		return $objRecordSet;

        }

	function insertUpdateSlabs()
	{
		$ObjClsDBInteraction = new class_dbconnector();

		if(isset($this->package_name))
		$arr["package_name"]	         = $this->package_name;

		if(isset($this->amount_1month))
		$arr["amount_1month"]		 = $this->amount_1month;

                if(isset($this->amount_6month))
		$arr["amount_6month"]            = $this->amount_6month;


                if(isset($this->amount_12month))
		$arr["amount_12month"]            = $this->amount_12month;

                if(isset($this->start_item_range))
		$arr["start_item"]              = $this->start_item_range;

                if(isset($this->end_item_range))
		$arr["end_item"]                = $this->end_item_range;


                if(isset($this->description))
		$arr["description"]       = $this->description;


		if(isset($this->slab_id) && $this->slab_id!="")
		{
			// $arr["UpdatedBy"]	= $_SESSION['session_admin_user_id'];
			 //$arr["updatedOn"]	= date("Y-m-d H:i:s");
			 $sWhere = " cat_com_id = '$this->slab_id'";
			 $nReturnValue = $ObjClsDBInteraction->insertUpdate("tbl_subscription_slabs", $arr, $sWhere);
		}
		else
		{
			//$arr["createdBy"]	= $_SESSION['session_admin_user_id'];
			$arr["date_added"] 	= date("Y-m-d H:i:s");
			$nReturnValue = $ObjClsDBInteraction->insertUpdate("tbl_subscription_slabs", $arr, null);
		}
		$ObjClsDBInteraction->connection_close();
		return $nReturnValue;
	}
        ////end of function
        //
//----------end of slabs-----------------------///


	//------------------------------------->>>>> Category <<<<<-------------------------------------
	// this function is used to get category
	function selectCatgeory()
	{
		$ObjClsDBInteraction = new class_dbconnector();

		$sSQL = "SELECT cat1.* FROM tbl_category_master cat1";
		//$sSQL .=" LEFT JOIN tbl_category_master cat2 ON(cat1.category_id=cat2.parent_id)";
		$sSQL .= " WHERE cat1.category_id IS NOT NULL";
		if(isset($this->category_id) && $this->category_id!="")
		{
			$sSQL .= " AND cat1.category_id = $this->category_id";
		}
		//$sSQL .= " AND status=1";
		$sSQL .= " ORDER BY cat1.name";
		
		if(isset($this->pageLimit) && $this->pageLimit!="")
		$sSQL .= $this->pageLimit;
		
	echo $sSQL . ";<br><br><br>";
		$objRecordSet = $ObjClsDBInteraction -> select($sSQL);
		$ObjClsDBInteraction->connection_close();
		return $objRecordSet;
	}//end of function
	function selectCatgeory1()
	{
		$ObjClsDBInteraction = new class_dbconnector();

		$sSQL = "SELECT cat1.* FROM tbl_category_master cat1 ";
		
		$sSQL .= " WHERE cat1.category_id IS NOT NULL and parent_id!=0 " ;
		if(isset($this->category_id) && $this->category_id!="")
		{
			$sSQL .= " AND cat1.category_id = $this->category_id";
		}
			if(isset($this->parent_id) && $this->parent_id!="")
		{
			$sSQL .= " AND cat1.parent_id = $this->parent_id";
		}
		//$sSQL .= " AND status=1";
		$sSQL .= " ORDER BY parent_id ";
		
		if(isset($this->pageLimit) && $this->pageLimit!="")
		$sSQL .= $this->pageLimit;
		
		 $sSQL . ";<br><br><br>";
		$objRecordSet = $ObjClsDBInteraction -> select($sSQL);
		$ObjClsDBInteraction->connection_close();
		return $objRecordSet;
	}//end of function


	
	//select parent category
	function selectParentCatgeory()
	{
		$ObjClsDBInteraction = new class_dbconnector();

		$sSQL = "SELECT category_id, name FROM tbl_category_master WHERE parent_id=0";
		if(isset($this->category_id) && $this->category_id!="")
		{
			$sSQL .= " AND category_id = $this->category_id";
		}
		//$sSQL .= " AND status=1";
		$sSQL .= " ORDER BY name";
		
		if(isset($this->pageLimit) && $this->pageLimit!="")
		$sSQL .= $this->pageLimit;
		
		//echo $sSQL . ";<br><br><br>";
		$objRecordSet = $ObjClsDBInteraction -> select($sSQL);
		$ObjClsDBInteraction->connection_close();
		return $objRecordSet;
	}//end of function

	//select sub  category
	function selectSubCatgeory()
	{
		$ObjClsDBInteraction = new class_dbconnector();

		$sSQL = "SELECT category_id, name FROM tbl_category_master WHERE parent_id!=0";
		if(isset($this->category_id) && $this->category_id!="")
		{
			$sSQL .= " AND category_id = $this->category_id";
		}
		//select sub cateory for a main cateory
		if(isset($this->parent_id) && $this->parent_id!="")
		{
			$sSQL .= " AND parent_id = $this->parent_id";
		}
		$sSQL .= " AND status=1";
		$sSQL .= " ORDER BY name";
		
		if(isset($this->pageLimit) && $this->pageLimit!="")
		$sSQL .= $this->pageLimit;
		
		//echo $sSQL . ";<br><br><br>";
		$objRecordSet = $ObjClsDBInteraction -> select($sSQL);
		$ObjClsDBInteraction->connection_close();
		return $objRecordSet;
	}//end of function
	
	// this function is used get existing name
	function validateExisringName()
	{

		$ObjClsDBInteraction = new class_dbconnector();

		$sSQL = "SELECT name FROM tbl_category_master WHERE category_id IS NOT NULL";
		if(isset($this->name) && $this->name!="")
		{
			$sSQL .= " AND name = '$this->name' ";
		}
		if(isset($this->category_id) && $this->category_id!="")
		{
			$sSQL .= " AND category_id != '$this->category_id' ";
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
	
	//Function Insert/Update
	function insertUpdateCatgeory()
	{

		$ObjClsDBInteraction = new class_dbconnector();
		
		if(isset($this->parent_id))
		$arr["parent_id"]			  = $this->parent_id;
		
		if(isset($this->name))
		$arr["name"]		  = $this->name;
		
		if(isset($this->description))
		$arr["description"]       = $this->description;

                if(isset($this->commision))
		$arr["commision"]         = $this->commision;
		
		if(isset($this->status))
		$arr["status"]            = $this->status;
	echo '<pre>';print_r($arr);
		if(isset($this->category_id) && $this->category_id!="")
		{
			 $arr["UpdatedBy"]	= $_SESSION['session_admin_user_id'];
			 $arr["updatedOn"]	= date("Y-m-d H:i:s");
			 $sWhere = " category_id = '$this->category_id'";
	 $nReturnValue = $ObjClsDBInteraction->insertUpdate( "tbl_category_master", $arr, $sWhere);
//		exit;

                }
		else
		{
			$arr["createdBy"]	= $_SESSION['session_admin_user_id'];
			$arr["createdOn"] 	= date("Y-m-d H:i:s");
			$nReturnValue = $ObjClsDBInteraction->insertUpdate( "tbl_category_master", $arr, null);
		}
		$ObjClsDBInteraction->connection_close();
		return $nReturnValue;
	}//end of function
	
	//function delete
	function deleteCatgeory()
	{
		$ObjClsDBInteraction = new class_dbconnector();
		
		if(isset($this->category_id))
		{
			$sSQL ="DELETE FROM tbl_category_master WHERE category_id='$this->category_id' OR parent_id='$this->category_id'"; 
		}
		
		$objRecordSet = $ObjClsDBInteraction->select( $sSQL );
		$ObjClsDBInteraction->connection_close();
		return $nReturnValue;
	}//end of function
	
	#------------------------------------->>>>> Keywords <<<<<-------------------------------------#		
	// this function is used to get records
	function selectKeywords()
	{
		$ObjClsDBInteraction = new class_dbconnector();

		$sSQL = "select * from tbl_keyword_master where keyword_id IS NOT NULL";
		$sSQL .=" AND business_id=0";//get all keywords which entered by admin
		if(isset($this->keyword_id) && $this->keyword_id!="")
		{
			$sSQL .= " AND keyword_id = $this->keyword_id";
		}
		//$sSQL .= " AND status=1";
		$sSQL .= " ORDER BY keyword";
		
		if(isset($this->pageLimit) && $this->pageLimit!="")
		$sSQL .= $this->pageLimit;
		
		//echo $sSQL . ";<br><br><br>";
		$objRecordSet = $ObjClsDBInteraction -> select($sSQL);
		$ObjClsDBInteraction->connection_close();
		return $objRecordSet;
	}//end of function
	
	// this function is used get existing record
	function validateExisringKeywords()
	{

		$ObjClsDBInteraction = new class_dbconnector();

		$sSQL = "select keyword from tbl_keyword_master where keyword_id IS NOT NULL";
		if(isset($this->keyword) && $this->keyword!="")
		{
			$sSQL .= " AND keyword = '$this->keyword' ";
		}
		if(isset($this->keyword_id) && $this->keyword_id!="")
		{
			$sSQL .= " AND keyword_id != '$this->keyword_id' ";
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
	
	//Function Insert/Update
	function insertUpdateKeywords()
	{
		$ObjClsDBInteraction = new class_dbconnector();
		
		if(isset($this->keyword))
		$arr["keyword"]			  = $this->keyword;
		
		if(isset($this->description))
		$arr["description"]       = $this->description;
		
		if(isset($this->status))
		$arr["status"]            = $this->status;
		
		if(isset($this->keyword_id) && $this->keyword_id!="")
		{
			 $arr["UpdatedBy"]	= $_SESSION['session_admin_user_id'];
			 $arr["updatedOn"]	= date("Y-m-d H:i:s");
			 $sWhere = " keyword_id = '$this->keyword_id'";
			 $nReturnValue = $ObjClsDBInteraction->insertUpdate( "tbl_keyword_master", $arr, $sWhere);
		}
		else
		{
			$arr["createdBy"]	= $_SESSION['session_admin_user_id'];
			$arr["createdOn"] 	= date("Y-m-d H:i:s");
			$nReturnValue = $ObjClsDBInteraction->insertUpdate( "tbl_keyword_master", $arr, null);
		}
		//echo "<pre>";
		//print_r($arr);
		$ObjClsDBInteraction->connection_close();
		return $nReturnValue;
	}//end of function
	
	//function delete
	function deleteKeywords()
	{
		$ObjClsDBInteraction = new class_dbconnector();
		
		if(isset($this->keyword_id))
		{
			$sSQL ="delete from tbl_keyword_master where keyword_id='$this->keyword_id'"; 
		}
		$objRecordSet = $ObjClsDBInteraction->select( $sSQL );
		$ObjClsDBInteraction->connection_close();
		return $nReturnValue;
	}//end of function
	
	#------------------------------------->>>>> Job Functions <<<<<-------------------------------------#		
	// this function is used to get records
	function selectJobs()
	{
		$ObjClsDBInteraction = new class_dbconnector();

		$sSQL = "select * from tbl_job_master where job_id IS NOT NULL";
		if(isset($this->job_id) && $this->job_id!="")
		{
			$sSQL .= " AND job_id = $this->job_id";
		}
		//$sSQL .= " AND status=1";
		$sSQL .= " ORDER BY name";
		
		if(isset($this->pageLimit) && $this->pageLimit!="")
		$sSQL .= $this->pageLimit;
		
		//echo $sSQL . ";<br><br><br>";
		$objRecordSet = $ObjClsDBInteraction -> select($sSQL);
		$ObjClsDBInteraction->connection_close();
		return $objRecordSet;
	}//end of function
	
	// this function is used get existing name
	function validateExisringJob()
	{

		$ObjClsDBInteraction = new class_dbconnector();

		$sSQL = "select name from tbl_job_master where job_id IS NOT NULL";
		if(isset($this->name) && $this->name!="")
		{
			$sSQL .= " AND name = '$this->name' ";
		}
		if(isset($this->job_id) && $this->job_id!="")
		{
			$sSQL .= " AND job_id != '$this->job_id' ";
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
	
	//Function Insert/Update
	function insertUpdateJob()
	{
		$ObjClsDBInteraction = new class_dbconnector();
		
		if(isset($this->name))
		$arr["name"]			  = $this->name;
		
		if(isset($this->description))
		$arr["description"]       = $this->description;
		
		if(isset($this->status))
		$arr["status"]            = $this->status;
		
		if(isset($this->job_id) && $this->job_id!="")
		{
			 $arr["UpdatedBy"]	= $_SESSION['session_admin_user_id'];
			 $arr["updatedOn"]	= date("Y-m-d H:i:s");
			 $sWhere = " job_id = '$this->job_id'";
			 $nReturnValue = $ObjClsDBInteraction->insertUpdate( "tbl_job_master", $arr, $sWhere);
		}
		else
		{
			$arr["createdBy"]	= $_SESSION['session_admin_user_id'];
			$arr["createdOn"] 	= date("Y-m-d H:i:s");
			$nReturnValue = $ObjClsDBInteraction->insertUpdate( "tbl_job_master", $arr, null);
		}
		//echo "<pre>";
		//print_r($arr);
		$ObjClsDBInteraction->connection_close();
		return $nReturnValue;
	}//end of function
	
	//function delete
	function deleteJob()
	{
		$ObjClsDBInteraction = new class_dbconnector();
		
		if(isset($this->job_id))
		{
			$sSQL ="delete from tbl_job_master where job_id='$this->job_id'"; 
		}
		$objRecordSet = $ObjClsDBInteraction->select( $sSQL );
		$ObjClsDBInteraction->connection_close();
		return $nReturnValue;
	}//end of function
	
	#------------------------------------->>>>> Country <<<<<-------------------------------------#	
	// this function is used to get records
	function selectCountry()
	{
		$ObjClsDBInteraction = new class_dbconnector();

		$sSQL = "select * from tbl_country_master where id IS NOT NULL";
		if(isset($this->country_id) && $this->country_id!="")
		{
			$sSQL .= " AND id = $this->country_id";
		}
		//$sSQL .= " AND status=1";
		$sSQL .= " ";
		
		if(isset($this->pageLimit) && $this->pageLimit!="")
		$sSQL .= $this->pageLimit;
		
	 $sSQL . ";<br><br><br>";
		$objRecordSet = $ObjClsDBInteraction ->select($sSQL);
		$ObjClsDBInteraction->connection_close();
		return $objRecordSet;
	}//end of function
	
	// this function is used get existing name
	function validateExisringCountry()
	{

		$ObjClsDBInteraction = new class_dbconnector();

		$sSQL = "select name from tbl_country_master where country_id IS NOT NULL";
		if(isset($this->name) && $this->name!="")
		{
			$sSQL .= " AND name = '$this->name' ";
		}
		if(isset($this->country_id) && $this->country_id!="")
		{
			$sSQL .= " AND country_id != '$this->country_id' ";
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
	
	//Function Insert/Update
	function insertUpdateCountry()
	{
		$ObjClsDBInteraction = new class_dbconnector();
		
		if(isset($this->name))
		$arr["name"]			  = $this->name;
		
		if(isset($this->description))
		$arr["description"]       = $this->description;
		
		if(isset($this->status))
		$arr["status"]            = $this->status;
		
		if(isset($this->country_id) && $this->country_id!="")
		{
			 $arr["UpdatedBy"]	= $_SESSION['session_admin_user_id'];
			 $arr["updatedOn"]	= date("Y-m-d H:i:s");
			 $sWhere = " country_id = '$this->country_id'";
			 $nReturnValue = $ObjClsDBInteraction->insertUpdate( "tbl_country_master", $arr, $sWhere);
		}
		else
		{
			$arr["createdBy"]	= $_SESSION['session_admin_user_id'];
			$arr["createdOn"] 	= date("Y-m-d H:i:s");
			$nReturnValue = $ObjClsDBInteraction->insertUpdate( "tbl_country_master", $arr, null);
		}
		//echo "<pre>";
		//print_r($arr);
		$ObjClsDBInteraction->connection_close();
		return $nReturnValue;
	}//end of function
	
	//function delete
	function deleteCountry()
	{
		$ObjClsDBInteraction = new class_dbconnector();
		
		if(isset($this->country_id))
		{
			$sSQL ="delete from tbl_country_master where country_id='$this->country_id'"; 
		}
		$objRecordSet = $ObjClsDBInteraction->select( $sSQL );
		$ObjClsDBInteraction->connection_close();
		return $nReturnValue;
	}//end of function
	
	#------------------------------------->>>>> State <<<<<-------------------------------------#	
	// this function is used to get records
	function selectState()
	{
		$ObjClsDBInteraction = new class_dbconnector();

		$sSQL = "SELECT tsm.*,tcm.name AS country_name,tcm.country_id FROM tbl_state_master tsm";
		$sSQL .= " JOIN tbl_country_master tcm USING(country_id)";
		$sSQL .=" WHERE tsm.state_id IS NOT NULL";
		if(isset($this->state_id) && $this->state_id!="")
		{
			$sSQL .= " AND tsm.state_id = $this->state_id";
		}
		//$sSQL .= " AND status=1";
		$sSQL .= " ORDER BY tsm.name";
		
		if(isset($this->pageLimit) && $this->pageLimit!="")
		$sSQL .= $this->pageLimit;
		
		//echo $sSQL . ";<br><br><br>";
		$objRecordSet = $ObjClsDBInteraction -> select($sSQL);
		$ObjClsDBInteraction->connection_close();
		return $objRecordSet;
	}//end of function
	
	// this function is used get existing name
	function validateExisringState()
	{

		$ObjClsDBInteraction = new class_dbconnector();

		$sSQL = "select name from tbl_state_master where state_id IS NOT NULL";
		if(isset($this->name) && $this->name!="")
		{
			$sSQL .= " AND name = '$this->name' ";
		}
		if(isset($this->country_id) && $this->country_id!="")
		{
			$sSQL .= " AND country_id = '$this->country_id' ";
		}
		if(isset($this->state_id) && $this->state_id!="")
		{
			$sSQL .= " AND state_id != '$this->state_id' ";
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
	
	//Function Insert/Update
	function insertUpdateState()
	{
		$ObjClsDBInteraction = new class_dbconnector();
		
		if(isset($this->name))
		$arr["name"]			  = $this->name;
		
		if(isset($this->country_id))
		$arr["country_id"]		  = $this->country_id;
		
		if(isset($this->description))
		$arr["description"]       = $this->description;
		
		if(isset($this->status))
		$arr["status"]            = $this->status;
		
		if(isset($this->state_id) && $this->state_id!="")
		{
			 $arr["UpdatedBy"]	= $_SESSION['session_admin_user_id'];
			 $arr["updatedOn"]	= date("Y-m-d H:i:s");
			 $sWhere = " state_id = '$this->state_id'";
			 $nReturnValue = $ObjClsDBInteraction->insertUpdate( "tbl_state_master", $arr, $sWhere);
		}
		else
		{
			$arr["createdBy"]	= $_SESSION['session_admin_user_id'];
			$arr["createdOn"] 	= date("Y-m-d H:i:s");
			$nReturnValue = $ObjClsDBInteraction->insertUpdate( "tbl_state_master", $arr, null);
		}
		//echo "<pre>";
		//print_r($arr);
		$ObjClsDBInteraction->connection_close();
		return $nReturnValue;
	}//end of function
	
	//function delete
	function deleteState()
	{
		$ObjClsDBInteraction = new class_dbconnector();
		
		if(isset($this->state_id))
		{
			$sSQL ="delete from tbl_state_master where state_id='$this->state_id'"; 
		}
		if(isset($this->country_id))
		{
			$sSQL ="delete from tbl_state_master where country_id='$this->country_id'"; 
		}
		$objRecordSet = $ObjClsDBInteraction->select( $sSQL );
		$ObjClsDBInteraction->connection_close();
		return $nReturnValue;
	}//end of function
}//end of class
?>