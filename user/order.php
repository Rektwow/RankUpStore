<?php
include('../includes/connect.php');
include('../functions/functions.php');

if(isset($_GET['user_id'])){
   $user_id=$_GET['user_id'];
}
$ip=getIPAddress();
//get total items and price

$get_name="SELECT * FROM `users` WHERE user_name='$username' OR user_id=$user_id";
$result_query=mysqli_query($con,$get_name);
$row_query=mysqli_fetch_assoc($result_query);
$user_id=$row_query['user_id'];                                                                                
$total_price=0;
$cart_query="SELECT * FROM `cart` where user_id=$user_id";                                            
$result_cart=mysqli_query($con,$cart_query);
$invoice_nr=mt_rand();
$status='pending';
$count_products=mysqli_num_rows($result_cart);
while($row_price=mysqli_fetch_array($result_cart)){
   $product_id=$row_price['product_id'];
   $select_products="SELECT * FROM `products` where product_id=$product_id";   
   $result_products=mysqli_query($con,$select_products);
   while($row_products=mysqli_fetch_array($result_products)){
      $product_price=array($row_products['product_price']);
      $product_sum=array_sum($product_price);
      $total_price+=$product_sum;
   }
}

//getting quantity from cart
$get_cart="SELECT * FROM `cart`";
$run_cart=mysqli_query($con,$get_cart);
$get_quantity=mysqli_fetch_array($run_cart);
$quantity=$get_quantity['quantity'];
if($quantity==1){
   //$quantity=1;
   $subtotal=$total_price;
}else{
   $quantity=$quantity;
   $subtotal=$total_price*$quantity;
}

$insert_orders="INSERT INTO `orders` (user_id, amount, invoice_nr, total_products, order_date, order_status) VALUES ($user_id,$subtotal,$invoice_nr,$count_products,NOW(),'$status')";
$result_query=mysqli_query($con,$insert_orders);
if($result_query){
   echo "<script>alert('orders submitted')</script>";
   echo "<script>window.open('profile.php','_self')</script>";
}

//order pending

$insert_pending="INSERT INTO `pending` (user_id, invoice_nr, order_status) VALUES ($user_id, $invoice_nr,'$status')";
$result_pending=mysqli_query($con,$insert_pending);

//delete cart items
$empty_cart="DELETE FROM `cart` WHERE user_id=$user_id and ip_address='$ip'";
$result_delete=mysqli_query($con,$empty_cart);
?>
