<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty property_view modifier plugin
 *
 * Type:     modifier<br>
 * Name:     property_view<br>
 * Purpose:  convert property views to full text
 * @link: 
 * @author: Mahipal Adhikari
 * @param: string
 * @return string
 */
function smarty_modifier_property_view($strView="")
{
   //Mountain,	Ocean
	$view = str_replace('M','Mountain',$strView);
	$view = str_replace('O','Ocean',$view);
	$view = str_replace(',',' and ',$view);
	return $view;
}
?>