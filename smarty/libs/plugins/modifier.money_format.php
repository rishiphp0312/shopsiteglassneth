<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty money_format modifier plugin
 *
 * Type:     modifier<br>
 * Name:     money_format<br>
 * Purpose:  format strings via number_format
 * @link: 
 * @author: Mahipal Adhikari
 * @param: float
 * @return string
 */
function smarty_modifier_money_format($money="")
{
    $money = number_format($money,0,'',',');
	return $money;
}
?>