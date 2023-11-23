<?php
include('../includes/connect.php');
include('../functions/functions.php');
include('../includes/header.php');

if(isset($_POST['user_register'])){
   $user_name=sanitize($_POST['user_name']);
   $user_email=filter_var($_POST['user_email'] , FILTER_SANITIZE_EMAIL);
   $user_password=sanitizePw($_POST['user_password']);
   $user_confirm_password=sanitizePw($_POST['user_confirm_password']);
   $hash_password=password_hash($user_password,PASSWORD_DEFAULT);
   $user_image=$_FILES['user_image']['name'];
   $user_image_tmp=$_FILES['user_image']['tmp_name'];
   $user_address=sanitize($_POST['user_address']);
   $user_phone=filter_var($_POST['user_phone'] , FILTER_SANITIZE_NUMBER_INT);
   $regex= '/^(0)?[1-9]{2}[\s]?[0-9]{3}[\s]?[0-9]{2}[\s]?[0-9]{2}$/';
   $regexPw="/^(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,10}$/";
   $ip=getIPAddress();
   

   //select query
   $select_query="SELECT * FROM `users` WHERE user_email='$user_email' OR user_name='$user_name'";
   $result=mysqli_query($con,$select_query);
   $row_num=mysqli_num_rows($result);
   if($row_num>0 or $user_name=='' or $user_email==''){
      echo "<script>alert('user or email are empty or exists')</script>";
   }elseif($user_password!=$user_confirm_password or !preg_match($regexPw, $user_password)){
      echo "<script>alert('password fail')</script>";
   }elseif($user_address=='' or !preg_match($regex, $user_phone)){
      echo "<script>alert('please add your address and phone number')</script>";
   }else{
   //insert query
   move_uploaded_file($user_image_tmp,"user_images/$user_image");
   $insert_query="INSERT INTO `users` (user_name, user_email, user_password, user_img, user_address, user_phone,ip_address) VALUES('$user_name', '$user_email', '$hash_password', '$user_image', '$user_address', '$user_phone','$ip')";
   $sql_execute=mysqli_query($con,$insert_query);
   if($sql_execute){
      echo "<script>alert('user data added to db')</script>";
      echo "<script>window.open('user_login.php','_self')</script>";
   }else{
      echo "<script>alert('data failed to add')</script>";
   }
   }
   //$username=$_SESSION['username'];
/*                      $get_name="SELECT * FROM `users` WHERE user_name='$user_name'";
                     $result_query=mysqli_query($con,$get_name);
                     $row_query=mysqli_fetch_assoc($result_query);
                     $user_id=$row_query['user_id'];             
   //select cart items
   $select_cart_items="SELECT * FROM `cart` WHERE user_id=$user_id";  //OR user_id='$user_name'
   $result_cart=mysqli_query($con,$select_cart_items);
   $row_num_cart=mysqli_num_rows($result_cart);
   if($row_num_cart>0){
      $_SESSION['username']=$user_name;
      echo "<script>alert('you have items in cart')</script>";
      echo "<script>window.open('checkout.php','_self')</script>";
   }else{
      echo "<script>window.open('../index.php','_self')</script>";
   } */
}
?>

<body>
   <div class="container-fluid mt-5">
      <h2 class="text-center mb-4">Registration</h2>
      <div class="row d-flex align-items-center justify-content-center fw-bold">
         <div class="col-lg-12 col-xl-6">
            <form action="" method="post" enctype="multipart/form-data">
               <div class="form-outline mb-4 fw-bold">
                  <label for="user_name" class="form-label">Username</label>
                  <input type="text" id="user_name" name ="user_name" class="form-control" placeholder="Enter your Username" autocomplete="off" value="<?php echo isset($_POST['user_name']) ? $user_name : ''; ?>"  >
               </div>
               <div class="form-outline mb-4 fw-bold">
                  <label for="user_email" class="form-label">Email</label>
                  <input type="email" id="user_email" name ="user_email" class="form-control" placeholder="Enter your Email" autocomplete="off" value="<?php echo isset($_POST['user_email']) ? $user_email : ''; ?>"  >
               </div>
               <div class="form-outline mb-4 fw-bold" data-bs-toggle="tooltip" data-bs-placement="right" title="at least one lower case letter
at least one upper case letter
at least one digit
8-10 characters length">
                  <label for="user_password" class="form-label">Password <small>Tooltip on hover</small></label>
                  <input type="password" id="user_password" name ="user_password" class="form-control" placeholder="Enter your Password" autocomplete="off">
               </div>
               <div class="form-outline mb-4 fw-bold">
                  <label for="user_confirm_password" class="form-label">Confirm Password</label>
                  <input type="password" id="user_confirm_password" name ="user_confirm_password" class="form-control" placeholder="Confirm your Password" autocomplete="off">
               </div>
               <div class="form-outline mb-4 fw-bold">
                  <label for="user_image" class="form-label">User Image</label>
                  <input type="file" id="user_image" name ="user_image" class="form-control">
               </div>
               <div class="form-outline mb-4 fw-bold">
                  <label for="user_address" class="form-label">Address</label>
                  <input type="text" id="user_address" name ="user_address" class="form-control" placeholder="Enter your Address" autocomplete="off" value="<?php echo isset($_POST['user_address']) ? $user_address : ''; ?>"  >
               </div>
               <div class="form-outline mb-4 fw-bold">
                  <label for="user_phone" class="form-label">Phone</label>
                  <input type="text" id="user_phone" name ="user_phone" class="form-control" placeholder="Enter your Phone Number" autocomplete="off" value="<?php echo isset($_POST['user_phone']) ? $user_phone : ''; ?>"  >
               </div>
               <div class="text-center">
                  <input type="submit" value="Register" name="user_register" class="btn btn-success px-4 py-2 mt-2">
                  <p class="mt-3 fw-bold">Already have an account? <a href="user_login.php">Login</a></p>
                  <a class="btn btn-secondary mb-3 px-3" href="../index.php">Back</a>
               </div>
            </form>
         </div>
      </div>
   </div>
   
</body>
</html>