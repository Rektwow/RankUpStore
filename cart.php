<?php
include('includes/connect.php');
include('functions/functions.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Rank Up Store</title>
   <!-- LINKS -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
   <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
   <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
   <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
   <link rel="manifest" href="favicon/site.webmanifest">
</head>
<body>
      
   <!-- Navbar -->
   <div class="container-fluid text-light p-0">
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark fs-5 text-light">
         <div class="container-fluid ms-2">
            <!-- Logo + nav -->         
            <img src="images/Rank Up Logo.png" alt="Rank Up Store Logo Without Title" class="logo">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
               <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-2">
                  <li class="nav-item">
                     <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="#">About</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="#">Contact</a>
                  </li>
                  <?php
                     if(!isset($_SESSION['username'])){
                        echo "<li class='nav-item'>
                                 <a class='nav-link' href='user/user_registration.php'>Register</a>
                              </li>";
                     }else{
                        echo "<li class='nav-item'>
                                 <a class='nav-link' href='user/profile.php'>My Account</a>               
                              </li>";
                     }
                  ?>
                  <?php
                     if(!isset($_SESSION['username'])){
                        echo "<li class='nav-item'>
                                 <a class='nav-link' href='user/user_login.php'>Login</a>
                              </li>";
                     }else{
                        echo "<li class='nav-item'>
                              <a class='nav-link' href='user/logout.php'>Logout</a>
                              </li>";
                     }
                  ?>   
               </ul> 
               <!-- Search bar -->   
               <form class="d-flex mx-auto col-md-5" action="index.php" method="get">
                  <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_data">
                  <input type="submit" value="Search" class="btn btn-outline-light" name="product_data">
               </form>
               <!-- Welcome + Login / Logout + Cart -->         
               <nav class="navbar navbar-expand-lg navbar-dark bg-dark mx-4 fs-5">
                  <ul class="navbar-nav me-auto">
                  <?php
                     if(!isset($_SESSION['username'])){
                     echo "<li class='nav-item'>
                              <a class='nav-link' href='#'>Welcome Guest</a>
                           </li>";
                     }else{
                        echo "<li class='nav-item'>
                              <a class='nav-link' href='#'>Welcome ".$_SESSION['username']."</a>
                              </li>";
                     }
                  ?>   
                     <li class="nav-item">
                        <a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-arrow-down"></i><sup><?php cart_item(); ?></sup></a>
                     </li>
                  </ul>
               </nav>
            </div>
         </div>
      </nav>
      <!-- calling cart function -->
      <?php
      cart();
      if(isset($_GET['product_data'])){
         searchProduct();
         //header('Location: index.php');
      }
      ?>
      <!-- Title -->
      <div class="text-dark fw-bold">
         <h1 class="text-center">Rank Up Store</h1>
         <p class="text-center">Wonder what your customer really wants? Ask. Don't tell.</p>
      </div>
      <!-- Body -->  
      <div class="container">
         <div class="row">
            <form action="" method="post">
               <div class="table-responsive">
            <table class="table table-bordered border-secondary text-center">

      <!-- code to display data -->
      <?php
         global $con;
         $ip=getIPAddress();
         if(!isset($_SESSION['username'])){
            $user_id=0;
         }else{
         $username=$_SESSION['username'];
         $get_name="SELECT * FROM `users` WHERE user_name='$username'";
         $result_query=mysqli_query($con,$get_name);
         $row_query=mysqli_fetch_assoc($result_query);
         $user_id=$row_query['user_id'];
         }                                                                                                                     //user_id instead of ip_address
         $total=0;
         $cart_query="SELECT * FROM `cart` WHERE user_id=$user_id";                                                                                  
         $result_query=mysqli_query($con,$cart_query);
         $count=mysqli_num_rows($result_query);
         if($count>0){
            echo "<thead>
                     <tr>
                        <th>Product Title</th>
                        <th>Product Image</th>
                        <th>Quantity</th>
                        <th>Price per Unit</th>
                        <th>Delete</th>
                        <th colspan='2'>Operations</th>
                     </tr>
                  </thead>
                  <tbody class='align-middle'>";
         while($row=mysqli_fetch_assoc($result_query)){
            $cart_id[]=$row['cart_id'];
            $product_id=$row['product_id'];
            $quantity=$row['quantity'];
            $select_product="SELECT * FROM `products` WHERE product_id=$product_id";
            $result_product=mysqli_query($con,$select_product);
            while($row_price=mysqli_fetch_assoc($result_product)){
               $product_price=$row_price['product_price'];
               //$price_table=$row_price['product_price'];
               $product_title=$row_price['product_title'];
               $product_img_1=$row_price['product_img_1']; 
/*                if(isset($_POST['cart_update'])){
                  $quantity=$_POST['quantity'];
                  //foreach($quantity as $qty){
                     $cart_update="UPDATE `cart` SET quantity='$quantity' WHERE product_id=$product_id and user_id=$user_id";    
                     //error_reporting(0);  
                     $result_quantity=mysqli_query($con,$cart_update); 
                     $product_value=$product_price*intval($quantity);
                     $total+=$product_value; 
                     //print_r($cart_update);
                     //}
                  }else{ */
                     /* $product_value=$product_price*$quantity;
                     $total+=$product_value; */
                  //} 
                  
                  if(isset($_POST['cart_update'])){
                     foreach($_POST['quantity'] as $key => $qty){
                  /*    echo "key ". $key;
                        echo "<br>";
                        echo "input quantity ". $qty;
                        echo "<br>";   */                     
                           $cart_update="UPDATE `cart` SET quantity='$qty' WHERE product_id=$product_id and user_id=$user_id";    
                           $result_quantity=mysqli_query($con,$cart_update);  
                           /* print_r($cart_update);
                           echo "<br>";  */
                        }
                           $product_value=$product_price*intval($qty);
                           $total+=$product_value; 
                     }else {
                        $product_value=$product_price*$quantity;
                        $total+=$product_value;
                     }
      ?>
      <tr>
         <td><?php echo $product_title ?></td>
         <td><img src="admin/product_images/<?php echo $product_img_1 ?>" alt="" class="cart_img"></td>
         <td><input type="text" name="quantity[]" class="form-input w-50 rounded border-1 text-center" value="<?php echo $quantity ?>"></td>   <!-- php code to change value -->
         <td><?php echo $product_price ?>.-</td>
         <td><input type="checkbox" name="removeitem[]" value="<?php echo $product_id ?>"></td>
         <td>
         <input type="submit" value="Update" class="btn btn-success px-3 mx-2" name="cart_update">
         <input type="submit" value="Remove" class="btn btn-danger px-3 mx-2" name="remove_cart">
         </td>
      </tr>
   <?php
}
   }
      }else{
         echo "<h2 class='text-center mt-5'>Your cart is empty</h2>";
      }
   ?>
               </tbody>
            </table>
            </div>
            <!-- total -->
            <div class="d-flex my-5">
               <?php
      if(!isset($_SESSION['username'])){
         $user_id=0;
      }else{
      $username=$_SESSION['username'];
      $get_name="SELECT * FROM `users` WHERE user_name='$username'";
      $result_query=mysqli_query($con,$get_name);
      $row_query=mysqli_fetch_assoc($result_query);
      $user_id=$row_query['user_id'];
      }                                                                                                                       //user_id instead of ip_address
                  $cart_query="SELECT * FROM `cart` WHERE user_id=$user_id";                                                                                  
                  $result_query=mysqli_query($con,$cart_query);
                  $count=mysqli_num_rows($result_query);
                  if($count>0){
                     echo "<h3 class='text-dark'>Total: <strong>$total.-</strong></h3>
                           <input type='submit' value='Continue Shopping' class='btn btn-success mx-2' name='continue_shopping'>
                           <button class='border-0'><a href='user/checkout.php' class='btn btn-secondary px-3 py-2'>Checkout</a></button>";
                  }else{
                     echo "<input type='submit' value='Continue Shopping' class='btn btn-success' name='continue_shopping'>";
                  }
                  if(isset($_POST['continue_shopping'])){
                     echo "<script>window.open('index.php','_self')</script>";
                  }
               ?>

            </div>
            </form>             
            <!-- function to remove item -->          
            <?php 
               function remove_items(){
                  global $con;
                  global $user_id;
                  error_reporting(0);
                  if(isset($_POST['remove_cart'])){
                     foreach($_POST['removeitem'] AS $remove_id){
                        echo $remove_id;
                        $delete_cart="DELETE FROM `cart` WHERE product_id=$remove_id and user_id=$user_id";
                        $result_delete=mysqli_query($con,$delete_cart);
                        if($result_delete){
                           echo "<script>window.open('cart.php','_self')</script>";
                        }
                     }
                  }
               }
               echo $remove_item=remove_items();
            ?>
         </div>
      </div>







   </div>
<!-- Footer -->
<?php
   include("includes/footer.php")
?>

