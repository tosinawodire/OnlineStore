<?php


	include 'includes/db.php';
	include'includes/header.php';
	include 'includes/footer.php';
	include 'includes/functions.php';

	$errors = [];

	if (array_key_exists('register', $_POST))
	{
		if(empty($_POST['fname']))
		{
			$errors['fname'] = "please enter your firstname";
		}

		if(empty($_POST['lname']))
		{
			$errors['lname'] = "please enter your lastname";
		}

		
		if(empty($_POST['email']))
		{
			$errors['email'] = "please enter your email";
		}

		if(doesEmailExists($conn, $_POST['email']))
		{
			$errors['email'] = "email already exist";
		}

		if(empty($_POST['password']))
		{
			$errors['password'] = "please enter your password";
		}


		if($_POST['password'] != $_POST['pword'])
		{
			$errors['pword'] = "password does not match";
		}

		if (empty($errors))
		{
			$clean = array_map('trim', $_POST);
			
			registerAdmin($conn, $clean);

		}

	}

?>
<html>	
	<div class="wrapper">
		<h1 id="register-label">Admin Register</h1>
		<hr>
		<form id="register"  action ="register.php" method ="POST">
			<div>
				<?php
				$display = displayErrors($errors, 'fname');
				echo $display;
				?>
				<label>first name:</label>
				<input type="text" name="fname" placeholder="first name">
			</div>
			<div>
				<?php
				$display = displayErrors($errors, 'lname');
				echo $display;
				?>
				<label>last name:</label>	
				<input type="text" name="lname" placeholder="last name">
			</div>

			<div>
				<?php
				$display = displayErrors($errors, 'email');
				echo $display;
				?>
				<label>email:</label>
				<input type="text" name="email" placeholder="email">
			</div>

			<div>
				<?php
				$display = displayErrors($errors, 'password');
				echo $display;
				?>
				<label>password:</label>
				<input type="password" name="password" placeholder="password">
			</div>
 
			<div>
				<?php

				$passe ='pword';
				$display = displayErrors($errors, $passe);

				echo $display;
				?>
				<label>confirm password:</label>	
				<input type="password" name="pword" placeholder="password">
			</div>

			<input type="submit" name="register" value="register">
		</form>

		<h4 class="jumpto">Have an account? <a href="login.php">login</a></h4>
	</div>
</html>
	
