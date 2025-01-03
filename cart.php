<?php
include 'config.php';
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Get cart items with prepared statement
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT cart.id as id_cart, 
    c.id as course_id, 
    image, 
    name, 
    price, 
    number_lessons, 
    number_student 
    FROM course_cart as cart 
    INNER JOIN courses as c ON cart.course_id = c.id 
    WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$course_cart = $stmt->get_result();

// Get cart total
$stmt = $conn->prepare("SELECT SUM(price) as total_money 
    FROM course_cart as cart 
    INNER JOIN courses as c ON cart.course_id = c.id 
    WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$total = $result->fetch_assoc();
$total_money = $total['total_money'] ?? 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart | Course Platform</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.0/css/all.min.css">
    <link rel="stylesheet" href="./CSS/user_style.css">
    <link rel="stylesheet" href="./CSS/cart.css">

</head>

<body>
    <?php include 'header.php' ?>

    <div class="main">
        <h1>Shopping Cart</h1>
        <div class="container-box">
            <?php if ($course_cart->num_rows > 0): ?>
                <?php while ($row = $course_cart->fetch_assoc()): ?>
                    <div class="box">
                        <a href="detail_course.php?course_id=<?= htmlspecialchars($row['course_id']) ?>">
                            <img src="uploaded_img/<?= htmlspecialchars($row['image']) ?>" alt="Course Image">
                            <div class="info">
                                <h3 class="title info-card"><?= htmlspecialchars($row['name']) ?></h3>
                                <p class="info-card">Price: <span class="price"><?= number_format($row['price']) ?> VND</span></p>
                                <p class="info-card">Lessons: <span><?= htmlspecialchars($row['number_lessons']) ?></span></p>
                                <p class="info-card">Students: <span><?= htmlspecialchars($row['number_student']) ?></span></p>
                            </div>
                        </a>
                        <div class="btn-add">
                            <a href="delete_cart.php?id=<?= htmlspecialchars($row['id_cart']) ?>"
                                onclick="return confirm('Remove this course from cart?')"
                                class="delete-btn">Remove</a>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="empty-cart">Your cart is empty</p>
            <?php endif; ?>
        </div>

        <?php if ($total_money > 0): ?>
            <div class="checkout">
                <div class="tong">
                    <h2>Total: <span><?= number_format($total_money) ?> VND</span></h2>
                    <button class="btn-checkout" onclick="showPaymentQR()">Checkout</button>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- Payment QR Modal -->
    <div class="main-qr" id="main-qr">
        <div class="box-qr">
            <h1>Scan QR Code to Pay</h1>
            <img src="./images/payment-qr.jpg" width="200px" alt="Payment QR Code">
            <div class="payment-details">
                <p>Bank: <strong>BIDV</strong></p>
                <p>Account Number: <strong>99999999</strong></p>
                <p>Account Name: <strong>Nhóm 7 pro</strong></p>
                <p>Amount: <strong><?= number_format($total_money) ?> VND</strong></p>
            </div>
            <div class="payment-actions">
                <button class="btn-cancel" onclick="hidePaymentQR()">Cancel</button>
                <a href="checkout.php" class="btn-finish">Complete Payment</a>
            </div>
        </div>
    </div>

    <?php include 'footer.php' ?>

    <script>
        function showPaymentQR() {
            document.getElementById('main-qr').classList.add('active-qr');
        }

        function hidePaymentQR() {
            document.getElementById('main-qr').classList.remove('active-qr');
        }
    </script>
</body>

</html>