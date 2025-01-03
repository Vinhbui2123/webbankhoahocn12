<?php
include '../config.php';
session_start();
$admin_id = $_SESSION['admin_id'];
if (!isset($admin_id)) {
    header('Location:login.php');
}
if (isset($_POST['submit'])) {
    $user_id = $_POST['user_id'];

    // Delete related records first
    mysqli_query($conn, "DELETE FROM learning_progress WHERE user_id = '$user_id'") or die('learning_progress delete failed');
    mysqli_query($conn, "DELETE FROM course_cart WHERE user_id = '$user_id'") or die('course_cart delete failed');
    mysqli_query($conn, "DELETE FROM user_course WHERE user_id = '$user_id'") or die('user_course delete failed');

    // Then delete the user
    mysqli_query($conn, "DELETE FROM users WHERE id = '$user_id'") or die('users delete failed');
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
            <form action="" method="POST">
                <table>
                    <th>STT</th>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>chỉnh sửa</th>
                    <?php
                    $select_users = mysqli_query($conn, "SELECT * FROM `users`;") or die('query failed');
                    $number_rows = mysqli_num_rows($select_users);
                    $i = 0;
                    while ($i < $number_rows) {
                        $row = mysqli_fetch_assoc($select_users);
                        $i++;
                    ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row['id'] ?></td>
                            <td><?php echo $row['name'] ?></td>
                            <td><?php echo $row['email'] ?></td>
                            <input type="hidden" name="user_id" value="<?php echo $row['id'] ?>">
                            <td>
                                <input type="submit" name="submit" onclick="return confirm('delete this user?')" value="Xoá" class="btn btn-delete">
                            </td>
                        </tr>
                    <?php
                    };
                    ?>
                </table>
            </form>

        </section>
    </div>


    <script src="../js/admin_script.js"></script>

</body>

</html>