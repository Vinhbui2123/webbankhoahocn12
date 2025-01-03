<?php
include 'config.php';
session_start();
$cart_id = $_GET['id'];
$user_id = $_SESSION['user_id'];
mysqli_query($conn,"DELETE FROM `course_cart` WHERE id = '$cart_id' AND user_id = $user_id;");
header('Location:cart.php');
?>