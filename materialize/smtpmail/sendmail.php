<?php
include 'library.php'; // include the library file
include "classes/class.phpmailer.php"; // include the class name
$value=isset($_POST["send"]);

if(isset($_POST["send"])){
	$email = $_POST["email"];
	$mail	= new PHPMailer; // call the class 
	$mail->IsSMTP(); 
	$mail->Host = SMTP_HOST; //Hostname of the mail server
	$mail->SMTPDebug = 1;
	$mail->Port = SMTP_PORT; //Port of the SMTP like to be 25, 80, 465 or 587
	$mail->SMTPSecure = 'ssl';
	$mail->SMTPAuth = true; //Whether to use SMTP authentication
	$mail->Username = SMTP_UNAME; //Username for SMTP authentication any valid email created in your domain
	$mail->Password = SMTP_PWORD; //Password for SMTP authentication
	$mail->AddReplyTo("suyashthakare4@gmail.com", "Suyash Thakare"); //reply-to address
	$mail->SetFrom("bhaveshpatel640@gmail.com", "NewsPlate"); //From address of the mail
	// put your while loop here like below,
	$mail->Subject = "NewsPlate Latest News"; //Subject od your mail
	$mail->AddAddress($email, "Bhavesh Patel"); //To address who will receive this email
	$mail->MsgHTML("<b><font style='color:#009933;'>NewsPlate Latest News</font><br/><br/>by NewsPlate backend Developer<BR> Thank You.</B>");
	$mail->AddAttachment("images/newsplate.jpg"); //Attach a file here if any or comment this line, 
	$send = $mail->Send(); //Send the mails
	if($send){
		echo '<center><h3 style="color:#009933;">Mail sent successfully</h3></center>';
		header("Location: ../index.php");
	}
	else{
		echo '<center><h3 style="color:#FF3300;">Mail error: </h3></center>'.$mail->ErrorInfo;
	}
}
?>
