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
    include "_partials/header.php"
    ?>
    <div class="container my-4">
        <?php
        include "_partials/dbconnect.php";
        $cat = $_GET['thread_id'];
        $id=$_GET['user_id'];
        $sql = "SELECT * FROM threads WHERE thread_id=$cat";
        $result = mysqli_query($conn, $sql);

        $sql1 = "SELECT * FROM users WHERE user_id=$id";
        $result1 = mysqli_query($conn, $sql1);
        $row1=mysqli_fetch_assoc($result1);
        $user=$row1['user_name'];
        while ($row = mysqli_fetch_assoc($result)) {
            $title = $row['thread_title'];
            $des = $row['thread_desc'];
            echo "<div class='jumbotron'>
       <h1 class='display-4'>$title</h1>
       <p class='lead'>$des</p>
       <hr class='my-4'>
       <p><b>Posted By: $user</b></p>  
       </div>
       ";}
        ?>
        <?php
    if($_SERVER['REQUEST_METHOD']=="POST"){
        $comment=$_POST['comment'];
        $sql="INSERT INTO comments(comment_content,thread_id) VAlUES('$comment','$cat')";
        $result=mysqli_query($conn,$sql);
        if($result){
            $success=true;
        }
    }
    ?>
        <h2 class="my-4">Disscuss </h2>
        <form action="" method="post">
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Post a comment</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="comment"></textarea>
            </div>
            <button class="btn btn-success" type="submit">Submit</button>
        </form>
        <h2 class="my-4">Browse Answers</h2>
        <?php
    //query for selecting comments from database
    $sql="SELECT * FROM comments WHERE thread_id='$cat'";
    $result=mysqli_query($conn,$sql);
     
    //query for fetch users from database
    // $sql1="SELECT *  FROM users WHERE thread_id='$cat'";
    // $result2=mysqli_query($conn,$sql2);
    
    while($row=mysqli_fetch_assoc($result)){
        $comment=$row['comment_content'];
        $comment_by=$row['comment_by'];
        $sql2="SELECT * FROM users WHERE user_id='$comment'";
        $result2=mysqli_query($conn,$sql2);
        $row=mysqli_fetch_assoc($result2);
        $user=$row['user_name'];
        echo '<div class="media">
        <img src="_img/user_default.png" class="align-self-start mr-3" alt="..." width="30px">
        <div class="media-body">
          <h5 class="mt-0">'.$user.'</h5>
          <p>'.$comment.'</p>
          
        </div>
      </div>';
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