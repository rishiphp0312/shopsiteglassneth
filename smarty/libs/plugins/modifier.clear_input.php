<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty clear_input modifier plugin
 *
 * Type:     modifier<br>
 * Name:     clear_input<br>
 * Purpose:  convert special characters text in to original text
 * @link: 
 * @author: Mahipal Adhikari
 * @param: string
 * @return string
 */
function smarty_modifier_clear_input($strText)
{
	$text = html_entity_decode($strText);
	return $text;
}
?>