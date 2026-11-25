<footer>
    <div class="container">
        <h3>TND Computer - Uy tín tạo niềm tin</h3>
        <p>Địa chỉ: Trường Đại học Văn Lang, TP.HCM</p>
        <p>Email: hotro@tndcomputer.com | Hotline: 0123 456 789</p>
        <p>&copy; <?php echo date("Y"); ?> TND Computer. Thiết kế bởi Sinh viên đồ án.</p>
    </div>
</footer>

<!-- KHAI BÁO FILE JAVASCRIPT Ở ĐÂY (Ngay trước thẻ đóng body) -->
<!-- Lưu ý: Trang admin nằm trong thư mục con, nên cần dùng đường dẫn linh hoạt -->
<?php
    // Kiểm tra xem đang ở trang admin hay trang ngoài để gọi đúng đường dẫn
    $script_path = strpos($_SERVER['REQUEST_URI'], '/admin/') !== false ? '../js/script.js' : 'js/script.js';
?>
<script src="<?php echo $script_path; ?>"></script>

</body>
</html>