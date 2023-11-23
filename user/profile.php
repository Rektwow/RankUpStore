<?php
include('../includes/connect.php');
include('../functions/functions.php');
include('../includes/header.php');
session_start();
?>

<body>
      
   <!-- Navbar -->
   <div class="container-fluid text-light p-0">
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark fs-5 text-light">
         <div class="container-fluid ms-2">
            <!-- Logo + nav -->         
            <img src="../images/Rank Up Logo.png" alt="Rank Up Store Logo Without Title" class="logo">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
               <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-2">
                  <li class="nav-item">
                     <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="#">About</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="#">Contact</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="profile.php">My Account</a>
                  </li>
                  <?php
                     if(!isset($_SESSION['username'])){
                        echo "<li class='nav-item'>
                                 <a class='nav-link' href='user_login.php'>Login</a>
                              </li>";
                     }else{
                        echo "<li class='nav-item'>
                              <a class='nav-link' href='logout.php'>Logout</a>
                              </li>";
                     }
                  ?>
               </ul> 
               <!-- Search bar -->   
               <form class="d-flex mx-auto col-lg-5" action="../index.php" method="get">
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
                        <a class="nav-link" href="../cart.php"><i class="fa-solid fa-cart-arrow-down"></i><sup><?php cart_item(); ?></sup></a>
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
         <p class="text-center">E-commerce isn't the cherry on the cake, it's the new cake.</p>
      </div>
      <!-- Body -->  
         <div class="row text-dark">
         <div class="col-lg-2 bg-dark py-2 ps-4 mb-2 rounded col-md-4">
            <!-- sidenav select brands and categories -->
            <ul class="navbar-nav me-auto text-center mb-4">
               <li class="nav-item bg-light rounded mb-3 mt-2">
                  <a href="#" class="nav-link text-dark"><h2>Your profile</h2></a>
               </li>
               <?php
               $username=$_SESSION['username'];
               $user_image="SELECT * FROM `users` WHERE user_name='$username'";
               $user_image=mysqli_query($con,$user_image);
               $row_image=mysqli_fetch_array($user_image);
               $user_image=$row_image['user_img'];
               $default_image="../images/default.png";
               if (!empty($user_image)){
                  echo "<li class='nav-item mb-3 mt-2'>
                  <img src='user_images/$user_image' alt='' class='profile_img'>
                  </li>";
               }else{
                  echo "<li class='nav-item mb-3 mt-2'>
                        <img src='../images/$default_image' alt='' class='profile_img'>
                        </li>";
               }
               ?>
               <li class="nav-item bg-light rounded mb-3 mt-2 w-75 m-auto">
                  <a href="profile.php" class="nav-link text-dark">Pending orders</a>
               </li>
               <li class="nav-item bg-light rounded mb-3 mt-2 w-75 m-auto">
                  <a href="profile.php?my_orders" class="nav-link text-dark">My orders</a>
               </li>
               <li class="nav-item bg-light rounded mb-3 mt-2 w-75 m-auto">
                  <a href="profile.php?edit_account" class="nav-link text-dark">Edit account</a>
               </li>
               <li class="nav-item bg-light rounded mb-3 mt-2 w-75 m-auto">
                  <a href="profile.php?delete_account" class="nav-link text-dark">Delete account</a>
               </li>
               <li class="nav-item bg-light rounded mb-3 mt-2 w-75 m-auto">
                  <a href="logout.php" class="nav-link text-dark">Logout</a>
               </li>
            </ul>
      </div>
      <div class="col-lg-10 d-flex justify-content-center align-items-center flex-column col-md-8 table-responsive">
         <?php 
         order_details();
         if(isset($_GET['edit_account'])){
            include('edit_account.php');
         }
         if(isset($_GET['my_orders'])){
            include('my_orders.php');
         }
         if(isset($_GET['delete_account'])){
            include('delete_account.php');
         }
         ?>
      </div>               











   </div>
<!-- Footer -->
<?php
   include("../includes/footer.php")
?>