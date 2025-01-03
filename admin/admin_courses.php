<?php
include '../config.php';
session_start();
$admin_id = $_SESSION['admin_id'];
if (!isset($admin_id)) {
    header('Location:register.php');
}
if (isset($_GET['delete'])) {
    $id_course = $_GET['delete'];

    $image_course_delete = mysqli_query($conn, "SELECT image FROM `courses` WHERE id = '$id_course';") or die('query failed');
    $video_course_delete = mysqli_query($conn, "SELECT video FROM `course_videos` WHERE course_id = '$id_course';") or die('query failed');

    $image_course = mysqli_fetch_array($image_course_delete);
    unlink('uploaded_img/' . $image_course['image']);

    $i = 0;
    while ($i < mysqli_num_rows($video_course_delete)) {
        $row = mysqli_fetch_array($video_course_delete);
        unlink('uploaded_video/' . $row['video']);
        $i++;
    }
    $delete_videos = mysqli_query($conn, "DELETE FROM `course_videos` WHERE course_id = '$id_course';") or die('query failed');
    $delete_course = mysqli_query($conn, "DELETE FROM `courses` WHERE id = '$id_course';") or die('query failed');

    if ($delete_course) {
        $message = "Xoá thành công";
        header('Location:admin_courses.php');
    } else {
        $message = "Xoá thất bại";
    }
    echo "<script type=\"text/javascript\">" .
        "alert('$message');" .
        "</script>";
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
                <th>STT</th>
                <th>Tên khoá học</th>
                <th>Giá bán</th>
                <th>Số bài học</th>
                <th>Số học viên</th>
                <th>Sửa</th>
                <th>Xoá</th>
                <th>Xem</th>
                <?php
                $select_courses = mysqli_query($conn, "SELECT * FROM `courses`") or die('query failed');
                $number_courses = mysqli_num_rows($select_courses);
                $i = 0;
                while ($i < $number_courses) {
                    $i++;
                    $row = mysqli_fetch_assoc($select_courses);

                ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo number_format($row['price']) ?></td>
                        <td><?php echo $row['number_lessons'] ?></td>
                        <td><?php echo $row['number_student'] ?></td>
                        <td><a href="admin_course_edit.php?id=<?php echo $row['id'] ?>" class="btn btn-update">Sửa</a></td>
                        <td>
                            <a href="admin_courses.php?delete=<?php echo $row['id']; ?>" class="btn btn-delete" onclick="return confirm('Delete this course?');"> xoá</a>
                        </td>
                        <td><a href="admin_view_course.php?course_id=<?php echo $row['id']; ?>" class="btn btn-watch">Xem</a></td>

                    </tr>
                <?php
                }

                ?>
            </table>
            <a href="admin_add_course.php" class="btn btn-add" style="width:162px">Thêm khoá học</a>
        </section>
    </div>



    <script src="../js/admin_script.js"></script>

</body>

</html>