<?php

    session_start();

    if($_COOKIE['id']){
        
        $_SESSION['id'] = $_COOKIE['id'];
    }
 
   if($_SESSION['id'])
   {
       
       
       include("connection.php");
       
       $query = "SELECT tabcontent FROM users WHERE email = '".mysqli_real_escape_string($link,$_SESSION['id'])."'";
       
       $row = mysqli_fetch_array(mysqli_query($link,$query));
       
       $dairyContent = $row['tabcontent'];
       
       
   }else
   {
       header("Location: index.php");
   }
?>
<html>
<?php include("header.php"); ?>
    
    <nav class="navbar navbar-light bg-light fixed-top" style="text-align:center">
        <p class="navbar-brand"><b>MY DAIRY !</b></p>
  <form class="form-inline">
   
    <a class="btn btn-outline-success my-2 my-sm-0" type="submit" href="index.php?logout=1">Logout</a>
  </form>
</nav>
    
    <div class="container-fluid" >
    <textarea id = "dairy" class="form-control"><?php print_r($dairyContent) ?></textarea>
    
    </div>
<?php include("footer.php"); ?>


</html>

