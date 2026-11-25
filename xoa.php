<?php
session_start();
if (!isset($_SESSION['admin'])) { header("Location: login.php"); exit(); }
require_once '../ketnoi.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    // (Tùy chọn: Xóa luôn file ảnh trong thư mục images ở đây bằng hàm unlink())
    $sql = "DELETE FROM products WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Lỗi xóa: " . $conn->error;
    }
}
?>