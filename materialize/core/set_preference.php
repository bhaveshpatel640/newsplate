<?php
require 'init.php';
if(logged_in()) {
    $email=$_SESSION['email'];
}
else
    header('Location: ../index.php?login=2');

$string="";

if(isset($_POST['save'])) {  //to run PHP script on submit

	if(!empty($_POST['category'])) {
		foreach($_POST['category'] as $selected) {
			$string=$string.$selected."='1',";
		}
	}

		if($_POST['emailnews']==emailnews) {
			$update='1';
		}
		else
			$update='0';
		
	
		$string=substr($string, 0, -1);
		$str="";

		$result=$db->query("SELECT * From categorylist");
        
        while($row=$result->fetch_assoc()) {
        	if ($row['category']!="email") {
	        	$str.=$row['category']."='0',";
        	}
        }
		$str=substr($str, 0, -1);
	//	echo "$string <br>";
	//	echo $str;
		 $result=$db->query("UPDATE category SET $str WHERE email='$email'");
		 $query="UPDATE category SET $string WHERE email='$email'";
		 $result=$db->query($query);
	     header('Location: ../profile.php');

	}
?>