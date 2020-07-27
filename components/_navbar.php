<?php
require 'components/_dbconnect.php';
//########################################  NAVBAR  ##############################################
print '
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="/php_forum/index.php">We_Discuss</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">About</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Hot Topics
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">';

        $sql="SELECT id,topic_title FROM `topic` LIMIT 5;";
        $result=mysqli_query($conn,$sql);
        while($topic=mysqli_fetch_assoc($result)){
          $topic_id=$topic['id'];
          $topic_title=$topic['topic_title'];

          print '<a class="dropdown-item" href="/php_forum/threadslist.php?topic_id='.$topic_id.'">'.$topic_title.'</a>';
        }


        print'
        </div>
      </li>

    <li class="nav-item">
      <a class="nav-link" href="#">Contact</a>
    </li>

    </ul>

    <form class="form-inline my-2 my-lg-0" action="/php_forum/search.php" method="GET">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search">
      <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
    </form>

    <div class="row">';

    // session_start();
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
      print '<p class="text-light ml-4 my-0 mt-2">Welcome, '.$_SESSION['fullname'].'</p>
      <a href="/php_forum/logout.php" class="btn btn-outline-info ml-3 mx-3">logout</a>
      </div>
      </div>
    </nav>';
    }
    else{
    print '
    <a href="#" class="btn btn-outline-info ml-4 " data-toggle="modal" data-target="#loginmodal">Login</a>
    <a href="/php_forum/signup.php" class="btn btn-outline-info ml-1 mr-2">Sign Up</a>
    </div>
  </div>
</nav>';
}

?>