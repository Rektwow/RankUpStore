<?php
   $delete_id=$_POST['delete'];
   $delete_query="DELETE FROM `users` WHERE user_id=$delete_id";
   $result=mysqli_query($con,$delete_query);
   if($result){
      echo "<script>alert('user delete')</script>";
      echo "<script>window.open('../index.php?users_list','_self')</script>";
   }
?>