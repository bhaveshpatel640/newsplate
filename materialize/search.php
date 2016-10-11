<?php
  include "template/header.php";

if(empty($_GET)===false) {

$news_id=$_GET['search'];
$search=explode(" ",$news_id);


}

  ?>
  <main>
		<div style="width:100%; padding:20px; padding-top:20px; box-shadow:5px 5px 100px rgba(0,0,0,0.4);position:relative;top:10px;border-radius:10px;" class="container">
			<?php
			$keyword="";
			foreach ($search as $key) {
				$keyword.="<b>'".$key."'</b>, ";
			}
			$keyword=substr($keyword,0,-2);
			echo("Showing News for keywords : ".$keyword);
			?>
	    </div>
	    <br>
		<?php
		foreach ($search as $key) {
			$result=$db->query("SELECT * FROM news ORDER BY pubDate DESC");
            $x=0;
			if($result)
			{
	      	    while ( $row=$result->fetch_assoc()) {
					if (preg_match('/'.strtolower($key).'/',strtolower($row['description'])))
						$newsarray[]=getnewsid($db,$row['link']);				
				}
				if (empty($newsarray)==false) {
					$newsarray=array_unique($newsarray);
					}
					
			 }
		}
		if (empty($newsarray)==false) {
			foreach ($newsarray as $id) {
				$result=$db->query("SELECT * From news WHERE news_id=$id");
					$row=$result->fetch_assoc();
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
	                          <span><u><i><a href="category.php?category='.$row['category'].'">' .$row['category'].'</a></i></u></span>
	                          <span class="grey-text"style="float:right;">' .$row['pubDate']. '</span>
	                        </div>
	                      </div>
	                    </div>';
	              
	            if ($x % 3 == 2) {
	                echo '</div>';
	            }
	            $x++;
			}
		}
		else{?><br>
			<div style="width:100%; padding:20px; padding-top:20px; box-shadow:5px 5px 100px rgba(0,0,0,0.4);position:relative;top:10px;border-radius:10px;" class="container">
			<?php
			echo('No Result Found, Try Other Keywords<form action="search.php" method=get>
              <input class="sb-search-input" placeholder="Search News...." type="text" name="search" id="search" autocomplete=off>
              <input type=submit hidden>
            </input>
            </form>');
			?>
	    </div>
		<?php
	}
		?>
	</main>
	<?php include "template/footer.php"; ?>