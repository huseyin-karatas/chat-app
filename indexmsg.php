
<?php 
include('connect.php');
$users_connection_query = $baglan->query("SELECT * FROM users");
    $users_table = $users_connection_query->fetchAll(PDO::FETCH_ASSOC); 
    foreach($users_table as $users){?> 
    Username: <?php echo $users['username']; ?>

<?}
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
   <title>Login/register</title>
<style>
.colored-text {
      color: white; 
    }
</style>
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta charset="UTF-8">
   <link rel="stylesheet" type="text/css" href="message.css" />

</head>

<body>
   <div id="contain"><strong class="colored-text">Help/FAQ</strong></div>
   <div id="maintitle">
      <img src="icon.jpg" alt="" class="site-logo">
      <strong class="colored-text">Welcome to Student Messaging System </strong>
   </div>
   <div class="maindiv">
      <div class="login">
         <div class="title"> <strong><u>Log-in</u></strong> </div>
         <form class="b">
            
               <label style="font-size: 26px;">E-mail : </label><br>
               <input class="input" type="email" placeholder="Enter E-mail" name="e-mail" required> <br><br>
               <label style="font-size: 26px;">Password : </label><br>
               <input class="input" type="password" placeholder="Enter Password" name="password" required> <br><br>
               <button class="hover stitched" type="submit">Login</button>
               <p style="font-size: 20px;text-align:center;"> Forgot <a style="text-decoration: none;color: rgb(29, 29, 157);" href="#"> <strong>password?</strong></a> </p>
            
         </form>
      </div>   
      <div class="register">
         <h1 id="registertitle">Register</h1>
         <p id="registerprg"> Don't have an account? Register now!</p>
         <div class="stitchedreg-container">
  
            <button class="hover stitchedreg"><a href="register.html" target="_self" >Register</a></button>
         </div>	
      </div>
   </div>

</body>

</html>