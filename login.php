<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once '../ketnoi.php';

if (isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit();
}

$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);
    
    $sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $_SESSION['admin'] = $username;
        header("Location: index.php");
        exit();
    } else {
        $error = "Sai tài khoản hoặc mật khẩu!";
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Đăng nhập quản trị</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="form-container" style="margin-top: 100px;">
        <h2 style="text-align: center; margin-bottom: 20px;">Đăng Nhập Quản Trị</h2>
        <?php if($error) echo "<p style='color:red; text-align:center;'>$error</p>"; ?>
        <form action="" method="POST">
            <div class="form-group">
                <label>Tài khoản</label>
                <input type="text" name="username" required>
            </div>
            <div class="form-group">
                <label>Mật khẩu</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit" class="btn-submit">Đăng nhập</button>
            <p style="text-align: center; margin-top: 15px;"><a href="../index.php">Về trang chủ</a></p>
        </form>
    </div>
</body>
</html>