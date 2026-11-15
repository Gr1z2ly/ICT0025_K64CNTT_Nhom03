-- FreshNest - Database setup
-- Import this file using phpMyAdmin (XAMPP).
-- MySQL / MariaDB compatible.

CREATE DATABASE IF NOT EXISTS freshnest_db
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE freshnest_db;

CREATE TABLE IF NOT EXISTS danhmuc (
    id_danhmuc INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    ten_danhmuc VARCHAR(100) NOT NULL,
    mo_ta TEXT NULL,
    hinh_anh VARCHAR(255) NULL,
    ngay_tao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS sanpham (
    id_sanpham INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    ten_sanpham VARCHAR(150) NOT NULL,
    gia DECIMAL(12,2) NOT NULL DEFAULT 0,
    so_luong INT UNSIGNED NOT NULL DEFAULT 0,
    hinh_anh VARCHAR(255) NULL,
    mo_ta TEXT NULL,
    id_danhmuc INT UNSIGNED NOT NULL,
    trang_thai TINYINT(1) NOT NULL DEFAULT 1,
    ngay_tao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_sanpham_danhmuc
      FOREIGN KEY (id_danhmuc) REFERENCES danhmuc(id_danhmuc)
      ON UPDATE CASCADE ON DELETE RESTRICT,
    INDEX idx_sanpham_danhmuc (id_danhmuc),
    INDEX idx_sanpham_ten (ten_sanpham)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS donhang (
    id_donhang INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    ten_khachhang VARCHAR(100) NOT NULL,
    sodienthoai VARCHAR(20) NOT NULL,
    diachi TEXT NOT NULL,
    ghi_chu TEXT NULL,
    ngay_dat DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    tong_tien DECIMAL(12,2) NOT NULL DEFAULT 0,
    phuong_thuc_tt VARCHAR(30) NOT NULL DEFAULT 'COD',
    trang_thai VARCHAR(30) NOT NULL DEFAULT 'Chờ xác nhận',
    INDEX idx_donhang_ngay_dat (ngay_dat),
    INDEX idx_donhang_trang_thai (trang_thai)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS chitietdonhang (
    id_chitiet INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_donhang INT UNSIGNED NOT NULL,
    id_sanpham INT UNSIGNED NOT NULL,
    ten_sanpham VARCHAR(150) NOT NULL,
    so_luong INT UNSIGNED NOT NULL,
    don_gia DECIMAL(12,2) NOT NULL,
    thanh_tien DECIMAL(12,2) NOT NULL,
    CONSTRAINT fk_chitiet_donhang
      FOREIGN KEY (id_donhang) REFERENCES donhang(id_donhang)
      ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT fk_chitiet_sanpham
      FOREIGN KEY (id_sanpham) REFERENCES sanpham(id_sanpham)
      ON UPDATE CASCADE ON DELETE RESTRICT,
    INDEX idx_chitiet_donhang (id_donhang),
    INDEX idx_chitiet_sanpham (id_sanpham)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS taikhoan (
    id_taikhoan INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    ten_dang_nhap VARCHAR(50) NOT NULL UNIQUE,
    mat_khau VARCHAR(255) NOT NULL,
    ho_ten VARCHAR(100) NOT NULL,
    vai_tro VARCHAR(20) NOT NULL DEFAULT 'admin',
    ngay_tao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Sample categories
INSERT INTO danhmuc (id_danhmuc, ten_danhmuc, mo_ta, hinh_anh) VALUES
(1, 'Rau củ', 'Rau củ tươi mỗi ngày', 'category-vegetables.jpg'),
(2, 'Trái cây', 'Trái cây tươi ngon', 'category-fruits.jpg'),
(3, 'Thực phẩm', 'Thực phẩm thiết yếu', 'category-food.jpg'),
(4, 'Đồ uống', 'Sữa và đồ uống', 'category-drinks.jpg'),
(5, 'Bánh & Snack', 'Bánh và đồ ăn nhẹ', 'category-snacks.jpg')
ON DUPLICATE KEY UPDATE ten_danhmuc = VALUES(ten_danhmuc);

-- Sample products. Prices are illustrative and can be edited in Admin.
INSERT INTO sanpham
(id_sanpham, ten_sanpham, gia, so_luong, hinh_anh, mo_ta, id_danhmuc, trang_thai)
VALUES
(1, 'Bắp cải xanh', 13000, 40, 'bap-cai-xanh.jpg', 'Bắp cải xanh tươi, phù hợp cho bữa ăn gia đình.', 1, 1),
(2, 'Bông cải xanh', 25000, 25, 'bong-cai-xanh.jpg', 'Bông cải xanh tươi ngon.', 1, 1),
(3, 'Cà rốt', 18000, 35, 'ca-rot.jpg', 'Cà rốt giàu vitamin, dễ chế biến.', 1, 1),
(4, 'Khoai tây', 17000, 30, 'khoai-tay.jpg', 'Khoai tây dùng cho nhiều món ăn.', 1, 1),
(5, 'Xoài chín', 25000, 20, 'xoai-chin.jpg', 'Xoài chín ngọt tự nhiên.', 2, 1),
(6, 'Táo đỏ', 45000, 20, 'tao-do.jpg', 'Táo đỏ giòn ngọt.', 2, 1),
(7, 'Cam tươi', 30000, 25, 'cam-tuoi.jpg', 'Cam tươi mọng nước.', 2, 1),
(8, 'Chuối', 20000, 30, 'chuoi.jpg', 'Chuối tươi, tiện lợi cho bữa phụ.', 2, 1),
(9, 'Trứng gà (10 quả)', 32000, 25, 'trung-ga.jpg', 'Trứng gà đóng khay 10 quả.', 3, 1),
(10, 'Gạo thơm (1 kg)', 22000, 50, 'gao-thom.jpg', 'Gạo thơm dùng hằng ngày.', 3, 1),
(11, 'Ức gà (500 g)', 55000, 15, 'uc-ga.jpg', 'Ức gà tươi, bảo quản lạnh.', 3, 1),
(12, 'Sữa tươi (1 lít)', 35000, 20, 'sua-tuoi.jpg', 'Sữa tươi hộp 1 lít.', 4, 1),
(13, 'Nước cam (1 lít)', 42000, 18, 'nuoc-cam.jpg', 'Nước cam đóng chai.', 4, 1),
(14, 'Bánh quy', 28000, 20, 'banh-quy.jpg', 'Bánh quy giòn cho bữa ăn nhẹ.', 5, 1),
(15, 'Khoai tây lát', 20000, 22, 'snack-khoai-tay.jpg', 'Snack khoai tây giòn.', 5, 1)
ON DUPLICATE KEY UPDATE
  ten_sanpham = VALUES(ten_sanpham),
  gia = VALUES(gia),
  so_luong = VALUES(so_luong),
  id_danhmuc = VALUES(id_danhmuc);
