<?php
	if (array_key_exists('submit', $_POST))
	{
		$errors = [];


		if(empty($_POST['fname']))
		{
			$errors[]= "please enter your firstname";
		}


		if(empty($_POST['email']))
		{
			$errors[]= "please enter your email";
		}

	}/*	if (empty($errors))
		{
			$_clean = array_map('trim', $_POST);
		}

		echo $_clean['fname'];


	}

	/*function plural($item)
	{
		return $item ."s";
	}

	$data = ["james","mark","hope"];
	$new_data = array_map('plural', $data);

	
	//var_dump($_clean);



	function saymyname($name, $cb)
	{
		echo $name.$cb();
	}
	$name = "shayo";

	/*$message = function ()
	{
		return "loves coding";
	};

	saymyname("tunde ", function (){
		return "loves coding";
	});
	echo "<br>";
	saymyname($name,function (){
		return " loves coding";
	});*/


	function fetchCategories($cb)
	{
		//assuming the data has arrived

		
		$data = ["java", "ruby", "javascript", "php" ; "elm", "R"];

		$cb($data);

	}

		fetchCategories(function($resultset){

			echo "<select>";
			foreach ($resultset as $key => $value) {
			
				echo '<option value="'.$key.'">'.$value.'</option>';
			}
			echo "</select>";
		});


	
?>



<form method = "POST" action = "">

	<p>name</p>
	<input type = "text" name ="fname">

	<p>email</p>
	<input type="text" name = "email">

	<input type = "submit" name = "submit" > 
</form>