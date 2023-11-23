<h2 class="text-center pb-3">All users</h2>
<form action="index.php/deletes?delete_users=<?php $user_id ?>" method="post">
<table class="table table-bordered">
   <thead class="bg-secondary text-light">
   <tr class="text-center">
            <th>User ID</th>
            <th>User Name</th>
            <th>User Email</th>
            <th>User Image</th>
            <th>User Address</th>
            <th>User Phone</th>
            <th>Delete</th>
         </tr>
   </thead>
   <tbody class="fw-bold">
      <?php
      $select_user="SELECT * FROM `users`";
      $result=mysqli_query($con,$select_user);
      while($row=mysqli_fetch_assoc($result)){
         $user_id=$row['user_id'];
         $user_name=$row['user_name'];
         $user_email=$row['user_email'];
         $user_img=$row['user_img'];
         $user_address=$row['user_address'];
         $user_phone=$row['user_phone'];
         echo "<tr class='text-center align-middle'>
                  <td>$user_id</td>
                  <td>$user_name</td>
                  <td>$user_email</td>
                  <td><img src='../user/user_images/$user_img' alt='' class='cart_img'></td>
                  <td>$user_address</td>
                  <td>$user_phone</td>
                  <td><button href='index.php/deletes?delete_users=$user_id' type='submit' name='delete' class='text-dark delete-me border-0' data-confirm='$user_name' value='$user_id'><i class='fa-solid fa-trash-can'></i></button></td>
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