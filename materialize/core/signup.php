<?php
require 'init.php';
include '../smtpmail/library.php'; // include the library file
include "../smtpmail/classes/class.phpmailer.php";
include "../smtpmail/classes/class.smtp.php";
// include the class name
$path=$_SESSION['path'];
if(empty(($_POST)===false))
{
	$first_name=$_POST['first_name'];
	$last_name=$_POST['last_name'];
	$password=$_POST['password'];
	$cpassword=$_POST['cpassword'];    //Confirm Password
	$email=$_POST['email'];
	$gender=$_POST['gender'];			//0:Male,1:Female
	$active=0;
	$preference=0;

	if($password!=$cpassword){
		header("Location: ../error.php?error=6");  // 6: Password incorrect
	}
	else{
		
		$flag=account_exists($email,$password,$db);
		if ($flag==1) {
			header("Location: ../error.php?error=7");	
		}
		else if ($flag==2) {
			header("Location: ../error.php?error=4");
		}
		else
		{
			$password=md5($password);
			if($result=$db->query("INSERT into userdetails(first_name,last_name,password,email,gender,active,preference_id) values('$first_name','$last_name','$password','$email','$gender','$active','$preference')"))
			{

                $_SESSION['email']=$email;
				$_SESSION['password']=$password;
		   	 	$_SESSION['user_name']=$first_name." ".$last_name;
		   	 	$_SESSION['first_name']=$first_name;
		   	 	$_SESSION['last_name']=$last_name;
		   	 	$user_id=getuserid($email,$password,$db);
		    	$_SESSION['user_id']=$user_id;
		    	
		    	$result=$db->query("INSERT into category (email) values ('$email')");
               //header("Location: ../profile.php");

	 $htmlcode=array(
    'welcome'=>'<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>News Plate</title>
    </head>

    <body bgcolor="#8d8e90" style="box-shadow: 7px 7px 7px -3px black; border:2;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
    <td width="61"></td>
    
    <td width="144" style="padding-top:25px"><a href="http://'.$path.'index.php" target="_blank">
    <h2 style="font-family:"Myriad Pro", Helvetica, Arial, sans-serif; color:#68696a;" >News Plate</h2></a>
    </td>
    
    <td width="393"><table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
    <td height="46" align="right" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
    <td width="20%" align="right"><font style="font-family:"Myriad Pro", Helvetica, Arial, sans-serif; color:#68696a; font-size:12px">
    <a href= "http://'.$path.'index.php" style="color:#68696a; text-decoration:none; text-transform:uppercase">
    <strong>HOME</strong></a></font></td>
    <td width="10%" align="right"><font style="font-family:"Myriad Pro", Helvetica, Arial, sans-serif; color:#68696a; font-size:12px">
    <a href= "http://'.$path.'contact.php" style="color:#68696a; text-decoration:none; text-transform:uppercase"><strong>Contact Us</strong></a></font></td>
    <td width="10%" align="right"><font style="font-family:"Myriad Pro", Helvetica, Arial, sans-serif; color:#68696a; font-size:12px">
    <a href= "http://'.$path.'about.php" style="color:#68696a; text-decoration:none; text-transform:uppercase"><strong>About Us</strong></a></font></td>
    <td width="4%">&nbsp;</td>
    </tr>
    </table></td>
    </tr>
    </table></td>
    </tr>
    </table>
    </td></tr>

    <tr> <td align="center"><BR><hr width=100%><BR></td>
    <td><hr width=100%/><BR></td></tr>
    <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
    <td width="10%">&nbsp;</td>
    <td width="80%" align="left" valign="top"><font style="font-family: Georgia,Times, serif; color:#010101; font-size:24px">
    <strong><em>Hi '.$first_name." ".$last_name.'</em></strong></font><br /><br />
    <font style="font-family: Verdana, Geneva, sans-serif; color:#666766; font-size:13px; line-height:21px">
    Welcome to Newsplate,feed yourself<br>
    You successfully created your account.('.$email.')<br>
    You can now get all latest news right here.<br>
    Set your preferences to get your personalize news.<br>
    <a href="http://'.$path.'login.php"><button style="background-color:#eeeeee;border:1px solid" >Login Here</button></a><BR><br>

    On behalf of the NewsPlate<br />
    Bhavesh Patel, Suyash Thakare, Piyush Saravagi</font></td>
    <td width="10%">&nbsp;</td>
    
    <tr><td>&nbsp;</td><td>&nbsp;</td></tr>
    </table>
    </td>
    </tr>


    <tr>
    <td><hr width=100%/><BR></td>
    <td><hr width=100%/><BR></td>

    </tr>
    
    <tr>
    <td align="center"><font style="font-family:"Myriad Pro", Helvetica, Arial, sans-serif; color:#231f20; font-size:12px">
    <strong>Newsplate  pvt Ltd &copy;,<BR> Sardar Patel Institute of Technology, Bharatiya Vidya Bhavans<BR>Munshi Nagar, Andheri (West), Mumbai , Maharashtra, 400 058 <BR>
     Tel: 123 456 789 | <span style="color:#010203; text-decoration:none">newsplate2015@gmail.com</strong></font></td>
    </tr>
    <tr>
    <td>&nbsp;</td>
    </tr>
    </table>
    </body></html>');

                    $mail	= new PHPMailer; // call the class 
                    $mail->IsSMTP(); 
                    $mail->Host = SMTP_HOST; //Hostname of the mail server
                    $mail->SMTPDebug = 1;
                    $mail->Port = SMTP_PORT; //Port of the SMTP like to be 25, 80, 465 or 587
                    $mail->SMTPSecure = 'ssl';
                    $mail->SMTPAuth = true; //Whether to use SMTP authentication
                    $mail->Username = SMTP_UNAME; //Username for SMTP authentication any valid email created in your domain
                    $mail->Password = SMTP_PWORD; //Password for SMTP authentication
                    $mail->AddReplyTo("newsplate2015@gmail.com", "News PLate"); //reply-to address
                    $mail->SetFrom("newsplate2015@gmail.com","News PLate"); //From address of the mail
                    // put your while loop here like below,
                    $mail->Subject = "Sign Up successfully"; //Subject od your mail
                    $mail->AddAddress($email, getusername($email,$password,$db)); //To address who will receive this email
                    $mail->MsgHTML($htmlcode['welcome']);
                    $send = $mail->Send(); //Send the mails
                    if($send){
                      echo '<center><h3 style="color:#009933;">Mail sent successfully</h3></center>';
                      header("Location: ../profile.php");
                    }
                    else{
                      $errors='Mail error:'.$mail->ErrorInfo;
                      header("Location: ../error.php?error_log=".$errors);
                    }
			
	     	}
			
		}
}
	
}
?>				