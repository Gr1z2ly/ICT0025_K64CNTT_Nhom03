<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>02_bien</title>
</head>
<body>
    <?php
        // Sử dụng Mảng kết hợp (Associative Array) quản lý biến đối tượng
        $san_pham = [
            "ten" => "Tai nghe Bluetooth Wireless",
            "so_luong" => 2,
            "don_gia" => 450000
        ];

        echo "--- THÔNG TIN BAN ĐẦU ---<br>";
        echo "Tên sản phẩm: " . $san_pham['ten'] . "<br>";
        echo "Số lượng: " . $san_pham['so_luong'] . "<br>";
        echo "Đơn giá: " . number_format($san_pham['don_gia']) . " VNĐ<br><br>";

        // Thay đổi số lượng sản phẩm
        $san_pham['so_luong'] = 5;

        echo "--- THÔNG TIN SAU KHI CẬP NHẬT SỐ LƯỢNG ---<br>";
        echo "Tên sản phẩm: " . $san_pham['ten'] . "<br>";
        echo "Số lượng mới: " . $san_pham['so_luong'] . "<br>";
        // Nối chuỗi dùng toán tử chấm (.)
        echo "Đơn giá: " . number_format($san_pham['don_gia']) . " VNĐ<br>";
        echo "Tổng tạm tính: " . number_format($san_pham['so_luong'] * $san_pham['don_gia']) . " VNĐ<br>";
    ?>
</body>
</html>