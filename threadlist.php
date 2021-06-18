<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Disscuss on topic</title>
</head>

<body>
    <?php
    include "_partials/header.php";
    
    
    ?>
    <div class="container my-4">
        <?php
        include "_partials/dbconnect.php";
        $cat = $_GET['catid'];
        $sql = "SELECT * FROM categories WHERE category_id=$cat";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $name = $row['category_name'];
            $des = $row['category_description'];

            echo "<div class='jumbotron'>
       <h1 class='display-4'>$name Questions & Answers</h1>
       <p class='lead'>$des</p>
       <hr class='my-4'>
       <p>FORUM Rules </p>
       <p>1. No Spam / Advertising / Self-promote in the forums.<br>
       2. Do not post copyright-infringing material.<br>3. Do not post “offensive” posts, links or images.
       <br>4. Do not cross post questions.<br>5. Do not PM users asking for help.<br>
       6. Remain respectful of other members at all times.
       </p>
       <a class='btn btn-success btn-lg' href='#' role='button'>Learn more</a>
       </div>";
        }
        ?>
        <?php
        $showalert=false;
        if($_SERVER['REQUEST_METHOD']=="POST"){
            $title=$_POST['title'];
            $desc=$_POST['desc'];
            $sql="INSERT INTO threads(thread_title,thread_desc,thread_cat_id) VALUES('$title','$desc','$cat')";
            $result=mysqli_query($conn,$sql);
            if($result){
                $showalert=true;
            }
        }
        if($showalert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!!</strong> Your Question has been added. Please wait for community to respond.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';}
        ?>
        <div class="container">
            <h1 class="text-center">Ask a Question</h1>
            <form method="post" action="<?php echo $_SERVER['REQUEST_URI']?>">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Question Title</label>
                    <input type="text" name="title" class="form-control" id="exampleFormControlInput1"
                        placeholder="Enter your question title here">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Question Description</label>
                    <textarea class="form-control" name="desc" id="exampleFormControlTextarea1"
                        placeholder="Enter your question description here" rows="3"></textarea>
                </div>
                <button class="btn btn-success" type="submit">Submit</button>
            </form>
        </div>
<hr>

        <?php
    // include "_partials/dbconnect.php";
    $noresult=true;
    $cat = $_GET['catid'];
    $sql = "SELECT * FROM threads WHERE thread_cat_id=$cat";
    $result = mysqli_query($conn, $sql);
    $num=mysqli_num_rows($result);
    if($num>0){
        $noresult=false;
    }
    while ($row = mysqli_fetch_assoc($result)) {
        $name = $row['thread_id'];
        $title = $row['thread_title'];
        $des = $row['thread_desc'];
        $thread_user_id=$row['thread_user_id'];
        $time=$row['timestamp'];
        
        $sql1="SELECT * FROM users WHERE user_id='$thread_user_id'";
        $result1=mysqli_query($conn,$sql1);
        $row1=mysqli_fetch_assoc($result1);
        $user_id=$row1['user_id'];
        echo "
         <div class='media px-2'>
 <img src='_img/userdefault.png' width='30px' class='mr-3' alt='...'>
 <div class='media-body'><p class='my-0'>Posted By: ".$row1['user_name']."  at $time</p>
   <h5 class='mt-0'><a class='text-dark' href='thread.php?thread_id=$name&user_id=$user_id'>Question Title:-  $title</a></h5>Description:- $des
 </div>
</div><hr>";
    }
    if($noresult){
        // echo"hiiii";
       echo" <div class='jumbotron jumbotron-fluid'>
      <div class='container'>
        <h1 class='display-4'> No Questions Found </h1>
        <p class='lead'>Be the First person to ask a Question</p>
      </div>
    </div>";
     }
    ?>
    
    </div>
    <?php include "_partials/footer.php" ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
</body>

</html>