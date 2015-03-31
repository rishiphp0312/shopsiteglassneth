<?php
/**
 * This file is used to get common AJAX results
 */

include ('include/common.inc');


//get district neigbourhood
if ($_POST['action'] == 'getNeighbourhood')
{
	//selects regions to make region drop down
	$distt_id = $_POST['distt_id'];
	if($distt_id=="" || $distt_id=="-1")
	{
		$distt_neighborhood_arr = $distt_neighborhood_arr[-1];
	}
	else
	{
		$distt_neighborhood_arr = $distt_neighborhood_arr[$distt_id];
	}
	foreach($distt_neighborhood_arr as $key)
	{
		if ($data == "")
		{
			$data .="\"".$key."#".$key."\"";
		}
		else
		{
			$data .=", \"".$key."#".$key."\"";
		}
	}
	
	//Here we create Array of items to be used in JavaScript
	$response = " new Array($data);";
	header("content-type:text/plain");
	print $response;
	exit(0);
}
?>