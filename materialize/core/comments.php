<?php
require 'init.php';
if(logged_in()){
	 if(empty($_POST)===false){
	 	$news_id=$_POST['news_id'];
		$comment=$_POST['comments'];	 	
		$user_id=$_SESSION['user_id'];
	 	$d=strtotime("today");
        $date_time=date("h:i:sa Y-m-d", $d);

      if($result=$db->query("INSERT INTO comments(news_id,text,user_id) VALUES ('$news_id','$comment','$user_id')"))
    {
      header("Location: ../newspage.php?id=".$news_id);
    }
  }
}
else{
  header("Location: ../login.php?login=4");
}
?>