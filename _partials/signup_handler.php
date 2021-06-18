<?php
    if($_SERVER['REQUEST_METHOD']=="POST"){
        include "dbconnect.php";
        $username=$_POST['username'];
        $password=$_POST['password'];
        $cpassword=$_POST['cpassword'];
        
    $sql="SELECT * FROM users WHERE user_name='$username'";
    $result=mysqli_query($conn,$sql);
    $num=mysqli_num_rows($result);
    if($num==0){
        if($password==$cpassword){
            $hash=password_hash($password,PASSWORD_DEFAULT);
            $sql2="INSERT INTO users(user_name,user_pass) VALUES('$username','$hash')";
            $result2=mysqli_query($conn,$sql2);
            $showalert=true;
            header("location: /forums/index.php?signupsuccess=true");
        }
        else{
            $showerror="Password did not match";
            header("location: /forums/index.php?signupsuccess=false&error=$showerror");
        }
    }
    else{
        $showerror2="username already avilable";
        header("location: /forums/index.php?signupsuccess=false&error=$showerror2");
    }
}

?>