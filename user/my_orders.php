<?php
   $username=$_SESSION['username'];
   $get_user="SELECT * FROM `users` WHERE user_name='$username'";
   $result=mysqli_query($con,$get_user);
   $row_fetch=mysqli_fetch_assoc($result);
   $user_id=$row_fetch['user_id'];
   
   ?>
   <h3>All orders</h3>
   <div class="table-responsive">
   <table class="table tabled-bordered border-dark mt-3 table-responsive">
      <thead class="bg-secondary text-light">
         <tr class="text-center">
            <th>Order ID</th>
            <th>Invoice Nr</th>
            <th>Amount</th>
            <th>Order Date</th>
            <th>Order Status</th>
            <th>Confirmation</th>
         </tr>
      </thead>
      <tbody class="fw-bold">
            <?php
            $get_details="SELECT * FROM `orders` WHERE user_id=$user_id";
            $result_details=mysqli_query($con,$get_details);
            while($row_order=mysqli_fetch_assoc($result_details)){
               $order_id=$row_order['order_id'];
               $amount=$row_order['amount'];
               $invoice_nr=$row_order['invoice_nr'];
               $order_date=$row_order['order_date'];
               $order_status=$row_order['order_status'];
               if($order_status=='pending'){
                  $order_status='Pending';
               }else{
                  $order_status='Completed';
               }
               echo "<tr class='text-center'>
                        <td>$order_id</td>
                        <td>$invoice_nr</td>
                        <td>$amount</td>
                        <td>$order_date</td>
                        <td>$order_status</td>";
                        ?>
                        <?php
                        if($order_status=='Completed'){
                           echo "<td>Paid</td>";
                        }else{
                           echo "<td><a href='confirm_payment.php?order_id=$order_id' class='text-dark'>Confirm</a></td>
                              </tr>"; 
                        }
            }
            ?>

      </tbody>
   </table>
   </div>
