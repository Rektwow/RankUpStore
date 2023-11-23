<?php
include('../includes/connect.php');
include('../functions/functions.php');
include('../includes/header.php');
?>

<body>
   <?php
                                                                  $username=$_SESSION['username'];
                                                                  $get_name="SELECT * FROM `users` WHERE user_name='$username'";
                                                                  $result_query=mysqli_query($con,$get_name);
                                                                  $row_query=mysqli_fetch_assoc($result_query);
                                                                  $user_id=$row_query['user_id'];
      $get_user="SELECT * FROM `users` WHERE user_id=$user_id";
      $result=mysqli_query($con,$get_user);
      $fetch_query=mysqli_fetch_assoc($result);
      $user_id=$fetch_query['user_id'];
      
   ?>
   <div class="container mt-5">
      <h2 class="text-center mb-5">Payment Options</h2>
      <div class="container row d-flex justify-content-center align-items-center mb-5 m-auto">
         <div class="col-md-6 d-flex justify-content-evenly align-items-center">
            <a href="https://www.paypal.com" target="blank"><img src="../images/PayPal.png" alt="" class="pay_img1"></a>                                     <!-- styling -->
            <a href="https://www.mastercard.ch" target="blank"><img src="../images/Mastercard.png" alt="" class="pay_img2"></a>                                     <!-- styling -->
            <a href="https://www.visaeurope.ch" target="blank"><img src="../images/Visa.png" alt="" class="pay_img2"></a>                                     <!-- styling -->
            <a href="https://bitcoin.org" target="blank"><img src="../images/Bitcoin.png" alt="" class="pay_img1"></a>                                     <!-- styling -->
         </div>
         <div class="col-md-6">
            <a href="order.php?user_id=<?php echo $user_id ?>"><h3 class="text-center mt-3">Pay Later</h3></a>
         </div>
      </div>
   </div>

</body>  