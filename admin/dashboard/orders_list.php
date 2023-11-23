<h2 class="text-center pb-3">All Orders</h2>
<form action="index.php/deletes?delete_orders=<?php $order_id ?>" method="post">
<table class="table table-bordered">
   <thead class="bg-secondary text-light">
   <tr class="text-center">
            <th>Order ID</th>
            <th>User ID</th>
            <th>Amount</th>
            <th>Invoice Nr</th>
            <th>Order Date</th>
            <th>Status</th>
            <th>Delete</th>
         </tr>
   </thead>
   <tbody class="fw-bold">
      <?php
      $select_orders="SELECT * FROM `orders`";
      $result=mysqli_query($con,$select_orders);
      while($row=mysqli_fetch_assoc($result)){
         $order_id=$row['order_id'];
         $user_id=$row['user_id'];
         $amount=$row['amount'];
         $invoice_nr=$row['invoice_nr'];
         $order_date=$row['order_date'];
         $order_status=$row['order_status'];
      if($row==0){
         echo "<h3 class='text-center text-dark'>No orders</h3>";
      }else{   
         echo "<tr class='text-center align-middle'>
                  <td>$order_id</td>
                  <td>$user_id</td>
                  <td>$amount.-</td>
                  <td>$invoice_nr</td>
                  <td>$order_date</td>
                  <td>$order_status</td>
                  <td><button href='index.php/deletes?delete_orders=$order_id' type='submit' name='delete' class='text-dark delete-me border-0' data-confirm='$invoice_nr' value='$order_id'><i class='fa-solid fa-trash-can'></i></button></td>
               </tr>";
            }   
      }
      ?>
   </tbody>
</table>
</form>
   <script>
     // Javascript: Gebe Confirm-Fenster mit Hinweis aus
     let deleteButtons = document.querySelectorAll('.delete-me');
     
     for (let i = 0; i < deleteButtons.length; i++) {
       deleteButtons[i].addEventListener('click', function(event) {
         let go = confirm('Do you really want to delete ' + this.getAttribute('data-confirm') + ' ? \nThis process is irreversible!');
         if (go == false) {
           event.preventDefault();
      		}
        });
      }
      </script>