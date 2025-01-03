<?php
include '../config.php';
include_once('../libs/getid3/getid3.php');
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
    <script src="../JS/admin_script.js" defer></script>

    <style>
        body {
            /* background-color: red; */
        }

        textarea.box {
            min-height: 100px;
            resize: vertical;
            font-family: inherit;
            line-height: 1.5;
            padding: 10px;
        }
    </style>
</head>

<body>
    <?php
    include './admin_header.php';
    ?>
    <div class="main">
        <!-- Thông tin khoá học -->
        <section class="container-box">
            <form action="processing/edit_course.php?id=<?php $id_course = $_GET['id'];
                                                        echo $id_course; ?>" method="post" enctype="multipart/form-data">
                <h1>Thông tin khoá học</h1>
                <?php $id_course = $_GET['id'];
                $select_course =  mysqli_query($conn, "SELECT * FROM `courses` WHERE id = '$id_course';") or die('query failed');
                if (mysqli_num_rows($select_course) > 0) {
                    $row = mysqli_fetch_assoc($select_course);
                ?>
                    <div class="flex">
                        <div class="div1">
                            <label for="name_course">Tên: </label>
                            <input type="text" name="name_course" class="box" required placeholder="Nhận tên khoá học" value="<?php echo $row['name'] ?>">
                            <label style="margin-top:14px;">Sĩ số:
                                <span>
                                    <?php
                                    $id_course = $_GET['id'];
                                    $countST = mysqli_query($conn, "SELECT number_student as st FROM `courses` WHERE id = '$id_course';") or die('query failed');
                                    $countST = mysqli_fetch_array($countST);
                                    $countST = $countST['st'];
                                    echo $countST;
                                    ?>
                                </span>
                            </label>
                            <label style="margin-top:14px">Số bài giảng:
                                <?php
                                $id_course = $_GET['id'];
                                $countVideo = mysqli_query($conn, "SELECT COUNT(video) as vd FROM `course_videos` WHERE course_id = '$id_course';") or die('query failed');
                                $countVideo = mysqli_fetch_array($countVideo);
                                $countVideo = $countVideo['vd'];
                                echo $countVideo;
                                ?>
                            </label>
                            <label for="price_course">Giá:</label>
                            <input type="number" placeholder="Nhận giá khoá học" required name="price_course" class="box" value="<?php echo $row['price'] ?>">

                            <label for="image_course">Ảnh bìa</label>
                            <input type="file" name="image" accept="image/*" onchange="loadFile(event)" value="">
                            <img id="output" src="../uploaded_img/<?php echo $row['image'] ?>" />
                        </div>
                        <div class="div2">
                            <label for="asks_course">Yêu cầu:</label>
                            <textarea name="asks_course" class="box" id=""><?php echo $row['request'] ?></textarea>
                            <label for="context_course">Nội dung:</label>
                            <textarea name="context_course" class="box" id=""><?php echo $row['context'] ?></textarea>
                        </div>
                    </div>
                <?php
                }
                ?>
                <button type="button" class="btn btn-update" onclick="editInfoCourse()" value="edit" id="edit_info_course">Chỉnh sửa</button>
                <button type="submit" class="btn btn-save" name="submit_change_course" value="save" id="save1">Lưu</button>
                <button type="button" class="btn btn-cancel" value="cancel" id="cancel1"><i class="fa-solid fa-xmark"></i></button>

            </form>
        </section>

        <!-- Thêm khoá học -->
        <section class="container-box">
            <form action="processing/edit_course.php?id=<?php $id_course = $_GET['id'];
                                                        echo $id_course; ?>" method="post" enctype="multipart/form-data">
                <h1 id="title-section1">Thêm bài học</h1>
                <div class="flex">
                    <div class="div1">
                        <?php
                        if (isset($_GET['id_video'])) {
                            $id_video = $_GET['id_video'];
                            $sql = "SELECT * FROM `course_videos` WHERE id = '$id_video';";
                            $selected_video = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($selected_video) > 0) {
                                while ($row = mysqli_fetch_assoc($selected_video)) {
                        ?>
                                    <label for="name_lesson">Tên bài học:</label>
                                    <input type="text" name="name_lesson" value="<?php echo htmlspecialchars($row['title']); ?>" class="box" id="name-lesson" required placeholder="Nhập tên bài học">

                                    <label for="description">Mô tả bài học:</label>
                                    <textarea name="description" class="box" id="description" rows="4" placeholder="Nhập mô tả bài học"><?php echo htmlspecialchars($row['description']); ?></textarea>

                                    <label for="video">Video</label>
                                    <input type="hidden" name="id_video" value="<?php echo $row['id']; ?>">
                                    <input type="file" id="input" name="input_video" accept="video/mp4, video/mov">
                    </div>
                    <div class="div2">
                        <video id="video" style="display:block;" preload="block" src="../uploaded_video/<?php echo htmlspecialchars($row['video']); ?>" controls></video>
                    </div>
                </div>
                <button style="display: block;" type="submit" name="submit_save_change_lesson" class="btn btn-save" id="btn-save-lesson">Lưu</button>
                <button style="display: block;" class="btn btn-cancel" id="btn-cancel-change-lesson" type="button"><i class="fa-solid fa-xmark"></i></button>
        <?php
                                }
                            }
                        } else {
        ?>
        <label for="name_lesson">Tên bài học:</label>
        <input type="text" name="name_lesson" class="box" id="name-lesson" required placeholder="Nhập tên bài học">

        <label for="description">Mô tả bài học:</label>
        <textarea name="description" class="box" id="description" rows="4" placeholder="Nhập mô tả bài học"></textarea>

        <label for="video">Video</label>
        <input type="file" id="input" name="input_video" accept="video/mp4, video/mov" required>
    </div>
    <div class="div2">
        <video id="video" style="display:none;" preload="none" controls></video>
    </div>
    </div>
    <button type="submit" name="submit_video" class="btn btn-add" id="btn-add-lesson">Thêm</button>
<?php
                        }
?>
</form>
</section>

<!-- Các bài học  -->
<section class="container-box">
    <form action="processing/edit_course.php" method="get">
        <h1>Các bài học</h1>
        <table>
            <th style="width: 3rem;">STT</th>
            <th>Tên</th>
            <th style="width: 13rem;">Video</th>
            <th style="width: 6rem;">Xoá</th>
            <th style="width: 6rem;">Sửa</th>
            <?php
            $course_id = $_GET['id'];
            $select_lesson = mysqli_query($conn, "SELECT * FROM `course_videos` WHERE course_id = '$course_id';") or die('Query failed');
            $i = 0;
            while ($row = mysqli_fetch_assoc($select_lesson)) {
                $i++;
            ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td> <span class="title-lesson"> <?php echo htmlspecialchars($row['title']); ?></span> </td>
                    <td>
                        <video onmousemove="hello()" class="display-video" src="../uploaded_video/<?php echo $row['video']; ?>"></video>
                        <!-- <?php echo $row['video']; ?> -->
                    </td>
                    <td style="display:none;"><span class="id-video"><?php echo htmlspecialchars($row['id']); ?></span></td>
                    <td>
                        <!--  button sẽ gửi lên url và mât id -->
                        <a style="width:60px" class="btn btn-delete" href="processing/edit_course.php?id=<?php $course_id = $_GET['id'];
                                                                                                            echo htmlspecialchars($course_id); ?>&delete_video_id=<?php echo htmlspecialchars($row['id']); ?>" onclick="return confirm('Delete this video?');">Xoá</a>
                    </td>
                    <td>
                        <!-- <button class="btn btn-update update-video">Sửa</button> -->
                        <a onclick="editVideo()" href="admin_course_edit.php?id=<?php echo $course_id; ?>&id_video=<?php echo $row['id']; ?>" class="btn btn-update update-video">Sửa</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
    </form>
</section>
</div>


</body>

</html>