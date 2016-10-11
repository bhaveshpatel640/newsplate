<?php
include 'init.php';

if(empty($_GET)===false) {
$id=$_GET['id'];

date_default_timezone_set('Asia/Calcutta');
		
			if($result=$db->query('SELECT * FROM categorylist WHERE category_id='.$id)) {
				$row=$result->fetch_assoc();
				print_r($row);
				store_news($db,$row['categoryLink'],$row['category']);
				$link=$row['categoryLink'];
				$d=strtotime("now");
				$date=date("Y-m-d h:i:s", $d);
				echo $date;
				if($result1=$db->query("UPDATE categorylist SET date='$date' WHERE category_id='$id'")){
                header("Location: ../admin.php");   
              }
		}

}		
else{
	header("Location: ../admin.php");
}

?>