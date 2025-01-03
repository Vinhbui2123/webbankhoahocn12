<?php
include 'config.php';

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, md5($_POST['password']));
    $cpassword = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
    if ($password == $cpassword) {
        $select_user = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('query failed');
        if (mysqli_num_rows($select_user) > 0) {
            echo "<script>alert('user already exist.');</script>";
        } else {
            mysqli_query($conn, "INSERT INTO `users`(name,email,password) VALUES('$name','$email','$password')") or die('query failed');
            echo "<script>alert('Register successful!');</script>";
            header('location:login.php');
        }
    } else {
        $message[] = 'password not matched!';
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="CSS/register_login.css">
</head>

<body>

    <?php
    if (isset($message)) {
        foreach ($message as $message) {
            echo "<script type=\"text/javascript\">" .
                "alert('$message');" .
                "</script>";
        }
    }
    ?>
    <div class="container-box">
        <form action="" method="post">
            <h2>Register</h2>
            <input type="text" name="name" placeholder="enter your name" required class="box">
            <input type="email" name="email" placeholder="enter your email" required class="box">
            <input type="password" name="password" placeholder="enter your password" required class="box">
            <input type="password" name="cpassword" placeholder="confirm password" required class="box">

            <input type="submit" value="register" class="btn" name="submit" id="">
            <p>you have account? <a href="login.php">login now</a></p>
        </form>
    </div>
</body>

</html>