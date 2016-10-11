<?php include 'template/header.php'; 	
	if(logged_in()){
		if ($_SESSION['email']=="newsplate2015@gmail.com") {
		}else
		header("Location: index.php");
	}else
		header("Location: index.php?login=1");
	
?>
<main>
<div style="max-width:650px; padding:20px; padding-top:20px; box-shadow:5px 5px 100px rgba(0,0,0,0.4);position:relative;top:10px;border-radius:10px;"
class="container">
<form class="col s12" action="core/admin.php" method="post">
	<label><center><h5>Administrator</h5></center></label>
	<li class="divider" style="margin-bottom:15px;"></li>


	<div class="row">
	    <div class="input-field col s12">
	        <input id="rsscategory"  name="rsscategory" type="text" class="validate" required>
	        <label for="rsscategory" data-error="wrong" data-success="right">Category Name</label>
	    </div>
	    <div class="input-field col s12">
	        <input id="rsslink"  name="rsslink" type="text" class="validate" required>
	        <label for="rsslink" data-error="wrong" data-success="right">Add New Rss Feed</label>
	    </div>
	    
	    <div class="input-field col offset-m4">
            <button class="btn waves-effect waves-light" type="submit" name="action" style="width:115px;height:50px;padding:10px;font-size:1.3em;"><span style="position:relative;bottom:5px;">Add</span>
    			<i class="material-icons" style="position:relative;top:-2px;left:5px;">add</i>
  			</button>
        </div>
        </div>
</form>

				<li class="divider" style="margin-top:15px;"></li>  
		   			<label><center><h5>Send Mail</h5></center></label>
		   			<form class="col s12" action="core/sendmail.php" method="post">
						<div class="row">
						    <div class="input-field col offset-m3">
					            <button class="btn waves-effect waves-light" type="submit" name="action" style="width:200px;height:50px;padding:10px;font-size:1.3em;">
					            	<span style="position:relative;bottom:5px;">Send Latest News</span>
					  			</button>
					        </div>
						</div>
					</form>
				<li class="divider" style="margin-top:15px;"></li>  
		   			<label><center><h5>Update Link</h5></center></label>
				<li class="divider" style="margin-bottom:15px;"></li>

				
   			<?php
			$result=$db->query("SELECT * FROM categorylist");
			$x=0;
			echo "<table><tr><td style='font-size:30px'>Links</td><td style='font-size:30px'>Updated Date</td></tr>";
			if($result) {						
				while($row=$result->fetch_assoc()) {
					echo '<tr>';
					echo '<td><a href=core/update.php?id='.$row['category_id'].' id="download-button" class="btn-large waves-effect waves-light" style="width:70%">'.$row['category'].'</a></td><td><font style="font-size:1.5em;">'.$row['date'].'</td></font>';
					echo '</tr>';
					
					$x++;
				}
			}
			?>
			</table>
	</main>
<?php include 'template/footer.php'; ?>