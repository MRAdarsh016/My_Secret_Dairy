<?php
session_start();
    $error='';
    if($_POST)
    {
       include("connection.php");
        
        if($_POST['email'] == "")
            $error.="Email is required<br>";
        
        if($_POST['pass'] == "")
            $error.="Password is required<br>";
        if($error){
            
            $error = "<p>There were error(s) in your form:</p>".$error;
        }else{
                    $query = "SELECT * FROM users WHERE email = '".mysqli_real_escape_string($link,$_POST['email'])."'";
                
                    $result1 = mysqli_query($link,$query);
              
                
    $row1 = mysqli_fetch_array($result1);
               
                if(isset($row1)){
                    $hp = md5(md5($row1['id']).$_POST['pass']);
                    
                    if($hp == $row1['password'])
                    {
                        $_SESSION['id']=$_POST['email'];
                    
                     
                    if($_POST['log']=='1')
                    {
                     setcookie("id",$_POST['email'],time() + 60*60*24*365);
                    }
                    header("Location: loggedin.php");
                    }else{
                        $error = "That email/password combination could not login";
                    }
                }
        }
    }
?>

 <!doctype html>
<html lang="en">   
    
<?php include("header.php"); ?>
    
 <body>   
      
      <div class="container" id="homePage"> 
    <h1>Sign In</h1>
          
    
      
          
      <div><?php 
     if($error!="")
         echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';?></div>
          


<form method="post" id="signUpForm">

    <div class="form-group"><input type="email" class="form-control" name="email" placeholder="Your Email"></div>
    
    <div class="form-group"><input type="password" class="form-control" name="pass" placeholder="Your Password"></div>
    
    <div class="form-group"><input type="checkbox"  name="log" value="1"> Stay logged in</div>
    
    <div class="form-group"><input type="hidden" name="signup" value="1"></div>
    
    <div class="form-group"><input type="submit" value="Log in" class="btn btn-primary"></div>


   </form>       
          

</div>
  
<?php include("footer.php"); ?>

</body>
</html>

