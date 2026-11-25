<?php
$host = "sql207.infinityfree.com"; //"localhost";
$username = "if0_43403668";//"root";
$password = "0Cd9UN6YFxNgSe"; // Mặc định XAMPP là rỗng , lấy trong cái infinity free khi tạo địa chỉ web 
$database = "if0_43403668_tnd_db";//"TND_computer";

$conn = new mysqli($host, $username, $password, $database);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
// Đảm bảo hiển thị tiếng Việt chính xác
$conn->set_charset("utf8mb4"); // tiếng việt có dáu 
?>