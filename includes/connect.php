<?php
   $dbhost = "localhost";
   $dbuser = "root";
   $dbpass = "";      //add "root" here for mac users
   $dbname = "rank_up_db";
   //SQL connection
   $con= mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
   if(!$con){
      //shutdown if connection failed
      die(mysqli_error($con));
   }
?>