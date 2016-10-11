<?php
  include "template/header.php";
if(empty($_GET)===false){
            if (isset($_GET['num'])) {
              $num=$_GET['num'];
            }else{
              $num=20;
            }
          }else{
            $num=20;
          }
if(empty($_GET)==false) {
$news_id=$_GET['id'];
$_SESSION['news_id']=$news_id;
$_SESSION['currentpage']=$_SERVER['PHP_SELF'];
          
if (logged_in()) {
  $email=$_SESSION['email'];
}
     if($result=$db->query("SELECT * From news WHERE news_id='$news_id'")){
               $row=$result->fetch_assoc();
   
              $title         =$row['title'];
              $link          =$row['link'];
              $pubDate       =$row['pubDate'];
              $creater       =$row['creater'];
              $category      =$row['category']; 
              $description   =$row['description'];
              $news_feed     =$row['news_feed'];
              $imageTitle    =$row['imageText'];
              $imageSrc      =$row['imageSrc'];
      }
    
 ?>
     
    <main>
        <div class="row">
            <div class="col m12 offset-m1">
                <div class="col s12 m10">
                    <div class="card">
                        <div class="card-image">
                            <img src="<?php echo $imageSrc?>"  title="<?php echo $title?>">
                            <span class="card-title"><?php echo $title?></span>
                        </div>
                        <div class="card-content">
                            <p><?php echo '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.$description ?></p>
                        </div>
                       </div>
                </div>
            </div>

        </div>

        </div>
        <div class="row">
            <div class="col m12 offset-m1">
                <div class="col s12 m10">
                    <div class="card cyan lighten-5">
                        <div class="card-content">
                            <span class="card-title" style="color:black">Comments</span>
                            <li class="divider"></li>
                            <br>
                            <form action="core/comments.php" method=post>
                            <div class="input-field col s12">
                                <input type=hidden name="news_id"value="<?php echo $news_id?>">
                                <textarea id="textarea1" class="materialize-textarea" name=comments></textarea>
                                <label for="textarea1">Write a comment</label>
                            </div>
                            <a class="btn-floating btn waves-effect waves-light teal" style="margin-left:2%;">
                            <button type=submit border=0px style="border: none; background-color: transparent;outline: none;">
                              <i class="material-icons">add</i></div></a>
                            
      <ul class="collection cyan lighten-5">                           
                             <?php  

                              if($result=$db->query("SELECT * From comments WHERE news_id='$news_id' ORDER BY comment_id DESC")){
                                
                              while ( $row=$result->fetch_assoc()) {      
                              ?>
   




    <li class="collection-item avatar cyan lighten-5">
      <img src=<?php echo $path.getprofileimage($email,$db)?> alt="" class="circle">
      <span class="title"><?php echo getusernamefromid($row['user_id'],$db)?></span>
      <span class="title" style="float:right;"><?php echo $row['date'] ?></span>

      <p><br>
          <?php echo $row['text'] ?>
      </p>

    </li>
    <?php } } ?>
  </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <li class="divider"></li>
        <div class="row" style="margin:5px;text-align:center;">
            <h5 class="grey-text">Related News</h5>
        </div>
        <li class="divider"></li>

        <?php

if($result=$db->query("SELECT * From news WHERE category='$category'")){
     $x=0;

          while ( $row=$result->fetch_assoc()) {
              $title         =$row['title'];
              $link          =$row['link'];
              $pubDate       =$row['pubDate'];
              $creater       =$row['creater'];
              $category      =$row['category']; 
              $description   =$row['description'];
              $news_feed     =$row['news_feed'];
              $imageTitle    =$row['imageText'];
              $imageSrc      =$row['imageSrc'];

              if(getnewsid($db,$link)==$news_id)
                continue;

              if ($x % 4 == 0) {
                echo '<div class="row">';
            }
           echo     '<a href=newspage.php?id='.getnewsid($db,$row['link']).'>
                    <div class="col s12 m3" >
                      <div class="card small" style="height:435px">
                        <div class="card-image">
                            <img src='.$row['imageSrc'].'>
                        </div>
                      <div class="card-title" style="height:50px;color:#2196f3;margin-left:20px;margin-right:20px;font-size:15px">
                          <p>' . $row['title']. '.</p>
                        </div></a>
                        <div class="card-content" style="font-size:15px;">
                          <p>' .create_description($row['description']). '</p>
                        </div>
                      <div class="card-action">
                          <span float="left"><u><i>' .$row['category'].'</i></u></span>
                          <span float="right">'.$row['pubDate'] . '</span>
                        </div>
                    </div>
                </div>';

            if ($x % 4 == 3) {
                echo '</div>';
            }
      $x++;
      if($x==$num){
        $num=$num+20;
        echo '<div class="row"><div class="row" style="margin:10px"><a href="newspage.php?id='.$news_id.'&num='.$num.'#'.getnewsid($db,$row['link']).'"><h5 class="grey-text">Read More</h5></a></div>';
        break;
      }

      }
  }




?>
            </div>

        </div>
        </div>


    </main>
  <?php
  }else{
    ?>
<div style="width:100%; padding:20px; padding-top:20px; box-shadow:5px 5px 100px rgba(0,0,0,0.4);position:relative;top:10px;border-radius:10px;" class="container">
      <?php
      echo("Something went wrong :-( <a href=index.php> Home Page</a>");
      ?>
      </div>
    <?php
  }

  include "template/footer.php";

?>