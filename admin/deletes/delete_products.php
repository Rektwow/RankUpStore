<?php
   $delete_id=$_POST['delete'];
   $delete_query="DELETE FROM `products` WHERE product_id=$delete_id";
   $result=mysqli_query($con,$delete_query);
   if($result){
      echo "<script>alert('product delete')</script>";
      echo "<script>window.open('../index.php?view_products','_self')</script>";
   }
?>