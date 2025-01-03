<?php
include 'config.php';
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./CSS/study.css">
</head>

<body>
    <?php include 'header_study.php' ?>
    <div class="main21">
        <div class="video-title">
            <div class="video">
                <?php
                $course_id = isset($_GET['course_id']) ? intval($_GET['course_id']) : 0;
                if ($course_id > 0) {
                    $sql = '';
                    if (isset($_GET['video_id'])) {
                        $video_id = intval($_GET['video_id']);
                        $sql = "SELECT `video`, `title`, `description` FROM `course_videos` WHERE course_id = $course_id AND id = '$video_id';";
                    } else {
                        $sql = "SELECT `video`, `title`, `description` FROM `course_videos` WHERE course_id = $course_id limit 1";
                    }
                    $fetch_video = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($fetch_video) > 0) {
                        while ($row = mysqli_fetch_assoc($fetch_video)) {
                ?>
                            <video src="uploaded_video/<?php echo htmlspecialchars($row['video']); ?>" controls class="video-item"></video>
                            <h2 class="video-title"><?php echo htmlspecialchars($row['title']); ?></h2>

            </div>
        </div>
        <!-- Add this after the video and title -->
        <div class="video-description">
            <h3 class="description-title">Mô tả bài học</h3>
            <div class="description-content">
                <?php echo nl2br(htmlspecialchars($row['description'] ?? 'Chưa có mô tả cho bài học này.')); ?>
            </div>
        </div>
    </div>
<?php
                        }
                    }
                }
?>

<div class="list-video">
    <?php
    $course_id = isset($_GET['course_id']) ? intval($_GET['course_id']) : 0;
    if ($course_id > 0) {
        $sql = "SELECT * FROM `course_videos` WHERE course_id = $course_id";
        $fetch_video = mysqli_query($conn, $sql);
        if (mysqli_num_rows($fetch_video) > 0) {
            $i = 0;
            while ($row = mysqli_fetch_assoc($fetch_video)) {
                $progress_sql = "SELECT completed, watch_duration 
                               FROM learning_progress 
                               WHERE user_id = ? AND video_id = ?";
                $progress_stmt = $conn->prepare($progress_sql);
                $progress_stmt->bind_param("ii", $_SESSION['user_id'], $row['id']);
                $progress_stmt->execute();
                $progress = $progress_stmt->get_result()->fetch_assoc();

                $completed = $progress && $progress['completed'] ? '✓ ' : '';
                $watch_duration = $progress ? intval($progress['watch_duration']) : 0;
                $total_duration = 100; // Replace with actual video duration
                $progress_percent = min(($watch_duration / $total_duration) * 100, 100);
    ?>
                <a href="study.php?course_id=<?php echo $course_id; ?>&video_id=<?php echo $row['id']; ?>"
                    class="link-video">
                    <p class="title-item">
                        <?php echo $completed; ?>Bài <?php echo ($i + 1) . ". " . htmlspecialchars($row['title']); ?>
                    </p>
                    <div class="progress-container">
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: <?php echo $progress_percent; ?>%"></div>
                        </div>
                        <div class="progress-text"><?php echo floor($progress_percent); ?>% completed</div>
                    </div>
                    <p class="duration"><?php echo $row['duration']; ?></p>
                </a>
    <?php
                $i++;
            }
        }
    }
    ?>
</div>

<!-- Near the end of study.php, replace the footer section with: -->
<div class="footer-next-video">
    <?php
    if (isset($_GET['video_id'])) {
        $current_video_id = $_GET['video_id'];

        // Get previous video
        $prev_query = "SELECT id FROM course_videos 
                      WHERE course_id = $course_id 
                      AND id < $current_video_id 
                      ORDER BY id DESC LIMIT 1";
        $prev_result = mysqli_query($conn, $prev_query);
        $prev_video = mysqli_fetch_assoc($prev_result);

        // Get next video  
        $next_query = "SELECT id FROM course_videos 
                      WHERE course_id = $course_id 
                      AND id > $current_video_id 
                      ORDER BY id ASC LIMIT 1";
        $next_result = mysqli_query($conn, $next_query);
        $next_video = mysqli_fetch_assoc($next_result);
    } else {
        // If no video_id, user is on first video
        $next_query = "SELECT id FROM course_videos 
                      WHERE course_id = $course_id 
                      ORDER BY id ASC LIMIT 1,1";
        $next_result = mysqli_query($conn, $next_query);
        $next_video = mysqli_fetch_assoc($next_result);
        $prev_video = null;
    }
    ?>

    <?php if ($prev_video): ?>
        <a href="study.php?course_id=<?php echo $course_id; ?>&video_id=<?php echo $prev_video['id']; ?>"
            class="btn-pre">Bài trước</a>
    <?php else: ?>
        <a class="btn-pre" style="opacity:0.5;cursor:not-allowed">Bài trước</a>
    <?php endif; ?>

    <?php if ($next_video): ?>
        <a href="study.php?course_id=<?php echo $course_id; ?>&video_id=<?php echo $next_video['id']; ?>"
            class="btn-next">Bài tiếp theo</a>
    <?php else: ?>
        <a class="btn-next" style="opacity:0.5;cursor:not-allowed">Bài tiếp theo</a>
    <?php endif; ?>
</div>
<script src="JS/track-progress.js"></script>
</body>

</html>