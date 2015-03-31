<?php
/*
	    **************************** Creation Log ***************************************************************
	    File Name                   -  class.search.inc
	    Module Name                 -  class
	    Project Name                -  
	    Description                 -  Contain all common functons used for property searching functionality
	    Version                     -  
	    Created by                  -  Mahipal Adhikari 
	    Created on                  -  17-Nov-2009
		******************************** Update Log *************************************************************
		SNo		Version		Updated by			Updated on			Description
		*********************************************************************************************************
*/

class Class_Search
{
	
	// This function is used to get properties details
	function selectProperty()
	{
		global $distt_neighborhood_arr, $neigh_subdivsion_arr, $zip_neighborhood;
		$ObjClsDBInteraction = new class_dbconnector();

		$sSQL = "SELECT DISTINCT id, mls_no, form, business_name, status, listing_status, district, subdivision_abbrev, abbrev_address, price, land_area, living_area, DATEDIFF(CURDATE(), listing_date) AS days_on_mkt, dom, bedrooms, baths, mapX, mapY, DOM_start_date, restrictions, remarks FROM mls_feeds";
		$sSQL .=" WHERE id IS NOT NULL";
		//get particular property
		if(isset($this->id) && $this->id!="")
		{
			$sSQL .= " AND id = $this->id";
		}
		//search by district
		/*if(isset($this->district) && $this->district!="")
		{
			$sSQL .= " AND district = '$this->district'";
		}*/
		
		//echo "<pre>";
		//print_r($neigh_subdivsion_arr);
		//search all District and All Neighborhood
		/*if($this->district=="-1" && $this->neighborhood=="All Neighborhood")
		{
			foreach($neigh_subdivsion_arr as $mainKey=>$mainVal)
			{
				echo "<br>------------------------Main=".$mainKey;
				foreach($neigh_subdivsion_arr[$mainKey] as $subKey=>$subVal)
				{
					echo "<br>sub=>".$subVal;
				}
			}
		}*/
		
		//search by particular neighborhood
		if(isset($this->neighborhood) && $this->neighborhood!="All Neighborhood")
		{
			//$sSQL .= " AND neighborhood = '$this->neighborhood'";
			//$sSQL .= " AND district = '$this->neighborhood'"; //commented on 24-Feb-2004 for new search
			
			//following line code commented on 9-March-10, implemented new search by subdivision
			//$sSQL .= " AND (district LIKE '%$this->neighborhood%' OR subdivision_abbrev LIKE '%$this->neighborhood%')";

            //add condition for subdivision search
            foreach($neigh_subdivsion_arr[$this->neighborhood] as $subKey=>$subVal)
			{
                $subVal = addslashes($subVal);
                //$single_nbh_SQL .= " subdivision LIKE '%$subVal%' OR";
                $single_nbh_SQL .= " subdivision ='$subVal' OR";
			}
			$single_nbh_SQL = substr($single_nbh_SQL,0,strlen($single_nbh_SQL)-2);
			$sSQL .= " AND (".$single_nbh_SQL.")";

            //search by zip code instead of sub division ## Commented above line on 30-mar-2010
            //add condition for zip codes search
            //$sSQL .= " AND zip_code='".$zip_neighborhood[$this->neighborhood]."'";
		}
		//search by all neighborhood for a district
		if((isset($this->neighborhood) && $this->neighborhood=="All Neighborhood") && (isset($this->district) && $this->district!="-1"))
		{
			$nbhSQL = "";
			//following foreach loop commented on 9-March-10, implemented new search by subdivision
			/*foreach($distt_neighborhood_arr[$this->district] as $key=>$value)
			{
				//$nbhSQL .= " district='$value' OR";
				//$nbhSQL .= " subdivision_abbrev LIKE '%$value%' OR"; //commented on 24-Feb-2004 for new search
				$nbhSQL .= " district LIKE '%$value%' OR subdivision_abbrev LIKE '%$value%' OR";
				//$nbhSQL .= " subdivision_abbrev LIKE '%$value%' OR";
			}*/
			foreach($distt_neighborhood_arr[$this->district] as $key=>$value)
			{
				//echo "<br>------------------------Main=".$value;

                foreach($neigh_subdivsion_arr[$value] as $subKey=>$subVal)
				{
                    $subVal = addslashes($subVal);
                    //$nbhSQL .= " subdivision LIKE '%$subVal%' OR";
                    $nbhSQL .= " subdivision = '$subVal' OR";
				}

				//search by zip code instead of sub division  ## Commented above line on 30-mar-2010
                 //$nbhZipSQL .= " zip_code = '$zip_neighborhood[$value]' OR";
			}
            //add condition for subdivision search
			$nbhSQL = substr($nbhSQL,0,strlen($nbhSQL)-2);
			$sSQL .= " AND (".$nbhSQL.")";
			
			//add condition for zip codes search
			//$nbhZipSQL = substr($nbhZipSQL,0,strlen($nbhZipSQL)-2);
			//$sSQL .= " OR (".$nbhZipSQL.")";
		}
		
		//search by form=RES //HOME
		if(isset($this->form_home) && $this->form_home!="" && $this->form_condo=="" && $this->form_land=="")
		{
			$sSQL .= " AND form = '$this->form_home'";
		}
		//search by form=CND //CANDO
		if(isset($this->form_condo) && $this->form_condo!="" && $this->form_home=="" && $this->form_land=="")
		{
			$sSQL .= " AND form = '$this->form_condo'";
		}
		//search by form=LND //LAND
		if(isset($this->form_land) && $this->form_land!="" && $this->form_home=="" && $this->form_condo=="")
		{
			$sSQL .= " AND form = '$this->form_land'";
		}
		//search Home,Condo,Land
		if($this->form_home!="" && $this->form_condo!="" && $this->form_land!="")
		{
			$sSQL .= " AND (form = '$this->form_home' OR form = '$this->form_condo' OR form = '$this->form_land')";
		}
		//search Home,Condo
		if($this->form_home!="" && $this->form_condo!="" && $this->form_land=="")
		{
			$sSQL .= " AND (form = '$this->form_home' OR form = '$this->form_condo')";
		}
		//search Home,Land
		if($this->form_home!="" && $this->form_condo=="" && $this->form_land!="")
		{
			$sSQL .= " AND (form = '$this->form_home' OR form = '$this->form_land')";
		}
		//search Condo,Land
		if($this->form_home=="" && $this->form_condo!="" && $this->form_land!="")
		{
			$sSQL .= " AND (form = '$this->form_condo' OR form = '$this->form_land')";
		}
		//search by price //Max Price
		if(isset($this->max_price) && $this->max_price!="" && $this->min_price=="")
		{
			$sSQL .= " AND price <= '$this->max_price'";
		}
		//search by price //Min Price
		if(isset($this->min_price) && $this->min_price!="" && $this->max_price=="")
		{
			$sSQL .= " AND price >= '$this->min_price'";
		}
		//search by both Min and Max price
		if((isset($this->min_price) && $this->min_price!="") && (isset($this->max_price) && $this->max_price!=""))
		{
			$sSQL .=" AND (price BETWEEN ".$this->min_price." AND ".$this->max_price.")";
		}
		//search by  dom	//DOM
		if(isset($this->dom) && $this->dom!="")
		{
			//$sSQL .= " AND listing_date = '$this->dom'";
			$sSQL .= " AND dom <= '$this->dom'";
		}
				
		//search by Beds
		if(isset($this->beds))
		{
			$sSQL .= " AND bedrooms >= '$this->beds'";
		}
		//search by Baths
		if(isset($this->baths))
		{
			$sSQL .= " AND baths >= '$this->baths'";
		}
		
		//search by Sq Area //Max Sq Area
		if(isset($this->max_sq_area) && $this->max_sq_area!="" && $this->min_sq_area=="")
		{
			$sSQL .= " AND living_area <= '$this->max_sq_area'";
		}
		//search by Sq Area //Min Sq Area
		if(isset($this->min_sq_area) && $this->min_sq_area!="" && $this->max_sq_area=="")
		{
			$sSQL .= " AND living_area >= '$this->min_sq_area'";
		}
		//search by both Min and Max Sq Area
		if((isset($this->min_sq_area) && $this->min_sq_area!="") && (isset($this->max_sq_area) && $this->max_sq_area!=""))
		{
			$sSQL .=" AND (living_area BETWEEN ".$this->min_sq_area." AND ".$this->max_sq_area.")";
		}
		
		//search by Land Area //Max Land Area
		if(isset($this->max_land_area) && $this->max_land_area!="" && $this->min_land_area=="")
		{
			$sSQL .= " AND land_area <= '$this->max_land_area'";
		}
		//search by Land Area //Min Land Area
		if(isset($this->min_land_area) && $this->min_land_area!="" && $this->max_land_area=="")
		{
			$sSQL .= " AND land_area >= '$this->min_land_area'";
		}
		//search by both Min and Max Land Area
		if((isset($this->min_land_area) && $this->min_land_area!="") && (isset($this->max_land_area) && $this->max_land_area!=""))
		{
			$sSQL .=" AND (land_area BETWEEN ".$this->min_land_area." AND ".$this->max_land_area.")";
		}
		
		//search by Yr Built //Max Yr Built
		if(isset($this->max_yr_built) && $this->max_yr_built!="" && $this->min_yr_built=="")
		{
			$sSQL .= " AND year_built <= '$this->max_yr_built'";
		}
		//search by Yr Built //Min Yr Built
		if(isset($this->min_yr_built) && $this->min_yr_built!="" && $this->max_yr_built=="")
		{
			$sSQL .= " AND year_built >= '$this->min_yr_built'";
		}
		//search by both Min and Max Yr Built
		if((isset($this->min_yr_built) && $this->min_yr_built!="") && (isset($this->max_yr_built) && $this->max_yr_built!=""))
		{
			$sSQL .=" AND (year_built BETWEEN ".$this->min_yr_built." AND ".$this->max_yr_built.")";
		}
		
		//search by Maintinance Fees //Max Maintinance Fees
		if(isset($this->max_mn_fees) && $this->max_mn_fees!="" && $this->min_mn_fees=="")
		{
			$sSQL .= " AND condo_maint <= '$this->max_mn_fees'";
		}
		//search by Maintinance Fees //Min Maintinance Fees
		if(isset($this->min_mn_fees) && $this->min_mn_fees!="" && $this->max_mn_fees=="")
		{
			$sSQL .= " AND condo_maint >= '$this->min_mn_fees'";
		}
		//search by both Min and Max Maintinance Fees
		if((isset($this->min_mn_fees) && $this->min_mn_fees!="") && (isset($this->max_mn_fees) && $this->max_mn_fees!=""))
		{
			$sSQL .=" AND (condo_maint BETWEEN ".$this->min_mn_fees." AND ".$this->max_mn_fees.")";
		}
		
		
		//Search by Ocean View
		if( (isset($this->view_o) && $this->view_o=="O") && $this->view_m=="" ) 
		{
			//$sSQL .= " AND view_ = 'O' ";
			$sSQL .= " AND (view_ = 'O' OR view_='O,M' OR view_='M,O')";
		}
		//Search by Mountain View
		if( (isset($this->view_m) && $this->view_m=="M") && $this->view_o=="" )
		{
			//$sSQL .= " AND view_ = 'M' ";
			$sSQL .= " AND (view_ = 'M' OR view_='O,M' OR view_='M,O')";
		}
		//search by both ocean and mountain view
		if( isset($this->view_m) && isset($this->view_o) )
		{
			$sSQL .= " AND (view_ ='M,O' OR view_='O,M' OR view_ = 'M' OR view_ = 'O')";
		}
		
		//search by property listing_status-> A
		if(isset($this->property_A_status) && $this->property_C_status=="")
		{
			$sSQL .= " AND listing_status = '$this->property_A_status'";
		}
		//search by property listing_status-> C
		else if(isset($this->property_C_status) && $this->property_A_status=="")
		{
			$sSQL .= " AND listing_status = '$this->property_C_status'";
		}
        //both listing status
		else
		{
			$sSQL .= " AND (listing_status = 'A' OR listing_status = 'C')";
		}
		
		//search by Free Sample Tenure
		if(isset($this->feeSimple) && $this->leasehold=="")
		{
			$sSQL .= " AND land_tenure = 'FS'";
		}
		//search by Free Sample Tenure
		else if(isset($this->leasehold) && $this->feeSimple=="")
		{
			$sSQL .= " AND land_tenure = 'LH'";
		}
		//both
		else
		{
			$sSQL .= " AND (land_tenure = 'FS' OR land_tenure = 'LH')";
		}
		
		//search by keyword
		if(isset($this->keyword) && $this->keyword!="")
		{
            $keyword = addslashes($this->keyword);
            //$sSQL .= " AND MATCH (district, abbrev_address, street, subdivision_abbrev, zip_code) AGAINST ('$this->keyword')";
			$sSQL .= " AND (street LIKE '%$keyword%'";
			$sSQL .= " OR abbrev_address LIKE '%$keyword%'";
			$sSQL .= " OR district LIKE '%$keyword%'";
			$sSQL .= " OR zip_code LIKE '%$keyword%'";
			$sSQL .= " OR remarks LIKE '%$keyword%'";
			$sSQL .= " OR inclusions LIKE '%$keyword%'";
			$sSQL .= " OR subdivision_abbrev LIKE '%$keyword%')";
			
		}
		
		//search forclosure property i.e. restrictions like REO
		if(isset($this->restrictions) && $this->restrictions!="")
		{
			$sSQL .= " AND restrictions LIKE '%REO%'";
		}
		
		//search by oceanfront_parcel filed
		//his will determine whether a certain property is built right on the ocean without another property
		//being infront or inbetween the ocean and the subject property
		if(isset($this->oceanfront_parcel) && $this->oceanfront_parcel!="")
		{
			$sSQL .= " AND oceanfront_parcel ='Y'";
		}
		
		//search by property mls_no
		if(isset($this->mls_no))
		{
			//$sSQL .= " AND mls_no = '$this->mls_no'";
			//for more than one MLS no
			$mlsArr = split(',',$this->mls_no);
			$mlsSQL = "";
			for($i=0; $i<count($mlsArr); $i++)
			{
				$mls_no = trim($mlsArr[$i]);
				if(isset($mls_no) && $mls_no!="" && strlen($mls_no)==6)
				{
					$mlsSQL .= " mls_no=".trim($mlsArr[$i])." OR";
				}	
			}
			$mls_no_sql = substr($mlsSQL,0,strlen($mlsSQL)-2);
			$sSQL .= " AND (".$mls_no_sql.")";
		}
		
		//set order column
		if(isset($this->orderBy) && $this->orderBy!="")
		{
			$sSQL .= " ORDER BY $this->orderBy";
		}
		//set order 
		if(isset($this->order) && $this->order!="")
		{
			$sSQL .= " $this->order";
		}
		//set limt
		if(isset($this->pageLimit))
		{
			$sSQL .= " $this->pageLimit";
		}
		//echo $sSQL . ";<br><br><br>";
		$objRecordSet = $ObjClsDBInteraction -> select($sSQL);
		//$ObjClsDBInteraction->connection_close();
		return $objRecordSet;
	}//end of function
	
	
	// This function is used to get properties details
	function selectPropertyDetails()
	{
		$ObjClsDBInteraction = new class_dbconnector();

		$sSQL = "SELECT *, DATEDIFF(CURDATE(), listing_date) AS days_on_mkt FROM mls_feeds";
		$sSQL .=" WHERE id IS NOT NULL";
		//get particular property
		if(isset($this->id) && $this->id!="")
		{
			$sSQL .= " AND id = $this->id";
		}
		//search by msl_no
		if(isset($this->mls_no) && $this->mls_no!="")
		{
			$sSQL .= " AND mls_no = '$this->mls_no'";
		}
		//search by district
		if(isset($this->district) && $this->district!="")
		{
			$sSQL .= " AND district = '$this->district'";
		}
		//search by form(property type)
		if(isset($this->form) && $this->form!="")
		{
			$sSQL .= " AND form = '$this->form'";
		}
		//search by zip_code
		if(isset($this->zip_code) && $this->zip_code!="")
		{
			$sSQL .= " AND zip_code = '$this->zip_code'";
		}
		//search by bedrooms
		if(isset($this->bedrooms) && $this->bedrooms!="")
		{
			$sSQL .= " AND bedrooms = '$this->bedrooms'";
		}
		//search by bath
		if(isset($this->baths) && $this->baths!="")
		{
			$sSQL .= " AND baths = '$this->baths'";
		}
		//do not show current property
		if(isset($this->not_mls_no) && $this->not_mls_no!="")
		{
			$sSQL .= " AND mls_no != '$this->not_mls_no'";
		}
		$sSQL .= " ORDER BY price DESC";
		if(isset($this->property_limit))
		{
			$sSQL .= " LIMIT ".$this->property_limit;
		}
		else
		{
			$sSQL .= " LIMIT 1";
		}	
		//echo $sSQL . ";<br><br><br>";
		$objRecordSet = $ObjClsDBInteraction -> select($sSQL);
		$ObjClsDBInteraction->connection_close();
		return $objRecordSet;
	}//end of function
	
	// This function is used to get comparable properties against current viewing property
	function selectComparableProperty()
	{
		$ObjClsDBInteraction = new class_dbconnector();

		$sSQL  = "SELECT mls_no, form, listing_status, district, street, subdivision_abbrev, abbrev_address, price, land_area, living_area";
		$sSQL .= ", DATEDIFF(CURDATE(), listing_date) AS days_on_mkt, dom, bedrooms, baths, mapX, mapY FROM mls_feeds";
		$sSQL .= " WHERE id IS NOT NULL";
		$sSQL .= " AND (listing_status = 'A' OR listing_status = 'C')";
		//search by district
		if(isset($this->district) && $this->district!="")
		{
			$sSQL .= " AND district = '$this->district'";
		}
		
		//search by form(property type)
		if(isset($this->form) && $this->form!="")
		{
			$sSQL .= " AND form = '$this->form'";
		}
		
		//search by zip_code
		if(isset($this->zip_code) && $this->zip_code!="")
		{
			$sSQL .= " AND zip_code = '$this->zip_code'";
		}
		
		//search by MIN/MAX price
		if(isset($this->min_price) && isset($this->max_price))
		{
			$sSQL .= " AND (price BETWEEN ".$this->min_price." AND ".$this->max_price.")";
		}
		
		//search by bedrooms
		if(isset($this->min_bedrooms) && isset($this->max_bedrooms) && $this->min_bedrooms!="-1")
		{
			$sSQL .= " AND (bedrooms BETWEEN ".$this->min_bedrooms." AND ".$this->max_bedrooms.")";
		}
		
		//search by bath
		if(isset($this->min_baths) && isset($this->max_baths) && $this->min_baths!="-1")
		{
			$sSQL .= " AND (baths BETWEEN ".$this->min_baths." AND ".$this->max_baths.")";
		}
		
		//search by Living area
		if($this->min_living_area!=0 && $this->max_living_area!=0)
		{
			$sSQL .= " AND (living_area BETWEEN ".$this->min_living_area." AND ".$this->max_living_area.")";
		}
		
		//search by Land area
		if($this->min_land_area!=0 && $this->max_land_area!=0)
		{
			$sSQL .= " AND (land_area BETWEEN ".$this->min_land_area." AND ".$this->max_land_area.")";
		}
		
		//do not show current property
		if(isset($this->not_mls_no) && $this->not_mls_no!="")
		{
			$sSQL .= " AND mls_no != '$this->not_mls_no'";
		}
		$sSQL .= " ORDER BY price ASC";
		
		if(isset($this->property_limit))
		{
			$sSQL .= " LIMIT ".$this->property_limit;
		}
		else
		{
			$sSQL .= " LIMIT 6";
		}
			
		//echo $sSQL . ";<br><br><br>";
		$objRecordSet = $ObjClsDBInteraction -> select($sSQL);
		$ObjClsDBInteraction->connection_close();
		return $objRecordSet;
	}//end of function
	
	//function is used to insert users favorite properties
	function saveFavoriteProperty()
	{
		$ObjClsDBInteraction = new class_dbconnector();
		
		if(isset($this->user_id))
		$arr["user_id"]		= $this->user_id;
		
		if(isset($this->mls_no))
		$arr["mls_no"]      = $this->mls_no;
		
		$arr["created"] 	= date("Y-m-d H:i:s");
		
		$nReturnValue = $ObjClsDBInteraction->insertUpdate( "tbl_users_property", $arr, null);
		$ObjClsDBInteraction->connection_close();
		return $nReturnValue;
	}
	//check user account, whether property added to their account or not
	function existsInUserAccount()
	{
		$ObjClsDBInteraction = new class_dbconnector();

		if(isset($this->mls_no) && $this->mls_no!="")
		{
			$sSQL = "SELECT mls_no FROM tbl_users_property WHERE mls_no IS NOT NULL";
			$sSQL .= " AND user_id = '$this->user_id' ";
			$sSQL .= " AND mls_no = '$this->mls_no' ";
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
		}	
	}
	//delete user properties
	function deleteUserProperty()
	{
		$ObjClsDBInteraction = new class_dbconnector();

		if(isset($this->mls_no))
		{
			$sSQL ="DELETE FROM tbl_users_property WHERE mls_no='$this->mls_no' AND user_id = '$this->user_id' ";
			$objRecordSet = $ObjClsDBInteraction->select( $sSQL );
			$ObjClsDBInteraction->connection_close();
			return $nReturnValue;	 
		}
	}
	//select user favorite properties
	function selectUserProperty()
	{
		$ObjClsDBInteraction = new class_dbconnector();

		$sSQL  = "SELECT mf.*, DATEDIFF(CURDATE(), mf.listing_date) AS days_on_mkt ";
		$sSQL .= " FROM mls_feeds AS mf";
		$sSQL .= " JOIN tbl_users_property AS tup";
		$sSQL .= " WHERE mf.mls_no=tup.mls_no";
		$sSQL .= " AND user_id = $this->user_id";
		$sSQL .= " ORDER BY created DESC";
		//echo $sSQL . ";<br><br><br>";
		$objRecordSet = $ObjClsDBInteraction -> select($sSQL);
		$ObjClsDBInteraction->connection_close();
		return $objRecordSet;
	}
	
	//save user search
	function saveUserSearch()
	{
		$ObjClsDBInteraction = new class_dbconnector();
		
		if(isset($this->user_id))
		$arr["user_id"]			= $this->user_id;
		
		if(isset($this->search_name))
		$arr["search_name"]		= $this->search_name;
		
		$arr["email_alerts"]	= $this->email_alerts;
		
		if(isset($this->search_parameter))
		$arr["search_parameter"]	= $this->search_parameter;
		
		if(isset($this->search_id) && $this->search_id!="")
		{
			 $arr["modified"]	= date("Y-m-d H:i:s");
			 $sWhere			= " search_id = '$this->search_id'";
			 $nReturnValue		= $ObjClsDBInteraction->insertUpdate( "tbl_user_search", $arr, $sWhere);
		}
		else
		{
			$arr["created"]	= date("Y-m-d H:i:s");
			$nReturnValue	= $ObjClsDBInteraction->insertUpdate( "tbl_user_search", $arr, null);
		}
		//print_r($arr);
		$ObjClsDBInteraction->connection_close();
		return $nReturnValue;
	}
	
	//select user saved searches
	function selectUserSavedSearches()
	{
		$ObjClsDBInteraction = new class_dbconnector();

		$sSQL  = "SELECT tus.* ";
		$sSQL .= " FROM tbl_user_search AS tus WHERE search_id IS NOT NULL";
		//$sSQL .= " JOIN tbl_users_property AS tup";
		$sSQL .= " AND tus.user_id = $this->user_id";
		if(isset($this->search_id))
		{
			$sSQL .= " AND tus.search_id = $this->search_id";
		}
		$sSQL .= " ORDER BY tus.created DESC";
		//echo $sSQL . ";<br><br><br>";
		$objRecordSet = $ObjClsDBInteraction -> select($sSQL);
		$ObjClsDBInteraction->connection_close();
		return $objRecordSet;
	}
	//delete user saved searches
	function deleteUserSavedSearch()
	{
		$ObjClsDBInteraction = new class_dbconnector();

		if(isset($this->search_id))
		{
			$sSQL ="DELETE FROM tbl_user_search WHERE search_id='$this->search_id' AND user_id = '$this->user_id' ";
			$objRecordSet = $ObjClsDBInteraction->select( $sSQL );
			$ObjClsDBInteraction->connection_close();
			return $nReturnValue;	 
		}
	}
	
	//function is used to insert properties into gallery
	function saveGalleryProperty()
	{
		$ObjClsDBInteraction = new class_dbconnector();
		$disp_order = 0;
		$sSQL = "SELECT MAX(disp_order) AS disp_order FROM tbl_gallery_property LIMIT 1";
		$objRecordSet = $ObjClsDBInteraction->select($sSQL);
		$galleryArr = mysql_fetch_array($objRecordSet);
		if(isset($galleryArr['disp_order']) && $galleryArr['disp_order']!="")
		{
			$disp_order = $galleryArr['disp_order'] + 1;
		}
		
		if(isset($disp_order))
		$arr["disp_order"]		= $disp_order;
		
		if(isset($this->mls_no))
		$arr["mls_no"]      = $this->mls_no;
		
		$arr["created"] 	= date("Y-m-d H:i:s");
		
		$nReturnValue = $ObjClsDBInteraction->insertUpdate( "tbl_gallery_property", $arr, null);
		$ObjClsDBInteraction->connection_close();
		return $nReturnValue;
	}
	//function is used to update properties gallery sorting order
	function updateGalleryOrder()
	{
		$ObjClsDBInteraction = new class_dbconnector();
		
		if(isset($this->disp_order))
		$arr["disp_order"]		= $this->disp_order;
		
		if(isset($this->gallery_id) && $this->gallery_id!="")
		{
			 $arr["modified"]	= date("Y-m-d H:i:s");
			 $sWhere			= " gallery_id = '$this->gallery_id'";
			 $nReturnValue		= $ObjClsDBInteraction->insertUpdate( "tbl_gallery_property", $arr, $sWhere);
		}
		//$nReturnValue = $ObjClsDBInteraction->insertUpdate( "tbl_gallery_property", $arr, null);
		$ObjClsDBInteraction->connection_close();
		return $nReturnValue;
	}
	
	//check gallery , whether property already exists or not in gallery list
	function existsInGallery()
	{
		$ObjClsDBInteraction = new class_dbconnector();

		if(isset($this->mls_no) && $this->mls_no!="")
		{
			$sSQL = "SELECT mls_no FROM tbl_gallery_property WHERE gallery_id IS NOT NULL";
			$sSQL .= " AND mls_no = '$this->mls_no' ";
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
		}	
	}
	//delete properties from gallery
	function deleteGalleryProperty()
	{
		$ObjClsDBInteraction = new class_dbconnector();

		if(isset($this->gallery_id))
		{
			$sSQL ="DELETE FROM tbl_gallery_property WHERE gallery_id = '$this->gallery_id' ";
			$objRecordSet = $ObjClsDBInteraction->select( $sSQL );
			$ObjClsDBInteraction->connection_close();
			return $nReturnValue;	 
		}
	}
	//select gallery properties
	function selectGalleryProperty()
	{
		$ObjClsDBInteraction = new class_dbconnector();

		$sSQL  = "SELECT mf.*, DATEDIFF(CURDATE(), mf.listing_date) AS days_on_mkt, tgp.*";
		$sSQL .= " FROM mls_feeds AS mf";
		$sSQL .= " JOIN tbl_gallery_property AS tgp";
		$sSQL .= " WHERE mf.mls_no=tgp.mls_no";
		$sSQL .= " ORDER BY tgp.disp_order ASC";
		//set limt
		if(isset($this->pageLimit))
		{
			$sSQL .= " $this->pageLimit";
		}
		//echo $sSQL . ";<br><br><br>";
		$objRecordSet = $ObjClsDBInteraction -> select($sSQL);
		$ObjClsDBInteraction->connection_close();
		return $objRecordSet;
	}
	
	
	//function is used to get user saved searches
	function getUserSavedSearch()
	{
		$ObjClsDBInteraction = new class_dbconnector();

		$saved_search_sql  =" SELECT tus.search_name, tus.search_parameter, usr.FirstName, usr.LastName, usr.Email FROM tbl_user_search AS tus";
		$saved_search_sql .=" JOIN users AS usr ON (usr.id=tus.user_id)";
		$saved_search_sql .=" WHERE tus.search_id IS NOT NULL AND tus.email_alerts=1";
		$saved_search_sql .=" AND usr.Status=1 AND usr.isdeleted=0";
		//echo $sSQL . ";<br><br><br>";
		$objRecordSet = $ObjClsDBInteraction -> select($saved_search_sql);
		$ObjClsDBInteraction->connection_close();
		return $objRecordSet;
	}
}//end of class
?>
