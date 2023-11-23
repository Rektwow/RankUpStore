<?php
if(isset($_POST['add_product'])){
   $product_title=sanitize($_POST['product_title']);
   $product_description=sanitize($_POST['product_description']);
   $product_keywords=sanitize($_POST['product_keywords']);
   $product_brand=$_POST['product_brand'];
   $product_category=$_POST['product_category'];
   $product_price=filter_var($_POST['product_price'] , FILTER_SANITIZE_NUMBER_INT);
   //image access
   $product_image_1=$_FILES['product_image_1']['name'];
   $product_image_2=$_FILES['product_image_2']['name'];
   $product_image_3=$_FILES['product_image_3']['name'];
   $tmp_image_1=$_FILES['product_image_1']['tmp_name'];
   $tmp_image_2=$_FILES['product_image_2']['tmp_name'];
   $tmp_image_3=$_FILES['product_image_3']['tmp_name'];
   //select data from database
   $select_query="SELECT * FROM `products` WHERE `product_title`='$product_title'";
   $result_select=mysqli_query($con,$select_query);
   $number=mysqli_num_rows($result_select);
   if($number>0 || $product_title=='' || $product_description=='' || $product_keywords=='' || $product_brand=='' || $product_category==''  || $product_price=='' || $product_image_1==''){
      include('../functions/fail_alert.php');
   }else{
      //insert images in upload folder
      move_uploaded_file($tmp_image_1,"product_images/$product_image_1");
      move_uploaded_file($tmp_image_2,"product_images/$product_image_2");
      move_uploaded_file($tmp_image_3,"product_images/$product_image_3");
      //insert data into database
      $insert_products="INSERT INTO `products`(product_title, product_description, product_keyword, brand_id, category_id, product_img_1, product_img_2, product_img_3, product_price, product_date) 
      VALUES ('$product_title','$product_description','$product_keywords','$product_brand','$product_category','$product_image_1','$product_image_2','$product_image_3','$product_price',NOW())";
      $result_query=mysqli_query($con,$insert_products);
      if ($result_query){
         include('../functions/success_alert.php');
      }
   }
}
?>


   <div class="container  fw-bold">
      <h2 class="text-center mt-3">Add Product</h2>
      <!-- form -->
      <form action="" method="post" enctype="multipart/form-data" class="text-dark">
         <div class="form-outline mb-4 w-50 m-auto">
            <label for="product_title" class="form-label">Product Title</label>
            <input type="text" name="product_title" id="product_title" class="form-control" placeholder="Enter Product Title" autocomplete="off">
         </div>
         <div class="form-outline mb-4 w-50 m-auto">
            <label for="product_description" class="form-label">Product Description</label>
            <input type="text" name="product_description" id="product_description" class="form-control" placeholder="Enter Product Description" autocomplete="off">
         </div>
         <div class="form-outline mb-4 w-50 m-auto">
            <label for="product_keywords" class="form-label">Product Keywords</label>
            <input type="text" name="product_keywords" id="product_keywords" class="form-control" placeholder="Enter Product Keywords" autocomplete="off">
         </div>
         <div class="form-outline mb-4 w-50 m-auto">
         <label for="product_brand" class="form-label">Select a brand</label>
            <select name="product_brand" id="" class="form-select">        
               <?php
                  //select data into database
                  $select_query="SELECT * FROM `brands`";
                  $result_query=mysqli_query($con,$select_query);
                  //display data 
                  while($row=mysqli_fetch_assoc($result_query)){
                     $brand_title=$row['brand_title'];
                     $brand_id=$row['brand_id'];
                     echo "<option value='$brand_id'>$brand_title</option>";
                  }
               ?>
            </select>
         </div>
         <div class="form-outline mb-4 w-50 m-auto">
         <label for="product_category" class="form-label">Select a Category</label>
            <select name="product_category" id="" class="form-select">
               <?php
                  //select data into database
                  $select_query="SELECT * FROM `categories`";
                  $result_query=mysqli_query($con,$select_query);
                  //display data 
                  while($row=mysqli_fetch_assoc($result_query)){
                     $category_title=$row['category_title'];
                     $category_id=$row['category_id'];
                     echo "<option value='$category_id'>$category_title</option>";
                  }
               ?>
            </select>
         </div>
         <div class="form-outline mb-4 w-50 m-auto">
            <label for="product_image_1" class="form-label">First Image</label>
            <input type="file" name="product_image_1" id="product_image_1" class="form-control">
         </div>
         <div class="form-outline mb-4 w-50 m-auto">
            <label for="product_image_2" class="form-label">Second Image</label>
            <input type="file" name="product_image_2" id="product_image_2" class="form-control">
         </div>
         <div class="form-outline mb-4 w-50 m-auto">
            <label for="product_image_3" class="form-label">Third Image (Optional)</label>
            <input type="file" name="product_image_3" id="product_image_3" class="form-control">
         </div>
         <div class="form-outline mb-4 w-50 m-auto">
            <label for="product_price" class="form-label">Product Price</label>
            <input type="number" min="1" step="any" name="product_price" id="product_price" class="form-control" placeholder="Enter Product Price" autocomplete="off">
         </div>
         <div class="form-outline mb-4 w-50 m-auto">
            <input type="submit" name="add_product" class="btn btn-success mb-3 px-3" value="Add Product">
         </div>
      </form>
   </div>

