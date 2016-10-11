<?php 
include "template/header.php";
if(logged_in()){
  header("Location: index.php");
}
?>
        <main>
            <div style="max-width:650px; padding:25px; padding-top:10px; box-shadow:5px 5px 100px rgba(0,0,0,0.4);position:relative;top:10px;" class="container">
    <form class="col s12" action="core/signup.php" method="post">
      <div class="row">
        <div class="input-field col s6">
          <input id="first_name" name="first_name" type="text" class="validate" required maxlength="32">
          <label for="first_name">First Name</label>
        </div>
        <div class="input-field col s6">
          <input id="last_name"  name="last_name" type="text" class="validate" required maxlength="32">
          <label for="last_name">Last Name</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="password"  name="password"  type="password" class="validate" required maxlength="32">
          <label for="password">Password</label>
        </div>
      </div>
        <div class="row">
        <div class="input-field col s12">
          <input id="password"  name="cpassword" type="password" class="validate" required maxlength="32">
          <label for="password">Confirm Password</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
           <input id="email"  name="email" type="email" class="validate" required maxlength="100">
            <label for="email" data-error="wrong" data-success="right">Email</label>
        </div>
      </div>
         <div class="row">
        <div class="input-field col s12">
    <label for="gender" style="position:relative;bottom:30px;font-size:1.1em;">Select your gender</label>
    <p>
      <input name="gender" type="radio" id="test1" value=0/>
      <label for="test1">Male</label>
    </p>
    <p>
      <input name="gender" type="radio" id="test2" value=1/>
      <label for="test2">Female</label>
    </p>
        </div>
      </div>
         <div class="row">
        <div class="input-field offset-l4 offset-m4 offset-s4 col l3 m3 s3">
            <button class=" btn waves-effect waves-light" type="submit" name="send" style="width:150px; height:50px;padding:10px;font-size:1.3em;">
              <span style="position:relative;bottom:5px;">Submit</span>
    <i class="material-icons" style="position:relative;top:-2px;left:5px;">send</i>
  </button>
        </div>
      </div>
        
    </form>
    </div>
        </main>
         <?php 
include "template/footer.php"
?>