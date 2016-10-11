<?php 
include "template/header.php";

if(!logged_in()){
  header("Location: index.php?login=2");
}


$email=$_SESSION['email'];
     if($result=$db->query("SELECT * From category WHERE email='$email'")){
    
               $row=$result->fetch_assoc();
                $preference="";
              foreach ($row as $key => $value) {
                if ($key!="email") {
                $preference[$key]=($value==1)?"checked": "" ;
                }
              }
      }


?>

        <main>
            <div style="max-width:650px; padding:25px; box-shadow:5px 5px 100px rgba(0,0,0,0.4);position:relative;top:10px;" class="container">
    <form class="col s12" action="core/set_preference.php" method="post">
 
     
      <div class="row">
        <div class="input-field col s12">
   <label style="position:relative;bottom:10px;">Check your prefered categories</label>
    <?php 
    $x=1;
    //print_r($preference);
    foreach ($preference as $key => $value) {
          echo '<p>
            <input type="checkbox" id="test.'.$x.'" name="category[]" value="'.$key.'" '.$value.'/>
            <label for="test.'.$x.'">'.$key.'</label>
          </p>';
    $x++;
  }
    ?>
      </div>       
        </div>

         <div class="row">
        <div class="input-field col offset-l5 offset-m5 offset-s4 col l3 m3 s3">
            <button class="btn waves-effect waves-light" type="submit" name="save" style="padding:10px;height:50px;padding:10px;font-size:1.4em;position:relative;top:20px;"><span>Save</span>
       </button>
      </div>
    </form>
    </div>
        </main>
        <?php 
include "template/footer.php"
?>