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

	function getproducts($dbconn){
      $stmt=$dbconn->prepare("SELECT * FROM books");
       $stmt->execute();
      $result = "";

       while ($record = $stmt->fetch()){
              $book_id = $record['book_id'];
              $title = $record['title'];
              $author = $record['author'];
              $category = getCategoryByID($dbconn, $record['cat_id']);
              $price = $record['price'];
              $year= $record['year'];
              $isbn = $record['isbn'];

              $path = $record['image_path'];
                   $flag = $record['flag'];
           

          

                $result .= "<tr>";
                $result .= "<td>".$title."</td>";
                $result .= "<td>".$author."</td>";
                $result .= "<td>".$category['category_name']."</td>";
                $result .= "<td>".$price."</td>";
                $result .= "<td>".$year."</td>";
                $result .= "<td>".$isbn."</td>";
                $result .= "<td>".$flag."</td>";
                $result .= "<td><img src='$path' height='80px'  width='80px'/></td>";
                $result .= "<td><a href='editProducts.php?book_id=$book_id'>edit</a></td>";
                   $result .= "<td><a href='adminHome.php?action=delete&book_id=$book_id'>delete</a></td>";
                
                $result .= "</tr>";


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


function addCategories($dbconn, $input) {
	$cat = [];
	$stmt = $dbconn->prepare("SELECT * FROM category WHERE category_name = :cat_name");
	$stmt->bindParam(":cat_name", $input['category_name']);
	$stmt->execute();
	if($stmt->rowCount() == 0) {
		$st = $dbconn->prepare("INSERT INTO category(category_name) VALUES(:cat_name)");
		$st->bindParam(":cat_name", $input['category_name']);
		$st->execute();
		 $success = "Category Successfully Added";
    
    header("Location:category.php?success=$success");
   
		$row = $st->fetch(PDO::FETCH_BOTH);
		$cat[] = true;
		$cat[] = $row['category_id'];
		return $cat;
	}
}

		function editCategory($dbconn,$post,$get){


  $stmt =$dbconn->prepare("UPDATE categories SET category_name=:name WHERE category_id=:id");

        $stmt->bindparam(":name",$post['category']);

        $stmt->bindparam(":id",$get['id']);

        $stmt->execute();

        header("Location:category.php");
	   
     }


     function deleteCategory($dbconn,$get){

        
         $stmt=$dbconn->prepare("DELETE FROM categories WHERE category_id=:id");
         
         $stmt->bindparam(":id", $get['id']);

         $stmt->execute();

         redirect('category.php');

       }



?>