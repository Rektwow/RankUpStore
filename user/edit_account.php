<?php
if(isset($_GET['edit_account'])){
   $user_session=$_SESSION['username'];
   $select_query="SELECT * FROM `users` WHERE user_name='$user_session'";
   $result_query=mysqli_query($con,$select_query);
   $row_fetch=mysqli_fetch_assoc($result_query);
   $user_id=$row_fetch['user_id'];
   $user_address=$row_fetch['user_address'];
   $user_phone=$row_fetch['user_phone'];

}
   if(isset($_POST['user_update'])){
      $update_id=$user_id;
      $user_password=sanitizePw($_POST['user_password']);
      $user_confirm_password=sanitizePw($_POST['user_confirm_password']);
      $hash_password=password_hash($user_password,PASSWORD_DEFAULT);
      $user_address=sanitize($_POST['user_address']);
      $user_phone=filter_var($_POST['user_phone'] , FILTER_SANITIZE_NUMBER_INT);
      $regex= '/^(0)?[1-9]{2}[\s]?[0-9]{3}[\s]?[0-9]{2}[\s]?[0-9]{2}$/';
      $user_img=$_FILES['user_img']['name'];
      $user_img_tmp=$_FILES['user_img']['tmp_name'];
      move_uploaded_file($user_img_tmp, "user_images/$user_img");

      if ($user_address=='' or !preg_match($regex, $user_phone)){
         echo "<script>alert('please fill all the fields')</script>";
      }else{
         if ($user_img=="" or $user_img_tmp==""){
            if (empty($user_password)){
               $update_data="UPDATE `users` SET user_address='$user_address',user_phone='$user_phone' WHERE user_id=$update_id";
               $result_update=mysqli_query($con,$update_data);
                  if($result_update){
                     echo "<script>alert('success update')</script>";
                  }     
            }elseif($user_password!=$user_confirm_password){
               echo "<script>alert('password fail')</script>";
            }else{
               $update_data="UPDATE `users` SET user_password='$hash_password', user_address='$user_address',user_phone='$user_phone' WHERE user_id=$update_id";
               $result_update=mysqli_query($con,$update_data);
               if($result_update){
                  echo "<script>alert('success update')</script>";
               }
            }   
         }else{
            if (empty($user_password)){
               $update_data="UPDATE `users` SET user_img='$user_img',user_address='$user_address',user_phone='$user_phone' WHERE user_id=$update_id";
               $result_update=mysqli_query($con,$update_data);
                  if($result_update){
                     echo "<script>alert('success update')</script>";
                  }
            }elseif($user_password!=$user_confirm_password){
               echo "<script>alert('password fail')</script>";
            }else{
               $update_data="UPDATE `users` SET user_password='$hash_password',user_img='$user_img', user_address='$user_address',user_phone='$user_phone' WHERE user_id=$update_id";
               $result_update=mysqli_query($con,$update_data);
               if($result_update){
                  echo "<script>alert('success update')</script>";
               }
            }
         }
      }
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Rank Up Store</title>
</head>
<body>
   <h3>Edit Account</h3>
   <form action="" method="post" enctype="multipart/form-data" class="text-center">
      <div class="form-outline mb-3">
         <input type="password" class="form-control" name="user_password" placeholder="new password">
      </div>
      <div class="form-outline mb-3">
         <input type="password" class="form-control" name="user_confirm_password" placeholder="confirm password">
      </div>
      <div class="form-outline mb-3 d-flex">
         <input type="file" class="form-control" name="user_img">
         <img src="user_images/<?php echo $user_image ?>" alt="" class="edit_img">
      </div>
      <div class="form-outline mb-3">
         <input type="text" class="form-control" name="user_address" value="<?php echo $user_address ?>">
      </div>
      <div class="form-outline mb-3">
         <input type="text" class="form-control" name="user_phone" value="<?php echo $user_phone ?>">
      </div>
      <input type="submit" class="btn btn-success" name="user_update" value="Update">
   </form>
</body>
</html>