<?php


	include 'includes/db.php';
	include'includes/header.php';
	include 'includes/footer.php';
	include 'includes/functions.php';

	$errors = [];

	if (array_key_exists('login', $_POST))
	{
		
		if(empty($_POST['email']))
		{
			$errors['email'] = "please enter your email";
		}

		

		if(empty($_POST['password']))
		{
			$errors['password'] = "please enter you password";
		}

		if (empty($errors))
		{
			$clean = array_map('trim', $_POST);

			$chk = doAdminLogin($conn,$clean);

			if($chk[0])
			{
				$_SESSION['id'] = $chk[1]['admin_id'];
				header("Location:category.php");
			}
			
			
		}

	}

?>
<html>	
	<div class="wrapper">
		<h1 id="register-label">Admin Login</h1>
		<hr>
		<form id="register"  action ="login.php" method ="POST">

			<div>
				<?php
				$e = 'email';
				$display = displayErrors($errors, $e);
				echo $display;
				?>
				<label>email:</label>
				<input type="text" name="email" placeholder="email">
			</div>
			<div>
				<?php
				$pass = 'password';
				$display = displayErrors($errors, $pass);
				echo $display;
				?>
				<label>password:</label>
				<input type="password" name="password" placeholder="password">
			</div>
 
			
			<input type="submit" name="login" value="register">
		</form>

		<h4 class="jumpto">Have an account? <a href="login.php">login</a></h4>
	</div>
</html>
	
