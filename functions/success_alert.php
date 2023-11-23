<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
   <script>
      //load DOM before script
      document.addEventListener("DOMContentLoaded",function(){
         swal({
            title:"<?php
                  error_reporting(0);
                  if ($_POST['add_brand']){
                     echo "Brand added successfully";
                  } elseif ($_POST['add_category']){
                     echo "Category added successfully!";
                  } elseif ($_POST['add_product']) {
                     echo "Product added successfully";
                  } elseif ($_POST['edit_brand']){
                     echo "Brand updated successfully";
                  } elseif ($_POST['edit_category']){
                     echo "Category updated successfully";
                  } elseif ($_POST['edit_product']) {
                     echo "Product updated successfully";
                  } elseif ($_GET['add_to_cart']){
                     echo "Product added successfully";
                  }
                  else {
                     return;
                  }
                  ?>",
            text:"<?php
                  error_reporting(0);
                  if ($_POST['add_brand']){
                     echo "Congratulations the brand has been added"; 
                  } elseif ($_POST['add_category']){
                     echo "Congratulations the category has been added";
                  } elseif ($_POST['add_product']){
                     echo "Congratulations the product has been added";
                  } elseif ($_POST['edit_brand']){
                     echo "Congratulations the brand has been updated";
                  } elseif ($_POST['edit_category']){
                     echo "Congratulations the category has been updated";
                  } elseif ($_POST['edit_product']) {
                     echo "Congratulations the product has been updated";
                  } elseif ($_GET['add_to_cart']){
                     echo "The product has been added to the cart";
                  }
                  else {
                     return;
                  }
                  ?>",
            icon: "success",
            button: "ok!",
         });
      });
   </script>

header('Refresh:3 ; URL=index.php?view_brands');
         include('../functions/success_alert.php'); 