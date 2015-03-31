<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty property_design modifier plugin
 *
 * Type:     modifier<br>
 * Name:     property_design<br>
 * Purpose:  convert property design to full text
 * @link: 
 * @author: Mahipal Adhikari
 * @param: string
 * @return string
 */
function smarty_modifier_property_design($strDesign="")
{
   //1Story,	2Story,	Double Wall, Hollow Tile, Single Wall, Split Level,	Wood Frame
	$design = str_replace('1S','1Story',$strDesign);
	$design = str_replace('2S','2Story',$design);
	$design = str_replace('DW','Double Wall',$design);
	$design = str_replace('SW','Single Wall',$design);
	$design = str_replace('HT','Hollow Tile',$design);
	$design = str_replace('SL','Split Level',$design);
	$design = str_replace('WF','Wood Frame',$design);
	$design = str_replace(',',', ',$design);
	return $design;
}
?>