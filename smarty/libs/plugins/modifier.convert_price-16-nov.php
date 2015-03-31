<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty convert_price modifier plugin
 *
 * Type:     modifier<br>
 * Name:     convert_price<br>
 * Purpose:  convert price into user country price
 * @link: 
 * @author: Mahipal Adhikari
 * @param: float
 * @return float
 */
function smarty_modifier_convert_price($price)
{
	if(is_numeric($price))
	{
		$currency_code = $_SESSION['nethaat_user_session']['currency_code'];
		$currency_rate = $_SESSION['nethaat_user_session']['currency_rate'];
		$new_price = $price * $currency_rate;
		$new_price = number_format($new_price, 2, '.', ',');
		return $currency_code." ".$new_price;
	}
	else
	{
		$price = $price .'is not a price';
		return $price;
	}
}
?>