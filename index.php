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
               <form class="d-flex mx-auto col-lg-5" action="" method="get">
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
                        <a class="nav-link" href="#">Total Price: <?php cart_price(); ?>.-</a>
                     </li>
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
      ?>
      <!-- Title -->
      <div class="text-dark fw-bold">
         <h1 class="text-center">Rank Up Store</h1>
         <p class="text-center">Remember, every 'mistake' your customer makes, it's not because they're stupid. It's because your website sucks.</p>
      </div>
      <!-- Body -->  
      <div class="row text-dark">
         <div class="col-lg-2 bg-dark py-2 ps-4 mb-2 rounded">
            <!-- sidenav select brands and categories -->
            <ul class="navbar-nav me-auto text-center mb-4">
               <li class="nav-item bg-light rounded mb-3 mt-2">
                  <a href="#" class="nav-link text-dark"><h2>Brands</h2></a>
               </li>
               <?php
                  /* call function to display brands*/
                  callBrands();
               ?>
            </ul>
            <ul class="navbar-nav me-auto text-center mb-4">
               <li class="nav-item bg-light rounded mb-3">
                  <a href="#" class="nav-link text-dark"><h2>Categories</h2></a>
               </li>
               <?php
                  /* call function to display categories*/
                  callCategories();
               ?>
            </ul>
      </div>
      <!-- product -->
      <div class="col-lg-10">
         <div class="row">
            <!-- fetching products -->
            <?php
               /* call function to display products*/
               if(isset($_GET['product_data'])){
                  searchProduct();
               }elseif(isset($_GET['product_id'])){
                  view_details();
               }else{
                  callProducts();
               }
               getUniCategories();
               getUniBrands();
            ?>
            
         </div>
      </div>
               <?php

                  if(isset($_SESSION['username'])){
                  getUserInfo();
                  }
                  

               ?>


   </div>
<!-- Footer -->
<?php
   include("includes/footer.php")
?>