<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .header{
            height: 60px;
            width: 100%;
            display: flex;
            padding: 0px 30px;
            border-bottom: 1px solid lightgrey;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            z-index: 10;
            top: 0;
            background-color: white;
        }

        .header h2 a{
            text-decoration: none;
            font-size: 32px;
            color: rgb(98, 182, 210);
        }


        .header .navigate a{
            text-transform: capitalize;
            margin: 10px;
            font-size: 20px;
            padding: 12px;
            text-decoration: none;
            color: #333333;
            font-weight: 500;
        }

        .header .navigate a:hover{
            text-decoration: underline;
            color: lightblue;
        }

        .header .user-info {
            position: absolute;
            top: 66px;
            right: 20px;
            width: 15rem;
            padding: 10px;
            border-radius: 8px;
            border: #333333 1px solid;
            background-color: whitesmoke;
            display: none;

        }

        .header .user-info .btn{
            margin: 10px auto;
            display: block;
            width: 50%;
            text-decoration: none;
            text-transform: capitalize;
            padding: 8px 24px;
            font-weight: bolder;
            color: white;
            border-radius: 8px;
            background-color: #FFA500;
            border: none;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">
            <h2><a href="admin_page.php">Admin</a></h2>
        </div>
        <div class="navigate">
            <a href="admin_page.php">home</a>
            <a href="admin_users.php">người dùng</a>
            <a href="<?php if($_SESSION['level'] == 2){
                             echo "admin_main.php";
                            }
                            else if($_SESSION['level'] == 1){
                                echo "admin_normal.php";
                               }
            ;?>">admin</a>
            <a href="admin_user_courses.php">Đơn hàng</a>
            <a href="admin_courses.php">Các Khoá học</a>

        </div>
        <div class="user" onmousemove="display_user_box()">
            <i class="fa-solid fa-user"></i>
        </div>
        <div class="user-info"  onmouseleave="hidden_user_box()">
            <p>Name: <span><?php echo $_SESSION['admin_name']?></span></p>
            <p>Email: <span><?php echo $_SESSION['admin_email']?></span> </p>
            <a href="logout.php" class="btn"> Logout</a>
        </div>
    </div>
</body>
</html>