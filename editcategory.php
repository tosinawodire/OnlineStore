<?php
  
	include 'includes/db.php';
	include'includes/header.php';
	include 'includes/footer.php';
	include 'includes/functions.php';
   ?>




<?php

	 $errors =[];
    #title

   $page_title = "EditCategory";

 



   if(array_key_exists('edit', $_POST)) {
   	
   	
   	
	   	#validate first name 
	   	if(empty($_POST['category'])){
	   		$errors['category'] = "*please enter a category name </br>";

	   	}


	   	if(empty($errors)) {

	   	editCategory($conn,$_POST,$_GET);

	   		
	   	} else {
	   		foreach ($errors as $error) {
	   			echo $error;
	   		}
	   	}
   		

  	}







 

  	
?>







	<div class="wrapper">
		<div id="stream">

				

			

					<form class="register" method="POST">
						<p>Edit Category</p>

						<input type="text" name="category">


						<input type="submit" name="edit" value="Click to edit">
					</form>

						

				
		</div>

		
			<div class="paginated">
			<strong>
				<a href="editcategory.php">EDIT CATEGORY</a>
			<a href="deletecategory.php">DELETE CATEGORY</a>
			<span></span>
			<a href="post.php">POST</a>
			</strong>
			
		
			
		</div>
	</div>

	<section class="foot">
		<div>
			<p>&copy; 2016;
		</div>
	</section>
</body>
</html>
