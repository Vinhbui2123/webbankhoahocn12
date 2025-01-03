<?php
session_start();
include 'config.php';

// Validate user is logged in
if (!isset($_SESSION['user_id'])) {
  http_response_code(401);
  exit('Not logged in');
}

// Get POST data
$user_id = $_SESSION['user_id'];
$video_id = intval($_POST['video_id']);
$course_id = intval($_POST['course_id']);
$current_time = isset($_POST['current_time']) ? intval($_POST['current_time']) : 0;
$completed = isset($_POST['completed']) ? 1 : 0;

// Update progress
$sql = "INSERT INTO learning_progress 
        (user_id, course_id, video_id, watch_duration, completed) 
        VALUES (?, ?, ?, ?, ?)
        ON DUPLICATE KEY UPDATE 
        watch_duration = GREATEST(watch_duration, ?),
        completed = GREATEST(completed, ?),
        last_watched_time = CURRENT_TIMESTAMP";

$stmt = $conn->prepare($sql);
$stmt->bind_param(
  "iiiiiii",
  $user_id,
  $course_id,
  $video_id,
  $current_time,
  $completed,
  $current_time,
  $completed
);
$stmt->execute();
