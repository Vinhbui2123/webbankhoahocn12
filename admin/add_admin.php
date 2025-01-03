<?php
include '../config.php';
session_start();
$admin_id = $_SESSION['admin_id'];
if (!isset($admin_id)) {
    header('Location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../CSS/register_login.css">
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
        <form action="processing/add_admin.php" method="post">
            <h2>Add admin</h2>
            <input type="text" name="name" placeholder="enter admin name" required class="box">
            <input type="email" name="email" placeholder="enter admin email" required class="box">
            <input type="password" name="password" placeholder="enter admin password" required class="box">
            <input type="password" name="cpassword" placeholder="confirm password" required class="box">
            <input type="number" name="level" placeholder="enter admin level 1-2" class="box" id="">
            <input type="submit" value="add" class="btn" name="submit" id="">
        </form>
    </div>
</body>

</html>