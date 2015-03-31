<?php
echo $date1 = date('Y-m-d');
echo $date2 = '2011-01-02';
$no= 60*60*24;
$d1 = strtotime($date1);
$d2 = strtotime($date2);
echo '<br>';
echo ceil('5.788');
echo '<br>';

echo ($d1-$d2)/$no;
//echo 'Number of days since 2005-03-01'.$days;
?>