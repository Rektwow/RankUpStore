<?php
if(isset($_GET['edit_categories'])){
   $edit_id=$_GET['edit_categories'];
   $select_query="SELECT * FROM `categories` WHERE category_id=$edit_id";
   $result=mysqli_query($con,$select_query);
   $row=mysqli_fetch_assoc($result);
   $category_title=$row['category_title'];
}
if(isset($_POST['edit_category'])){
   $title_category=sanitize($_POST['category_title']);

   if($title_category==''){
      include('../functions/fail_alert.php');
   }else{
      $update_query="UPDATE `categories` SET category_title='$title_category' WHERE category_id=$edit_id";
      $result_update=mysqli_query($con,$update_query);
       if($result_update){
          header('Refresh:3 ; URL=index.php?view_categories');
         include('../functions/success_alert.php'); 
         //echo "<script>window.open('index.php?view_categories','_self')</script>";
       }
   }
}   
?>
<div class="container">
   <h2 class="text-center pb-3">Edit Categories</h2>
   <form action="" method="post">
      <div class="form-outline text-dark fw-bold w-50 m-auto mb-3">
         <label for="category_title" class="form-label">Category title</label>
         <input type="text" id="category_title" name="category_title" class="form-control" value="<?php echo $category_title ?>">
      </div>
      <div class="form-outline mt-4 w-50 m-auto">
         <input type="submit" name="edit_category" class="btn btn-success mb-3 px-3" value="Update Category">
      </div>
   </form>
</div>