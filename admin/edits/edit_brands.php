<?php
if(isset($_GET['edit_brands'])){
   $edit_id=$_GET['edit_brands'];
   $select_query="SELECT * FROM `brands` WHERE brand_id=$edit_id";
   $result=mysqli_query($con,$select_query);
   $row=mysqli_fetch_assoc($result);
   $brand_title=$row['brand_title'];
}
if(isset($_POST['edit_brand'])){
   $title_brand=sanitize($_POST['brand_title']);

   if($title_brand==''){
      include('../functions/fail_alert.php');
   }else{
      $update_query="UPDATE `brands` SET brand_title='$title_brand' WHERE brand_id=$edit_id";
      $result_update=mysqli_query($con,$update_query);
       if($result_update){
         header('Refresh:3 ; URL=index.php?view_brands');
         include('../functions/success_alert.php'); 
         //echo "<script>window.open('index.php?view_brands','_self')</script>";
       }
   }
}   
?>
<div class="container">
   <h2 class="text-center pb-3">Edit Brands</h2>
   <form action="" method="post">
      <div class="form-outline text-dark fw-bold w-50 m-auto mb-3">
         <label for="brand_title" class="form-label">Brand title</label>
         <input type="text" id="brand_title" name="brand_title" class="form-control" value="<?php echo $brand_title ?>">
      </div>
      <div class="form-outline mt-4 w-50 m-auto">
         <input type="submit" name="edit_brand" class="btn btn-success mb-3 px-3" value="Update Brand">
      </div>
   </form>
</div>