<?php
include 'config.php';
// include 'cart.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./CSS/detail.css">
</head>

<body>
    <?php include 'header.php' ?>
    <div class="main1">
        <div class="title-videos">
            <?php
            $id_course = $_GET['course_id'];
            $sql = "SELECT *FROM `courses` WHERE id = '$id_course';";
            $select_course = mysqli_query($conn, $sql) or die('query failed');
            while ($row = mysqli_fetch_assoc($select_course)) {
            ?>
                <h2 class="title-course"><?php echo $row['name'] ?></h2>
                <p><span class="context-request">Nội dung: </span><?php echo $row['context'] ?></p>
                <p><span class="context-request">Yêu cầu: </span><?php echo $row['request'] ?></p>
                <h2 class="lessons">Các bài học</h2>
            <?php } ?>

            <div class="lessons-container">
                <?php
                $id_course = $_GET['course_id'];
                $sql = "SELECT * FROM `course_videos` WHERE course_id = '$id_course';";
                $select_course = mysqli_query($conn, $sql) or die('query failed');
                while ($row = mysqli_fetch_assoc($select_course)) {
                ?>
                    <div class="item-video">
                        <p><?php echo "{$row['title']}"; ?></p>
                        <p><?php echo $row['duration']; ?></p>
                    </div>
                <?php
                }
                ?>
            </div>



        </div>

        <div class="video-review">
            <?php
            $id_course = $_GET['course_id'];
            $sql = "SELECT *
                FROM courses co
                INNER JOIN course_videos cv ON co.id = cv.course_id
                WHERE co.id = $id_course
                LIMIT 1;";

            $select_course = mysqli_query($conn, $sql) or die('query failed');
            while ($row = mysqli_fetch_assoc($select_course)) {
            ?>
                <img class="image" onclick="onVideoDetail()" src="uploaded_img/<?php echo $row['image']; ?>"></img>
                <p class="price"><?php echo number_format($row['price'], 0, ',', '.') . ' VND'; ?></p>
                <?php
                if (isset($_SESSION['user_id'])) {
                ?>
                    <a href="add_to_card.php?course_id=<?php echo $id_course; ?>" class="btn-add1">Add to cart</a>
                <?php
                } else {
                ?>
                    <a href="login.php" class="btn-add1">Add to cart</a>

                <?php
                }
                ?>

                <a class="btn-buy" onclick='onOffQr()'>Buy now</a>
                <p>Số bài: <?php echo $row['number_lessons']; ?></p>
                <p>Thời lượng: <?php echo $row['duration']; ?></p>
                <div class="main-qr" src="./images/payment-qr.jpg" id="main-qr">
                    <div class="box-qr">
                        <h1>Quét QR để thanh toán</h1>
                        <img class="img-qr"></img>
                        <p>Ngân hàng
                        <h3>BIDV</h3>
                        </p>
                        <p>Số tài khoản:
                        <h3>999999999</h3>
                        </p>
                        <p>Tên tài khoản:
                        <h3>Anh em nhóm 7 vip vcl</h3>
                        </p>
                        <p>Số tiền:
                        <h3><?php echo number_format($row['price'], 0, ',', '.') . ' VND'; ?></h3>
                        </p>
                        <button class="btn-cancel" onclick="onOffQr()">Huỷ bỏ</button>
                        <a href="checkout.php" class="btn-finish" onclick="onOffQr()">Hoàn tất</a>
                    </div>
                </div>
        </div>

    </div>
    <div class="video-main" id="video-main">
        <div class="box-video">
            <p class="name-course"><?php echo $row['name']; ?></p>
            <video class="video-detail" controls src="uploaded_video/<?php echo $row['video']; ?>"></video>
            <button class="btn-x" onclick="offVideoDetail()"><i class="fa-solid fa-x"></i></button>
        </div>
    </div>
<?php
            }
?>
<script src="js/user.js"></script>
<?php include 'footer.php' ?>
</body>

</html>