<?php

session_start();
 if($_POST['content'])
 {
     
     include("connection.php");
     $query = "UPDATE users SET tabcontent = '".mysqli_real_escape_string($link,$_POST['content'])."'WHERE email ='".mysqli_real_escape_string($link,$_SESSION['id'])."'"; 
     
    mysqli_query($link,$query);
 }

?>