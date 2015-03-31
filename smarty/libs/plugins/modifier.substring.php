<?php
function smarty_modifier_substring($string, $position, $length)
{
    return substr($string, $position-1, $length);
}
?>
