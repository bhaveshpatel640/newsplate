<?php
function getprofileimage($email,$db){
	if($result=$db->query("SELECT * From userdetails WHERE email='$email'")){
		
		if($result->num_rows) {			
				$row=$result->fetch_assoc();
				return $row['profile'];
		}
	}
}
function ispreferenceset($email,$db){
if($result=$db->query("SELECT * From category WHERE email='$email'")){
		$row=$result->fetch_assoc();
	 foreach ($row as $key => $value) {
	 				if($value=="1"){
	 					return true;
	 				}
	 			}		
		}
return false;
}
function changepassword($email,$newpassword,$db){
		$newpassword=md5($newpassword);
	if($result=$db->query("UPDATE userdetails SET password='$newpassword' WHERE email='$email'"))
		return true;
	else
		return false;	
}

function createpassword($email,$db){
	$temp=md5($email.date("h:i:sa"));
	$temp=substr($temp,0,8);
	$newpassword=md5($temp);
	if($result=$db->query("UPDATE userdetails SET password='$newpassword' WHERE email='$email'"))
		return $temp;
	else
		return "newsplate";	
}
function account_exists($email_id,$password,$db) {
	$flag=0;
	$password=md5($password);
	if($result=$db->query("SELECT * From userdetails WHERE email='$email_id'")){
		
		if($result->num_rows) {			 //Return Description:0=Email Id Does not Exists,1=Password Incorrect,2=Already Registered
				$row=$result->fetch_assoc();
				if($row['password']==$password)
					return 2;
				else
					return 1;
		}
		else
	 		return 0;
		}
	}

function logged_in()
{
	return(isset($_SESSION['email']))?true:false;
}
 
function getusername($email,$password,$db){
	$password=md5($password);
	if($result=$db->query("SELECT * From userdetails WHERE email='$email'AND password='$password'")){
		
		if($result->num_rows) {			
				$row=$result->fetch_assoc();
				if($row['password']==$password)
					$name=$row['first_name']." ".$row['last_name'];
				else
					$name="user";
		}
	return $name;
}
}

function updateset($email,$db){
	if($result=$db->query("SELECT * From userdetails WHERE email='$email'")){
		if($result->num_rows) {			
				$row=$result->fetch_assoc();
					if($row['emailnews']=='1'){
						return true;
					}
					else
						return false;
		}
	}
	return false;
}
function getusernamefromemail($email,$db){
if($result=$db->query("SELECT * From userdetails WHERE email='$email'")){
		if($result->num_rows) {			
				$row=$result->fetch_assoc();
					$name=$row['first_name']." ".$row['last_name'];
		}
	return $name;	
}
}
function getusernamefromid($id,$db){

	if($result=$db->query("SELECT * From userdetails WHERE user_id='$id'")){
		$name="Anonymous";
		if($result->num_rows){
				$row=$result->fetch_assoc();
					$name = $row['first_name']." ".$row['last_name'];
		}
	return $name;
	}
}


function getuserid($email,$password,$db){
	$password=md5($password);
	if($result=$db->query("SELECT * From userdetails WHERE email='$email'AND password='$password'")){
		
		if($result->num_rows) {			
				$row=$result->fetch_assoc();
				$id=$row['user_id'];
		}
	return $id;
}


}

?>