<?php
include 'config.php';
session_start();

// Pagination setup
$items_per_page = 12;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $items_per_page;

// Get total courses
$total_courses = mysqli_query($conn, "SELECT COUNT(*) as count FROM `courses`");
$total_count = mysqli_fetch_assoc($total_courses)['count'];
$total_pages = ceil($total_count / $items_per_page);

// Get courses with pagination
$select_courses = mysqli_query(
    $conn,
    "SELECT * FROM `courses` LIMIT $items_per_page OFFSET $offset"
) or die('Query failed: ' . mysqli_error($conn));
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Courses - Learn Anywhere, Anytime</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.0/css/all.min.css">
    <link rel="stylesheet" href="CSS/user_style.css">
</head>

<body>
    <?php include 'header.php' ?>

    <div class="main">
        <div class="banner"></div>
        <h1>All Courses</h1>

        <div class="container-box">
            <?php if (mysqli_num_rows($select_courses) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($select_courses)): ?>
                    <div class="box">
                        <a href="detail_course.php?course_id=<?= htmlspecialchars($row['id']) ?>">
                            <img src="uploaded_img/<?= htmlspecialchars($row['image']) ?>" alt="Course Image">
                            <div class="info">
                                <h3 class="title info-card"><?= htmlspecialchars($row['name']) ?></h3>
                                <p class="info-card">Price:
                                    <span class="price"><?= number_format($row['price']) ?> VND</span>
                                </p>
                                <p class="info-card">Lessons:
                                    <span><?= htmlspecialchars($row['number_lessons']) ?></span>
                                </p>

                            </div>
                        </a>
                        <div class="btn-add">
                            <a href="<?= isset($_SESSION['user_id']) ?
                                            'add_to_card.php?course_id=' . htmlspecialchars($row['id']) :
                                            'login.php' ?>">
                                Add to Cart 
                            </a>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="empty">No courses available</p>
            <?php endif; ?>
        </div>

        <?php if ($total_pages > 1): ?>
            <div class="pagination">
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <a href="?page=<?= $i ?>"
                        class="<?= $page == $i ? 'active' : '' ?>">
                        <?= $i ?>
                    </a>
                <?php endfor; ?>
            </div>
        <?php endif; ?>
    </div>

    <?php include 'footer.php' ?>
</body>

</html>