<?php 
include '../config.php';
session_start();
$admin_id = $_SESSION['admin_id'];
if(!isset($admin_id)){
    header('Location:login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../CSS/user_style.css">
    <style>
        .main1{
            display: flex;
            width: 83%;
            height: 700px;
            margin: 80px auto;
            /* background-color: pink; */
            border: 1px solid lightgray;
            padding: 25px;
            box-shadow: rgba(0, 0, 0, 0.05) 0px 6px 24px 0px, rgba(0, 0, 0, 0.08) 0px 0px 0px 1px;

        }
        .title-videos{

            width: 65%;
            height: 100%;
            /* background-color: greenyellow; */
        }
        .title-course{
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 20px;
        }
        .video-review{
            width: 35%;
            text-align: center;

        }
        .image{
            margin: 0px auto;
            width: 85%;
            background-color: orange;
            border-radius: 20px;
            box-shadow: rgba(0, 0, 0, 0.05) 0px 6px 24px 0px, rgba(0, 0, 0, 0.08) 0px 0px 0px 1px;

        }
        button{
            margin-top: 10px;
        }
        .item-video{
            /* margin-top: 18px; */
            margin-bottom: 10px;
            width: 100%;
            height: 42px;
            background-color: #eef4fc;
            border-radius: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0px 18px 10px 18px;
            font-weight: 600;
        }
        p{
            margin-top: 10px;
        }
        .video-main{

            position:fixed;
            top: 0; left: 0;
            height: 100%; width: 100%;
            z-index: 1002;
            background: rgba(0, 0, 0, .6);
            display: none;
            justify-content: center;
            align-items: center;
        }
        .box-video{
            border-radius: 20px;
            background-color: white;
            width: 60%;
            display: flex;
           flex-direction: column;
           justify-content: center;
           align-items: center;
           position: relative;
           
        }
      

        .name-course{
            font-size: 24px;
            font-weight: 600;
            padding-top: 5px;

        }

        .video-detail{
           padding:0px 20px 20px 20px;
            width: 100%;
            height: 500px;
        }
        .box-video .btn-x{
            border: none;
            position: absolute;
            padding: 8px;
            top: -10px;
            right: 0px;
            width: 40px;
            height: 40px;
            background-color: transparent;
        }
        .box-video .btn-x:hover{
            cursor: pointer;
        }
        .active-video{
            display: flex;
        }
        .lessons{
            margin-top: 18px;
            margin-bottom: 10px;
            padding: 15px 0px 0px 0px;
            width: 100%;
        }
        .context-request{
            font-weight: 650;
            font-size: 20px;
        }
        .price{
            font-size: 28px;
            font-weight: 500;
            color: orangered;
            padding: 8px;

        }

        .btn-add1, .btn-buy{
            display: inline-block;
            border-radius: 10px;
            font-size: 18px;
            font-weight: 500;
        }
        .btn-add1{
            
            padding: 6px 8px;
            margin-right: 5px;
            background-color: lawngreen;
           
        }
        .btn-buy{
            margin-left: 5px;
            padding: 6px;
            background-color: lightskyblue;
        }
    </style>
</head>
<body>
    <?php include 'admin_header.php'?>
    <div class="main1">
        <div class="title-videos"> 
            <?php
                $id_course = $_GET['course_id'];
                $sql = "SELECT *FROM `courses` WHERE id = '$id_course';";
                $select_course = mysqli_query($conn,$sql) or die('query failed');
                while($row = mysqli_fetch_assoc($select_course)){
            ?>
                    <h2 class="title-course"><?php echo $row['name']?></h2>
                    <p><span class="context-request">Nội dung: </span><?php echo $row['context']?></p>
                    <p><span class="context-request">Yêu cầu: </span><?php echo $row['request']?></p>
                    <h2 class="lessons">Các bài học</h2>
            <?php }?>

            <?php
                $id_course = $_GET['course_id'];
                $sql = "SELECT *FROM `course_videos` WHERE course_id = '$id_course';";
                $select_course = mysqli_query($conn,$sql) or die('query failed');
                $i = 0;
                while($row = mysqli_fetch_assoc($select_course)){
            ?>
                    <div class="item-video">
                        <p><?php $i+=1; echo "$i. {$row['title']}";?></p>
                        <p><?php echo $row['duration'];?></p>
                    </div>
            <?php
                }
            ?>
              

        
        </div>

        <div class="video-review" >
            <?php
                $id_course = $_GET['course_id'];
                $sql = "SELECT *
                FROM courses co
                INNER JOIN course_videos cv ON co.id = cv.course_id
                WHERE co.id = $id_course
                LIMIT 1;";
                
                $select_course = mysqli_query($conn,$sql) or die('query failed');
                while($row = mysqli_fetch_assoc($select_course)){
            ?>
                    <img class="image" onclick="onVideoDetail()" src="../uploaded_img/<?php echo $row['image'];?>"></img>
                    <p class="price"><?php echo $row['price'];?></p>
                   
                    <p>Số bài: <?php echo $row['number_lessons'];?></p>
                    <p>Thời lượng: <?php echo $row['duration'];?></p>
           

        </div>
    </div>
    <div class="video-main" id="video-main" >
        <div class="box-video">
            <p class="name-course"><?php echo $row['name'];?></p>
            <video class="video-detail" controls src="../uploaded_video/<?php echo $row['video'];?>"></video>
            <button class="btn-x" onclick="offVideoDetail()"><i class="fa-solid fa-x"></i></button>
        </div>
    </div>
    <?php
                }
           ?>
          <script src="../JS/user.js"></script>
    <!-- <?php include 'footer.php'?> -->
</body>
</html>