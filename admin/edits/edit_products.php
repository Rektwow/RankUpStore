<?php
if(isset($_GET['edit_products'])){
   $edit_id=$_GET['edit_products'];
   $select_query="SELECT * FROM `products` WHERE product_id=$edit_id";
   $result=mysqli_query($con,$select_query);
   $row=mysqli_fetch_assoc($result);
   $product_title=$row['product_title'];
   $product_description=$row['product_description'];
   $product_keyword=$row['product_keyword'];
   $product_brand=$row['brand_id'];
   $product_category=$row['category_id'];
   $product_img_1=$row['product_img_1'];
   $product_img_2=$row['product_img_2'];
   $product_img_3=$row['product_img_3'];
   $product_price=$row['product_price'];
   $default_image="tbc.jpg";
   //fetch brand
   $select_brand="SELECT * FROM `brands` WHERE brand_id=$product_brand";
   $result_brand=mysqli_query($con,$select_brand);
   $row_brand=mysqli_fetch_assoc($result_brand);
   $brand_title=$row_brand['brand_title'];
   //fetch category
   $select_category="SELECT * FROM `categories` WHERE category_id=$product_category";
   $result_category=mysqli_query($con,$select_category);
   $row_category=mysqli_fetch_assoc($result_category);
   $category_title=$row_category['category_title'];

}
?>
<div class="container">
   <h2 class="text-center pb-3">Edit Product</h2>
   <form action="" method="post" enctype="multipart/form-data">
      <div class="form-outline text-dark fw-bold w-50 m-auto mb-3">
         <label for="product_title" class="form-label">Product title</label>
         <input type="text" id="product_title" name="product_title" class="form-control" value="<?php echo $product_title ?>">
      </div>
      <div class="form-outline text-dark fw-bold w-50 m-auto mb-3">
         <label for="product_description" class="form-label">Product description</label>
         <input type="text" id="product_description" name="product_description" class="form-control" value="<?php echo $product_description ?>">
      </div>
      <div class="form-outline text-dark fw-bold w-50 m-auto mb-3">
         <label for="product_keyword" class="form-label">Product keyword</label>
         <input type="text" id="product_keyword" name="product_keyword" class="form-control" value="<?php echo $product_keyword ?>">
      </div>
      <div class="form-outline text-dark fw-bold w-50 m-auto mb-3">
         <label for="product_brand" class="form-label">Product brand</label>
         <select name="product_brand" class="form-select">
            <option value="<?php echo $product_brand ?>"><?php echo $brand_title ?></option>
            <?php
               $select_brand_all="SELECT * FROM `brands`";
               $result_brand_all=mysqli_query($con,$select_brand_all);
               while($row_brand_all=mysqli_fetch_assoc($result_brand_all)){
                  $brand_title=$row_brand_all['brand_title'];
                  $brand_id=$row_brand_all['brand_id'];
                  echo "<option value='$brand_id'>$brand_title</option>";
               }
            ?> 
         </select>
      </div>
      <div class="form-outline text-dark fw-bold w-50 m-auto mb-3">
         <label for="product_category" class="form-label">Product category</label>
         <select name="product_category" class="form-select">
            <option value="<?php echo $product_category ?>"><?php echo $category_title ?></option>
            <?php
               $select_category_all="SELECT * FROM `categories`";
               $result_category_all=mysqli_query($con,$select_category_all);
               while($row_category_all=mysqli_fetch_assoc($result_category_all)){
                  $category_title=$row_category_all['category_title'];
                  $category_id=$row_category_all['category_id'];
                  echo "<option value='$category_id'>$category_title</option>";
               }
            ?> 
         </select>
      </div>
      <div class="form-outline text-dark fw-bold w-50 m-auto mb-3">
         <label for="product_img_1" class="form-label">Product image 1</label>
         <div class="d-flex">
            <input type="file" id="product_img_1" name="product_img_1" class="form-control">
            <img src="product_images/<?php if(!empty($product_img_1)){echo $product_img_1;}else{echo $default_image;} ?>" alt="" class="admin_img">
         </div>
      </div>
      <div class="form-outline text-dark fw-bold w-50 m-auto mb-3">
         <label for="product_img_2" class="form-label">Product image 2</label>
         <div class="d-flex">
            <input type="file" id="product_img_2" name="product_img_2" class="form-control">
            <img src="product_images/<?php if(!empty($product_img_2)){echo $product_img_2;}else{echo $default_image;} ?>" alt="" class="admin_img">
         </div>
      </div>
      <div class="form-outline text-dark fw-bold w-50 m-auto mb-3">
         <label for="product_img_3" class="form-label">Product image 3</label>
         <div class="d-flex">
            <input type="file" id="product_img_3" name="product_img_3" class="form-control">
            <img src="product_images/<?php if(!empty($product_img_3)){echo $product_img_3;}else{echo $default_image;} ?>" alt="" class="admin_img">
         </div>
      </div>
      <div class="form-outline text-dark fw-bold w-50 m-auto mb-3">
         <label for="product_price" class="form-label">Product price</label>
         <input type="text" id="product_price" name="product_price" class="form-control" value="<?php echo $product_price ?>">
      </div>
      <div class="form-outline mt-4 w-50 m-auto">
         <input type="submit" name="edit_product" class="btn btn-success mb-3 px-3" value="Update Product">
      </div>
   </form>
</div>
<?php
if(isset($_POST['edit_product'])){
   $product_title=sanitize($_POST['product_title']);
   $product_description=sanitize($_POST['product_description']);
   $product_keyword=sanitize($_POST['product_keyword']);
   $product_brand=$_POST['product_brand'];
   $product_category=$_POST['product_category'];
   $product_price=filter_var($_POST['product_price'] , FILTER_SANITIZE_NUMBER_INT);
   $product_img_1=$_FILES['product_img_1']['name'];
   $product_img_2=$_FILES['product_img_2']['name'];
   $product_img_3=$_FILES['product_img_3']['name'];
   $tmp_img_1=$_FILES['product_img_1']['tmp_name'];
   $tmp_img_2=$_FILES['product_img_2']['tmp_name'];
   $tmp_img_3=$_FILES['product_img_3']['tmp_name'];

   move_uploaded_file($tmp_img_1,"product_images/$product_img_1");
   move_uploaded_file($tmp_img_2,"product_images/$product_img_2");
   move_uploaded_file($tmp_img_3,"product_images/$product_img_3");

   //check for empty fields
   if($product_title=='' or $product_description=='' or  $product_keyword==''  or $product_price=='' or !filter_var($product_price, FILTER_VALIDATE_INT)){
      include('../functions/fail_alert.php');
   }
   else{
         if(empty($product_img_1)){
               //update query
               $update_query="UPDATE `products` SET product_title='$product_title', product_description='$product_description', product_keyword='$product_keyword', brand_id=$product_brand, category_id=$product_category,
               product_img_2='$product_img_2', product_img_3='$product_img_3', product_price='$product_price' WHERE product_id=$edit_id";
               $result_update=mysqli_query($con,$update_query);
               if($result_update){
                  header('Refresh:3 ; URL=index.php?view_products');
                  include('../functions/success_alert.php'); 
               }
         }elseif(empty($product_img_2)){
               //update query
               $update_query="UPDATE `products` SET product_title='$product_title', product_description='$product_description', product_keyword='$product_keyword', brand_id=$product_brand, category_id=$product_category,
               product_img_1='$product_img_1', product_img_3='$product_img_3', product_price='$product_price' WHERE product_id=$edit_id";
               $result_update=mysqli_query($con,$update_query);
               if($result_update){
                  header('Refresh:3 ; URL=index.php?view_products');
                  include('../functions/success_alert.php'); 
               }
         }elseif(empty($product_img_3)){
               //update query
               $update_query="UPDATE `products` SET product_title='$product_title', product_description='$product_description', product_keyword='$product_keyword', brand_id=$product_brand, category_id=$product_category,
               product_img_1='$product_img_1', product_img_2='$product_img_2', product_price='$product_price' WHERE product_id=$edit_id";
               $result_update=mysqli_query($con,$update_query);
               if($result_update){
                  header('Refresh:3 ; URL=index.php?view_products');
                  include('../functions/success_alert.php'); 
               }
         }elseif(empty($product_img_1) and empty($product_img_2)){
               //update query
               $update_query="UPDATE `products` SET product_title='$product_title', product_description='$product_description', product_keyword='$product_keyword', brand_id=$product_brand, category_id=$product_category,
               product_img_3='$product_img_3', product_price='$product_price' WHERE product_id=$edit_id";
               $result_update=mysqli_query($con,$update_query);
               if($result_update){
                  header('Refresh:3 ; URL=index.php?view_products');
                  include('../functions/success_alert.php'); 
               }
         }elseif(empty($product_img_1) and empty($product_img_3)){
               //update query
               $update_query="UPDATE `products` SET product_title='$product_title', product_description='$product_description', product_keyword='$product_keyword', brand_id=$product_brand, category_id=$product_category,
               product_img_2='$product_img_2', product_price='$product_price' WHERE product_id=$edit_id";
               $result_update=mysqli_query($con,$update_query);
               if($result_update){
                  header('Refresh:3 ; URL=index.php?view_products');
                  include('../functions/success_alert.php'); 
               }
         }elseif(empty($product_img_2) and empty($product_img_3)){
               //update query
               $update_query="UPDATE `products` SET product_title='$product_title', product_description='$product_description', product_keyword='$product_keyword', brand_id=$product_brand, category_id=$product_category,
               product_img_1='$product_img_1', product_price='$product_price' WHERE product_id=$edit_id";
               $result_update=mysqli_query($con,$update_query);
               if($result_update){
                  header('Refresh:3 ; URL=index.php?view_products');
                  include('../functions/success_alert.php'); 
               }
         }elseif(empty($product_img_1) and empty($product_img_2) and empty($product_img_3)){
               //update query
               $update_query="UPDATE `products` SET product_title='$product_title', product_description='$product_description', product_keyword='$product_keyword', brand_id=$product_brand, category_id=$product_category,
               product_price='$product_price' WHERE product_id=$edit_id";
               $result_update=mysqli_query($con,$update_query);
               if($result_update){
                  header('Refresh:3 ; URL=index.php?view_products');
                  include('../functions/success_alert.php'); 
               }
         }else{
               //update query
               $update_query="UPDATE `products` SET product_title='$product_title', product_description='$product_description', product_keyword='$product_keyword', brand_id=$product_brand, category_id=$product_category,
               product_img_1='$product_img_1', product_img_2='$product_img_2', product_img_3='$product_img_3', product_price='$product_price' WHERE product_id=$edit_id";
               $result_update=mysqli_query($con,$update_query);
               if($result_update){
                  header('Refresh:3 ; URL=index.php?view_products');
                  include('../functions/success_alert.php'); 
               }
         }
   }
}
?>