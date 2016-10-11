<?php
$connect_error="Sorry,Something went wrong :-(";
	$db=new mysqli('localhost','root','','newsplate');

if($db->connect_error)
{
	die($connect_error);
}


//$link=mysqli_connect('localhost','root','','newsplate') or die($connect_error);// or die(mysql_error());
//mysqli_select_db($link,"newsplate");


?>