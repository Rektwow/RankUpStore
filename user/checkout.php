<?php
include('../includes/connect.php');
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
                  <?php
                     if(!isset($_SESSION['username'])){
                        echo "<li class='nav-item'>
                                 <a class='nav-link' href='user/user_registration.php'>Register</a>
                              </li>";
                     }else{
                        echo "<li class='nav-item'>
                                 <a class='nav-link' href='profile.php'>My Account</a>               
                              </li>";
                     }
                  ?>
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
               <form class="d-flex mx-auto col-md-5" action="" method="get">
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
                  </ul>
               </nav>
            </div>
         </div>
      </nav>


      <!-- Title -->
      <div class="text-dark fw-bold">
         <h1 class="text-center">Rank Up Store</h1>
         <p class="text-center">Remember, every 'mistake' your customer makes, it's not because they're stupid. It's because your website sucks.</p>
      </div>
      <!-- Body -->  
      <div class="row text-dark">

      <!-- product -->
      <div class="col-md-12">
         <div class="row">
            <?php
            if(!isset($_SESSION['username'])){
               include('user_login.php');
            }else{
               include('payment.php');
            }
            ?>
         </div>
      </div>







   </div>
<!-- Footer -->
<?php
   include("../includes/footer.php")
?>