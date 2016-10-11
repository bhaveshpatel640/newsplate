<?php
  include "template/header.php";


if(empty($_GET)===false) {
  $category=$_GET['category'];

   if($result=$db->query("SELECT * From news WHERE category='$category'")){
    
              $row=$result->fetch_assoc();
              $title         =$row['title'];
              $link          =$row['link'];
              $pubDate       =$row['pubDate'];
              $category      =$row['category']; 
              $description   =$row['description'];
              $imageTitle    =$row['imageText'];
              $imageSrc      =$row['imageSrc'];
      } 
  }

?>
  <main style="padding:5px;">
        <div class="row" style="margin:0">
            <h5 class="grey-text"><?php echo $category?></h5>
        </div>
        <li class="divider"></li>

<?php
$result=$db->query("SELECT * FROM news WHERE category='$category' ORDER BY pubDate DESC ");
            $x=0;
            $size=4;
            $num=2;
       if($result)
      {
          while ( $row=$result->fetch_assoc()) {
            if ($x % $num == 0) {
                echo '<div class="row">';
                $size=8;
            }
            else
              $size=4;
            if ($x>4) {
              $size=4;
            }
            if ($x>6) {
              $num=3;
            }
        echo   '<a href=newspage.php?id='.getnewsid($db,$row['link']).'>
          <div class="col s12 m'.$size.'">
            <div class="card medium"  style="height:525px;">
               <div class="card-image">
                 <img src='.$row['imageSrc'].' title='.$row['title'].' >
               </div>
              <div class="card-title" style="height:50px;color:#2196f3;margin-left:20px;margin-right:20px;font-size:20px">
                            <p>' . $row['title']. '.</p>
              </div></a>          
            <div class="card-content">
              <p>' .create_description($row['description']). '</p>
            </div>
            <div class="card-action">
                <span ><u><i>'.$row['category'].'</i></u></span>
                 <span class="grey-text"style="float:right;">' .$row['pubDate']. '</span>
            </div>
          </div>
        </div>';

            if ($x % $num == $num-1) {
                echo '</div>';
            }
            $x++;
        }
    }  
?>


        </main>
            
<?php
  include "template/footer.php";
?>