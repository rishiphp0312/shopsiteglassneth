<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty convert_land modifier plugin
 *
 * Type:     modifier<br>
 * Name:     convert_land<br>
 * Purpose:  convert Land sqft if it is over an acre refer to acres
 * @link: 
 * @author: Mahipal Adhikari
 * @param: float
 * @return string
 */
function smarty_modifier_convert_land($land_area)
{
	if(is_numeric($land_area))
	{
		if($land_area < 43560)
		{
		  return number_format($land_area,'0','',',').' sq.ft.';  //return number if less than 43560
		}
		else
		{
			$land_area = preg_replace("/[^0-9]/","",$land_area);
			$land_area = ($land_area / 43560).' ac';
			$land_area = number_format($land_area,2,'.',',') .' ac'; 
			return $land_area;
		}	
	}
	else
	{
		$land_area = $land_area .'is not a number';
		return $land_area;
	}
}
?>