<?php
$servername="localhost";
$username="root";
$password="";
$database="forums";

$conn=mysqli_connect($servername,$username,$password,$database);

if(!$conn){
    die("ERROR"."mysqli_error()");
}
?>