<?php 
require_once 'ketnoi.php';
include 'header.php'; 

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM products WHERE id = $id";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
?>
<div class="container">
    <div style="display: flex; flex-wrap: wrap; gap: 30px; margin: 40px 0; background: #fff; padding: 20px; border-radius: 8px;">
        <div style="flex: 1; min-width: 300px; text-align: center;">
            <img src="images/<?php echo $row['image']; ?>" style="max-width: 100%; border-radius: 5px;">
        </div>
        <div style="flex: 2; min-width: 300px;">
            <h2><?php echo $row['name']; ?></h2>
            <p style="color: #e74c3c; font-size: 1.5em; font-weight: bold; margin: 15px 0;">
                Giá: <?php echo number_format($row['price'], 0, ',', '.'); ?> VNĐ
            </p>
            <p><strong>Danh mục:</strong> <?php echo $row['category']; ?></p>
            
            <table style="width: 100%; border-collapse: collapse; margin: 20px 0;">
                <tr><td style="border: 1px solid #ccc; padding: 8px;">CPU</td><td style="border: 1px solid #ccc; padding: 8px;"><?php echo $row['CPU']; ?></td></tr>
                <tr><td style="border: 1px solid #ccc; padding: 8px;">RAM</td><td style="border: 1px solid #ccc; padding: 8px;"><?php echo $row['RAM']; ?></td></tr>
                <tr><td style="border: 1px solid #ccc; padding: 8px;">Ổ cứng</td><td style="border: 1px solid #ccc; padding: 8px;"><?php echo $row['storage']; ?></td></tr>
                <tr><td style="border: 1px solid #ccc; padding: 8px;">VGA</td><td style="border: 1px solid #ccc; padding: 8px;"><?php echo $row['GPU']; ?></td></tr>
            </table>
            
            <h3>Mô tả sản phẩm:</h3>
            <p style="margin-top: 10px; line-height: 1.6;"><?php echo nl2br($row['description']); ?></p>
            
            <br>
            <!-- Form xử lý giỏ hàng và mua ngay -->
<form action="giohang.php" method="POST">
    <!-- Gửi kèm ID sản phẩm cần mua -->
    <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
    
    <div style="margin: 15px 0;">
        <label>Số lượng:</label>
        <input type="number" name="quantity" value="1" min="1" max="10" style="width: 60px; padding: 5px;">
    </div>

    <!-- Nút Thêm vào giỏ hàng -->
    <button type="submit" name="add_to_cart" style="background: #f0ad4e; color: white; padding: 10px 20px; border: none; cursor: pointer; border-radius: 4px;">
        Thêm vào giỏ hàng
    </button>

    <!-- Nút Mua ngay (Chuyển thẳng đến trang thanh toán) -->
    <button type="submit" name="buy_now" formaction="thanhtoan.php" style="background: #d9534f; color: white; padding: 10px 20px; border: none; cursor: pointer; border-radius: 4px; margin-left: 10px;">
        Mua ngay
    </button>
</form>
        </div>
    </div>
</div>
<?php
    } else {
        echo "<div class='container'><h2 style='text-align:center; padding: 50px 0;'>Không tìm thấy sản phẩm.</h2></div>";
    }
}
include 'footer.php'; 
?>