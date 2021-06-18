<?php
session_start();
echo '
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php">Hmm!</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/forums/index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
      </li>
    </ul>
    
    <form class="form-inline my-2 my-lg-0">
    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-success" type="submit">Search</button>
    </form>';
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
      echo'<p class="text-light mx-1 my-0">Welcome '.$_SESSION['username'].'</p>
    <a href="/forums/_partials/logout.php" role="button" class="btn btn-outline-success mx-1 text-light">Logout</a>';
  }
    else {
      echo'
    <buttton class="btn btn-outline-success mx-2 my-sm-0" data-toggle="modal" data-target="#loginModal" type="button">Log In</buttton>
    <buttton class="btn btn-outline-success my-2 my-sm-0" data-toggle="modal" data-target="#signupModal">SignUp</buttton>
  ';}
  echo'</div>
</nav>';

include "_partials/login.php";
include "_partials/signup.php";
if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']=="true"){
  echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
  <strong>Success!</strong> You have successfully signup. Now you can login.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']=="false"){
  if($_GET['error']=='username already avilable'){
    echo'<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
  <strong>Failed to sign up !!</strong>  username already exists!!
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
 </div>';

  }
  if($_GET['error']=='Password did not match'){
    echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
  <strong>Failed to sign up !!</strong>  Password did not match!!
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
  }
}

if(isset($_GET['logout']) && $_GET['logout']=="success"){
    echo'<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
  <strong>Logged Out!!</strong>   You have Successfully Logged Out.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
 </div>';
}
if(isset($_GET['error']) && $_GET['error']=="unable to login!! Wrong Password.."){
  echo'<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
  <strong>Unable to login!!</strong>    Wrong Password..
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
 </div>';
}
if(isset($_GET['error2']) && $_GET['error2']=="user not found"){
  echo'<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
  <strong>Unable to login!!</strong>    User not found..
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
 </div>';
}
?>