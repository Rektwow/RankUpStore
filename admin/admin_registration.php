<?php
include('../includes/connect.php');
include('../functions/functions.php');
session_start();
$login_check = check_login($con);
if(isset($_POST['admin_register'])){
   $admin_name=sanitize($_POST['admin_name']);
   $admin_email=filter_var($_POST['admin_email'] , FILTER_SANITIZE_EMAIL);
   $admin_password=sanitizePw($_POST['admin_password']);
   $admin_confirm_password=sanitizePw($_POST['admin_confirm_password']);
   $hash_password=password_hash($admin_password,PASSWORD_DEFAULT);
   $regexPw="/^(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,10}$/";

   //select query
   $select_query="SELECT * FROM `admins` WHERE admin_email='$admin_email' OR admin_name='$admin_name'";
   $result=mysqli_query($con,$select_query);
   $row_num=mysqli_num_rows($result);
   if($row_num>0){
      echo "<script>alert('admin or email exist')</script>";
   }elseif($admin_password!=$admin_confirm_password  or !preg_match($regexPw, $admin_password)){
      echo "<script>alert('password fail')</script>";
   }else{
   //insert query
   //move_uploaded_file($admin_image_tmp,"admin_images/$admin_image");
   $insert_query="INSERT INTO `admins` (admin_name, admin_email, admin_password) VALUES('$admin_name', '$admin_email', '$hash_password')";
   $sql_execute=mysqli_query($con,$insert_query);
   if($sql_execute){
      echo "<script>alert('admin data added to db')</script>";
      echo "<script>window.open('index.php','_self')</script>";
   }else{
      echo "<script>alert('data failed to add')</script>";
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
   <title>Admin Dashboard</title>
   <!-- LINKS -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="../css/style.css">
   <link rel="apple-touch-icon" sizes="180x180" href="../favicon/apple-touch-icon.png">
   <link rel="icon" type="image/png" sizes="32x32" href="../favicon/favicon-32x32.png">
   <link rel="icon" type="image/png" sizes="16x16" href="../favicon/favicon-16x16.png">
   <link rel="manifest" href="../favicon/site.webmanifest">
</head>
<body>
   <div class="container-fluid">
      <h1 class="text-center my-5">Registration</h1>
      <div class="row d-flex justify-content-center">
         <div class="col-lg-6 col-xl-4 order-2">
            <img src="../images/freepik_register.png" alt="" class="img-fluid">
         </div>
         <div class="col-lg-6 col-xl-4 mt-5 shadow order-1">
            <form action="" method="post">
            <div class="form-outline mt-5 mb-4 fw-bold">
                  <label for="admin_name" class="form-label">Username</label>
                  <input type="text" id="admin_name" name ="admin_name" class="form-control" placeholder="Enter your Username" autocomplete="off" required>
               </div>
               <div class="form-outline mb-4 fw-bold">
                  <label for="admin_email" class="form-label">Email</label>
                  <input type="email" id="admin_email" name ="admin_email" class="form-control" placeholder="Enter your Email" autocomplete="off" required>
               </div>
               <div class="form-outline mb-4 fw-bold"  data-bs-toggle="tooltip" data-bs-placement="right" title="at least one lower case letter
at least one upper case letter
at least one digit
8-10 characters length">
                  <label for="admin_password" class="form-label">Password</label>
                  <input type="password" id="admin_password" name ="admin_password" class="form-control" placeholder="Enter your Password" autocomplete="off" required>
               </div>
               <div class="form-outline mb-4 fw-bold">
                  <label for="admin_confirm_password" class="form-label">Confirm Password</label>
                  <input type="password" id="admin_confirm_password" name ="admin_confirm_password" class="form-control" placeholder="Confirm your Password" autocomplete="off" required>
               </div>
               <div class="text-center">
                  <input type="submit" value="Register" name="admin_register" class="btn btn-success px-4 py-2 mt-2">
                  <p class="mt-3 fw-bold">Back <a href="index.php">Home</a></p>
               </div>
            </form>
         </div>
      </div>
   </div>
</body>
</html>