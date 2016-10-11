		<?php 
		include 'template/header.php'; 
		if(empty($_GET)==false){
        switch ($_GET['error']) {
            case '1':
                echo '<script type="text/javascript">
                        alert("Email Does Not Exists");
                      </script>';
                    break;
                # code...
                break;
            
            default:
                # code...
                break;
        }
    }
			?>
		
			<main>
			<div style="max-width:650px; padding:20px; padding-top:20px; box-shadow:5px 5px 100px rgba(0,0,0,0.4);position:relative;top:10px;border-radius:10px;"
			class="container">
			<form class="col s12" action="core/resetpassword.php" method="post">
			<label><center><h5>Reset Password</h5></center></label>
				<hr class="divider">
				<div class="row">
				    <div class="input-field col s12">
				        <input id="email"  name="email" type="email" class="validate" required>
				        <label for="email" data-error="wrong" data-success="right">Email</label>
				    </div>
				</div>    
				
				<div class="row" style="margin-bottom:40px;">
			        <div class="input-field col offset-m4">
			            <button class="btn waves-effect waves-light" type="submit" name="action" style="width:150px;height:50px;padding:10px;font-size:1.3em;"><span style="position:relative;bottom:5px;">Create Password</span>
			    			<i class="material-icons" style="position:relative;top:0px;left:5px;">send</i>
			  			</button>
			        </div>
			    </div>
			</form>
		</div>
	</main>

<?php include 'template/footer.php'; ?>