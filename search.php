<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Threads List | Forum</title>
  </head>
  <style>
    #result_container{
        margin-top:34px;
        min-height:80vh;
    }

  </style>
  <body>
<?php
session_start();
require 'components/_dbconnect.php';
require 'components/_navbar.php';

$query=$_GET['search'];
$sql="SELECT * FROM `thread` WHERE MATCH(thread_title,thread_description) AGAINST ('".$query."') ";
$result=mysqli_query($conn,$sql);
$num=mysqli_num_rows($result);

print '<div class="container mt-4">
<h2 >Showing results for  "<b>'.$query.'</b>":</h2>

<div id="result_container">';


if($num == 0){
  print '<h1 class="text-center">No results found for: <i>"'.$query.'"</i></h1>.';
}
else{
  while($thread=mysqli_fetch_assoc($result)){
    print '
    <div class="media">
    <img src="./images/defaultuser.jpg" width="50px" class="mr-3 my-1" alt="...">
  <div class="media-body my-2">
    <p style="margin-bottom:8px;"><b>Raman</b> at 12345678</p>
    <h4 class="mt-0 mb-1" style="margin-bottom:8px;">'.$thread['thread_title'].'</h4>
    '.$thread['thread_description'].'
  </div>
</div>
<hr>';
  }
}

print '</div>
</div>';
?>


<?php 
print '<hr>';
require 'components/_footer.php';
?>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>