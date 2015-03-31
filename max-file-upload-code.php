<?php
$POST_MAX_SIZE = ini_get('post_max_size');
$mul = substr($POST_MAX_SIZE, -1);
$mul = ($mul == 'M' ? 1048576 : ($mul == 'K' ? 1024 : ($mul == 'G' ? 1073741824 : 1)));
if ($_SERVER['CONTENT_LENGTH'] > $mul*(int)$POST_MAX_SIZE && $POST_MAX_SIZE) $error = true;
?>