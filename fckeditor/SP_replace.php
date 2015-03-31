<?php
function replace_sp($tmp)
{
        $replace_string=trim($tmp);
        $replace_string=stripslashes($replace_string);
        foreach (count_chars($replace_string, 1) as $i => $val)
        {
                if(!((chr($i)>='a' && chr($i)<='z') || (chr($i)>='A' && chr($i)<='Z') || (chr($i)>='0' && chr(
$i)<='9') || chr($i)=='_' || chr($i)==' '))
                {
                        $replace_string=str_replace(chr($i),'',$replace_string);

                }
        }

        $replace_string=str_replace(' ','_',$replace_string);
        return $replace_string;

}

function replace_fck($tmp)
{
        $replace_string=trim($tmp);
        $replace_string=stripslashes($replace_string);
        foreach (count_chars($replace_string, 1) as $i => $val)
        {
                if(ord(chr($i))=='32' || ord(chr($i))=='38' || ord(chr($i))=='47' || ord(chr($i))=='59' || ord(chr($i))=='60' || ord(chr($i))=='62' || ord(chr($i))=='98' ||ord(chr($i))=='110' || ord(chr($i))=='112' || ord(chr($i))=='115' )
                {
                        $replace_string=str_replace(chr($i),'',$replace_string);//ord(chr($i))
//$replace_string1=$replace_string1.ord(chr($i)).",";
                }
		else{
		$replace_string1=$replace_string1.ord(chr($i)).",";
		}
        }

        return $replace_string;

}

?>
