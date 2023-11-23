<h2 class="text-center pb-3">All Payments</h2>
<form action="index.php/deletes?delete_payments=<?php $payment_id ?>" method="post">
<table class="table table-bordered">
   <thead class="bg-secondary text-light">
   <tr class="text-center">
            <th>payment ID</th>
            <th>Order ID</th>
            <th>Invoice Nr</th>
            <th>Amount</th>
            <th>payment Mode</th>
            <th>payment Date</th>
            <th>Delete</th>
         </tr>
   </thead>
   <tbody class="fw-bold">
      <?php
      $select_payments="SELECT * FROM `payments`";
      $result=mysqli_query($con,$select_payments);
      while($row=mysqli_fetch_assoc($result)){
         $payment_id=$row['payment_id'];
         $order_id=$row['order_id'];
         $invoice_nr=$row['invoice_nr'];
         $amount=$row['amount'];
         $payment_mode=$row['payment_mode'];
         $payment_date=$row['payment_date'];
      if($row==0){
         echo "<h3 class='text-center text-dark'>No payments</h3>";
      }else{   
         echo "<tr class='text-center align-middle'>
                  <td>$payment_id</td>
                  <td>$order_id</td>
                  <td>$invoice_nr</td>
                  <td>$amount.-</td>
                  <td>$payment_mode</td>
                  <td>$payment_date</td>
                  <td><button href='index.php/deletes?delete_payments=$payment_id' type='submit' name='delete' class='text-dark delete-me border-0' data-confirm='$invoice_nr' value='$payment_id'><i class='fa-solid fa-trash-can'></i></button></td>
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