<?php

	session_start();
$_SESSION['active'] = true;

		
	include 'includes/db.php';
	include'includes/header.php';
	include 'includes/footer.php';
	include 'includes/functions.php';

	$errors = [];

	if(isset($_GET['action']))

  	{


   	deleteProduct($conn,$_GET['book_id']);
   }



?>

	<div class="wrapper">
		<div id="stream">

			<?php  if(isset($_GET['message'])) { echo $_GET['message'];} ?>

			<table id ="tab">
				<thead>
					<tr>
						<th>Title</th>
						<th>Author</th>
						<th>Category</th>
						<th>Price</th>
						<th>Year</th>
						<th>ISBN</th>
						<th>Flag</th>
						<th>Image</th>
						<th>edit</th>
						<th>delete</th>
					</tr>
				</thead>
				<tbody>
					<tr>
					<?php  $view = getProducts($conn); 
					        echo "$view"; ?>
					</tr>
          		</tbody>
			</table>
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