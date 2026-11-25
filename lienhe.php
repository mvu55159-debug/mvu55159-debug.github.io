<?php include 'header.php'; ?>
<div class="container">
    <div class="form-container">
        <h2 style="text-align: center; margin-bottom: 20px;">Liên Hệ Chúng Tôi</h2>
        
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = htmlspecialchars($_POST['name']);
            $email = htmlspecialchars($_POST['email']);
            $message = htmlspecialchars($_POST['message']);
            
            if (!empty($name) && !empty($email) && !empty($message)) {
                // Thực tế có thể dùng hàm mail() ở đây
                echo "<p style='color: green; text-align: center;'>Cảm ơn $name, chúng tôi đã nhận được thông tin và sẽ phản hồi sớm nhất!</p>";
            } else {
                echo "<p style='color: red; text-align: center;'>Vui lòng nhập đầy đủ thông tin.</p>";
            }
        }
        ?>

        <form action="" method="POST">
            <div class="form-group">
                <label>Họ và Tên</label>
                <input type="text" name="name" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label>Số điện thoại</label>
                <input type="text" name="phone">
            </div>
            <div class="form-group">
                <label>Nội dung</label>
                <textarea name="message" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn-submit">Gửi Liên Hệ</button>
        </form>
    </div>
</div>
<?php include 'footer.php'; ?>