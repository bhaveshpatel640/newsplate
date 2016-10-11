<?php
  include "template/header.php";

if(!logged_in()){
  header("Location: login.php?login=2");
}

$email=$_SESSION['email'];
    
if (ispreferenceset($email,$db)) {

     if($result=$db->query("SELECT * From category WHERE email='$email'")){


           $row=$result->fetch_assoc();
              $preference="";
          
            foreach ($row as $key => $value) {
                if ($value==0||$key=='email') {
                  continue;
                }

?>

<main style="padding:5px;">
<div class="row">
   <div class="row" style="margin:0">
    <h5 class="grey-text"><?php echo $key?></h5>
</div>
<?php 
echo '<div class="row">';
$temp=0;

if($result=$db->query("SELECT * From news WHERE category='$key' ORDER BY pubDate DESC")){
     $x=0;

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

if ($temp%5==0) {
 echo '<a href=newspage.php?id='.getnewsid($db,$row['link']).'>
        <div class="col s12 m8">
        <div class="card medium" style="height:635px;">
          <div class="card-image" style="height:350px;">
            <img src='.$imageSrc.' title='.$row['title'].'>
          </div>
           <div class="card-title" style="height:50px;color:#2196f3;margin-left:20px;margin-right:20px;font-size:20px">
            <p>' . $row['title']. '.</p>
          </div></a>
          <div class="card-content">
            <p>'.substr($description,0,700)."...".'</p>
          </div>

          <div class="card-action">
            <span><u><i><a href="category.php?category='.$row['category'].'">' .$row['category'].'</a></i></u></span>
            <span class="grey-text"style="float:right;">' .$row['pubDate']. '</span>
        </div>
       </div>
        </div>';
} else {
  echo '<a href=newspage.php?id='.getnewsid($db,$row['link']).'>
        <div class="col s12 m4">
        <div class="card medium" style="height:635px;">
          <div class="card-image" style="height:250px;">
            <img src='. $row['imageSrc'] .' title='.$row['title'].' style="opacity:1.0;">
          </div>
          <div class="card-title" style="height:50px;color:#2196f3;margin-left:20px;margin-right:20px;font-size:20px">
            <p>' . $row['title']. '.</p>
          </div></a>
          <div class="card-content" style="height:335px;"">
            <p>'.substr($description,0,535).'</p>
          </div>

          <div class="card-action">
            <span><u><i><a href="category.php?category='.$row['category'].'">' .$row['category'].'</a></i></u></span>
            <span class="grey-text"style="float:right;">' .$row['pubDate']. '</span>
            </div>
        </div>
      </div>';

             }
             $temp++;
             if ($temp==5) {
               break;
             }
      }
    }
    echo('</div>');
?>
           
        </main>
<?php
  }
 }
}
else{?>
<div style="width:70%; padding:20px; padding-top:20px; box-shadow:5px 5px 100px rgba(0,0,0,0.4);position:relative;top:10px;border-radius:10px;" class="container">
<?php
echo("Please set your preferences : <a href=preference.php>Click  here </a>");
?>
</div>
<?php
}
include "template/footer.php";
?>