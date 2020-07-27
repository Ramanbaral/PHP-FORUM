<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Home | Forum</title>
  </head>
  <body>

<?php
session_start();
$error=false;
$success=false;
require 'components/_dbconnect.php';
require 'components/_navbar.php';

// ###################################### ALERTS #####################################################

//displaying alerts in login success or fail work on production server give notice in localhost

// $error=$_GET['error'];
// $success=$_GET['success'];
// if($error)
// {
//   print '
//   <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
//   <strong>Error!</strong>Invalid crendentials
//   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
//     <span aria-hidden="true">&times;</span>
//   </button>
// </div>';
// }
// if($success){
//   print '
//   <div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
//   <strong>Success!</strong>You are successfully logged in.
//   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
//     <span aria-hidden="true">&times;</span>
//   </button>
// </div>';
// }

// ###################################### ALERTS #####################################################





require 'components/_carousel.php';
?>

<h1 class="text-center mt-2" style="text-decoration:overline;"><strong> Forums</strong></h1>

<!-- ####################################  TOPICS CARDS   ############################################ -->
<div class="container">
<div class="row">
<?php
$sql="SELECT * FROM `topic`;";
$result=mysqli_query($conn,$sql);
while($topic=mysqli_fetch_assoc($result)){
  print '
  <div class="card mx-4  my-4" style="width: 20rem;">
  <img src="./images/py.jpg" class="card-img-top" alt="python">
  <div class="card-body">
    <h5 class="card-title">'.$topic['topic_title'].'</h5>
    <p class="card-text">'.$topic['topic_description'].'</p>
    <a href="/php_forum/threadslist.php?topic_id='.$topic['id'].'" class="btn btn-outline-info">Explore</a>
  </div>
</div>';
}

?>
</div>
</div>

<!-- ####################################  TOPICS CARDS   ############################################ -->



<?php 
print '<hr>';
require 'components/_loginmodal.php';
require 'components/_footer.php';
?>


    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>