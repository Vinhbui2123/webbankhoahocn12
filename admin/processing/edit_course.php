<?php
include '../../config.php';
include_once('../../libs/getid3/getid3.php');

session_start();


$admin_id = $_SESSION['admin_id'];
// if(!isset($admin_id)){
//     header('Location:register.php');
// }
// Chỉnh sửa thông tin của khoá học
if (isset($_POST['submit_change_course'])) {
    $name_course = mysqli_real_escape_string($conn, $_POST['name_course']);
    $price_course = mysqli_real_escape_string($conn, $_POST['price_course']);
    $asks_course = mysqli_real_escape_string($conn, $_POST['asks_course']);
    $context_course = mysqli_real_escape_string($conn, $_POST['context_course']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $id_course = $_GET['id'];

    if ($_FILES['image']['size'] != 0) {
        $image = $_FILES['image']['name']; // Tên gốc của tệp (ví dụ: example.jpg).
        $image_size = $_FILES['image']['size'];
        $image_tmp_name = $_FILES['image']['tmp_name']; // Đường dẫn tới tệp tạm thời trên máy chủ.
        $image_folder = 'uploaded_img/' . $image; // Thư mục lưu tệp

        $select_image = mysqli_query($conn, "SELECT image FROM `courses` WHERE id = '$id_course';") or die('query failed');
        $fetch_image = mysqli_fetch_array($select_image);
        unlink('uploaded_img/' . $fetch_image['image']);

        // ko được có dấu phẩy ở trước where
        $add_course_query = mysqli_query(
            $conn,
            "UPDATE `courses` SET
                            image = '$image', 
                            name =  '$name_course', 
                            price = '$price_course', 
                            request = '$asks_course',
                            context = '$context_course' 
                            WHERE id = $id_course ;"
        ) or die('query failed');
        if ($add_course_query) {
            if ($image_size > 20000000) {
                $message = 'Ảnh quá lớn';
            } else {
                move_uploaded_file($image_tmp_name, $image_folder);
                $message = 'Sửa thành công!';
            }
        } else {
            $message = "Thêm thất bại!";
        }
    } else {
        mysqli_query(
            $conn,
            "UPDATE `courses` SET
                            name =  '$name_course', 
                            price = '$price_course', 
                            request = '$asks_course',
                            context = '$context_course' 
                            WHERE id = $id_course ;"
        ) or die('query failed');
    }
    header('Location:../admin_course_edit.php?id=' . $id_course);
}

// Thêm video vào khoá học
if (isset($_POST['submit_video'])) {
    $video_name =  mysqli_real_escape_string($conn, $_POST['name_lesson']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $id_course = $_GET['id'];
    if ($_FILES['input_video']['size'] <= 0) {
        $message = "Vui lòng nhập email";
    } else {
        $video = $_FILES['input_video']['name'];
        $video_size = $_FILES['input_video']['size'];
        $video_tmp_name = $_FILES['input_video']['tmp_name'];
        $video_folder = '../../uploaded_video/' . $video;

        $temporary_file_path = $video_tmp_name;

        $getID3 = new getID3;
        $file_info = $getID3->analyze($temporary_file_path);

        if (!empty($file_info['playtime_string'])) {
            $duration = $file_info['playtime_string'];
        } else {
            echo "Không thể lấy thời lượng video.<br>";
        }

        $add_course_query = mysqli_query(
            $conn,
            "INSERT INTO `course_videos`
    (`course_id`, `video`, `title`, `description`, `duration`) 
    VALUES
    ('$id_course', '$video', '$video_name', '$description', '$duration')"
        ) or die('query failed');
        mysqli_query($conn, "UPDATE `courses` SET `number_lessons` = `number_lessons` + 1 WHERE id = '$id_course';");
        if ($add_course_query) {
            move_uploaded_file($video_tmp_name, $video_folder);
            $message = "Thêm video thành công!";
            header('Location:../admin_course_edit.php?id=' . $id_course);
        }
    }

    echo "<script type=\"text/javascript\">" .
        "alert('$message');" .
        "</script>";
}

// Chỉnh sửa video trong khoá học
if (isset($_POST['submit_save_change_lesson'])) {
    $newName = $_POST['name_lesson'];
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $id_old_video = $_POST['id_video'];
    $id_course = $_GET['id'];

    if ($_FILES['input_video']['size'] > 0) {
        $video = $_FILES['input_video']['name'];
        $video_size = $_FILES['input_video']['size'];
        $video_tmp_name = $_FILES['input_video']['tmp_name'];
        $video_folder = '../../uploaded_video/' . $video;

        $temporary_file_path = $video_tmp_name;
        $getID3 = new getID3;
        $file_info = $getID3->analyze($temporary_file_path);

        if (!empty($file_info['playtime_string'])) {
            $duration = $file_info['playtime_string'];
        } else {
            echo "Không thể lấy thời lượng video.<br>";
        }

        $select_video = mysqli_query($conn, "SELECT video FROM `course_videos` WHERE id = '$id_old_video';") or die('query failed');
        $video_unlink = mysqli_fetch_array($select_video);
        unlink('../../uploaded_video/' . $video_unlink['video']);

        $add_video_query = mysqli_query(
            $conn,
            "UPDATE `course_videos` 
         SET `title` = '$newName', 
             `video` = '$video',
             `description` = '$description'
         WHERE id = '$id_old_video';"
        ) or die('query failed');
        if ($add_video_query) {
            move_uploaded_file($video_tmp_name, $video_folder);
            $message = "Thêm video thành công!";
        }
    } else {
        mysqli_query($conn, "UPDATE  `course_videos` SET title = '$newName',  `description` = '$description' WHERE id = '$id_old_video';") or die('query failed');
    }
    header('Location:../admin_course_edit.php?id=' . $id_course);
}

// Xoá video của khoá học
if (isset($_GET['delete_video_id'])) {
    $id_course = $_GET['id'];
    $id_video = $_GET['delete_video_id'];

    $select_video = mysqli_query($conn, "SELECT video FROM `course_videos` WHERE id = $id_video;") or die('query failed');
    $fetch_video = mysqli_fetch_assoc($select_video);

    unlink('../../uploaded_video/' . $fetch_video['video']);
    mysqli_query($conn, "DELETE FROM `course_videos` WHERE id = $id_video;") or die('query failed');
    header('Location:../admin_course_edit.php?id=' . $id_course);
}
