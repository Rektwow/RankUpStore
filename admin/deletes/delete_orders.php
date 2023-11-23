<?php
   $delete_id=$_POST['delete'];
   $delete_query="DELETE FROM `orders` WHERE order_id=$delete_id";
   $result=mysqli_query($con,$delete_query);
   if($result){
      echo "<script>alert('order delete')</script>";
      echo "<script>window.open('../index.php?orders_list','_self')</script>";
   }
?>