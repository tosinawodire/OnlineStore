<?php
	
	session_start();
	$_SESSION['active'] = true;

	include 'includes/db.php';
	include'includes/header.php';
	include 'includes/footer.php';
	include 'includes/functions.php';


?>




	<div class="wrapper">
		<div id="stream">
			<table id="tab">
				<thead>
					<tr>
						<th>Book Id</th>
						<th>Book Title</th>
						<th>Author</th>
						<th>Category</th>
						<th>Price</th>
						<th>Year</th>
						<th>ISBN</th>
						<th>Flag</th>
						<th>edit</th>
						<th>delete</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<?php $view = viewProducts($conn); echo $view; ?>
						<td></td>
						<td></td>
						<td></td>
						<td><a href="edit_product.php">edit</a></td>
						<td><a href="delete_product.php">delete</a></td>
					</tr>
          		</tbody>
			</table>
		</div>

		<div class="paginated">
			<a href="addproduct.php">ADD PRODUCTS</a>
			<a href="edit_product.php">EDIT PRODUCTS</a>
			<a href="view_products.php">VIEW PRODUCTS</a>
			<a href="delete_product.php">DELETE PRODUCTS</a>
			<span>3</span>
			<a href="#">2</a>
		</div>
	</div>

	<section class="foot">
		<div>
			<p>&copy; 2016;
		</div>
	</section>
</body>
</html>
