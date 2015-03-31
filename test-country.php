<?php
include('class/ipinfodb.class.php');

//Load the class
$ipinfodb = new ipinfodb;
$ipinfodb->setKey('936462656b47c77cd8ffe6c5e232d4d4757957ab25631592578ace0eae293ea6');

//Get errors and locations
$locations = $ipinfodb->getGeoLocation($_SERVER['REMOTE_ADDR']);
$errors = $ipinfodb->getErrors();
print_r($locations);
//Getting the result
echo "<p>\n";
echo "<strong>First result</strong><br />\n";
if (!empty($locations) && is_array($locations)) {
  foreach ($locations as $field => $val) {
    echo $field . ' : ' . $val . "<br />\n";
  }
}
echo "</p>\n";

//Show errors
echo "<p>\n";

echo "</p>\n";
