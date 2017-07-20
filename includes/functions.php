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


	function viewCategories($dbconn){


   

            $stmt = $dbconn->prepare("SELECT * FROM categories"); 

            $stmt->execute();

            while ($record = $stmt->fetch()) {

            echo "<tr>";
            echo "<td>".$record['category_id']."</td>";
            echo "<td>".$record['category_name']."</td>";
            echo "<td>".$record['date_created']."</td>";
            echo "<td><a href=\"editCategory.php?id=" .$record['category_id']. "&name=" .$record['category_name']. "\">edit</a></td>";
            echo "<td><a href=\"deleteCategory.php?id=" .$record['category_id']."\">delete</a></td>";
            echo "</tr>";
            
              # code...
            }

}


			function addCategory($dbconn, $input)
			{
				$stmt = $dbconn->prepare("INSERT INTO category() VALUES(:id, :ca)");
				$data =[
				':id'=>$input[NULL],
				':ca'=> $input['category']
				];
				$stmt->execute($data);
			}








		function editCategory($dbconn,$input,$id){


  $stmt =$dbconn->prepare("UPDATE category SET category_name=:name WHERE category_id=:cid");

        
        $data = [
        ":name" => $input,
        ":cid" => $id
        ];

        $stmt->execute($data);

        header("Location:viewcategory.php");
	   
     }

     function deleteCategory($dbconn, $input){

        
         $stmt = $dbconn->prepare("DELETE FROM category WHERE category_id=:cid");
         
         $stmt->bindParam(":cid", $input);

         $stmt->execute();

       }


     function getCategoryById($dbconn, $id)
     {
     	$stmt = $dbconn->prepare("SELECT * FROM category WHERE category_id= :cid");
     	$stmt->bindParam(":cid", $id);
     	$stmt->execute();
     	$row = $stmt->fetch(PDO::FETCH_BOTH);
     	return $row;
     }



     function viewCategory($dbconn)

     {
     	$result =" ";

		$stmt= $dbconn->prepare("SELECT * FROM category");
     	$stmt->execute();

     	while ($row = $stmt->fetch(PDO::FETCH_BOTH))
      {
     	$result .= '<tr>
     	<td>'.$row['category_id'].'</td>;
     	<td>'.$row['category_name'].'</td>;

     	<td><a href="edit_view.php?cid='.$row['category_id'].'">edit</a></td>;

		<td><a href="deletecategory.php?cid='.$row['category_id'].'">delete</a></td>;
		</tr>';

     }

     	return $result;
     	

     }

  
function getCategory($dbconn){

       $stmt =$dbconn->prepare("SELECT * FROM category");
       $stmt->execute();
       $result = "";

       while ($record = $stmt->fetch()){
            $cat_id = $record['category_id'];
            $cat_name = $record['category_name'];

            $result .= "<option value='$cat_id'>$cat_name</option>";

       }
       return $result;
   
}


 function uploadFiles($fileArray, $imageName){
     // $result = [];

   		#generate random number to append
    	$rnd = rand(0000000000, 9999999999);

    	#strip filename for spaces
    	$strip_name = str_replace("","_", $fileArray[$imageName]['name']);

    	$filename = $rnd.$strip_name;
    	$destination = 'uploads/'.$filename;

    	if(!move_uploaded_file($fileArray[$imageName]['tmp_name'], $destination))
    	 {
        	return [false, $destination]; 
    	}
    	return [true, $destination]; 
         }

         function addProducts($dbconn,$input, $destin){
    $stmt=$dbconn->prepare("INSERT INTO books VALUES(NULL, :title,:au,:id,:bpr,:yr,:is,:flag,:fi)"); 
           $data =
           [

           ":title" => $input['title'],
           ":au" => $input['author'],
           ":id" => $input['category'],
           ":bpr" => $input['price'],
           ":yr" => $input['year'],
            ":is" => $input['isbn'],
             ":flag" => $input['flag'],
            ":fi" => $destin
  ];
            
            $stmt->execute($data);

            
            
}



     

?>