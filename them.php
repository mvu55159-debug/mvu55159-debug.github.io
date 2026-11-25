<?php
session_start();
if (!isset($_SESSION['admin'])) { header("Location: login.php"); exit(); }
require_once '../ketnoi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $category = $conn->real_escape_string($_POST['category']);
    $price = intval($_POST['price']);
    $cpu = $conn->real_escape_string($_POST['CPU']);
    $ram = $conn->real_escape_string($_POST['RAM']);
    $storage = $conn->real_escape_string($_POST['storage']);
    $gpu = $conn->real_escape_string($_POST['GPU']);
    $desc = $conn->real_escape_string($_POST['description']);
    
    // Xử lý upload ảnh cơ bản
    $imageName = "default.jpg";
    if(isset($_FILES['image']) && $_FILES['image']['name'] != ""){
        $imageName = time() . "_" . basename($_FILES["image"]["name"]);
        $target_file = "../images/" . $imageName;
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    }

    $sql = "INSERT INTO products (name, category, price, image, CPU, RAM, storage, GPU, description) 
            VALUES ('$name', '$category', $price, '$imageName', '$cpu', '$ram', '$storage', '$gpu', '$desc')";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Thêm thành công!'); window.location.href='index.php';</script>";
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm Sản Phẩm</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container" style="padding: 20px 0;">
    <h2><a href="index.php" style="color: blue;">&laquo; Quay lại</a> | Thêm Sản Phẩm Mới</h2>
    <div class="form-container" style="max-width: 800px;">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group"><label>Tên sản phẩm *</label><input type="text" name="name" required></div>
            <div class="form-group">
                <label>Danh mục *</label>
                <select name="category" required>
                    <option value="Laptop">Laptop</option>
                    <option value="PC Gaming">PC Gaming</option>
                    <option value="PC văn phòng">PC văn phòng</option>
                    <option value="Màn hình">Màn hình</option>
                    <option value="Linh kiện máy tính">Linh kiện máy tính</option>
                    <option value="Phụ kiện">Phụ kiện</option>
                </select>
            </div>
            <div class="form-group"><label>Giá (VNĐ) *</label><input type="number" name="price" required></div>
            <div class="form-group"><label>Hình ảnh</label><input type="file" name="image" accept="image/*"></div>
            <div class="form-group"><label>CPU</label><input type="text" name="CPU"></div>
            <div class="form-group"><label>RAM</label><input type="text" name="RAM"></div>
            <div class="form-group"><label>Ổ cứng</label><input type="text" name="storage"></div>
            <div class="form-group"><label>Card đồ họa (GPU)</label><input type="text" name="GPU"></div>
            <div class="form-group"><label>Mô tả chi tiết</label><textarea name="description" rows="5"></textarea></div>
            <button type="submit" class="btn-submit">Thêm Sản Phẩm</button>
        </form>
    </div>
</div>
</body>
</html>