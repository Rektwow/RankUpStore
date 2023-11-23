<?php
include('../includes/connect.php');
include('../functions/functions.php');
include('../includes/header.php');
@session_start();

if(isset($_POST['user_login'])){
   $user_name=sanitize($_POST['user_name']);
   $user_password=sanitizePw($_POST['user_password']);
   $select_query="SELECT * FROM `users` WHERE user_name='$user_name'";
   $result=mysqli_query($con, $select_query);
   $row_num=mysqli_num_rows($result);
   $row_data=mysqli_fetch_assoc($result);
   $ip=getIPAddress();
   $get_name="SELECT * FROM `users` WHERE user_name='$user_name'";
   $result_query=mysqli_query($con,$get_name);
   $row_query=mysqli_fetch_assoc($result_query);
   error_reporting(0);
   $user_id=$row_query['user_id'];
   //cart item
   if($user_id>0){
      $update_cart="UPDATE `cart` SET user_id=$user_id WHERE ip_address='$ip'";
      $result_quantity=mysqli_query($con,$update_cart);
      $select_cart="SELECT * FROM `cart` WHERE user_id=$user_id AND ip_address='$ip'"; 
      $result_cart=mysqli_query($con, $select_cart);
      $row_cart=mysqli_num_rows($result_cart);
   }
   if($row_num>0){
      $_SESSION['username']=$user_name;
      if(password_verify($user_password,$row_data['user_password'])){
         //echo "<script>alert('login success')</script>";
         if($row_num==1 AND $row_cart==0){
            $_SESSION['username']=$user_name;
            echo "<script>alert('login success')</script>";
            echo "<script>window.open('profile.php','_self')</script>";
         }else{
            $_SESSION['username']=$user_name;
            echo "<script>alert('login success')</script>";
            echo "<script>window.open('../index.php','_self')</script>";
         }
      }else{
         echo "<script>alert('invalid password')</script>";
      }
   }else{
      echo "<script>alert('invalid username')</script>";
   }
}
?>

<body>
   <div class="container-fluid mt-5">
      <h2 class="text-center mb-4">Login</h2>
      <div class="row d-flex align-items-center justify-content-center fw-bold">
         <div class="col-lg-12 col-xl-6">
            <form action="" method="post">
               <div class="form-outline mb-4">
                  <label for="user_name" class="form-label">Username</label>
                  <input type="text" id="user_name" name ="user_name" class="form-control" placeholder="Enter your Username" autocomplete="off" value="<?php echo isset($_POST['user_name']) ? $user_name : ''; ?>"  >
               </div>
               <div class="form-outline mb-4">
                  <label for="user_password" class="form-label">Password</label>
                  <input type="password" id="user_password" name ="user_password" class="form-control" placeholder="Enter your Password" autocomplete="off">
               </div>
               <div class="text-center">
                  <input type="submit" value="Login" name="user_login" class="btn btn-success px-4 py-2 mt-2">
                  <p class="mt-3 fw-bold">Don't have an account? <a href="user_registration.php">Register</a></p>
                  <a class="btn btn-secondary mb-3 px-3" href="../index.php">Back</a>
               </div>
            </form>
         </div>
      </div>
   </div>
</body>
</html>