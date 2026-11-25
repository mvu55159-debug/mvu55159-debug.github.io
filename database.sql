CREATE DATABASE IF NOT EXISTS TND_computer DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE TND_computer;

-- Bảng tài khoản quản trị
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
);

-- Bảng sản phẩm
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `CPU` varchar(100) DEFAULT NULL,
  `RAM` varchar(100) DEFAULT NULL,
  `storage` varchar(100) DEFAULT NULL,
  `GPU` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- Thêm dữ liệu mẫu
INSERT INTO `admin` (`username`, `password`) VALUES ('admin', '123456');

INSERT INTO `products` (`name`, `category`, `price`, `image`, `CPU`, `RAM`, `storage`, `GPU`, `description`) VALUES
('Laptop Gaming ASUS ROG', 'Laptop', 25000000, 'asus_rog.jpg', 'Intel Core i7 12700H', '16GB DDR5', '512GB SSD', 'RTX 3060', 'Laptop gaming hiệu năng cao, tản nhiệt tốt.'),
('PC Văn Phòng Dell Optiplex', 'PC văn phòng', 8500000, 'dell_pc.jpg', 'Intel Core i5 10400', '8GB DDR4', '256GB SSD', 'Intel UHD 630', 'Máy tính bộ nhỏ gọn, ổn định cho văn phòng.'),
('Màn hình LG 27 inch 144Hz', 'Màn hình', 4500000, 'lg_monitor.jpg', '-', '-', '-', '-', 'Màn hình tần số quét cao dành cho game thủ.');