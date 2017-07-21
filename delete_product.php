<?php

   session_start();
   $_SESSION['active'] = true;

   include 'includes/db.php';
   include'includes/header.php';
   include 'includes/footer.php';
   include 'includes/functions.php';

   if(isset($_GET['bid']))
   {
      $id = $_GET['bid'];
   }

         
          deleteProduct($conn, $id);
            header("Location:view_products.php?successfully deleted");
        



?>
   
   