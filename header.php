<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TND Computer - Thiết bị công nghệ hàng đầu</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header>
    <div class="container header-top">
        <div class="logo">
            <a href="index.php"><h1>TND Computer</h1></a>
        </div>
        <form action="sanpham.php" method="GET" class="search-form">
            <input type="text" name="search" placeholder="Tìm kiếm sản phẩm..." required>
            <button type="submit">Tìm</button>
        </form>
    </div>
    <div class="container">
        <nav>
            <ul>
                <li><a href="index.php">Trang chủ</a></li>
                <li><a href="sanpham.php">Sản phẩm</a></li>
                <li><a href="sanpham.php?category=Laptop">Laptop</a></li>
                <li><a href="sanpham.php?category=PC Gaming">PC Gaming</a></li>
                <li><a href="lienhe.php">Liên hệ</a></li>
                <li><a href="admin/login.php">Quản trị</a></li>
            </ul>
        </nav>
    </div>
</header>