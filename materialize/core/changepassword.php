<?php
require 'init.php';
include '../smtpmail/library.php'; // include the library file
include "../smtpmail/classes/class.phpmailer.php";
include "../smtpmail/classes/class.smtp.php";
if(empty(($_POST)===false)) {
	$email=$_POST['email'];
	$oldpassword=$_POST['oldpassword'];
	$newpassword=$_POST['newpassword'];
	$newrepeatpassword=$_POST['newrepeatpassword'];

	$flag=account_exists($email,$oldpassword,$db);

	if ($flag==2) {
		if ($newpassword==$newrepeatpassword) {
			changepassword($email,$newpassword,$db);

	$htmlcode=array(
    'changepassword'=>'<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>News Plate</title>
    </head>

    <body bgcolor="#8d8e90" style="box-shadow: 7px 7px 7px -3px black; border:2">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
    <td width="61"></td>
    
    <td width="144" style="padding-top:25px"><a href="'.$path.'index.php" target="_blank">
    <span style="font-family:"Myriad Pro", Helvetica, Arial, sans-serif; color:#68696a; font-size:25px" width="144" height="76" border="0" >News Plate</span></a>
    </td>
    
    <td width="393"><table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
    <td height="46" align="right" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
    <td width="20%" align="right"><font style="font-family:"Myriad Pro", Helvetica, Arial, sans-serif; color:#68696a; font-size:12px"><a href= "'.$path.'index.php" style="color:#68696a; text-decoration:none; text-transform:uppercase">
    <strong>HOME</strong></a></font></td>
    <td width="10%" align="right"><font style="font-family:"Myriad Pro", Helvetica, Arial, sans-serif; color:#68696a; font-size:12px"><a href= "'.$path.'contact.php" style="color:#68696a; text-decoration:none; text-transform:uppercase"><strong>Contact Us</strong></a></font></td>
    <td width="10%" align="right"><font style="font-family:"Myriad Pro", Helvetica, Arial, sans-serif; color:#68696a; font-size:12px"><a href= "'.$path.'about.php" style="color:#68696a; text-decoration:none; text-transform:uppercase"><strong>About Us</strong></a></font></td>
    <td width="4%">&nbsp;</td>
    </tr>
    </table></td>
    </tr>
    </table></td>
    </tr>
    </table>

    </td></tr>

    <tr> <td align="center"><BR><hr width=80%><BR></td></tr>
    
    <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
    <td width="10%">&nbsp;</td>
    <td width="80%" align="left" valign="top"><font style="font-family: Georgia,Times, serif; color:#010101; font-size:24px"><strong><em>Hi '.getusernamefromemail($email,$db).'</em></strong></font><br /><br />
    <font style="font-family: Verdana, Geneva, sans-serif; color:#666766; font-size:13px; line-height:21px">
    You successfully changed your password for your Newsplate account. <br>Click the button below to login.
    <br><br><a href="http://localhost/WT%20project%20new/materialize/login.php"><button style="background-color:#eeeeee;border:1px solid">Login</button></a><BR><br>

    Note: If the changes was not been made by you, then please reset your password OR 
    Reach out to us immediately at <a href="mailto:newsplate2015@gmail.com" target="_top">newsplate2015@gmail.com</a>
    <br /><br />
    On behalf of the NewsPlate<br />
    Bhavesh Patel, Suyash Thakare, Piyush Saravagi</font></td>
    <td width="10%">&nbsp;</td>
    <tr><td>&nbsp;</td><td>&nbsp;</td></tr>
    </table>
    </td>
    </tr>
    <tr>
    <td><hr width=80%/><BR></td>
    </tr>
    
    <tr>
    <td align="center"><font style="font-family:"Myriad Pro", Helvetica, Arial, sans-serif; color:#231f20; font-size:12px">
    <strong>Newsplate  pvt Ltd &copy;,<BR> Sardar Patel Institute of Technology, Bharatiya Vidya Bhavans<BR>Munshi Nagar, Andheri (West), Mumbai , Maharashtra, 400 058 <BR> Tel: 123 456 789 | <span style="color:#010203; text-decoration:none">newsplate2015@gmail.com</strong></font></td>
    </tr>
    <tr>
    <td>&nbsp;</td>
    </tr>
    </table>
    </body></html>');

		  			$mail = new PHPMailer; // call the class 
                    $mail->IsSMTP(); 
                    $mail->Host = SMTP_HOST; //Hostname of the mail server
                    $mail->SMTPDebug = 1;
                    $mail->Port = SMTP_PORT; //Port of the SMTP like to be 25, 80, 465 or 587
                    $mail->SMTPSecure = 'ssl';
                    $mail->SMTPAuth = true; //Whether to use SMTP authentication
                    $mail->Username = SMTP_UNAME; //Username for SMTP authentication any valid email created in your domain
                    $mail->Password = SMTP_PWORD; //Password for SMTP authentication
                    $mail->AddReplyTo("newsplate2015@gmail.com", "News Plate"); //reply-to address
                    $mail->SetFrom("newsplate2015@gmail.com","News Plate"); //From address of the mail

                    // put your while loop here like below,
                    $mail->Subject = "Password has been changed successfully"; //Subject od your mail
                    $mail->AddAddress($email, getusername($email,$password,$db)); //To address who will receive this email
                    $mail->MsgHTML($htmlcode['changepassword']);
                    $send = $mail->Send(); //Send the mail
                    if($send){
                      echo '<center><h3 style="color:#009933;">Mail sent successfully</h3></center>';
						header("Location: ../profile.php");
					}
                    else{
                      $errors='Mail error:'.$mail->ErrorInfo;
                      header("Location: ../error.php?error_log=".$errors);
                    }
		}
		else
			header("Location: ../changepassword.php?error=1");
	}
	else if($flag==0)
		header("Location: ../changepassword.php?error=2");
}
		?>