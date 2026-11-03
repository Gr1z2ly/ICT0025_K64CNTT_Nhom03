<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>06_van_dung</title>
</head>
<body>
    <?php
        // Đề tài A9: Bán hàng mini có giỏ hàng
        define("TY_LE_PHI", 0.05); // Hằng số tỷ lệ phí 5%

        // Viết hàm tính toán hóa đơn
        function tinhHoaDon($ten_san_pham, $so_luong, $don_gia) {
            $tien_hang = $so_luong * $don_gia;
            $tien_phi = $tien_hang * TY_LE_PHI;
            $tong_tien = $tien_hang + $tien_phi;
            
            return [
                'ten' => $ten_san_pham,
                'so_luong' => $so_luong,
                'don_gia' => $don_gia,
                'tien_hang' => $tien_hang,
                'tien_phi' => $tien_phi,
                'tong_tien' => $tong_tien
            ];
        }

        // Chạy thử với 2 bộ dữ liệu bằng Hàm
        $bo_du_lieu_1 = tinhHoaDon("Áo phông Unisex", 3, 250000);
        $bo_du_lieu_2 = tinhHoaDon("Sản phẩm mẫu (Mục A2)", 3, 25000);

        function inHoaDon($data, $tieu_de) {
            echo "<h2>$tieu_de</h2>";
            echo "Tên sản phẩm: " . $data['ten'] . "<br>";
            echo "Số lượng mua: " . $data['so_luong'] . "<br>";
            echo "Đơn giá: " . number_format($data['don_gia']) . " VNĐ<br>";
            echo "Tiền hàng: " . number_format($data['tien_hang']) . " VNĐ<br>";
            echo "Tỷ lệ phí dịch vụ: " . (TY_LE_PHI * 100) . "%<br>";
            echo "Phí dịch vụ: " . number_format($data['tien_phi']) . " VNĐ<br>";
            echo "<strong>Tổng số tiền cần thanh toán: (" . $data['so_luong'] . " * " . $data['don_gia'] . ") + (" . $data['tien_hang'] . " * " . TY_LE_PHI . ") = " . number_format($data['tong_tien']) . " VNĐ</strong><br><hr>";
        }

        inHoaDon($bo_du_lieu_1, "BỘ DỮ LIỆU 1 (THỰC TẾ A9)");
        inHoaDon($bo_du_lieu_2, "BỘ DỮ LIỆU 2 (ĐỐI CHIẾU MẪU A2)");
    ?>
</body>
</html>