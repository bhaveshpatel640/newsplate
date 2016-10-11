<?php
include 'template/header.php';  
if(logged_in()){
	header("Location: index.php");
}
$errors="No Error";
$link_text="login.php";
if(empty($_GET)===false) {
	$error_num=$_GET['error'];
	if(empty($_GET['error_log'])===false) 
	$error_log=$_GET['error_log'];
	
if(empty($error_num)===false){
	if ($error_num==1) {
		$errors="Invalid Email or Password";
		$link="login.php";
		$link_text="Login Again";
	}elseif ($error_num==2) {

		$errors='Email does not exists :-(';
		$link="signup.php";
		$link_text="Register Here";

		$text="Login Again";
		$text_link="login.php";
	}elseif ($error_num==3) {
		$errors='Invalid Password';
		$link="login.php";
		$link_text="Login Again";

		$text="Forgot Password ?";
		$text_link="resetpassword.php";
	}elseif ($error_num==4) {
		$errors='Already Registered';
		$link="login.php";
		$link_text="Login";
	}
	elseif ($error_num==6) {

		$errors='Password Does Not Match';
		$link="signup.php";
		$link_text="Signup Again";

	}elseif ($error_num==5) {

		$errors='Unknown Error';
		$link="index.php";
		$link_text="Click Here";

	}elseif ($error_num==7) {

		$errors='Email Id already exists';
		$link="login.php";
		$link_text="Login here";

	}else
	header("Location: index.php");

}else
	header("Location: index.php");
}
else{
$error_num=0;
if(empty($_GET['error_log'])===false)
$errors=$error_log;
$link="index.php";
}
?>	
<main>
			<div style="max-width:650px; padding:20px; padding-top:20px; box-shadow:5px 5px 100px rgba(0,0,0,0.4);position:relative;top:10px;border-radius:10px;"
			class="container">
				<label><center><h5>Error Occurred</h5></center></label>
				<hr class="divider">

				<div class="row">
				    <div class="input-field col s12" style="padding-bottom:20px;">
				        <label style="color:red;"><?php echo $errors?><a href=<?php echo $link?>>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $link_text?></a></label><BR>
				        <?php 
				        if ($error_num==3||$error_num==2) {
				echo '<br><font style="color:red;"><a href='.$text_link.'>&nbsp;&nbsp;&nbsp;&nbsp;('.$text.')</a></font>';
				        }
				        ?>
				    </div>
				</div>				
    </div>

	</main>
<?php include 'template/footer.php';  ?>
