<?php
if($_SERVER['REQUEST_METHOD']=="POST")
{
require 'components/_dbconnect.php';

    $email=$_POST['email'];
    $password=$_POST['password'];


    // $sql="SELECT * FROM `users2059` WHERE email='".$email."' AND password='".$password."';";
    $sql="SELECT * FROM `users2059` WHERE email='".$email."';";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_num_rows($result);

    if($row == 1){
        $user=mysqli_fetch_assoc($result);
        $fullname=$user['fullname'];
        $user_id=$user['id'];
        $hashed_password=$user['password'];

        if(password_verify($password,$hashed_password)){
            session_start();

            $_SESSION['loggedin']=true;
            $_SESSION['email']=$email;
            $_SESSION['fullname']=$fullname;
            $_SESSION['user_id']=$user_id;

            print $_SESSION['loggedin'];
            print $_SESSION['email'];
            print $_SESSION['fullname'];
            print $_SESSION['user_id'];

            header("location: /php_forum/index.php");
        }

        else{
            $error="Wrong password!";
            header("location: /php_forum/index.php?error=true");
        }
    }
    else{
        $error="Invalid creadeantials";
        header("location: /php_forum/index.php?error=true");
    }

}
else{
    print "404 Page Not Found";
}

?>