<?php
include '../config.php';
session_start();
$admin_id = $_SESSION['admin_id'];
if(!isset($admin_id)){
    header('Location:login.php');
}
if(isset($_POST['submit'])){
    $user_id = $_POST['user_id'];
    mysqli_query($conn,"DELETE FROM `users` WHERE id = '$user_id'") or die('query failed');
}

if(isset($_GET['delete_id'])){
    $id_admin = $_GET['delete_id'];
    mysqli_query($conn,"DELETE FROM `admin` WHERE id_admin = '$id_admin'") or die('query failed');
    header('Location:admin_main.php');

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.0/css/all.min.css">
    <link rel="stylesheet" href="../CSS/admin_style.css">
</head>
<body>
<?php
    include 'admin_header.php';
?>
<div class="main">
<section class="admin_table">
        <table>
            <th>STT</th>
            <th>ID</th>
            <th>Tên</th>
            <th>Email</th>
            <th>lever</th>
            <th>xoá</th>
            <th>sửa</th>
                <?php
                    $select_users = mysqli_query($conn,"SELECT * FROM `admin`") or die('query failed');
                    $number_rows = mysqli_num_rows($select_users);
                    $i = 0;
                    while($i < $number_rows){
                        $row = mysqli_fetch_assoc($select_users);
                        $i++;
                ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $row['id_admin'] ?></td>
                <td><?php echo $row['name_admin'] ?></td>
                <td><?php echo $row['email_admin'] ?></td>
                <td><?php echo $row['level'] ?></td>
                <input type="hidden" name="id_admin" value="<?php echo $row['id_admin']?>">
                <td>
                    <a href="admin_main.php?delete_id=<?php $id_admin = $row['id_admin']; echo $id_admin;?>"  name="delete_admin" onclick="return confirm('delete this user?')"  value="Xoá" class="btn btn-delete">Xoá</a>
                </td>
                <td>
                    <a href="./edit_admin_info.php?update_id=<?php $id_admin = $row['id_admin']; echo $id_admin;?>" name="update_admin"  value="Sửa" class="btn btn-delete">Sửa</a>
                </td>
            </tr>
                <?php
                    } ;
                ?>
        </table>
       <a href="./add_admin.php" class="btn btn-add" style="width:150px" >Thêm admin</a>
</section>
</div>



<script src="../js/admin_script.js"></script>

</body>
</html>