<?php
	/*
	    **************************** Creation Log *******************************
	    File Name                   -  constant.inc
	    Module Name                 -  class
	    Project Name                -  
	    Description                 -  
	    Version                     -  
	    Created by                  -  Rishi Kapoor
	    Created on                  -  12-Nov-09
		******************************** Update Log *************************************************************
		SNo		Version		Updated by			Updated on			Description
		******************************************
	*/
if($_SERVER['HTTP_HOST']=='localhost'){
	$DB_SERVER     	= "localhost"; 			// Database Server machine
	$DB_LOGIN      	= "root";        		// Database login
	$DB_PASSWORD   	= ""; 					// Database password
	$DB_COMMON 	= "nethaat";		// Database name
}
else{
	$DB_SERVER     	= "173.201.185.233"; 			// Database Server machine
	$DB_LOGIN      	= "adminnhdb";        		// Database login
	$DB_PASSWORD   	= "nhZAQ123"; 					// Database password
	//$DB_COMMON 	= "nethaat";		// Database name
       $DB_COMMON 	= "nhdb";		// Database name
}
?>