<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
   <script>
      //load DOM before script
      document.addEventListener("DOMContentLoaded",function(){
         swal({
            title:"<?php
                  error_reporting(0);
                  if ($_POST['add_brand']){
                     echo "Brand already exists or field is empty!";
                  } elseif ($_POST['add_category']){
                     echo "Category already exists or field is empty!";
                  } elseif ($_POST['add_product']) {
                     echo "Product already exists or fields are empty!";
                  } elseif ($_POST['edit_brand']){
                     echo "Brand failed to update";
                  } elseif ($_POST['edit_category']){
                     echo "Category failed to update";
                  } elseif ($_POST['edit_product']) {
                     echo "Product failed to update";
                  } elseif ($_GET['add_to_cart']){
                     echo "Product already added";
                  }
                  else {
                     return;
                  }
                  ?>",
            text:"<?php
                  error_reporting(0);
                  if ($_POST['add_brand']){
                     echo "Please choose a different brand title"; 
                  } elseif ($_POST['add_category']){
                     echo "Please choose a different category title";
                  } elseif ($_POST['add_product']){
                     echo "Please choose a different product title or fill out the missing fields";
                  } elseif ($_POST['edit_brand']){
                     echo "Please fill out the brand field";
                  } elseif ($_POST['edit_category']){
                     echo "Please fill out the category field";
                  } elseif ($_POST['edit_product']) {
                     echo "Please fill out the product field";
                  } elseif ($_GET['add_to_cart']){
                     echo "Product already exists in the cart";
                  }
                  else {
                     return;
                  }
                  ?>",
            icon: "error",
            button: "ok!",
         });
      });
   </script>

include('../functions/fail_alert.php');