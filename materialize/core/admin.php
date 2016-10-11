<?php
require 'init.php';
date_default_timezone_set('Asia/Calcutta');

if ($email=='username@gmail.com'&&$password=='password') {
}else {
	header("Location: login.php");
}

if(empty(($_POST)===false))
{
	$rsscategory=$_POST['rsscategory'];
	$rsslink=$_POST['rsslink'];
	if(!isRssLinkExist($db,$rsslink)){
		$d=strtotime("now");
		$date=date("Y-m-d h:i:s", $d);
	if($result=$db->query("INSERT into categorylist (category,categoryLink,date) values('$rsscategory','$rsslink','$date')")){

			if($result=$db->query("ALTER TABLE `category` ADD `$rsscategory` INT DEFAULT 0")){	
				//echo 'Added Successfully';
			}
		}
	}
}
?>
