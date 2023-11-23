<?php
//include('includes/connect.php');

//sanitize
function sanitize($dirty){
   $step_1 = strip_tags($dirty); //removes tags 
   $step_2 = htmlspecialchars($step_1); //disable tags
   $clean = trim($step_2); //removes spaces left and right
   return $clean;
}

function sanitizePw($dirty){
   $step_1 = htmlspecialchars($dirty); //disable tags
   $clean = trim($step_1); //removes spaces left and right
   return $clean;
}

//display brands in sidenav
function callBrands(){
   global $con;
   //select data into database
   $select_brands= "SELECT * FROM `brands`";
   $res_brands= mysqli_query($con,$select_brands);
   //display data
   while($row_data=mysqli_fetch_assoc($res_brands)){
   $brand_title=$row_data['brand_title'];
   $brand_id=$row_data['brand_id'];
   echo "<li class='nav-item my-0'>
   <a href='index.php?brand=$brand_id' class='nav-link text-light'>$brand_title</a>
   </li>";
   }
}

//display categories in sidenav
function callCategories(){
   global $con;
   //select data into database
   $select_categories= "SELECT * FROM `categories`";
   $res_categories= mysqli_query($con,$select_categories);
   //display data
   while($row_data=mysqli_fetch_assoc($res_categories)){
   $category_title=$row_data['category_title'];
   $category_id=$row_data['category_id'];
   echo "<li class='nav-item my-0'>
   <a href='index.php?category=$category_id' class='nav-link text-light'>$category_title</a>
   </li>";
   }
}

//display 6 random ordered products in index.php
function callProducts(){
   global $con;
   //condition to check isset or not
   if(!isset($_GET['category'])){
   if(!isset($_GET['brand'])){
      $select_query="SELECT * FROM `products` ORDER BY rand() LIMIT 0,6";
      $result_query=mysqli_query($con,$select_query);
      while($row=mysqli_fetch_assoc($result_query)){
         $product_id=$row['product_id'];
         $product_title=$row['product_title'];
         $product_description=$row['product_description'];
         $product_img_1=$row['product_img_1'];
         $product_price=$row['product_price'];
         $brand_id=$row['brand_id'];
         $category_id=$row['category_id'];
         echo "<div class='col-md-4 mb-2 mt-4'>
         <div class='card'>
         <img src='admin/product_images/$product_img_1' class='card-img-top mt-3' alt='$product_title'>
         <div class='card-body'>
         <h5 class='card-title'>$product_title</h5>
         <p class='card-text'>Price: $product_price.--</p>
         <a href='index.php?add_to_cart=$product_id' class='btn btn-success'>Add to cart</a>
         <a href='index.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
         </div>
         </div>
         </div>";
      }
   }
   }
}

//displaying only the chosen brands
function getUniBrands(){
   global $con;
   //condition to check isset or not
   if(isset($_GET['brand'])){
      $brandId=$_GET['brand'];
      $select_query="SELECT * FROM `products` WHERE brand_id=$brandId LIMIT 0,6";
      $result_query=mysqli_query($con,$select_query);
      $row_num=mysqli_num_rows($result_query);
      if($row_num==0){
         echo "<h2 class='text-center mt-5'>This brand is out of stock</h2>";
      }
      while($row=mysqli_fetch_assoc($result_query)){
         $product_id=$row['product_id'];
         $product_title=$row['product_title'];
         $product_description=$row['product_description'];
         $product_img_1=$row['product_img_1'];
         $product_price=$row['product_price'];
         $brand_id=$row['brand_id'];
         $category_id=$row['category_id'];
         echo "<div class='col-md-4 mb-2 mt-4'>
         <div class='card'>
         <img src='admin/product_images/$product_img_1' class='card-img-top mt-3' alt='$product_title'>
         <div class='card-body'>
         <h5 class='card-title'>$product_title</h5>
         <p class='card-text'>Price: $product_price.--</p>
         <a href='index.php?add_to_cart=$product_id' class='btn btn-success'>Add to cart</a>
         <a href='index.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
         </div>
         </div>
         </div>";
      }
   }
}

//displaying only the chosen category
function getUniCategories(){
   global $con;
   //condition to check isset or not
   if(isset($_GET['category'])){
      $categoryId=$_GET['category'];
      $select_query="SELECT * FROM `products` WHERE category_id=$categoryId LIMIT 0,6";
      $result_query=mysqli_query($con,$select_query);
      $row_num=mysqli_num_rows($result_query);
      if($row_num==0){
         echo "<h2 class='text-center mt-5'>This category is out of stock</h2>";
      }
      while($row=mysqli_fetch_assoc($result_query)){
         $product_id=$row['product_id'];
         $product_title=$row['product_title'];
         $product_description=$row['product_description'];
         $product_img_1=$row['product_img_1'];
         $product_price=$row['product_price'];
         $brand_id=$row['brand_id'];
         $category_id=$row['category_id'];
         echo "<div class='col-md-4 mb-2 mt-4'>
         <div class='card'>
         <img src='admin/product_images/$product_img_1' class='card-img-top mt-3' alt='$product_title'>
         <div class='card-body'>
         <h5 class='card-title'>$product_title</h5>
         <p class='card-text'>Price: $product_price.--</p>
         <a href='index.php?add_to_cart=$product_id' class='btn btn-success'>Add to cart</a>
         <a href='index.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
         </div>
         </div>
         </div>";
      }
   }
}


//searching products using keywords in the searchbar
function searchProduct(){
   global $con;
   if(isset($_GET['product_data'])){
      $search_data_value=sanitize($_GET['search_data']);
      $search_query="SELECT * FROM `products` WHERE product_keyword LIKE '%$search_data_value%'";
      $result_query=mysqli_query($con,$search_query);
      $row_num=mysqli_num_rows($result_query);
      if($row_num==0){
         echo "<h2 class='text-center mt-5'>Sorry, no matches found for '$search_data_value' </h2>";
      }
      while($row=mysqli_fetch_assoc($result_query)){
         $product_id=$row['product_id'];
         $product_title=$row['product_title'];
         $product_description=$row['product_description'];
         $product_img_1=$row['product_img_1'];
         $product_price=$row['product_price'];
         $brand_id=$row['brand_id'];
         $category_id=$row['category_id'];
         echo "<div class='col-md-4 mb-2 mt-4'>
         <div class='card'>
         <img src='admin/product_images/$product_img_1' class='card-img-top mt-3' alt='$product_title'>
         <div class='card-body'>
         <h5 class='card-title'>$product_title</h5>
         <p class='card-text'>Price: $product_price.--</p>
         <a href='index.php?add_to_cart=$product_id' class='btn btn-success'>Add to cart</a>
         <a href='index.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
         </div>
         </div>
         </div>";
      }
   }   
}

//view details
function view_details(){
   global $con;
   //condition to check isset or not
   if(isset($_GET['product_id'])){
   if(!isset($_GET['category'])){
   if(!isset($_GET['brand'])){
      $product_id=$_GET['product_id'];
      $select_query="SELECT * FROM `products` WHERE product_id=$product_id";
      $result_query=mysqli_query($con,$select_query);
      while($row=mysqli_fetch_assoc($result_query)){
         $product_id=$row['product_id'];
         $product_title=$row['product_title'];
         $product_description=$row['product_description'];
         $product_img_1=$row['product_img_1'];
         $product_img_2=$row['product_img_2'];
         $product_img_3=$row['product_img_3'];
         $product_price=$row['product_price'];
         $brand_id=$row['brand_id'];
         $category_id=$row['category_id'];
         
         echo "<div class='col-md-4 mb-2 mt-4'>
         <div class='card'>
         <img src='admin/product_images/$product_img_1' class='card-img-top mt-3' alt='$product_title'>
         <div class='card-body'>
         <h5 class='card-title'>$product_title</h5>
         <p class='card-text'>Price: $product_price.--</p>
         <a href='index.php?add_to_cart=$product_id' class='btn btn-success'>Add to cart</a>
         <a href='index.php' class='btn btn-secondary'>Go back</a>
         </div>
         </div>
         </div>
         <div class='col-md-8 py-4'>
               <div class='row'>
                  <div class='col-md-12'>
                     
                  </div>
                  <div class='col-md-6'>
                     <div class='card py-2'>";
                     if (!empty($product_img_2)){
                        echo "<img src='admin/product_images/$product_img_2' class='card-img-top mt-3' alt='$product_title'>";
                     }else{
                        echo "<img src='images/tbc.jpg' class='card-img-top mt-3' alt='$product_title'>";
                     }
                  echo "</div>
                  </div>
                  <div class='col-md-6'>
                     <div class='card py-2'>"; 
                     if (!empty($product_img_3)){
                        echo "<img src='admin/product_images/$product_img_3' class='card-img-top mt-3' alt='$product_title'>";
                     }else{
                        echo "<img src='images/tbc.jpg' class='card-img-top mt-3' alt='$product_title'>";
                     }   
                  echo "</div>
                  </div>
                  <div class='col-md-12 m-auto pt-4 text-center'>
                     <div class='card py-2'>
                     <h5>Product Description</h5>
                     <p class='card-text'>$product_description</p>                  
                     </div>
                  </div>
               </div>
            </div>";
      }     
   }
   }
   }
}

//function to get user ip address
 function getIPAddress() {  
   //whether ip is from the share internet  
    if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
               $ip = $_SERVER['HTTP_CLIENT_IP'];  
       }  
   //whether ip is from the proxy  
   elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
               $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
    }  
//whether ip is from the remote address  
   else{  
            $ip = $_SERVER['REMOTE_ADDR'];  
    }  
    return $ip;  
}   

                                                               function getUserInfo(){

                                                                  global $con;
                                                                  $username=$_SESSION['username'];
                                                                  $get_name="SELECT * FROM `users` WHERE user_name='$username'";
                                                                  $result_query=mysqli_query($con,$get_name);
                                                                  $row_query=mysqli_fetch_assoc($result_query);
                                                                  $user_id=$row_query['user_id'];
                                                                  //echo "<div class='text-center'>$username</div>";
                                                                  //echo "<div class='text-center'>$user_id</div>";
                                                                  return $username;
                                                                  return $user_id;
                                                               }

//cart function
function cart(){
   if(isset($_GET['add_to_cart'])){
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
      }
      $get_product_id=$_GET['add_to_cart'];
      $select_query="SELECT * FROM `cart` WHERE user_id=$user_id AND product_id=$get_product_id";                                              //user_id instead of ip_address
      $result_query=mysqli_query($con,$select_query);
      $row_num=mysqli_num_rows($result_query);
      if($row_num>0){
         header('Refresh:1 ; URL=index.php');
         include('functions/fail_alert.php'); 
      }else{
         
         $insert_query="INSERT INTO `cart` (product_id,quantity,user_id,ip_address) VALUES ($get_product_id,1,$user_id,'$ip')";
         $result_query=mysqli_query($con,$insert_query);
         header('Refresh:1 ; URL=index.php');
         include('functions/success_alert.php'); 
      }
   }
}

//display item number in cart
function cart_item(){
   if(isset($_GET['add_to_cart'])){
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
      }
         $select_query="SELECT * FROM `cart` WHERE user_id=$user_id";                                                                             //user_id instead of ip_address
         $result_query=mysqli_query($con,$select_query);
         $row_num=mysqli_num_rows($result_query);
         echo $row_num;
      }else{
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
         }
            $select_query="SELECT * FROM `cart` WHERE user_id=$user_id";                                                                          //user_id instead of ip_address
            $result_query=mysqli_query($con,$select_query);
            $row_num=mysqli_num_rows($result_query);
            echo $row_num; 
      }
   }

//total price function
function cart_price(){
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
   }
   //echo "<div class='text-center'>$username</div>";
   //echo "<div class='text-center'>$user_id</div>";
   $total=0;                                                                                                                                   //stop cart from resting 
   $cart_query="SELECT * FROM `cart` WHERE user_id=$user_id AND ip_address='$ip'";                                                                                  //user_id instead of ip_address
   $result_query=mysqli_query($con,$cart_query);
   while($row=mysqli_fetch_array($result_query)){
      $product_id=$row['product_id'];
      $quantity=$row['quantity'];
      $select_product="SELECT * FROM `products` WHERE product_id=$product_id";
      $result_product=mysqli_query($con,$select_product);
      while($row_price=mysqli_fetch_array($result_product)){
         $product_price=$row_price['product_price'];
         $product_value=$product_price*$quantity;
         $total+=$product_value; 
      }
   }
   echo $total;
}

//get user order details
function order_details(){
   global $con;
   $username=$_SESSION['username'];
   $get_details="SELECT * FROM `users` WHERE user_name='$username'";
   $result_query=mysqli_query($con,$get_details);
   while($row_query=mysqli_fetch_array($result_query)){
      $user_id=$row_query['user_id'];
      if(!isset($_GET['my_orders'])){
         if(!isset($_GET['edit_account'])){
            if(!isset($_GET['delete_account'])){
               $get_orders="SELECT * FROM `orders` WHERE user_id=$user_id AND order_status='pending'";
               $result_orders=mysqli_query($con,$get_orders);
               $row_count=mysqli_num_rows($result_orders);
               if($row_count>0){
                  echo "<h3>You have <span>$row_count</span> pending orders</h3>
                        <a href='profile.php?my_orders' class='mt-4'>Order details</a>";
               }else{
                  echo "<h3>You have 0 pending orders</h3>
                  <a href='../index.php' class='mt-4'>Go Shopping</a>";
               }
            }
         }
      }
   }
}

function check_login($con){
   if(isset($_SESSION['adminname'])){
      $admin_check = $_SESSION['adminname'];
      $select_query = "SELECT * FROM `admins` WHERE admin_name='$admin_check' limit 1";
      $result = mysqli_query($con,$select_query);
      if($result && mysqli_num_rows($result) > 0){
         $login_check = mysqli_fetch_assoc($result);
         return $login_check;
      }
   }//redirect to login
   header("Location: admin_login.php");
   die;
}
?>

