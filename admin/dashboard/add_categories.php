<?php
include('../includes/connect.php');

if(isset($_POST['add_category'])){
   $category_title=sanitize($_POST['add_category_title']);
   //select data from database
   $select_query="SELECT * FROM `categories` WHERE `category_title`='$category_title'";
   $result_select=mysqli_query($con,$select_query);
   $number=mysqli_num_rows($result_select);
   if($number>0 || $category_title==''){
      include('../functions/fail_alert.php');
   }else{
      //insert data into database
      $insert_query="INSERT INTO `categories`(category_title) VALUES ('$category_title')";
      $result=mysqli_query($con,$insert_query);
      if($result){
         include('../functions/success_alert.php');
      }
    }
   }
?>
<h2 class="text-center pb-3">Add Categories</h2>
<form action="" method="post" class="mb-2">
   <div class="input-group w-50 m-auto mb-2">
      <span class="input-group-text bg-light" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
      <input type="text" class="form-control" name="add_category_title" placeholder="Add a Category" aria-label="categories" aria-describedby="basic-addon1" autocomplete="off">
   </div>
   <div class="input-group w-50 mb-2 m-auto">    
      <input type="submit" class="rounded bg-success text-light border-0 px-3 py-2 mt-3" name="add_category" value="Add Category">
   </div>
</form>