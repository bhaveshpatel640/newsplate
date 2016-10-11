<?php
session_start();
//error_reporting(0);  //disable error display in webpage
require 'database/connect.php';
require 'function/general.php';
require 'function/user.php';
$path="uploads/";
$errors=array();
?>