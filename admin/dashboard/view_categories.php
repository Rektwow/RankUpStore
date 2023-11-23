<h2  class="text-center pb-3">All Categories</h2>
<form action="index.php/deletes?delete_categories=<?php $category_id ?>" method="post">
<table class="table table-bordered">
   <thead class="bg-secondary text-light">
   <tr class="text-center">
            <th>Category ID</th>
            <th>Category Title</th>
            <th>Edit</th>
            <th>Delete</th>
         </tr>
   </thead>
   <tbody class="fw-bold">
      <?php
      $select_category="SELECT * FROM `categories`";
      $result=mysqli_query($con,$select_category);
      while($row=mysqli_fetch_assoc($result)){
         $category_id=$row['category_id'];
         $category_title=$row['category_title'];
         echo "<tr class='text-center align-middle'>
                <td>$category_id</td>
                <td>$category_title</td>
                <td><a href='index.php?edit_categories=$category_id' class='text-dark'><i class='fa-solid fa-pen-to-square'></i></a></td>
                <td><button href='index.php/deletes?delete_categories=$category_id' type='submit' name='delete' class='text-dark delete-me border-0' data-confirm='$category_title' value='$category_id'><i class='fa-solid fa-trash-can'></i></button></td>
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
      <!-- Modal -->
      <!-- <div class="modal fade text-dark" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-body">
              <h4>Are you sure you want to delete this category?</h4>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
              <button type="button" class="btn btn-danger"><a href="index.php/deletes?delete_categories=<?php //echo $category_id ?>" class="text-light text-decoration-none">Delete</a></button>
            </div>
          </div>
        </div>
      </div> -->