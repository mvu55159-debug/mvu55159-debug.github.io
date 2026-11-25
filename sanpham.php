<?php 
require_once 'ketnoi.php';
include 'header.php'; 
?>

<div class="container">
    <h2 class="section-title">Danh sách Sản Phẩm</h2>
    
    <div class="product-grid">
        <?php
        $sql = "SELECT * FROM products WHERE 1";
        
        // Xử lý Tìm kiếm
        if (isset($_GET['search'])) {
            $search = $conn->real_escape_string($_GET['search']);
            $sql .= " AND name LIKE '%$search%'";
            echo "<p style='width:100%'>Kết quả tìm kiếm cho: <strong>$search</strong></p>";
        }
        // Xử lý Lọc danh mục
        if (isset($_GET['category'])) {
            $category = $conn->real_escape_string($_GET['category']);
            $sql .= " AND category = '$category'";
            echo "<p style='width:100%'>Danh mục: <strong>$category</strong></p>";
        }
        
        $sql .= " ORDER BY id DESC";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
        ?>
            <div class="product-card">
                <img src="images/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
                <h3><?php echo $row['name']; ?></h3>
                <p class="product-price"><?php echo number_format($row['price'], 0, ',', '.'); ?> VNĐ</p>
                <a href="chitiet.php?id=<?php echo $row['id']; ?>" class="btn-view">Xem chi tiết</a>
            </div>
        <?php
            }
        } else {
            echo "<p>Không tìm thấy sản phẩm nào.</p>";
        }
        ?>
    </div>
</div>

<?php include 'footer.php'; ?>