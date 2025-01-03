<?php
include 'config.php';
session_start();
if(isset($_POST['submit'])){
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $password = mysqli_real_escape_string($conn,md5($_POST['password']));
    $select_user = mysqli_query($conn,"SELECT * FROM `users` WHERE email = '$email' AND password = '$password';") or die('query failed');
    if(mysqli_num_rows($select_user)>0){
        $row = mysqli_fetch_assoc($select_user);
        $_SESSION['user_name'] = $row['name'];
        $_SESSION['user_email'] = $row['email'];
        $_SESSION['user_id'] = $row['id'];
        header('Location:home.php');
    }
    echo "<script>alert('failed');</script>";
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="CSS/register_login.css">
</head>
<body>
    <div class="container-box">
        <form action="" method="post">
            <h2>Login</h2>
            <input type="email" name="email" placeholder="enter your email" required class="box">
            <input type="password" name="password" placeholder="enter your password" required class="box">
            <input type="submit" value="login"  class="btn" name="submit" id="">
            <p>you don't have account? <a href="register.php">register now</a></p>
        </form>
    </div>
</body>
</html>