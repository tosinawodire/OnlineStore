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
						<th>Category Id:</th>
						<th>Category Name:</th>
						<th>edit</th>
						<th>delete</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<?php $view = viewCategory($conn); echo $view; ?>
						<td></td>
						<td></td>
						<td></td>
						<td><a href="edit_view.php">edit</a></td>
						<td><a href="deletecategory.php">delete</a></td>
					</tr>
          		</tbody>
			</table>
		</div>

		<div class="paginated">
			<a href="addproduct.php">ADD PRODUCTS</a>
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
</body>
</html>
