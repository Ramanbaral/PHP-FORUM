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
  .jumbotron {
    padding: 1rem 2rem;
}
  </style>
  <body>
<!-- Handling comment to post in db  -->
<?php
session_start();
require 'components/_dbconnect.php';
$success=false;
//getting thread id
$id=$_GET['thread_id'];

if($_SERVER['REQUEST_METHOD']=="POST"){
  $comment=$_POST['comment'];
  //escaping < and > to protecting from xss
  $comment=str_replace('<','&lt;',$comment);
  $comment=str_replace('>','&gt;',$comment);
  
  $commentsql="INSERT INTO `comment` (`id`, `comment`, `thread_id`, `user_id`, `timestamp`) VALUES (NULL, '".$comment."', '".$id."','".$_SESSION['user_id']."', current_timestamp());";
  $making_query=mysqli_query($conn,$commentsql);
  if($making_query){
    $success="Your comment is posted successfully";
  }
}

?>
<?php
require 'components/_loginmodal.php';
require 'components/_navbar.php';
// showing success on posting comment 
if($success){
  print '
  <div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
  <strong>Success!</strong>'.$success.'
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
?>

<!-- ######################################## JUMBOTRON ################################################# -->
<?php

$sql="SELECT * FROM `thread` WHERE id=$id;";
$result=mysqli_query($conn,$sql);

while($thread=mysqli_fetch_assoc($result)){

  //fetching the name of user who posted this thread 
  $user_id=$thread['user_id'];
  $sql="SELECT * FROM `users2059` WHERE id=$user_id ;";
  $executing_query=mysqli_query($conn,$sql);
  $user=mysqli_fetch_assoc($executing_query);

print '
<div class="jumbotron">
  <h1 class="display-4">'.$thread['thread_title'].'</h1>
  <p class="lead">'.$thread['thread_description'].'</p>
  <hr class="my-4">
  <p>This is peer to peer forum for python.
  <pre>
  Forum Rules are below:-

  1.No spam. All automated messages, advertisements, and links to competitor websites will be deleted immediately.

  2.Post in relevant sub-forums only. Messages posted in the wrong topic area will be removed and placed in the correct sub-forum by moderators.

  3.Respect other users. No flaming or abusing fellow forum members. Users who continue to post inflammatory, abusive comments will be deleted from the forum after two warnings are issued by moderators.

  4.Harassment. No threats or harassment of other users will be tolerated. Any instance of threatening or harassing behavior is grounds for deletion from the forums.

  5.Adult content. No profanity or pornography is allowed. Posts containing adult material will be deleted.

  6.Illegal content. No re-posting of copyrighted materials or other illegal content is allowed. Any posts containing illegal content or copyrighted materials will be deleted. 
  </pre>
  </p>
  <p>Created By:<b> '.$user['fullname'].' </b>at '.$thread['timestamp'].'</p>
</div>';
}
?>
<!-- ######################################## JUMBOTRON ################################################# -->

<!-- ############################################ comment form ########################################## -->
<div class="container">

<h1 class="text-center">Post a comment:</h1>

<?php
if(isset($_SESSION['loggedin'])){
print '
<form action="'.$_SERVER['REQUEST_URI'].'" method="POST">
  <div class="form-group">
    <label for="description">Your Comment</label>
    <textarea class="form-control" id="description" name="comment" rows="3" style="height: 156px;" required=""></textarea>
  </div>

  <button type="submit" class="btn btn-info">Comment</button>
</form>';
}
else{
  print '<h2 class="my-3"><a href="/php_forum/index.php">Login </a> to <b>Post</b> the comment.</h2>';
}
?>

</div>
<!-- ############################################ comment form ########################################## -->

<h1 class="text-center">Disscussion:</h1>

<!-- ############################################ Comments ######################################### -->
<div class="container">

<?php
$comment_sql="SELECT * FROM `comment` WHERE thread_id=$id";
$query_result=mysqli_query($conn,$comment_sql);
$num=mysqli_num_rows($query_result);
if($num==0){
  print '<h2 class="my-4">No Commnets Be first one to post a comment.</h2>';
}

while($comment=mysqli_fetch_assoc($query_result)){
  //fetching the name of user who posted the comment
  $user_id=$comment['user_id'];
  $sql="SELECT * FROM `users2059` WHERE id=$user_id ;";
  $executing_query=mysqli_query($conn,$sql);
  $user=mysqli_fetch_assoc($executing_query);

  print '
  <div class="media">
<img src="./images/defaultuser.jpg" width="50px" class="mr-3" alt="...">
  <div class="media-body my-3">
    <h5 class="mt-0 mb-1" style="margin-bottom:8px;"><b>'.$user['fullname'].'</b> at '.$comment['timestamp'].'</h5>
    '.$comment['comment'].'
  </div>
</div>
<hr>';
}

?>
<!-- ############################################ Comments ######################################### -->



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