<?php

	session_start();
	$_SESSION['active'] = true;

	include 'includes/db.php';
	include'includes/header.php';
	include 'includes/footer.php';
	include 'includes/functions.php';


	$errors =[];
    #title

   $page_title = "category";



   if(array_key_exists('add', $_POST)) {
   	
   	
   	
	   	#validate first name 
	   	if(empty($_POST['category'])){
	   		$errors['category'] = "*please enter a category name </br>";

	   	}


	   	if(empty($errors)) {
	   		addCategories($conn,$_POST);
	   	} else {
	   		foreach ($errors as $error) {
	   			echo $error;
	   		}
	   	}
   		

  	}




?>
	

  	
	<div class="wrapper">
		<div id="stream">

				

			<table id="tab">

					<form class="register" method="POST">
						<p>Edit Category</p>

						<input type="text" name="category" placeholder ="enter category name">


						<input type="submit" name="add" value="Click to add">
					</form>

						<?php

						?>

				<thead>
					<tr>
						<th>category id</th>
						<th>category name</th>
						<th>date created</th>
					</tr>
				</thead>
				<tbody>
					
					<?php

					viewCategories($conn);


					?>

          		</tbody>
			</table>
		</div>

		<div class="paginated">
			<span><a href="category.php"></a></span>
			
			<span><a href="#"></a></span>
			
		</div>
	</div>

	<section class="foot">
		<div>
			<p>&copy; 2016;
		</div>
	</section>