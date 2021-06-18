<?php
if($_SERVER['REQUEST_METHOD']=="POST"){
    include "dbconnect.php";
    $user=$_POST['username'];
    $pass=$_POST['password'];
    $sql="SELECT * FROM users WHERE user_name='$user'";
    $result=mysqli_query($conn,$sql);
    $num=mysqli_num_rows($result);
    if($num==1){
        $row=mysqli_fetch_assoc($result);
        if(password_verify($pass,$row['user_pass'])){
            session_start();
            $_SESSION['loggedin']=true;
            $_SESSION['username']=$user;
            echo "logged in $user";
            header("location: /forums/index.php?login=true");
        }
        else{
            $loginerror="unable to login!! Wrong Password..";
            header("location: /forums/index.php?login=false&error=$loginerror");
        }
    }
    else{
    $loginerror2= "user not found";
    header("location: /forums/index.php?login=false&error2=$loginerror2");
    }
}

?>