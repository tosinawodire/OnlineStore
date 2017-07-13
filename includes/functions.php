<?php
	
	function doesEmailExists($dbconn, $input)
	{
		$result = false;

		$stmt = $dbconn->prepare("SELECT * FROM admin WHERE email = :em");

		$stmt->bindParam(":em", $input);

		$stmt->execute();
		$count = $stmt->rowCount();
		if($count>0)
		{
			$result = true;
		}
		return $result;
	}



	function registerAdmin($dbconn, $input)
	{
		

			$hash = password_hash($input['password'], PASSWORD_BCRYPT);
			//do registration

			$stmt = $dbconn->prepare("INSERT INTO admin(firstname,lastname,email,hash) VALUES(:fn, :ln, :e,:h)");

			$data = [
					':fn' =>$input['fname'],
					':ln' =>$input['lname'],
					":e" => $input['email'],
					":h"=> $hash
					
					];

			$stmt->execute($data);

	}

	function displayErrors($errors, $field)
	{
		$result= "";
		if (isset($errors[$field]))
		{
			$result = '<span class="err">'.$errors[$field].'</span>';
		}
		return $result;
	}

	function doAdminLogin($dbconn, $input)
	{
		$result = [];

		$stmt = $dbconn->prepare("SELECT admin_id,hash FROM admin WHERE email=:e");
		$stmt ->bindParam(":e", $input['email']);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_BOTH);

		if($stmt->rowCount() !=1 || !password_verify($input['password'], $row['hash']))
		{
			header('login.php'); exit();
		}
		else
		{
			$result[] = true;
			$result[] = $row['admin_id'];
		}

		return $result;

	}

?>