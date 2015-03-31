<?php
$backupFile= 'backupfile.sql.gz';
$dbname='nhdb';
$backupFile = $dbname.date("Y-m-d-H-i-s").'.gz';
$command = "mysqldump --opt --host=173.201.185.233 --user=adminnhdb --password=nhZAQ123 nhdb | gzip > $backupFile"; 
system($command);
header("Content-type: application/force-download");
header('Content-Disposition: inline; filename="' .$backupFile . '"');
header("Content-Transfer-Encoding: Binary");
header("Content-length: ".filesize($backupFile));
header('Content-Type: application/zip');
header('Content-Disposition: attachment; filename="' . $backupFile . '"');
readfile("$backupFile"); 
unlink($backupFile);
exit;
 
?>
?>