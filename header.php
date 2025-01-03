<?php
include 'config.php';

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
        @import url("https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap");

        * {
            margin: 0;
            padding: 0;
            font-family: roboto;
            /* font-size: 18px; */
            box-sizing: border-box;
            text-decoration: none;
        }

        .logo {
            font-size: 30px;
            font-weight: 600;
            color: lightskyblue;
        }

        .header {
            background-color: white;
            height: 66px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-left: 20px;
            padding-right: 20px;
            border-bottom: 1px solid #B8B8B8;
            position: fixed;
            z-index: 1000;
            top: 0;
            right: 0;
            left: 0;
        }

        .search {
            width: 30%;
            height: 42px;
        }

        .search input {
            width: 100%;
            height: 100%;
            border-radius: 20px;
            border: 1.5px solid #B8B8B8;
            padding-left: 40px;
        }

        .search {
            display: flex;
            flex-direction: row;
            position: relative;
        }

        .search button {
            position: absolute;
            padding: 10px;
            font-size: 16px;
            border: none;
            margin: 2px;
            color: #B8B8B8;
            background-color: white;
            top: 0;
            left: 0;
            bottom: 0;
            border-radius: 20px 0px 0px 20px;
        }

        .my-course {
            position: absolute;
            top: 100%;
            right: 160px;
            width: 300px;
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            display: none;
            z-index: 1000;

        }

        .active-my-course {
            display: block;
        }

        .item {
            display: flex;
            margin-bottom: 20px;
            align-items: center;
            gap: 15px;
            padding: 12px;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.3s ease;
            border: 1px solid #eee;

        }

        .my-course .item:hover {
            background: #f8f9fa;
            transform: translateY(-2px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .my-course .item img {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            object-fit: cover;
        }

        .item img {
            width: 140px;
            height: 90px;
            margin-right: 10px;
        }

        .header #user-info {
            position: absolute;
            top: 100%;
            right: 20px;
            width: 280px;
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            display: none;
            z-index: 1000;
        }

        #user-info p {
            margin: 12px 0;
            color: #666;
            font-size: 14px;
        }

        #user-info.active-user {
            display: block;
        }

        #user-info p span {
            color: #333;
            font-weight: 500;
            margin-left: 5px;
        }

        #user-info .btn {
            display: block;
            width: 100%;
            padding: 10px;
            background: #ff4757;
            color: white;
            text-align: center;
            border-radius: 6px;
            text-decoration: none;
            margin-top: 15px;
            transition: all 0.3s ease;
            border: none;
            font-weight: 500;
        }

        #user-info .btn:hover {
            background: #ff6b81;
            transform: translateY(-2px);
        }

        .user-icon i {
            padding: 14px;
        }

        .btn-my-course {
            border: none;
            background-color: white;
            font-size: 18px;
        }

        i {
            font-size: 19px;
        }

        .fa-cart-shopping {
            position: relative;
        }

        .number-cart {
            position: absolute;
            top: 4px;
            right: 4px;

            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="header">
        <a class="logo" href="home.php">
            Bán khoá học
        </a>
        <form class="search" method="Post" action="search_page.php">
            <button type="submit" name="search_submit">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
            <input type="text" name="string_search" placeholder="Tìm kiếm khoá học...">
        </form>

        <?php
        // Kiểm tra người dùng đã đăng nhập chưa mới cho thức hiện các chức năng còn không chuyển sang header với icon ref đến login
        if (!isset($_SESSION['user_id'])) {
        ?>
            <div class="user-icon">
                <a href="login.php"><i class="fa-solid fa-cart-shopping"> </i></a>
                <a href="login.php"><i class="fa-solid fa-user"></i></a>
            </div>
        <?php
        } else {
        ?>
            <div class="user-icon">
                <!-- <?php
                        session_start();
                        $user_id = $_SESSION['user_id'];
                        if (!isset($user_id)) {
                            header('Location:login.php');
                        }
                        ?> -->
                <button onclick="displayMyCourse()" class="btn-my-course">Khoá học của tôi</button>
                <a href="cart.php">
                    <i class="fa-solid fa-cart-shopping">
                        <span class="number-cart">
                            <?php

                            $id_user = $_SESSION['user_id'];
                            $number_cart = mysqli_query($conn, "SELECT COUNT(id) as num FROM`course_cart` Where user_id =  $id_user;") or die('query failed');
                            $row = mysqli_fetch_assoc($number_cart);
                            echo $row['num'];

                            ?></span>
                    </i>
                </a>
                <i onclick="displayUserInfo()" class="fa-solid fa-user"></i>
            </div>

            <div class="my-course" id="my-course">
                <?php

                $id_user = $_SESSION['user_id'];
                $sql_select = mysqli_query($conn, "SELECT * FROM `user_course` as uc INNER JOIN `courses` as c on uc.course_id = c.id  WHERE user_id = '$id_user' AND payment_state = 'Xong';") or die('query failed');
                while ($row = mysqli_fetch_assoc($sql_select)) {
                ?>
                    <a href="study.php?course_id=<?php echo $row['id']; ?>" class="item">
                        <img src="uploaded_img/<?php echo $row['image'] ?>" alt="">
                        <p style="font-size: 20px; font-weight:500;"><?php echo $row['name'] ?></p>
                    </a>
                <?php
                }
                ?>
            </div>

            <div id="user-info">
                <p>Name: <span><?php $user_name = $_SESSION['user_name'];
                                echo $user_name; ?></span></p>
                <p>Email: <span><?php $user_email = $_SESSION['user_email'];
                                echo $user_email; ?></span> </p>
                <a href="logout.php" class="btn"> Logout</a>
            </div>
        <?php
        }
        ?>


    </div>
    </div>
    <script src="js/user.js"></script>
</body>

</html>