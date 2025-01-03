<?php
include '../../config.php';
session_start();
if(isset($_POST['submit'])){
    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $password = mysqli_real_escape_string($conn,md5($_POST['password']));
    $cpassword = mysqli_real_escape_string($conn,md5($_POST['cpassword']));
    $level = mysqli_real_escape_string($conn,$_POST['level']);
    if($password == $cpassword){
        $selected_admin = mysqli_query($conn,"SELECT * FROM `admin` WHERE email_admin = '$email'") or die('query failed');
        if(mysqli_num_rows($selected_admin)>0){
            echo "<script>alert('user already exist.');</script>";
        }
        else{
            mysqli_query($conn,"INSERT INTO `admin`(name_admin,email_admin,password_admin,level) VALUES('$name','$email','$password','$level')") or die('query failed');
            echo "<script>alert('Register successful!');</script>";
            header('location:../admin_main.php');
        }
    }
    else{
        $message[] = 'password not matched!';
    }
}


?>