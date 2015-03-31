<?php
session_start(); 
ob_start();
   if(!isset($_SESSION['session_user_id']) || ($_SESSION['session_user_id'] == '')) {
   header("Location: login.php");
   exit;
 }
ini_set('display_errors','0');
include 'library/fiprotect.php';
include "library/class.search.php";
include 'include/mysql.php';
include 'include/global.php';
include 'library/category_header.php';
include 'library/mr.php';
include("header.php");
@include 'library/gd.php';
@include 'sendmail.php';





?>