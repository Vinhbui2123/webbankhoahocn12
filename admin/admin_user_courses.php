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
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.0/css/all.min.css">
    <link rel="stylesheet" href="../CSS/admin_style.css">
</head>

<body>
    <?php
    include 'admin_header.php';
    ?>
    <section class="admin_table">
        <div class="main">
            <table>
                <th>Tên</th>
                <th>Email</th>
                <th>Khoá học</th>
                <th>Giá</th>
                <th>Thanh toán</th>
                <th>Xoá</th>
                <th>Lưu</th>

                <?php
                $sql = "SELECT 
                u.name as user_name,
                u.id as user_id,
                u.email as user_email,
                c.name as course_name, 
                c.id as course_id,
                c.price as course_price, 
                uc.payment_state as user_course_payment,
                uc.id as user_course_id
                FROM `user_course` AS uc 
                INNER JOIN `courses` AS c 
                ON uc.course_id = c.id 
                INNER JOIN `users` AS u 
                ON uc.user_id = u.id 
                WHERE uc.payment_state = 'chưa';";
                $select_orders = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($select_orders)) {
                ?>
                    <tr>
                        <td><?php echo $row['user_name']; ?></td>
                        <td><?php echo $row['user_email']; ?></td>
                        <td><?php echo $row['course_name']; ?></td>
                        <td><?php echo number_format($row['course_price']); ?></td>
                        <form action="processing/save_user_course.php" method="POST">
                            <td>
                                <select name="update_payment" style="border:none;  color:black; padding:8px" id="">
                                    <option value="" selected disabled> <?php echo $row['user_course_payment'] ?></option>
                                    <option value="Chưa">Chưa</option>
                                    <option value="Xong">Xong</option>
                                </select>
                            </td>
                            <td>
                                <a href="processing/delete_user_course.php?user_course_id=<?php echo $row['user_course_id'] ?>" class="btn btn-delete" onclick="return confirm('Delete this course?');"> xoá</a>
                            </td>
                            <input type="hidden" name="user_course_id" value="<?php echo $row['user_course_id'] ?>">
                            <!-- <input type="hidden" name="" value="<?php echo $row['user_course_payment'] ?>"> -->
                            <td>
                                <input type="submit" name="update_user_course" class="btn btn-add" value="lưu">
                            </td>
                        </form>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>

    </section>

    <script src="../js/admin_script.js"></script>

</body>

</html>