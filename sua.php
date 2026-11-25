<?php
session_start();
if (!isset($_SESSION['admin'])) { header("Location: login.php"); exit(); }
require_once '../ketnoi.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$sql = "SELECT * FROM products WHERE id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if (!$row) { die("Không tìm thấy sản phẩm!"); }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $category = $conn->real_escape_string($_POST['category']);
    $price = intval($_POST['price']);
    $cpu = $conn->real_escape_string($_POST['CPU']);
    $ram = $conn->real_escape_string($_POST['RAM']);
    $storage = $conn->real_escape_string($_POST['storage']);
    $gpu = $conn->real_escape_string($_POST['GPU']);
    $desc = $conn->real_escape_string($_POST['description']);
    
    $imageName = $row['image']; // Giữ ảnh cũ
    if(isset($_FILES['image']) && $_FILES['image']['name'] != ""){
        $imageName = time() . "_" . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], "../images/" . $imageName);
    }

    $sql_update = "UPDATE products SET name='$name', category='$category', price=$price, image='$imageName', CPU='$cpu', RAM='$ram', storage='$storage', GPU='$gpu', description='$desc' WHERE id=$id";
    
    if ($conn->query($sql_update) === TRUE) {
        echo "<script>alert('Cập nhật thành công!'); window.location.href='index.php';</script>";
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa Sản Phẩm</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container" style="padding: 20px 0;">
    <h2><a href="index.php" style="color: blue;">&laquo; Quay lại</a> | Sửa Sản Phẩm</h2>
    <div class="form-container" style="max-width: 800px;">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group"><label>Tên sản phẩm *</label><input type="text" name="name" value="<?php echo $row['name']; ?>" required></div>
            <div class="form-group">
                <label>Danh mục *</label>
                <select name="category" required>
                    <option value="Laptop" <?php if($row['category']=='Laptop') echo 'selected';?>>Laptop</option>
                    <option value="PC Gaming" <?php if($row['category']=='PC Gaming') echo 'selected';?>>PC Gaming</option>
                    <option value="PC văn phòng" <?php if($row['category']=='PC văn phòng') echo 'selected';?>>PC văn phòng</option>
                </select>
            </div>
            <div class="form-group"><label>Giá (VNĐ) *</label><input type="number" name="price" value="<?php echo $row['price']; ?>" required></div>
            <div class="form-group">
                <label>Hình ảnh (Để trống nếu không đổi)</label>
                <img src="../images/<?php echo $row['image']; ?>" width="100"><br>
                <input type="file" name="image" accept="image/*">
            </div>
            <div class="form-group"><label>CPU</label><input type="text" name="CPU" value="<?php echo $row['CPU']; ?>"></div>
            <div class="form-group"><label>RAM</label><input type="text" name="RAM" value="<?php echo $row['RAM']; ?>"></div>
            <div class="form-group"><label>Ổ cứng</label><input type="text" name="storage" value="<?php echo $row['storage']; ?>"></div>
            <div class="form-group"><label>Card đồ họa</label><input type="text" name="GPU" value="<?php echo $row['GPU']; ?>"></div>
            <div class="form-group"><label>Mô tả chi tiết</label><textarea name="description" rows="5"><?php echo $row['description']; ?></textarea></div>
            <button type="submit" class="btn-submit">Cập Nhật</button>
        </form>
    </div>
</div>
</body>
</html>