<?php
include '../../config.php';
session_start();
if(isset($_POST['update_user_course'])){
    $user_course_id = $_POST['user_course_id'];
    $update_payment = $_POST['update_payment'];
    mysqli_query($conn,"UPDATE `user_course` SET payment_state = '$update_payment' WHERE id = '$user_course_id'");
    header('Location:../admin_user_courses.php');
}
?>