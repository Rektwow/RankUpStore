<?php
include('../includes/connect.php');
include('../functions/functions.php');
//include('check.php');
session_start();
/*    if(!isset($_SESSION['adminname'])){
   header("Location: admin_login.php"); 
} */

$login_check = check_login($con);
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

   <!-- Navabr -->
   <div class="container-fluid text-light p-0">
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark fs-5 text-light">
         <div class="container-fluid ms-2">
            <!-- Logo -->   
            <img src="../images/Rank Up Logo.png" alt="Rank Up Store Logo Without Title" class="logo">
            <!-- Welcome + Login / Logout -->      
            <nav class="navbar navbar-expand-lg mx-4 fs-5">
               <ul class="navbar-nav">
               <?php
                     if(!isset($_SESSION['adminname'])){
                     echo "<li class='nav-item'>
                              <a class='nav-link' href='#'>Welcome Guest</a>
                           </li>";
                     }else{
                        echo "<li class='nav-item'>
                              <a class='nav-link' href='#'>Welcome ".$_SESSION['adminname']."</a>
                              </li>";
                     }
                  ?>  
                  <?php
                     if(!isset($_SESSION['adminname'])){
                        echo "<li class='nav-item'>
                                 <a class='nav-link' href='admin_login.php'>Login</a>
                              </li>";
                     }else{
                        echo "<li class='nav-item'>
                              <a class='nav-link' href='admin_logout.php'>Logout</a>
                              </li>";
                     }
                  ?>
                  <li class='nav-item'>
                    <a class='nav-link mx-5 px-5' href='admin_registration.php'>Register a new Admin</a>
                  </li>
               </ul>
            </nav>
         </div>
      </nav>
      <!-- Title -->     
      <div class="text-dark fw-bold">
         <h1 class="text-center">Rank Up Store</h1>
         <p class="text-center fs-4">Management</p>
      </div>
      <!-- Admin management -->   
      <div class="row">
         <div class="col-md-12 bg-dark p-5 mt-2 d-flex align-items-center justify-content-evenly">
            <div class="button text-center">
               <button class="rounded-3 p-0 ms-1 border-0"><a href="index.php?add_products" class="nav-link-dark btn btn-light btn-outline-secondary py-2 px-4 fs-5">Add Products</a></button>
               <button class="rounded-3 p-0 ms-1 border-0"><a href="index.php?view_products" class="nav-link-dark btn btn-light btn-outline-secondary py-2 px-4 fs-5">View Products</a></button>
               <button class="rounded-3 p-0 ms-1 border-0"><a href="index.php?add_brands" class="nav-link-dark btn btn-light btn-outline-secondary py-2 px-4 fs-5">Add Brands</a></button>
               <button class="rounded-3 p-0 ms-1 border-0"><a href="index.php?view_brands" class="nav-link-dark btn btn-light btn-outline-secondary py-2 px-4 fs-5">View Brands</a></button>
               <button class="rounded-3 p-0 ms-1 border-0"><a href="index.php?add_categories" class="nav-link-dark btn btn-light btn-outline-secondary py-2 px-4 fs-5">Add Categories</a></button>
               <button class="rounded-3 p-0 ms-1 border-0"><a href="index.php?view_categories" class="nav-link-dark btn btn-light btn-outline-secondary py-2 px-4 fs-5">View Categories</a></button>
               <button class="rounded-3 p-0 ms-1 border-0"><a href="index.php?users_list" class="nav-link-dark btn btn-light btn-outline-secondary py-2 px-4 fs-5">Users List</a></button>
               <button class="rounded-3 p-0 ms-1 border-0"><a href="index.php?orders_list" class="nav-link-dark btn btn-light btn-outline-secondary py-2 px-4 fs-5">Orders List</a></button>
               <button class="rounded-3 p-0 ms-1 border-0"><a href="index.php?payments_list" class="nav-link-dark btn btn-light btn-outline-secondary py-2 px-4 fs-5">Payments List</a></button>
            </div>
         </div>
      </div>
      <!-- add brand and categories inside index page -->
      <div class="container my-4">
         <?php 
         //PRODUCTS
            if(isset($_GET['add_products'])){
               include('dashboard/add_products.php');
            }
            if(isset($_GET['view_products'])){
               include('dashboard/view_products.php');
            }
            if(isset($_GET['edit_products'])){
               include('edits/edit_products.php');
            }
            if(isset($_GET['delete_products'])){
               include('deletes/delete_products.php');
            }
         //BRANDS
            if(isset($_GET['add_brands'])){
               include('dashboard/add_brands.php');
            }
            if(isset($_GET['view_brands'])){
               include('dashboard/view_brands.php');
            }
            if(isset($_GET['edit_brands'])){
               include('edits/edit_brands.php');
            }
            if(isset($_GET['delete_brands'])){
               include('deletes/delete_brands.php');
            }
         //CATEGORIES
            if(isset($_GET['add_categories'])){
               include('dashboard/add_categories.php');
            }
            if(isset($_GET['view_categories'])){
               include('dashboard/view_categories.php');
            }
            if(isset($_GET['edit_categories'])){
               include('edits/edit_categories.php');
            }
            if(isset($_GET['delete_categories'])){
               include('deletes/delete_categories.php');
            }
            //USERS
            if(isset($_GET['users_list'])){
               include('dashboard/users_list.php');
            }
            if(isset($_GET['delete_users'])){
               include('deletes/delete_users.php');
            } 
            //ORDERS
            if(isset($_GET['orders_list'])){
               include('dashboard/orders_list.php');
            }
            if(isset($_GET['delete_orders'])){
               include('deletes/delete_orders.php');
            }
            //PAYMENTS
            if(isset($_GET['payments_list'])){
               include('dashboard/payments_list.php');
            }
            if(isset($_GET['delete_payments'])){
               include('deletes/delete_payments.php');
            }
         ?>
      </div>
   </div>

   <!-- SCRIPTS -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
</body>
</html>