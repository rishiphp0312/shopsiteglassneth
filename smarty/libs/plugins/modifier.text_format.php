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
function smarty_modifier_text_format($x)
{
	$x= ucfirst(nl2br(stripslashes($x)));
  	return $x;
}
?>
