<?php
include('../includes/connect.php');
include('../functions/functions.php');
@session_start();

if(isset($_POST['admin_login'])){
   $admin_name=sanitize($_POST['admin_name']);
   $admin_password=sanitizePw($_POST['admin_password']);
   $select_query="SELECT * FROM `admins` WHERE admin_name='$admin_name'";
   $result=mysqli_query($con, $select_query);
   $row_num=mysqli_num_rows($result);
   $row_data=mysqli_fetch_assoc($result);

   if($row_num>0){
      $_SESSION['adminname']=$admin_name;
      if(password_verify($admin_password,$row_data['admin_password'])){
         echo "<script>alert('login success')</script>";
         echo "<script>window.open('index.php','_self')</script>";
      }else{
         echo "<script>alert('invalid password')</script>";
      }
   }else{
      echo "<script>alert('invalid username')</script>";
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
      <h1 class="text-center my-5">Admin Login</h1>
      <div class="row d-flex justify-content-center">
         <div class="col-lg-6 col-xl-4 order-2">
            <img src="../images/freepik_login.png" alt="" class="img-fluid">
         </div>
         <div class="col-lg-6 col-xl-4 mt-5 shadow order-1">
            <form action="" method="post">
            <div class="form-outline mt-5 mb-4 fw-bold">
                  <label for="admin_name" class="form-label">Username</label>
                  <input type="text" id="admin_name" name ="admin_name" class="form-control" placeholder="Enter your Username" autocomplete="off" >
               </div>
               <div class="form-outline mb-4 fw-bold">
                  <label for="admin_password" class="form-label">Password</label>
                  <input type="password" id="admin_password" name ="admin_password" class="form-control" placeholder="Enter your Password" autocomplete="off" >
               </div>
               <div class="text-center">
                  <input type="submit" value="login" name="admin_login" class="btn btn-success px-4 py-2 mt-2">
                  <!-- <p class="mt-3 fw-bold">Don't have an account? <a href="admin_registration.php">Register</a></p> -->
               </div>
            </form>
         </div>
      </div>
   </div>
</body>
</html>