<?php
include '../config.php';
session_start();
$admin_id = $_SESSION['admin_id'];
if(!isset($admin_id)){
    header('Location:login.php');
}
if(isset($_POST['submit_edit_admin_info'])){
    $id_admin = $_POST['id_admin'];
    $name_admin = $_POST['name_admin'];
    $email_admin = $_POST['email_admin'];
    $password_admin = md5($_POST['password_admin']);
    $level_admin = $_POST['level'];
    $sql = "UPDATE `admin` SET 
        name_admin = '$name_admin',
        email_admin = '$email_admin',
        password_admin = '$password_admin',
        level = $level_admin
        WHERE id_admin = $id_admin;";

    mysqli_query($conn,$sql);
    header('Location:./admin_main.php');
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

    <div class="container-box">
        <form  method="post">
            <h2>Edit admin</h2>
            <?php
                if(isset($_GET['update_id'])){
                    $id_admin = $_GET['update_id'];
                    $sql = "SELECT * FROM `admin` WHERE id_admin = $id_admin;";
                    $selected = mysqli_query($conn,$sql);
                    while($selected_admin = mysqli_fetch_assoc($selected)){
            ?>          <input type="hidden" name="id_admin" value="<?php echo $selected_admin['id_admin']?>">
                        <input type="text" name="name_admin" value="<?php echo $selected_admin['name_admin']?>" placeholder="enter admin name" required class="box">
                        <input type="email" name="email_admin" value="<?php echo $selected_admin['email_admin']?>" placeholder="enter admin email" required class="box">
                        <input type="password" name="password_admin" value="<?php echo $selected_admin['password_admin']?>" placeholder="enter admin password" required class="box">
                        <input type="number" name="level" value="<?php echo $selected_admin['level']?>" placeholder="enter admin level 1-2"  class="box" id="">
            <?php
                }
            }
            ?>
            <input type="submit" value="Save"  class="btn" name="submit_edit_admin_info">
        </form>
    </div>
    <script src="../js/admin_script.js"></script>

</body>
</html>