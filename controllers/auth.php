<?php
include_once ("../config/dbconnect.php");
session_start();

if(isset($_POST['username'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM `admin` WHERE `username` ='$username' AND `password` ='$password'";

    $result=mysqli_query($conn, $sql);

    if(mysqli_num_rows($result)==1){
        $user = mysqli_fetch_assoc($result);
        $_SESSION['username']=$user['username'];
        header("Location: ../index.php");
    }else{
        header("Location: ../login.php?error");
    }
}
?>