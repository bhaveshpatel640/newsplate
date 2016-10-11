<?php
  include "template/header.php";

if(!logged_in()){
    header("Location: index.php?login=3");
}

  $email=$_SESSION['email'];
  if($result=$db->query("SELECT * From userdetails WHERE email='$email'")){
               $row=$result->fetch_assoc();
   }

     if($result=$db->query("SELECT * From category WHERE email='$email'")){
               $category=$result->fetch_assoc();
                $preference="";
                foreach($category as $key => $value) {
                $preference[$key]=($value==1)?"checked": "" ;
              }
      }

?>

    <main>

        <div class="row">
            <div class="col s12 m8 offset-m4 l6 offset-l5">
                <img style="float:left; width:150px;height:150px;box-shadow:5px 5px 50px rgba(0,0,0,0.3);margin-top:5%;" src=<?php echo $path.$row['profile']?> alt="" class="circle responsive-img">
                <form action="core/upload.php" method="post" enctype="multipart/form-data">
                      <div class="file-field input-field">
                      <div style="margin-top:30%;position:relative;left:35px;">
                        <span><i class="material-icons" id="editimage">mode_edit</i></span>
                        <input type="file" name="fileToUpload" id="fileToUpload" />
                        <input type=image src="images/save.png" style="position:relative;margin-left:20px;" width=25px height:25px alt=submit value="Upload Image" name="submit"/>
                      </div>
                    </div> 
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col s12 m6 offset-m3">
                <div class="card-panel teal">
                    <span class="white-text">Name
               <div class="collection">
                    <a href="" class="collection-item"><?php echo $row['first_name']?></input></a>
                    <a href="" class="collection-item"><?php echo $row['last_name']?></input></a>
            </div>
          </span>   <span class="white-text">Email ID
               <div class="collection">
    <a  class="collection-item"><?php echo $row['email']?></a>
            </div>
          </span>
             <span class="white-text">Password
               <div class="collection">
    <a href="changepassword.php" class="collection-item"><?php echo "******************"?><span class="badge"><i class="material-icons">mode_edit</i></span> </a>
            </div>
          </span>
    <span class="white-text">Preferred Categories <a href="preference.php" class="white-text"><i class="material-icons">mode_edit</i></a>
 <div class="collection">
   
       <?php
        $x=1;
    foreach ($preference as $key => $value) {
      if ($x!=8) {
       echo '<div class="collection-item">
              <input type="checkbox" id="test.'.$x.'" disabled  '.$value.'/>
              <label for="test.'.$x.'">'.$key.'</label>
        </div>';
      }
      $x++;
    }
        ?>
      </div>                               
          </span>
            </div>
            </div>
            </div>
        </div>

    </main>
<script type="text/javascript">

$(document).ready(function() {

$('#editimage').click(function() {
    return false;
});
return false;
});
});

</script>
    <?php include "template/footer.php"; ?>