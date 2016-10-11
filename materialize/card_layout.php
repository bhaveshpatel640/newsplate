<?php
include "template/header.php";
include '/smtpmail/library.php'; // include the library file
include "/smtpmail/classes/class.phpmailer.php";
include "/smtpmail/classes/class.smtp.php";
$email="bhaveshpatel640@gmail.com";
$body="";
$header='<h3 style="text-align:centre;">Latest News</h3> 
<head><link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.1/css/materialize.css" media="screen,projection" /></head>
';

if($result=$db->query("SELECT * From category WHERE email='$email'")){
   $row=$result->fetch_assoc();
      $preference="";
    foreach ($row as $key => $value) {
        if ($value==0||$key=='email') {
          continue;
        }

$body.='<main style="padding:5px;">
<div class="row">
   <div class="row" style="margin:0">
    <h5 class="grey-text">'.$key.'</h5>
</div>';
$body.='<div class="row">';
$x=0;
if($result=$db->query("SELECT * From news WHERE category='$key' ORDER BY pubDate DESC")){
          while($row=$result->fetch_assoc()) {
              $title         =$row['title'];
              $link          =$row['link'];
              $pubDate       =$row['pubDate'];
              $creater       =$row['creater'];
              $category      =$row['category']; 
              $description   =$row['description'];
              $news_feed     =$row['news_feed'];
              $imageTitle    =$row['imageText'];
              $imageSrc      =$row['imageSrc'];

               $body.='<div class="row">
            <div class="col s12 m8">
                <div class="card large" style="height:310px;">
                    <div class="row" style="padding:10px 10px 0 0;">
                        <div class="card-image col m5">
                            <img src='. $row['imageSrc'] .' title='.$row['title'].'>
                        </div>
                        <span class="col s12 m7 grey-text" style="font-size:1em;position:relative; left:8px;">' . $row['title']. '</span>
                        <li class="divider col s12 m7"></li>
                        <div class="card-content col s12 m7" style="margin-bottom:15px;">
                            <p>'.$description.'</p>
                        </div>
                        <div>
                        <li class="divider col s12 m7"></li>
                        <div class="card-content col s12 m2">
                        <span class="grey-text" style="font-size:1.2em;">'.$category.'</span>
                        </div>
                        <div class="card-content col s12 m4">
                        <span class="grey-text right-align" style="font-size:1.2em; float:right;">'.$pubDate.'</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>';

            if($x==5){
              $x=0;
              break;
            }
            $x++;
      }
    }
    $body.='</div>';

   $news='<div style="width:500px;">
    <div style="width:250px; height=100%; float:left;">
            <img style="width:200px; height:200px;" src='. $row['imageSrc'] .' title='.$row['title'].'>
    </div>
    <div style="width:250px; height=100%; float:right;">
        <span color="grey" style="font-size:1.2em;">' . $row['title']. '</span>
        <p>'.substr($description,0,300).'</p>
        <div style="width:100%">

            <div style="height=100%; float:left;">
                <b><span color="grey" style="font-size:1em;">'.$category.'</span></b>
            </div>
            <div style="height=100%; float:right;">
                <b><span color="grey" style="font-size:1em;">'.$pubDate.'</span></b>
            </div>
        </div>
    </div>
</div>';
           

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
                    $mail->AddReplyTo("newsplate2015@gmail.com", "News PLate"); //reply-to address
                    $mail->SetFrom("newsplate2015@gmail.com","News PLate"); //From address of the mail
                    // put your while loop here like below,
                    $mail->Subject = "Latest News"; //Subject od your mail
                    $mail->AddAddress($email, "Bhavesh Patel"); //To address who will receive this email
                    $mail->MsgHTML($header.$body.$footer);
                    $send = $mail->Send(); //Send the mails
                    if($send){
                      echo '<center><h3 style="color:#009933;">Mail sent successfully</h3></center>';
                    }
                    else{
                      $errors='Mail error:'.$mail->ErrorInfo;
                    }
  // echo($header.$body.$footer);
    ?>