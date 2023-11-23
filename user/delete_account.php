<?php
$username=$_SESSION['username'];
if(isset($_POST['delete_account'])){
   $delete_query="DELETE FROM `users` WHERE user_name='$username'";
   $result=mysqli_query($con,$delete_query);
   if($result){
      session_destroy();
      echo "<script>alert('account deleted')</script>";
      echo "<script>window.open('../index.php','_self')</script>";
   }
}
if(isset($_POST['keep_account'])){
   echo "<script>window.open('profile.php','_self')</script>";
}
?>
<h3>Delete Account</h3>
   <form action="" method="post" class="mt-4">
      <div class="form-outline">
         <button type="submit" class="form-control mb-4 bg-danger text-light px-5 py-2 delete-me" name="delete_account" data-confirm='<?php echo $username ?>' value='<?php $username ?>'>Delete my account</button>
      </div>
      <div class="form-outline">
         <input type="submit" class="form-control bg-success text-light px-5 py-2" name="keep_account" value=" Keep my account ">
      </div>
   </form>
   <script>
     // Javascript: Gebe Confirm-Fenster mit Hinweis aus
     let deleteButtons = document.querySelectorAll('.delete-me');
     
     for (let i = 0; i < deleteButtons.length; i++) {
       deleteButtons[i].addEventListener('click', function(event) {
         let go = confirm('Do you really want to delete your account ' + this.getAttribute('data-confirm') + ' ? \nThis process is irreversible!');
         if (go == false) {
           event.preventDefault();
      		}
        });
      }
      </script>