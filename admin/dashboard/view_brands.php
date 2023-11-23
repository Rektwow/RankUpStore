<h2  class="text-center pb-3">All brands</h2>
<form action="index.php/deletes?delete_brands=<?php $brand_id ?>" method="post">
<table class="table table-bordered">
   <thead class="bg-secondary text-light">
   <tr class="text-center">
            <th>Brand ID</th>
            <th>Brand Title</th>
            <th>Edit</th>
            <th>Delete</th>
         </tr>
   </thead>
   <tbody class="fw-bold">
      <?php
      $select_brand="SELECT * FROM `brands`";
      $result=mysqli_query($con,$select_brand);
      while($row=mysqli_fetch_assoc($result)){
         $brand_id=$row['brand_id'];
         $brand_title=$row['brand_title'];
         echo "<tr class='text-center align-middle'>
                  <td>$brand_id</td>
                  <td>$brand_title</td>
                  <td><a href='index.php?edit_brands=$brand_id' class='text-dark'><i class='fa-solid fa-pen-to-square'></i></a></td>
                  <td><button href='index.php/deletes?delete_brands=$brand_id' type='submit' name='delete' class='text-dark delete-me border-0' data-confirm='$brand_title' value='$brand_id'><i class='fa-solid fa-trash-can'></i></button></td>
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
