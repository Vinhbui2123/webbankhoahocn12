<?php
include '../config.php';
session_start();
$admin_id = $_SESSION['admin_id'];
if(!isset($admin_id)){
    header('Location:login.php');
}
if(isset($_POST['submit'])){
    $name_course = mysqli_real_escape_string($conn,$_POST['name_course']);
    $price_course = mysqli_real_escape_string($conn,$_POST['price_course']);
    $asks_course = mysqli_real_escape_string($conn,$_POST['asks_course']);
    $context_course = mysqli_real_escape_string($conn,$_POST['context_course']);
   
    $image = $_FILES['image']['name']; // Tên gốc của tệp (ví dụ: example.jpg).
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name']; // Đường dẫn tới tệp tạm thời trên máy chủ.
    $image_folder = '../uploaded_img/'.$image; // Thư mục lưu tệp

    $add_course_query = mysqli_query($conn, "INSERT INTO `courses`(name,image,price,context,request) VALUES('$name_course','$image','$price_course','$context_course','$asks_course');") or die('query failed');
    if($add_course_query){
        if($image_size >20000000){
            $message = 'Ảnh quá lớn';
        }
        else{
            move_uploaded_file($image_tmp_name, $image_folder);
            $message = 'Thêm thành công!';
            $SelectID = mysqli_query($conn,"SELECT MAX(id) as id FROM `courses`") or die('query failed');
            $id = mysqli_fetch_array($SelectID);
            $id = $id['id'];
            header('Location:admin_course_edit.php?id='.$id);
        }
    }
    else{
        $message = "Thêm thất bại!";
    }
    echo "<script type=\"text/javascript\">".
            "alert('$message');".
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
    <section class="container-box">
        <form action="" method="post" enctype="multipart/form-data">
            <h2>Thêm khoá học</h2>
            <div class="flex">
                <div class="div1">
                    <label for="name_course">Tên:</label>
                    <input type="text" name="name_course" class="box" required placeholder="Nhận tên khoá học">
                    <label for="price_course">Giá:</label>
                    <input type="number" placeholder="Nhận giá khoá học" required name="price_course" class="box"  >
                    <label for="image_course">Ảnh bìa</label>
                    <input type="file" name="image"  accept="image/*" required onchange="loadFile(event)">
                    <img id="output" />
                    <script>
                    
                    </script>
                </div>
                <div class="div2">
                    <label for="asks_course">Yêu cầu:</label>
                    <textarea name="asks_course" class="box"  id=""></textarea>
                    <label for="context_course">Nội dung:</label>
                    <textarea name="context_course" class="box"  id=""></textarea>
                </div>
            </div>
           <input type="submit" id="output" name="submit"  value="Thêm" class="btn btn-add">
        </form>
    </section>
</div>

<script src="../js/admin_script.js"></script>

</body>
</html>