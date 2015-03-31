<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty convert_number modifier plugin
 *
 * Type:     modifier<br>
 * Name:     money_format<br>
 * Purpose:  This function will convert 1000 to 1K or 2000 to 2k and so on
 * @link: 
 * @author: Mahipal Adhikari
 * @param: float
 * @return string
 */
function smarty_modifier_convert_number($x)
{
	if(is_numeric($x))
	{
        /*
        if($x < 1000)
		{
		  //return $x;  //return number if less than 1000
		  $x = $x;
		}
		else if($x >1000 & $x<1000000)
		{
			$x = preg_replace("/[^0-9]/","",$x);
			$dec_place=2;
			if($x%1000==0)
			{
				$dec_place=0;
			}
			$x = $x / 1000;
			
			$x = number_format($x,$dec_place,'.',',') . 'K';
		}
		else if ($x >1000000 & $x<100000000)
		{
			$x = preg_replace("/[^0-9]/","",$x);
			$dec_place=2;
			if($x%1000000==0)
			{
				$dec_place=0;
			}
			$x = $x / 1000000;
			$x = number_format($x,$dec_place,'.',',') . 'M';
		}
		else
		{
			$x = preg_replace("/[^0-9]/","",$x);
			$dec_place=2;
			if($x%100000000==0)
			{
				$dec_place=0;
			}
			$x = $x / 100000000;
			$x = number_format($x,$dec_place,'.',',') . 'B';

		}
        */
        $x = number_format($x,2,'.',',');
	}
	else
	{
		$x = $x .'is not a number';
  	}
  	return $x;
}
?>
