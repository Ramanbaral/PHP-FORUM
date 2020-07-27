<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Join us Now</title>
</head>
<body>
    
    <!-- signup handler  -->
<?php
require 'components/_dbconnect.php';

$error=false;
$success=false;
if($_SERVER['REQUEST_METHOD']=="POST"){

  $fullname=$_POST['fullname'];
  $email=$_POST['email'];
  $password=$_POST['password'];
  $cpassword=$_POST['confirmpassword'];

  //check email already exists or not 
  $email_checking_sql="SELECT * FROM `users2059`  WHERE email='".$email."';";
  $result=mysqli_query($conn,$email_checking_sql);
  $num=mysqli_num_rows($result);

  if($num==0){
      if($password == $cpassword){
        $hashed_password=password_hash($password,PASSWORD_DEFAULT);
        $sql="INSERT INTO `users2059` (`id`, `email`, `fullname`, `password`, `timestamp`) VALUES (NULL, '".$email."', '".$fullname."', '".$hashed_password."', current_timestamp());";
        $result=mysqli_query($conn,$sql);

        if($result){
          $success="Your Account is successfully created.";
        }

      }
      else{
        $error="Password doesn't match!";
      }
  }
  else{
    $error="Email already exists. Email should be unique!";
  }
}

// ########################################## showing alert ##################################################
if($error){
print '
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Error!</strong>'.$error.'
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}

if($success){
  print '
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong>'.$success.'
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
}

?>

<h1 style="text-align:center;">Join us Now</h1>
<!-- ####################################### signup form ############################################### -->
<div class="container">
<form action="/php_forum/signup.php" method="POST">
  <div class="form-group">
    <label for="username">Full Name</label>
    <input type="text" class="form-control" id="username" name="fullname" required>
  </div>

  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email" name="email" required>
  </div>

  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="password" name="password" required>
  </div>
  <div class="form-group">
    <label for="confirmpassword">Confirm Password</label>
    <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" required>
  </div>

  <button type="submit" class="btn btn-outline-info " style="display:block;margin:auto;width:350px;margin-top:5px">Signup</button>
</form>
<span style="display:block;" class="mt-3 ">Already Have An Account? <a href="/php_forum/index.php">Login</a></span>
</div>
<!-- ####################################### signup form ############################################### -->


</body>
</html>