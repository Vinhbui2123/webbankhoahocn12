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
        @import url("https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap");

        * {
            margin: 0;
            padding: 0;
            font-family: 'Roboto', sans-serif;
            box-sizing: border-box;
            text-decoration: none;
        }

        .header {
            background-color: white;
            height: 70px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 40px;
            border-bottom: 1px solid rgba(184, 184, 184, 0.2);
            position: fixed;
            z-index: 1000;
            top: 0;
            right: 0;
            left: 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .logo {
            font-size: 32px;
            font-weight: 700;
            color: #3498db;
            transition: color 0.3s ease;
        }

        .logo:hover {
            color: #2980b9;
        }

        .search {
            width: 35%;
            height: 45px;
            position: relative;
            display: flex;
            align-items: center;
        }

        .search input {
            width: 100%;
            height: 100%;
            border-radius: 25px;
            border: 2px solid #e0e0e0;
            padding: 0 45px;
            font-size: 15px;
            transition: border-color 0.3s ease;
        }

        .search input:focus {
            outline: none;
            border-color: #3498db;
        }

        .search button {
            position: absolute;
            left: 15px;
            background: none;
            border: none;
            color: #777;
            font-size: 18px;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .search button:hover {
            color: #3498db;
        }

        .my-course {
            background-color: white;
            top: 75px;
            right: 50px;
            width: 420px;
            padding: 15px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border: 1px solid #eee;
        }

        .item {
            display: flex;
            margin-bottom: 20px;
            padding: 10px;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        .item:hover {
            background-color: #f8f9fa;
        }

        .item img {
            width: 140px;
            height: 90px;
            border-radius: 8px;
            object-fit: cover;
        }

        #user-info {
            background-color: white;
            padding: 15px;
            border-radius: 12px;
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            width: 250px;
        }

        .user-icon i {
            padding: 12px;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .user-icon i:hover {
            color: #3498db;
        }

        .btn-my-course {
            border: none;
            background-color: transparent;
            font-size: 16px;
            cursor: pointer;
            padding: 8px 15px;
            border-radius: 20px;
            transition: background-color 0.3s ease;
        }

        .btn-my-course:hover {
            background-color: #f0f0f0;
        }

        .number-cart {
            background-color: #e74c3c;
            color: white;
            padding: 2px 6px;
            border-radius: 50%;
            font-size: 12px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="header">
        <a class="logo" href="home.php">
            Bán khoá học
        </a>


    </div>
    </div>
    <script src="js/user.js"></script>
</body>

</html>