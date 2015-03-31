<?php
/*
	    **************************** Creation Log *******************************
	    File Name                   -  dbconnector.inc
	    Module Name                 -  Connection File
	    Project Name                -  Local Buzz
	    Description                 -  Connection File
	    Version                     -  
	    Created by                  - 	Mahipal Adhikari 
	    Created on                  -   03-June-2009
		******************************** Update Log *************************************************************
		SNo		Version		Updated by			Updated on			Description
		*********************************************************************************************************
*/
include "constant.inc";

class ClsDBReturn
{
	var $nErrorCode;
	var $nIdentity;
	var $nAffectedRows;
}

class class_dbconnector
{
	var $con;

           function class_dbconnector()
           {
		global $DB_SERVER, $DB_LOGIN, $DB_PASSWORD, $DB_COMMON;
		$this->con=mysql_connect($DB_SERVER,$DB_LOGIN,$DB_PASSWORD)
		 or die("Error in Connection--> Could not Connect to Database".mysql_error());
		 if( $this->con )
		 {
			 $selected= mysql_select_db($DB_COMMON,$this->con);
		 }
		 else
		 { 	 
			echo("Could not select Database");
		 }
           }
	  function select($sSQL)
         {
        //print $sSQL;
     	return mysql_query($sSQL,$this->con);
	 }
	 
     /*--------------------------- Function To Insert/Update Data into Database  ------------------------*/
     
     function insertUpdate( $sTableName, $arrFieldValues, $sWhere )
     {
         $sSQL;

         if( $sWhere == null )
         {
             $sSQL = "INSERT INTO " . $sTableName . "(";
         }
         else
         {
             $sSQL = "UPDATE " . $sTableName . " SET";
         }

         $nFieldCount = count($arrFieldValues);
         reset( $arrFieldValues );
         $i = 1;

         while(list($key, $value) = each($arrFieldValues))
         {
             if($i != $nFieldCount)
             {
                 if($sWhere == null)
                 {
                     $sSQL .= " " . $key . ",";
                 }
                 else
                 { // Update
                     $sSQL .= " " . $key . "='" . $value . "', ";
                 }
             }
             else
             {
                 if( $sWhere == null )
                 {
                     $sSQL .= " " . $key . ")" . "  VALUES( '";
                 }
                 else
                 { // Update
                     $sSQL .= " " . $key . "='" . $value . "'";
                 }
             }
             $i++;
         }

         if( $sWhere == null )
         {
             reset( $arrFieldValues );
             $i = 1;
             while( list($key, $value) = each($arrFieldValues) )
             {
                 $sSQL .= $value;
                 if( $i != $nFieldCount )
                 {
                     $sSQL .= "', '";
                 }
                 else
                 {
                     $sSQL .= "');";
                 }
                 $i++;
             }
         }
         else
         {
              $sSQL .= " WHERE " . $sWhere;
         }

// echo $sSQL."<br><br>";	//for printing the query
//mail()
//exit;
	$result = mysql_query($sSQL,$this->con);
		//echo "<br>".mysql_error();
		//print $sSQL."<br><br>";die;	//for printing the query
         $objDBReturn = new ClsDBReturn();
         $objDBReturn->nErrorCode    = mysql_errno();
         $objDBReturn->nIdentity     = mysql_insert_id();
	 $objDBReturn->nAffectedRows = mysql_affected_rows();
	 return $objDBReturn;
     }

	function connection_close()
	 {
         if( $this->con)
         {
             mysql_close( $this->con);
         }
         else
         {
           //  echo("Cannot close non-existent connection");
             //Define and set err object.
         }
	 }   
}	 
?>