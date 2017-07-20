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

         
          deleteCategory($conn, $id);
            header("Location:viewcategory.php?successfully deleted");
        



?>
   
   