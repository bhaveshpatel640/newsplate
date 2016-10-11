  <?php
  include "template/header.php";
  $align = array("center", "left","right");
  $str=$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF'];
  $str=str_replace("index.php","",$str);
  $_SESSION['path']=$str;

  ?>

  <main>
    <div class="row">
      <div class="slider">
        <ul class="slides">
          <?php

          if(empty($_GET)===false){
            if (isset($_GET['num'])) {
              $num=$_GET['num'];
            }else{
              $num=30;
            }
          }else{
            $num=30;
          }
          $result=$db->query("SELECT * FROM news ORDER BY pubDate DESC");
          $x=0;

          if($result)
          {
            while ( $row=$result->fetch_assoc()) {
             $i=rand(0,2);
             echo '<li>
             <img src='.$row['imageSrc'].'  title='.$row['title'].' style="opacity:1.0;">
             <div class="caption ' . $align[$i] . '-align">
             <h3>' .$row['title']. '</h3>
             <h5 class="light grey-text text-lighten-3">' .$row['pubDate'].'  '. '<a href=' . 'newspage.php?id='.getnewsid($db,$row['link']).'>Read More</a></h5>
             </div>
             </li>';

             if($x==10){
              break;
            }
            $x++;
          }
        }

        ?>
      </ul>
    </div>
  </div>

  <?php
  $result=$db->query("SELECT * FROM news ORDER BY pubDate DESC");
  $x=0;
  if($result)
  {
    while ( $row=$result->fetch_assoc()) {

      if ($x % 3 == 0) {
        echo '<div class="row">';
      }
      echo '<a href=newspage.php?id='.getnewsid($db,$row['link']).'><div class="col    m4">
      <div class="card medium" style="height:525px;" id='.getnewsid($db,$row['link']).'>
      <div class="card-image">
      <img src=' . $row['imageSrc'] . ' title='.$row['title'].' style="opacity:1.0;">
      </div>
      <div class="card-title" style="height:50px;color:#2196f3;margin-left:20px;margin-right:20px;font-size:20px">
      <p>' . substr($row['title'],0,75). '.</p>
      </div></a>
      <div class="card-content">
      <p>' .create_description($row['description']). '</p>
      </div>
      <div class="card-action">
      <span><u><i><a  href="category.php?category='.$row['category'].'">' .$row['category'].'</a></i></u></span>
      <span class="grey-text"style="float:right;">' .$row['pubDate']. '</span>
      </div>
      </div>
      </div>';
      
      if ($x % 3 == 2) {
        echo '</div>';
      }
      $x++;
      if($x==$num){

        $num=$num+30;
        echo '<div class="row"><div class="row" style="margin:10px"><a href="index.php?num='.$num.'#'.getnewsid($db,$row['link']).'"><h5 class="grey-text">Read More</h5></a></div>';
        break;
      }
    }
  }
  ?>
</main> 
<?php include "template/footer.php"; ?>