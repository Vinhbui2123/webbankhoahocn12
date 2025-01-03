<?php
include '../../config.php';
session_start();
$user_course_id = $_GET['user_course_id'];
$sql = "DELETE FROM `user_course` WHERE id = '$user_course_id ';";
mysqli_query($conn,$sql)or die('query failed');
header('Location:../admin_user_courses.php');
?>