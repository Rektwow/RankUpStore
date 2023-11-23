<?php
   $delete_id=$_POST['delete'];
   $delete_query="DELETE FROM `brands` WHERE brand_id=$delete_id";
   $result=mysqli_query($con,$delete_query);
   if($result){
      echo "<script>alert('brand delete')</script>";
      echo "<script>window.open('../index.php?view_brands','_self')</script>";
   }
?>