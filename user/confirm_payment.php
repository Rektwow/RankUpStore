<?php
include('../includes/connect.php');
include('../functions/functions.php');
include('../includes/header.php');
session_start();
if(isset($_GET['order_id'])){
   $order_id=$_GET['order_id'];
   $select_query="SELECT * FROM `orders` WHERE order_id=$order_id";
   $result=mysqli_query($con,$select_query);
   $row_fetch=mysqli_fetch_assoc($result);
   $invoice_nr=$row_fetch['invoice_nr'];
   $amount=$row_fetch['amount'];
}
if(isset($_POST['confirm_payment'])){
   $invoice_nr_p=sanitize($_POST['invoice_nr']);
   $amount_p=sanitize($_POST['amount']);
   $payment_mode=$_POST['payment_mode'];
   $insert_query="INSERT INTO `payments` (order_id, invoice_nr, amount, payment_mode, payment_date) VALUES ($order_id, $invoice_nr_p, $amount_p, '$payment_mode', NOW())";
   $result_query=mysqli_query($con,$insert_query);
   if($result_query){
      echo "<script>alert('payment success')</script>";
      echo "<script>window.open('profile.php','_self')</script>";
   }
$update_orders="UPDATE `orders` SET order_status='Completed' WHERE order_id=$order_id";
$result_orders=mysqli_query($con,$update_orders);
$update_pending="UPDATE `pending` SET order_status='Completed' WHERE order_id=$order_id";
$result_pending=mysqli_query($con,$update_pending);

}
?>

<body class="bg-dark">
   <div class="container my-5">
      <h3 class="text-center text-light">Confirm payment</h3>
      <form action="" method="post">
      <!-- <fieldset disabled> -->
         <div class="form-outline my-4 text-center">
            <label for="" class="text-light">Invoice Nr:</label>
            <input type="text" class="form-control w-25 m-auto" name="invoice_nr" value="<?php echo $invoice_nr ?>" readonly>
         </div>
         <div class="form-outline my-4 text-center">
            <label for="" class="text-light">Amount:</label>
            <input type="text" class="form-control w-25 m-auto" name="amount" value="<?php echo $amount ?>" readonly>
         </div>
      <!-- </fieldset> -->
         <div class="form-outline my-4 text-center">
            <label for="" class="text-light">Select a payment option</label>
            <select name="payment_mode" class="form-select w-25 m-auto">
               <option value="Paypal">Paypal</option>
               <option value="MasterCard">MasterCard</option>
               <option value="Visa">Visa</option>
               <option value="Bitcoin">Bitcoin</option>
            </select>
         </div>
         <div class="form-outline my-4 text-center">
            <input type="submit" class="btn btn-success" name="confirm_payment" value="Confirm">
         </div>
      </form>
   </div>
   
</body>
</html>