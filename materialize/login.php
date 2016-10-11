		<?php include 'template/header.php'; 	

		if (logged_in()) {
			header("Location: index.php");
		}
	
		?>

			<main>
			<div style="max-width:650px; padding:20px; padding-top:20px; box-shadow:5px 5px 100px rgba(0,0,0,0.4);position:relative;top:10px;border-radius:10px;"
			class="container">
			<form class="col s12" action="core/login.php" method="post">
				<div class="row">
				    <div class="input-field col s12">
				        <input id="email"  name="email" type="email" class="validate" required>
				        <label for="email" data-error="wrong" data-success="right">Email</label>
				    </div>
				</div>    
				<div class="row" style="margin-bottom:20px;">
				    <div class="input-field col s12">
				        <input id="password"  name="password"  type="password" class="validate" required>
				        <label for="password">Password</label>
				    </div>
				</div>
				<div class="col offset-m4" style="text-align:right;margin-bottom:20px;">
			        <a href="resetpassword.php"><font class="grey-text" style="text-size:25px;text-decoration: underline;" >Forgot Password?</font></a>
			        </div>
				<div class="row" style="margin-bottom:40px;">
			        <div class="input-field col offset-m4">
			            <button class="btn waves-effect waves-light" type="submit" name="action" style="width:150px;height:50px;padding:10px;font-size:1.3em;"><span style="position:relative;bottom:5px;">Send</span>
			    			<i class="material-icons" style="position:relative;top:0px;left:5px;">send</i>
			  			</button>
			        </div>
			    </div>
			</form>
			 <li class="divider"></li>
			    <div class="row">
			        <div class="input-field col offset-m4">
			            <h5 class="grey-text center-align">New User?</h5>
                        <a href="signup.php">
			            <button class="btn waves-effect waves-light" style="width:150px;height:50px;padding:10px;font-size:1.3em;">
                            <span style="position:relative;bottom:2px;">Signup</span>
			  			</button></a>
			        </div>
			    </div>
    </div>

	</main>
<?php 
	if(isset($_GET['login'])){
			switch ($_GET['login']) {
				case '1':

				echo '<script type="text/javascript">
						alert("Login now by using the new password that you must have received by an email from us.");
					  </script>';
					# code...login please
					break;
				case '2':

				echo '<script type="text/javascript">
					alert("Login to set preference");
				</script>';
					# code...login to set preference
					break;
				case '3':
		
				echo '<script type="text/javascript">
					alert("Login to set profile");
				</script>';
					# code...login to set profile
					break;
				case '4':
	
				echo '<script type="text/javascript">
					alert("Login to comment");
				</script>';
					# code...login to comment
					break;
				
				default:

				echo '<script type="text/javascript">
					alert("Login Please");
				</script>';
					# code...login please
	

					break;
			}
		}

include 'template/footer.php'; ?>