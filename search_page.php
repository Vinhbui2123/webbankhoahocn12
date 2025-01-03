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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.0/css/all.min.css">
    <link rel="stylesheet" href="CSS/user_style.css">
    <style>
        .main {
            margin-top: 100px;
        }

        .container-box {
            margin-top: 16px;
        }

        .checkout {
            width: 100%;
            margin: 0 auto;
        }

        .tong {
            display: block;
            width: 210px;
            margin: 10px auto;
            margin-bottom: 50px;
        }

        .btn-checkout {
            background-color: blueviolet;
            border: none;
            border-radius: 8px;
            font-size: 22px;
            font-weight: 600;
            margin-top: 15px;
            padding: 10px 25px;
            width: 100%;
            color: white;
            box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;
        }
    </style>
</head>

<body>
    <?php include 'header.php' ?>
    <div class="main">

        <h1>Kết quả tìm kiếm "<?php $string = $_POST['string_search'];
                                echo $string; ?>"</h1>
        <div class="container-box">
            <?php
            if (isset($_POST['search_submit'])) {
                $string = $_POST['string_search'];
                $sql = "SELECT * FROM `courses` WHERE name LIKE '{$string}%'";
                $selected_courses = mysqli_query($conn, $sql) or die('query failed');
                while ($row = mysqli_fetch_assoc($selected_courses)) {
            ?>
                    <div class="box">
                        <a href="detail_course.php?course_id=<?php echo $row['id']; ?>">
                            <img src="uploaded_img/<?php echo $row['image'] ?>" alt="">
                            <div class="info">
                                <h3 class="title info-card"><?php echo $row['name'] ?></h3>
                                <h4 class="price info-card"><?php echo $row['price'] ?></h4>
                                <p class="info-card">Số bài: <span><?php echo $row['number_lessons'] ?></span></p>
                                <p class="info-card">Học viên: <span><?php echo $row['number_student'] ?></span></p>


                            </div>
                        </a>
                        <?php
                        ?>">
                        <div class="btn-add">
                            <a href="add_to_card.php?course_id=<?php echo $row['id']; ?>">Thêm</a>
                        </div>
                    </div>
            <?php
                }
            }
            ?>


        </div>
    </div>


    <?php include 'footer.php' ?>
</body>

</html>