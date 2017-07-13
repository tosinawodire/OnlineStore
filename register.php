<?php


	include 'includes/db.php';
	include'includes/header.php';
	include 'includes/footer.php';
	include 'includes/functions.php';

	$error = [];

	if (array_key_exists('register', $_POST))
	{
		if(empty($_POST['fname']))
		{
			$error['fname'] = "please enter your firstname";
		}

		if(empty($_POST['lname']))
		{
			$error['lname'] = "please enter your lastname";
		}

		if(empty($_POST['email']))
		{
			$error['email'] = "please enter your email";
		}


		if($_POST['pword'] != $_POST['password'])
		{
			$error['pword'] = "password does not match";
		}

		
	}

?>
<html>	
	<div class="wrapper">
		<h1 id="register-label">Admin Register</h1>
		<hr>
		<form id="register"  action ="register.php" method ="POST">
			<div>
				<label>first name:</label>
				<input type="text" name="fname" placeholder="first name">
			</div>
			<div>
				<label>last name:</label>	
				<input type="text" name="lname" placeholder="last name">
			</div>

			<div>
				<label>email:</label>
				<input type="text" name="email" placeholder="email">
			</div>
			<div>
				<label>password:</label>
				<input type="password" name="password" placeholder="password">
			</div>
 
			<div>
				<label>confirm password:</label>	
				<input type="password" name="pword" placeholder="password">
			</div>

			<input type="submit" name="register" value="register">
		</form>

		<h4 class="jumpto">Have an account? <a href="login.php">login</a></h4>
	</div>
</html>
	
