<?php

	session_start();
	$_SESSION['active'] = true;
	   #load db connection

   	include 'includes/db.php';
	include'includes/header.php';
	include 'includes/footer.php';
	include 'includes/functions.php';


    $flag = array ("top-selling", "trending", "most viewed");

     define("MAX_FILE_SIZE", "2097152");

					$ext = ["image/jpg","image/jpeg", "image/png"];

  
				 $erorrs = [];

		   if (array_key_exists('add', $_POST)) 
		   {

		   	  		if(empty($_POST['title']))
		   	  		{

				  		$errors['title']="Please enter a Book title"; 
				   	}

				   if(empty($_POST['author']))
				   {

				  		$errors['author']="Please enter Book author"; 
				   }
					if(empty($_POST['price']))
					{

				  		$errors['price']="Please enter the Book price"; 
				   	}

				   if(empty($_POST['category']))
				   {

				  		$errors['category']="Please select the category"; 
				   }
				if(empty($_POST['year']))
				{

				  		$errors['year']="Please enter the year of publication"; 
				   }

				if(empty($_POST['isbn'])){

					$errors['isbn']="Please enter the ISBN"; 
				}

				if(empty($_POST['flag'])){

					$errors['flag']="Please enter a flag"; 
				}
					


					    #be sure a file was selected....
						if(empty($_FILES['pic']['name'])){
							$errors['pic']= "please choose a file";
						}

						#check file size...

						if($_FILES['pic']['size'] > MAX_FILE_SIZE) {
							$errors['pic'] = "file size exceeds maximum. maximum: ".MAX_FILE_SIZE;
						}

						#check extention....
						if(!in_array($_FILES['pic']['type'], $ext)) {
							$errors['pic'] = "Invalid file type";
						}

						

						


					 if(empty($errors)){
						   
						   $upload = uploadFiles($_FILES, 'pic');

						   if($upload[0])
						   {
						   	addProducts($conn,$_POST, $upload[1]);


						   }

						   $errors['pic'] = 'file Upload failed. please try again';


				   			
		 		 	}

			}

		?>

	<div class="wrapper">
		<h1 id="register-label">Add Products</h1>
		<hr>
		<form id="register"  action ="addProduct.php" method ="POST" enctype="multipart/form-data">
			<div>

				<div>
				
				<label>Upload Image</label>
				<input type="file" name="pic">
			
			</div>

			<div>
				
				
				<label>Title</label>
				<input type="text" name="title" placeholder="title">
			</div>
			<div>

				
				
				<label>Author</label>	
				<input type="text" name="author" placeholder="author">
			</div>
			<div>
				
				
				<label>Category</label>	
				<select name="category">
					<option value = "">Select</option>
					<?php $view = getCategory($conn);   echo $view; ?>
				</select>
				
			</div>
			    
			<div>
				
				
				<label>Price</label>
				<input type="text" name="price" placeholder="price">
			</div>
			    
			<div>
				
				
				<label>Year of Publication</label>
				<input type="text" name="year" placeholder="year">
			</div>
			<div>
				
				<label>ISBN</label>
				<input type="text" name="isbn" placeholder="ISBN">
			</div>
			
			<div>
				

			    <label>Flag</label>
			    <select name= "flag">

			    <option value="">Select a flag</option>
			    <?php foreach($flag as $flag){ ?>
               <option value="<?php echo $flag?>"><?php echo $flag?></option>
               <?php }?>

			    </select>


			</div>

			<input type="submit" name="add" value="Add product">


			</form>
		</div>

		<div class="paginated">
			<a href="addproduct.php">ADD PRODUCTS</a>
			<a href="#">2</a>
			<span>3</span>
			<a href="#">2</a>
		</div>
	</div>

	