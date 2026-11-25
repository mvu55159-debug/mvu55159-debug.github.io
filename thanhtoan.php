<?php
session_start();
require_once 'ketnoi.php';

$success = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    
    // Tính tổng tiền giỏ hàng hiện tại
    $total = 0;
    if (!empty($_SESSION['cart'])) {
        $ids = implode(',', array_keys($_SESSION['cart']));
        $result = $conn->query("SELECT * FROM products WHERE id IN ($ids)");
        while ($row = $result->fetch_assoc()) {
            $total += $row['price'] * $_SESSION['cart'][$row['id']];
        }
    }

    // Lưu đơn hàng vào database (Bảng orders)
    $sql = "INSERT INTO orders (customer_name, phone, address, total_price) VALUES ('$name', '$phone', '$address', '$total')";
    if ($conn->query($sql)) {
        // Xóa giỏ hàng sau khi đặt thành công
        unset($_SESSION['cart']);
        $success = "Đặt hàng thành công! Chúng tôi sẽ liên hệ với bạn sớm nhất.";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thanh toán - TND Computer</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container" style="max-width: 600px; margin: 30px auto; background: #fff; padding: 25px; border-radius: 8px;">
        <h2>Thông tin thanh toán</h2>
        <?php if($success): ?>
            <p style="color: green; font-weight: bold; font-size: 1.2em;"><?php echo $success; ?></p>
            <a href="sanpham.php" style="display:inline-block; margin-top:15px; padding:10px 15px; background:#007bff; color:#fff; text-decoration:none; border-radius:4px;">Tiếp tục mua sắm</a>
        <?php else: ?>
            <form method="POST">
                <div style="margin-bottom: 15px;">
                    <label>Họ tên người nhận:</label><br>
                    <input type="text" name="name" required style="width: 100%; padding: 8px; margin-top: 5px;">
                </div>
                <div style="margin-bottom: 15px;">
                    <label>Số điện thoại:</label><br>
                    <input type="text" name="phone" required style="width: 100%; padding: 8px; margin-top: 5px;">
                </div>
                <div style="margin-bottom: 15px;">
                    <label>Địa chỉ nhận hàng:</label><br>
                    <textarea name="address" required rows="3" style="width: 100%; padding: 8px; margin-top: 5px;"></textarea>
                </div>
                <button type="submit" style="background: #28a745; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; width: 100%;">Xác nhận đặt hàng</button>
            </form>
        <?php endif; ?>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>