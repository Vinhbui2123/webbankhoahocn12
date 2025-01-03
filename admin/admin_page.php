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

    <div class="main">
        <section class="admin_table">
            <table>
                <th>Số học viên</th>
                <th>Số admin</th>
                <th>Số khoá học</th>
                <th>Tổng doanh thu</th>
                <th>Đơn hàng chờ xử lý</th>
                <tr>
                    <td>
                        <?php
                        $select_user = mysqli_query($conn, "SELECT * FROM `users`;") or die('query failed');
                        $number_rows = mysqli_num_rows($select_user);
                        echo $number_rows
                        ?>
                    </td>
                    <td>
                        <?php
                        $select_user = mysqli_query($conn, "SELECT * FROM `admin`;") or die('query failed');
                        $number_rows = mysqli_num_rows($select_user);
                        echo $number_rows
                        ?>
                    </td>
                    <td>
                        <?php
                        $select_user = mysqli_query($conn, "SELECT * FROM `courses`;") or die('query failed');
                        $number_rows = mysqli_num_rows($select_user);
                        echo $number_rows
                        ?>
                    </td>
                    <td>
                        <?php
                        $total_money_query = "SELECT SUM(price) as total FROM user_course us 
                        INNER JOIN courses c ON us.course_id = c.id 
                        WHERE payment_state = 'xong'";
                        $total_money = mysqli_query($conn, $total_money_query) or die('Query failed');
                        $row = mysqli_fetch_assoc($total_money);
                        $total = isset($row['total']) ? $row['total'] : 0;
                        echo number_format($total);
                        ?>
                    </td>

                    <td>
                        <?php
                        $select_orders = mysqli_query($conn, "SELECT * FROM `user_course` WHERE payment_state = 'chưa';") or die('query failed');
                        $number_rows = mysqli_num_rows($select_orders);
                        echo $number_rows
                        ?>
                    </td>
                </tr>
            </table>
        </section>
    </div>



    <script src="../js/admin_script.js"></script>
</body>

</html>