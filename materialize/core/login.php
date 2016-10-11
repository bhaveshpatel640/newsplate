<?php
require 'init.php';
if(logged_in()){
	header("Location: ../index.php");
}
if(empty($_POST)===false) {
	$email=$_POST['email'];
	$password=$_POST['password'];

			$flag=account_exists($email,$password,$db);
			if(empty($email)===true||empty($password)===true){
			header("Location: ../error.php?error=1");  // 1: Invalid Email or Password
			}
			else if ($flag==0) {
				header("Location: ../error.php?error=2");  // 2: Email does not exists
			}
			else if ($flag==1) {
				header("Location: ../error.php?error=3");  //3 : Invalid Password
			}else if ($flag==2) {
		        
		        $_SESSION['email']=$email;
				$_SESSION['password']=$password;
				$_SESSION['user_name']=getusername($email,$password,$db);
				$_SESSION['user_id']=getuserid($email,$password,$db);

				$_SESSION['profile']=getprofileimage($email,$db);
				$pos=strrpos($_SESSION['user_name']," ");
				$_SESSION['first_name']=substr($_SESSION['user_name'],0,$pos);
				$_SESSION['last_name']=substr($_SESSION['user_name'],$pos+1,strlen($_SESSION['user_name'])-$pos-1);

				if(empty($_SESSION['currentpage'])===false){
					header("Location: ".$_SESSION['currentpage']);
				}
				else
					header("Location: ../index.php");
				exit();
				}
}
		?>