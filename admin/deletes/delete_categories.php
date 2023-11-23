<?php
   $delete_id=$_POST['delete'];
   $delete_query="DELETE FROM `categories` WHERE category_id=$delete_id";
   $result=mysqli_query($con,$delete_query);
   if($result){
      echo "<script>alert('category delete')</script>";
      echo "<script>window.open('../index.php?view_categories','_self')</script>";  
   }
?>