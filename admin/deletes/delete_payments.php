<?php
   $delete_id=$_POST['delete'];
   $delete_query="DELETE FROM `payments` WHERE payment_id=$delete_id";
   $result=mysqli_query($con,$delete_query);
   if($result){
      echo "<script>alert('payment delete')</script>";
      echo "<script>window.open('../index.php?payments_list','_self')</script>";
   }
?>