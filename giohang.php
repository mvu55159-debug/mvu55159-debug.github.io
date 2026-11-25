<?php
session_start();
require_once 'ketnoi.php';

// 1. Xử lý khi bấm nút "Thêm vào giỏ hàng" từ trang chi tiết
if (isset($_POST['add_to_cart'])) {
    $product_id = intval($_POST['product_id']);
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

    // Nếu sản phẩm đã có trong giỏ hàng thì cộng dồn số lượng, nếu chưa thì thêm mới
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id] += $quantity;
    } else {
        $_SESSION['cart'][$product_id] = $quantity;
    }

    // Chuyển hướng lại trang giỏ hàng để tránh việc F5 bị gửi lại form
    header("Location: giohang.php");
    exit();
}

// 2. Xử lý xóa sản phẩm khỏi giỏ hàng
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $id = intval($_GET['id']);
    unset($_SESSION['cart'][$id]);
    header("Location: giohang.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Giỏ hàng - TND Computer</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'header.php'; ?>
    
    <div class="container" style="margin: 30px auto; width: 85%;">
        <h2>Giỏ hàng của bạn</h2>
        
        <?php if (empty($_SESSION['cart'])): ?>
            <p style="margin-top: 20px;">Giỏ hàng đang trống! <a href="sanpham.php" style="color: #007bff; text-decoration: none;">Tiếp tục mua sắm ngay</a></p>
        <?php else: ?>
            <table style="width: 100%; border-collapse: collapse; margin-top: 20px; background: #fff;">
                <tr style="background: #f4f4f4;">
                    <th style="border: 1px solid #ddd; padding: 10px;">Tên sản phẩm</th>
                    <th style="border: 1px solid #ddd; padding: 10px;">Giá</th>
                    <th style="border: 1px solid #ddd; padding: 10px;">Số lượng</th>
                    <th style="border: 1px solid #ddd; padding: 10px;">Thành tiền</th>
                    <th style="border: 1px solid #ddd; padding: 10px;">Thao tác</th>
                </tr>
                <?php
                $total_all = 0;
                foreach ($_SESSION['cart'] as $id => $quantity) {
                    $result = $conn->query("SELECT * FROM products WHERE id = $id");
                    if ($row = $result->fetch_assoc()) {
                        $subtotal = $row['price'] * $quantity;
                        $total_all += $subtotal;
                ?>
                <tr>
                    <td style="border: 1px solid #ddd; padding: 10px;"><?php echo $row['name']; ?></td>
                    <td style="border: 1px solid #ddd; padding: 10px; color: #e74c3c;"><?php echo number_format($row['price'], 0, ',', '.'); ?> VNĐ</td>
                    <td style="border: 1px solid #ddd; padding: 10px; text-align: center;"><?php echo $quantity; ?></td>
                    <td style="border: 1px solid #ddd; padding: 10px; font-weight: bold;"><?php echo number_format($subtotal, 0, ',', '.'); ?> VNĐ</td>
                    <td style="border: 1px solid #ddd; padding: 10px; text-align: center;">
                        <a href="giohang.php?action=delete&id=<?php echo $id; ?>" style="color: red; text-decoration: none;">Xóa</a>
                    </td>
                </tr>
                <?php 
                    }
                } 
                ?>
            </table>
            
            <h3 style="text-align: right; margin-top: 20px;">Tổng tiền thanh toán: <span style="color: #e74c3c;"><?php echo number_format($total_all, 0, ',', '.'); ?> VNĐ</span></h3>
            
            <div style="text-align: right; margin-top: 15px;">
                <a href="thanhtoan.php" style="background: #d9534f; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px; font-weight: bold;">Tiến hành đặt hàng</a>
            </div>
        <?php endif; ?>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>