<?php
$email="bhaveshpatel640@gmail.com";

$header='<html><head>
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.1/css/materialize.css" media="screen,projection" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <style>
        body {
            overflow: auto;
        }
        
        .brand-logo {
            margin-left: 10px;
        }
        
        .dropdown-content {
            min-width: 150px;
        }
    </style></head><body><main>';

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
$body='<div class="row">';
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
               $body.='<a href=newspage.php?id='.getnewsid($db,$row['link']).'>
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
                $body.='<a href=newspage.php?id='.getnewsid($db,$row['link']).'>
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
    $body.='</div>';

   $news='<div class="row">
            <div class="col s12 m8">
                <div class="card large" style="height:310px;">
                    <div class="row" style="padding:10px 10px 0 0;">
                        <div class="card-image col m5">
                            <img src="http://lorempixel.com/800/680/city">
                        </div>
                        <span class="col s12 m7 grey-text" style="font-size:1.8em;position:relative; left:8px;">Card Title</span>
                        <li class="divider col s12 m7"></li>
                        <div class="card-content col s12 m7" style="margin-bottom:15px;">
                            <p>I am a very simple card. I am good at containing small bits of information. I am convenient because I require little markup to use effectively. I am convenient because I require..</p>
                        </div>
                        <div>
                        <li class="divider col s12 m7"></li>
                        <div class="card-content col s12 m2">
                        <span class="grey-text" style="font-size:1.5em;">Category</span>
                        </div>
                        <div class="card-content col s12 m4">
                        <span class="grey-text right-align" style="font-size:1.5em; float:right;">Date</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
           

  }
}


  $footer='</main></body></html>';
  echo($header.$body.$footer);
    ?>