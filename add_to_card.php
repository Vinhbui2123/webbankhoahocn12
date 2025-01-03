<?php 
include 'config.php';
session_start();
$id_user = $_SESSION['user_id'];
$id_course = $_GET['course_id'];

$check_course_exists = mysqli_query($conn, "SELECT id FROM `course_cart` WHERE user_id = $id_user AND course_id = $id_course") or die('Query failed');

if (mysqli_num_rows($check_course_exists) > 0) {
    echo '<script>alert("Bạn đã thêm khóa học này vào giỏ hàng trước đó!"); window.location.href="home.php";</script>';
    exit; 
} else {
    mysqli_query($conn, "INSERT INTO `course_cart`(`user_id`, `course_id`) VALUES ('$id_user', '$id_course')") or die('Query failed');
    header('Location: home.php'); 
    exit; 
}
?>
