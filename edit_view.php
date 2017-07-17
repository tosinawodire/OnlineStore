<?php

	session_start();
	$_SESSION['active'] = true;

	include 'includes/db.php';
	include'includes/header.php';
	include 'includes/footer.php';
	include 'includes/functions.php';

	if(isset($_GET['cid']))
	{
		$id = $_GET['cid'];
	}

 $view = getCategoryById($conn, $_GET['cid']  );

	$errors =[];
    #title

   $page_title = "category";



  if(array_key_exists('submit', $_POST)) 
  {
		if(empty($_POST['category']))
		 {
			$error['category'] = "Please enter category name";
		}
		if(empty($error)) 
		{
			$clean = array_map('trim', $_POST);
			$newName=$clean['category'];
			
			 editcategory($conn, $newName,$_GET['cid']);
				header("Location:viewcategory.php?successfully added");
			}
			 else {
				header("Location:category.php?err");
			}
		
	}



?>
	
	<div class="wrapper">
		<div id="stream">
			<table id="tab">
				<thead>
					<tr>
						<th><a href = "category.php">CREATE CATEGORIES</a></th>
						<th><a href = "editcategory.php">EDIT CATEGORIES</a></th>
						<th><a href = "deletecategory.php">DELETE CATEGORIES</a></th>
						<th><a href = "viewcategory.php">VIEW CATEGORIES</a></th>
						
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>the knowledge gap</td>
						<td>maja</td>
						<td>January, 10</td>
						<td><a href="#">edit</a></td>
						<td><a href="#">delete</a></td>
					</tr>
          		</tbody>
			</table>
		</div>
		<form class="register" action="" method="POST">
						<p>Edit Category</p>

						
						<input type="hidden" name="category_id">

						<input type="text" name="category" placeholder = "<?php echo $view['category_name']; ?>">


						<input type="submit" name="submit" value="Click to Create">

					</form>

		<div class="paginated">
			<a href="#">1</a>
			<a href="#">2</a>
			<span>3</span>
			<a href="#">2</a>
		</div>
	</div>

	<section class="foot">
		<div>
			<p>&copy; 2016;
		</div>
	</section>