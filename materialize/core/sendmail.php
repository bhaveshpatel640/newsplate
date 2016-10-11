<?php
require 'init.php';
include '../smtpmail/library.php'; // include the library file
include "../smtpmail/classes/class.phpmailer.php";
include "../smtpmail/classes/class.smtp.php";

if($result1=$db->query("SELECT * From userdetails")){

	while ($row1=$result1->fetch_assoc()) {
		if ($row1['email']!="newsplate2015@gmail.com") {
			$email_id=$row1['email'];
			//$email_id="bhaveshpatel640@gmail.com";
			$body="";
	$header='<h3 style="text-align:centre;">Latest News</h3>';

	if($result2=$db->query("SELECT * From category WHERE email='$email_id'")){
		$row2=$result2->fetch_assoc();
		$preference="";
		foreach ($row2 as $key => $value) {
			if ($value==0||$key=='email') {
				continue;
			}

			$body.='<main style="padding:5px;">
			<div style="margin:0">
			<h2 style="font-size:2em;">'.$key.'</h2>
			</div>';
			$x=0;
			if($result3=$db->query("SELECT * From news WHERE category='$key' ORDER BY pubDate DESC")){
				while($row3=$result3->fetch_assoc()) {
					$title         =$row3['title'];
					$link          =$row3['link'];
					$pubDate       =$row3['pubDate'];
					$creater       =$row3['creater'];
					$category      =$row3['category']; 
					$description   =$row3['description'];
					$news_feed     =$row3['news_feed'];
					$imageTitle    =$row3['imageText'];
					$imageSrc      =$row3['imageSrc'];

					$body.='<div style="width:70%;box-shadow:5px 5px 5px 5px;border-style: solid;border-width: medium;">
						    <div>
						    <div>
						    <img src='.$imageSrc.' title='.$title.'style="position:relative;float:left;padding:10px;" width=100% height=300px >
						    </div>
						    <div style="padding:10px;">
						    <span style="font-size:1em;padding:10px;font-family: Georgia,Times, serif; color:#010101;">'.$title.'</span>
						    </div>  
						    <hr>
						    <div style="padding:5px">
						    <p style="font-size:1em;padding:10px;">'.$description.'</p>
						    </div>
						    <hr>
						    
						    <div style="position:relative;float:left;padding:10px;">
						    <span style="font-size:1em;padding:10px;font-family: Georgia,Times, serif; color:#010101;">Category :'.$category.'</span>
						    </div>
						    <div style="position:relative;float:right;padding:10px;">
						    <span style="font-size:1em;padding:10px;font-family: Georgia,Times, serif; color:#010101;">Date :'.$pubDate.'</span>
						    </div>
						</div><br><br></div><hr style="float:left;" width=70%><br><br><br>';

					if($x==2){
						$x=0;
						break;
					}
					$x++;
				}
			}
		}
	}
	$footer='</main>';

	 				    $mail  = new PHPMailer; // call the class 
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
	                    $mail->Subject = "Latest News"; //Subject od your mail
	                    $mail->AddAddress($email_id, getusernamefromemail($email_id,$db)); //To address who will receive this email
	                    $mail->MsgHTML($header.$body.$footer);
	                    $send = $mail->Send(); //Send the mails
	                    if($send){
	                    	echo '<center><h3 style="color:#009933;">Mail sent successfully to '.$email_id.'</h3></center>';
	                    }
	                    else{
	                    	$errors='Mail error:'.$mail->ErrorInfo;
	                    	echo $errors;
	                    }
		} 
	}
	echo "<br><a href='../admin.php'>Click Here to visit admin page</a>";
}
?>