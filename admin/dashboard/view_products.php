<h2 class="text-center pb-3">All Products</h2>
<form action="index.php/deletes?delete_products=<?php $product_id ?>" method="post">
<table class="table table-bordered">
   <thead class="bg-secondary text-light">
   <tr class="text-center">
            <th>Product ID</th>
            <th>Product Title</th>
            <th>Product Image</th>
            <th>Product Price</th>
            <th>Edit</th>
            <th>Delete</th>
         </tr>
   </thead>
   <tbody class="fw-bold">
      <?php
      $select_product="SELECT * FROM `products`";
      $result=mysqli_query($con,$select_product);
      while($row=mysqli_fetch_assoc($result)){
         $product_id=$row['product_id'];
         $product_title=$row['product_title'];
         $product_img=$row['product_img_1'];
         $product_price=$row['product_price'];
         echo "<tr class='text-center align-middle'>
                  <td>$product_id</td>
                  <td>$product_title</td>
                  <td><img src='product_images/$product_img' alt='' class='cart_img'></td>
                  <td>$product_price.-</td>
                  <td><a href='index.php?edit_products=$product_id' class='text-dark'><i class='fa-solid fa-pen-to-square'></i></a></td>
                  <td><button href='index.php/deletes?delete_products=$product_id' type='submit' name='delete' class='text-dark delete-me border-0' data-confirm='$product_title' value='$product_id'><i class='fa-solid fa-trash-can'></i></button></td>
               </tr>";
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