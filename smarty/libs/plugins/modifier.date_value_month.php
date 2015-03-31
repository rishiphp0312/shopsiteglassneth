<?php
function smarty_modifier_date_value_month($length)
{
	 //$length=$length-1;
    //return date('M',$length);
	 return date('M',mktime(0,0,0,$length,0,0)) ;
}
?>
