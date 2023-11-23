<?php
include('../includes/connect.php');

if(isset($_POST['add_brand'])){
   $brand_title=sanitize($_POST['add_brand_title']);
   //select data from database
   $select_query="SELECT * FROM `brands` WHERE `brand_title`='$brand_title'";
   $result_select=mysqli_query($con,$select_query);
   $number=mysqli_num_rows($result_select);
   if($number>0 || $brand_title==''){
      include('../functions/fail_alert.php');
   }else{
      //insert data into database
      $insert_query="INSERT INTO `brands`(brand_title) VALUES ('$brand_title')";
      $result=mysqli_query($con,$insert_query);
      if($result){
         include('../functions/success_alert.php'); 
      }
    }
   }
?>
<h2 class="text-center pb-3">Add Brands</h2>
<form action="" method="post" class="mb-2">
   <div class="input-group w-50 m-auto mb-2">
      <span class="input-group-text bg-light" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
      <input type="text" class="form-control" name="add_brand_title" placeholder="Add a Brand" aria-label="brands" aria-describedby="basic-addon1" autocomplete="off">
   </div>
   <div class="input-group w-50 mb-2 m-auto">    
      <input type="submit" class="rounded bg-success text-light border-0 px-3 py-2 mt-3" name="add_brand" value="Add Brand">
   </div>
</form>