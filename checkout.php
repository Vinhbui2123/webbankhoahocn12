<?php
include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM `course_cart` WHERE user_id = $user_id";
$select_course_cart = mysqli_query($conn,$sql) or die('query failed');
while($row = mysqli_fetch_assoc($select_course_cart)){
    mysqli_query($conn, "INSERT INTO `user_course` (user_id, course_id, payment_state) 
    VALUES ('{$row['user_id']}', '{$row['course_id']}','Chưa');") or die('Query failed');
    }
$sql1 = "DELETE FROM `course_cart` WHERE user_id = $user_id";
mysqli_query($conn,$sql1) or die('query failed');
echo '<script>alert("Yêu cầu thành công!"); window.location.href="home.php";</script>';
exit; 
?>