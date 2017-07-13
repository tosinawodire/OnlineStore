<?php
	if (array_key_exists('submit', $_POST))
	{
		$errors =[];

		/*var_dump($_FILES);
		echo "<hr>";

		echo$_FILES['pic']['type'];*/


		$FILE_MAX_SIZE = 2048576;

		$allowed_extensions = ["image/JPEG", "image/jpeg", "image/jpg", "image/png", "image/PNG"];
		$upload_dir = "uploads/";

		//print_r($_FILES['pic']['size']);
		//exit();

		if($_FILES['pic']['size'] > $FILE_MAX_SIZE)
		{
			$errors[] = "file too large. see instructions...";
		}

		/*if(! in_array($_FILES['pic']['size'], $allowed_extensions))

		{
			$errors[]= "file type not allowed ";

		}*/

		$random = rand(00000, 99999);
		$filename =$random.$_FILES['pic']['name'];
		$destination = $upload_dir.$filename;

		







		if(empty($errors))
		{
			if(!move_uploaded_file($_FILES['pic']['tmp_name'] , $destination))
			{
			
			$errors[] = 'could not upload file';
			
			}



		}
		else
		{
			print_r($errors);
		}

	}



?>
<form method = "POST" action ="" enctype = "multipart/form-data">
	
	<input type = "file" name="pic">

	<input type = "submit" name = "submit" value = "upload">

</form>