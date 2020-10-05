<?php
    session_start();
    $error='';

    if(isset($_GET['logout'])){
        unset($_SESSION);
        setcookie("id","",time()-60*60);
    }
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
            
            $query = "SELECT id FROM users WHERE email = '".mysqli_real_escape_string($link,$_POST['email'])."'";

            $result = mysqli_query($link,$query);

            $row = mysqli_num_rows($result);
            if($row >0)
                $error = "Email already exists";
            else{
                
                $query1 = "INSERT INTO users (email,password) VALUES ('".mysqli_real_escape_string($link,$_POST['email'])."','".mysqli_real_escape_string($link,$_POST['pass'])."')";

                if(!mysqli_query($link,$query1))
                    echo "Could not sign up";
                else{
                    
                    $query = "UPDATE users SET password = '".md5(md5(mysqli_insert_id($link)).$_POST['pass'])."' WHERE id = ".mysqli_insert_id($link)."";
                    
                    mysqli_query($link,$query);
                    
                    $_SESSION['id']=$_POST['email'];
                    
                     
                    if($_POST['log']=='1')
                    {
                     setcookie("id",$_POST['email'],time() + 60*60*24*365);
                    }
                    header("Location: loggedin.php");
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
    <h1>Secret Dairy!</h1>
          
    <p><strong>Store your thoughts permanently and securely.</strong></p>
      
          
      <div><?php 
     if($error!="")
         echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';?></div>
          
<p>Interested? Sign up now</p>

<form method="post" id="signUpForm">

    <div class="form-group"><input type="email" class="form-control" name="email" placeholder="Your Email"></div>
    
    <div class="form-group"><input type="password" class="form-control" name="pass" placeholder="Your Password"></div>
    
    <div class="form-group"><input type="checkbox"  name="log" value="1"> Stay logged in</div>
    
    <div class="form-group"><input type="hidden" name="signup" value="1"></div>
    
    <div class="form-group"><input type="submit" value="Sign up" class="btn btn-primary"></div>


<p>Already have an account? <a href="login.php" id="showLoginForm">Login here</a></p>
   </form>       
          

</div>
  
<?php include("footer.php"); ?>

</body>
</html>


