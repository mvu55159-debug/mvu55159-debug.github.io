<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
require_once '../ketnoi.php';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Quản lý Sản phẩm - TND Computer</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container" style="padding: 20px 0;">
    <h2>Trang Quản Trị Hệ Thống</h2>
    <p>Xin chào, <?php echo $_SESSION['admin']; ?> | <a href="logout.php" style="color: red;">Đăng xuất</a> | <a href="../index.php" style="color: blue;">Xem Website</a></p>
    
    <div style="margin: 20px 0; display: flex; justify-content: space-between;">
        <h3>Danh sách Sản Phẩm</h3>
        <a href="them.php" class="btn-submit" style="width: auto;">+ Thêm sản phẩm mới</a>
    </div>

    <table class="admin-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Hình ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Danh mục</th>
                <th>Giá</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM products ORDER BY id DESC";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['id']}</td>
                        <td><img src='../images/{$row['image']}' alt='img'></td>
                        <td>{$row['name']}</td>
                        <td>{$row['category']}</td>
                        <td>" . number_format($row['price'], 0, ',', '.') . " đ</td>
                        <td>
                            <a href='sua.php?id={$row['id']}' class='btn-edit'>Sửa</a> 
                            <a href='xoa.php?id={$row['id']}' onclick='return confirm(\"Bạn có chắc chắn muốn xóa?\")' class='btn-delete'>Xóa</a>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Chưa có sản phẩm nào.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>